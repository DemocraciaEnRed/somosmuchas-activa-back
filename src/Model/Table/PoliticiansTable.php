<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Politicians Model
 *
 * @property \App\Model\Table\DistrictsTable|\Cake\ORM\Association\BelongsTo $Districts
 * @property \App\Model\Table\PartiesTable|\Cake\ORM\Association\BelongsTo $Parties
 * @property \App\Model\Table\PoliticiansProjectTable|\Cake\ORM\Association\HasMany $PoliticiansProject
 * @property \App\Model\Table\StancesTable|\Cake\ORM\Association\BelongsToMany $Stances
 *
 * @method \App\Model\Entity\Politician get($primaryKey, $options = [])
 * @method \App\Model\Entity\Politician newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Politician[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Politician|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Politician saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Politician patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Politician[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Politician findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PoliticiansTable extends Table
{

    public function sanitizeLatin($string) {
        $unsupported_characters = ['Ñ', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü',  'ä', 'ë', 'ï', 'ö', 'ü', ' '];
        $ucharacters_replace = ['n', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', '-'];
        $string = iconv('UTF-8', 'ASCII//TRANSLIT',  $string);
        $string = preg_replace("/[^\-a-zA-Z0-9.]/", "", $string);
        return str_replace($unsupported_characters, $ucharacters_replace, strtolower($string));
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('politicians');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
				'filesystem' => [
                    'root' => FRONT_ROOT
                ],
                'path' => '{DS}img{DS}personas{DS}{microtime}',
                'nameCallback' => function(array $data, array $settings) {
                    $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $filename = pathinfo($data['name'], PATHINFO_FILENAME );
                    return $this->sanitizeLatin($filename) . '.' . $ext;
                },
				'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {

					ini_set('memory_limit', '1024M');

                    $supported_image = ['gif', 'jpg', 'jpeg', 'png'];

        
                    $data['name'] = $this->sanitizeLatin(strtolower($data['name']));
                    
					$extension = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));

                    if (in_array($extension, $supported_image)) {

    					$tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$grid = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $box = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$imagine = new \Imagine\Imagick\Imagine();

    					$image = $imagine->open($data['tmp_name']);

                		$sizes = $image->getSize();

                		$width = $sizes->getWidth();
                		$height = $sizes->getHeight();

                        $this->imageTransformer($grid, $image, 400, 250);

                        $this->imageTransformer($box, $image, 320, 320);

                        $this->imageTransformer($tmp, $image);

    					return [
    						$data['tmp_name'] => $data['name'],
    						$grid => 'grid-' . $data['name'],
    						$box => 'box-' . $data['name'],
    						$tmp => 'thumb-' . $data['name'],
    					];

                    }

					return [ $data['tmp_name'] => $data['name'] ];
				},
            ]
        ]);

        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id'
        ]);
        $this->belongsTo('Parties', [
            'foreignKey' => 'party_id'
        ]);
        $this->hasMany('PoliticiansProject', [
            'foreignKey' => 'politician_id'
        ]);
        $this->belongsToMany('Stances', [
            'foreignKey' => 'politician_id',
            'targetForeignKey' => 'stance_id',
            'joinTable' => 'politicians_stances'
        ]);
    }

    public function imageTransformer($saveObj, $original, $setWidth = 220, $setHeight = 220)
    {

		$size = new \Imagine\Image\Box($setWidth, $setHeight);
		$mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

		$sizes = $original->getSize();

		$width = $sizes->getWidth();
		$height = $sizes->getHeight();

		$box = new \Imagine\Image\Box($width, $height);

		if($width < $setWidth || $height < $setHeight) {
			if($width <= $height) {
				$box = new \Imagine\Image\Box($setWidth, ($height*$setWidth/$width));
			} else {
                $box = new \Imagine\Image\Box(($width*$setWidth/$height), $setWidth);
			}
		}

		$original->resize($box)
			->thumbnail($size, $mode)
			->save($saveObj);
    }

    public function beforeSave($event, $entity, $options)
    {
        $twitter = $entity->get('twitter');

        if(!empty($twitter) && strcasecmp($twitter[0], "@") == 0) {
            $twitter = ltrim($twitter, '@');
        }

        $entity->set('twitter', $twitter);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->notEmpty('first_name', 'Debe ingresar el nombre.');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->notEmpty('first_name', 'Debe ingresar el apellido.');

        $validator
            ->date('birthday')
            ->allowEmptyDate('birthday');

        $validator
            ->scalar('religion')
            ->maxLength('religion', 50)
            ->allowEmptyString('religion');
        
        $validator
            ->allowEmptyFile('image', 'Debe seleccionar una imagen.', 'update');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['position_id'], 'Positions'));
        $rules->add($rules->existsIn(['party_id'], 'Parties'));

        return $rules;
    }
}

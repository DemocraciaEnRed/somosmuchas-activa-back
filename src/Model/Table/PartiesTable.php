<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parties Model
 *
 * @property \App\Model\Table\PoliticiansTable|\Cake\ORM\Association\HasMany $Politicians
 *
 * @method \App\Model\Entity\Party get($primaryKey, $options = [])
 * @method \App\Model\Entity\Party newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Party[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Party|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Party saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Party patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Party[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Party findOrCreate($search, callable $callback = null, $options = [])
 */
class PartiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('parties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
				'filesystem' => [
                    'root' => FRONT_ROOT
                ],
				'path' => '{DS}img{DS}bloques{DS}{microtime}',
                'nameCallback' => function(array $data, array $settings) {
                    $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $filename = pathinfo($data['name'], PATHINFO_FILENAME );
                    $unsupported_characters = ['Ñ', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü',  'ä', 'ë', 'ï', 'ö', 'ü', ' '];
                    $ucharacters_replace = ['n', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', '-'];
                    return str_replace($unsupported_characters, $ucharacters_replace, strtolower($filename)) . '.' . $ext;
                },
				'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {

					ini_set('memory_limit', '1024M');

                    $supported_image = ['gif', 'jpg', 'jpeg', 'png'];

                    $data['name'] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $data['name']);

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

        $this->hasMany('Politicians', [
            'foreignKey' => 'party_id'
        ]);
    }

    public function imageTransformer($saveObj, $original, $setWidth = 220, $setHeight = 220) {

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
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmpty('name', 'Debe ingresar el nombre del bloque.')
            ->add(
                'name', 
                ['unique' => [
                    'rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'Ya existe un bloque con ese nombre.']
                ]
            );

        $validator
            ->allowEmptyFile('image');
            
        $validator
            ->scalar('ideology')
            ->maxLength('ideology', 255)
            ->allowEmptyString('ideology');

        return $validator;
    }
}

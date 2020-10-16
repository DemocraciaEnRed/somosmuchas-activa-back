<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \App\Model\Table\PoliticiansProjectTable|\Cake\ORM\Association\HasMany $PoliticiansProject
 * @property \App\Model\Table\PoliticiansStancesTable|\Cake\ORM\Association\HasMany $PoliticiansStances
 * @property \App\Model\Table\StancesTable|\Cake\ORM\Association\HasMany $Stances
 * @property \App\Model\Table\VideosTable|\Cake\ORM\Association\HasMany $Videos
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
{

    public function sanitizeLatin($string) {
        $unsupported_characters = ['Ñ', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü',  'ä', 'ë', 'ï', 'ö', 'ü', ' '];
        $ucharacters_replace = ['n', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', '-'];
        $string = preg_replace("/[^\-a-zA-Z0-9.]/", "", $string);
        $string = iconv('UTF-8', 'ASCII//TRANSLIT',  $string);
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

        $this->setTable('projects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'cover_image' => [
				'filesystem' => [
                    'root' => FRONT_ROOT
                ],
				'path' => '{DS}img{DS}proyectos{DS}{microtime}',
                'nameCallback' => function(array $data, array $settings) {
                    $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $filename = pathinfo($data['name'], PATHINFO_FILENAME );
                    return $this->sanitizeLatin($filename) . '.' . $ext;
                },
                'fields' => [
                    'dir' => 'c_dir',
                    'size' => 'c_size',
                    'type' => 'c_type',
                ],
				'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {

					ini_set('memory_limit', '1024M');

                    $supported_image = ['gif', 'jpg', 'jpeg', 'png'];

                    $data['name'] = $this->sanitizeLatin($data['name']);

					$extension = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));

                    if (in_array($extension, $supported_image)) {

    					$tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $cover = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$grid = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $cover= tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $box = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$imagine = new \Imagine\Imagick\Imagine();

    					$image = $imagine->open($data['tmp_name']);

                		$sizes = $image->getSize();

                		$width = $sizes->getWidth();
                        $height = $sizes->getHeight();

                        $this->imageTransformer($cover, $image, 1920, 650);

                        $this->imageTransformer($box, $image, 320, 320);

                        $this->imageTransformer($tmp, $image);

    					return [
    						$data['tmp_name'] => $data['name'],
    						$cover => 'cover-' . $data['name'],
    						$box => 'box-' . $data['name'],
    						$tmp => 'thumb-' . $data['name'],
    					];

                    }

					return [ $data['tmp_name'] => $data['name'] ];
				},
            ],
            'image' => [
				'filesystem' => [
                    'root' => FRONT_ROOT
                ],
                'path' => '{DS}img{DS}proyectos{DS}{microtime}',
                'nameCallback' => function(array $data, array $settings) {
                    $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $filename = pathinfo($data['name'], PATHINFO_FILENAME );
                    return $this->sanitizeLatin($filename) . '.' . $ext;
                },
				'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {

					ini_set('memory_limit', '1024M');

                    $supported_image = ['gif', 'jpg', 'jpeg', 'png'];

                    $data['name'] = $this->sanitizeLatin($data['name']);

					$extension = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));

                    if (in_array($extension, $supported_image)) {

    					$tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$grid = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $cover= tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                        $box = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

    					$imagine = new \Imagine\Imagick\Imagine();

    					$image = $imagine->open($data['tmp_name']);

                		$sizes = $image->getSize();

                		$width = $sizes->getWidth();
                        $height = $sizes->getHeight();

                        $this->imageTransformer($grid, $image, 555, 300);

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

        $this->hasMany('PoliticiansProject', [
            'foreignKey' => 'project_id',
            'dependent' => true
        ]);
        $this->hasMany('PoliticiansStances', [
            'foreignKey' => 'project_id',
            'dependent' => true
        ]);
        $this->hasMany('Stances', [
            'foreignKey' => 'project_id',
            'dependent' => true
        ]);
        $this->hasMany('Videos', [
            'foreignKey' => 'project_id',
            'dependent' => true
        ]);
        $this->belongsToMany('Positions', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'position_id',
            'joinTable' => 'positions_project',
            'dependent' => true
        ]);
        $this->belongsToMany('Politicians', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'politician_id',
            'joinTable' => 'politicians_project',
            'dependent' => true
        ]);
    }

    public function beforeMarshal($event, $entity, $options)
    {

        if(array_key_exists('slug', $entity) && !empty($entity['slug'])) {
            $slug = $entity['slug'];
            $slug = explode("/", $slug);
            $slug = $slug[count($slug) - 1];
            $slug = $this->sanitizeLatin($slug);
            $entity['slug'] = $slug;
        }

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
            ->notEmpty('name', 'Debe ingresar el nombre del proyecto.')
            ->add(
                'name',
                ['unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Ya existe un proyecto con ese nombre.']
                ]
            );

        $validator
            ->scalar('text')
            ->allowEmptyString('text');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->notEmpty('slug', 'Debe ingresar la URL Interna del proyecto.')
            ->add(
                'slug',
                ['unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Ya existe un proyecto con esa URL Interna.']
                ]
            );

        $validator
            ->allowEmptyFile('image', 'Debe seleccionar una imagen para la tarjeta.', 'update');

        $validator
            ->allowEmptyFile('cover_image', 'Debe seleccionar una imagen de portada.', 'update');

        $validator
            ->scalar('primary_color')
            ->maxLength('primary_color', 6)
            ->allowEmptyString('primary_color');

        $validator
            ->scalar('secondary_color')
            ->maxLength('secondary_color', 6)
            ->allowEmptyString('secondary_color');

        return $validator;
    }
}

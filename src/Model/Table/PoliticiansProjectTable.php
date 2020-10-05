<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoliticiansProject Model
 *
 * @property \App\Model\Table\PoliticiansTable|\Cake\ORM\Association\BelongsTo $Politicians
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\PoliticiansProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\PoliticiansProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PoliticiansProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoliticiansProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoliticiansProject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoliticiansProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PoliticiansProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoliticiansProject findOrCreate($search, callable $callback = null, $options = [])
 */
class PoliticiansProjectTable extends Table
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

        $this->setTable('politicians_project');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Politicians', [
            'foreignKey' => 'politician_id'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id'
        ]);
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
            ->allowEmptyString('sort_position');

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
        $rules->add($rules->existsIn(['politician_id'], 'Politicians'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));

        return $rules;
    }
}

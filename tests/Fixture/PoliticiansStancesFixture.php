<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PoliticiansStancesFixture
 */
class PoliticiansStancesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'politician_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'project_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'stance_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ps_politician_id' => ['type' => 'index', 'columns' => ['politician_id'], 'length' => []],
            'ps_project_id' => ['type' => 'index', 'columns' => ['project_id'], 'length' => []],
            'ps_stance_id' => ['type' => 'index', 'columns' => ['stance_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'ps_politician_id' => ['type' => 'foreign', 'columns' => ['politician_id'], 'references' => ['politicians', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'ps_project_id' => ['type' => 'foreign', 'columns' => ['project_id'], 'references' => ['projects', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'ps_stance_id' => ['type' => 'foreign', 'columns' => ['stance_id'], 'references' => ['stances', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'politician_id' => 1,
                'project_id' => 1,
                'stance_id' => 1
            ],
        ];
        parent::init();
    }
}

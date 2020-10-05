<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PoliticiansStancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PoliticiansStancesTable Test Case
 */
class PoliticiansStancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PoliticiansStancesTable
     */
    public $PoliticiansStances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PoliticiansStances',
        'app.Politicians',
        'app.Projects',
        'app.Stances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PoliticiansStances') ? [] : ['className' => PoliticiansStancesTable::class];
        $this->PoliticiansStances = TableRegistry::getTableLocator()->get('PoliticiansStances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PoliticiansStances);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

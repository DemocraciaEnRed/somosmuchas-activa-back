<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StancesTable Test Case
 */
class StancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StancesTable
     */
    public $Stances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Stances',
        'app.Projects',
        'app.Tweets',
        'app.Politicians'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Stances') ? [] : ['className' => StancesTable::class];
        $this->Stances = TableRegistry::getTableLocator()->get('Stances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stances);

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

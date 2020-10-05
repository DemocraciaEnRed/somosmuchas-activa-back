<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartiesTable Test Case
 */
class PartiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartiesTable
     */
    public $Parties;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Parties',
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
        $config = TableRegistry::getTableLocator()->exists('Parties') ? [] : ['className' => PartiesTable::class];
        $this->Parties = TableRegistry::getTableLocator()->get('Parties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Parties);

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
}

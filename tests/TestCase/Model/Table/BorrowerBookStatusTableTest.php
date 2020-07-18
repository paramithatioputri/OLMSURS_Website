<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BorrowerBookStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BorrowerBookStatusTable Test Case
 */
class BorrowerBookStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BorrowerBookStatusTable
     */
    public $BorrowerBookStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BorrowerBookStatus',
        'app.Borrowers',
        'app.BookCopies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BorrowerBookStatus') ? [] : ['className' => BorrowerBookStatusTable::class];
        $this->BorrowerBookStatus = TableRegistry::getTableLocator()->get('BorrowerBookStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BorrowerBookStatus);

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

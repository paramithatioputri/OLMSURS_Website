<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookSharingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookSharingsTable Test Case
 */
class BookSharingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookSharingsTable
     */
    public $BookSharings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BookSharings',
        'app.Senders',
        'app.Receivers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BookSharings') ? [] : ['className' => BookSharingsTable::class];
        $this->BookSharings = TableRegistry::getTableLocator()->get('BookSharings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookSharings);

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

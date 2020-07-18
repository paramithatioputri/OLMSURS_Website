<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookCopiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookCopiesTable Test Case
 */
class BookCopiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookCopiesTable
     */
    public $BookCopies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('BookCopies') ? [] : ['className' => BookCopiesTable::class];
        $this->BookCopies = TableRegistry::getTableLocator()->get('BookCopies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookCopies);

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

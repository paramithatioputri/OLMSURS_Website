<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BorrowersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BorrowersTable Test Case
 */
class BorrowersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BorrowersTable
     */
    public $Borrowers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Borrowers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Borrowers') ? [] : ['className' => BorrowersTable::class];
        $this->Borrowers = TableRegistry::getTableLocator()->get('Borrowers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Borrowers);

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

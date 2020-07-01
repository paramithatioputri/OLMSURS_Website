<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LibrariansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LibrariansTable Test Case
 */
class LibrariansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LibrariansTable
     */
    public $Librarians;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Librarians',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Librarians') ? [] : ['className' => LibrariansTable::class];
        $this->Librarians = TableRegistry::getTableLocator()->get('Librarians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Librarians);

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

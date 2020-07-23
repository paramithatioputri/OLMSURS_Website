<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BorrowerBookRatingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BorrowerBookRatingTable Test Case
 */
class BorrowerBookRatingTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BorrowerBookRatingTable
     */
    public $BorrowerBookRating;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BorrowerBookRating',
        'app.Borrowers',
        'app.Books',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BorrowerBookRating') ? [] : ['className' => BorrowerBookRatingTable::class];
        $this->BorrowerBookRating = TableRegistry::getTableLocator()->get('BorrowerBookRating', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BorrowerBookRating);

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

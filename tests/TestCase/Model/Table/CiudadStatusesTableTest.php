<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CiudadStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CiudadStatusesTable Test Case
 */
class CiudadStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CiudadStatusesTable
     */
    public $CiudadStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ciudad_statuses',
        'app.ciudades'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CiudadStatuses') ? [] : ['className' => CiudadStatusesTable::class];
        $this->CiudadStatuses = TableRegistry::get('CiudadStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CiudadStatuses);

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

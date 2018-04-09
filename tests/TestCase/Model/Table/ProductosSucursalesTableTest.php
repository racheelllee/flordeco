<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductosSucursalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductosSucursalesTable Test Case
 */
class ProductosSucursalesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.productos_sucursales',
        'app.productos',
        'app.usuarios',
        'app.proveedores',
        'app.precios',
        'app.productos_proveedores',
        'app.users',
        'app.marcas',
        'app.cupones',
        'app.clientes',
        'app.municipios',
        'app.estados',
        'app.paises',
        'app.direcciones',
        'app.users_groups',
        'app.clienteestatuses',
        'app.pedidos',
        'app.sucursales',
        'app.formasdepagos',
        'app.estatuses',
        'app.partidas',
        'app.pedidos_comentarios',
        'app.categorias',
        'app.filtros',
        'app.opcionesfiltros',
        'app.opcionefiltros_productos',
        'app.categorias_productos',
        'app.cupones_categorias',
        'app.cupones_marcas',
        'app.productos_copy',
        'app.productos_estatuses',
        'app.atributos',
        'app.opciones',
        'app.imagenes',
        'app.preciocomeptencias',
        'app.promociones',
        'app.productos_promociones',
        'app.complementos_categorias',
        'app.fichas',
        'app.comentarios',
        'app.sucursals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProductosSucursales') ? [] : ['className' => 'App\Model\Table\ProductosSucursalesTable'];
        $this->ProductosSucursales = TableRegistry::get('ProductosSucursales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductosSucursales);

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

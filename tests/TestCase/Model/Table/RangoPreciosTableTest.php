<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RangoPreciosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RangoPreciosTable Test Case
 */
class RangoPreciosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RangoPreciosTable
     */
    public $RangoPrecios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rango_precios',
        'app.ciudades',
        'app.estados',
        'app.paises',
        'app.clientes',
        'app.municipios',
        'app.direcciones',
        'app.users_groups',
        'app.clienteestatuses',
        'app.cupones',
        'app.users',
        'app.categorias',
        'app.filtros',
        'app.opcionesfiltros',
        'app.opcionefiltros_productos',
        'app.productos',
        'app.usuarios',
        'app.proveedores',
        'app.precios',
        'app.productos_proveedores',
        'app.marcas',
        'app.productos_copy',
        'app.productos_estatuses',
        'app.sucursales',
        'app.atributos',
        'app.opciones',
        'app.imagenes',
        'app.preciocomeptencias',
        'app.categorias_productos',
        'app.promociones',
        'app.productos_promociones',
        'app.complementos_categorias',
        'app.fichas',
        'app.comentarios',
        'app.pedidos',
        'app.formasdepagos',
        'app.estatuses',
        'app.partidas',
        'app.pedidos_comentarios',
        'app.cupones_categorias',
        'app.cupones_marcas',
        'app.ciudad_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RangoPrecios') ? [] : ['className' => RangoPreciosTable::class];
        $this->RangoPrecios = TableRegistry::get('RangoPrecios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RangoPrecios);

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

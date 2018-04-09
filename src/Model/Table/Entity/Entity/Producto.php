<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producto Entity.
 */
class Producto extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'usuario_id' => true,
        'proveedor_id' => true,
        'sku' => true,
        'codigo_fabricante' => true,
        'nombre' => true,
        'nombre_grupo' => true,
        'frase_push' => true,
        'descripcion_corta' => true,
        'descripcion_larga' => true,
        'ficha_tecnica' => true,
        'marca_id' => true,
        'modelo' => true,
        'estatus_id' => true,
        'fecha_publicacion' => true,
        'url' => true,
        'meta_titulo' => true,
        'meta_descripcion' => true,
        'meta_keywords' => true,
        'envio' => true,
        'largo' => true,
        'ancho' => true,
        'alto' => true,
        'peso' => true,
        'peso_volumetrico' => true,
        'costo' => true,
        'margen' => true,
        'precio' => true,
        'envio_gratis' => true,
        'garantia' => true,
        'tiempo_de_entrega' => true,
        'usuario' => true,
        'proveedores' => true,
        'marca' => true,
        'atributos' => true,
        'cupones' => true,
        'imagenes' => true,
        'preciocomeptencias' => true,
        'precios' => true,
        'categorias' => true,
        'promociones' => true,
         'total_de_costos' => true,
         'existencia' => true,
         'modified' => true,
         'padre_id' => true,
        'sucursal_id' => true,
        'destacado' => true,
    ];
}
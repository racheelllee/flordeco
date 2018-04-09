<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Precio Entity.
 */
class Precio extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'proveedor_id' => true,
        'costo' => true,
        'margen' => true,
        'precio' => true,
        'activo' => true,
        'envio_gratis' => true,
        'existencia' => true,
        'usuario_id' => true,
        'producto' => true,
        'proveedor' => true,
        'usuario' => true,
        'created' => true,
        'modified' => true,
        'total_de_costos' => true
    ];
}

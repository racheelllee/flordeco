<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosProveedor Entity.
 */
class ProductosProveedor extends Entity
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
        'existencia' => true,
        'user_id' => true,
        'producto' => true,
        'proveedor' => true,
        'user' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosSucursale Entity.
 */
class ProductosSucursale extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'sucursal_id' => true,
        'estado_id' => true,
        'producto' => true,
        'sucursal' => true,
        'estado' => true,
    ];
}

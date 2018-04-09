<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpcionefiltrosProducto Entity.
 */
class OpcionefiltrosProducto extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'opcionesfiltro' => true,
        'producto' => true,
    ];
}

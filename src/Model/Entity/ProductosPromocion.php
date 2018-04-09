<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosPromocion Entity.
 */
class ProductosPromocion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'promocion_id' => true,
        'producto' => true,
        'promocion' => true,
    ];
}

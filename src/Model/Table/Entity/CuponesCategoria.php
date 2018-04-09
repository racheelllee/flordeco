<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CuponesCategoria Entity.
 */
class CuponesCategoria extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cupon_id' => true,
        'categoria_id' => true,
        'cupon' => true,
        'categoria' => true,
    ];
}

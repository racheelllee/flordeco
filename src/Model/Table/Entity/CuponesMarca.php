<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CuponesMarca Entity.
 */
class CuponesMarca extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cupon_id' => true,
        'marca_id' => true,
        'cupon' => true,
        'marca' => true,
    ];
}

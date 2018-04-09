<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ficha Entity.
 */
class Ficha extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'nombre' => true,
        'producto' => true,
        'orden' => true,
    ];
}

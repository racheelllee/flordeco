<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Marca Entity.
 */
class Marca extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'logo' => true,
        'productos' => true,
    ];
}

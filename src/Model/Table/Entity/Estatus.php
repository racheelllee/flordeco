<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Estatus Entity.
 */
class Estatus extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'pedidos' => true,
    ];
}

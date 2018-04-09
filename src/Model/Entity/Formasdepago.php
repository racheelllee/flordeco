<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Formasdepago Entity.
 */
class Formasdepago extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'descripcion' => true,
        'imagen' => true,
        'activo' => true,
        'pedidos' => true,
    ];
}

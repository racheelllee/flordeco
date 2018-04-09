<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mensaje Entity.
 */
class Mensaje extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'usuario_id' => true,
        'mensaje' => true,
        'envia' => true,
        'fecha' => true,
        'user' => true,
    ];
}

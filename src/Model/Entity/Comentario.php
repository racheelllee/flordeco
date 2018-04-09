<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comentario Entity.
 */
class Comentario extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'calificacion' => true,
        'user_id' => true,
        'comentarios' => true,
        'fecha' => true,
        'autorizado' => true,
        'producto' => true,
        'usuario' => true
    ];
}

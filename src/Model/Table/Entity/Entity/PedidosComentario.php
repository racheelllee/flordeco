<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PedidosComentario Entity.
 */
class PedidosComentario extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'pedido_id' => true,
        'usuario_id' => true,
        'mensaje' => true,
        'fecha' => true,
        'pedido' => true,
        'usuario' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PedidoCobroExtra Entity
 *
 * @property int $id
 * @property float $monto
 * @property string $comentario
 * @property string $no_tarjeta
 * @property string $respuesta_pago
 * @property string $nombre_completo
 * @property int $pedido_id
 * @property \Cake\I18n\Time $created
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Pedido $pedido
 * @property \App\Model\Entity\Usuario $usuario
 */
class PedidoCobroExtra extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Promocion Entity.
 */
class Promocion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'fecha_inicio' => true,
        'fecha_fin' => true,
        'monto' => true,
        'descuento' => true,
        'envio' => true,
        'usuario_id' => true,
        'usuario' => true,
        'productos' => true,
    ];
}

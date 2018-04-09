<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Preciocompetencia Entity.
 */
class Preciocompetencia extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'producto_id' => true,
        'competencia_id' => true,
        'precio' => true,
        'envio_gratis' => true,
        'usuario_id' => true,
        'producto' => true,
        'compentecia' => true,
        'usuario' => true,
    ];
}

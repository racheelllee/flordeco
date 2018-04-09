<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partida Entity.
 */
class Partida extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'pedido_id' => true,
        'cantidad' => true,
        'sku' => true,
        'codigo_fabricante' => true,
        'producto' => true,
        'atributos' => true,
        'precio' => true,
        'precio_real' => true,
        'pedido' => true,
        'mensaje_personalizado' => true,
        'producto_id' => true,
        'adicional' => true
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cupon Entity.
 */
class Cupon extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'codigo' => true,
        'cliente_id' => true,
        'monto' => true,
        'porcentaje' => true,
        'fecha_inicio' => true,
        'fecha_fin' => true,
        'categoria_id' => true,
        'marca_id' => true,
        'producto_id' => true,
        'cantidad' => true,
        'cliente' => true,
        'categoria' => true,
        'marca' => true,
        'producto' => true,
        'compra_minima' => true,
    ];
}

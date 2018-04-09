<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CiudadProductoFestivo Entity
 *
 * @property int $id
 * @property int $ciudad_id
 * @property int $producto_id
 * @property \Cake\I18n\Date $fecha
 *
 * @property \App\Model\Entity\Ciudad $ciudad
 * @property \App\Model\Entity\Producto $producto
 */
class CiudadProductoFestivo extends Entity
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

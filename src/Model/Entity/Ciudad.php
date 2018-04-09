<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ciudad Entity
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $estado_id
 * @property int $ciudad_status_id
 * @property int $rango_precio_id
 * @property int $costo_envio
 * @property string $descripcion
 * @property int $deleted
 *
 * @property \App\Model\Entity\Estado $estado
 * @property \App\Model\Entity\CiudadStatus $ciudad_status
 * @property \App\Model\Entity\RangoPrecio $rango_precio
 */
class Ciudad extends Entity
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

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CiudadHorarioEntregaPreciso Entity
 *
 * @property int $id
 * @property int $ciudad_horario_entrega_id
 * @property \Cake\I18n\Time $desde
 * @property \Cake\I18n\Time $hasta
 * @property float $costo_pesos
 * @property float $costo_dolar
 *
 * @property \App\Model\Entity\CiudadHorarioEntrega $ciudad_horario_entrega
 */
class CiudadHorarioEntregaPreciso extends Entity
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

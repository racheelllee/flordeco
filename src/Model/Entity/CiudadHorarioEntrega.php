<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CiudadHorarioEntrega Entity
 *
 * @property int $id
 * @property int $ciudad_id
 * @property string $titulo
 * @property string $descripcion
 * @property \Cake\I18n\Time $disponible_hasta
 * @property \Cake\I18n\Time $desde
 * @property \Cake\I18n\Time $hasta
 * @property float $costo_pesos
 * @property float $costo_dolar
 *
 * @property \App\Model\Entity\Ciudad $ciudad
 * @property \App\Model\Entity\CiudadHorarioEntregaPreciso[] $ciudad_horario_entrega_precisos
 */
class CiudadHorarioEntrega extends Entity
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

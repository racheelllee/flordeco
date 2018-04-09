<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CiudadFestivosSemana Entity
 *
 * @property int $id
 * @property int $ciudad_id
 * @property int $estado_id
 * @property bool $lun
 * @property bool $mar
 * @property bool $mie
 * @property bool $jue
 * @property bool $vie
 * @property bool $sab
 * @property bool $dom
 *
 * @property \App\Model\Entity\Ciudad $ciudad
 * @property \App\Model\Entity\Estado $estado
 */
class CiudadFestivosSemana extends Entity
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

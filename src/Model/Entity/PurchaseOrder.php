<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property float $monto
 * @property string $numero
 * @property int $cotizacion_id
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 * @property bool $deleted
 *
 * @property \App\Model\Entity\Cotizacion $cotizacion
 */
class PurchaseOrder extends Entity
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

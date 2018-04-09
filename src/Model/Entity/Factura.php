<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Factura Entity
 *
 * @property int $id
 * @property int $cotizacion_id
 * @property int $cargo_id
 * @property int $customer_id
 * @property string $no_factura
 * @property float $importe
 * @property string $archivo
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 * @property bool $deleted
 *
 * @property \App\Model\Entity\Cotizacion $cotizacion
 * @property \App\Model\Entity\Cargo $cargo
 * @property \App\Model\Entity\Customer $customer
 */
class Factura extends Entity
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

    public function _getMontoPesos() {
        return $this->moneda_id == 2 ? $this->importe * $this->tipo_cambio : $this->importe;
    }


}

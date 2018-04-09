<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * Cotizacione Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $contacto_cliente_id
 * @property int $categoria_cliente_id
 * @property int $vendedor_asignado_id
 * @property \Cake\I18n\Time $fecha_registro
 * @property int $sucursal_id
 * @property int $status_id
 * @property string $archivo
 * @property string $comentario
 * @property float $monta_total
 * @property string $modena
 * @property string $descuento
 * @property bool $iva
 * @property string $codiciones_pago
 * @property string $condiciones_entrega
 * @property string $tiempo_entrega
 * @property string $comentarios_generales
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $deleted
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\ContactoCliente $contacto_cliente
 * @property \App\Model\Entity\CategoriaCliente $categoria_cliente
 * @property \App\Model\Entity\VendedorAsignado $vendedor_asignado
 * @property \App\Model\Entity\Sucursal $sucursal
 * @property \App\Model\Entity\Status $status
 */
class Cotizacione extends Entity
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

        $monto = $this->_properties['monto_total'];

        if($this->_properties['moneda_id'] != 1){
            $monto = $this->_properties['monto_total'] * $this->_properties['tipo_cambio'];
        }

        return $monto;
    }

    public function _getPendingMxn(){
        /*
        $facturado = 0;
        if ($this->_properties['facturas']) {
            foreach ($this->_properties['facturas'] as $key => $factura) {
                if ($factura->moneda_id == 2) {
                    $facturado += $factura->importe * $factura->tipo_cambio;
                } else {
                    $facturado += $factura->importe;
                }
            }
        }
        return $this->_getMontoPesos() - $facturado;
        */
        return $this->vendido_cotizacion - $this->billed_mxn;
    }

    public function _getBilledMxn(){
        $facturado = 0;
        if ($this->facturas) {
            foreach ($this->facturas as $key => $factura) {
                $facturado += $factura->monto_pesos;
            }
        }
        return $facturado;
    }

    public function _getIndicadores(){

        $indicadores['pendiente'] = 0;
        $indicadores['facturado'] = 0;

        #if ($this->_properties['status_id'] == 7 || $this->_properties['status_id'] == 8) {
            if ($this->_properties['facturas']) {
                foreach ($this->_properties['facturas'] as $key => $factura) {
                    if ($factura->moneda_id == 2) {
                        $indicadores['facturado'] += $factura->importe * $factura->tipo_cambio;
                    } else {
                        $indicadores['facturado'] += $factura->importe;
                    }
                }
            }
            $indicadores['pendiente'] = $this->_properties['monto_total'] - $indicadores['facturado'];
            $indicadores['pendiente_mxn'] = $this->_properties['moneda_id'] == 2 ?
                                            $this->_getMontoPesos() - $indicadores['facturado']:
                                            $indicadores['pendiente'];
        #}

        return $indicadores;
    }

    public function _getBillingDatesFormatted(){
        $datesList = [];
        if (isset($this->_properties['billing_dates'])) {
            foreach ($this->_properties['billing_dates'] as $key => $billingDate) {
                if ( $billingDate->date > Time::now() ) {
                    $amount = number_format($billingDate->amount, 2);
                    $datesList[$key] = "<br><b>{$billingDate->date->format('d/m/Y')} &nbsp;</b> $ {$amount}";
                }
            }
#            $datesList
        }
        return implode(' ', $datesList) . '<br>';
    }

    public function _getBillingDatesFormattedPdf(){
        $datesList = [];
        if (isset($this->_properties['billing_dates'])) {
            foreach ($this->_properties['billing_dates'] as $key => $billingDate) {
                if ( $billingDate->date > Time::now() ) {
                    $amount = number_format($billingDate->amount, 2);
                    $datesList[$key] = $billingDate->date->format('d/m/Y') . " - $" . $amount;
                }
            }
        }
        return implode("\n", $datesList);
    }

    public function _getBillingDatesXls(){
        $datesList = [];
        if (isset($this->_properties['billing_dates'])) {
            foreach ($this->_properties['billing_dates'] as $key => $billingDate) {
                if ( $billingDate->date > Time::now() ) {
                    $amount = number_format($billingDate->amount, 2);
                    $datesList[$key] = $billingDate->date->format('d/m/Y') . ' - $' . $amount . "\n";
                }
            }
        }
        return implode('<br>', $datesList);
    }

    public function _getVendidoCotizacion(){
        $dolares = ($this->moneda_id == 2 && $this->tipo_cambio != 0);
        $vendido = $dolares ? $this->sold_quote * $this->tipo_cambio : $this->sold_quote;
        return $vendido;
    }

    public function _getSoldQuote(){
        $vendido = 0;
        if ($this->status_id == 8) {
            $vendido = $this->monto_total;
        } elseif ($this->status_id == 7) {
            if ($this->purchase_orders != NULL) {
                foreach ($this->purchase_orders as $key => $order) {
                    $vendido = $vendido + $order->monto;
                }
            }
        }
        return $vendido;
    }

    public function _getPurchaseOrdersFormatted(){
        $purchase_orders = '';
        if ($this->purchase_orders){
            foreach ($this->purchase_orders as $key => $order){
                $purchase_orders .= $order->numero . ' - ' . '$' . number_format($order->monto, 2) . "\n";
            }
        }
        return $purchase_orders;
    }

}

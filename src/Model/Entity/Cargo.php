<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Cargo Entity
 *
 * @property int $id
 * @property string $numero
 * @property int $cliente_id
 * @property string $descripcion
 * @property int $sucursal_id
 * @property int $supervisor_id
 * @property int $status_id
 * @property float $ingresos
 * @property float $costo_directo_material
 * @property float $costo_directo_obra
 * @property float $utilidad
 * @property float $rentabilidad
 * @property int $no_cotizaciones_asociadas
 * @property int $pendientes_facturacion
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Sucursal $sucursal
 * @property \App\Model\Entity\Supervisor $supervisor
 * @property \App\Model\Entity\Status $status
 */
class Cargo extends Entity
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

    public function _getIndicadores( $value ) {

        $indicadores = [];
        $indicadores['monto_total'] = 0;
        $indicadores['moneda'] = NULL;
        $indicadores['costo_directo_materiales'] = $this->_properties['costo_directo_material'];
        $indicadores['costo_indirecto_materiales'] = 0;
        $indicadores['costo_directo_obra'] = $this->_properties['costo_directo_obra'];
        $indicadores['costo_indirecto_obra'] = 0;

        $indicadores['cantidad_cotizaciones'] = count($this->_properties['cotizaciones']);
        $indicadores['cotizaciones_facturadas'] = 0;
        $indicadores['facturado_total'] = 0;
        $listaCotizaciones = [];
        $pendientesFacturacion = [];

        foreach ($this->_properties['cotizaciones'] as $cotizacion) {
            
            if ($cotizacion->status_id == 7 || $cotizacion->status_id == 8 ) {
                if($cotizacion->moneda_id == 1){
                    $indicadores['monto_total'] += $cotizacion->monto_total;
                    $indicadores['moneda'] = '<span>(MXN)</span>';
                }else{
                    $indicadores['monto_total'] += $cotizacion->monto_total * $cotizacion->tipo_cambio;
                    $indicadores['moneda'] = '<span>(USD)</span>';
                }
            }

            $listaCotizaciones[$cotizacion->numero_cotizacion] = $cotizacion->numero_cotizacion;

            #$indicadores['costo_directo_materiales'] = $cotizacion->costo_directo_materiales;
            $indicadores['costo_indirecto_materiales'] += $cotizacion->costo_indirecto_materiales;
            #$indicadores['costo_directo_obra'] = $cotizacion->costo_directo_obra;
            $indicadores['costo_indirecto_obra'] += $cotizacion->costo_indirecto_obra;

            if (count($cotizacion->facturas) > 0) {
                $indicadores['cotizaciones_facturadas'] += 1;
                $facturaImporte = 0;
                foreach ($cotizacion->facturas as $key => $factura) {
                    $importeFactura = 0;
                    if ($factura->moneda_id == 1) {
                        $importeFactura = $factura->importe;
                    } else {
                        $importeFactura = $factura->importe * $factura->tipo_cambio;
                    }
                    $indicadores['facturado_total'] += $importeFactura;
                    $facturaImporte += $importeFactura;
                }
                if ($facturaImporte < $cotizacion->monto_total) {
                    $pendientesFacturacion[$cotizacion->numero_cotizacion] = $cotizacion->numero_cotizacion;
                }
            } else {
                $pendientesFacturacion[$cotizacion->numero_cotizacion] = $cotizacion->numero_cotizacion;
            }

        }
    
        $indicadores['lista_cotizaciones'] = implode(', ', $listaCotizaciones);
        $indicadores['pendientes_facturacion'] = implode(', ', $pendientesFacturacion);

        $indicadores['utilidad'] = 
            $indicadores['facturado_total'] - 
                (
                    ($indicadores['costo_directo_materiales'] * ( ($indicadores['costo_indirecto_materiales'] / 100) + 1)) +
                    ($indicadores['costo_directo_obra'] * 1.10 ) * ( ($indicadores['costo_indirecto_obra'] / 100) + 1)
                );

        if ($indicadores['monto_total'] > 0) {
            if ($indicadores['facturado_total'] > 0) {
                $indicadores['rentabilidad'] = $indicadores['utilidad'] / $indicadores['facturado_total'];
            } else {
                $indicadores['rentabilidad'] = 0;
            }
        } else {
            $indicadores['rentabilidad'] = 0;
        }
        $indicadores['cotizaciones_pendientes_factura'] = $indicadores['cantidad_cotizaciones'] - $indicadores['cotizaciones_facturadas'];

        $indicadores['sinIndTotalGastos'] = $indicadores['costo_directo_materiales'] + $indicadores['costo_directo_obra'];

        $indicadores['sinIndUtilidadPerdida'] = $indicadores['facturado_total'] - $indicadores['sinIndTotalGastos'];

        $indicadores['conIndMateriales'] = (
            $indicadores['costo_directo_materiales'] * (1 + $indicadores['costo_directo_materiales']) );

        $indicadores['conIndOM'] = (
            $indicadores['costo_directo_obra'] * (1.1 * $indicadores['costo_directo_obra']) );

        $indicadores['conIndTotalGastos'] = $indicadores['conIndMateriales'] + $indicadores['conIndOM'];

        $indicadores['conIndUtilidadPerdida'] = $indicadores['facturado_total'] - $indicadores['conIndTotalGastos'];

        if( $indicadores['conIndUtilidadPerdida'] > 0 && $indicadores['facturado_total'] > 0 ){
            $indicadores['conIndRentabilidad'] = ($indicadores['conIndUtilidadPerdida'] / $indicadores['facturado_total']) * 100;
        }else {
            $indicadores['conIndRentabilidad'] = 0;
        }

        

        return $indicadores;
    }
}

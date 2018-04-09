<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Orm\TableRegistry;
use Cake\I18n\Time;

/**
 * GeneraPdfCotizaciones shell command.
 */
class GeneraPdfCotizacionesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() 
    {
        //ini_set('memory_limit', '640M');

        $this->out($this->OptionParser->help());

        $this->loadModel('ColaExportacion');

        $exportaciones = $this->ColaExportacion->find('all', [
            'conditions' => ['en_ejecucion' => 0],
        ]);

        include 'CustomPDF.php';

        foreach ($exportaciones as $key => $exportacion) {

            $exportacion->en_ejecucion = 1;

            $this->ColaExportacion->save($exportacion);

            $queryConditions = json_decode($exportacion->condiciones, true);
            $parametrosBusqueda = json_decode($exportacion->parametros, true);

            $total = 0;
            //$cotizaciones = $this->quotesWrapper($queryConditions, 5000, 1);

            $pdf = new \CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetMargins(5, 44, 5);
            $pdf->SetFooterMargin(10);

            if ($exportacion->tipo == 'cargos' || $exportacion->tipo == 'resumen_cargos') {
                $pdf->AddPage('L', 'A4');
            } else {
                $pdf->AddPage();
            }

            $titulos = [
                'cotizaciones' => 'Desglose de Cotizaciones',
                'facturas' => 'Desglose de Facturado',
                'ventas' => 'Desglose de Ventas',
                'cargos' => 'Resultado de Cargos',
                'en_proceso' => 'Cotizaciones en Proceso',
                'cargos_en_proceso' => 'Resumen de Trabajos en Proceso de Ejecución',
                'resumen_cargos' => 'Resumen de Cargos',
                '' => '',
            ];

            $titulo = $titulos[$exportacion->tipo];

            $now = Time::now();
            $now->timezone  = 'America/Mexico_City';
            $view = new \Cake\View\View(new \Cake\Network\Request, new \Cake\Network\Response);
            $pdf->writeHTML($view->element('Cotizaciones/titulo_filtros_pdf',compact('titulo', 'parametrosBusqueda', 'now')), true, false, true, false, '');

            if ($exportacion->tipo == 'cotizaciones') {
                $cotizaciones = $this->quotesWrapper($queryConditions, 5000, 1);
                $this->printQuotes($pdf, $cotizaciones);
            } elseif($exportacion->tipo == 'ventas'){
                $cotizaciones = $this->quotesWrapper($queryConditions, 5000, 1);
                $this->printSells($pdf, $cotizaciones);
            } elseif ($exportacion->tipo == 'cargos') {
                $cargos = $this->cargosWrapper($queryConditions, 5000, 1);
                $this->printCargos($pdf, $cargos);
            } elseif ($exportacion->tipo == 'resumen_cargos') {
                $resumen = $this->cargosWrapper($queryConditions, 5000, 1);
                $this->printResumenCargos($pdf, $resumen);
            } elseif ($exportacion->tipo == 'en_proceso') {
                $cotizaciones = $this->inProcessWrapper($queryConditions, 5000, 1);
                $this->printInProcess($pdf, $cotizaciones);
                $interactions = $this->interactionsWrapper($queryConditions, 5000, 1);
                $pdf->AddPage();
                $this->printInteractions($pdf, $interactions);
            } elseif ($exportacion->tipo == 'facturas') {
                $cotizaciones = $this->quotesWrapper($queryConditions, 5000, 1);
                $this->printBills($pdf, $cotizaciones);
            } elseif ($exportacion->tipo == 'cargos_en_proceso') {
                $cargos = $this->cargosEnProceso($queryConditions, 5000, 1);
                $this->imprimeCargosEnProceso($pdf, $cargos);
            }

            $file = 'files/cotizaciones/' . uniqid() . '.pdf';
            #$file = 'files/cotizaciones/TEST_PDF.pdf';
            $pdf->Output( WWW_ROOT . $file, 'F');


            $exportacion->terminado = 1;
            $exportacion->archivo = $file;
            $this->ColaExportacion->save($exportacion);
        }
    }

    public function rowHeight(&$pdf, &$data, &$widths = []){
        $heights = [];
        foreach ($data as $key => $cell) {
            $width = isset($widths[$key]) ? $widths[$key] : 30;
            $heights[] = $pdf->getNumLines($cell, $width);
        }
        return max($heights);
    }

    public function printRow(&$pdf, &$data, &$widths){
        $height = $this->rowHeight($pdf, $data, $widths);
        $height *= 2.5; # Line height
        foreach ($data as $key => $cell) {
            $width = isset($widths[$key]) ? $widths[$key] : 30;
            $pdf->MultiCell($width, $height, $cell, 1, 'c', 0, 0);
        }
        $pdf->Ln();
    }

    public function printTotal(&$pdf, &$total, &$widths){
        $width = array_sum($widths);
        $total = 'Total MXN: $' . number_format($total, 2);
        $pdf->MultiCell($width, 0, $total, 1, 'R', 0, 0);
        $pdf->Ln();
    }

    public function printQuotesTotal(&$pdf, &$total, &$widths){
        $pdf->SetFont('Helvetica','B',8);
        $pdf->SetTextColor(0,0,0);
        $width = array_sum($widths);
        $total = 'Total MXN: $' . number_format($total, 2);
        $pdf->MultiCell($width, 0, $total, 1, 'R', 0, 0);
        $pdf->Ln();
        $pdf->SetFont('Helvetica','',6);
    }

    public function printBalance(&$pdf, &$balanceTotal, $rentabilidadPromedio,&$widths){
        $width = array_sum($widths);
        $balanceTotal = 'Balance Total (MXN): $' . number_format($balanceTotal, 2);
        $pdf->MultiCell($width, 0, $balanceTotal, 1, 'R', 0, 0);
        $pdf->Ln();

        $rentabilidadPromedio = 'Rentabilidad Promedio: $' . number_format($rentabilidadPromedio, 2);
        $pdf->MultiCell($width, 0, $rentabilidadPromedio, 1, 'R', 0, 0);
        $pdf->Ln();
    }

    public function printQuotes(&$pdf, &$quotes){
        $pdf->SetFont('Helvetica','',6);
        $currencies = TableRegistry::get('Monedas')->find('list')->toArray() + ['' => '', 0 => ''];
        $widths = [
            10, # #
            25, # No. de COT
            20, # Descripción
            15, # Status
            25, # Orden de compra
            15, # Fecha de Venta
            25, # Cliente
            12, # Cargo
            15, # Importe
            15, # Moneda
            15, # Fecha Estimadas de Compra
        ];
        $header = [
            '#',
            'No. de COT',
            'Descripción',
            'Status',
            'Orden de compra',
            'Fecha de Venta',
            'Cliente',
            'Cargo',
            'Importe',
            'Moneda',
            'Fecha Estimadas de Compra',
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $total = 0;
        foreach ($quotes as $key => $quote) {
            $row = [
                $i++,
                $quote->numero_cotizacion,
                $quote->descripcion,
                $quote->has('cotizaciones_estatus') ? $quote->cotizaciones_estatus->nombre : '',
                $quote->purchase_orders_formatted,
                $quote->has('fecha_venta') ? $quote->fecha_venta->format('d/m/Y') : '',
                $quote->customer ? $quote->customer->title : '',
                $quote->cargo ? $quote->cargo->numero : '',
                '$' . number_format($quote->monto_total, 2),
                $currencies[$quote->moneda_id],
                $quote->fecha_estimada_compra ? $quote->fecha_estimada_compra->format('d/m/Y') : '',
            ];
            $total += $quote->monto_pesos;
            $this->printRow($pdf, $row, $widths);
            if ($pdf->getY() > 250) {
                $pdf->AddPage();
            }
        }
        $this->printTotal($pdf, $total, $widths);
    }

    public function printSells(&$pdf, &$quotes){
        $pdf->SetFont('Helvetica','',6);
        $currencies = TableRegistry::get('Monedas')->find('list')->toArray() + ['' => '', 0 => ''];

        $widths = [
            10, # #
            20, # No. De COT
            30, # Cliente
            35, # Descripción
            15, # No. De Cargo
            25, # Supervisor Responsable
            15, # Fecha de Asignación
            20, # Fecha estimada de cierre
            15, # Importe
            15, # Moneda
        ];

        $header = [
            '#',
            'No. De COT',
            'Cliente',
            'Descripción',
            'No. De Cargo',
            'Supervisor Responsable',
            'Fecha de Asignación',
            'Fecha estimada de cierre',
            'Importe',
            'Moneda',
        ];
        $this->printRow($pdf, $header, $widths);

        $i = 1;
        $total = 0;
        foreach ($quotes as $key => $quote) {

            $supervisor = '';

            if ( $quote->has('cargo') && $quote->cargo->has('user') ) {
                $supervisor .= $quote->cargo->user->first_name . ' ';
                $supervisor .= $quote->cargo->user->last_name  . ' ';
                $supervisor .= $quote->cargo->user->clast_name;
            }

            $row = [
                $i++,
                $quote->numero_cotizacion,
                $quote->has('customer') ? $quote->customer->title : '',
                $quote->descripcion,
                $quote->has('cargo') ? $quote->cargo->numero : '',
                $supervisor,
                $quote->has('fecha_registro') ? $quote->fecha_registro->format('d/m/Y') : '',
                $quote->has('fecha_venta') ? $quote->fecha_venta->format('d/m/Y') : '',
                '$' . number_format($quote->monto_total, 2),
                $currencies[$quote->moneda_id],
            ];

            $total += $quote->vendido_cotizacion;

            $this->printRow($pdf, $row, $widths);
            if ($pdf->getY() > 250) {
                $pdf->AddPage();
            }
        }
        $this->printTotal($pdf, $total, $widths);
    }

    public function printBills(&$pdf, &$quotes){
        $pdf->SetFont('Helvetica','',6);
        $currencies = TableRegistry::get('Monedas')->find('list')->toArray() + ['' => '', 0 => ''];
        $widths = [
            15, # #
            30, # No. de cotización
            40, # Descripción
            20, # Fecha de Factura
            20, # Número de Factura
            25, # Cliente
            20, # Status
            12, # Monto
            20, # Moneda
        ];
        $header = [
            '#',
            'No. de cotización',
            'Descripción',
            'Fecha de Factura',
            'Número de Factura',
            'Cliente',
            'Status',
            'Monto',
            'Moneda',
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $total = 0;
        foreach ($quotes as $cotQuot){
            foreach ($cotQuot->facturas as $key => $factura){
                $row = [
                    $i++,
                    $cotQuot->numero_cotizacion,
                    $cotQuot->descripcion,
                    $factura->created ? $factura->created->format('d/m/Y') : '',
                    $factura->no_factura,
                    $cotQuot->customer ? $cotQuot->customer->title : '',
                    $cotQuot->has('cotizaciones_estatus') ? $cotQuot->cotizaciones_estatus->nombre : '',
                    '$' . number_format($factura->importe, 2),
                    $currencies[$cotQuot->moneda_id],
                ];
                $total += $factura->monto_pesos;
                $this->printRow($pdf, $row, $widths);
                if ($pdf->getY() > 250) {
                    $pdf->AddPage();
                }
            }
        }
        $this->printTotal($pdf, $total, $widths);
    }

    public function printCargos(&$pdf, &$cargos){
        $pdf->SetFont('Helvetica','',6);
        $widths = [
            8,
            10,
            25,
            15,
            15,
            15,
            15,
            10,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
        ];
        $header = [ #19
            'No.',
            'No. de cargo',
            'Cliente',
            'Descripción',
            'Fecha de apertura',
            'Fecha Estimada de Cierre',
            'Sucursal',
            '(SI) Facturado (MXN)',
            '(SI) Materiales (MXN)',
            '(SI) M.O. (MXN)',
            '(SI) Total de Gatos (MXN)',
            '(SI) Utilidad / Perdida',
            '% Indirecto de Materiales',
            '% Indirecto de Mano de Obra',
            '(CI) Materiales (MXN)',
            '(CI) M.O. (MXN)',
            '(CI) Total de Gatos (MXN)',
            '(CI) Utilidad / Perdida',
            'Rentabilidad'
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $balanceTotal = 0;
        $rentabilidadPromedio = 0;

        foreach ($cargos as $cargo){
            $row = [
                $i++,
                $cargo->numero,
                $cargo->customer->title,
                $cargo->descripcion,
                $cargo->has('fecha_apertura') ? $cargo->fecha_apertura->format('d/m/Y') : '',
                $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('d/m/Y') : '',
                $cargo->office->name,
                '$'.number_format($cargo->indicadores['facturado_total'], 2),
                '$'.number_format($cargo->indicadores['costo_directo_materiales'],2),
                '$'.number_format($cargo->indicadores['costo_directo_obra'],2),
                '$'.number_format($cargo->indicadores['sinIndTotalGastos'],2),
                '$'.number_format($cargo->indicadores['sinIndUtilidadPerdida'],2),
                $cargo->indicadores['costo_indirecto_materiales'],
                $cargo->indicadores['costo_indirecto_obra'],
                '$'.number_format($cargo->indicadores['conIndMateriales'],2),
                '$'.number_format($cargo->indicadores['conIndOM'],2),
                '$'.number_format($cargo->indicadores['conIndTotalGastos'],2),
                '$'.number_format($cargo->indicadores['conIndUtilidadPerdida'],2),
                number_format($cargo->indicadores['conIndRentabilidad'],2).'%',
            ];
            $balanceTotal += $cargo->indicadores['conIndUtilidadPerdida'];
            $rentabilidadPromedio += $cargo->indicadores['conIndRentabilidad'];

            if( strtotime($cargo->fecha_estimada_cierre) > 0 ){
                
                $fecha = $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('Y-m-d') : '';
                $hoy = date('Y-m-d');

                $fecha1 = new \DateTime($fecha);
                $fecha2 = new \DateTime($hoy);

                if( $fecha1 < $fecha2 ){
                    $pdf->SetFillColor(255, 0, 0);
                    $pdf->SetTextColor(255, 0, 0);
                    $this->printRow($pdf, $row, $widths);
                } else {
                    $pdf->SetFillColor(0, 0, 0, 100);
                    $pdf->SetTextColor(0, 0, 0, 100);
                    $this->printRow($pdf, $row, $widths);
                } 
            } else {
                $pdf->SetFillColor(0, 0, 0, 100);
                $pdf->SetTextColor(0, 0, 0, 100);
                $this->printRow($pdf, $row, $widths);
            }

            if ($pdf->getY() > 175) {
                $pdf->AddPage('L', 'A4');
            }
        }
        $this->printBalance($pdf, $balanceTotal, $rentabilidadPromedio / $i, $widths);
    }

    public function printResumenCargos(&$pdf, &$cargos){
        $pdf->SetFont('Helvetica','',6);
        $widths = [
            20,
            30,
            65,
            65,
            50,
            50
        ];
        $header = [ #19
            'No.',
            'No. de cargo',
            'Cliente',
            'Descripción',
            'Fecha de apertura',
            'Fecha Estimada de Cierre'
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $balanceTotal = 0;
        $rentabilidadPromedio = 0;

        foreach ($cargos as $cargo){
            $row = [
                $i++,
                $cargo->numero,
                $cargo->customer->title,
                $cargo->descripcion,
                $cargo->has('fecha_apertura') ? $cargo->fecha_apertura->format('d/m/Y') : '',
                $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('d/m/Y') : ''
            ];
            $balanceTotal += $cargo->indicadores['conIndUtilidadPerdida'];
            $rentabilidadPromedio += $cargo->indicadores['conIndRentabilidad'];

            if( strtotime($cargo->fecha_estimada_cierre) > 0 ){
                
                $fecha = $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('Y-m-d') : '';
                $hoy = date('Y-m-d');

                $fecha1 = new \DateTime($fecha);
                $fecha2 = new \DateTime($hoy);

                if( $fecha1 < $fecha2 ){ 
                    $pdf->SetFillColor(255, 0, 0);
                    $pdf->SetTextColor(255, 0, 0);
                    $this->printRow($pdf, $row, $widths);
                } else { 
                    $pdf->SetFillColor(0, 0, 0, 100);
                    $pdf->SetTextColor(0, 0, 0, 100);
                    $this->printRow($pdf, $row, $widths);
                } 
            }else{
                $pdf->SetFillColor(0, 0, 0, 100);
                $pdf->SetTextColor(0, 0, 0, 100);
                $this->printRow($pdf, $row, $widths);
            }

            if ($pdf->getY() > 175) {
                $pdf->AddPage('L', 'A4');
            }
        }
    }

    public function printInProcess(&$pdf, &$quotes){
        
        $pdf->SetFont('Helvetica','',6);

        $depts = TableRegistry::get('CompanyDepartments')->find('list')->toArray() + ['' => '', 0 => ''];
        $currencies = TableRegistry::get('Monedas')->find('list')->toArray() + ['' => '', 0 => ''];

        $pdf->writeHTML('<h2 style="text-align:center;">En Proceso de Realización (estatus en proceso)</h2>');
        $pdf->ln(5);

        $widths = [
            10, # No.
            25, # No. De COT
            25, # Cliente
            20, # Breve Descripción de lo cotizado
            20, # Primer Vendedor
            20, # Segundo Vendedor
            18, # Departamento
            14, # Fecha de Solicitud
            14, # Fecha de entrega a cliente
            20, # Contacto Cliente
            14, # Fecha estimada de compra
        ];
        $header = [
            'No.',
            'No. De COT',
            'Cliente',
            'Breve Descripción de lo cotizado',
            'Primer Vendedor',
            'Segundo Vendedor',
            'Departamento',
            'Fecha de Solicitud',
            'Fecha de entrega a cliente',
            'Contacto Cliente',
            'Fecha estimada de compra',
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $total = 0;
        foreach ($quotes as $key => $quote) {

            if ($quote->status_id == 5) {

                $now = new Time();
                $now->setTimezone('UTC');
                $now->hour(0)->minute(0)->second(0);
                if ( $quote->has('fecha_entrega_cliente') && $quote->fecha_entrega_cliente < $now ) {
                    $pdf->SetTextColor(245,15,15);
                } else {
                    $pdf->SetTextColor(0,0,0);
                }

                $row = [
                    $i++,
                    $quote->numero_cotizacion,
                    $quote->customer ? $quote->customer->title : '',
                    $this->shortenText($quote->descripcion),
                    $quote->user ? $quote->user->first_name . ' ' . $quote->user->last_name . ' ' . $quote->user->clast_name : '',
                    $quote->second ? $quote->second->first_name . ' ' . $quote->second->last_name . ' ' . $quote->second->clast_name : '',
                    $quote->user ? $depts[$quote->user->company_department_id] : '',
                    $quote->has('fecha_solicitud') ? $quote->fecha_solicitud->format('d/m/Y') : '',
                    $quote->has('fecha_entrega_cliente') ? $quote->fecha_entrega_cliente->format('d/m/Y') : '',
                    $quote->contact ? $quote->contact->first_name . ' ' . $quote->contact->middle_name . ' ' . $quote->contact->last_name : '',
                    $quote->has('fecha_estimada_compra') ? $quote->fecha_estimada_compra->format('d/m/Y') : '',
                ];
                $total += $quote->monto_pesos;
                $this->printRow($pdf, $row, $widths);
                if ($pdf->getY() > 250) {
                    $pdf->AddPage();
                }
            }
        }

        $pdf->SetTextColor(0,0,0);

        $this->printQuotesTotal($pdf, $total, $widths);


        $pdf->AddPage();

        $pdf->writeHTML('<h2 style="text-align:center;">En Proceso de Aprobación (estatus enviada)</h2>');
        $pdf->ln(5);

        $widths = [
            10, # No.
            18, # No. De COT
            18, # Cliente
            17, # Breve Descripción de lo cotizado
            17, # Primer Vendedor
            17, # Segundo Vendedor
            14, # Departamento
            13, # Fecha de Solicitud
            13, # Fecha de entrega real
            12, # Cumplimiento
            14, # Importe
            10, # Moneda
            13, # Fecha estimada de compra
            12, # Observaciones
        ];
        $header = [
            'No.',
            'No. De COT',
            'Cliente',
            'Breve Descripción de lo cotizado',
            'Primer Vendedor',
            'Segundo Vendedor',
            'Departamento',
            'Fecha de Entrega a Cliente',
            'Fecha de entrega real',
            'Cumplimiento',
            'Importe',
            'Moneda',
            'Fecha estimada de compra',
            'Observaciones',
        ];
        $this->printRow($pdf, $header, $widths);

        $i = 1;
        $total = 0;
        foreach ($quotes as $key => $quote) {
            if ($quote->status_id == 6) {

                $cumplimiento = 'NO';

                if ($quote->has('fecha_entrega_cliente') && $quote->has('fecha_entrega_real')) {

                    $quote->fecha_entrega_cliente->second = 0;
                    $quote->fecha_entrega_cliente->minute = 0;
                    $quote->fecha_entrega_cliente->hour = 0;

                    $quote->fecha_entrega_real->second = 0;
                    $quote->fecha_entrega_real->minute = 0;
                    $quote->fecha_entrega_real->hour = 0;

                    if ($quote->fecha_entrega_cliente <= $quote->fecha_entrega_real) {
                        $cumplimiento = 'SI';
                    }

                }

                $row = [
                    $i++,
                    $quote->numero_cotizacion,
                    $quote->customer ? $quote->customer->title : '',
                    $this->shortenText($quote->descripcion),
                    $quote->user ? $quote->user->first_name . ' ' . $quote->user->last_name . ' ' . $quote->user->clast_name : '',
                    $quote->second ? $quote->second->first_name . ' ' . $quote->second->last_name . ' ' . $quote->second->clast_name : '',
                    $quote->user ? $depts[$quote->user->company_department_id] : '',
                    $quote->has('fecha_entrega_cliente') ? $quote->fecha_entrega_cliente->format('d/m/Y') : '',
                    $quote->has('fecha_entrega_real') ? $quote->fecha_entrega_real->format('d/m/Y') : '',
                    $cumplimiento,
                    '$' . number_format($quote->monto_total, 2),
                    $currencies[$quote->moneda_id],
                    $quote->has('fecha_estimada_compra') ? $quote->fecha_estimada_compra->format('d/m/Y') : '',
                    $this->shortenText($quote->descripcion, 50),
                ];
                $total += $quote->monto_pesos;
                $this->printRow($pdf, $row, $widths);
                if ($pdf->getY() > 250) {
                    $pdf->AddPage();
                }
            }
        }
        $this->printQuotesTotal($pdf, $total, $widths);
    }

    public function printInteractions(&$pdf, &$interactions){

        $pdf->writeHTML('<h2 style="text-align:center;">Interacciones abiertas</h2>');

        $pdf->ln(5);

        $widths = [
            20, # No.
            35, # Fecha
            35, # Cliente
            30, # Observaciones
            30, # Vendedor
            20, # Tipo de interacción
            30, # Marcas
        ];
        $header = [
            'No.',
            'Fecha',
            'Cliente',
            'Observaciones',
            'Vendedor',
            'Tipo de interacción',
            'Marcas',
        ];
        $this->printRow($pdf, $header, $widths);
        $i = 1;
        $total = 0;
        foreach ($interactions as $key => $interaction) {
            $row = [
                $i++,
                $interaction->created->format('d/m/Y'),
                $interaction->has('customer') ? $interaction->customer->title : '',
                $this->shortenText($interaction->comments, 50),
                $interaction->has('user') ? $interaction->user->first_name . ' ' . $interaction->user->last_name . ' ' . $interaction->user->clast_name : '',
                $interaction->interaction_type ? $interaction->interaction_type->name : '',
                $interaction->marcas,
            ];
            $this->printRow($pdf, $row, $widths);
            if ($pdf->getY() > 250) {
                $pdf->AddPage();
            }
        }
    }

    public function imprimeCargosEnProceso(&$pdf, &$cargos){

        $pdf->SetFont('Helvetica','B',6);
        $pdf->ln(5);

        $widths = [
            10, # No.
            10, #
            15, # No. De Cargo
            25, # No. De COT.
            25, # Cliente
            30, # Descripción
            22, # Supervisor Responsable
            22, # Fecha de apertura
            22, # Fecha estimada de cierre / terminación
            22, # Observaciones
        ];
        $header = [
            'No.',
            '',
            'No. De Cargo',
            'No. De COT.',
            'Cliente',
            'Descripción',
            'Supervisor Responsable',
            'Fecha de apertura',
            'Fecha estimada de cierre / terminación',
            'Observaciones',
        ];
        $this->printRow($pdf, $header, $widths);

        $i = 1;
        $total = 0;
        $now = Time::now();
        $now->setTimezone('UTC');
        $now->hour(0)->minute(0)->second(0);

        foreach ($cargos as $key => $cargo) {
            $pdf->SetFont('Helvetica','B',6);
            $pdf->SetTextColor(0,0,0);
            if ( $cargo->has('fecha_estimada_cierre') ){
                if ($cargo->fecha_estimada_cierre < $now){
                    $pdf->SetTextColor(245,15,15);
                }
            }

            $row = [
                $i++,
                '',
                $cargo->numero,
                '',
                $cargo->customer ? $cargo->customer->title : '',
                $cargo->descripcion,
                $cargo->has('user') ? $cargo->user->first_name . ' ' . $cargo->user->last_name . ' ' . $cargo->user->clast_name : '',
                $cargo->has('fecha_apertura') ? $cargo->fecha_apertura->format('d/m/Y') : '',
                $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('d/m/Y') : '',
                $cargo->observaciones,
            ];
            $this->printRow($pdf, $row, $widths);
            if ($pdf->getY() > 250) {
                $pdf->AddPage();
            }

            if ($cargo->cotizaciones) {
                $o = 0;
                $pdf->SetFont('Helvetica','',6);
                foreach ($cargo->cotizaciones as $key => $cotizacion) {
                    $row = [
                        '',
                        $i - 1 . $this->letterFromNumber($o++),
                        '',
                        $cotizacion->numero_cotizacion,
                        '',
                        $cotizacion->descripcion,
                        '',
                        '',
                        '',
                        '',
                    ];
                    $this->printRow($pdf, $row, $widths);
                    if ($pdf->getY() > 250) {
                        $pdf->AddPage();
                    }
                }
            }

        }
    }


    public function quotesWrapper($conditions){
        $this->loadModel('Cotizaciones');
        return $this->Cotizaciones->find('all', [
            #'limit' => 80,
            'conditions' => $conditions,
            'fields' => [
                'id',
                'cliente_id',
                'contacto_cliente_id',
                'vendedor_asignado_id',
                'fecha_registro',
                'sucursal_id',
                'status_id',
                'monto_total',
                'subtotal',
                'cantidad',
                'unidad',
                'moneda_id',
                'descuento',
                'total_iva',
                'total',
                'iva',
                'deleted',
                'descripcion',
                'tipo_cambio',
                'fecha_solicitud',
                'fecha_entrega_real',
                'fecha_entrega_cliente',
                'fecha_estimada_compra',
                'interaction_id',
                'from_interaction',
                'second_seller',
                'company_id',
                'cargo_id',
                'num_orden_compra',
                'numero_cotizacion',
                'fecha_venta',
                'parent',
                'last_version',
                'original',
                'comprado_total',
            ],
            'contain'   => [
                'Cargos' => [
                    'fields' => [
                        'numero',
                        'supervisor_id',
                    ],
                    'TiposObra',
                    'Users' => [
                        'fields' => [
                            'id',
                            'first_name',
                            'last_name',
                            'clast_name',
                        ],
                    ],
                ],
                'Monedas',
                'PurchaseOrders' => [
                    'fields' => [
                        'cotizacion_id',
                        'numero',
                        'monto',
                    ],
                ],
                'BillingDates' => [
                    'fields' => [
                        'date',
                        'amount',
                        'cotizacion_id',
                    ],
                ],
                'Facturas' => [
                    'fields' => [
                        'id',
                        'importe',
                        'created',
                        'moneda_id',
                        'no_factura',
                        'tipo_cambio',
                        'cotizacion_id',
                    ]
                ],
                'Customers' => [
                    'fields' => [
                        'id',
                        'title',
                        'customer_category_id',
                    ],
                    'CustomerCategories' => [
                        'fields' => [
                            'id',
                            'name',
                        ]
                    ],
                ],
                'Contacts' => [
                    'fields' => [
                        'id',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'email',
                        'office_id',
                    ],
                ],
                'Offices' => [
                    'fields' => [
                        'id',
                        'name',
                    ],
                ],
                'Users' => [
                    'fields' => [
                        'id',
                        'company_department_id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ]
                ],
                'CotizacionesEstatuses' => [
                    'fields' => [
                        'id',
                        'nombre',
                    ],
                ],
                'Second' => [
                    'fields' => [
                        'id',
                        'company_department_id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ]
                ],
                'Companies'
            ],
            'order' => ['Cotizaciones.id'=>'DESC'],
        ])/*->hydrate(false)*/->toArray();
    }

    public function cargosWrapper($conditions){
        $this->loadModel('Cargos');
        return $this->Cargos->find('all', [
            #'limit' => 80,
            'conditions' => $conditions,
            'fields' => [
                'id',
                'numero',
                'cliente_id',
                'company_id',
                'descripcion',
                'sucursal_id',
                'supervisor_id',
                'status_id',
                'costo_directo_material',
                'costo_directo_obra',
                'utilidad',
                'rentabilidad',
                'no_cotizaciones_asociadas',
                'pendientes_facturacion',
                'tipo_obra',
                'fecha_apertura',
                'fecha_estimada_cierre',
                'deleted',
            ],
            'contain'   => [
 
                'Customers' => [
                    'fields' => [
                        'id',
                        'title',
                        'customer_category_id',
                    ]
                ],
                'Offices' => [
                    'fields' => [
                        'id',
                        'name',
                    ],
                ],
                'Users' => [
                    'fields' => [
                        'id',
                        'company_department_id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ]
                ],
                'Companies',
                'CargosStatuses',
                'Cotizaciones.Facturas',
            ],
            'order' => ['Cargos.numero'=>'DESC'],
        ])->toArray();
    }


    public function inProcessWrapper($conditions){
        $this->loadModel('Cotizaciones');
        return $this->Cotizaciones->find('all', [
            'conditions' => $conditions,
            'fields' => [
                'id',
                'cliente_id',
                'contacto_cliente_id',
                'vendedor_asignado_id',
                'fecha_registro',
                'sucursal_id',
                'status_id',
                'monto_total',
                'subtotal',
                'cantidad',
                'unidad',
                'moneda_id',
                'descuento',
                'total_iva',
                'total',
                'iva',
                'deleted',
                'descripcion',
                'tipo_cambio',
                'fecha_solicitud',
                'fecha_entrega_real',
                'fecha_entrega_cliente',
                'fecha_estimada_compra',
                'interaction_id',
                'from_interaction',
                'second_seller',
                'company_id',
                'cargo_id',
                'num_orden_compra',
                'numero_cotizacion',
                'fecha_venta',
                'parent',
                'last_version',
                'original',
                'comprado_total',
            ],
            'contain'   => [
                'Monedas',
                'Customers' => [
                    'fields' => [
                        'id',
                        'title',
                    ],
                ],
                'Contacts' => [
                    'fields' => [
                        'id',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'email',
                        'office_id',
                    ],
                ],
                'Offices' => [
                    'fields' => [
                        'id',
                        'name',
                    ],
                ],
                'Users' => [
                    'fields' => [
                        'id',
                        'company_department_id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ],
                ],
                'CotizacionesEstatuses' => [
                    'fields' => [
                        'id',
                        'nombre',
                    ],
                ],
                'Second' => [
                    'fields' => [
                        'id',
                        'company_department_id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ]
                ],
                'Cargos' => [
                    'fields' => [
                        'numero',
                        'supervisor_id',
                    ],
                    'Users' => [
                        'fields' => [
                            'id',
                            'first_name',
                            'last_name',
                            'clast_name',
                        ]
                    ],
                ],
                'Companies',
            ],
            'order' => ['Cotizaciones.fecha_estimada_compra' => 'ASC'],
        ])->toArray();
    }


    public function interactionsWrapper($conditions){
        $this->loadModel('Interactions');
        $conditions = $this->stripConditions($conditions);
        return $this->Interactions->find('all', [
            'conditions' => $conditions,
            'fields' => [
                'id',
                'title',
                'user_id',
                'comments',
                'quote_id',
                'interaction_type_id',
                'customer_id',
                'start_date',
                'modified',
                'created',

            ],
            'contain'   => [
                'Customers' => [
                    'fields' => [
                        'id',
                        'title',
                        'office_id',
                    ],
                ],
                'InteractionStatuses' => [
                    'fields' => [
                        'id',
                        'name',
                    ]
                ],
                'Users' => [
                    'fields' => [
                        'id',
                        'first_name',
                        'last_name',
                        'clast_name',
                        'email',
                    ],
                ],
                'InteractionTypes' => [
                    'fields' => [
                        'id',
                        'name',
                    ]
                ],
                'InteraccionMarcas' => [
                    'Marcas' => [
                        'fields' => [
                            'id',
                            'nombre',
                        ]
                    ],
                ]
            ],
            'order' => ['Interactions.created' => 'DESC'],
        ])->toArray();
    }

    public function cargosEnProceso($conditions){
        $conditions['Cargos.deleted'] = false;
        $this->loadModel('Cargos');
        return $this->Cargos->find('all', [
            'conditions' => $conditions,
            'fields' => [
                'id',
                'numero',
                'cliente_id',
                'company_id',
                'descripcion',
                'sucursal_id',
                'supervisor_id',
                'status_id',
                'tipo_obra',
                'fecha_apertura',
                'fecha_estimada_cierre',
                'observaciones',
                'deleted',
            ],
            'contain'   => [ 
                'Cotizaciones',
                'Customers' => [
                    'fields' => [
                        'id',
                        'title',
                        'customer_category_id',
                    ]
                ],
                'Offices' => [
                    'fields' => [
                        'id',
                        'name',
                    ],
                ],
                'Users' => [
                    'fields' => [
                        'id',
                        'first_name',
                        'last_name',
                        'clast_name',
                    ]
                ],
                'Companies',
                'CargosStatuses',
                'Cotizaciones.Facturas',
            ],
            'order' => [
                'Cargos.fecha_apertura' => 'ASC',
                'Cargos.fecha_estimada_cierre' => 'DESC',
            ],
        ]);
    }

    public function stripConditions($conditions){

        $intConds = [];
        $intConds['Interactions.interaction_status_id'] = 1;

        if ( isset($conditions['Cotizaciones.fecha_entrega_cliente >=']) && $conditions['Cotizaciones.fecha_entrega_cliente >='] ){
            $intConds['Interactions.created >='] = $conditions['Cotizaciones.fecha_entrega_cliente >='];
        }
        if ( isset($conditions['Cotizaciones.fecha_entrega_cliente <=']) && $conditions['Cotizaciones.fecha_entrega_cliente <='] ){
            $intConds['Interactions.created <='] = $conditions['Cotizaciones.fecha_entrega_cliente <='];
        }

        if ( isset($conditions['Customers.title LIKE']) && $conditions['Customers.title LIKE'] ){
            $intConds['Customers.title LIKE'] = $conditions['Customers.title LIKE'];
        }

        if ( isset($conditions['Cotizaciones.vendedor_asignado_id']) && $conditions['Cotizaciones.vendedor_asignado_id'] ){
            $intConds['Interactions.user_id'] = $conditions['Cotizaciones.vendedor_asignado_id'];
        }

        if ( isset($conditions['Cotizaciones.sucursal_id']) && $conditions['Cotizaciones.sucursal_id'] ){
            $intConds['Customers.office_id LIKE'] = '%' . $conditions['Cotizaciones.sucursal_id'] . '%';
        }

        if ( isset($conditions['Users.company_department_id']) && $conditions['Users.company_department_id'] ){
            $intConds['company_department_id'] = $conditions['Users.company_department_id'];
        }

        return $intConds;
    }

    public function shortenText($text = '', $length = 80){
        $delimiter = '|||||';
        $text = wordwrap($text, $length, $delimiter, true);
        return strlen($text) > $length ? explode($delimiter, $text)[0] . '...' : $text;
    }

    public function letterFromNumber($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return $this->letterFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }

}

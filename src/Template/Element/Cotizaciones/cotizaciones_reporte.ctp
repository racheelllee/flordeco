<p style="text-align: right;">
    <button id="exportarCotizacionesXlsx" class="btn btn-default exportar botones" type="button">EXCEL</button>
    <button id="exportarCotizacionesPdf" type="button" class="btn btn-default exportar botones">PDF</button>
</p>
<table id="reportesCotizacionesTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?= $this->Paginator->sort('numero_cotizacion', __('No. Quote')); ?></th>
            <th scope="col" style="min-width:150px"><?= __('Descripción'); ?></th>
            <th scope="col" style="width:100px"><?= $this->Paginator->sort('status_id', __('Status')); ?></th>
            <th scope="col"><?= __('No. Orden de compra') ?></th>
            <th scope="col"><?= $this->Paginator->sort('fecha_venta', __('Fecha de venta')); ?></th>
            <th scope="col" style="min-width:150px"><?= $this->Paginator->sort('Customer.title', __('Customer')); ?></th>
            <th scope="col"><?= $this->Paginator->sort('Cargos.numero', __('Cargos')); ?></th>
            <th scope="col"><?= $this->Paginator->sort('monto_total', __('Monto')); ?></th>
            <th scope="col"><?= __('Coin'); ?></th>
            <th scope="col"><?= $this->Paginator->sort('fecha_estimada_compra', __('Fecha estimada de compra')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $totalMxn = 0 ?>
        <?php $counter = 1 ?>
        <?php $monedas = [1=>'MXN', 2 => 'USD'] ?>
        <?= $this->element('Cotizaciones/Loop/cotizaciones_reporte', compact('cotizaciones', 'totalMxn', 'counter', 'monedas')); ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
    <div class="col-lg-2"><b id="total-cotizado">$<?= number_format($totalMxn, 2) ?></b></div>
</div>
<script type="text/javascript">
    $('#exportarCotizacionesPdf').on('click', function(ev){
        //$('#exportar-reporte').val('cotizaciones_pdf');
        //$('#reporte-ventas-form').submit();
        exportaPdf('cotizaciones');
    });
    $('#exportarCotizacionesXlsx').on('click', function(ev){
        $('#exportar-reporte').val('cotizaciones_xlsx');
        $('#reporte-ventas-form').submit();
        $('#exportar-reporte').val('');
    });
</script>
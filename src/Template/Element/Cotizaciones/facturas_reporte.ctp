<p style="text-align: right;">
    <button id="exportarFacturasXlsx" class="btn btn-default exportar botones" type="button">EXCEL</button>
    <button id="exportarFacturasPdf" type="button" class="btn btn-default exportar botones">PDF</button>
</p>
<table id="reporteFacturasTable" class="pronosticosTable table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th><?= __('Número de cotización') ?></th>
            <th><?= __('Descripción') ?></th>
            <th><?= __('Fecha de Factura') ?></th>
            <th><?= __('Número de Factura') ?></th>
            <th><?= __('Cliente') ?></th>
            <th><?= __('Status') ?></th>
            <th><?= __('Monto') ?></th>
            <th><?= __('Moneda') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $ctr = 0; ?>
        <?php $counter = 1; ?>
        <?= $this->element('Cotizaciones/Loop/facturas_reporte', compact('counter', 'ctr')); ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>TOTAL MXN</b></div>
    <div class="col-lg-2"><b id="total-facturado">$ <?= number_format($ctr, 2) ?></b></div>
</div>
<script type="text/javascript">
    $('#exportarFacturasPdf').on('click', function(ev){
        //$('#exportar-reporte').val('facturacion_pdf');
        //$('#reporte-ventas-form').submit();
        exportaPdf('facturas');
    });
    $('#exportarFacturasXlsx').on('click', function(ev){
        $('#exportar-reporte').val('facturas_xlsx');
        $('#reporte-ventas-form').submit();
        $('#exportar-reporte').val('');
    });
</script>
<p style="text-align: right;">
    <button id="exportarVentasXlsx" class="btn btn-default exportar botones" type="button">EXCEL</button>
    <button id="exportarVentasPdf" type="button" class="btn btn-default exportar botones">PDF</button>
</p>
<table id="reportesVentasTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="min-width:150px"><?= __('No. De COT') ?></th>
            <th scope="col" style="min-width:150px"><?= __('Cliente') ?></th>
            <th scope="col" style="min-width:150px"><?= __('Descripción') ?></th>
            <th scope="col"><?= __('No. De Cargo') ?></th>
            <th scope="col"><?= __('Supervisor Responsable') ?></th>
            <th scope="col"><?= __('Fecha de Asignación') ?></th>
            <th scope="col"><?= __('Fecha estimada de cierre') ?></th>
            <th scope="col"><?= __('Importe') ?></th>
            <th scope="col"><?= __('Moneda') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 1 ?>
        <?php $totalMxn = 0 ?>
        <?= $this->element('Cotizaciones/Loop/ventas_reporte', compact('totalMxn', 'counter')) ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
    <div class="col-lg-2"><b id="total-vendido">$<?= number_format($totalMxn, 2) ?></b></div>
</div>
<script type="text/javascript">
    $('#exportarVentasPdf').on('click', function(ev){
        //$('#exportar-reporte').val('ventas_pdf');
        //$('#reporte-ventas-form').submit();
        exportaPdf('ventas');
    });
    $('#exportarVentasXlsx').on('click', function(ev){
        $('#exportar-reporte').val('ventas_xlsx');
        $('#reporte-ventas-form').submit();
        $('#exportar-reporte').val('');
    });
</script>
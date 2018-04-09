<style type="text/css">
    .basic{
        font-family: sans-serif;
        color: #333;
    }
    .filter{
        font-weight: bold;
    }
    .table{
        border-collapse: collapse;
        text-align: center;
        width: 100%;
    }
    .table th,
    .table td{
        border: 1px solid #333;
    }
</style>
<div class="basic" style="text-align: center;">
      <h1 style="font-weight: bold;"><?= __('Desglose de Cotizaciones') ?></h1>
</div>
<div class="basic main">
    <?php $i = 1; ?>
    <?php if ($parametrosBusqueda): ?>
        <?php foreach ($parametrosBusqueda as $parametro => $busqueda): ?>
            <span class="filter"><?= $parametro ?>: </span>
            <span class="filter-value"><?= $busqueda ?></span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <?php if ($i++ % 3 == 0): ?>
                <br>
            <?php endif ?>
        <?php endforeach ?>
        <br>
    <?php endif ?>
</div>
<br>
<?php $x = 1; ?>
<?php if (!empty($cotizaciones)): ?>
    <div class="basic">
        <table class="basic table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Número</th>
                    <th>No. de COT</th>
                    <th>Descripción</th>
                    <th>Status</th>
                    <th>Orden de compra</th>
                    <th>Fecha de Venta</th>
                    <th>Cliente</th>
                    <th>Cargo</th>
                    <th>Importe</th>
                    <th>Moneda</th>
                    <th>Fecha Estimadas de Compra</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cotizaciones as $key => $cot): ?>
                    <tr>
                        <td><?= $x++ ?></td>
                        <td><?= $cot->numero_cotizacion ?></td>
                        <td><?= $cot->descripcion ?></td>
                        <td><?= $cot->status->nombre ?></td>
                        <td><?= $cot->purchase_orders_formatted ?></td>
                        <td><?= $cot->has('fecha_venta') ? $cot->fecha_venta->format('d/m/Y') : '' ?></td>
                        <td><?= $cot->customer ? $cot->customer->title : '' ?></td>
                        <td><?= $cot->cargo ? $cot->cargo->numero : '' ?></td>
                        <td><?= $cot->monto_total ?></td>
                        <?php $total += $cot->monto_pesos; ?>
                        <td><?= $cot->moneda->name ?></td>
                        <td><?= $cot->fecha_estimada_compra ?></td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="7"></td>
                    <td colspan="2">MONTO TOTAL EN MXN</td>
                    <td colspan="2">$<?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>
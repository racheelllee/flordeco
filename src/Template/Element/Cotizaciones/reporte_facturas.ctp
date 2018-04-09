<style type="text/css">
    .basic{
        font-family: sans-serif;
        color: #333;
    }
    .table{
        border-collapse: collapse;
        width: 100%;
    }
    .table th, .table td{
        border: 1px solid #333;
        text-align: center;
    }
    .from-interaction{
        color:white;
        background-color: #79af5d;
    }
    .not-from-interaction{
        color:white;
        background-color: #4f8fc6;
    }
    span.filter{
        font-weight: bold;
    }
    span.filter-value{
    }
</style>
<div class="basic" style="text-align: center;">
      <h1 style="font-weight: bold;"><?= __('Desglose de Facturado') ?></h1>
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
<?php if (!empty($cotizaciones)): ?>
    <div class="basic main">
        <table class="basic table">
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
                <?php foreach ($cotizaciones as $cotQuot): ?>
                    <?php foreach ($cotQuot->facturas as $key => $factura): ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $cotQuot->numero_cotizacion ?></td>
                            <td><?= $this->Generic->shortenText($cotQuot->descripcion, 80) ?></td>
                            <td><?= $factura->created ? $factura->created->format('d/m/Y') : '' ?></td>
                            <td><?= $factura->no_factura ?></td>
                            <td><?= $cotQuot->customer ? $cotQuot->customer->title : '' ?></td>
                            <td><?= $cotQuot->has('cotizaciones_estatus') ? $cotQuot->cotizaciones_estatus->nombre : '' ?></td>
                            <td>$<?= number_format($factura->importe, 2) ?></td>
                            <?php $ctr += $factura->monto_pesos; ?>
                            <td><?= $cotQuot->moneda ? $cotQuot->moneda->name : '' ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="7" style="text-align: right;">IMPORTE TOTAL EN MXN &nbsp;</td>
                        <td colspan="1">$<?= number_format($ctr, 2) ?></td>
                        <td colspan="1"></td>
                    </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>
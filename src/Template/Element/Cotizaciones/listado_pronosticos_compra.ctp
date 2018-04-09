<table class="pronosticosCompra table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">
                <?= __('Número') ?>
            </th>
            <th scope="col" style="width: 100px;"><?= __('Fecha Estimada de compra') ?></th>
            <th scope="col" style="min-width: 120px;"><?= __('No. de COT') ?></th>
            <th scope="col"><?= __('Cargo') ?></th>
            <th scope="col"><?= __('Customer') ?></th>
            <th scope="col"><?= __('Descripción') ?></th>
            <th scope="col" style="max-width:40px;text-align: center;"><?= __('Status') ?></th>
            <th scope="col" style="max-width:40px;text-align: center;"><?= __('Importe') ?></th>
            <th scope="col" style="max-width:40px;text-align: center;"><?= __('Moneda') ?></th>
            <th scope="col" style="max-width:40px;text-align: center;"><?= __('T.C.') ?></th>
            <th scope="col" style="max-width:40px;text-align: center;"><?= __('Total MXN') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php $counter = 1; ?>
        <?php foreach ($quotes as $cotizacion): ?>
            <tr>
                <td><?= $counter ?></td> <!-- Número -->
                <td><?= $cotizacion->fecha_estimada_compra ? $cotizacion->fecha_estimada_compra->format('d/m/Y') : ''; ?></td> <!-- Fecha -->
                <td><?= $cotizacion->numero_cotizacion ?></td> <!-- No. de COT -->
                <td><?= $cotizacion->cargo ? $cotizacion->cargo->numero : '' ?></a></td> <!-- Cargo -->
                <td>
                    <a href="/customers/customers/view/<?= $cotizacion->customer->id; ?>">
                        <?= h($cotizacion->customer->title) ?>
                    </a>
                </td> <!-- Customer -->
                <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td> <!-- Description -->
                <td align="center">
                    <span class="btn btn-primary btn-xs" style="border: 0px;color:white;padding:4px;background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                        <?= $cotizacion->cotizaciones_estatus->nombre ?>
                    </span>
                </td> <!-- Status -->
                <td>$<?= number_format($cotizacion->monto_total, 2) ?></td> <!-- Importe -->
                <td><?= $cotizacion->moneda ? $cotizacion->moneda->name : '' ?></td> <!-- Moneda -->
                <td>  <?= number_format($cotizacion->tipo_cambio, 2) ?></td> <!-- Tipo de cambio -->
                <td>$<?= number_format($cotizacion->indicadores['pendiente_mxn'], 2) ?></td> <!-- Pendiente en pesos -->
                <?php $total += $cotizacion->indicadores['pendiente_mxn']; ?>
            </tr>
            <?php $counter++ ?>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
    <div class="col-lg-2"><b>$<?= number_format($total, 2) ?></b></div>
</div>

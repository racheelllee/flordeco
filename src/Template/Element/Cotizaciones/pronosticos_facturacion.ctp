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
      <h1 style="font-weight: bold;"><?= __('Pronóstico de Facturación') ?></h1>
</div>
<div class="basic main">
    <?php $i = 1; ?>
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
</div>
<br>
<?php if (!empty($billingDates)): ?>
    <div class="basic main">
        <table class="basic table">
            <thead>
                <tr>
                    <th style="width: 10%"><?= __('Número') ?></th>
                    <th style="width: 10%"><?= __('Fecha Estimada de Facturación') ?></th>
                    <th style="width: 10%"><?= __('Número de cotización') ?></th>
                    <th style="width: 10%"><?= __('Cargo') ?></th>
                    <th style="width: 10%"><?= __('Cliente') ?></th>
                    <th style="width: 10%"><?= __('Descripción') ?></th>
                    <th style="width: 10%"><?= __('Status') ?></th>
                    <th style="width: 13%"><?= __('Monto') ?></th>
                    <th style="width:  7%"><?= __('Moneda') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                <?php foreach ($billingDates as $date): ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= $date->date->format('d/m/Y') ?></td>
                        <td><?= $date->cotizacione->numero_cotizacion ?></td>
                        <td><?= $date->cotizacione->cargo ? $date->cotizacione->cargo->numero : '' ?></td>
                        <td><?= h($date->cotizacione->customer->title) ?></td>
                        <td>
                            <?= $this->Generic->shortenText($date->cotizacione->descripcion, 80) ?>
                        </td>
                        <td>
                            <span style="border: 0px;color:white;padding:4px;background-color: <?= $date->cotizacione->cotizaciones_estatus->color ?>">
                                &nbsp;<?= $date->cotizacione->cotizaciones_estatus->nombre ?>&nbsp;
                            </span>
                        </td>
                        <td>$ <?= number_format($date->amount, 2) ?></td>
                        <td><?= $date->cotizacione->moneda->name ?></td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                    <tr>
                        <td colspan="7" style="text-align: right;">IMPORTE TOTAL EN MXN &nbsp;</td>
                        <td colspan="1">$ <?= number_format($total, 2) ?></td>
                        <td colspan="1"></td>
                    </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>
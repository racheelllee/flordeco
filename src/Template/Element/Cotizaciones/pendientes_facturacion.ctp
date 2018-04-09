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
      <h1 style="font-weight: bold;"><?= __('Pendientes de Facturación') ?></h1>
</div>
<div class="basic" style="text-align: right;">
      <span class="filter">Fecha de emisión: </span>
        <span class="filter-value"><?= date('d/m/Y g:i a'); ?></span>
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
<?php if (!empty($data)): ?>
    <div class="basic">
        <table class="basic table">
            <thead>
                <tr>
                    <th><?= 'Número' ?></th>
                    <th><?= 'Fecha de Creación' ?></th>
                    <th><?= 'No. de COT' ?></th>
                    <th><?= 'Cargo' ?></th>
                    <th><?= 'Cliente' ?></th>
                    <th><?= 'Descripción' ?></th>
                    <th><?= 'Status' ?></th>
                    <th><?= 'Importe' ?></th>
                    <th><?= 'Moneda' ?></th>
                    <th><?= 'T.C.' ?></th>
                    <th><?= 'Total MXN' ?></th>
                    <th><?= 'Facturado MXN' ?></th>
                    <th><?= 'Saldo Pendiente MXN' ?></th>
                    <th><?= 'Fechas Estimadas de Facturación' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $dta): ?>
                    <tr>
                        <td><?= $dta['counter'] ?></td>
                        <td><?= $dta['created'] ?></td>
                        <td><?= $dta['numero_cotizacion'] ?></td>
                        <td><?= $dta['cargo'] ?></td>
                        <td><?= $dta['cliente'] ?></td>
                        <td><?= $dta['descripcion'] ?></td>
                        <td><?= $dta['estatuses_nombre'] ?></td>
                        <td><?= $dta['monto_total'] ?></td>
                        <td><?= $dta['moneda_id'] ?></td>
                        <td><?= $dta['tipo_cambio'] ?></td>
                        <td><?= $dta['total_pesos'] ?></td>
                        <td><?= $dta['facturado'] ?></td>
                        <td><?= $dta['pendiente'] ?></td>
                        <td><?= $dta['billing_dates_formatted'] ?></td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="10"></td>
                    <td colspan="3">IMPORTE TOTAL EN MXN</td>
                    <td colspan="1">$<?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>

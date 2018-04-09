<style type="text/css">
    .basic{
        font-family: sans-serif;
        color: #333;
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
    span.filter{
        font-weight: bold;
    }
</style>
<div class="basic" style="text-align: center;">
      <h1 style="font-weight: bold;"><?= __('Pronóstico de Venta') ?></h1>
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
                    <th style="width: 7%;text-align: center;"><?= 'Número' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Fecha Estimada de compra' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'No. de COT' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Cargo' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Customer' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Descripción' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Status' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Importe' ?></th>
                    <th style="width: 7%;text-align: center;"><?= 'Moneda' ?></th>
                    <th style="width: 4%;text-align: center;"><?= 'T.C.' ?></th>
                    <th style="width:10%;text-align: center;"><?= 'Total MXN' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $dta): ?>
                    <tr>
                        <td><?= $dta['counter'] ?></td>
                        <td><?= $dta['fecha_estimada_compra'] ?></td>
                        <td><?= $dta['numero_cotizacion'] ?></td>
                        <td><?= $dta['cargo'] ?></td>
                        <td><?= $dta['cliente'] ?></td>
                        <td><?= $dta['descripcion'] ?></td>
                        <td><?= $dta['estatuses_nombre'] ?></td>
                        <td><?= $dta['monto_total'] ?></td>
                        <td><?= $dta['moneda_id'] ?></td>
                        <td><?= $dta['tipo_cambio'] ?></td>
                        <td><?= $dta['pendiente_mxn'] ?></td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="7"></td>
                    <td colspan="3">IMPORTE TOTAL EN MXN</td>
                    <td colspan="1">$ <?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>
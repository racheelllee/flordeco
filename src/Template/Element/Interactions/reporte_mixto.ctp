<style type="text/css">
    .white{
        color: white;
    }
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
    h2{
        font-family: sans-serif;
    }
    .filter{
        font-weight: bold;
    }
</style>
<div class="basic" style="text-align: center;">
      <h2 style="font-weight: bold;"><?= __('Actividad Comercial de la marca') ?>: <?= $brand ?></h2>
</div>
<div class="basic">
    <?php $i = 1; ?>
    <?php foreach ($searchParams as $param => $value): ?>
        <span class="filter"><?= $param ?>: </span>
        <span class="filter-value"><?= $value ?></span>
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
<?php if (!empty($interacciones)): ?>
    <div class="basic" style="text-align: center;">
        <h2>Interacciones abiertas / sin cotización</h2>
    </div>
    <div class="basic">
        <table class="basic table">
            <thead>
                <tr>
                    <th><?= __('No.') ?></th>
                    <th><?= __('Customer') ?></th>
                    <th><?= __('Seller') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Fecha') ?></th>
                    <th><?= __('Comentario') ?></th>
                    <th><?= __('Estatus') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $o = 1; ?>
            <?php foreach ($interacciones as $interaccion): ?>
                <tr>
                    <td><?= $o++ ?></td>
                    <td><?= $interaccion->customer->title ?></td>
                    <td>
                        <?=
                            $interaccion->user ?
                            $interaccion->user->first_name . ' ' .
                            $interaccion->user->last_name  . ' ' .
                            $interaccion->user->clast_name : ' '
                        ?>
                    </td>
                    <td>
                        <?php if ($interaccion->interaction_type): ?>
                            <?= $interaccion->interaction_type->name ?>
                        <?php endif ?>
                    </td>
                    <td><?= $interaccion->start_date ? $interaccion->start_date->format('d/m/Y') : '' ?></td>
                    <td><?= $this->Generic->shortenText($interaccion->comments, 80) ?></td>
                    <td class="white">
                        <span class="cs-btn" style="background-color: <?= $interaccion->interaction_status->color ?>;">
                            <?= $interaccion->interaction_status ? $interaccion->interaction_status->name : '' ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <hr>
<?php endif ?>

<?php if (!empty($cotizacionesEnProceso)): ?>
    <div class="basic" style="text-align: center;">
        <h2>Cotizaciones en Proceso de Aprobación</h2>
    </div>
    <div class="basic">
        <table class="basic table">
            <thead>
                <tr>
                    <th><?= __('No.') ?></th>
                    <th><?= __('Customer') ?></th>
                    <th><?= __('Fecha Estimada de Compra') ?></th>
                    <th><?= __('No. de COT'); ?></th>
                    <th><?= __('Descripción') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Importe') ?></th>
                    <th><?= __('Moneda') ?></th>
                    <th><?= __('Contact') ?></th>
                    <th><?= __('Observaciones') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Seller') ?></th>
                    <th><?= __('Second Seller') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $o = 1; ?>
            <?php $total = 0; ?>
            <?php foreach ($cotizacionesEnProceso as $cotizacion): ?>
                <tr>
                    <td><?= $o++ ?></td>
                    <td><?= $cotizacion->customer->title ?></td>
                    <td><?= $this->Time->format($cotizacion->fecha_estimada_compra, 'dd/MM/YYYY') ?></td>
                    <td><?= $cotizacion->numero_cotizacion ?></td>
                    <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td>
                    <td class="white">
                        <span style="background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                            <?= $cotizacion->cotizaciones_estatus->nombre ?>
                        </span>
                    </td>
                    <td>$<?= number_format($cotizacion->monto_total, 2) ?></td>
                    <?php $total += $cotizacion->monto_pesos; ?>
                    <td><?= $cotizacion->moneda->name ?></td>
                    <td>
                        <?=
                            $cotizacion->contact ?
                            $cotizacion->contact->first_name  . ' ' . 
                            $cotizacion->contact->middle_name . ' ' .
                            $cotizacion->contact->last_name   : ' '
                        ?>
                    </td>
                    <td><?= $this->Generic->shortenText($cotizacion->comentarios_generales, 80) ?></td>
                    <td class="white">
                      <?php if ($cotizacion->from_interaction): ?>
                        <span style="border: 0px;background-color: #79af5d;">&nbsp;P&nbsp;</span>
                      <?php else: ?>
                        <span style="border: 0px;background-color: #4f8fc6;">&nbsp;D&nbsp;</span>
                      <?php endif ?>
                    </td>
                    <td>
                        <?=
                            $cotizacion->user ?
                            $cotizacion->user->first_name . ' ' .
                            $cotizacion->user->last_name  . ' ' .
                            $cotizacion->user->clast_name : ' '
                        ?>
                    </td>
                    <td>
                        <?=
                            $cotizacion->second ?
                            $cotizacion->second->first_name . ' ' .
                            $cotizacion->second->last_name  . ' ' .
                            $cotizacion->second->clast_name : ' '
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="8"></td>
                <td colspan="3">IMPORTE TOTAL EN MXN</td>
                <td colspan="2">$<?= number_format($total, 2) ?></td>
            </tr>
        </table>
    </div>
    <hr>
<?php endif ?>

<?php if (!empty($cotizacionesVendidas)): ?>
    <div class="basic" style="text-align: center;">
        <h2>Cotizaciones Vendidas</h2>
    </div>
    <div class="basic">
        <table class="basic table">
            <thead>
                <tr>
                    <th><?= __('No.') ?></th>
                    <th><?= __('Customer') ?></th>
                    <th><?= __('Fecha de Venta') ?></th>
                    <th><?= __('No. de COT'); ?></th>
                    <th><?= __('Descripción') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Importe') ?></th>
                    <th><?= __('Moneda') ?></th>
                    <th><?= __('Contact') ?></th>
                    <th><?= __('Observaciones') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Seller') ?></th>
                    <th><?= __('Second Seller') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $o = 1; ?>
            <?php $total = 0; ?>
            <?php foreach ($cotizacionesVendidas as $cotizacion): ?>
                <tr>
                    <td><?= $o++ ?></td>
                    <td><?= $cotizacion->customer->title ?></td>
                    <td><?= $this->Time->format($cotizacion->fecha_venta, 'dd/MM/YYYY') ?></td>
                    <td><?= $cotizacion->numero_cotizacion ?></td>
                    <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td>
                    <td class="white">
                        <span style="background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                            <?= $cotizacion->cotizaciones_estatus->nombre ?>
                        </span>
                    </td>
                    <td>$<?= number_format($cotizacion->monto_total, 2) ?></td>
                    <?php $total += $cotizacion->monto_pesos; ?>
                    <td><?= $cotizacion->moneda->name ?></td>
                    <td>
                        <?=
                            $cotizacion->contact ?
                            $cotizacion->contact->first_name  . ' ' . 
                            $cotizacion->contact->middle_name . ' ' .
                            $cotizacion->contact->last_name   : ' '
                        ?>
                    </td>
                    <td><?= $this->Generic->shortenText($cotizacion->comentarios_generales, 80) ?></td>
                    <td class="white">
                      <?php if ($cotizacion->from_interaction): ?>
                        <span style="border: 0px;background-color: #79af5d;">&nbsp;P&nbsp;</span>
                      <?php else: ?>
                        <span style="border: 0px;background-color: #4f8fc6;">&nbsp;D&nbsp;</span>
                      <?php endif ?>
                    </td>
                    <td>
                        <?=
                            $cotizacion->user ?
                            $cotizacion->user->first_name . ' ' .
                            $cotizacion->user->last_name  . ' ' .
                            $cotizacion->user->clast_name : ' '
                        ?>
                    </td>
                    <td>
                        <?=
                            $cotizacion->second ?
                            $cotizacion->second->first_name . ' ' .
                            $cotizacion->second->last_name  . ' ' .
                            $cotizacion->second->clast_name : ' '
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"></td>
                    <td colspan="3">IMPORTE TOTAL EN MXN</td>
                    <td colspan="2">$<?= number_format($total, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <hr>
<?php endif ?>

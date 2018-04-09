<table class="pronosticosTable table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th><?= __('Número') ?></th>
            <th>
                <?= $this->Paginator->sort('BillingDates.date', __('Fecha Estimada de Facturación')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cotizaciones.numero_cotizacion', __('Número de cotización')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cargos.numero', __('Cargo')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cotizaciones.cliente_id', __('Cliente')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cotizaciones.descripcion', __('Descripción')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cotizaciones.status_id', __('Status')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('BillingDates.amount', __('Monto')) ?>
            </th>
            <th>
                <?= $this->Paginator->sort('Cotizaciones.moneda_id', __('Moneda')) ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $ctr = 0; ?>
        <?php $counter = 1; ?>
        <?php foreach ($billingDates as $date): ?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $date->date->format('d/m/Y') ?></td>
                <td><?= $date->cotizacione->numero_cotizacion ?></td>
                <td><?= $date->cotizacione->cargo ? $date->cotizacione->cargo->numero : '' ?></td>
                <td>
                    <a href="/customers/customers/view/<?= $date->cotizacione->customer->id; ?>">
                        <?= h($date->cotizacione->customer->title) ?>
                    </a>
                </td>
                <td>
                    <?= $this->Generic->shortenText($date->cotizacione->descripcion, 80) ?>
                </td>
                <td align="center">
                    <span class="btn btn-primary btn-xs" style="border: 0px;color:white;padding:4px;background-color: <?= $date->cotizacione->cotizaciones_estatus->color ?>">
                        <?= $date->cotizacione->cotizaciones_estatus->nombre ?>
                    </span>
                </td>
                <td>$ <?= number_format($date->amount, 2) ?></td>
                <?php $ctr += $date->amount_mxn; ?>
                <td><?= $date->cotizacione->moneda->name ?></td>
            </tr>
            <?php $counter++ ?>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>TOTAL MXN</b></div>
    <div class="col-lg-2"><b>$ <?= number_format($ctr, 2) ?></b></div>
</div>
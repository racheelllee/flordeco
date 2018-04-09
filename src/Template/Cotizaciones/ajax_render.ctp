<div class="ibox-content" style="margin-top: 30px;">
    <table class="table table-striped table-bordered table-condensed table-hover" width="100%">
        <thead>
            <tr>
                <th style="width:300px;"><?= __('Vendedor'); ?></th>
                <th style="width:300px;"><?= __('Interacciones'); ?></th>
                <th style="width:300px;"><?= __('Cotizaciones Realizadas'); ?></th>
                <th style="width:300px;"><?= __('Monto (Cotizados)'); ?></th>
                <th style="width:300px;"><?= __('Ventas Realizadas'); ?></th>
                <th style="width:300px;"><?= __('Monto (Ventas)'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $k => $row): ?>
            <tr>
                <td><?= $k ?></td>
                <td><?= $row['interacciones'] ?></td>
                <td><?= $row['quote_realizadas'] ?></td>
                <td>$<?= number_format($row['total_realizadas'], 2) ?></td>
                <td><?= $row['quote_vendidas'] ?></td>
                <td>$<?= number_format($row['total_venta'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

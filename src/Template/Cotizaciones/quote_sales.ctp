<div class="ibox-content" style="margin-top: 30px;">
    <p style="font-size: 18px;">Ventas por Cliente</p>
    <table class="table table-striped table-bordered table-condensed table-hover" width="100%">
        <thead>
            <tr>
                <th style="width:300px;"><?= __('Ranking'); ?></th>
                <th style="width:300px;"><?= __('Cliente'); ?></th>
                <th style="width:300px;"><?= __('Cotizaciones Realizadas'); ?></th>
                <th style="width:300px;"><?= __('Monto (Cotizados)'); ?></th>
                <th style="width:300px;"><?= __('Ventas Realizadas'); ?></th>
                <th style="width:300px;"><?= __('Monto (Ventas)'); ?></th>
                <th style="width:300px"><?= __('% de Contribución'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = count($clientes); ?>
            <?php $o = 1; ?>
            <?php foreach ($clientes as $k => $row): ?>
                <tr>
                    <td><?= $o ?></td>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['quote_realizadas'] ?></td>
                    <td>$<?= number_format($row['total_realizadas'], 2) ?></td>
                    <td><?= $row['quote_vendidas'] ?></td>
                    <td>$<?= number_format($row['total_venta'], 2) ?></td>
                    <td><?= number_format($row['contribucion'], 2) ?> %</td>
                </tr>
                <?php $i--; ?>
                <?php $o++; ?>
                <?php if ($o > 30) break; ?> 
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

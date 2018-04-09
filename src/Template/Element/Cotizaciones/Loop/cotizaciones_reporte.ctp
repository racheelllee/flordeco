<?php if (isset($cotizaciones)): ?>
    <?php foreach ($cotizaciones as $cotizacion): ?>
        <tr>
            <td><?= $counter++ ?></td>
            <td style="word-break: break-word;"><?= $cotizacion->numero_cotizacion ?></td>
            <td><?= $cotizacion->descripcion ?></td>
            <td>
                <label class="btn btn-primary btn-xs" style="border: 0px;color:white;padding:4px;background-color: <?= $cotizacion->cotizaciones_estatus->color ?>;"></label>
                    <?= $cotizacion->cotizaciones_estatus->nombre ?>
            </td>
            <td>
                <?php if ($cotizacion->purchase_orders): ?>
                    <?php foreach ($cotizacion->purchase_orders as $key => $order): ?>
                        <?= $order->numero ?> - $<?= number_format($order->monto_total, 2) ?>
                        <br>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
            <td><?= $cotizacion->has('fecha_venta') ? $cotizacion->fecha_venta->format('d/m/Y') : '' ?></td> 
            <td><?= h($cotizacion->customer->title) ?></td>
            <td><?= $cotizacion->has('cargo') ? $cotizacion->cargo->numero : '' ?></td> 
            <td>$<?= number_format($cotizacion->monto_total, 2) ?></td>
            <?php if (isset($totalMxn)): ?>
                <?php $totalMxn += $cotizacion->monto_pesos ?>
            <?php endif ?>
            <td>
                <?php if ($cotizacion->moneda_id): ?>
                    <?= $monedas[$cotizacion->moneda_id] ?>
                <?php endif ?>
            </td>
            <td>
                <?= $cotizacion->has('fecha_estimada_compra') ? $cotizacion->fecha_estimada_compra->format('d/m/Y') : '' ?>
                <script type="text/javascript">
                    window.totalCotizado += <?= $cotizacion->monto_pesos ?>;
                </script>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif ?>
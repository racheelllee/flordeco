<?php if (isset($cotizaciones)): ?>
    <?php foreach ($cotizaciones as $cotizacion): ?>
        <tr>
            <td><?= $counter++ ?></td>
            <td><?= $cotizacion->numero_cotizacion ?></td>
            <td><?= $cotizacion->has('customer') ? $cotizacion->customer->title : '' ?></td>
            <td><?= $cotizacion->descripcion ?></td>
            <td><?= $cotizacion->has('cargo') ? $cotizacion->cargo->numero : '' ?></td>
            <td>
                <?php if ( $cotizacion->has('cargo') && $cotizacion->cargo->has('user') ): ?>
                    <?=
                        $cotizacion->cargo->user->first_name . ' ' .
                        $cotizacion->cargo->user->last_name  . ' ' .
                        $cotizacion->cargo->user->clast_name
                    ?>
                <?php endif ?>
            </td>
            <td><?= $cotizacion->has('fecha_registro') ? $cotizacion->fecha_registro->format('d/m/Y') : '' ?></td> 
            <td><?= $cotizacion->has('fecha_venta') ? $cotizacion->fecha_venta->format('d/m/Y') : '' ?></td> 
            <td>$<?= number_format($cotizacion->monto_total, 2) ?></td>
            <td>
                <?= $monedas[$cotizacion->moneda_id] ?>
                <script type="text/javascript">
                    window.totalVendido += <?= $cotizacion->vendido_cotizacion ?>;
                </script>
            </td>
            <?php $totalMxn += $cotizacion->vendido_cotizacion ?>
        </tr>
    <?php endforeach; ?>
<?php endif ?>
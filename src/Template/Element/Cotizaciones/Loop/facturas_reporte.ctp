<?php if (isset($cotizaciones)): ?>
    <?php foreach ($cotizaciones as $cotQuot): ?>
        <?php foreach ($cotQuot->facturas as $key => $factura): ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td><?= $cotQuot->numero_cotizacion ?></td>
                <td><?= $this->Generic->shortenText($cotQuot->descripcion, 80) ?></td>
                <td><?= $factura->created ? $factura->created->format('d/m/Y') : '' ?></td>
                <td><?= $factura->no_factura ?></td>
                <td><?= $clientes[$cotQuot->cliente_id] ?></td>
                <td><?= $cotQuot->has('cotizaciones_estatus') ? $cotQuot->cotizaciones_estatus->nombre : '' ?></td>
                <td>$<?= number_format($factura->importe, 2) ?></td>
                <td>
                    <?= $monedas[$cotQuot->moneda_id] ?>
                    <script type="text/javascript">
                        window.totalFacturado += <?= $factura->monto_pesos ?>;
                        window.billsCount++;
                    </script>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endforeach; ?>
<?php endif ?>
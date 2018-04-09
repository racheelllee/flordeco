<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Facturas de la Cot. <?= sprintf('%06d', $cotizacion->id); ?></h4>
        <br><br>
        <div class="row">
           <table class="table" style="margin-left:10%; width:80%;">
                <thead>
                    <tr>
                        <th scope="col"><?= __('No.') ?></th>
                        <th scope="col"><?= __('Fecha') ?></th>
                        <th scope="col"><?= __('Monto') ?></th>
                        <th scope="col"><?= __('Moneda') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cotizacion->facturas as $factura): ?>
                        <tr>
                            <td><?= $factura->no_factura ?></td>
                            <td><?= $factura->created->format('d/m/Y') ?></td>
                            <td>$<?= number_format($factura->importe, 2) ?></td>
                            <td><?= $factura->moneda->name ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br>
        <p style="text-align: center;margin: 0;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </p>   
</div>
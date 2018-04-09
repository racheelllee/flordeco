<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cotizaciones de Cargo <?= $cargo->numero; ?></h4>
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
                    <?php foreach ($cargo->cotizaciones as $cotizacion) { ?>
                    <tr>
                        <td><?= $cotizacion->numero_cotizacion ?></td>
                        <td><?= $cotizacion->created->format('d/m/Y') ?></td>
                        <td>$<?= number_format($cotizacion->monto_total, 2) ?></td>
                        <td><?= $cotizacion->moneda->name ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <br>
        <p style="text-align: center;margin: 0;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </p>   
</div>
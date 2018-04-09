<style type="text/css">
    .basic{
        font-family: sans-serif;
        color: #333;
    }
    .table{
        border-collapse: collapse;
        width: 100%;
    }
    .table th, .table td{
        border: 1px solid #333;
        text-align: center;
    }
    .from-interaction{
        color:white;
        background-color: #79af5d;
    }
    .not-from-interaction{
        color:white;
        background-color: #4f8fc6;
    }
    span.filter{
        font-weight: bold;
    }
    span.filter-value{
    }
</style>
<?php if (!empty($cotizaciones)): ?>
    <div class="basic main">
        <?php if ($marcaFiltro || $vendedor || $cliente || $desde || $hasta): ?>
            <br>
        <?php endif ?>
        <?php if ($marcaFiltro): ?>
            <span class="filter">Cotizaciones relacionadas con la marca: </span>
            <span class="filter-value"><?= $marcaFiltro ?></span>
            <br>
        <?php endif; ?>
        <?php if ($vendedor): ?>
            <span class="filter">Vendedor:</span>
            <span class="filter-value"> <?= $vendedor ?>&nbsp; &nbsp;</span>
        <?php endif; ?>
        <?php if ($cliente): ?>
            <span class="filter">Cliente:</span>
            <span class="filter-value"> <?= $cliente ?>&nbsp; &nbsp;</span>
            <br>
        <?php endif; ?>
        <?php if ($desde): ?>
            <span class="filter">Desde:</span>
            <span class="filter-value"> <?= $this->Time->format($desde, 'd/M/Y') ?>&nbsp; &nbsp;</span>
        <?php endif; ?>
        <?php if ($hasta): ?>
            <span class="filter">Hasta:</span>
            <span class="filter-value"> <?= $this->Time->format($hasta, 'd/M/Y') ?>&nbsp; &nbsp;</span>
        <?php endif; ?>
        <?php if ($marcaFiltro || $vendedor || $cliente || $desde || $hasta): ?>
            <br>
            <br>
        <?php endif ?>
    </div>
    <div class="basic main">
        <table class="basic table">
            <thead>
                <tr>
                    <th style="width: 24%;"><?= __('Customer') ?></th>
                    <th style="width: 11%;"><?= __('Fecha') ?></th>
                    <th style="width: 14%;"><?= __('No. de COT'); ?></th>
                    <th style="width: 18%;"><?= __('Descripción') ?></th>
                    <th style="width: 12%;"><?= __('Status') ?></th>
                    <th style="width: 10%;"><?= __('Importe') ?></th>
                    <th style="width:  8%;"><?= __('Moneda') ?></th>
                    <th style="width: 18%;"><?= __('Contact') ?></th>
                    <th style="width: 20%;"><?= __('Observaciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cotizaciones as $key => $cotizacion): ?>
                    <tr>
                        <td><?= $cotizacion->customer ? $cotizacion->customer->title : '' ?></td>
                        <td><?= $this->Time->format($cotizacion->fecha_registro, 'dd/MM/YYYY') ?></td> <!-- Fecha -->
                        <td>
                            <span style="font-size: 10px;">
                                <?= $cotizacion->numero_cotizacion ?>
                            </span>
                        </td>
                        <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td>
                        <td>
                            <span style="border: 0px;color:white;padding:4px;background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                                &nbsp;<?= $cotizacion->cotizaciones_estatus->nombre ?>&nbsp;
                            </span>
                        </td>
                        <td>$ <?= number_format($cotizacion->monto_total, 2) ?></td>
                        <td><?= $cotizacion->moneda->name ?></td>
                        <td>
                            <?= 
                                $cotizacion->contact ? 
                                h(
                                    $cotizacion->contact->first_name . ' ' . 
                                    $cotizacion->contact->middle_name . ' ' .
                                    $cotizacion->contact->last_name
                                ) : ''
                            ?>
                        </td>
                        <td><?= $cotizacion->comentarios_generales ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>
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
<?php if (!empty($interacciones)): ?>
    <div class="basic main">
        <?php if ($marcaFiltro || $vendedor || $cliente || $desde || $hasta): ?>
            <br>
        <?php endif ?>
        <?php if ($marcaFiltro): ?>
            <span class="filter">Interacciones relacionadas con la marca: </span>
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
                    <th><?= __('Customer') ?></th>
                    <th><?= __('Seller') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Fecha') ?></th>
                    <th><?= __('Comentario') ?></th>
                    <th style="text-align: center;"><?= __('Estatus') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($interacciones as $key => $interaccion): ?>
                    <tr>
                        <td><?= $interaccion->customer->title ?></td>
                        <td>
                            <?= 
                                $interaccion->user ? 
                                h(
                                    $interaccion->user->first_name . ' ' . 
                                    $interaccion->user->last_name . ' ' . 
                                    $interaccion->user->clast_name
                                ) : '' 
                            ?>
                        </td>
                        <td><?= $interaccion->interaction_type ? $interaccion->interaction_type->name : '' ?></td>
                        <td><?= $this->Time->format($interaccion->start_date, 'dd/MM/YYYY') ?></td>
                        <td><?= $this->Generic->shortenText($interaccion->comments, 80) ?></td>
                        <td style="text-align: center;">
                            <span style="padding:5px;color: white;background-color: <?= $interaccion->interaction_status->color ?>;">
                                &nbsp;<?= $interaccion->interaction_status ? $interaccion->interaction_status->name : '' ?>&nbsp;
                            </span>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>
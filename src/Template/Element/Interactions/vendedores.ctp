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
</style>
<?php if (!empty($interacciones)): ?>
    <div class="basic main">
        <table class="basic table">
            <thead>
                <tr>
                    <th><?= __('Seller') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Fecha') ?></th>
                    <th><?= __('Customer') ?></th>
                    <th><?= __('Comentario') ?></th>
                    <th><?= __('Estatus') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($interacciones as $key => $interaccion): ?>
                    <tr>
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
                        <td><?= $interaccion->customer->title ?></td>
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
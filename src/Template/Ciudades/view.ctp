<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ciudad'), ['action' => 'edit', $ciudad->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ciudad'), ['action' => 'delete', $ciudad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ciudad->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ciudades'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ciudad'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ciudad Statuses'), ['controller' => 'CiudadStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ciudad Status'), ['controller' => 'CiudadStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rango Precios'), ['controller' => 'RangoPrecios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rango Precio'), ['controller' => 'RangoPrecios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ciudades view large-9 medium-8 columns content">
    <h3><?= h($ciudad->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($ciudad->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $ciudad->has('estado') ? $this->Html->link($ciudad->estado->nombre, ['controller' => 'Estados', 'action' => 'view', $ciudad->estado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ciudad Status') ?></th>
            <td><?= $ciudad->has('ciudad_status') ? $this->Html->link($ciudad->ciudad_status->id, ['controller' => 'CiudadStatuses', 'action' => 'view', $ciudad->ciudad_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rango Precio') ?></th>
            <td><?= $ciudad->has('rango_precio') ? $this->Html->link($ciudad->rango_precio->id, ['controller' => 'RangoPrecios', 'action' => 'view', $ciudad->rango_precio->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($ciudad->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ciudad->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Envio') ?></th>
            <td><?= $this->Number->format($ciudad->costo_envio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($ciudad->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripcion') ?></h4>
        <?= $this->Text->autoParagraph(h($ciudad->descripcion)); ?>
    </div>
</div>

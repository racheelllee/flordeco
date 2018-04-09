<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sucursale'), ['action' => 'edit', $sucursale->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sucursale'), ['action' => 'delete', $sucursale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sucursale->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sucursales'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sucursale'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Municipios'), ['controller' => 'Municipios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Municipio'), ['controller' => 'Municipios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sucursales view large-9 medium-8 columns content">
    <h3><?= h($sucursale->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($sucursale->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $sucursale->has('estado') ? $this->Html->link($sucursale->estado->nombre, ['controller' => 'Estados', 'action' => 'view', $sucursale->estado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Municipio') ?></th>
            <td><?= $sucursale->has('municipio') ? $this->Html->link($sucursale->municipio->nombre, ['controller' => 'Municipios', 'action' => 'view', $sucursale->municipio->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Banner') ?></th>
            <td><?= h($sucursale->banner) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sucursale->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($sucursale->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Detalles') ?></h4>
        <?= $this->Text->autoParagraph(h($sucursale->detalles)); ?>
    </div>
</div>

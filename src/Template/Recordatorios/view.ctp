<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Recordatorio'), ['action' => 'edit', $recordatorio->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Recordatorio'), ['action' => 'delete', $recordatorio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recordatorio->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Recordatorios'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Recordatorio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($recordatorio->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Pedido') ?></h6>
                    <p><?= $recordatorio->has('pedido') ? $this->Html->link($recordatorio->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $recordatorio->pedido->id]) : '' ?></p>
                                                    <h6><?= __('Cliente') ?></h6>
                    <p><?= $recordatorio->has('cliente') ? $this->Html->link($recordatorio->cliente->nombre, ['controller' => 'Clientes', 'action' => 'view', $recordatorio->cliente->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($recordatorio->id) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Created') ?></h6>
                <p><?= h($recordatorio->created) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Deleted') ?></h6>
                <p><?= $recordatorio->deleted ? __('Yes') : __('No'); ?></p>
                </div>
    </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


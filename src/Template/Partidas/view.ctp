<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Partida'), ['action' => 'edit', $partida->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Partida'), ['action' => 'delete', $partida->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partida->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Partidas'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Partida'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($partida->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Pedido') ?></h6>
                    <p><?= $partida->has('pedido') ? $this->Html->link($partida->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $partida->pedido->id]) : '' ?></p>
                                                    <h6><?= __('Sku') ?></h6>
                    <p><?= h($partida->sku) ?></p>
                                                    <h6><?= __('Codigo Fabricante') ?></h6>
                    <p><?= h($partida->codigo_fabricante) ?></p>
                                                    <h6><?= __('Producto') ?></h6>
                    <p><?= h($partida->producto) ?></p>
                                                    <h6><?= __('Atributos') ?></h6>
                    <p><?= h($partida->atributos) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($partida->id) ?></p>
                    <h6><?= __('Cantidad') ?></h6>
                <p><?= $this->Number->format($partida->cantidad) ?></p>
                    <h6><?= __('Precio') ?></h6>
                <p><?= $this->Number->format($partida->precio) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


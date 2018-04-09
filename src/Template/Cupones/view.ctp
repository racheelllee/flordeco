<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Cupon'), ['action' => 'edit', $cupon->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Cupon'), ['action' => 'delete', $cupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cupon->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Cupones'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Cupon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Marcas'), ['controller' => 'Marcas', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Marca'), ['controller' => 'Marcas', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($cupon->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($cupon->nombre) ?></p>
                                                    <h6><?= __('Codigo') ?></h6>
                    <p><?= h($cupon->codigo) ?></p>
                                                    <h6><?= __('Cliente') ?></h6>
                    <p><?= $cupon->has('cliente') ? $this->Html->link($cupon->cliente->nombre, ['controller' => 'Clientes', 'action' => 'view', $cupon->cliente->id]) : '' ?></p>
                                                    
                                                    <h6><?= __('Producto') ?></h6>
                    <p><?= $cupon->has('producto') ? $this->Html->link($cupon->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $cupon->producto->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($cupon->id) ?></p>
                    <h6><?= __('Monto') ?></h6>
                <p><?= $this->Number->format($cupon->monto) ?></p>
                    <h6><?= __('Porcentaje') ?></h6>
                <p><?= $this->Number->format($cupon->porcentaje) ?></p>
                    <h6><?= __('Cantidad') ?></h6>
                <p><?= $this->Number->format($cupon->cantidad) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Fecha Inicio') ?></h6>
                <p><?= h($cupon->fecha_inicio) ?></p>
                    <h6><?= __('Fecha Fin') ?></h6>
                <p><?= h($cupon->fecha_fin) ?></p>
                </div>
        </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


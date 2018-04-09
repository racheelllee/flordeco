<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Productos Proveedor'), ['action' => 'edit', $productosProveedor->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Productos Proveedor'), ['action' => 'delete', $productosProveedor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productosProveedor->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Productos Proveedores'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Productos Proveedor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Proveedores'), ['controller' => 'Proveedores', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Proveedor'), ['controller' => 'Proveedores', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($productosProveedor->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Producto') ?></h6>
                    <p><?= $productosProveedor->has('producto') ? $this->Html->link($productosProveedor->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $productosProveedor->producto->id]) : '' ?></p>
                                                    <h6><?= __('Proveedor') ?></h6>
                    <p><?= $productosProveedor->has('proveedor') ? $this->Html->link($productosProveedor->proveedor->nombre, ['controller' => 'Proveedores', 'action' => 'view', $productosProveedor->proveedor->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($productosProveedor->id) ?></p>
                    <h6><?= __('Costo') ?></h6>
                <p><?= $this->Number->format($productosProveedor->costo) ?></p>
                    <h6><?= __('Margen') ?></h6>
                <p><?= $this->Number->format($productosProveedor->margen) ?></p>
                    <h6><?= __('Precio') ?></h6>
                <p><?= $this->Number->format($productosProveedor->precio) ?></p>
                    <h6><?= __('Activo') ?></h6>
                <p><?= $this->Number->format($productosProveedor->activo) ?></p>
                    <h6><?= __('Existencia') ?></h6>
                <p><?= $this->Number->format($productosProveedor->existencia) ?></p>
                    <h6><?= __('User Id') ?></h6>
                <p><?= $this->Number->format($productosProveedor->user_id) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Created') ?></h6>
                <p><?= h($productosProveedor->created) ?></p>
                    <h6><?= __('Modified') ?></h6>
                <p><?= h($productosProveedor->modified) ?></p>
                </div>
        </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


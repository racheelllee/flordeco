<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Direccion'), ['action' => 'edit', $direccion->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Direccion'), ['action' => 'delete', $direccion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $direccion->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Direcciones'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Direccion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Municipios'), ['controller' => 'Municipios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Municipio'), ['controller' => 'Municipios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Paises'), ['controller' => 'Paises', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pais'), ['controller' => 'Paises', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($direccion->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Cliente') ?></h6>
                    <p><?= $direccion->has('cliente') ? $this->Html->link($direccion->cliente->nombre, ['controller' => 'Clientes', 'action' => 'view', $direccion->cliente->id]) : '' ?></p>
                                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($direccion->nombre) ?></p>
                                                    <h6><?= __('Calle') ?></h6>
                    <p><?= h($direccion->calle) ?></p>
                                                    <h6><?= __('Numero Exterior') ?></h6>
                    <p><?= h($direccion->numero_exterior) ?></p>
                                                    <h6><?= __('Numero Interior') ?></h6>
                    <p><?= h($direccion->numero_interior) ?></p>
                                                    <h6><?= __('Entre Calles') ?></h6>
                    <p><?= h($direccion->entre_calles) ?></p>
                                                    <h6><?= __('Colonia') ?></h6>
                    <p><?= h($direccion->colonia) ?></p>
                                                    <h6><?= __('Municipio') ?></h6>
                    <p><?= $direccion->has('municipio') ? $this->Html->link($direccion->municipio->id, ['controller' => 'Municipios', 'action' => 'view', $direccion->municipio->id]) : '' ?></p>
                                                    <h6><?= __('Codigo Postal') ?></h6>
                    <p><?= h($direccion->codigo_postal) ?></p>
                                                    <h6><?= __('Estado') ?></h6>
                    <p><?= $direccion->has('estado') ? $this->Html->link($direccion->estado->id, ['controller' => 'Estados', 'action' => 'view', $direccion->estado->id]) : '' ?></p>
                                                    <h6><?= __('Pais') ?></h6>
                    <p><?= $direccion->has('pais') ? $this->Html->link($direccion->pais->nombre, ['controller' => 'Paises', 'action' => 'view', $direccion->pais->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($direccion->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


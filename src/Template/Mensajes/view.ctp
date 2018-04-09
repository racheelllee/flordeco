<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Mensaje'), ['action' => 'edit', $mensaje->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Mensaje'), ['action' => 'delete', $mensaje->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mensaje->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Mensajes'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Mensaje'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($mensaje->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Usuario') ?></h6>
                    <p><?= $mensaje->has('usuario') ? $this->Html->link($mensaje->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $mensaje->usuario->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($mensaje->id) ?></p>
                    <h6><?= __('Envia') ?></h6>
                <p><?= $this->Number->format($mensaje->envia) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Fecha') ?></h6>
                <p><?= h($mensaje->fecha) ?></p>
                </div>
        </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Mensaje') ?></h6>
                <?= $this->Text->autoParagraph(h($mensaje->mensaje)); ?>
            </div>
        </div>
    <ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


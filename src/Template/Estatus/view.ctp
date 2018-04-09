<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Estatus'), ['action' => 'edit', $estatus->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Estatus'), ['action' => 'delete', $estatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estatus->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Estatus'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Estatus'), ['action' => 'add']) ?> </li>
    </ul>
<?php $this->end(); ?>

<h2><?= h($estatus->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($estatus->nombre) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($estatus->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


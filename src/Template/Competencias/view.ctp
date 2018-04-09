<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Competencia'), ['action' => 'edit', $competencia->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Competencia'), ['action' => 'delete', $competencia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competencia->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Competencias'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Competencia'), ['action' => 'add']) ?> </li>
    </ul>
<?php $this->end(); ?>

<h2><?= h($competencia->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($competencia->nombre) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($competencia->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


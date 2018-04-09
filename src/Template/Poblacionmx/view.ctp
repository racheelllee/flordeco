<?php
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Poblacionmx'), ['action' => 'edit', $poblacionmx->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Poblacionmx'), ['action' => 'delete', $poblacionmx->id], ['confirm' => __('Are you sure you want to delete # {0}?', $poblacionmx->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Poblacionmx'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Poblacionmx'), ['action' => 'add']) ?> </li>
    </ul>
<?php $this->end(); ?>

<h2><?= h($poblacionmx->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Estado') ?></h6>
                    <p><?= h($poblacionmx->estado) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($poblacionmx->id) ?></p>
                    <h6><?= __('Year') ?></h6>
                <p><?= $this->Number->format($poblacionmx->year) ?></p>
                    <h6><?= __('Poblacion') ?></h6>
                <p><?= $this->Number->format($poblacionmx->poblacion) ?></p>
                    <h6><?= __('Hombres') ?></h6>
                <p><?= $this->Number->format($poblacionmx->hombres) ?></p>
                    <h6><?= __('Mujeres') ?></h6>
                <p><?= $this->Number->format($poblacionmx->mujeres) ?></p>
                    <h6><?= __('Nacimientos') ?></h6>
                <p><?= $this->Number->format($poblacionmx->nacimientos) ?></p>
                    <h6><?= __('Defunciones') ?></h6>
                <p><?= $this->Number->format($poblacionmx->defunciones) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>


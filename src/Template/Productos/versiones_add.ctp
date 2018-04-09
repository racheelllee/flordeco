
<div class="page-padding">
    <?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Agregar versión'); ?></legend>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?php 
                    echo $this->Form->input('padre_id', ['type'=>'hidden','value' => $producto->padre_id]); 
                    echo $this->Form->input('sku', ['label'=>'Código']); 
                    echo $this->Form->input('nombre');                   
                    echo $this->Form->input('precio');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?= $this->Html->link(__('Cancelar'), ['action' => 'versiones_view',$padre_id], ['title' => __('Cancelar'), 'class'=>'btn btn-warning']) ?>
        </div>     
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?= $this->Form->button(__('Guardar'),['class'=>"btn btn-primary pull-right"]) ?>
        </div>
    </div> 

<?php
$user = $this->UserAuth->getUser();
echo $this->Form->input('usuario_id', ['type'=>'hidden','value' => $user['User']['id']]);
?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>
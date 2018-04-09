<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<div class="page-padding">
    <?= $this->Form->create($marca, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Editar {0}', ['Marca']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        echo $this->Form->input('logo',array('type'=>'file', 'label'=>'Logo'));
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
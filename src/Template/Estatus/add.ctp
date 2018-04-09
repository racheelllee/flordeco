<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Estatus'), ['action' => 'index']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($estatus); ?>
    <fieldset>
        <legend><?= __('Add {0}', ['Estatus']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
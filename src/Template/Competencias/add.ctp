<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Competencias'), ['action' => 'index']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($competencia); ?>
    <fieldset>
        <legend><?= __('Add {0}', ['Competencia']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
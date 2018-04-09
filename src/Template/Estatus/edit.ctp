<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $estatus->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $estatus->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Estatus'), ['action' => 'index']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($estatus); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Estatus']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
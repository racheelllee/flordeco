<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $competencia->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $competencia->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Competencias'), ['action' => 'index']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($competencia); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Competencia']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
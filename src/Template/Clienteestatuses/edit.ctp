<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $clienteestatus->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $clienteestatus->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Clienteestatuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($clienteestatus); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Clienteestatus']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
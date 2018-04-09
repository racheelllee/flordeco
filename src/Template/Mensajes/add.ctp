<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Mensajes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($mensaje); ?>
    <fieldset>
        <legend><?= __('Agregar {0}', ['Mensaje']) ?></legend>
        
        <?php
                echo $this->Form->input('usuario_id', ['options' => $usuarios]);
                        echo $this->Form->input('mensaje');
                        echo $this->Form->input('envia');
                        echo $this->Form->input('fecha');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
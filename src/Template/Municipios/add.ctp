<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Municipios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => 'Direcciones', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($municipio); ?>
    <fieldset>
        <legend><?= __('Agregar {0}', ['Municipio']) ?></legend>
        
        <?php
                echo $this->Form->input('estado_id', ['options' => $estados]);
                        echo $this->Form->input('nombre');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
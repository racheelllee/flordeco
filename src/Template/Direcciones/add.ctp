<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Direcciones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Municipios'), ['controller' => 'Municipios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Municipio'), ['controller' => 'Municipios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Paises'), ['controller' => 'Paises', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pais'), ['controller' => 'Paises', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($direccion); ?>
    <fieldset>
        <legend><?= __('Add {0}', ['Direccion']) ?></legend>
        
        <?php
                echo $this->Form->input('cliente_id', ['options' => $clientes]);
                        echo $this->Form->input('nombre');
                        echo $this->Form->input('calle');
                        echo $this->Form->input('numero_exterior');
                        echo $this->Form->input('numero_interior');
                        echo $this->Form->input('entre_calles');
                        echo $this->Form->input('colonia');
                        echo $this->Form->input('municipio_id', ['options' => $municipios]);
                        echo $this->Form->input('codigo_postal');
                        echo $this->Form->input('estado_id', ['options' => $estados]);
                        echo $this->Form->input('pais_id', ['options' => $paises]);
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
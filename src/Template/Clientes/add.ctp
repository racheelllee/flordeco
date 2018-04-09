<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Clientes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Municipios'), ['controller' => 'Municipios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Municipio'), ['controller' => 'Municipios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Paises'), ['controller' => 'Paises', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pais'), ['controller' => 'Paises', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clienteestatuses'), ['controller' => 'Clienteestatuses', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Clienteestatus'), ['controller' => 'Clienteestatuses', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Cupones'), ['controller' => 'Cupones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cupon'), ['controller' => 'Cupones', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => 'Direcciones', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($cliente); ?>
    <fieldset>
        <legend><?= __('Agregar {0}', ['Cliente']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        echo $this->Form->input('correo_electronico');
                        echo $this->Form->input('telefono_local');
                        echo $this->Form->input('telefono_celular');
                        echo $this->Form->input('contrasena');
                        echo $this->Form->input('razon_social');
                        echo $this->Form->input('rfc');
                        echo $this->Form->input('calle');
                        echo $this->Form->input('numero_exterior');
                        echo $this->Form->input('numero_interior');
                        echo $this->Form->input('entre_calles');
                        echo $this->Form->input('colonia');
                        echo $this->Form->input('municipio_id', ['options' => $municipios]);
                        echo $this->Form->input('codigo_postal');
                        echo $this->Form->input('estado_id', ['options' => $estados]);
                        echo $this->Form->input('pais_id', ['options' => $paises]);
                        echo $this->Form->input('clienteestatus_id', ['options' => $clienteestatuses]);
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Comentarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($comentario); ?>
    <fieldset>
        <legend><?= __('Add {0}', ['Comentario']) ?></legend>
        
        <?php
                echo $this->Form->input('producto_id', ['options' => $productos]);
                        echo $this->Form->input('calificacion');
                        echo $this->Form->input('user_id', ['options' => $usuarios]);
                        echo $this->Form->input('comentarios');
                        echo $this->Form->input('fecha');
                        echo $this->Form->input('autorizado');
                        echo $this->Form->input('pedidos._ids', ['options' => $pedidos]);
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
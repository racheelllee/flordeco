<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $productosProveedor->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $productosProveedor->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Productos Proveedores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Proveedores'), ['controller' => 'Proveedores', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Proveedor'), ['controller' => 'Proveedores', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($productosProveedor); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Productos Proveedor']) ?></legend>
        
        <?php
                echo $this->Form->input('producto_id', ['options' => $productos]);
                        echo $this->Form->input('proveedor_id', ['options' => $proveedores]);
                        echo $this->Form->input('costo');
                        echo $this->Form->input('margen');
                        echo $this->Form->input('precio');
                        echo $this->Form->input('activo');
                        echo $this->Form->input('existencia');
                        echo $this->Form->input('user_id');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
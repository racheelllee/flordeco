<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $formasdepago->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $formasdepago->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Formasdepagos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($formasdepago); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Formasdepago']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        echo $this->Form->input('descripcion');
                        echo $this->Form->input('imagen');
                        echo $this->Form->input('activo');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
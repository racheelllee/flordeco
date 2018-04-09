<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Partidas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($partida); ?>
    <fieldset>
        <legend><?= __('Add {0}', ['Partida']) ?></legend>
        
        <?php
                echo $this->Form->input('pedido_id', ['options' => $pedidos]);
                        echo $this->Form->input('cantidad');
                        echo $this->Form->input('sku');
                        echo $this->Form->input('codigo_fabricante');
                        echo $this->Form->input('producto');
                        echo $this->Form->input('atributos');
                        echo $this->Form->input('precio');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
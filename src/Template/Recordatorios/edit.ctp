<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $recordatorio->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $recordatorio->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Listar Recordatorios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($recordatorio); ?>
    <fieldset>
        <legend><?= __('Edit {0}', ['Recordatorio']) ?></legend>
        
        <?php
                echo $this->Form->input('pedido_id', ['options' => $pedidos]);
                        echo $this->Form->input('cliente_id', ['options' => $clientes]);
                        echo $this->Form->input('deleted');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
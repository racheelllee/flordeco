<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Promociones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>


<div class="page-padding">
    <div class="row">
        <div class="col-lg-8">

        <?= $this->Form->create($promocion); ?>
        <fieldset>
        <legend><?= __('Agregar Promoción') ?></legend>
        
        <div class="row">
            <div class="col-lg-6">
                <?php
                    echo $this->Form->input('nombre');
                ?>
            </div>
            <div style="display:none;" class="col-lg-6"> <br>
                <?php

                    echo $this->Form->input('envio', ['type'=>'hidden','value'=>0]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php
                    echo $this->Form->input('fecha_inicio',array('class ' => 'form-control', 'type'=>'text', 'label' => false));
                    echo $this->Form->input('monto');
                ?>
            </div>
            <div class="col-lg-3">
                <?php
                    echo $this->Form->input('fecha_fin',array('class ' => 'form-control', 'type'=>'text', 'label' => false));
                    echo $this->Form->input('descuento');
                ?>
            </div>
        </div>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>



<script type="text/javascript">

    $('#fecha-inicio').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

    $('#fecha-fin').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

</script>

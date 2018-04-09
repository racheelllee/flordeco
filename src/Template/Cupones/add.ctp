<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Cupones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Marcas'), ['controller' => 'Marcas', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Marca'), ['controller' => 'Marcas', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>
<div class="page-padding">
    <?= $this->Form->create($cupon); ?>
    <fieldset>
        <legend>Agregar Cupon</legend>
        
        <?php
                echo $this->Form->input('nombre');
                        echo $this->Form->input('codigo');
                        echo $this->Form->input('cliente_id', ['options' => $clientes,
                                                                    'empty' => ['' => 'Todos']]);
                        echo $this->Form->input('monto');
                        echo $this->Form->input('porcentaje');
                        echo $this->Form->input('fecha_inicio',array('class ' => 'form-control', 'type'=>'text'));
                        echo $this->Form->input('fecha_fin',array('class ' => 'form-control', 'type'=>'text'));
                        /*
                        echo $this->Form->input('categoria_id', ['options' => $categorias,
                                                                    'empty' => ['' => 'Todas']]);
                        echo $this->Form->input('marca_id', ['options' => $marcas,
                                                                'empty' => ['' => 'Todas']]);*/
                        echo $this->Form->input('producto_id', ['options' => $productos,
                                                                    'empty' => ['' => 'Todos']]);
                        //echo $this->Form->input('cantidad');

                        echo $this->Form->input('compra_minima',array('label'=>'Compra Mínima ($)'));

                        echo $this->Form->radio(
    'cantidad',
    [
        ['value' => '0', 'text' => 'Cupon valido n veces durante el periodo'],
        ['value' => '1', 'text' => 'Cupon valido solo una vez']
    ]
);
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
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
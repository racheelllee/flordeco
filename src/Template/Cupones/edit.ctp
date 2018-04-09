<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $cupon->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $cupon->id)]
            )
            ?></li>
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
        <legend><?= __('Editar {0}', ['Cupon']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');
                        echo $this->Form->input('codigo');
                        echo $this->Form->input('cliente_id', ['options' => $clientes,
                                                                    'empty' => ['' => 'Todos']]);
                        echo $this->Form->input('monto');
                        echo $this->Form->input('porcentaje');
                        echo $this->Form->input('fecha_inicio',array('class ' => 'form-control', 'type'=>'text'));
                        echo $this->Form->input('fecha_fin',array('class ' => 'form-control', 'type'=>'text'));
                        
                        echo $this->Form->input('producto_id', ['options' => $productos,
                                                                    'empty' => ['' => 'Todos']]);
                        //echo $this->Form->input('cantidad');

                        echo $this->Form->input('compra_minima',array('label'=>'Compra Miníma ($)'));

                        echo $this->Form->radio(
    'cantidad',
    [
        ['value' => '0', 'text' => 'Cupon valido n veces durante el periodo'],
        ['value' => '1', 'text' => 'Cupon valido solo una vez']
    ]
);
                        ?>
       
        <br><br><br>
    </fieldset>

    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>


    <br><br>
    <h3> Multiples Categorias </h3>
    <div class="row">
            <div class="col-md-2">
                <p>Categorias Permitidas</p>

                <?php echo $this->Form->input('categorias_permitidas', ['id'=>'categorias_permitidas', 'size'=>'10', 'class'=>'select_categorias', 'label'=>false, 'style'=>'width:220px;border:1px solid #CCC;', 'options' => $categorias_permitidas]); ?>
            </div>

            <div class="col-md-2">
                <p>Categorias No Permitidas</p>


                <?php echo $this->Form->input('categorias_no_permitidas', ['id'=>'categorias_no_permitidas', 'size'=>'10', 'class'=>'select_categorias', 'label'=>false, 'style'=>'width:220px;border:1px solid #CCC;', 'options' => $categorias_no_permitidas]); ?>
                
            </div>
        </div>


    <br><br>
    <h3> Multiples Marcas </h3>
    <div class="row">
            <div class="col-md-2">
                <p>Marcas Permitidas</p>

                <?php echo $this->Form->input('marcas_permitidas', ['id'=>'marcas_permitidas', 'size'=>'10', 'class'=>'select_marcas', 'label'=>false, 'style'=>'width:220px;border:1px solid #CCC;', 'options' => $marcas_permitidas]); ?>
            </div>

            <div class="col-md-2">
                <p>Marcas No Permitidas</p>


                <?php echo $this->Form->input('marcas_no_permitidas', ['id'=>'marcas_no_permitidas', 'size'=>'10', 'class'=>'select_marcas', 'label'=>false, 'style'=>'width:220px;border:1px solid #CCC;', 'options' => $marcas_no_permitidas]); ?>
                
            </div>
        </div>

                



<br><br><br>

    <h3> Pedidos con Cupon </h3>

            <table class="table">
                <thead>
                    <tr>  
                        <th>No. de Orden</th>     
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th>Descuento Cupon</th>  
                        <th>Total</th>               
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cupon->pedidos as $pedido): ?>
                    <tr>
                        <td>#<?php echo $pedido->id; ?></td>
                        <td><?php echo $pedido->fecha->i18nFormat('dd-MM-YYYY'); ?></td>
                        <td><?php echo $pedido->estatus->nombre; ?></td>
                        <td>$ <?php echo number_format($pedido->cupon,2); ?> MXN</td>
                        <td>$ <?php echo number_format($pedido->monto,2); ?> MXN</td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

<script type="text/javascript">
    
    $(document).on({click: function(){

            var _this = $(this);
            var o = _this.find('option:selected');
            if(o.length == 1){
                var select = (_this.attr('id') == 'categorias_permitidas') ? 'categorias_no_permitidas' : 'categorias_permitidas';
                o.removeAttr('selected');
                $('#'+select).append(o);

                var categoria_id = o.val();
                var accion = _this.attr('id');
                var cupon_id = <?php echo $cupon->id; ?>;
               
                $.ajax({
                    url: '/cupones/multiple_categoria',
                    type: 'POST',
                    dataType: 'html', 
                    data:{ 
                        accion:accion,
                        cupon_id:cupon_id,
                        categoria_id:categoria_id
                    },
                    })
                    .done(function(data) {
                      
                    });
            }

    }}, '.select_categorias');


    $(document).on({click: function(){

            var _this = $(this);
            var o = _this.find('option:selected');
            if(o.length == 1){
                var select = (_this.attr('id') == 'marcas_permitidas') ? 'marcas_no_permitidas' : 'marcas_permitidas';
                o.removeAttr('selected');
                $('#'+select).append(o);

                var marca_id = o.val();
                var accion = _this.attr('id');
                var cupon_id = <?php echo $cupon->id; ?>;
               
                $.ajax({
                    url: '/cupones/multiple_marca',
                    type: 'POST',
                    dataType: 'html', 
                    data:{ 
                        accion:accion,
                        cupon_id:cupon_id,
                        marca_id:marca_id
                    },
                    })
                    .done(function(data) {
                      
                    });
            }

    }}, '.select_marcas');

    $('#fecha-inicio').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

    $('#fecha-fin').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

</script>
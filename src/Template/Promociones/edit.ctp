<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?=
            $this->Form->postLink(
            __('Eliminar'),
            ['action' => 'delete', $promocion->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $promocion->id)]
            )
            ?></li>
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
        <legend><?= __('Editar Promoción') ?></legend>
        
        <div class="row">
            <div class="col-lg-6">
                <?php
                    echo $this->Form->input('nombre');
                ?>
            </div>
            <div style="display:none;"  class="col-lg-6"> <br>
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


    <br><br><br>
    <h3>Productos en Promocion </h3>

            <table class="table">
                <thead>
                    <tr>       
                        <th>SKU</th>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Precio</th>             
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_promociones as $producto): ?>
                    <tr>
                        <td><?php echo $producto->producto->sku; ?></td>
                        <td><?php echo $producto->producto->nombre; ?></td>
                        <td><?php echo $producto->producto->marca->nombre; ?></td>
                        <td>$<?php echo number_format($producto->producto->precio,2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            

    <br><br><br>
    <h3>Agregar Productos en Promocion </h3>


    <form method="post" accept-charset="utf-8" id="form_buscar_productos" action="">  
        <div class="row">
            <div class="col-lg-4">
                <?php echo $this->Form->input('palabra_busqueda', ['label'=>'Palabra Clave']); ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->input('categoria_busqueda', ['options'=>$categorias, 'empty'=>'Seleccina', 'label'=>'Categoria']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->input('proveedor_busqueda', ['options' => $proveedores, 'empty'=>'Seleccina', 'label'=>'Proveedor']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->input('marca_busqueda', ['options' => $marcas, 'empty'=>'Seleccina', 'label'=>'Marca']) ?>
            </div>
            <div class="col-lg-2">
                <br>
                <input type="button" class="btn buscar_productos" value="Buscar"/>  
            </div>
        </div>
    </form>


    <br>

        <div class="row">
            <div class="col-lg-1">
                <?php echo $this->Form->checkbox('checkAll', ['hiddenField' => false, 'class'=>'checkAll']); ?>
            </div>
            <div class="col-lg-2">
                <b>SKU</b>
            </div>
            <div class="col-lg-4">
                <b>Producto</b>
            </div>
            <div class="col-lg-2">
                <b>Precio</b>
            </div>
        </div>

        <legend></legend>

        <?php foreach ($busqueda_productos as $producto) { ?>
            <div class="row">
                <div class="col-lg-1">
                    <?php echo $this->Form->checkbox('check'.$producto->id, ['hiddenField' => false, 'value'=>$producto->id, 'class'=>'check_producto_relacionado']); ?>
                </div>
                <div class="col-lg-2">
                    <?php echo $producto->sku; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo $producto->nombre; ?>
                </div>
               
                <div class="col-lg-2">
                    $<?php echo number_format($producto->precio,2); ?>
                </div>
            </div>
            <br>
        <?php } ?>
       
            <div class="row">
                <div class="col-lg-12" style="text-align:right;">
                    <br>
                    <input type="button" class="btn agregar_producto_relacionado" value="Agregar Seleccion"/>  
                </div>
            </div>





<script type="text/javascript">

    $(document).on({click: function(e){        
          
          var palabra = $( "#palabra-busqueda" ).val();
          var categoria = $( "#categoria-busqueda" ).val();
          var proveedor = $( "#proveedor-busqueda" ).val();
          var marca = $( "#marca-busqueda" ).val();

          if(palabra == ''){ palabra = null; }
          if(categoria == ''){ categoria = null; }
          if(proveedor == ''){ proveedor = null; }
          if(marca == ''){ marca = null; }

          
          window.location = '/promociones/edit/<?php echo $promocion->id;?>/'+palabra+'/'+categoria+'/'+proveedor+'/'+marca;
          
          
    }}, '.buscar_productos'); 

    $(document).on({change: function(e){ 

            var check =  this.checked;

            $('input[class=check_producto_relacionado]').prop('checked',check);

    }}, '.checkAll');


    $(document).on({click: function(e){ 

            var producto_relacionados = new Array();
            var i = 0;
            
            $("input[class=check_producto_relacionado]:checked").each(function(){
              
                producto_relacionados.push($(this).val());  

            });


            $.ajax({
                        url: '/promociones/add_producto/<?php echo $promocion->id; ?>',
                        type: 'POST',
                        dataType: 'html', 
                        data: { producto_relacionados:producto_relacionados },
                    })
                    .done(function(data) {
                        
                        window.location = '/promociones/edit/<?php echo $promocion->id;?>';
            });


    }}, '.agregar_producto_relacionado');


    $('#fecha-inicio').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

    $('#fecha-fin').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

</script>
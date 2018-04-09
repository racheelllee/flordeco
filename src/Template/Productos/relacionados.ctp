<div class="row">
<br>
 <?= $this->Form->create($producto,['action'=>'edit_categoria_relacionada']); ?>
  <div class="col-lg-4 col-xs-4 col-md-4" id="CategoriaRelacionada">
    <?php echo $this->Form->input('categoria_relacionada', ['options'=>$categorias,'default'=>$categoria_relacionada['categoria_id'],'empty'=>[''=>'-- Seleccione --'],'label'=>'Categroría de Complementos']); ?>
    </div>
    <div class="col-lg-2 col-xs-2 col-md-2" id="CategoriaRelacionada">
    <br>
    <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-primary']) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
<div class="row">
  <div class="col-md-12 col-xs-12 col-lg-12" id="RelacionadosLista">
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12 col-lg-12" id="RelacionadosBusqueda">
  </div>
</div>
<script type="text/javascript">
  $( "#RelacionadosLista" ).load('/complementos_productos/add/<?php echo $producto->id; ?>', function() {

        $(document).on({click: function(e){  

              var producto_relacionado_id = $(this).data('id');

                  
                    $.ajax({
                        url: '/complementos_productos/delete',
                        type: 'POST',
                        dataType: 'html', 
                        data:{ producto_relacionado_id: producto_relacionado_id },
                    })
                    .done(function(data) {
                        $('#RelacionadosLista').load('/complementos_productos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.eliminar_producto_relacionado');

    });

    $( "#RelacionadosBusqueda" ).load('/complementos_productos/busqueda/', function() {
        $(document).on({click: function(e){        
          
          var palabra = $( "#palabra-busqueda" ).val();
          var categoria = $( "#categoria-busqueda" ).val();
          var proveedor = $( "#proveedor-busqueda" ).val();
          var marca = $( "#marca-busqueda" ).val();

          if(palabra == ''){ palabra = null; }
          if(categoria == ''){ categoria = null; }
          if(proveedor == ''){ proveedor = null; }
          if(marca == ''){ marca = null; }

          

          $('#RelacionadosBusqueda').load('/complementos_productos/busqueda/'+palabra+'/'+categoria+'/'+proveedor+'/'+marca);
          
        }}, '.buscar_productos'); 

        $(document).on({click: function(e){ 

            var producto_relacionados = new Array();
            var i = 0;
            $("input[class=check_producto_relacionado]:checked").each(function(){
              
                producto_relacionados.push($(this).val());  

            });


            $.ajax({
                        url: '/complementos_productos/add/<?php echo $producto->id; ?>',
                        type: 'POST',
                        dataType: 'html', 
                        data: { producto_relacionados:producto_relacionados },
                    })
                    .done(function(data) {
                        $('#RelacionadosLista').load('/complementos_productos/add/<?php echo $producto->id; ?>');
                        $('#RelacionadosBusqueda').load('/complementos_productos/busqueda/');

            });


        }}, '.agregar_producto_relacionado');

        $(document).on({change: function(e){ 

            var check =  this.checked;

            $('input[class=check_producto_relacionado]').prop('checked',check);

        }}, '.checkAll');

    });

</script>
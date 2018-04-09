<?php

$this->extend('../Layout/TwitterBootstrap/dashboard');
 echo $this->Html->script('/js/summernote.min.js'); 
?>
<link rel="stylesheet" type="text/css" href="/css/summernote.css">
       

  
<div class="page-padding">
  <div class="row">
    <div class="col-lg-12">

        <?= $this->Form->create($producto); ?>
        
        <legend><?= __('Editar {0}', ['Producto']) ?></legend>
        

        <div class="row">
          <div class="col-lg-6">
            <?= $this->Form->input('nombre') ?>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-9">
                  <?= $this->Form->input('sku', ['label'=>'Código']) ?>
              </div>
              <div class="col-lg-3">

                <?php
               
                    echo $this->Form->input('estatus_id', ['label'=>'Estatus', 'options'=>$estatus]);
                ?>

              </div>
            </div>
              
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <?= $this->Form->input('descripcion_corta', ['label'=>'Descripción Corta']) ?>
          </div>

          <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-6">
                      <?= $this->Form->input('url') ?>
                  </div>
                  <div class="col-lg-4" style="padding-top: 19px; font-size: 14px;">

                    <?php
                   
                        echo $this->Form->input('mensaje_personalizado', ['style'=>'font-weight: bold;']);
                    ?>

                  </div>
                  <div class="col-lg-2" style="padding-top: 19px; font-size: 14px;">

                    <?php
                   
                        echo $this->Form->input('adicional', ['style'=>'font-weight: bold;']);
                    ?>

                  </div>
                </div>
          </div>

        </div>

        

        <div class="row">

          <div class="col-lg-12">
            <?php echo $this->Tinymce->textarea('descripcion_larga',['type'=>'textarea', 'label'=>'Descripción Larga', 'div'=>false, 'style'=>'height:500px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>
          </div>
          <div class="col-lg-12">
          <br><br>
            <?= $this->Form->button(__('Guardar'), ['class'=>'pull-right btn btn-primary']) ?>
            <?= $this->Form->end() ?>
          </div>  
        </div>

        <?= $this->Form->end() ?>
      
        

        <div class="row">
          <div class="col-lg-12">
            <br><br>
        
            <ul id="myTab" class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#Precios" id="Precios-tab" role="tab" data-toggle="tab" aria-controls="Precios" aria-expanded="true">Precios</a>
              </li>
              
              <li role="presentation" class="">
                <a href="#Imagenes" id="Imagenes-tab" role="tab" data-toggle="tab" aria-controls="Imagenes" aria-expanded="false">Imágenes</a>
              </li>

              <li role="presentation" class="">
                <a href="#Categorias" id="Categorias-tab" role="tab" data-toggle="tab" aria-controls="Categorias" aria-expanded="false">Categorías</a>
              </li>
              <li role="presentation" class="">
                <a href="#Relacionados" id="Relacionados-tab" role="tab" data-toggle="tab" aria-controls="Relacionados" aria-expanded="false">Relacionados</a>
              </li>
              <li role="presentation" class="">
                <a href="#SEO" id="SEO-tab" role="tab" data-toggle="tab" aria-controls="SEO" aria-expanded="false">SEO</a>
              </li>
              
            </ul>
          </div>
        </div>

        <div id="myTabContent" class="tab-content" style="min-height: 700px">
          <div role="tabpanel" class="tab-pane fade in active" id="Precios" aria-labelledBy="Precios-tab">

              <?= $this->Form->create($producto); ?>
              <div class="row" style="margin-top:40px;">
                
                  <div class="col-lg-2">
                    <?= $this->Form->input('costo',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_1',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_2',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_3',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_4',[]); ?>
                  </div>
                  <div class="col-lg-8">
                  </div>
                
              </div>

              <div class="row" style="margin-top:40px;">
                
                  <div class="col-lg-2">
                    
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_1_especial',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_2_especial',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_3_especial',[]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_4_especial',[]); ?>
                  </div>
                  <div class="col-lg-8">
                  </div>
                
              </div>

              <div class="row" style="margin-top:40px;">
                
                  <div class="col-lg-2">
                    
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_1_especial_hasta',['type'=>'text', 'class'=>'datepicker', 'value'=>(!empty($producto->precio_1_especial_hasta))? $producto->precio_1_especial_hasta->format('Y-m-d') : '' ]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_2_especial_hasta',['type'=>'text', 'class'=>'datepicker', 'value'=>(!empty($producto->precio_2_especial_hasta))? $producto->precio_2_especial_hasta->format('Y-m-d') : '' ]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_3_especial_hasta',['type'=>'text', 'class'=>'datepicker', 'value'=>(!empty($producto->precio_3_especial_hasta))? $producto->precio_3_especial_hasta->format('Y-m-d') : '' ]); ?>
                  </div>
                  <div class="col-lg-2">
                    <?= $this->Form->input('precio_4_especial_hasta',['type'=>'text', 'class'=>'datepicker', 'value'=>(!empty($producto->precio_4_especial_hasta))? $producto->precio_4_especial_hasta->format('Y-m-d') : '' ]); ?>
                  </div>
                  <div class="col-lg-8">
                    <?= $this->Form->button(__('Guardar Precios'), ['class'=>'btn btn-primary']) ?>
                  </div>
                
              </div>

              <?= $this->Form->end() ?>

          </div>
          
          <div role="tabpanel" class="tab-pane fade in " id="Imagenes" aria-labelledBy="Imagenes-tab">
            <iframe src="/imagenes/index/<?= $producto->id?>" width="100%" height="700" frameborder="0"></iframe>
          </div>

          <div role="tabpanel" class="tab-pane fade in " id="Categorias" aria-labelledBy="Categorias-tab">
          </div>


          <div role="tabpanel" class="tab-pane fade in " id="Relacionados" aria-labelledBy="Relacionados-tab">

            <div class="row">
              <div class="col-lg-12" id="RelacionadosLista">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12" id="RelacionadosBusqueda">
              </div>
            </div>

          </div>

          <div role="tabpanel" class="tab-pane fade in " id="SEO" aria-labelledBy="SEO-tab">
            <div class="row">
              <div class="col-lg-8">
                <?= $this->Form->create($producto); ?>
                <br><br>
                <?php 
                      echo $this->Form->input('id', ['type'=>'hidden']);
                      echo $this->Form->input('meta_titulo',['maxlength'=>70]);
                      echo $this->Form->input('meta_descripcion',['maxlength'=>156]);
                      echo $this->Form->input('meta_keywords');
                ?>

                <?= $this->Form->button(__('Guardar SEO'), ['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>
          
        </div>


    </div>
  </div>
</div>

<!--  ++++++++++++++++
      +++++++c++++++++
      ++++++++++++++++ -->

<!-- Modal generic-->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar </h4>
      </div>
      <div class="modal-body">
          <form id="myForm" action="">
          <fieldset id="myFieldset"> 
          </fieldset>
          </form>    
      </div>
      <div class="modal-footer">
        <button type="button" id="modalButton" class="btn btn-primary" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    var slug = function(str) {
      str = str.replace(/^\s+|\s+$/g, ''); // trim
      str = str.toLowerCase();
      
      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to   = "aaaaeeeeiiiioooouuuunc------";
      for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }

      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

      return str;
    }


  $('#nombre').keyup(function () {

    var url = slug($('#nombre').val());
    var url_actual = '<?php echo $producto->url; ?>';

    $('#meta-titulo').val($('#nombre').val());

    $('#url').val(url);

        $.ajax({
            url: '/productos/url_existente',
            type: 'POST',
            dataType: 'html', 
            data:{ url:url },
            })
            .done(function(data) {
              if(data > 0 && url != url_actual){
                alert('URL de producto existente.');
              }
        });

  });

  $('#url').keyup(function (e) {

    var url = $('#url').val();
    var url_actual = '<?php echo $producto->url; ?>';

        $.ajax({
            url: '/productos/url_existente',
            type: 'POST',
            dataType: 'html', 
            data:{ url:url },
            })
            .done(function(data) {
              if(data > 0 && url != url_actual){
                alert('URL de producto existente.');
              }
        });
  });


  $(document).ready(function() {


    $('.summernote').summernote();   
  

    $('#descripcion-corta').keyup(function () {
    
      if(!$('#meta-descripcion').val()){

        $('#meta-descripcion').val( $('#descripcion-corta').val());
      } 
    
    });


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

  
    $( "#Categorias" ).load('/categorias_productos/add/<?php echo $producto->id; ?>', function() {

      $(document).on({click: function(e){        
                    $.ajax({
                        url: '/CategoriasProductos/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_categoria").serialize(),
                    })
                    .done(function(data) {
                        $('#Categorias').load('/categorias_productos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.agregar_categoria');

      

      $(document).on({click: function(e){  

              var categoria_id = $(this).data('id');

                  
                    $.ajax({
                        url: '/CategoriasProductos/delete',
                        type: 'POST',
                        dataType: 'html', 
                        data:{ categoria_id: categoria_id },
                    })
                    .done(function(data) {
                        $('#Categorias').load('/categorias_productos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.eliminar_categoria');

    });


   


  });
    


</script>
<style type="text/css">
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline;
    padding: 0;
  }
  table.dataTable tbody tr {
    background-color: transparent;
  }
</style>
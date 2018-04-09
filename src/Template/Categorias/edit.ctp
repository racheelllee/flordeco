<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>


<div class="page-padding">
  <div class="row">
    <div class="col-lg-12">



    <?= $this->Form->create($categoria, ['type' => 'file']); ?>
      <legend><?= __('Editar {0}', ['Categoría']) ?></legend>
      <div class="row">
        <div class="col-lg-6">
          <?= $this->Form->input('id', array('type'=>'hidden')) ?>
          <?= $this->Form->input('nombre') ?>
        </div>
        <div class="col-lg-6">
          <div class="col-lg-8">
            <?= $this->Form->input('url') ?>
          </div>
          <div class="col-lg-4">
            <br>
            <?= $this->Form->input('publicado') ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $this->Form->input('categoria_id', array('options'=>$categorias, 'label'=>'Categoria Padre','empty'=>'-- Seleccione --')) ?>
        </div>
      </div>

      <div class="row">
          <div class="col-lg-6">
            <div class="col-lg-10">
              <label class="control-label">Banner Principal</label>
              <?= $this->Form->input('banner',array('type'=>'file', 'label'=>false)) ?>
            </div>
            <div class="col-lg-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-image" data-href="/<?php echo $categoria->imagen_banner; ?>" style="margin-top: 30px;"> <i class="fa fa-eye"></i> </button>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="col-lg-10">
              <label class="control-label">Imagen Fondo</label>
              <?= $this->Form->input('imagen_fondo',array('type'=>'file', 'label'=>false)) ?>
            </div>
            <div class="col-lg-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-image" data-href="/<?php echo $categoria->imagen_fondo; ?>" style="margin-top: 30px;"> <i class="fa fa-eye"></i> </button>
            </div>
          </div>

      </div>


       <?php echo $this->Tinymce->textarea('descripcion',['type'=>'textarea', 'label'=>false, 'div'=>false, 'style'=>'height:500px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>

           <?php
            echo $this->Form->button(__('Guardar'), ['class'=>'pull-right btn btn-primary']);
            echo $this->Form->end();
            ?>


      <br><br>
        <ul id="myTab" class="nav nav-tabs" role="tablist">
         
          <!-- <li role="presentation" class="">
            <a href="#Filtros" id="Filtros-tab" role="tab" data-toggle="tab" aria-controls="Filtros" aria-expanded="true">Filtros</a>
          </li> -->
          
           <li role="presentation" class="active">
            <a href="#SEO" id="SEO-tab" role="tab" data-toggle="tab" aria-controls="SEO" aria-expanded="true">SEO</a>
          </li>

        </ul>
      <div id="myTabContent" class="tab-content">

        
        <!-- <div role="tabpanel" class="tab-pane fade in " id="Filtros" aria-labelledBy="Filtros-tab"></div> -->
        
        <div role="tabpanel" class="tab-pane fade in active" id="SEO" aria-labelledBy="SEO-tab">
          <div class="row">
            <div class="col-lg-8">    
              <br><br>
              <?php
                echo $this->Form->create($categoria, ['type' => 'file']);
                echo $this->Form->input('id', array('type'=>'hidden'));
                echo $this->Form->input('meta_titulo');
                echo $this->Form->input('meta_descripcion');
                echo $this->Form->input('meta_keywords');
                
                echo $this->Form->button(__('Guardar'), ['class'=>'btn btn-primary']);
                echo $this->Form->end();
              ?>
            </div>
          </div>

        </div>

      </div>




    </div>
  </div>

<?php echo $this->element('modal_image'); ?>

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

        $('#url').val(url);
      });

  $(document).ready(function() {
   
  
    $( "#Filtros" ).load('/filtros/add/<?php echo $categoria->id; ?>', function() {

        $(document).on({click: function(e){        
                    $.ajax({
                        url: '/filtros/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_filtro").serialize(),
                    })
                    .done(function(data) {
                        $('#Filtros').load('/filtros/add/<?php echo $categoria->id; ?>');
                    });
        }}, '.agregar_filtro');


        $(document).on({click: function(e){   

            var id = $(this).data('id');

                    $.ajax({
                        url: '/Opcionesfiltros/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_opcionFiltro"+id).serialize(),
                    })
                    .done(function(data) {
                        $('#Filtros').load('/filtros/add/<?php echo $categoria->id; ?>');
                    });
        }}, '.guarda_opcionFiltro');


    $(document).on({click: function(e){   

            var id = $(this).data('id');

                    $.ajax({
                        url: '/Opcionesfiltros/edit',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_opcionFiltro"+id).serialize(),
                    })
                    .done(function(data) {
                        $('#Filtros').load('/filtros/add/<?php echo $categoria->id; ?>');
                    });

        }}, '.editar_opcionFiltro');



    $(document).on({click: function(e){   

            var id = $(this).data('id');

                    $.ajax({
                        url: '/filtros/edit',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_Filtro"+id).serialize(),
                    })
                    .done(function(data) {
                        $('#Filtros').load('/filtros/add/<?php echo $categoria->id; ?>');
                    });

        }}, '.editar_Filtro');


        $(document).on({click: function(e){  

              var opcion_id = $(this).data('id');

                  
                    $.ajax({
                        url: '/Opcionesfiltros/delete',
                        type: 'POST',
                        dataType: 'html', 
                        data:{ opcion_id: opcion_id },
                    })
                    .done(function(data) {
                        $('#Filtros').load('/filtros/add/<?php echo $categoria->id; ?>');
                    });
        }}, '.eliminar_opcionFiltro');

    });

  });



/*
$('#img').click(function (e) {
    $('#myModal img').attr('src', $(this).attr('data-img-url'));
});*/
</script>

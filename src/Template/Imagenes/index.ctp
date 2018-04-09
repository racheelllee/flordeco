<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<style type="text/css">
  .texto-prueba{
    text-align: center;
    position: absolute;
    width: 100%;
  }
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        
            <form action="<?= $url ?>" class="dropzone" id="uploadFile">
              <div class="fallback">
                <input name="file" type="file" multiple />
              </div>
            </form>

        </div>
    </div>
</div>

<div class="row" style="margin-top:40px;">
<?= $this->Form->create($producto, ['url'=>'/productos/edit/'.$producto_id]); ?>

    <div class="col-lg-2">
      <div class="col-lg-12">
        <?= $this->Form->input('mensaje_personalizado_margin_top',['type'=>'number', 'label'=>'Margen Arriba', 'class'=>'change-margin', 'data-medida'=>'px', 'data-atributocss'=>'top']); ?>
      </div>
      <div class="col-lg-12">
        <?= $this->Form->input('mensaje_personalizado_margin_left',['type'=>'number', 'label'=>'Margen Izquierda', 'class'=>'change-margin', 'data-medida'=>'px', 'data-atributocss'=>'padding-left']); ?>
      </div>
      <div class="col-lg-12">
        <?= $this->Form->input('mensaje_personalizado_margin_right',['type'=>'number', 'label'=>'Margen Derecha', 'class'=>'change-margin', 'data-medida'=>'px', 'data-atributocss'=>'padding-right']); ?>
      </div>

      <div class="col-lg-12">
        <?= $this->Form->input('mensaje_personalizado_color',['label'=>'Color de Texto', 'class'=>'change-margin', 'data-medida'=>'', 'data-atributocss'=>'color']); ?>
      </div>

      <div class="col-lg-12">
        <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-primary']) ?>
      </div>
    </div>
                  
<?= $this->Form->end() ?>

  <?php if($imagenes){ ?>
    
    <div class="col-lg-6">
      <div style="width:300px; position: relative;">
        <img id="bigImg" src="/img/productos/original/<?= $imagenes[0]->nombre ?>" alt=""  style="width:300px;">
        <div class="texto-prueba" style="<?= $producto->estilos_texto_imagen ?>">Este es mi mensaje personalizado en 50 caracteres</div>
      </div>
    </div>

  <?php } ?>

</div>






<script type="text/javascript">

  $('.change-margin').keyup(function() {

      var atributocss = $(this).data('atributocss');
      var val = $(this).val() + $(this).data('medida');
      
      $('.texto-prueba').css(atributocss, val);

  });
  

    $(function() { //maxFiles: 1,
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#uploadFile", { addRemoveLinks: true, dictRemoveFile: "Eliminar Foto", dictDefaultMessage: "Arrastra las fotos aquí para subirlas"});
        var archivos = <?= json_encode($imagenes)?>;

        $.each( archivos, function( key, value) {

            var mockFile = { size: value.size };
            //myDropzone.options.addedfile.call(myDropzone, mockFile);

            myDropzone.emit('addedfile', mockFile);
            myDropzone.emit('thumbnail', mockFile, '/img/productos/original/' + value.nombre);
            //myDropzone.emit("success", mockFile);
            myDropzone.emit('complete', mockFile); 

            mockFile.previewTemplate.id = value.id;
            
        });

        myDropzone.on("success", function(file, serverFileName) {

            file.previewTemplate.id = JSON.parse( serverFileName );

        });

        myDropzone.on("queuecomplete", function(file) {
            //location.reload();
        });

        myDropzone.on("removedfile", function(file) {
          var id = file.previewTemplate.id; 
          
          $.ajax({
              type: 'POST',
              url: '/imagenes/delete/'+id,
              data: {id:id},
              dataType: 'json',
              success: function(data){

                  
              }
          });
        });


        $('div.dz-default.dz-message > span').show();
        $('div.dz-default.dz-message').css({'opacity':1, 'background-image': 'none', 'text-align': 'center'});

    });


</script>
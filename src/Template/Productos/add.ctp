<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
 echo $this->Html->script('/js/summernote.min.js'); 
?>
<link rel="stylesheet" type="text/css" href="/css/summernote.css">
       

<div class="page-padding">
  <div class="row">
    <div class="col-lg-12">

      <?= $this->Form->create($producto); ?>
        
        <legend><?= __('Agregar {0}', ['Producto']) ?></legend>
        

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
    $('#url').val(url);

        $.ajax({
            url: '/productos/url_existente',
            type: 'POST',
            dataType: 'html', 
            data:{ url:url },
            })
            .done(function(data) {
              if(data > 0 ){
                alert('URL de producto existente.');
              }
        });

  });

  $('#url').keyup(function (e) {
    var url = $('#url').val();

        $.ajax({
            url: '/productos/url_existente',
            type: 'POST',
            dataType: 'html', 
            data:{ url:url },
            })
            .done(function(data) {
              if(data > 0 ){
                alert('URL de producto existente.');
              }
        });
  });
  
</script>
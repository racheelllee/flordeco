
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<div class="page-padding">
  <div class="row">
    <div class="col-lg-12">



      <?= $this->Form->create($categoria, ['type' => 'file']); ?>
      <legend><?= __('Agregar {0}', ['Categoría']) ?></legend>
            
                
      <div class="row">
        <div class="col-lg-6">
          <?= $this->Form->input('nombre') ?>
        </div>
        
        <div class="col-lg-6">
           <?= $this->Form->input('url') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $this->Form->input('categoria_id', array('options'=>$categorias, 'label'=>'Categoria Padre', 'empty'=>'Categoria Padre')) ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <label class="control-label">Banner Principal</label>
          <?= $this->Form->input('banner',array('type'=>'file', 'label'=>false)) ?>
        </div>
      
        <div class="col-lg-6">
          <label class="control-label">Imagen Fondo</label>
          <?= $this->Form->input('imagen_fondo',array('type'=>'file', 'label'=>false)) ?>
        </div>
      </div>

       <?php echo $this->Tinymce->textarea('descripcion',['type'=>'textarea', 'label'=>false, 'div'=>false, 'style'=>'height:500px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>

    </div>
  </div>

    <?= $this->Form->button(__('Guardar'), ['class'=>'pull-right btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>



<script>

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





        $('#subcategoria').click(function(){
           
            if( $('#subcategoria').is(':checked') ) {
              $( "#subcategoria-id" ).prop( "disabled", false);
              //$( "#imagen-fondo" ).prop( "disabled", false);
              //$( "#banner" ).prop( "disabled", true);
            }else{
              $( "#subcategoria-id" ).prop( "disabled", true);
              //$( "#imagen-fondo" ).prop( "disabled", true);
              //$( "#banner" ).prop( "disabled", false);
            }
      
        });
        //$( "#imagen_fondo" ).prop( "disabled", true);
        
        $('#categoria-id').change(function(){
           
            var selected = $(this).val();
            
            $.ajax({
    
                type: 'POST',
                url: '<?php echo $this->Url->build(["action" => "busqueda_subcategoria"]); ?>',
                data: {selected:selected},
                dataType: 'json',
                success: function(data){
                    
                    
                    $('#subcategoria-id').html('').append('')
                         
                    $.each(data.data, function(k,v){
                            $('#subcategoria-id').append('<option value="'+k+'">'+v+'</option>');          
                    })
                
                    
                }
            });
            
        });

        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
</script>





<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-4">
                            <h2><?php echo __('Edición Masiva'); ?></h2>
                        </div>
                        <div class="ibox-tools col-md-4">
                          

                        </div>
                    </div>
                    <br>
                    <div class="ibox-content">
                        <?php echo $this->element('all_productosmasiva'); ?>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <form id="myForm" action="">
          <fieldset id="myFieldset"> 
          </fieldset>
          </form>    
      </div>
      <div class="modal-footer">
        <button type="button" id="modalButton" class="btn btn-primary" data-dismiss="modal">Editar</button>
      </div>
    </div>
  </div>
</div>

<div id="myFrameModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <iframe id="myIframe" src="" style="zoom:0.60" frameborder="0" height="500" width="99.6%"></iframe>
      </div>
    </div>
  </div>
</div>

<!-- Modales de edición masiva. -->
<div id="marcaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <?php echo $this->Form->input('val_marca_id', ['options' => $marcas,'empty'=>array(''=>'-- Seleccione --')]);?>
                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'marca_id']);?>
      </div>
    </div>
  </div>
</div>


<div id="garantiaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <?php echo $this->Form->input('val_garantia', ['type' => 'text']);?>
                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'garantia']);?>
      </div>
    </div>
  </div>
</div>


<div id="existenciaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->input('val_existencia', ['type' => 'number']);?>                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'existencia']);?>
      </div>
    </div>
  </div>
</div>


<div id="tiempo_de_entregaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
       <?php echo $this->Form->input('val_tiempo_de_entrega', []);?>                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'tiempo_de_entrega']);?>
      </div>
    </div>
  </div>
</div>

<div id="envio_gratisModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
       <?php echo $this->Form->input('val_envio_gratis', ['options' => array(0=>'NO',1=>'SI')]);?>                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'envio_gratis']);?>
      </div>
    </div>
  </div>
</div>


<div id="descripcion_cortaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
      <?php echo $this->Form->input('val_descripcion_corta', ['type' => 'textarea']);?>                   
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'descripcion_corta']);?>
      </div>
    </div>
  </div>
</div>


<div id="frase_pushModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
      <?php //echo $this->Form->input('val_frase_push');?>
      <?php echo $this->Tinymce->textarea('val_frase_push',['type'=>'textarea', 'label'=>'Push', 'div'=>false, 'style'=>'height:100px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>

      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'frase_push']);?>
      </div>
    </div>
  </div>
</div>


<div id="descripcion_largaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
      <?php //echo $this->Form->input('val_descripcion_larga');?>
      <?php echo $this->Tinymce->textarea('val_descripcion_larga',['type'=>'textarea', 'label'=>'Descripción larga', 'div'=>false, 'style'=>'height:100px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>
                         
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'descripcion_larga']);?>
      </div>
    </div>
  </div>
</div>

<div id="meta_keywordsModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->input('val_meta_keywords');?>
                         
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'meta_keywords']);?>
      </div>
    </div>
  </div>
</div>



<div id="estatus_idModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->input('val_estatus_id',['options'=>$estatus]);?>
                         
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva btn btn-primary', 'id'=>'estatus_id']);?>
      </div>
    </div>
  </div>
</div>



<div id="pesoModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        
                      <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <br><br>
                <div class="row">
                  <div class="col-lg-12">
                    Solo introducir numeros enteros (en centímetros).
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('val_largo', ['type'=>'number', 'label'=>'Largo (cm)', 'onchange'=>'calcula_peso_volumetrico_val();']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('val_ancho', ['type'=>'number', 'label'=>'Ancho (cm)', 'onchange'=>'calcula_peso_volumetrico_val();']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('val_alto', ['type'=>'number', 'label'=>'Alto (cm)', 'onchange'=>'calcula_peso_volumetrico_val();']); ?>
                  </div>
                  <div class="col-lg-2">
                    <?php echo $this->Form->input('val_peso', ['type'=>'text', 'label'=>'Peso (kg)']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('val_volumen', ['type'=>'text', 'label'=>'Volumen m3','readonly'=>'readonly']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('val_peso_volumetrico', ['type'=>'text', 'label'=>'Peso Volumetrico','readonly'=>'readonly']); ?>
                  </div>
                </div>
                
              </div>
            </div>   
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_peso btn btn-primary', 'id'=>'estatus_id']);?>
      </div>
    </div>
  </div>
</div>

<div id="categoriaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <?php echo $this->Form->input('val_categoria_id', ['options' => $categorias,'empty'=>array(''=>'-- Seleccione --'),'label'=>'Categorias']);?>
                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_categoria btn btn-primary', 'id'=>'categoria_id']);?>
      </div>
    </div>
  </div>
</div>

<div id="atributosModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
          <?php echo $this->Form->input('val_atributo_1', ['label'=>'Atributo 1']);?>
          <?php echo $this->Form->input('val_atributo_2', ['label'=>'Atributo 2']);?>
          <?php echo $this->Form->input('val_atributo_3', ['label'=>'Atributo 3']);?>
          <?php echo $this->Form->input('val_atributo_4', ['label'=>'Atributo 4']);?>
          <?php echo $this->Form->input('val_atributo_5', ['label'=>'Atributo 5']);?>
                       
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_atributos btn btn-primary', 'id'=>'categoria_id']);?>
      </div>
    </div>
  </div>
</div>

<div id="margenModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->input('val_margen',['type'=>'number', 'label' => 'Margen en porcentaje (%)']);?>
                         
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_margen btn btn-primary', 'id'=>'val_margen']);?>
      </div>
    </div>
  </div>
</div>


<div id="gananciaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->input('val_ganancia',['type'=>'number', 'label' => 'Ganancia en pesos']);?>
                         
      </div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_ganancia btn btn-primary', 'id'=>'val_margen']);?>
      </div>
    </div>
  </div>
</div>

<div id="complementosModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">
        <br>
              <div class="col-lg-4" id="CategoriaRelacionada">
                <?php echo $this->Form->input('val_categoria_relacionada', ['options'=>$categorias,'empty'=>[''=>'-- Seleccione --'],'label'=>'Categroría de Complementos']); ?>
                </div>
                <div class="col-lg-2" id="CategoriaRelacionada">
                <br>
                <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-primary masiva_categoria_relacionada']) ?>
              </div>
            

        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12" id="RelacionadosAllBusqueda">
          </div>
        </div>                   
      </div>
      <div class="modal-footer">
         <?php echo $this->Form->button('Guardar',['class'=>'masiva_complementos btn btn-primary', 'id'=>'val_margen']);?>
      </div>
    </div>
  </div>
</div>




<!-- Terminan modales -->
<script type="text/javascript">
      $(".masiva").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_columna');
  var id_col=$(this).attr("id");
  var id_dash=id_col.replace("_", "-");
  var valor=$("#val-"+id_dash).val();
    if(id_dash.indexOf("descripcion") > -1 || id_dash.indexOf("push") > -1){
        //tinyMCE.activeEditor.getContent({format : 'raw'});
        // Get content of a specific editor:
        valor= tinyMCE.get('val-'+id_dash).getContent({format : 'raw'});
    }
  $("#columna").val(id_col);
  $("#"+id_dash).val(valor);
  $("#productosForm").submit();



});

      $(".masiva_peso").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_peso');
  $("#mlargo").val($("#val-largo").val());
  $("#mancho").val($("#val-ancho").val());
  $("#malto").val($("#val-alto").val());
  $("#mpeso").val($("#val-peso").val());
  $("#mpeso_volumetrico").val($("#val-peso_volumetrico").val());

  $("#productosForm").submit();



});

$(".masiva_categoria").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_categoria');
  $("#categoria-id").val($("#val-categoria-id").val());
  $("#productosForm").submit();



});

$(".masiva_atributos").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_atributos');
  $("#atributo-1").val($("#val-atributo-1").val());
  $("#atributo-2").val($("#val-atributo-2").val());
  $("#atributo-3").val($("#val-atributo-3").val());
  $("#atributo-4").val($("#val-atributo-4").val());
  $("#atributo-5").val($("#val-atributo-5").val());

  $("#productosForm").submit();



});

$(".masiva_complementos").click(function( event ) {
  event.preventDefault();
  var producto_relacionados = new Array();

  $("input[class=check_producto_relacionado]:checked").each(function(){
       producto_relacionados.push($(this).val());  
    });
  
  todos=producto_relacionados.join(',');

  $("#producto-relacionados").val(todos);

  $("#productosForm").attr('action', 'masiva_complementos');
  $("#productosForm").submit();
});



$(".masiva_margen").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_margen');
  $("#margen").val($("#val-margen").val());

  $("#productosForm").submit();



});

$(".masiva_ganancia").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_ganancia');
  $("#ganancia").val($("#val-ganancia").val());

  $("#productosForm").submit();



});

$(".masiva_categoria_relacionada").click(function( event ) {
  event.preventDefault();
  $("#productosForm").attr('action', 'masiva_categoria_relacionada');
  $("#categoria-relacionada").val($("#val-categoria-relacionada").val());

  $("#productosForm").submit();



});
</script>
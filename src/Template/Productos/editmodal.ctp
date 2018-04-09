<!--<script src="/plugins/tinymce/js/tinymce/tinymce.min.js"></script>-->
<div class="row">
<?= $this->Form->create($producto); ?>        
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar </h4>
      </div>
      <div class="modal-body">

            <?= $this->Form->input('id', ['type'=>'hidden']) ?>
            <?php  
              $opciones=[];
              if(preg_match('/_id/', $columna) ){
                $ops=$columna."s";
                $opciones=['options'=>$$ops];
                echo $this->Form->input($columna,$opciones);
              }elseif (preg_match('/desc|push/', $columna)) {
                //echo $this->Form->input($columna,['type'=>'textarea']);

                echo $this->Tinymce->textarea($columna,['type'=>'textarea', 'style'=>'height:100px', 'class'=>'form-control'], ['language'=>'en'], 'umcode');

                $columna_dash=preg_replace('/_/', '-', $columna);
                $this->request->data['editar_'.$columna]=$producto->$columna;
                ?>
                <!-- script>
                //<![CDATA[
                  tinyMCE.init({"theme":"modern","plugins":["advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality","emoticons template paste textcolor jbimages"],"toolbar1":"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages","toolbar2":"print preview media | forecolor backcolor emoticons","image_advtab":true,"templates":[{"title":"Test template 1","content":"Test 1"},{"title":"Test template 2","content":"Test 2"}],"language":"en","selector":"#editar-<?php echo $columna_dash;?>"});
                //]]>
                </script -->
                <?php 
                // echo $this->Tinymce->textarea('editar_'.$columna,['type'=>'textarea', 'label'=>'Descripción larga', 'div'=>false, 'style'=>'height:100px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>
                <?php 
                //echo $this->Tinymce->textarea('editar_'.$columna,['type'=>'textarea', 'div'=>false, 'style'=>'height:300px'], ['language'=>'en'], 'umcode');
              }else{
                echo $this->Form->input($columna);
              }
              ?>
</div>
      <div class="modal-footer">
        
         <?php echo $this->Form->button('Guardar',['class'=>'btn btn-primary']);?>
      </div>
    </div>
  </div>
  <?= $this->Form->end() ?>
  </div>
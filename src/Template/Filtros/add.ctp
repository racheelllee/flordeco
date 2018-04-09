<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
//$this->start('tb_sidebar');
?>


        <form accept-charset="utf-8" id="form_filtro" onsubmit="return false;">    

          <?php
              //echo $this->Form->create(null, ['url' => ['controller' => 'Filtros', 'action' => 'add']]);

              echo $this->Form->input('categoria_id', array('type'=>'hidden', 'value'=>$categoria_id));

          ?>
              <br><br>
              <div class="row" id="filtro">
                <div class="col-lg-4">
          <?php
                  echo $this->Form->input('nombre', array('label'=>'Filtro'));
          ?> 
                </div>
              
                <div class="col-lg-2"> <br>
          <?php  //echo $this->Form->button(__('Agregar')); ?>

          <input type="button" class="btn agregar_filtro" value="Agregar"/>  

                </div>
              </div>
          <?php //echo $this->Form->end(); ?>

        </form>
        
          <hr>

          <?php foreach ($filtros as $filtro) { ?>
            <form accept-charset="utf-8" id="form_Filtro<?php echo $filtro->id;?>" onsubmit="return false;">   
            <div class="row">
                <div class="col-lg-4">
                  <b><?php    
                  echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$filtro->id));
                  echo $this->Form->input('categoria_id', array('type'=>'hidden', 'value'=>$categoria_id));
                        echo $this->Form->input('nombre', array('label'=>'','value'=>$filtro->nombre));

                       ?></b>
                </div>
                <div class="col-lg-4">
                  <b> <?= $this->Html->link('<i class="fa fa-edit"></i>','#filtro',['data-id'=>$filtro->id, 'title' => __('Editar Filtro'), 'escape' => false, 'class'=>'btn btn-primary editar_Filtro']) ?>
                    <?= $this->Html->link('<i class="fa fa-trash"></i>',['controller'=>'filtros','action'=>'delete',$filtro->id,$categoria_id],['data-id'=>$filtro->id, 'title' => __('Eliminar Filtro'), 'escape' => false, 'class'=>'btn btn-primary']) ?></b>
                </div>
            </div>
             </form>
            <div class="row">
                <div class="col-lg-8">
                  <hr>
                </div>
            </div>



            <?php foreach ($filtro->opcionesfiltros as $opcion) { ?>
  <form  id="form_opcionFiltro<?php echo $opcion->id;?>" onsubmit="return false;">   
              <div class="row">
                <div class="col-lg-4">

                  <b> <?php
                         echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$opcion->id));
                
                        echo $this->Form->input('nombre', array('label'=>'','value'=>$opcion->nombre));
                    ?></b>
                </div>
                 <div class="col-lg-2">
                  <?php  echo $this->Form->input('orden', array('label'=>'','value'=>$opcion->orden)); ?>
                 </div>
                <div class="col-lg-4">
 <?= $this->Html->link('<i class="fa fa-edit"></i>','#filtro',['data-id'=>$opcion->id, 'title' => __('Editar Opcion Filtro'), 'escape' => false, 'class'=>'btn btn-primary editar_opcionFiltro']) ?>
                    <?= $this->Html->link('<i class="fa fa-trash"></i>','#filtro',['data-id'=>$opcion->id, 'title' => __('Eliminar Opcion Filtro'), 'escape' => false, 'class'=>'btn btn-primary eliminar_opcionFiltro']) ?>
                    <br><br>
                </div>
            </div>
 </form>
            <?php } ?>

            <div class="row">
                <div class="col-lg-8">
                  <hr>
                </div>
            </div>

            <form accept-charset="utf-8" id="form_opcionFiltro<?php echo $filtro->id;?>" onsubmit="return false;">   
            <?php
                //echo $this->Form->create(null, ['url' => ['controller' => 'Opcionesfiltros', 'action' => 'add']]);

                echo $this->Form->input('filtro_id', array('type'=>'hidden', 'value'=>$filtro->id));
                echo $this->Form->input('orden', array('type'=>'hidden', 'value'=>"0"));
                echo $this->Form->input('categoria_id', array('type'=>'hidden', 'value'=>$categoria_id)); // Redirect
            ?>
              <div class="row">
                  <div class="col-lg-4">
                    <?php
                        echo $this->Form->input('opcion', array('label'=>'Opcion '.$filtro->nombre));
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <br>
                    <?php 

                        echo $this->Html->link('<i class="fa fa-floppy-o"></i>','#filtro',['data-id'=>$filtro->id, 'title' => __('Guarda Opcion Filtro'), 'escape' => false, 'class'=>'btn btn-primary guarda_opcionFiltro']);

                        //echo $this->Form->button(__('Agregar'));
                    ?>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-8">
                  <hr>
                </div>
              </div>
           
            </form>
            
          <?php } ?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
              
                    <div class="col-md-4">
                       
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/fichas/add/<?= $producto_id?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar ficha</a>
                    </div>
       
              
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                                               
                                                          
                                                                <th>Ficha</th>
                                                                <th>Orden</th>
                                                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                              <td>
                                    <a href="<?= FRONT_WWW ?>/files/productos/fichas/<?= h($ficha->producto_id.'_'.$ficha->nombre) ?>" target="_blank"><?= h($ficha->nombre) ?></a>
                            </td>
                            <td>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php 
                                        echo $this->Form->create(null,['class'=>"form-inline"]);
                                            echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$ficha->id));
                                            ?>
                                            <div class="form-group">
                                            <?php echo $this->Form->input('orden', array('type'=>'number', 'label'=>'','value'=>$ficha->orden));
                                            echo $this->Form->button('Guardar',['class'=>"btn btn-default"]);?>
                                            </div>
                                            <?php
                                        echo $this->Form->end();
                                    ?>

                                </div>
                            </td>

                            <td class="actions">
                                  
                                      
                                          <!-- li role="presentation"><?= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', $ficha->id], ['title' => __('Editar'), "escape" => false]) ?></li -->
                                         <?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Eliminar', ['action' => 'delete', $ficha->id], ['confirm' => __('Seguro que quiere borrar # {0}?', $ficha->id), 'title' => __('Eliminar'), "escape" => false]) ?>
                                     
                             
                            </td>
                            </tr>

                                <?php endforeach; ?>
                             </tbody>
</table>
    </div></div></div></div>


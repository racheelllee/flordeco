<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        
          
                <div class="col-lg-12 pull-right">
                    <a href="/imagenes/add/<?= $producto_id?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar Imagen</a>
                </div>
   
                <div class="col-lg-12">
                    <br>
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>        
                                <th>Imagen</th>
                                <th>Orden</th>
                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($imagenes as $imagen): ?>
                            <tr>
                                <td>
                                    <div class="actions" style="width: 200px;">
                                        <img src="/img/productos/original/<?= h($imagen->nombre) ?>" width="100%">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php 
                                            echo $this->Form->create(null,['class'=>"form-inline"]);
                                                echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$imagen->id));
                                                ?>
                                                <div class="form-group">
                                                <?php 
                                                    echo $this->Form->input('orden', array('type'=>'number', 'label'=>'','value'=>$imagen->orden));
                                                    echo $this->Form->button('Guardar',['class'=>'btn btn-default', 'style'=>'margin-left:10px;']);
                                                ?>
                                                </div>
                                                <?php
                                            echo $this->Form->end();
                                        ?>

                                    </div>
                                </td>

                                <td class="actions">
                  
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Eliminar', ['action' => 'delete', $imagen->id], ['confirm' => __('Seguro que quiere borrar la imagen?'), 'title' => __('Eliminar'), "escape" => false]) ?>
                                         
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
</div>


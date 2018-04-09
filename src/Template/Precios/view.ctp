<div class="col-md-12 col-xs-12 col-lg-12" style="text-align:right;">

          <?php if(($producto->largo > 0 AND $producto->ancho > 0 AND $producto->alto > 0 AND $producto->peso > 0) OR $producto->envio > 0){ ?>
           <a  href="/precios/add/<?= $producto->id ?>" data-target="#myModal" class="btn btn-primary pull-right">Agregar Proveedor</a>
          <?php }else{ ?>
            <b>Actualiza completamente los datos de envio para poder agregar un precio.</b> <br><br>
          <?php } ?>

</div>
<div class="row"> 
            <?php setlocale(LC_MONETARY, 'en_US.UTF-8');?>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Proveedor') ?></h4>
            <p><?= $producto->proveedor->nombre; ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Costo') ?></h4>
            <p><?= money_format('%.2n', $producto->costo) ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Margen') ?></h4>
            <p><?= $this->Number->format($producto->margen) ?>%</p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2"> 
            <h4><?= __('Precio') ?></h4>
            <p><?= money_format('%.2n', $producto->precio) ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Actualizacion') ?></h4>
            <p><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></p>
            </div>
          
</div>

<div class="row">
<br>
<br>
<br>
    <div class="col-md-12 col-xs-12 col-lg-12">
        <table id="myTable" width="100%">
            <thead style="border-bottom: 1px solid #888;">
            <th><b>Activo</b></th>
            <th><b>Proveedor</b></th>
            <th><b>Envio Gratis</b></th>
            <th><b>Vendor</b></th>
            <th><b>Margen</b></th>
            <th><b>MSRP</b></th>
            <th><b>Existencia</b></th>
            <th><b>Usuario</b></th>
            <th><b>Actualizacion</b></th>
            <th><b>Acciones</b></th>
            </thead>
            <tbody>
                <?php foreach ($precios as $precio): ?>
                    <tr><td><br></td></tr>
                    <tr>
                    <td><?= $this->Form->checkbox('activo',['value'=>$precio->id,'checked'=>$precio->activo, 'disabled'=>true]);?></td>
                   <td><?= $precio->proveedor->nombre;?></td>
                      <td><?php if ($precio->envio_gratis){echo "Si";}else{echo "No";}?></td>
                    <td>$<?= number_format($precio->costo,2);?></td>
                    <td><?= $precio->margen;?>%</td>
                    <td>$<?= number_format($precio->precio,2);?></td>
                    <td><?= $precio->existencia;?></td>
                    <td><?= $precio->usuario->username;?></td>
                    <td> <?php if(!is_null($precio->modified)){ echo  $precio->modified->i18nFormat('dd-MM-YYYY');}?> </td>
                    <td>

                      <?= $this->Form->postLink('<i class="fa fa-check"></i>', ['action' => 'asignar_proveedor', $precio->id], ['title' => __('Asignar Proveedor'), "escape" => false, 'class'=>'btn btn-primary']) ?>


                      &nbsp;&nbsp;&nbsp;&nbsp;


                      <?= $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $precio->id], ['title' => __('Editar'), "escape" => false, 'class'=>'btn btn-primary']) ?>

                      <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $precio->id, $precio->producto_id], ['confirm' => __('Seguro que quiere borrar # {0}?', $precio->id), 'title' => __('Eliminar'), "escape" => false, 'class'=>'btn btn-primary']) ?>

                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




<!-- Modal generic-->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <?php echo $this->Form->create(null, ['url' => ['controller' => 'preciocompetencias', 'action' => 'add']]); ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Competencia</h4>
      </div>
      <div class="modal-body">
              <?php 
                echo $this->Form->input('producto_id', ['type'=>'hidden', 'value'=>$producto->id]);
                echo $this->Form->input('comptencia_id', ['options'=>$competencias]);
                echo $this->Form->input('precio_competencia', ['label'=>'Precio']);
              ?>


              <?php echo $this->Form->checkbox('envio_gratis_competencia'); ?>
              <label>Envio Gratis</label>
      </div>
      <div class="modal-footer">
        <?= $this->Form->button(__('Agregar'), ['class'=>'btn btn-primary']) ?>
      </div>

      
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>


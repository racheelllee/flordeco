<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
       
                    <div class="col-md-4">
           
        </div>
                    <div class="ibox-tools col-md-4 pull-right">
           <?= $this->Html->link(__('Agregar Proveedor',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
        </div>
        <!-- Inicia element  <?php #echo $this->element('all_Productos Proveedores'); ?> -->
      <div id="updateProductos ProveedoresIndex">

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                   
            <th class="psorting">Proveedor</th>
            <th class="psorting">Costo</th>
            <th class="psorting">Margen</th>
            <th class="psorting">Precio</th>
            <th class="psorting">Activo</th>
            <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($productosProveedores)) {
        
         foreach ($productosProveedores as $productosProveedor): 
                    $i++;
            ?>
             <tr>
                     <td><?= $this->Number->format($productosProveedor->id) ?></td>
            <td>
                <?= $productosProveedor->has('producto') ? $this->Html->link($productosProveedor->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $productosProveedor->producto->id]) : '' ?>
            </td>
            <td>
                <?= $productosProveedor->has('proveedor') ? $this->Html->link($productosProveedor->proveedor->nombre, ['controller' => 'Proveedores', 'action' => 'view', $productosProveedor->proveedor->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($productosProveedor->costo) ?></td>
            <td><?= $this->Number->format($productosProveedor->margen) ?></td>
            <td><?= $this->Number->format($productosProveedor->precio) ?></td>
            <td><?= $this->Number->format($productosProveedor->activo) ?></td>
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                 <li role="presentation"><?= $this->Html->link(__('Ver'), ['action' => 'view', $productosProveedor->id]) ?></li>
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $productosProveedor->id]) ?></li>
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $productosProveedor->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $productosProveedor->id)]) ?></li>
                </ul>
                </div>
                              
            </td>
        </tr>

    <?php endforeach; 

      } else {
            echo "<tr><td colspan=7><br/><br/>".__('No hay proveedores definidos')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    
</div>
<!-- termina element -->

</div>

  <div id="updateProductosIndex">
    <?php echo $this->Search->searchForm('Productos', ['legend'=>false, 'updateDivId'=>'updateProductosIndex']); ?>
    <?php //echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateProductosIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th class="psorting"><?= $this->Paginator->sort('sku', 'Código') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('costo') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('precio_1') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('precio_2') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('precio_3') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('precio_4') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('estatus_id', 'Estatus')?></th>
                <th><?php echo __('Acciones');?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($productos)) {
                $page = $this->request->params['paging']['Productos']['page'];
                $limit = $this->request->params['paging']['Productos']['perPage'];
                $i = ($page-1) * $limit;

         foreach ($productos as $producto): 
                    $i++;
            ?>
             <tr>
                <td><?= h($producto->sku) ?></td>
             
                <td><?= h($producto->nombre) ?></td>
                <td>$<?= number_format($producto->costo,2) ?></td>
                <td>$<?= number_format($producto->precio_1,2) ?></td>
                <td>$<?= number_format($producto->precio_2,2) ?></td>
                <td>$<?= number_format($producto->precio_3,2) ?></td>
                <td>$<?= number_format($producto->precio_4,2) ?></td>

                <td align="center"><p><span class="badge" style="background-color:<?php echo $producto->productos_estatus->color; ?>;"> &nbsp;&nbsp; </span></p></td>

                <td class="actions">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    
                            <li role="presentation"><?= $this->Html->link(__('Editar'), ['action' => 'edit', $producto->id]) ?></li>
                            <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $producto->id], ['confirm' => __('Esta seguro que desea borrar el producto?')]) ?></li>
                             
                             
                        </ul>
                    </div>
                </td>
        </tr>
    <?php endforeach; 

      } else {
            echo "<tr><td colspan=9><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    <?php if(!empty($productos)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>

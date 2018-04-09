 <div id="updateComentariosIndex">
    <?php echo $this->Search->searchForm('Comentarios', ['legend'=>false, 'updateDivId'=>'updateComentariosIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateComentariosIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
             
            <th class="psorting"><?= $this->Paginator->sort('producto_id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('calificacion') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('user_id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('fecha') ?></th>
                  <th class="psorting"><?= $this->Paginator->sort('comentarios') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('autorizado') ?></th>
                    <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($comentarios)) {
                $page = $this->request->params['paging']['Comentarios']['page'];
                $limit = $this->request->params['paging']['Comentarios']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($comentarios as $comentario): 
                    $i++;
            ?>
      <td>
                <?= $comentario->has('producto') ? $this->Html->link($comentario->producto->codigo_fabricante, ['controller' => 'Productos', 'action' => 'edit', $comentario->producto->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($comentario->calificacion) ?></td>
            <td>
                <?= $comentario->has('usuario') ? $comentario->usuario->email : '' ?>
            </td>
            <td><?= h($comentario->fecha) ?></td>
            <td><?= h($comentario->comentarios) ?></td>
            <td><?= h($sino[$comentario->autorizado]) ?></td>
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
               
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $comentario->id]) ?></li>
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $comentario->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $comentario->id)]) ?></li>
                </ul>
                </div>
                              
            </td>
        </tr>

    <?php endforeach; 

      } else {
            echo "<tr><td colspan=7><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    <?php if(!empty($comentarios)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>
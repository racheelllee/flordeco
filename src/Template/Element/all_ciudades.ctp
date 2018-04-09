  <div id="updateCiudadesIndex">
    <?php echo $this->Search->searchForm('Ciudades', ['legend'=>false, 'updateDivId'=>'updateCiudadesIndex']); ?>
    <?php //echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateProductosIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('nombre', __('Nombre')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('url', __('Url')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('estado_id', __('Estado')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('ciudad_status_id', __('Ciudad Status')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('rango_precio_id', __('Rango Precio')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('costo_envio', __('Costo Envio')) ?></th>
                <th scope="col" class="psorting"><?= $this->Paginator->sort('orden', __('Orden')) ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($ciudades)) {
                $page = $this->request->params['paging']['Ciudades']['page'];
                $limit = $this->request->params['paging']['Ciudades']['perPage'];
                $i = ($page-1) * $limit;

         foreach ($ciudades as $ciudad): 
                    $i++;
            ?>
             
                  <tr>
                    <td><?= h($ciudad->nombre) ?></td>
                    <td><?= h($ciudad->url) ?></td>
                    <td><?= $ciudad->estado->nombre ?></td>
                    <td><?= $ciudad->ciudad_status->nombre ?></td>
                    <td><?= $tipoPrecios[$ciudad->precio] ?></td>
                    <td>$<?= number_format($ciudad->costo_envio, 2) ?></td>
                    <td><?= $ciudad->orden ?></td>
                        <td class="actions">
                          <div class='btn-group'>
                            <button class='btn btn-primary dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' aria-expanded='false'>
                                <?= __('Acciones') ?>
                                <span class='caret'></span>
                            </button>
                              <ul class='dropdown-menu pull-right'>
                                  <li>
                                      <a 
                                          href="/ciudades/edit/<?= $ciudad->id ?>" 
                                          data-remote="false" 
                                          data-toggle="modal" 
                                          data-target="#ciudadesModal">
                                          <?= __('Editar Ciudad') ?>
                                      </a>
                                  </li>
                                  <li>
                                      <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $ciudad->id], ['confirm' => __('¿Realmente deseas borrar la ciudad {0}?', $ciudad->nombre)]) ?>
                                  </li>
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
    <?php if(!empty($ciudades)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>

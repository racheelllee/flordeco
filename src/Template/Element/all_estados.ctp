


                     <div id="updateCategoriasIndex">
    <?php echo $this->Search->searchForm('Estados', ['legend'=>false, 'updateDivId'=>'updateCategoriasIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateCategoriasIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                     <th class="psorting"><?= $this->Paginator->sort('id') ?></th>
         
            <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
       
          

                    <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($estados)) {
                $page = $this->request->params['paging']['Estados']['page'];
                $limit = $this->request->params['paging']['Estados']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($estados as $estado): 
                    $i++;
              

            ?>
             <tr>
            <td><?= $this->Number->format($estado->id) ?></td>
            <td><?= h($estado->nombre) ?></td>
            
       
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                 
                 <!--<li role="presentation"><?= $this->Html->link(__('Ver'), ['action' => 'view', $categoria->id]) ?></li>-->
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $estado->id]) ?></li>
        
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $estado->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $estado->id)]) ?></li>
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
    <?php if(!empty($estado)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__(' Total')]);
    } ?>
</div>




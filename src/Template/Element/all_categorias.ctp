 <div id="updateCategoriasIndex">
    <?php echo $this->Search->searchForm('Categorias', ['legend'=>false, 'updateDivId'=>'updateCategoriasIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateCategoriasIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                     <th class="psorting"><?= $this->Paginator->sort('id') ?></th>
         
            <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
       
            <th class="psorting"><?= $this->Paginator->sort('url') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('categoria_id','Padre') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('orden') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('publicado') ?></th>

                    <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($categorias)) {
                $page = $this->request->params['paging']['Categorias']['page'];
                $limit = $this->request->params['paging']['Categorias']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($categorias as $categoria): 
                    $i++;
              

            ?>
             <tr>
            <td><?= $this->Number->format($categoria->id) ?></td>
            <td><?= h($categoria->nombre) ?></td>
            <td><?= h($categoria->url) ?></td>
            <td><?= h($categoriaslista[$categoria->categoria_id]) ?></td>
            <td>

                <form method="post" accept-charset="utf-8" id="form_Categoria" action="/categorias/edit/<?= $categoria->id?>/1">   
           
                  <b> 

                  <?php    
                  echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$categoria->id));
                     ?>
                  <div class="row">
          
                    <div class="col-lg-6"><?php 
                      echo $this->Form->input('orden', array('label'=>'','value'=>$categoria->orden));
                      ?>
                      </div>
                  
                    <div class="col-lg-6">

                      <?php
                      echo $this->Form->button('<i class="fa fa-save"></i>');
                      echo $this->Form->end();
                      ?></div>
                  </div>
              </td>
              <td align="center"><p><span class="badge" style="background-color:<?= ($categoria->publicado)? '#1ab394' : '#ed5565' ?>;"> &nbsp;&nbsp; </span></p></td>
       
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                 
                 <!--<li role="presentation"><?= $this->Html->link(__('Ver'), ['action' => 'view', $categoria->id]) ?></li>-->
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $categoria->id]) ?></li>
        
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $categoria->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $categoria->id)]) ?></li>
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
    <?php if(!empty($categorias)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>

 <div id="updateBannersIndex">
    <?php echo $this->Search->searchForm('Banners', ['legend'=>false, 'updateDivId'=>'updateBannersIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateBannersIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th class="psorting"><?= $this->Paginator->sort('id') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
                <th> Principal </th>
                <th style="text-align: center;"> Imagen </th>
                <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($banners)) {
                $page = $this->request->params['paging']['Banners']['page'];
                $limit = $this->request->params['paging']['Banners']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($banners as $banner): 
                    $i++;
            ?>
             <tr>
                     <td><?= $this->Number->format($banner->id) ?></td>
            <td><?= h($banner->nombre) ?></td>
            <td> <?= ($banner->principal == 1 )? "Banner Principal":"Banner Slider" ?>  </td>
            <td align="center"> 
                <?php if (!empty($banner->imagen)): ?>
                    <a href="/<?php echo $banner->imagen ?>" target="_blank"> <i class="fa fa-picture-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </td>
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" style="right:2px;left:0px;" role="menu" aria-labelledby="menu1">
                <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $banner->id]) ?></li>

                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $banner->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $banner->id)]) ?></li>
             
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
    <?php if(!empty($banners)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>
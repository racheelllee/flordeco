<div id="updatePromocionesIndex">
    <?php echo $this->Search->searchForm('Promociones', ['legend'=>false, 'updateDivId'=>'updatePromocionesIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updatePromocionesIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                     <th class="psorting"><?= $this->Paginator->sort('id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('fecha_inicio') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('fecha_fin') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('monto') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('descuento') ?></th>
           
                    <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($promociones)) {
                $page = $this->request->params['paging']['Promociones']['page'];
                $limit = $this->request->params['paging']['Promociones']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($promociones as $promocion): 
                    $i++;
            ?>
             <tr>
                     <td><?= $this->Number->format($promocion->id) ?></td>
            <td><?= h($promocion->nombre) ?></td>
            <td><?= h($promocion->fecha_inicio->i18nFormat('dd-MM-YYYY')) ?></td>
            <td><?= h($promocion->fecha_fin->i18nFormat('dd-MM-YYYY')) ?></td>
            <td><?= $this->Number->format($promocion->monto) ?></td>
            <td><?= $this->Number->format($promocion->descuento) ?></td>
            
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $promocion->id]) ?></li>
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $promocion->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $promocion->id)]) ?></li>
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
    <?php if(!empty($promociones)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
    <script>
    $('#datepicker1').datepicker({
        "setDate": new Date(),
        "format": 'yyyy-mm-dd',
        "autoclose": true
        });

        $('#datepicker2').datepicker({
        "setDate": new Date(),
        "format": 'yyyy-mm-dd',
        "autoclose": true
        }); 
        $('#datepicker_pago').datepicker({
            "setDate": new Date(),
            "autoclose": true
        });
        $('#datepicker_pago').datepicker('update');
        $('#datepicker1').change(function (){
            $('#facturas-fecha').val($('#datepicker1').val());
            //alert($('#facturas-fecha').val());

        })

        $('#datepicker1').val('<?php echo $fecha_inicio; ?>');
        $('#datepicker2').val('<?php echo $fecha_fin; ?>');

</script>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
            <h2><?php echo __('Recordatorios'); ?></h2>
        </div>
                    <!-- <div class="ibox-tools col-md-4 pull-right">
           <?= $this->Html->link(__('Agregar Recordatorio',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
        </div> -->
                </div>
    <div class="ibox-content">
        <!-- Inicia element  <?php #echo $this->element('all_Recordatorios'); ?> -->
      <div id="updateRecordatoriosIndex">
    <?php echo $this->Search->searchForm('Recordatorios', ['legend'=>false, 'updateDivId'=>'updateRecordatoriosIndex']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateRecordatoriosIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                     <th class="psorting"><?= $this->Paginator->sort('id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('pedido_id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('cliente_id') ?></th>
            <th class="psorting"><?= $this->Paginator->sort('Fecha') ?></th>
                    <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($recordatorios)) {
                $page = $this->request->params['paging']['Recordatorios']['page'];
                $limit = $this->request->params['paging']['Recordatorios']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($recordatorios as $recordatorio):
                    $i++;
            ?>
             <tr>
                     <td><?= $this->Number->format($recordatorio->id) ?></td>
            <td>
                <?= $recordatorio->has('pedido') ? $this->Html->link($recordatorio->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $recordatorio->pedido->id]) : '' ?>
            </td>
            <td>
                <?= $recordatorio->has('cliente') ? $this->Html->link($recordatorio->cliente->first_name.' '.$recordatorio->cliente->last_name, ['controller' => 'Clientes', 'action' => 'view', $recordatorio->cliente->id]) : '' ?>
            </td>
            <td>
              <?= date('d-m-Y', strtotime($recordatorio['created']->format('Y-m-d'))); ?>
            </td>
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                 <li role="presentation"><?= $this->Html->link(__('Ver'), ['action' => 'view', $recordatorio->id]) ?></li>
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', $recordatorio->id]) ?></li>
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $recordatorio->id], ['confirm' => __('Esta seguro que desea borrar # {0}?', $recordatorio->id)]) ?></li>
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
    <?php if(!empty($recordatorios)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>
<!-- termina element -->
</div>
</div>

<script type="text/javascript">
    $('#recordatorios-created').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });
</script>

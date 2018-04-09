<div class="row">
    <div class="col-xs-6 w-title w-color666">
      <span style="position: absolute; margin-top:30px;"><?php echo __('List of Offices');?></span>
    </div>
    <div class="col-xs-6">
        <button class="btn btn-default w-AvenirLight w-btnNewUsers" data-toggle="modal" data-target="#officesModal">
            +  <?= __('New Office') ?>
        </button>
    </div>
</div>
<div class="table-reponsive" style="margin-top:30px;">
    <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight" id="OfficesTable" width="100%" data-page-length='50' data-order='[[ 1, "asc" ]]'>
        <thead>
            <tr>
                <th style="min-width: 120px;"><?= $this->Paginator->sort('name', __('Name')); ?></th>
                <th><?= $this->Paginator->sort('street', __('Street')); ?></th>
                <th><?= $this->Paginator->sort('number',  __('Number')) ?></th>
                <th><?= $this->Paginator->sort('colony',  __('Colony')) ?></th>
                <th style="min-width: 120px;"><?= $this->Paginator->sort('Municipalities.name', __('Municipality')) ?></th>
                <th style="min-width: 120px;"><?= $this->Paginator->sort('States.name', __('State')) ?></th>
                <th><?= $this->Paginator->sort('postal_code', __('Postal code')) ?></th>
                <th style="min-width: 120px;"><?= $this->Paginator->sort('phone',  __('Phone')) ?></th>
                <th style="min-width: 120px;"><?= $this->Paginator->sort('email',  __('Email')) ?></th>
                <th><?= $this->Paginator->sort('opening_year', __('Año de apertura')) ?></th>
                
                <th style="min-width: 120px;" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offices as $office): ?>
            <tr>
                <td data-priority="1"><?= h($office->name) ?></td>
                <td><?= h($office->street) ?></td>
                <td><?= $office->number ?></td>
                <td><?= h($office->colony) ?></td>
                <td data-priority="1"><?= $office->municipality->name ?></td>
                <td data-priority="1"><?= $office->state->name ?></td>
                <td><?= h($office->postal_code) ?></td>
                <td data-priority="1"><?= h($office->phone) ?></td>
                <td data-priority="1"><?= h($office->email) ?></td>
                <td><?= h($office->opening_year) ?></td>
                

                <td class="actions" align="center">
                    <div class='btn-group'>
                        <button 
                                class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' 
                                aria-expanded='false'>
                            <?= __('Actions') ?>
                            <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu pull-right'>
                            <li>
                                <a 
                                    href="/offices/officeeditform/<?= $office->id ?>" 
                                    data-remote="false" 
                                    data-toggle="modal" 
                                    data-target="#officesModal<?= $office->id ?>">
                                    <?= __('Edit Office') ?>
                                </a>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Delete Office'), ['action' => 'delete', $office->id], ['confirm' => __('¿Estas seguro de querer borrar esta sucursal?')]) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('simple_pagination') ?><div class="clearfix"></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#OfficesTable').DataTable( {
            responsive: true,
            bSort: false,
            bPaginate: false,
            columnDefs: [
                { responsivePriority: 2, targets: 0 },
                { responsivePriority: 2, targets: 4 },
                { responsivePriority: 2, targets: 5 },
                { responsivePriority: 2, targets: 7 },
                { responsivePriority: 2, targets: 8 },
                { responsivePriority: 1, targets: -1 },
            ], 
            oLanguage: {
                sInfo: 'Mostrando resultados _START_ al _END_ de _TOTAL_.',
                sInfoEmpty: 'No hay registros para mostrar',
                sInfoFiltered: "(filtrado de _MAX_ registros)",
                sSearch: "Buscar:",
                sSelect: "Limit",
                sZeroRecords: "No se encontro ningún registro",
                sPaginate: {
                    sFirst: "Primero",
                    sPrevious: "Anterior",
                    sPnext: "Siguiente",
                    sLast: "último"
                }
            }
        });
    });
</script>
<?php
    echo $this->element('add_office_modal');
    foreach ($offices as $office) {
        echo $this->element('edit_office_modal', compact('office'));
    }
?>
<script type="text/javascript" src="/js/paises.js"></script>
<style type="text/css">
    .dataTables_info{
        display: none;
    }
</style>
<div class="ibox-title" style="height:70px;">
    <div class="col-md-4">
        <h2>Sucursales</h2>
    </div>
    <div class="ibox-tools col-md-4 pull-right">
        <a href="/sucursales/add" class="btn btn-primary pull-right"><?= __('Nueva sucursal') ?></a>
    </div>
</div>
<div class="table-reponsive sucursales" style="margin-top:10px;">
    <table id="sucursalesTable" class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre', __('Nombre')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado_id', __('Estado')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('municipio_id', __('Municipio')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sucursales as $sucursale): ?>
            <tr>
            <td><?= h($sucursale->nombre) ?></td>
            <td><?= $sucursale->estado->nombre ?></td>
            <td><?= $sucursale->municipio->nombre ?></td>
                <td class="actions">
                    <div class='btn-group'>
                        <ul>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/sucursales/edit/<?= $sucursale->id ?>">
                                            <?= __('Editar Sucursal') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $sucursale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sucursale->id)]) ?>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('Usermgmt.pagination', ['paginationText'=>__('Sucursales: ')]); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#sucursalesTable').DataTable({
            responsive: true,
            searching: false,
            bSort: false,
            bPaginate: false,
            columnDefs: [
                { responsivePriority: 1, targets: -1 },
            ]
        });
    });
</script>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Agregar Pais'), ['action' => 'add']); ?></li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => ' Clientes', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => ' Direcciones', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => ' Estados', 'action' => 'add']); ?></li>
                </ul>
<?php $this->end(); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
                        <h2> Paises</h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/paises/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar Pais</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                                                <th>id</th>
                                                                <th>nombre</th>
                                                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($paises as $pais): ?>
                            <tr>
                                                                <td><?= $this->Number->format($pais->id) ?></td>
                                                                            <td><?= h($pais->nombre) ?></td>
                                                                            <td class="actions">
                                    <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><?= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', $pais->id], ['title' => __('Editar'), "escape" => false]) ?></li>
                                          <li role="presentation"><?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Borrar', ['action' => 'delete', $pais->id], ['confirm' => __('Seguro que quiere borrar # {0}?', $pais->id), 'title' => __('Delete'), "escape" => false]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                                <?php endforeach; ?>
                             </tbody>
</table>
    </div></div></div></div></div>


<script type="text/javascript">
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "lengthChange": false,
                 "footerCallback": function( tfoot, data, start, end, display ) {
                    $(tfoot).html( "" );
                }
            });
        });

</script>
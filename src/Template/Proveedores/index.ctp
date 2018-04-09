<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Agregar Proveedor'), ['action' => 'add']); ?></li>
        <li><?= $this->Html->link(__('Listar Precios'), ['controller' => 'Precios', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Precio'), ['controller' => ' Precios', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => ' Productos', 'action' => 'add']); ?></li>
                </ul>
<?php $this->end(); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="height:70px;">
                    <div class="col-md-4">
                        <h2>Proveedores</h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/proveedores/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar Proveedor</a>
                    </div>
                </div>
                <br>
                <div class="ibox-content">
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                                                <th>Id</th>
                                                                <th>Nombre</th>
                                                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <tr>
                                                                <td style="width:5%;"><?= $this->Number->format($proveedor->id) ?></td>
                                                                            <td><?= h($proveedor->nombre) ?></td>
                                                                            <td class="actions" style="width:5%;">
                                    <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><?= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', $proveedor->id], ['title' => __('Editar'), "escape" => false]) ?></li>
                                          <li role="presentation"><?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Borrar', ['action' => 'delete', $proveedor->id], ['confirm' => __('Seguro que quiere borrar # {0}?', $proveedor->id), 'title' => __('Delete'), "escape" => false]) ?></li>
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
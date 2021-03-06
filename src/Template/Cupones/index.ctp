<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
                        <h2> Cupones</h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/cupones/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar Cupón</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                                                <th>Id</th>
                                                                <th>Nombre</th>
                                                                <th>Código</th>
                                                                <th>Cliente</th>
                                                                <th>Monto</th>
                                                                <th>Porcentaje</th>
                                                                <th>Fecha_inicio</th>
                                                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cupones as $cupon): ?>
                            <tr>
                                <td><?= $this->Number->format($cupon->id) ?></td>
                                            <td><?= h($cupon->nombre) ?></td>
                                            <td><?= h($cupon->codigo) ?></td>
                                                                                            <td>
                                                    <?= $cupon->has('cliente') ? $this->Html->link($cupon->cliente->nombre, ['controller' => 'Clientes', 'action' => 'view', $cupon->cliente->id]) : '' ?>
                                                </td>
                                                            <td><?= $this->Number->format($cupon->monto) ?></td>
                                                        <td><?= $this->Number->format($cupon->porcentaje) ?></td>
                                                        <td><?= h($cupon->fecha_inicio) ?></td>
                                                        <td class="actions">
                <div class="dropdown">
                   <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><?= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', $cupon->id], ['title' => __('Editar'), "escape" => false]) ?></li>
                                          <li role="presentation"><?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Borrar', ['action' => 'delete', $cupon->id], ['confirm' => __('Seguro que quiere borrar el cupón # {0}?', $cupon->id), 'title' => __('Delete'), "escape" => false]) ?></li>
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
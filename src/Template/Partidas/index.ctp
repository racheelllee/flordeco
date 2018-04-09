<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Agregar Partida'), ['action' => 'add']); ?></li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => ' Pedidos', 'action' => 'add']); ?></li>
                </ul>
<?php $this->end(); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
                        <h2> Partidas</h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/partidas/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar Partida</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                                                <th>id</th>
                                                                <th>pedido_id</th>
                                                                <th>cantidad</th>
                                                                <th>sku</th>
                                                                <th>codigo_fabricante</th>
                                                                <th>producto</th>
                                                                <th>atributos</th>
                                                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($partidas as $partida): ?>
                            <tr>
                                                                <td><?= $this->Number->format($partida->id) ?></td>
                                                                                            <td>
                                                    <?= $partida->has('pedido') ? $this->Html->link($partida->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $partida->pedido->id]) : '' ?>
                                                </td>
                                                                                <td><?= $this->Number->format($partida->cantidad) ?></td>
                                                                            <td><?= h($partida->sku) ?></td>
                                                                            <td><?= h($partida->codigo_fabricante) ?></td>
                                                                            <td><?= h($partida->producto) ?></td>
                                                                            <td><?= h($partida->atributos) ?></td>
                                                                            <td class="actions">
                                    <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><?= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', $partida->id], ['title' => __('Editar'), "escape" => false]) ?></li>
                                          <li role="presentation"><?= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Borrar', ['action' => 'delete', $partida->id], ['confirm' => __('Seguro que quiere borrar # {0}?', $partida->id), 'title' => __('Delete'), "escape" => false]) ?></li>
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
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Agregar Estado'), ['action' => 'add']); ?></li>
        <li><?= $this->Html->link(__('Listar Paises'), ['controller' => 'Paises', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Pais'), ['controller' => ' Paises', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => ' Clientes', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => ' Direcciones', 'action' => 'add']); ?></li>
                    <li><?= $this->Html->link(__('Listar Municipios'), ['controller' => 'Municipios', 'action' => 'index']); ?></li>
                <li><?= $this->Html->link(__('Agregar Municipio'), ['controller' => ' Municipios', 'action' => 'add']); ?></li>
                </ul>
<?php $this->end(); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
                        <h2> Estados</h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/estados/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar Estado</a>
                    </div>
                </div>
                <div class="ibox-content">
                   


                    <?php echo $this->element('all_estados') ?>





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
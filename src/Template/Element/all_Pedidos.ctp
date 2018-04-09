<div id="updatePedidosIndex">
    <?php echo $this->Search->searchForm('Pedidos', ['legend'=>false, 'updateDivId'=>'updatePedidosIndex']); ?>
    <?php //echo $this->element('Usermgmt.paginator', ['updateDivId'=>'updatePedidosIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
     <!-- table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" -->
        <thead>
            <tr>
            	<th class="">&nbsp;</th>
                <th class="" style="text-align:center;"><?= $this->Paginator->sort('id', __('No')) ?></th>
                <th class="" style="text-align:center;"><?= $this->Paginator->sort('fecha', __('Fecha')) ?></th>
                <th class=""><?= $this->Paginator->sort('nombre_cliente', __('Cliente')) ?></th>
                <th class=""><?= $this->Paginator->sort('ciudad', __('Ciudad')) ?></th>
                <th class="" style="text-align:center;"><?= $this->Paginator->sort('monto', __('Monto')) ?></th>
                <th class=""><?= $this->Paginator->sort('forma_pago_id', __('Forma de Pago')) ?></th>
                <th class=""><?= $this->Paginator->sort('estatus_id', __('Estatus')) ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($pedidos)) {
                $page = $this->request->params['paging']['Pedidos']['page'];
                $limit = $this->request->params['paging']['Pedidos']['perPage'];
                $i = ($page-1) * $limit;
                //$ban = true;
                foreach($pedidos as $row) {
                    //if ($ban) { var_dump($row); $ban = false; }
                    $i++;
                    echo "<tr>";
                        echo '<td style="text-align: center;">'.
                        		(($row['arreglo_funeral']) ? '<i class="fa fa-exclamation-triangle"></i>' : '').
                        	 '</td>';
                        echo "<td style='text-align: right;'>".$this->Html->link($row['id'], ['action' => 'view', $row['id']], ['title' => __('Ver'), "escape" => false, 'style' => ''])."</td>";
                        echo "<td style='text-align: center;'>".date('d-m-Y', strtotime($row['fecha']->format('Y-m-d')))."</td>";
                        echo "<td>".h($row['nombre_cliente'])."</td>";
                        echo "<td>".h($row['zona']['nombre'])."</td>";
                        echo "<td style='text-align: right;'>$".number_format($row['monto'],2)."</td>";
                        echo "<td>".h($row['formasdepago']['nombre'])."</td>";
                        echo "<td>".h($row['estatus']['nombre'])."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=10><br/><br/>".__d('usermgmt', 'No Records Available')."</td></tr>";
            } ?>
        </tbody>
    </table>
    <?php if(!empty($pedidos)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__d('usermgmt', 'Pedidos')]);
    }?>
</div>
<script type="text/javascript">
    $('#pedidos-fecha').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"

    });
</script>
<!-- script type="text/javascript">
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

</script -->
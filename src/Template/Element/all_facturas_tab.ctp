<?php if(!empty($facturas)) { ?>
<div class="table-reponsive">
  <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight" id="FacturasTable" width="100%" data-page-length='50' data-order='[[ 0, "desc" ]]'>
    <thead>
      <tr>
        <th class="sorting" style="min-width:100px;"> <?= __('Numero'); ?> </th>
        <th class="sorting"> <?= __('Cargo'); ?> </th>
        <th class="sorting"> <?= __('Cotización'); ?> </th>
        <th class="sorting" style="min-width:100px;"> <?= __('Importe'); ?> </th>
        <th class="sorting"> <?= __('Moneda'); ?> </th>
        <th class="sorting"> <?= __('Registro'); ?> </th>
        <th><?= __('Action'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php 
        
        foreach($facturas as $factura) {
          
          if ($factura->por_ajuste) {
            echo "<tr style='background-color:#f5ffbb'>";
          } else {
            echo "<tr>";
          }
            
            echo "<td>".$factura->no_factura."</td>";
            echo "<td>".$factura->cargo->numero."</td>";
            echo "<td>".sprintf('%06d', $factura->cotizacion_id)."</td>";
            echo "<td> $".number_format($factura->importe, 2)."</td>";
            echo "<td>".$factura->moneda->name."</td>";
            echo "<td>".$factura->created->format('d/m/Y')."</td>";

            echo "<td align='center'><div class='btn-group'>";

              if(!empty($factura->archivo)):
                echo $this->Html->link('<i class="fa fa-download fa6" aria-hidden="true"></i>', '/'.$factura->archivo, ['escape' => false, 'style' => 'margin-right: 10px; color: #519dd4', 'target' => '_blank']);
              elseif(empty($factura->archivo)):
                echo '<i class="fa fa-download fa6" aria-hidden="true" style="margin-right: 10px; color: #c75f5a"></i>';
              endif;

              echo $this->Html->link('<i class="fa fa-pencil-square-o fa6" aria-hidden="true"></i>', '/facturas/edit/'.$factura->id.'/'.$factura->customer_id, ['escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modalURL', 'style'=>'margin-right: 10px;']);

              echo $this->Form->postLink(
                    $this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa6', 'style' => 'margin-right: 10px; color: #519dd4')),
                    [
                        'controller' => 'facturas',
                        'plugin' => false,
                        'action' => 'delete',
                        $factura->id,
                        $factura->customer_id
                    ], 
                    [
                        'escape' => false,
                        'confirm' => __('¿Estas seguro de querer borrar esta factura?')
                    ]);

            echo "</div></td>";
          
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>
<?php 
} else {
  echo "<tr><td colspan=10><br/><br/>".__('No Records Available')."</td></tr>";
} 
?>
<script type="text/javascript">
$(document).ready(function(){
  $('#FacturasTable').DataTable( {
      responsive: true,
      ordering: true,
      columnDefs: [
          { responsivePriority: 1, targets: 0 },
          { responsivePriority: 2, targets: -1 }
      ], "oLanguage": {
          "sInfo": 'Mostrando resultados _START_ al _END_ de _TOTAL_.',
          "sInfoEmpty": 'No hay registros para mostrar',
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Buscar:",
          "sSelect": "Limit",
          "sZeroRecords": "No se encontro ningún registro",
          "sPaginate": {
              "sFirst": "Primero",
              "sPrevious": "Anterior",
              "sPnext": "Siguiente",
              "sLast": "último"
          }
      }
  });
});
</script>
<style type="text/css">

    .lbl{
        font-size: 12px;
        border: none;
    }
    .container {padding:20px;}
    .popover {max-width:550px;}
    .status{ margin-top: 5px; margin-bottom: 5px; }
</style>
<div id="updateCotizacionesIndex">

    <div class="table-reponsive">
        
        <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight" id="<?=$name?>" width="100%" data-page-length='50' data-order='[[ 0, "desc" ]]'>
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 110px"><?= __('Número') ?></th>
                        <th scope="col"><?= __('Fecha') ?></th>
                        <th scope="col"><?= __('Monto') ?></th>
                        <th scope="col"><?= __('Coin') ?></th>
                        <th scope="col" style="text-align: center;"><?= __('Type') ?></th>
                        <th scope="col" style="text-align: center;"><?= __('Status') ?></th>
                        <th scope="col"><?= __('No. de Cargo') ?></th>
                        <th scope="col"><?= __('Supervisor Responsable') ?></th>
                        <th scope="col" class="actions" style="text-align: center;"><?= __('Actions') ?></th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach ($quote as $row): ?>
                <tr>
                    <td><?= $row->numero_cotizacion ?></td>

                    <td><?= $this->Time->format($row->fecha_registro, 'dd/MM/YYYY') ?></td>
                   
                    <td>$<?= number_format($row->monto_total, 2) ?></td>

                    <td><?= $row->moneda->name ?></td>

                    <td align="center">
                      <?php if ($row->from_interaction): ?>
                        <span style="background-color: #79af5d;" class="btn lbl btn-primary btn-xs">P</span>
                      <?php else: ?>
                        <span style="background-color: #4f8fc6;" class="btn lbl btn-primary btn-xs">D</span>
                      <?php endif ?>
                    </td>
                     <td align="center">
                        <a href="/cotizaciones/change-status/<?= $row->id ?>" data-remote="false" data-toggle="modal" data-target="#genericModal">
                            <button class="btn lbl btn-primary btn-xs" style="background-color: <?= $row->cotizaciones_estatus->color ?>">
                                <?= $row->cotizaciones_estatus->nombre ?>
                            </button>
                        </a>
                    </td>
                    <td><?= $row->cargo ? $row->cargo->numero : '' ?></td> <!-- Cargo -->
                    <td><?= $row->has('cargo') ? $row->cargo->user->first_name.' '.$row->cargo->user->last_name.' '.$row->cargo->user->clast_name : '' ?></td> <!-- Supervisor -->
                    <td align="center" class="actions">
                        <div class='btn-group'>

                            <button 
                                style="border: none;" 
                                class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' 
                                aria-expanded='false'>
                                <i class="fa fa-ellipsis-h fa6" aria-hidden="true" style="font-size: large;"></i>
                            </button>
                            <ul class='dropdown-menu pull-right'>
                                <?php 


                                echo '<li>';
                                    echo $this->Html->link('<i class="fa fa-eye fa6" aria-hidden="true"></i> Ver Cotización', '/cotizaciones/view/'.$row->id.'/'.$customer->id, ['escape' => false]);
                                echo '</li>';


                                
                                    echo '<li>';
                                        echo $this->Html->link('<i class="fa fa-pencil-square-o fa6" aria-hidden="true"></i> Editar Cotización', '/cotizaciones/edit/'.$row->id.'/'.$customer->id, ['escape' => false]);
                                    echo '</li>';
                                    if($row->status_id != 7 && $row->status_id != 8){
                                    echo '<li>';
                                        echo $this->Html->link('<i class="fa fa-copy fa6" aria-hidden="true"></i> Nueva revisión', '/cotizaciones/add/'.$customer->id.'/0/'.$row->id, ['escape' => false]);
                                    echo '</li>';

                                }


                                if(($row->status_id == 7 || $row->status_id == 8) && $row->cargo_id){ 
                                    echo '<li>';
                                        echo $this->Html->link('
                                              <span class="fa-stack" style="padding-top:2px;">
                                                <i class="fa fa-file-text-o fa-stack-1x"></i>
                                                <i class="fa fa-plus" style="margin-left: -10px;"></i>
                                              </span> Agregar Factura
                                        ', '/facturas/add/'.$row->id.'/'.$customer->id, ['escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modalURL']);
                                    echo '</li>';

                                    echo '<li>';
                                        echo $this->Html->link('<i class="fa fa-list fa6"></i> Ver Facturas
                                        ', '/cotizaciones/cotizacion_facturas/'.$row->id, ['escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modalURL']);
                                    echo '</li>';
                                }

                                if(!empty($row->archivo)):
                                    echo '<li>';
                                        echo $this->Html->link('<i class="fa fa-download fa6" aria-hidden="true"></i> Descargar Archivo', '/files/cotizaciones/'.$row->archivo.'', ['escape' => false, 'target' => '_blank']);
                                    echo '</li>';
                                endif;

                                

                                echo '<li>';
                                    echo $this->Form->postLink(
                                        '<i class="fa fa-trash-o fa6" aria-hidden="true"></i> Borrar Cotización',
                                        [
                                            'controller' => 'cotizaciones',
                                            'plugin' => false,
                                            'action' => 'delete',
                                            $row->id
                                        ], 
                                        [
                                            'escape' => false,
                                            'confirm' => __('¿Estas seguro de querer borrar esta cotización?')
                                        ]
                                    );
                                echo '</li>';
                                ?>

                            </ul>

                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        if ( $.fn.dataTable.isDataTable( '#<?=$name?>' ) ) {
            table = $('#<?=$name?>').DataTable();
        }
        else {
            table = $('#<?=$name?>').DataTable( {
                paging: true,
                searching: false,
                columnDefs: [ 
                    { responsivePriority: 2, targets: -1 },
                    { targets: 6, orderable: false } 
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
            } );
        }
    });
</script>
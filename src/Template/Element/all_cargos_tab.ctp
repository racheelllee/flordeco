<style type="text/css"> .dataTables_info{ display: none; }</style>
<div id="updateCargosIndex">

    <div class="ibox-content">
    
        <table id="cargosIndexTable" class="table table-striped table-bordered table-condensed table-hover" width="100%" data-page-length='20' data-order='[[ 1, "asc" ]]'>
        
            <thead>
                <tr>
                    <th> <?= $this->Paginator->sort('numero', __('Number')) ?></th>
                    <th> <?= $this->Paginator->sort('descripcion', __('Description')) ?></th>
                    <th> <?= $this->Paginator->sort('Offices.name', __('Branch')) ?></th>

                    <th scope="col"><?= __('Contratado (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Facturado (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Pendiente por facturar (MXN)') ?></th>

                    <?php if($this->UserAuth->HP('Cargos','viewUtilidad')):?>
                        <th scope="col" style="min-width: 150px"><?= __('Useful') ?></th>
                    <?php endif;?>
                    <?php if($this->UserAuth->HP('Cargos','viewRentabilidad')):?>
                        <th scope="col" style="min-width: 150px"><?= __('% Profitability') ?></th>
                    <?php endif;?>
                    <?php if($this->UserAuth->HP('Cargos','viewCostos')):?>
                        <th scope="col" style="min-width: 150px"><?= __('Direct Cost of Materials') ?></th>
                        <th scope="col" style="min-width: 150px"><?= __('% de Indirecto de Materiales') ?></th>
                        <th scope="col" style="min-width: 150px"><?= __('Direct Labour Cost') ?></th>
                        <th scope="col" style="min-width: 150px"><?= __('% de indirecto de mano de obra') ?></th>
                    <?php endif;?>
                    <th scope="col" style="min-width: 150px"><?= __('Billing Pending') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Cotizaciones Asociadas') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('CargosStatuses.name', __('Status')) ?></th>
                    <th scope="col" style="min-width: 150px"><?= $this->Paginator->sort('Users.first_name', __('Responsible Supervisor')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
        <tbody>
            <?php foreach ($cargos as $row): ?>
                <tr>
                    <td> <?= h($row->numero); ?></td>
                    <td> <?= h($row->descripcion); ?></td>
                    <td> <?= h($row->office->name); ?></td>
                    <td>$<?= number_format($row->indicadores['monto_total'], 2); ?></td>
                    <td>$<?= number_format($row->indicadores['facturado_total'], 2) ?></td>
                    <td>$<?= number_format($row->indicadores['monto_total'] - $row->indicadores['facturado_total'], 2) ?>
                    </td>
                    <?php if($this->UserAuth->HP('Cargos','viewUtilidad')):?>
                        <td>$<?= number_format($row->indicadores['utilidad'], 2); ?></td>
                    <?php endif; ?>
                    <?php if($this->UserAuth->HP('Cargos','viewRentabilidad')):?>
                        <td> <?= number_format($row->indicadores['rentabilidad'], 2); ?>%</td>
                    <?php endif; ?>
                    <?php if($this->UserAuth->HP('Cargos','viewCostos')):?>
                        <td>$<?= number_format($row->indicadores['costo_directo_materiales'], 2); ?></td>
                        <td> <?= $row->indicadores['costo_indirecto_materiales'] ?></td>
                        <td>$<?= number_format($row->indicadores['costo_directo_obra'], 2); ?></td>
                        <td> <?= $row->indicadores['costo_indirecto_obra'] ?></td>
                    <?php endif; ?>
                    <td><?= $row->indicadores['pendientes_facturacion'] ?></td>
                    <td><?= $row->indicadores['lista_cotizaciones'] ?></td>
                    <td><?= h($row->cargos_status->name); ?></td>
                    <td><?= h($row->user->first_name.' '.$row->user->last_name.' '.$row->user->clast_name); ?></td>
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
                                        echo $this->Html->link('<i class="fa fa-list fa6"></i> Ver Cotizaciones
                                        ', '/cargos/cargo_cotizaciones/'.$row->id, ['escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modalURL']);
                                    echo '</li>';
                                    if($this->UserAuth->HP('Cargos','edit')){
                                        echo '<li>';
                                            echo '<a 
                                                href="/cargos/edit/'.$row->id.'" 
                                                data-remote="false" 
                                                data-toggle="modal" 
                                                data-target="#editCargosModal"
                                                style= "margin-right: 10px"
                                                escape = false>
                                                <i class="fa fa-pencil-square-o fa6" aria-hidden="true"></i> Editar Cargo
                                            </a>';
                                        echo '</li>';
                                    }

                                    echo '<li>';
                                        echo $this->Form->postLink(
                                            '<i class="fa fa-trash-o fa6" aria-hidden="true"></i> Borrar Cargo',
                                            [
                                                'controller' => 'cargos',
                                                'plugin' => false,
                                                'action' => 'delete',
                                                $row->id,
                                                $row->cliente_id
                                            ], 
                                            [
                                                'escape' => false,
                                                'confirm' => __('¿Estas seguro de querer borrar esta registro?')
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
        <?= $this->element('simple_pagination') ?><div class="clearfix"></div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#cargosIndexTable').dataTable({ 
        searching: false,
        responsive: true,
        bSort: false,
        bPaginate: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 },
            { targets: 6, orderable: false }
        ]
    }); 
});
</script>

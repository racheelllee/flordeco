<div id="updateResultadoCargosIndex">
    
    <div class="col-xs-6 w-title w-color666">
          <span style="position: absolute; margin-top:10px;"><?= __('Resultado de Cargos') ?></span>
    </div>
    <div class="col-xs-6 w-title w-color666">
          <button style="margin-top: 10px;" id="exportarCargosPdf" type="button" class="btn btn-default pull-right">PDF</button>
</p>
    </div>
    <div class="ibox-content">
        <?php echo $this->Search->searchForm('Cargos', ['legend'=>false, 'updateDivId'=>'updateResultadoCargosIndex']); ?>
    </div>

    <div class="ibox-content">
    
        <table id="resultadoCargosIndexTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
        
            <thead>
                <tr>
                    <th scope="col" width="20" ><?= __('No.') ?></th>
                    <th scope="col" style="min-width: 100px"> <?= $this->Paginator->sort('numero', __('No. De cargo')) ?></th>
                    <th scope="col" style="min-width: 150px"> <?= $this->Paginator->sort('Customers.title', __('Customer')) ?></th>
                    <th scope="col" style="min-width: 150px"> <?= $this->Paginator->sort('descripcion', __('Description')) ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Fecha de apertura') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Fecha estimada de cierre') ?></th>
                    <th scope="col" style="min-width: 150px"> <?= $this->Paginator->sort('Offices.name', __('Branch')) ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(SI) Facturado (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(SI) Materiales (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(SI) M.O. (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(SI) Total de Gatos (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(SI) Utilida / Perdida') ?></th>

                    <th scope="col" style="min-width: 150px"><?= __('% Indirecto de Materiales') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('% Indirecto de Mano de Obra') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(CI) Materiales (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(CI) M.O. (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(CI) Total de Gastos (MXN)') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('(CI) Utilidad / Perdida') ?></th>

                    <th scope="col" style="min-width: 150px"><?= __('Rentabilidad') ?></th>
                </tr>
            </thead>
        <tbody>
            <?php
                $count = 1;
                $balanceTotal = 0;
                $retabilidadPromedio = 0;
            ?>

            <?php foreach ($cargos as $row): ?>
                
                <?php
                    $fecha = $this->Time->format($row['fecha_estimada_cierre'], 'YYYY-MM-dd');
                    $hoy = date('Y-m-d');

                    $fecha1 = new \DateTime($fecha);
                    $fecha2 = new \DateTime($hoy);
                ?>

                <tr style="<?php echo $fecha1 < $fecha2 ? 'background-color: #CD5C5C; ' : '' ?>">

                    <td> <?= h($count++) ?></td>
                    <td> <?= h($row->numero); ?></td>
                    <td> <a href="/customers/customers/view/<?= $row->customer->id; ?>"> <?= h($row->customer->title); ?> </a> </td>
                    <td> <?= h($row->descripcion); ?></td>
                    <td> <?= $this->Time->format($row['fecha_apertura'], 'dd/MM/YYYY') ?></td>
                    <td> <?= $this->Time->format($row['fecha_estimada_cierre'], 'dd/MM/YYYY') ?></td>
                    <td> <?= h($row->office->name); ?></td>

                    <td> $<?= number_format($row->indicadores['facturado_total'], 2) ?></td>
                    <td> $<?= number_format($row->indicadores['costo_directo_materiales'], 2); ?></td>
                    <td> $<?= number_format($row->indicadores['costo_directo_obra'], 2); ?></td>

                    <td> $<?= number_format($row->indicadores['sinIndTotalGastos'], 2) ?></td>
                    <td> $<?= number_format($row->indicadores['sinIndUtilidadPerdida'], 2) ?> </td>

                    <td> <?= $row->indicadores['costo_indirecto_materiales'] ?>%</td>
                    <td> <?= $row->indicadores['costo_indirecto_obra'] ?>%</td>

                    <td> $<?= number_format($row->indicadores['conIndMateriales'], 2) ?></td>
                    <td> $<?= number_format($row->indicadores['conIndOM'], 2) ?></td>
                    <td> $<?= number_format($row->indicadores['conIndTotalGastos'], 2) ?></td>
                    <td> $<?= number_format($row->indicadores['conIndUtilidadPerdida'], 2) ?></td>

                    <td> <?= number_format($row->indicadores['conIndRentabilidad'], 2) ?>%</td>
                </tr>

                

            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <?php foreach ($cargos as $value) {
                
                $balanceTotal += $value->indicadores['conIndUtilidadPerdida'];
                $retabilidadPromedio += $value->indicadores['conIndRentabilidad'];
                
            } ?>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="col-md-12" style="text-align: end; padding-right: 0px;">
                    <label style="font-weight: bold !important; font-size: 20px !important;" class="control-label"><?=  __('Balance Total (MXN)'); ?>: </label>
                    <span style="font-size: 18px">$<?= number_format($balanceTotal, 2) ?></span>
                </div>
                <div class="col-md-12" style="text-align: end; padding-right: 0px;">
                    <label style="font-weight: bold !important; font-size: 20px !important;" class="control-label"><?=  __('Rentabilidad promedio'); ?>: </label>
                    <span style="font-size: 18px"><?= number_format($retabilidadPromedio / $count, 2) ?></span>
                </div>
            </div>
        </div>
        <?= $this->element('simple_pagination') ?>
    </div>
</div>

<!--Page Related Scripts-->
<script src="/assets/global/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/global/plugins/datatables/ZeroClipboard.js"></script>
<script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
<script src="/assets/global/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/assets/global/plugins/datatables/datatables-init.js"></script>

<style type="text/css">
    .searchLabel,
    .searchField
    {
        clear: both;
    }
    .usermgmtSearchForm .searchSubmit 
    {
        float: right;
        padding: 0 10px 5px;
        margin-top: 40px;
    }
    .w-btnNewUsers {
        position: absolute;
        right: 30px !important;
        margin-top: -10px !important;
    }
    .dataTables_info{
        display: none;
    }
</style>


<script type="text/javascript">
$(document).ready(function(){
    $('#resultadoCargosIndexTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false,
        columnDefs: [
            { responsivePriority: 1, targets: -1 },
        ]
    });
});
</script>

<?= $this->element('editCargos'); ?>
<?= $this->element('modalAjax'); ?>
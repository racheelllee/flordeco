<style type="text/css">.usermgmtSearchForm .searchSubmit{margin-right: 45px;}</style>

<div id="updateResumenCargosIndex">
    
    <div class="col-xs-6 w-title w-color666">
          <span style="position: absolute; margin-top: -20px;"><?= __('Resumen de Cargos') ?></span>
    </div>
    <div class="col-xs-6 w-title w-color666">

    </div>
    <div class="ibox-content" style="margin-top: 30px;">
        <?php echo $this->Search->searchForm('Cargos', ['legend'=>false, 'updateDivId'=>'updateResumenCargosIndex']); ?>
    </div>

    <div class="ibox-content">
    
        <table id="resumenCargosIndexTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
        
            <thead>
                <tr>
                    <th scope="col" width="20" ><?= __('No.') ?></th>
                    <th scope="col" style="min-width: 100px"> <?= $this->Paginator->sort('numero', __('No. De cargo')) ?></th>
                    <th scope="col" style="min-width: 150px"> <?= $this->Paginator->sort('Customers.title', __('Customer')) ?></th>
                    <th scope="col" style="min-width: 150px"> <?= $this->Paginator->sort('descripcion', __('Description')) ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Fecha de apertura') ?></th>
                    <th scope="col" style="min-width: 150px"><?= __('Fecha estimada de cierre') ?></th>
                </tr>
            </thead>
        <tbody>
            <?php $count = 1; ?>

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
                </tr>

                

            <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->element('simple_pagination') ?>
        <div class="clearfix"></div>
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
    $('#resumenCargosIndexTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false,
        columnDefs: [
            { responsivePriority: 1, targets: -1 },
        ]
    });
});
</script>
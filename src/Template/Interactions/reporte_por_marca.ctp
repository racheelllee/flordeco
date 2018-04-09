<style type="text/css">.usermgmtSearchForm .searchSubmit{margin-right: 45px;}</style>
<div class="clearfix">
    <style type="text/css">
        .widget{
            padding: 0;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            margin: 0 0 30px 0;
        }
    </style>
    <div id="updateInteractionsIndex">

        <div class="col-xs-6 w-title w-color666">
              <span style="position: absolute; margin-top:10px;"><?= __('Reporte por Marca') ?></span>
        </div>
        <div class="ibox-title">
            <span class="panel-title">
                <br>
            </span>
        </div>
        <div class="ibox-content">
            <?php echo $this->Search->searchForm('Interactions', ['legend'=>false, 'updateDivId'=>'updateInteractionsIndex']); ?>
        </div>

        <p style="text-align: right;margin: 10px 0;">
            <a href="/interactions/reporte-por-marca/pdf" target="_blank" class="btn btn-default" style="border: 1px solid #17aa8f;color: #777;">PDF</a>
        </p>


        <div class="customers ibox-content">
            <table id="interactionsIndexTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th style="min-width:150px">
                        <?= $this->Paginator->sort('Customers.title', __('Customer')) ?>
                    </th>
                    <th style="min-width:150px">
                        <?= $this->Paginator->sort('Users.first_name', __('Seller')) ?>
                    </th>
                    <th style="min-width:150px">
                        <?= $this->Paginator->sort('InteractionTypes.name', __('Type')) ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('start_date', __('Fecha')) ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('comments', __('Comentario')) ?>
                    </th>
                    <th style="text-align: center;">
                        <?= $this->Paginator->sort('InteractionStatuses.name', __('Estatus')) ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($interacciones as $interaccion): ?>
                <tr>
                    <td>
                        <a href="/customers/customers/view/<?= $interaccion->customer->id; ?>">
                            <?= h($interaccion->customer->title) ?>
                        </a>
                    </td>
                    <td>
                        <?= $interaccion->user ? h($interaccion->user->first_name.' '.$interaccion->user->last_name.' '.$interaccion->user->clast_name) : '' ?>
                    </td>
                    <td><?= $interaccion->interaction_type ? $interaccion->interaction_type->name : '' ?></td>
                    <td><?= $this->Time->format($interaccion->start_date, 'dd/MM/YYYY') ?></td>
                    <td><?= $this->Generic->shortenText($interaccion->comments, 80) ?></td>
                    <td style="text-align: center;">
                        <span style="padding:5px;color: white;background-color: <?= $interaccion->interaction_status->color ?>;">
                            <?= $interaccion->interaction_status ? $interaccion->interaction_status->name : '' ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?= $this->element('simple_pagination') ?>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#interactions-user-id').select2();
                $('#interactions-customer-id').select2();
                $('#arbitraryfilter-arbitraryfilter').select2();
                $('.search-date').datepicker({format: 'dd/mm/yyyy'});
                $('#interactionsIndexTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false});
            });
        </script>
    </div>

    <!-- Don't know if this is actually needed -->
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
            margin-right: 0px;
        }
        .w-btnNewUsers {
            position: absolute;
            right: 30px !important;
            margin-top: -10px !important;
        }
        .dataTables_info{
            display: none;
        }
        /*#InteractionsUsermgmt>.searchBlock:nth-child(8){
            clear: right;
            background-color: red;
            display: block;
        }*/
    </style>
</div>


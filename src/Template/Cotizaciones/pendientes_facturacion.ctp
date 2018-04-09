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
    <div id="updateCotizacionesIndex">
        <div class="col-xs-12" style="text-align: center;">
              <h3 style="font-weight: bold;"><?= __('Pendientes de Facturación') ?></h3>
        </div>
        <div class="ibox-title">
            <span class="panel-title">
                <br>
            </span>
        </div>
        <div class="ibox-content">
            <?= $this->Search->searchForm('Cotizaciones', [
                'legend'=>false,
                'updateDivId'=>'updateCotizacionesIndex'
            ]); ?>
        </div>

        <p style="text-align: right;margin: 10px 0;">
            <a href="/cotizaciones/pendientes-facturacion/pdf" target="_blank" class="btn btn-default" style="border: 1px solid #17aa8f;color: #777;">PDF</a>
        </p>

        <div class="customers ibox-content">
            <table id="pronosticosTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">
                        <?= __('Número') ?>
                    </th>
                    <th scope="col" style="width: 100px;">
                        <?= $this->Paginator->sort('created', __('Fecha de creación')) ?>
                    </th>
                    <th scope="col" style="min-width: 120px;">
                        <?= $this->Paginator->sort('numero_cotizacion', __('No. de COT')); ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Cargos.numero', __('Cargo')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Customers.title', __('Customer')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('descripcion', __('Descripción')) ?>
                    </th>
                    <th scope="col" style="max-width:40px;text-align: center;">
                        <?= $this->Paginator->sort('CotizacionesEstatuses.nombre', __('Status')) ?>
                    </th>
                    <th scope="col" style="max-width:40px;text-align: center;">
                        <?= $this->Paginator->sort('monto_total', __('Importe')) ?>
                    </th>
                    <th scope="col" style="max-width:40px;text-align: center;">
                        <?= $this->Paginator->sort('moneda_id', __('Moneda')) ?>
                    </th>
                    <th scope="col" style="max-width:40px;text-align: center;"><?= __('T.C.') ?></th>
                    <th scope="col" style="max-width:40px;text-align: center;"><?= __('Total MXN') ?></th>
                    <th scope="col" style="max-width:40px;text-align: center;"><?= __('Facturado MXN') ?></th>
                    <th scope="col" style="max-width:40px;text-align: center;"><?= __('Saldo Pendiente MXN') ?></th>
                    <th scope="col" style="max-width:40px;text-align: center;">
                        <?= __('Fechas Estimadas de facturación') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $ctr = 0; ?>
                <?php $counter = (($this->Paginator->current() - 1) * $this->Paginator->params()['perPage']) + 1; ?>
                <?php foreach ($cotizaciones as $cotizacion): ?>
                    <tr>
                        <td><?= $counter ?></td> <!-- Número -->
                        <td><?= $this->Time->format($cotizacion->created, 'dd/MM/YYYY') ?></td> <!-- Fecha -->
                        <td><?= $cotizacion->numero_cotizacion ?></td> <!-- No. de COT -->
                        <td><?= $cotizacion->cargo ? $cotizacion->cargo->numero : '' ?></a></td> <!-- Cargo -->
                        <td>
                            <a href="/customers/customers/view/<?= $cotizacion->customer->id; ?>">
                                <?= h($cotizacion->customer->title) ?>
                            </a>
                        </td> <!-- Customer -->
                        <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td> <!-- Description -->
                        <td align="center">
                            <span class="btn btn-primary btn-xs" style="border: 0px;color:white;padding:4px;background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                                <?= $cotizacion->cotizaciones_estatus->nombre ?>
                            </span>
                        </td> <!-- Status -->
                        <td>$<?= number_format($cotizacion->sold_quote, 2) ?></td> <!-- Importe -->
                        <td><?= $cotizacion->moneda ? $cotizacion->moneda->name : '' ?></td> <!-- Moneda -->
                        <td> <?= number_format($cotizacion->tipo_cambio, 2) ?></td> <!-- Tipo de cambio -->
                        <td>$<?= number_format($cotizacion->vendido_cotizacion, 2) ?></td> <!-- Monto en pesos -->
                        <td>$<?= number_format($cotizacion->billed_mxn, 2) ?></td> <!-- Facturado -->
                        <td>$<?= number_format($cotizacion->pending_mxn, 2) ?></td> <!-- Pendiente -->
                        <?php $ctr += $cotizacion->pending_mxn; ?>
                        <td> <?= $cotizacion->billing_dates_formatted ?> </td> <!-- Fechas de facturación -->
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->Form->input('page_total', [
            'type' => 'hidden',
            'value' => $ctr
        ]); ?>
        <div class="row">
            <div class="col-lg-7"></div>
            <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
            <div class="col-lg-2"><b>$ <?= number_format($pendienteMxn, 2) ?></b></div>
        </div>
        <?= $this->element('simple_pagination') ?>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#customfilter-multistatus').select2();
                $('#cotizaciones-cliente-id').select2();
                $('#cotizaciones-cargo-id').select2();
                $('#pronosticosTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false});
                $('.search-date').datepicker({format: 'dd/mm/yyyy'});
                var company_departments = <?= json_encode($companies) ?>;
                var selected_department = $('#users-company-department-id').val();
                $('#cotizaciones-company-id').on('change', function(ev){
                    var list = company_departments[this.value];
                    $('#users-company-department-id').empty();
                    $('#users-company-department-id').append(new Option('Todos', ''));
                    $.each(list, function(key, value){
                        $('#users-company-department-id').append(new Option(value, key));
                    });
                });
                $('#cotizaciones-company-id').trigger('change');
                $('#users-company-department-id').val(selected_department);
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
        /*#CotizacionesUsermgmt>.searchBlock:nth-child(8){
            clear: right;
            background-color: red;
            display: block;
        }*/
    </style>
</div>


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

        <div class="col-xs-6 w-title w-color666">
              <span style="position: absolute; margin-top:10px;"><?= __('Reporte por Marca') ?></span>
        </div>
        <div class="ibox-title">
            <span class="panel-title">
                <br>
            </span>
        </div>
        <div class="ibox-content">
            <?php echo $this->Search->searchForm('Cotizaciones', ['legend'=>false, 'updateDivId'=>'updateCotizacionesIndex']); ?>
        </div>

        <p style="text-align: right;margin: 10px 0;">
            <a href="/cotizaciones/reporte-por-marca/pdf" target="_blank" class="btn btn-default" style="border: 1px solid #17aa8f;color: #777;">PDF</a>
        </p>


        <div class="customers ibox-content">
            <table id="customersIndexTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('Customers.title', __('Customer')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('fecha_registro', __('Fecha')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('numero_cotizacion', __('No. de COT')); ?>
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
                        <?= $this->Paginator->sort('coin_id', __('Moneda')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Contacts.first_name', __('Contact')) ?>
                    </th>
                    <th scope="col">
                        <?= __('Observaciones') ?>
                    </th>
                    <th scope="col" style="max-width:40px;text-align: center;">
                        <?= $this->Paginator->sort('from_interaction', __('Type')) ?>
                    </th>
                    <th scope="col" style="min-width:150px">
                        <?= $this->Paginator->sort('Users.first_name', __('Seller')) ?>
                    </th>
                    <th scope="col" style="min-width:150px">
                        <?= $this->Paginator->sort('Second.first_name', __('Second Seller')) ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cotizaciones as $row): ?>
                <tr>
                    <td> <!-- Customer -->
                        <a href="/customers/customers/view/<?= $row->customer->id; ?>">
                            <?= h($row->customer->title) ?>
                        </a>
                    </td> <!-- Customer -->
                    <td><?= $this->Time->format($row->fecha_registro, 'dd/MM/YYYY') ?></td> <!-- Fecha -->
                    <td><?= $row->numero_cotizacion ?></td> <!-- No. de COT -->
                    <td><?= $this->Generic->shortenText($row->descripcion, 80) ?></td> <!-- Description -->
                    <td align="center"> <!-- Status -->
                        <span class="btn btn-primary btn-xs" style="border: 0px;color:white;padding:4px;background-color: <?= $row->cotizaciones_estatus->color ?>">
                            <?= $row->cotizaciones_estatus->nombre ?>
                        </span>
                    </td> <!-- Status -->
                    <td>$ <?= number_format($row->monto_total, 2) ?></td> <!-- Importe -->
                    <td><?= $row->moneda->name ?></td> <!-- Moneda -->
                    <td> <!-- Customer Contact /Contacto -->
                        <?= $row->contact ? h($row->contact->first_name.' '.$row->contact->middle_name.' '.$row->contact->last_name) : '' ?>
                    </td> <!-- Customer Contact /Contacto -->
                    <td><?= $this->Generic->shortenText($row->comentarios_generales, 80) ?></td> <!-- Observaciones -->
                    <td align="center"> <!-- Type -->
                      <?php if ($row->from_interaction): ?>
                        <span style="border: 0px;background-color: #79af5d;" class="btn lbl btn-primary btn-xs">P</span>
                      <?php else: ?>
                        <span style="border: 0px;background-color: #4f8fc6;" class="btn lbl btn-primary btn-xs">D</span>
                      <?php endif ?>
                    </td> <!-- Type -->
                    <td>
                        <?= $row->user ? h($row->user->first_name.' '.$row->user->last_name.' '.$row->user->clast_name) : '' ?>
                    </td> <!-- Seller -->
                    <td>
                        <?= $row->second ? h($row->second->first_name.' '.$row->second->last_name.' '.$row->second->clast_name) : '' ?>
                    </td> <!-- Second Seller -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?= $this->element('simple_pagination') ?>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#arbitraryfilter-arbitraryfilter').select2();
                $('#cotizaciones-vendedor-asignado-id').select2();
                $('#cotizaciones-cliente-id').select2();
                $('#cotizaciones-second-seller').select2();
                $('.search-date').datepicker({format: 'dd/mm/yyyy'});
                //$('#cotizaciones-vendedor-asignado-id option[value="<?= $vendedor_asignado_id;?>"]').prop("selected", true);
                $('#customersIndexTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false});
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


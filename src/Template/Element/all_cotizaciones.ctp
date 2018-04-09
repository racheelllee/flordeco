<style type="text/css">
    .widget{
        padding: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        margin: 0 0 30px 0;
    }
    .btn{
        margin: 1px;
    }
    .btn.lbl.btn-primary.btn-xs{
        border: 0px;
    }
</style>
<div id="updateCotizacionesIndex">

    <div class="col-xs-6 w-title w-color666">
          <span style="position: absolute; margin-top:10px;"><?= __('List Quotes') ?></span>
    </div>
    <div class="ibox-title">
        <span class="panel-title">
            <br>
        </span>
    </div>
    <div class="ibox-content">
        <?= $this->Search->searchForm('Cotizaciones', ['legend'=>false, 'updateDivId'=>'updateCotizacionesIndex']); ?>
    </div>

    <div class="customers ibox-content">
        <p style="text-align: right;">
            <a  href="/cotizaciones/cotizaciones-en-proceso-pdf"
                data-remote="false" 
                data-toggle="modal" 
                data-target="#genericModal"
                >
                    <button id="cotizacionesEnProcesoPDF" class="btn btn-primary" type="button" style="background-color: #79af5d;">EN PROCESO</button>
            </a>
        </p>
        <table id="customersIndexTable" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col" style="min-width:150px">
                    <?= $this->Paginator->sort('numero_cotizacion', __('No. de COT')); ?>
                </th>
                <th scope="col" style="min-width:150px"><?= $this->Paginator->sort('Customers.title', __('Customer')) ?></th>
                <th scope="col" style="min-width:150px;max-width: 190px;"><?= $this->Paginator->sort('descripcion', __('Breve Descripción de lo cotizado')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('monto_total', __('Importe')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('moneda_id', __('Coin')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('CotizacionesEstatuses.nombre', __('Status')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Cargos.numero', __('No. de Cargo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_interaction', __('Type')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Companies.name', __('Company')) ?></th>
                <th scope="col"><?= __('Company Department') ?></th>
                <th scope="col"><?= __('Supervisor Responsable') ?></th>
                <th scope="col"><?= __('Seller') ?></th>
                <th scope="col"><?= __('Second Seller') ?></th>
                <th scope="col"><?= __('Facturado') ?></th>
                <th scope="col"><?= __('Pendiente por facturar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Contacts.first_name', __('Customer Contact')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('SecondContact.first_name', __('Segundo Contacto')) ?></th>
                <th scope="col"><?= __('Customer Category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Offices.name', __('Branch')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_registro', __('Date Register')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('descuento', __('Discount')) ?></th>
                <th scope="col"><?= __('Payment conditions') ?></th>
                <th scope="col"><?= __('Delivery conditions') ?></th>
                <!--th scope="col"><?= $this->Paginator->sort('', __('Payment conditions')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('', __('Delivery conditions')) ?></th-->
                <th scope="col"><?= $this->Paginator->sort('tiempo_entrega', __('Delivery Time')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_entrega_cliente', __('Fecha Entrega a Cliente')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', __('Fecha de creación')) ?></th>

                <th scope="col"><?= $this->Paginator->sort('costo_directo_materiales', __('Costo directo de materiales')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_indirecto_materiales', __('% Indirecto de materiales')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_directo_obra', __('Costo Directo de Mano de Obra')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_indirecto_obra', __('% Indirecto de mano de obra')) ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cotizaciones as $row): ?>
            <tr>
                <td><?= $row->numero_cotizacion ?></td> <!-- No. de COT -->
                <td> <!-- Customer -->
                    <a href="/customers/customers/view/<?= $row->customer->id; ?>">
                        <?= h($row->customer->title) ?>
                    </a>
                </td> <!-- Customer -->
                <td> <!-- Description -->
                    <?= $this->Generic->shortenText($row->descripcion, 80) ?>
                </td> <!-- Description -->
                <td>$<?= number_format($row->monto_total, 2) ?></td> <!-- Sum Total / Monto -->
                <td><?= $row->moneda->name ?></td> <!-- Coin / Moneda -->
                <td align="center"> <!-- Status -->
                    <a href="/cotizaciones/change-status/<?= $row->id ?>" data-remote="false" data-toggle="modal" data-target="#genericModal">
                        <button class="btn lbl btn-primary btn-xs" style="background-color: <?= $row->cotizaciones_estatus->color ?>">
                            <?= $row->cotizaciones_estatus->nombre ?>
                        </button>
                    </a>
                </td> <!-- Status -->
                <td><?= $row->cargo ? $row->cargo->numero : '' ?></td> <!-- Cargo -->
                <td align="center"> <!-- Type -->
                  <?php if ($row->from_interaction): ?>
                    <span style="border: 0px;background-color: #79af5d;" class="btn lbl btn-primary btn-xs">P</span>
                  <?php else: ?>
                    <span style="border: 0px;background-color: #4f8fc6;" class="btn lbl btn-primary btn-xs">D</span>
                  <?php endif ?>
                </td> <!-- Type -->
                <td><?= $row->company->name ?></td> <!-- Company / Empresa -->
                <td> <!-- Company Department / Departamento -->
                    <?= $company_departments[$row->user->company_id][$row->user->company_department_id] ?>
                </td> <!-- Company Department / Departamento -->
                <td><?= $row->cargo ? $row->cargo->user->first_name.' '.$row->cargo->user->last_name.' '.$row->cargo->user->clast_name : '' ?></td> <!-- Supervisor -->
                <td><?= h($row->user->first_name.' '.$row->user->last_name.' '.$row->user->clast_name) ?></td> <!-- Seller -->
                <td> <!-- Second Seller / Segundo vendedor -->
                    <?= h($row->second->first_name.' '.$row->second->last_name.' '.$row->second->clast_name) ?>
                </td> <!-- Second Seller / Segundo vendedor -->
                <td> <!-- Facturado -->
                    <?php if ( $row->status_id == 7 || $row->status_id == 8 ): ?>
                        $ <?= number_format($row->indicadores['facturado'], 2) ?>
                    <?php endif ?>
                </td> <!-- Facturado -->
                <td> <!-- Pendiente por facturar -->
                    <?php if ( $row->status_id == 7 || $row->status_id == 8 ): ?>
                        $ <?= number_format($row->indicadores['pendiente'], 2) ?>
                    <?php endif ?>
                </td> <!-- Pendiente por facturar -->
                <td> <!-- Customer Contact /Contacto -->
                    <?= h($row->contact->first_name.' '.$row->contact->middle_name.' '.$row->contact->last_name) ?>
                </td> <!-- Customer Contact /Contacto -->
                <td> <!-- Second Contact / Segundo Contacto -->
                    <?= h($row->segundo_contacto->first_name.' '.$row->segundo_contacto->middle_name.' '.$row->segundo_contacto->last_name) ?>
                </td> <!-- Second Contact / Segundo Contacto -->
                <td><?= h($row->customer->customer_category->name) ?></td> <!-- Customer Category -->
                <td><?= $row->office->name ?></td> <!-- Branch -->
                <td><?= $this->Time->format($row->fecha_registro, 'dd/MM/YYYY') ?></td> <!-- Date Register -->
                <td><?= $row->descuento ?>%</td> <!-- Discount -->
                <td><?= $condicionesPago[$row->codiciones_pago] ?></td> <!-- Payment conditions -->
                <td><?= $row->condiciones_entrega ?></td> <!-- Delivery conditions -->
                <td><?= $row->tiempo_entrega ?></td> <!-- Delivery Time -->
                <td><?= $row->fecha_entrega_cliente ? $row->fecha_entrega_cliente->format('d/m/Y') : '' ?></td> <!-- Delivery Time -->
                <td><?= $this->Time->format($row->created, 'dd/MM/YYYY') ?></td> <!-- Fecha -->

                <td><?= $row->costo_directo_materiales ? '$ ' . number_format($row->costo_directo_materiales, 2) : '' ?></td>
                <td><?= $row->costo_indirecto_materiales ? $row->costo_indirecto_materiales . ' %' : '' ?></td>
                <td><?= $row->costo_directo_obra ? '$ ' . number_format($row->costo_directo_obra, 2) : '' ?></td>
                <td><?= $row->costo_indirecto_obra ? $row->costo_indirecto_obra . ' %' : '' ?></td>
               
                <td class="actions">
                    <div class='btn-group'>
                        <button 
                                class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' 
                                aria-expanded='false'>
                            <?= __('Actions') ?>
                            <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu pull-right'>
                            <li>
                                <?= $this->Html->link(__('View'), ['action' => 'view', $row->id]) ?>
                            </li>

                            <?php if($row->status_id >= 5 && $row->status_id <= 10){ ?>
                            <li>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $row->id]) ?>
                            </li>
                            <?php } ?>

                            <?php
                             if($row->status_id != 7 && $row->status_id != 8){
                                    echo '<li>';
                                        echo $this->Html->link('<i class="fa fa-copy fa6" aria-hidden="true"></i> Nueva revisión', '/cotizaciones/add/'.$row->customer->id.'/0/'.$row->id, ['escape' => false]);
                                    echo '</li>';

                                } 
                            ?>


                            <li>
                                <?php
                                    if(!empty($row->archivo)):
                                        echo $this->Html->link(__('Download File'),'/files/cotizaciones/'.$row->archivo.'', ['escape' => false, 'style' => 'margin-right: 10px;', 'target' => '_blank']);
                                      endif;
                                ?>
                            </li>

                            <li>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $row->id], ['confirm' => __('Are you sure you want to delete # {0}?', $row->id)]) ?>
                            </li>
                        </ul>
                        
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <?= $this->element('simple_pagination') ?>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#customfilter-multistatus').select2();
            $('#cotizaciones-vendedor-asignado-id').select2();
            $('#cotizaciones-second-seller').select2();
            $('#cotizaciones-cargos').select2();

            var company_departments = <?= json_encode($company_departments) ?>;
            var selected_department = $('#cotizaciones-users').val();
            $('#cotizaciones-company-id').on('change', function(ev){
                var list = company_departments[this.value];
                $('#cotizaciones-users').empty();
                $('#cotizaciones-users').append(new Option('Todos', ''));
                $.each(list, function(key, value){
                    $('#cotizaciones-users').append(new Option(value, key));
                });
            });
            $('#cotizaciones-company-id').trigger('change');
            $('#cotizaciones-users').val(selected_department);

        });
    </script>
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

        $('#cotizaciones-vendedor-asignado-id option[value="<?= $vendedor_asignado_id;?>"]').prop("selected", true);
        $('.search-date').datepicker({format: 'dd/mm/yyyy'});
        $('#customersIndexTable').dataTable({bPaginate: false, searching: false, responsive: true, bSort: false,
            columnDefs: [
                { responsivePriority: 1, targets: -1 },
            ]
        });
    });
</script>
<?= $this->element('generic_modal') ?>
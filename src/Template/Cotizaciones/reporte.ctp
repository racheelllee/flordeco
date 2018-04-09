<style type="text/css">
    .text-stat{
        text-align: center;
    }
    .text-stat .btn{
        width: 100%;
    }
    .widget{
        padding: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        margin: 0 0 30px 0;
    }

    .lblspan{
        font-size: 20px;
        font-family: Arial;
        line-height: 15px;
        position: absolute;
        z-index: 1;
        margin-top: -7px;
    }
    .sold, .quote, .effectiveness, .compliance, .invoiced, .invoicing, .direct_prospect, .efficiency{
        padding-right: 150px;
        width: 25px;
        height: 25px;
        border-radius: 5px;
        pointer-events: none;
        color: #FFF;
        line-height: 17px;
    }
    .sold{ background-color: #637fa1; }
    
    .quote { background-color: #00c39e; }
    
    .effectiveness{ background-color: #8e6ea8; }
    
    .compliance{ background-color: #f0ab54; }
    
    .invoiced{ background-color: #4c87b9; }
    
    .invoicing{ background-color: #c5bf65; }
    
    .direct_prospect{ background-color: #4c87b9; }
    
    .efficiency{ background-color: #1bbc9b; }

    .tab-pane{
      min-height: 500px;
    }

</style>
<div id="updateCotizacionesIndex">
    <div class="ibox-content">
            <?= $this->Form->create(null, [
              'url' => [
                'controller' => 'Cotizaciones',
                'action'=> 'reporte',
                'plugin' => false
              ],
              'type' => 'get',
              'style' => 'margin-top: 20px',
              'id' => 'reporte-ventas-form',
            ]); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?= $this->Form->input('desde',     [   'type'  =>  'text',
                                                                'label' =>  'Desde',
                                                                'id'    =>  'FromDate',
                                                                'div'   =>  false,
                                                                'style' =>  'height:28px',
                                                                'value' =>  (!empty($inicio))? $inicio:"",
                                                                'class' =>  'form-control datepicker']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('hasta',     [   'type'  =>  'text',
                                                                'label' =>  'Hasta',
                                                                'id'    =>  'ToDate',
                                                                'div'   =>  false,
                                                                'style' =>  'height:28px',
                                                                'value' =>  (!empty($fin))? $fin:"",
                                                                'class' =>  'form-control datepicker']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('empresa',   [   'type'  => 'select',
                                                                'label' => 'Empresa',
                                                                'div'   =>  false,
                                                                'style' =>  'height:28px',
                                                                'empty' => 'Todos',
                                                                'options' => $companies,
                                                                'default' => (!empty($company))? $company:"",
                                                                'class' =>  'form-control']); ?>  
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('sucursal', [    'type'  =>  'select',
                                                                'label' =>  'Sucursal',
                                                                'div'   =>  false,
                                                                'empty' =>  'Todos',
                                                                'style' =>  'height:28px',
                                                                'options' => $sucursales,
                                                                'default' => (!empty($offices))? $offices:"",
                                                                'class' =>  'form-control']); ?>         
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('primer_vendedor', [    'type'  =>  'select',
                                                                'label' =>  'Primer Vendedor',
                                                                'div'   =>  false,
                                                                'empty' =>  'Todos',
                                                                'options' => $vendedores,
                                                                'default' => (!empty($primer_vendedor))? $primer_vendedor:"",
                                                                'class' =>  'form-control'
                        ]); ?>   
                    </div>
                     <div class="col-md-2">
                        <?= $this->Form->button( __('Buscar' ) , [  'class' =>      'btn btn-primary', 
                                                                    'type'  =>      'submit', 
                                                                    'style' =>      'margin-top: 25px; height:30px;']) ?>
                           
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-2">
                        <?= $this->Form->input('segundo_vendedor', [ 'type'  =>  'select',
                                                                'label' =>  'Segundo Vendedor',
                                                                'div'   =>  false,
                                                                'empty' =>  'Todos',
                                                                'options' => $vendedores,
                                                                'default' => (!empty($segundo_vendedor))? $segundo_vendedor:"",
                                                                'class' =>  'form-control'
                        ]); ?>   
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('cliente_id', [  'type'  =>  'select',
                                                                'label' =>  'Cliente',
                                                                'div'   =>  false,
                                                                'empty' =>  'Todos',
                                                                'options' => $clientes,
                                                                'default' => (!empty($cliente_id))? $cliente_id:"",
                                                                'class' =>  'form-control'
                        ]); ?>   
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('departamento', [
                            'type'      => 'select',
                            'label'     => 'Departamento',
                            'div'       => false,
                            'empty'     => 'Todos',
                            'options'   => $departamentos,
                            'default'   => isset($departamento) ? $departamento : '',
                            'class'     => 'form-control'
                        ]); ?>
                    </div>
                </div>
                <?= $this->Form->input('exportar_reporte', [
                    'type'      => 'hidden',
                    'value'     => '',
                ]); ?>
            <?= $this->Form->end() ?>
    </div>

<script type="text/javascript">

    $('#exportar-reporte').val('');

</script>

<div style="margin-bottom: 50px; margin-top: 20px" class="ibox-content">
<!-- Page Body -->
<div class="page-body">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    <div id="ventas" style="height:500px;"></div>
                </div>
            </div>
        </div>
    </div>

<div style="margin: 20px 0 10px 30px">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">$<?=number_format($totalVenta['total'], 2)?></h3>
            <button class="btn sold">
                <span class="lblspan">
                    <?= __('Sold') ?>
                    <?= $totalVenta['cantidad'] ?>
                    <?= $totalVenta['cantidad'] ? ' Cot.' : '' ?>
                </span>
            </button>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">$<?=number_format($quotes_indicadores->total_cotizado, 2)?></h3>
            <button class="btn quote">
                <span class="lblspan">
                    <?= __('Quoted')?>
                    <?= $quotes_indicadores->cantidad_cotizados ?>
                    <?= $quotes_indicadores->cantidad_cotizados ? ' Cot.' : '' ?>
                </span>
            </button>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1"><?=round($quotes_indicadores->porcentaje_efectividad, 2)?>%</h3>
            <button class="btn effectiveness"><span class="lblspan"><?= __('% Effectiveness')?>  ($)</span></button>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1"><?=round($quotes_indicadores->porcentaje_cumplimiento, 2)?>%</h3>
            <button class="btn compliance"><span class="lblspan"><?= __('% Compliance')?></span></button>
        </div>
    </div>
</div>

<div style="margin: 20px 0 10px 30px">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">$<?=number_format($totalVenta['total_facturado'], 2)?></h3>
            <button class="btn invoiced"><span class="lblspan"><?= __('Invoiced')?></span></button>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">$<?=number_format($totalVenta['pendiente_facturar'], 2)?></h3>
            <button class="btn invoicing"><span class="lblspan"><?= __('For Invoicing')?></span></button>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">
                <?=round($quotes_indicadores->porcentaje_directo, 0)?>% | <?=round($quotes_indicadores->porcentaje_prospecto, 0)?>%
            </h3>
            <button class="btn direct_prospect"><span class="lblspan"><?= __('Direct vs. Prospect')?></span></button>
            
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
            <h3 style="margin-bottom: 10px; font-family: Arial; font-size: 30px; color: #637fa1">
                <?php if ($quotes_indicadores->cantidad_cotizados > 0): ?>
                    <?= number_format($quotes_indicadores->cantidad_aprobadas / $quotes_indicadores->cantidad_cotizados * 100, 2) ?>%
                <?php else: ?>
                    0%
                <?php endif ?>
            </h3>
            <button class="btn efficiency">
                <span class="lblspan">
                    <?= __('Net Efficiency')?>  (N°)
                </span>
            </button>
        </div>
    </div>
</div>

</div>
<!-- /Page Body -->
</div>
  <div class="row">
  <h3 align="center">Desgloses</h3>
    <ul class="nav nav-tabs controlTabs">
      <li class="active"><a data-toggle="tab" id="cotizacion-ct-tab" href="#cotizacion-ct">Cotizaciones</a></li>
      <li><a data-toggle="tab" id="ventas-ct-tab" href="#ventas-ct">Ventas</a></li>
      <li><a data-toggle="tab" id="facturado-ct-tab" href="#facturado-ct">Facturado</a></li>
    </ul>
    <div class="col-lg-12">
      <div class="tab-content">
        <div id="cotizacion-ct" class="tab-pane fade in active">
          <?= $this->element('Cotizaciones/cotizaciones_reporte') ?>
        </div>
        <div id="ventas-ct" class="tab-pane fade">
          <?= $this->element('Cotizaciones/ventas_reporte') ?>
        </div>
        <div id="facturado-ct" class="tab-pane fade">
          <?= $this->element('Cotizaciones/facturas_reporte') ?>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    window.totalCotizado = 0;
    window.totalVendido = 0;
    window.totalFacturado = 0;

    window.quotesPage = 1;
    function loadMoreQuotes(){
        $.post('/cotizaciones/ajax-quotes-wrapper/cotizaciones/500/' + window.quotesPage, $('#reporte-ventas-form').serialize(), function(res){
        }).done(function(res){
            $('#reportesCotizacionesTable tbody').append(res);
            window.quotesPage++;
            loadMoreQuotes();
        }).fail(function(){
            $('#total-cotizado').html('$' + number_format(window.totalCotizado, 2));
        });
    }


    window.sellsPage = 1;
    function loadMoreSells(){
        $.post('/cotizaciones/ajax-quotes-wrapper/ventas/200/' + window.sellsPage, $('#reporte-ventas-form').serialize(), function(resp){
        }).done(function(resp){
            $('#reportesVentasTable tbody').append(resp);
            window.sellsPage++;
            loadMoreSells();
        }).fail(function(){
            $('#total-vendido').html('$' + number_format(window.totalVendido, 2));
        });
    }

    window.billsPage = 1;
    window.billsCount = 1;
    function loadMoreBills(){
        $.post('/cotizaciones/ajax-bills-wrapper/500/' + window.billsPage + '/' + window.billsCount, $('#reporte-ventas-form').serialize(), function(resp){
        }).done(function(resp){
            $('#reporteFacturasTable tbody').append(resp);
            window.billsPage++;
            loadMoreBills();
        }).fail(function(){
            $('#total-facturado').html('$' + number_format(window.totalFacturado, 2));
        });
    }

    function exportaPdf(tipo){
        $('#fileLoadModal').modal('show');
        $.post('/cotizaciones/exporta-pdf-shell/' + location.search, {tipo:tipo}, function(resp){
            $('#fileLoadModal .modal-body').html(resp);
        });
    }

    $(document).ready(function(){

        loadMoreQuotes();
        loadMoreSells();
        loadMoreBills();


        var company_departments = <?= json_encode($company_departments) ?>;
        var selected_department = $('#departamento').val();
        $('#empresa').on('change', function(ev){
            var list = company_departments[this.value];
            $('#departamento').empty();
            $('#departamento').append(new Option('Todos', ''));
            $.each(list, function(key, value){
                $('#departamento').append(new Option(value, key));
            });
        });
        $('#empresa').trigger('change');
        $('#departamento').val(selected_department);


       $('#reportesIndexTable').DataTable( {
                    responsive: true,
                    ordering: false,
                    filter:false,
                    paginate:false,
                    info:false,
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
        
        $("#FromDate").datepicker({
            format: 'dd/mm/yyyy',
            numberOfMonths: 1,
            onSelect: function(selected) {
              $("#ToDate").datepicker("option","minDate", selected)
            }
        });
        
        $("#ToDate").datepicker({
            format: 'dd/mm/yyyy',
            numberOfMonths: 1,
            onSelect: function(selected) {
               $("#FromDate").datepicker("option","maxDate", selected)
            }
        }); 

    var quote = <?php echo json_encode($QuoteDias, JSON_PRETTY_PRINT) ?>;
    
    // AREA CHART
    $('#ventas').highcharts({
        chart: {
            type: 'area',
            style: {
                fontFamily: 'Open Sans'
            }
        },
        title: {
            text: 'Reporte de ventas'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?= json_encode($dias); ?>,
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: '  MXN'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'Ventas por día',
            data: <?= json_encode($series); ?>
        }]
    });

    $('#primer-vendedor').select2();
    $('#segundo-vendedor').select2();
    $('#cliente-id').select2();

    });

</script>
<div class="modal fade" id="fileLoadModal" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div id="modal-loader-content" style="display: none;">
    <p style="text-align: center;">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </p>
</div>
<script type="text/javascript">
    $("#fileLoadModal").find(".modal-body").html($('#modal-loader-content').html());
    $("#fileLoadModal").on("hidden.bs.modal", function(e) {
        $(this).find(".modal-body").html($('#modal-loader-content').html());
    });
</script>
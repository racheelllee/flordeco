<div id="updateCotizacionesIndex">
    <div class="ibox-content">
            <?= $this->Form->create(null, ['url' => 'cotizaciones/offices-ranking', 'type' => 'get', 'style' => 'margin-top: 20px']) ?>
                <div class="row">
                    <div class="col-md-2">
                        <?= $this->Form->input('desde',     [   
                            'type'  =>  'text',
                            'label' =>  'Desde',
                            'id'    =>  'FromDate',
                            'div'   =>  false,
                            'value' =>  $inicio->format('d/m/Y'),
                            'class' =>  'form-control datepicker'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('hasta',     [
                            'type'  =>  'text',
                            'label' =>  'Hasta',
                            'id'    =>  'ToDate',
                            'div'   =>  false,
                            'value' =>  $fin->format('d/m/Y'),
                            'class' =>  'form-control datepicker'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->button( __('Buscar' ) , [
                            'class' =>      'btn btn-primary', 
                            'type'  =>      'submit', 
                            'style' =>      'margin-top: 21px;'
                        ]) ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
    </div>
    <div class="ibox-content" style="margin-top: 30px;">
        <p style="font-size: 18px;">Ventas por Sucursal</p>
        <table id="office-sales" class="table table-striped table-bordered table-condensed table-hover" width="100%">
            <thead>
                <tr>
                    <th style="width:300px"><?= __('Ranking'); ?></th>
                    <th style="width:300px"><?= __('Sucursal'); ?></th>
                    <th style="width:300px"><?= __('Cotizaciones Realizadas'); ?></th>
                    <th style="width:300px"><?= __('Monto (Cotizados)'); ?></th>
                    <th style="width:300px"><?= __('Ventas Realizadas'); ?></th>
                    <th style="width:300px"><?= __('Monto (Ventas)'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($resultado as $k => $row): ?>
                    <tr>
                        <td align="center"><?= $i ?></td>
                        <td><?= $row['name'];?></td>
                        <td><?= $row['quote_realizadas']; ?></td>
                        <td>$<?= number_format($row['total_realizadas'], 2) ?></td>
                        <td><?= $row['quote_vendidas'] ?></td>
                        <td>$<?= number_format($row['total_venta'], 2) ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="quotesByDepartment"></div>
<div id="contentQuote"></div>

<script type="text/javascript">
    $(document).ready(function(){
        var inicio = $('#FromDate').val();
        var fin = $('#ToDate').val();
        $.ajax({
            type: 'POST',
            url: '/cotizaciones/departmentQuotes',
            data: {inicio:inicio,fin:fin},
            dataType: 'json',
            dataType : 'html',
            success: function(data){
                $('#quotesByDepartment').html(data);
                //$('#quotesByDepartment').find('table').DataTable({bPaginate: false,searching: false, aaSorting: [[0, 'asc']]});
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var inicio = $('#FromDate').val();
        var fin = $('#ToDate').val();
        $.ajax({
            type: 'POST',
            url: '/cotizaciones/quoteSales',
            data: {inicio:inicio,fin:fin},
            dataType: 'json',
            dataType : 'html',
            success: function(data){
                $('#contentQuote').html(data);
                $('#contentQuote').find('table').DataTable({bPaginate: false,searching: false, aaSorting: [[0, 'asc']]});
            },
        });

        $('#office-sales').DataTable({bPaginate: false,searching: false, bSort: false/*, aaSorting: [[0, 'asc']] */});
    });
</script>
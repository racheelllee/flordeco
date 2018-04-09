<?= $this->Form->create($factura , ['type'=>'file', 'class'=>'form-horizontal', 'id'=>'formFactura', 'data-validation'] ); ?>


<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Factura</h4>
        <br><br>
        <div class="row">
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('No. Factura'); ?>
                    </label>
                    <div class="col-xs-8">
                        <?= $this->Form->input('no_factura', [
                            'data-validation' => 'required',
                            'class' => 'form-control',
                            'label' => false,
                            'div'=>false,
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Cargo'); ?>
                    </label>
                    <label class="col-xs-8" style="padding-top: 7px; font-weight:bold;">
                        # <?= $cotizacion->cargo->numero ?>
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Cliente'); ?>
                    </label>
                    <label class="col-xs-8" style="padding-top: 7px; font-weight:bold;">
                        <?= $cotizacion->customer->title ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Cotización'); ?>
                    </label>
                    <label class="col-xs-8" style="padding-top: 7px; font-weight:bold;">
                        <?= $cotizacion->numero_cotizacion ?>
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Importe'); ?>
                    </label>
                    <div class="col-xs-8">
                        <?= $this->Form->input('importe', [
                            'data-maxmonto' => $cotizacion->monto_total,
                            'data-validation' => 'required',
                            'class' => 'form-control',
                            'label' => false,
                            'div'=>false,
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Archivo'); ?>
                    </label>
                    <div class="col-xs-8">
                        <?= $this->Form->input('archivo_file', [
                            'class' => 'form-control',
                            'label' => false,
                            'type' => 'file',
                            'div'=>false,
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Moneda'); ?>
                    </label>
                    <div class="col-xs-8">
                        <?= $this->Form->input('moneda_id', [
                            'div'=>false,
                            'label' => false,
                            'options' => $monedas,
                            'default' => $cotizacion->moneda_id,
                            'class' => 'form-control factura-moneda',
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="um-form-row form-group">
                    <label class="col-xs-3 control-label" >
                        <?=  __('Tipo de cambio al día de facturación'); ?>
                    </label>
                    <div class="col-xs-8">
                        <?= $this->Form->input('tipo_cambio', [
                            'min'=>0,
                            'value'=>'',
                            'div'=>false,
                            'type'=>'number',
                            'label' => false,
                            'data-validation' => 'required',
                            'class' => 'form-control factura-tipo-cambio',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="diferencia" class="row" style="display: none;">
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <label class="col-xs-2 control-label" >
                        <?= $this->Form->input('ajuste', [
                            'div'=>false,
                            'label' => false,
                            'type'=>'checkbox',
                        ]); ?>
                    </label>
                    <div class="col-xs-10">
                        <p style="margin-top: 5px;">
                            ¿Desea registrar la diferencia de $<span id="monto-diferencia">0.00</span> <span id="moneda-diferencia"><?= $cotizacion->moneda->name ?></span> como ajuste por ganancia o pérdida cambiaria?
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Form->input('cotizacion_moneda', [
            'type'=>'hidden',
            'value' => $cotizacion->moneda_id,
        ]) ?>
        <?= $this->Form->input('cotizacion_tipo_cambio', [
            'type'=>'hidden',
            'value' => $cotizacion->tipo_cambio,
        ]) ?>
        <?= $this->Form->input('cotizacion_monto_total', [
            'type'=>'hidden',
            'value' => $montoTotalPesos,
        ]) ?>
        <?= $this->Form->input('cotizacion_total_original', [
            'type'=>'hidden',
            'value' => $cotizacion->monto_total,
        ]) ?>
        <?= $this->Form->input('ajuste_por_cambio', [
            'type'=>'hidden',
            'value' => 0,
        ]) ?>

        <br>
        <p style="text-align: center;margin: 0;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-span btn-md w-btnAddUsers']) ?>
        </p>   
</div>
<?= $this->Form->end() ?>

<script type="text/javascript">
    var monedas = {
        '1': 'MXN',
        '2': 'USD'
    };
    function montoPesos(imp, moneda, tipoCambio){
        if (parseInt(moneda) == 1) {
            return parseFloat(imp);
        } else {
            var importe = parseFloat(imp);
            var tipo = parseFloat(tipoCambio);
            if ( importe > 0 && tipo > 0) {
                return importe * tipoCambio
            }
        }
        return 0;
    }
    function montoDolares(imp, tipoCambio){
        if ($('.cotizacion-moneda').val() == 2) {
            var total = parseFloat($('#cotizacion-total-original').val());
            console.error(imp, total);
            return Math.min(imp, total) - Math.max(imp, total);
        }
    }
    $('.factura-moneda,.factura-tipo-cambio,#importe').on('change', function(ev){
        var imp = $('#importe').val();
        var moneda = parseInt($('.factura-moneda').val());
        var tipoCambio = $('.factura-tipo-cambio').val();
        var total = parseFloat($('#cotizacion-monto-total').val());
        var tolerancia = total * 0.03;
        var montoMxn = montoPesos(imp, moneda, tipoCambio);
        var diferencia = Math.max(montoMxn, total) - Math.min(montoMxn, total);
        $('#moneda-diferencia').html('MXN');
        var res = moneda == 1 ? diferencia : montoPesos(res, 2, tipoCambio);
        $('#monto-diferencia').html(numberWithCommas(diferencia.toFixed(2)));
        $('#ajuste-por-cambio').val(diferencia.toFixed(2));

        if (diferencia < tolerancia && diferencia > 0) {
            $('#diferencia').show();
        } else {
            $('#diferencia').hide();
            $('#ajuste').removeAttr('checked');
        }
    });
    $('#formFactura').submit(function( event ) {
        var cantidad = $('#importe').val();
        var max_cantidad = $('#importe').data('maxmonto');

        if(cantidad > max_cantidad){
            if(!$('#importe').next().is("div")){
                $('#importe').after('<div class="error-message">Importe debe ser menor a lo cotizado</div>');
            }
            return false;
        }else{
            return true;
        }
    });

    $.validate();
    $('#moneda-id').on('change', function(e){
        moneda = this.options[this.selectedIndex];
        if ( moneda.innerHTML.toLowerCase() == 'usd' ) {
            $('#tipo-cambio').addClass('required');
            $('#tipo-cambio').prop('required', 'required');
            document.querySelector('#tipo-cambio').setAttribute('data-validation', 'required');
            $('#tipo-cambio').parent().addClass('required');
        } else {
            $('#tipo-cambio').removeClass('required');
            $('#tipo-cambio').removeAttr('required');
            document.querySelector('#tipo-cambio').removeAttribute('data-validation');
            $('#tipo-cambio').parent().removeClass('required');
        }
        $('#tipo-cambio').trigger('blur');
        $.validate();
    });

    $('#moneda-id').trigger('change');

</script>
<?= $this->Form->create($factura , ['type'=>'file', 'class'=>'form-horizontal', 'id'=>'formFactura'] ); ?>


<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar Factura</h4>
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
                        <?= $this->Form->input('archivo_file', ['type' => 'file', 'div'=>false, 'class' => 'form-control  ' , 'label' => false]); ?>
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
                            'class' => 'form-control factura-moneda',
                            'default' => $cotizacion->moneda_id,
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
                            'value'=>$factura->tipo_cambio != 0 ? $factura->tipo_cambio : '',
                            'div'=>false,
                            'type'=>'number',
                            'label' => false,
                            'class' => 'form-control factura-tipo-cambio',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <p style="text-align: center;margin: 0;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-span btn-md w-btnAddUsers']) ?>
        </p>   
</div>
<?= $this->Form->end() ?>

<script type="text/javascript">
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
</script>
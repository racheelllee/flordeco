<style type="text/css">
    span.help-block.form-error{
        position: absolute;
        margin-top: 0;
    }
</style>
<div class="ibox">
    <div style="margin-top: 30px" class="w-title w-color666">
        <span >
        <?= __('Add New Quote') ?>
        </span>
    </div>
    <div style="" class="ibox-content">

    <?= $this->Form->create($cotizaciones , [ 
        #'url'=>'/cotizaciones/add/' . $customers->id,
        'id'=>'cotizacion-form',
        'method'=>'post',
        'class'=>'form-horizontal',
        'enctype'=>'multipart/form-data',
        'novalidate'
    ] ); ?>

    <?= $this->Form->input('customer_id', [
        'type' => 'hidden',
        'value' => $customers->id,
    ]); ?>

    <?= $this->Form->input('last_version', [
        'type' => 'hidden',
        'value' => 1,
    ]); ?>

    <?= $this->Form->input('parent', [
        'type' => 'hidden',
    ]); ?>

    <?= $this->Form->input('original', [
        'type' => 'hidden',
    ]); ?>

    <div class="row">
    <div class="col-md-12">
        <hr>
        <h5>DATOS GENERALES</h5>    
        <div class="col-md-6">
            <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?php echo __('Customer'); ?></label>
                    <div class="col-md-8">
                        <?= $this->Form->input('cliente_id', ['type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'form-control', 'value' => $customers->title, 'readonly'=>'readonly']); ?>
                    </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Customer Category'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('categoria_cliente', ['type' => 'text','label'=>false, 'div'=>false, 'class'=>'form-control', 'value' => $customers->customer_category['name'], 'readonly'=>'readonly']); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Customer Contact'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('contacto_cliente_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $contacts]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Segundo Contacto'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('segundo_contacto_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $contacts]); ?>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Branch'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('sucursal_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $branch]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Tipo'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('from_interaction', [
                        'label'     => false,
                        'div'       => false,
                        'options'   => $tipos,
                        'class'     => 'form-control',
                        'type'      => 'select'
                    ]); ?>
                </div>
            </div>
        </div>


    </div>


    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                            <label class="col-md-4 control-label"><?php echo __('Días de Vigencia'); ?></label>
                            <div class="col-md-8">
                               <?= $this->Form->input('vigencia', [
                                    'type'=>'text',
                                    'label'=>false,
                                    'div'=>false,
                                    'data-validation' => 'required',
                                    'class'=>'form-control integer'
                                ]); ?>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">&nbsp;</div>
        </div>
        <div class="col-md-6">
            <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?php echo __('Fecha Solicitud'); ?></label>
                    <div class="col-md-8">
                        <div class="input-group relative-absolute">
                            <?= $this->Form->input('fecha_solicitud', [
                                'type'=>'text',
                                'label'=>false,
                                'div'=>false,
                                'data-validation'=>'required',
                                'class'=>'form-control maxToDay'
                            ]); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                          </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?php echo __('Fecha Entrega Cliente'); ?></label>
                    <div class="col-md-8">
                        <div class="input-group relative-absolute">
                            <?= $this->Form->input('fecha_entrega_cliente', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control minToDay']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                          </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?php echo __('Fecha Entrega Real'); ?></label>
                    <div class="col-md-8">
                        <div class="input-group relative-absolute">
                            <?= $this->Form->input('fecha_entrega_real', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control minToDay']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                          </div>
                    </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Fecha Estimada de compra'); ?></label>
                <div class="col-md-8">
                    <div class="input-group relative-absolute">
                        <?= $this->Form->input('fecha_estimada_compra', [
                            'type'=>'text',
                            'label'=>false,
                            'div'=>false,
                            'class'=>'form-control minToDay'
                        ]); ?>
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                      </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Costo directo de materiales'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('costo_directo_materiales', [
                        'label' => false,
                        'div' => false,
                        'class'=>'form-control',
                        'type' => 'text',
                        'data-validation' => 'number',
                        'data-validation-allowing' => 'float',
                        'data-validation-optional' => 'true',
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('% de Indirecto de materiales'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('costo_indirecto_materiales', [
                        'label' => false,
                        'div' => false,
                        'class'=>'form-control',
                        'type' => 'text',
                        'data-validation' => 'number',
                        'data-validation-allowing' => 'float',
                        'data-validation-optional' => 'true',
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Costo directo de mano de obra'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('costo_directo_obra', [
                        'label' => false,
                        'div' => false,
                        'class'=>'form-control',
                        'type' => 'text',
                        'data-validation' => 'number',
                        'data-validation-allowing' => 'float',
                        'data-validation-optional' => 'true',
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('% de Indirecto de mano de obra'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('costo_indirecto_obra', [
                        'label' => false,
                        'div' => false,
                        'class'=>'form-control',
                        'type' => 'text',
                        'data-validation' => 'number',
                        'data-validation-allowing' => 'float',
                        'data-validation-optional' => 'true',
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('First Seller'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('vendedor_asignado_id', [
                        'div'=>false,
                        'label'=>false,
                        'class'=>'form-control',
                        'options' => $userAssigned,
                        'data-validation' => 'required',
                        'default' => $this->UserAuth->getUserId(),
                        'empty' => '[Selecciona una opción]'
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Second Seller'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('second_seller', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $userAssigned, 'empty' => '[Selecciona una opción]']); ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Company'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('company_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $company]); ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Cargo'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('cargo_id', [
                        'label'=>false,
                        'div'=>false,
                        'class'=>'form-control',
                        'options' => $cargos
                    ]); ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Número de Cotización'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('numero_cotizacion', [
                        'label'=>false,
                        'div'=>false,
                        'class'=>'form-control',
                        'data-validation'=>'required',
                        'type' => 'text'
                    ]); ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Marcas'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('marcas', [
                        'label'     => false,
                        'div'       => false,
                        'multiple'  => true,
                        'options'   => $marcas,
                        'default'   => $marcasSeleccionadas,
                        'class'     => 'form-control',
                        'type'      => 'select'
                    ]); ?>
                </div>
            </div>
        </div>

    </div>

        <div class="col-md-12">
        <hr>
        <h5>DETALLE</h5>


        

        <div class="col-md-12">
            <div class="um-form-row form-group">
            
                <div class="col-md-4">
                    <div class="col-md-6">
                        <label class="control-label"><?php echo __('Subtotal'); ?></label>
                        <?= $this->Form->input('subtotal', [
                            'type'=>'text',
                            'label'=>false,
                            'div'=>false,
                            'data-validation' => 'required',
                            'class'=>'form-control decimal'
                        ]); ?>
                    </div>

                    <div class="col-md-6">
                        <label class="control-label"><?php echo __('Discount'); ?></label>
                        <?= $this->Form->input('descuento', [
                            'label'=>false,
                            'div'=>false,
                            'data-validation' => 'required',
                            'data-validation' => 'number',
                            'data-validation-allowing' => 'range[0.0;' . $customers->discount . '],float',
                            'class'=>'form-control decimal'
                        ]); ?>
                    </div>

                    <div id="cantidad-descuento" class="col-md-12" style="font-size: 12px;visibility: hidden;">
                        <span><b>Monto total:</b></span>
                        <span id="total-descuento">0</span>
                        <?= $this->Form->input('monto_total', ['type'=>'hidden']); ?>
                    </div>

                    <div class="col-md-6">
                        <label class="control-label"><?php echo __('Coin'); ?></label>
                        <?= $this->Form->input('moneda_id', [
                            'label'=>false,
                            'div'=>false,
                            'class'=>'form-control',
                            'options' => $moneda,
                            'id'=>'moneda'
                        ]); ?>
                    </div>

                    <div class="col-md-6">
                        <label class="control-label"><?php echo __('Tipo de Cambio'); ?></label>
                        <?= $this->Form->input('tipo_cambio', [
                            'type'=>'text',
                            'label'=>false,
                            'div'=>false,
                            'class'=>'form-control decimal'
                        ]); ?>
                    </div>
                </div>
                <div class="col-md-8">
                        <label class="control-label"><?php echo __('Descripción'); ?></label>
                        <?= $this->Form->input('descripcion', [
                            'type'=>'textarea',
                            'label'=>false,
                            'div'=>false,
                            'style'=>'height: 110px;',
                            'data-validation'=>'required',
                            'class'=>'form-control'
                        ]); ?>
                </div>
                
            </div>
        </div>
        
        <?= $this->element('Cotizaciones/files') ?>

        </div>

        <div class="col-md-12">
            <hr>
        <h5>CONDICIONES</h5>

        
        

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Payment conditions'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('codiciones_pago', [
                        'label'=>false,
                        'div'=>false,
                        'class'=>'form-control',
                        'options' => $condicionesPago
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Delivery conditions'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('condiciones_entrega', [
                        'type' => 'text',
                        'label'=>false,
                        'div'=>false,
                        'class'=>'form-control',
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('Delivery Time'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('tiempo_entrega', [
                        'type' => 'text',
                        'label'=>false,
                        'div'=>false,
                        'data-validation' => 'required',
                        'class'=>'form-control'
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?php echo __('General Comments'); ?></label>
                <div class="col-md-8">
                    <?= $this->Form->input('comentarios_generales', [
                        'label'=>false,
                        'div'=>false,
                        'data-validation' => 'required',
                        'class'=>'form-control'
                    ]); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
    <br>
    <div class="um-button-row">
        <div class="col-sm-6 button-right">
            <a  class="btn btn-default" onclick="goBack()"><?=__('Cancel')?></a>
        </div>
        <div class="col-md-6">
            <a id="save-button" class="btn btn-primary"><?=__('Guardar')?></a>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
</div>

<script src="/js/cotizaciones.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#second-seller').select2();
        $('#marcas').select2();
        $('#vendedor-asignado-id').select2();
        $('#save-button').on('click', function(ev){
            if( $('#cotizacion-form').isValid() ) {
                $('#previewModal').modal('show');
            }
        });
        $('#subtotal,#descuento').on('change', function(ev){
            var subtotal = $('#subtotal').val();
            var desc  = $('#descuento').val();
            var total = subtotal - ( subtotal * (desc / 100) );
                //total = total > 0 ? total : 0;
            if (subtotal && desc && total > 0) {
                $('#cantidad-descuento').css('visibility','visible');
                $('#total-descuento').html(total);
                $('#monto-total').val(total);
            } else {
                $('#cantidad-descuento').css('visibility','hidden');
            }
        });
    });
</script>
<?= $this->element('/Cotizaciones/preview') ?>
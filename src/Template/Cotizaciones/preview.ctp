    <style type="text/css">
        .data-div{
            font-size: 12px !important;
        }
        .bold-text{
            font-size: 14px !important;
            font-weight: bold;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Customer'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;"><?= $customer->title ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Customer Category'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $customer->customer_category['name'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Customer Contact'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $contacts[$cotizacion->contacto_cliente_id] ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Segundo Contacto'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $contacts[$cotizacion->segundo_contacto_id] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Branch'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;"><?= $branch[$cotizacion->sucursal_id] ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Tipo'); ?></label>
                        <div class="col-md-8 data-div" style="height:auto;"><?= $tipos[$cotizacion->from_interaction] ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                            <label class="col-md-12 bold-text control-label"><?= __('Días de Vigencia'); ?></label>
                            <div class="col-md-8 data-div" style="height: inherit;">
                                <?= $cotizacion->vigencia ?>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    &nbsp;
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                            <label class="col-md-12 bold-text control-label"><?= __('Fecha Solicitud'); ?></label>
                            <div class="col-md-8 data-div" style="height: inherit;">
                                <?= $cotizacion->fecha_solicitud ?>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Fecha Entrega Cliente'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $cotizacion->fecha_entrega_cliente ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Fecha Entrega Real'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $cotizacion->fecha_entrega_real ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Fecha Estimada de compra'); ?></label>
                        <div class="col-md-8 data-div" style="height: inherit;">
                            <?= $cotizacion->fecha_estimada_compra ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Costo directo de materiales'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->costo_directo_materiales ? '$ ' . number_format($cotizacion->costo_directo_materiales, 2) : '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('% de Indirecto de materiales'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->costo_indirecto_materiales ? $cotizacion->costo_indirecto_materiales . ' %' : '-' ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Costo directo de mano de obra'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->costo_directo_obra ? '$ ' . number_format($cotizacion->costo_directo_obra, 2) : '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('% de Indirecto de mano de obra'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->costo_indirecto_obra ? $cotizacion->costo_indirecto_obra . ' %' : '-' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('First Seller'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->vendedor_asignado_id ? $users[$cotizacion->vendedor_asignado_id] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Second Seller'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->second_seller ? $users[$cotizacion->second_seller] : '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Company'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->company_id ? $companies[$cotizacion->company_id] : '' ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Cargo'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->cargo_id ? $cargos[$cotizacion->cargo_id] : '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                 <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Número de Cotización'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $cotizacion->numero_cotizacion ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Marcas'); ?></label>
                        <div class="col-md-8 data-div" style="height:auto;"><?= (!empty($marcasSeleccionadas))? implode(', ', $marcasSeleccionadas):'' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="um-form-row form-group" style="padding-right: 0;">
                        <label class="col-md-12 bold-text control-label"><?= __('Subtotal'); ?></label>
                        <div class="col-md-12 data-div" style="padding-right: 0;">
                            $ <?= number_format($cotizacion->subtotal, 2) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="um-form-row form-group" style="padding-right: 0;">
                        <label class="col-md-12 bold-text control-label"><?= __('Discount'); ?></label>
                        <div class="col-md-12 data-div" style="padding-right: 0;">
                            <?= number_format($cotizacion->descuento, 2) ?> %
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="um-form-row form-group" style="padding-right: 0;">
                        <label class="col-md-12 bold-text control-label"><?= __('Total'); ?></label>
                        <div class="col-md-12 data-div" style="padding-right: 0;">
                            $ <?= number_format($cotizacion->monto_total, 2) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Coin'); ?></label>
                        <div class="col-md-8 data-div">
                            <?= $monedas[$cotizacion->moneda_id] ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Tipo de Cambio'); ?></label>
                        <div class="col-md-8 data-div">
                            $ <?= number_format($cotizacion->tipo_cambio, 2) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Descripción'); ?></label>
                        <div class="col-md-12 data-div">
                            <?= $cotizacion->descripcion ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Payment conditions'); ?></label>
                        <div class="col-md-8 data-div"><?= $condicionesPago[$cotizacion->codiciones_pago] ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Delivery conditions'); ?></label>
                        <div class="col-md-8 data-div"><?= $cotizacion->condiciones_entrega ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('Delivery Time'); ?></label>
                        <div class="col-md-8 data-div"><?= $cotizacion->tiempo_entrega ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="um-form-row form-group">
                        <label class="col-md-12 bold-text control-label"><?= __('General Comments'); ?></label>
                        <div class="col-md-8 data-div"><?= $cotizacion->comentarios_generales ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <br>
    </div>
    <div class="um-button-row">
        <div class="col-sm-12 button-right">
            <a data-dismiss="modal" class="btn btn-default"><?=__('Regresar')?></a>
            <a id="submit-button" class="btn btn-primary"><?=__('Guardar')?></a>
        </div>
    </div>
    <script type="text/javascript">
        $('#submit-button').on('click', function(ev){
            $(this).prop('disabled', 'disabled');
            $('#cotizacion-form').submit();
        });
    </script>
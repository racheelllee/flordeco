<div class="ibox">
    <div style="margin-top: 30px" class="w-title w-color666">
        <span >
        <?= __('View Quote') ?>
        </span>
    </div>
    <div style="" class="ibox-content">

    <?= $this->Form->create($cotizaciones , [ 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data'] ); ?>
   
       
    <div class="row">
    <div class="col-md-12">
        <hr>
        <h5>DATOS GENERALES</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                        <label class="col-md-4 control-label"><?= __('Customer'); ?></label>
                        <div class="col-md-8 pseudo-input" style="height: inherit;"><?= $customers->title ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Customer Category'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;"><?= $customers->customer_category['name'] ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Customer Contact'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;">
                        <?= $contacts[$cotizaciones->contacto_cliente_id] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Segundo Contacto'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;">
                        <?= $contacts[$cotizaciones->segundo_contacto_id] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Branch'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;"><?= $branch[$cotizaciones->sucursal_id] ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Tipo'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height:auto;"><?= $tipos[$cotizaciones->from_interaction] ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                        <label class="col-md-4 control-label"><?= __('Días de Vigencia'); ?></label>
                        <div class="col-md-8 pseudo-input" style="height: inherit;"><?= $cotizaciones->vigencia ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                        <label class="col-md-4 control-label"><?= __('Fecha Solicitud'); ?></label>
                        <div class="col-md-8 pseudo-input" style="height: inherit;"><?= (!empty($cotizaciones->fecha_solicitud))? $cotizaciones->fecha_solicitud->format('d/m/Y') : '' ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                        <label class="col-md-4 control-label"><?= __('Fecha Entrega Cliente'); ?></label>
                        <div class="col-md-8 pseudo-input" style="height: inherit;"><?= (!empty($cotizaciones->fecha_entrega_cliente))? $cotizaciones->fecha_entrega_cliente->format('d/m/Y') : '' ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Fecha Entrega Real'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;">
                        <?= (!empty($cotizaciones->fecha_entrega_real)) ?
                            $cotizaciones->fecha_entrega_real->format('d/m/Y') : ''
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Fecha Estimada de compra'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height: inherit;">
                        <?= (!empty($cotizaciones->fecha_estimada_compra)) ?
                            $cotizaciones->fecha_estimada_compra->format('d/m/Y') : '&nbsp;'
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Costo directo de materiales'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->costo_directo_materiales ? '$ ' . number_format($cotizaciones->costo_directo_materiales, 2) : '' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('% de Indirecto de materiales'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->costo_indirecto_materiales ? $cotizaciones->costo_indirecto_materiales . ' %' : '-' ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Costo directo de mano de obra'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->costo_directo_obra ? '$ ' . number_format($cotizaciones->costo_directo_obra, 2) : '' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('% de Indirecto de mano de obra'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->costo_indirecto_obra ? $cotizaciones->costo_indirecto_obra . ' %' : '-' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('First Seller'); ?></label>
                    <div class="col-md-8 pseudo-input">
                            <?= $cotizaciones->user->first_name.' '.$cotizaciones->user->last_name.' '.$cotizaciones->user->clast_name ?>
                        </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Second Seller'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->second->first_name.' '.$cotizaciones->second->last_name.' '.$cotizaciones->second->clast_name ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Company'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->company->name ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Cargo'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->cargo->numero ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
             <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Número de Cotización'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->numero_cotizacion ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Marcas'); ?></label>
                    <div class="col-md-8 pseudo-input" style="height:auto;"><?= (!empty($marcasName))? implode(', ', $marcasName):'' ?></div>
                </div>
            </div>

        </div>

        <div class="row">
             <div class="col-md-6">
                <div class="um-form-row form-group">
                    <label class="col-md-4 control-label"><?= __('Número de Orden de Compra'); ?></label>
                    <div class="col-md-8 pseudo-input">
                        <?= $cotizaciones->num_orden_compra ?>
                    </div>
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
                        <label class="control-label"><?= __('Monto'); ?></label>
                        <div class="col-md-12 pseudo-input">$ <?= number_format($cotizaciones->monto_total, 2) ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label"><?= __('Discount'); ?></label>
                        <div class="col-md-12 pseudo-input"><?= number_format($cotizaciones->descuento, 2) ?> %</div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label"><?= __('Coin'); ?></label>
                        <div class="col-md-12 pseudo-input"><?= $cotizaciones->moneda->name ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label"><?= __('Tipo de Cambio'); ?></label>
                        <div class="col-md-12 pseudo-input">$ <?= number_format($cotizaciones->tipo_cambio, 2) ?></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="control-label"><?= __('Descripción'); ?></label>
                    <div style="height: 90px;overflow-y: scroll;" class="col-md-12 pseudo-input"><?= $cotizaciones->descripcion ?></div>
                </div>
            </div>
        </div>
        
        <?php if($cotizaciones->status_id != 4){ ?>
            <?= $this->element('Cotizaciones/files') ?>
        <?php } ?>

        </div>

        <div class="col-md-12">
            <hr>
        <h5>CONDICIONES</h5>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?= __('Payment conditions'); ?></label>
                <div class="col-md-8 pseudo-input"><?= $condicionesPago[$cotizaciones->codiciones_pago] ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?= __('Delivery conditions'); ?></label>
                <div class="col-md-8 pseudo-input"><?= $cotizaciones->condiciones_entrega ?></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?= __('Delivery Time'); ?></label>
                <div class="col-md-8 pseudo-input"><?= $cotizaciones->tiempo_entrega ?></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="um-form-row form-group">
                <label class="col-md-4 control-label"><?= __('General Comments'); ?></label>
                <div class="col-md-8 pseudo-input"><?= $cotizaciones->comentarios_generales ?></div>
            </div>
        </div>
        </div>
    </div>
                    
    <div class="um-button-row">
        <div class="col-sm-6 button-right">
            <a  class="btn btn-default" onclick="goBack()"><?=__('Regresar')?></a>
        </div>
       
        
    </div>
    <?= $this->Form->end() ?>
</div>
</div>


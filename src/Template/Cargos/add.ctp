<style type="text/css">.input.textarea.required label,.input.text.required label{color: #333 !important;}</style>
<div class="ibox">
    <div class="ibox-content">
    <?= $this->Form->create($cargos , [ 'class'=>'form-horizontal'] ); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.numero', [
                            'div'=>false,
                            'class' => 'form-control',
                            'label' => __('Number'),
                            'value' => $getNumber->numero + 1
                        ]); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.sucursal_id', [
                            'div'=>false,
                            'class' => 'form-control',
                            'options'=>$offices,
                            'label' => __('Branch'),
                            'default' => $customers->office_id
                        ]); ?>
                    </div> 
                </div>
            </div>

            <div class="col-xs-12 clearfix">
                <div class="um-form-row form-group">
                    <label class="col-sm-12 control-label" style="text-align: left;padding-left: 14px;"><?=  __('Customer'); ?></label>
                    <div class="col-sm-12">
                        <span style="margin-top: 5px; z-index: 1;"><?= h($customers->title) ?></span>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.descripcion', [
                            'div'=>false,
                            'class' => 'form-control',
                            'label' => __('Description')
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.tipo_obra', [
                            'options' => $tiposObra,
                            'label'  => 'Tipo de Obra',
                            'class' => 'form-control',
                            'div' => false,
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.fecha_apertura', [
                            'div' => false,
                            'class' => 'form-control datepicker',
                            'type' => 'text',
                            'label' => 'Fecha de Apertura',
                            'value' => '',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.supervisor_id', ['div'=>false, 'class' => 'form-control select2','options'=>$users,'label' => 'Supervisor responsable']); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.status_id', ['div'=>false, 'class' => 'form-control','options'=>$cargosStatuses,'label' => __('Status')]); ?>
                    </div>
                </div>
            </div>  
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.company_id', [
                            'div' => false,
                            'class' => 'form-control',
                            'options' => $companies,
                            'label' => __('Company')
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.costo_directo_material', [
                            'div' => false,
                            'class' => 'form-control',
                            'type' => 'number',
                            'min' => 1,
                            'step' => 1,
                            'data-validation' => 'number',
                            'data-validation-allowing' => 'float',
                            'data-validation-optional' => 'true',
                            'label' => 'Costo Directo de Materiales'
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.costo_directo_obra', [
                            'div' => false,
                            'class' => 'form-control',
                            'type' => 'number',
                            'min' => 1,
                            'step' => 1,
                            'data-validation' => 'number',
                            'data-validation-allowing' => 'float',
                            'data-validation-optional' => 'true',
                            'label' => 'Costo Directo de Mano de Obra'
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.fecha_estimada_cierre', [
                            'div' => false,
                            'class' => 'form-control datepicker',
                            'type' => 'text',
                            'label' => 'Fecha Estimada de Cierre',
                            'value' => '',
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="um-form-row form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->input('Cargos.observaciones', [
                            'div' => false,
                            'class' => 'form-control',
                            'label' => 'Observaciones'
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p style="text-align: center;margin: 0;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-span btn-md w-btnAddUsers']) ?>
    </p>                     
    <?= $this->Form->end() ?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.select2').select2();
    });
</script>
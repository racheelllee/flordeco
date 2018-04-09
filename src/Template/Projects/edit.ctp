<div class="row">
    <div class="col-xs-6 w-title w-color666" style="margin-top:30px;">
    
      <?php echo __('Edit Project');?>
    
    </div>
    
</div>
<div style="margin-top:30px;">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#datos_generales" data-toggle="tab"> DATOS GENERALES </a>
        </li>
        <li>
            <a href="#estudios_ingenierias" data-toggle="tab"> ESTUDIOS E INGENIERÍAS </a>
        </li>
        <li>
            <a href="#staff_diseno" data-toggle="tab"> STAFF DISEÑO </a>
        </li>
        <li>
            <a href="#construccion" data-toggle="tab"> CONSTRUCCIÓN </a>
        </li>
    </ul>

    <?= $this->Form->create($project , [ 'class'=>'form-horizontal'] ); ?>

    <div class="tab-content">
        <div class="tab-pane fade active in" id="datos_generales">
            <br>
            <?= __('DATOS DEL PROYECTO') ?>

            <!-- DATOS GENERALES -->
            <div class="row">
                <div class="col-sm-6">
                
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proyecto_nombre'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proyecto_nombre', [ 'div'=>false, 'class' => 'form-control  ' , 'label' => false]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proyecto_tamano'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proyecto_tamano', [ 'div'=>false, 'class' => 'form-control bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$proyecto_tamano]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Proyecto_inicio'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('proyecto_inicio', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->proyecto_inicio ))? $project->proyecto_inicio->format('d/m/Y'):""]); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                </div>


                <div class="col-sm-6">
                
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proyecto_ubicacion'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proyecto_ubicacion', [ 'div'=>false, 'class' => 'form-control  ' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proyecto_complejidad'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proyecto_complejidad', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$proyecto_complejidad]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Proyecto_final_entrega_ejecutivo'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('proyecto_final_entrega_ejecutivo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->proyecto_final_entrega_ejecutivo ))? $project->proyecto_final_entrega_ejecutivo->format('d/m/Y'):""]); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr>
            
            <?= __('DATOS DEL CLIENTE') ?>
            

            <!-- DATOS DEL CLIENTE -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_nombre'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_nombre', ['label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_telefono'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_telefono', ['label'=>false,'div'=>false, 'class'=>'form-control phone']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_correo'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_correo', ['label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
            
                        <label class="col-sm-6 control-label" >

                        <?=  __('Cliente_color'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('cliente_color', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$cliente_color]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Servicio_vip'); ?>

                        </label>

                        <div class="col-sm-6">

                            <?= $this->Form->input('servicio_vip',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    
                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_nombre'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_nombre2', ['label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_telefono'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_telefono2', ['label'=>false,'div'=>false, 'class'=>'form-control phone']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
                      <label class="col-sm-6 control-label"><?=  __('Cliente_correo'); ?></label>
                        <div class="col-sm-6">
                          <div class="input-group relative-absolute">
                            <?= $this->Form->input('cliente_correo2', ['label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </button>
                            </span>
                          </div>
                        </div>
                    </div>

                    <div class="um-form-row form-group">
            
                        <label class="col-sm-6 control-label" >

                        <?=  __('Cliente_color'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('cliente_color2', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$cliente_color]); ?>

                        </div>
                    </div>
                </div>
            </div>


            <hr>
            
            <?= __('TIPO DE CONTRATO') ?>

            <!-- TIPO DE CONTRATO -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Contrato_tipo_residencial'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('contrato_tipo_residencial', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$contrato_tipo_residencial]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_construccion_contratada'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_construccion_contratada', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_terreno'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_terreno', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_volados'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_volados', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Contrato_tipo_interiores'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('contrato_tipo_interiores', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$contrato_tipo_interiores]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                            <?=  __('M2_construccion_disenada'); ?>

                            </label>

                            <div class="col-sm-8">

                            <?= $this->Form->input('m2_construccion_disenada', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_interiores'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_interiores', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_cocheras_bodegas'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_cocheras_bodegas', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="um-form-row form-group">

                        <label class="col-sm-4 control-label" >

                        <?=  __('Contrato_tipo_supervision'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('contrato_tipo_supervision', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$contrato_tipo_supervision]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_construccion_diferencia'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_construccion_diferencia', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('M2_terrazas'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('m2_terrazas', [ 'div'=>false, 'class' => 'form-control  integer' , 'label' => false]); ?>

                        </div>
                    </div>

                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Precio_m2'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('precio_m2', [ 'div'=>false, 'class' => 'form-control' , 'label' => false]); ?>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="estudios_ingenierias">
            
            <br>

            <?= __('GESTORÍA') ?>
            

            <!-- GESTORÍA -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Gestor'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('gestor', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Status_licencia_constructor'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('status_licencia_constructor', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$estatus_licencia_conductor]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>
            
            <?= __('ESTUDIO PREVIOS') ?>
            

            <!-- ESTUDIO PREVIOS -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Estudio_topografico'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('estudio_topografico', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Estudio_mecanica_suelos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('estudio_mecanica_suelos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Estudios_otros'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('estudios_otros', [ 'div'=>false, 'class' => 'form-control  ' , 'label' => false]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Estudio_geologico'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('estudio_geologico', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Estudio_hidrologico'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('estudio_hidrologico', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>
            
            <?= __('INGENIERÍA EXTERNAS') ?>
            

            <!--'INGENIERÍA EXTERNAS -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_cocina'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_cocina', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio, 'empty'=>'NA']); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_iluminacion_contactos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_iluminacion_contactos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_aire_acondicionado'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_aire_acondicionado', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_hidro_sanitaria_gas_pluvial'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_hidro_sanitaria_gas_pluvial', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_automatizacion'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_automatizacion', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_calef_hidronica'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_calef_hidronica', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_paisaje'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_paisaje', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_estructural'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_estructural', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_electrica'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_electrica', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_alberca'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_alberca', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_planos_ing_paneles_solares'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_planos_ing_paneles_solares', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Proveedor_otros_planos_ingenierias'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('proveedor_otros_planos_ingenierias', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="tab-pane fade" id="staff_diseno">

            <br>

            <?= __('STAFF P. RESIDENCIAL') ?>
            
            <!-- STAFF P. RESIDENCIAL -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Responsable_podiseno'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('responsable_podiseno', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Responsable_poejecutivo'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('responsable_poejecutivo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Responsable_pointeriores'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('responsable_pointeriores', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Responsable_pocruce_ingenierias'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('responsable_pocruce_ingenierias', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('STAFF P. DIAGNÓSTICO') ?>
            
            <!--'STAFF P. DIAGNÓSTICO -->
            <div class="row">

                <div class="col-sm-4">
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_str_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_str_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_str_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_str_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_iluminacion_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_iluminacion_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_hid_san_gas_plu_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_hid_san_gas_plu_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_inst_especiales_responsable'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_inst_especiales_responsable', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Status_construccion_contratar_supervision'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('status_construccion_contratar_supervision', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$estatus_construccion]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Muros_contencion_barda_perimetral'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('muros_contencion_barda_perimetral',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                    
                </div>

                <div class="col-sm-4">
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_str_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_str_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_str_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_str_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_iluminacion_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_ac_iluminacion_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_hid_san_gas_plu_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_hid_san_gas_plu_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_inst_especiales_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('cruce_inst_especiales_vobo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Tipo_terreno'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('tipo_terreno', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$tipo_terreno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Categoria_estructura'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('categoria_estructura', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$categoria_estructura]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Alberca_cimentacion_misma_etapa'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('alberca_cimentacion_misma_etapa',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_str_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_str_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_str_fecha_vobo ))? $project->cruce_str_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_ac_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_ac_fecha_vobo ))? $project->cruce_ac_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_str_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_ac_str_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_ac_str_fecha_vobo ))? $project->cruce_ac_str_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_ac_iluminacion_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_ac_iluminacion_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_ac_iluminacion_fecha_vobo ))? $project->cruce_ac_iluminacion_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_hid_san_gas_plu_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_hid_san_gas_plu_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_hid_san_gas_plu_fecha_vobo ))? $project->cruce_hid_san_gas_plu_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Cruce_inst_especiales_fecha_vobo'); ?>

                        </label>

                        <div class="col-sm-8">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('cruce_inst_especiales_fecha_vobo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->cruce_inst_especiales_fecha_vobo ))? $project->cruce_inst_especiales_fecha_vobo->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Tipo_suelo'); ?>

                        </label>

                        <div class="col-sm-8">

                        <?= $this->Form->input('tipo_suelo', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$tipo_suelo]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-4 control-label" >

                        <?=  __('Muros_contencion_casa'); ?>

                        </label>

                        <div class="col-sm-8">

                            <?= $this->Form->input('muros_contencion_casa',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('STAFF P. SUPERVISIÓN') ?>
            
            <!--'STAFF P. SUPERVISIÓN -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Encargado_sup_admon'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('encargado_sup_admon', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Supervisor_asignado'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('supervisor_asignado', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Etapa_6a_buffer_obra_civil'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('etapa_6a_buffer_obra_civil',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Etapa_6b__buffer_preacabados'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('etapa_6b__buffer_preacabados',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Etapa_6c_buffer_acab_gruesos'); ?>

                        </label>

                        <div class="col-sm-6">

                            <?= $this->Form->input('etapa_6c_buffer_acab_gruesos',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Etapa_6d_buffer_acab_finos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('etapa_6d_buffer_acab_finos',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Encargado_sup_oper'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('encargado_sup_oper', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Dia_hora_sup_bernardo'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('dia_hora_sup_bernardo', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datetimepicker', 'data-format'=>'dd/MM/yyyy hh:mm:ss', 'value' => (!empty( $project->dia_hora_sup_bernardo ))? $project->dia_hora_sup_bernardo->format('d/m/Y H:m:s'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_etapa_6a'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_etapa_6a', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_etapa_6a ))? $project->fecha_etapa_6a->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    
                    
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_etapa_6b'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_etapa_6b', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_etapa_6b ))? $project->fecha_etapa_6b->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_etapa_6c'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_etapa_6c', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_etapa_6c ))? $project->fecha_etapa_6c->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_etapa_6d'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_etapa_6d', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_etapa_6d ))? $project->fecha_etapa_6d->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="construccion">

            <br>

            <?= __('CONSTRUCTOR') ?>
            
            <!--'CONSTRUCTOR -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Constructor_jefe'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('constructor_jefe', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Contratista_asignado_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('contratista_asignado_obra', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Constructor_residente_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('constructor_residente_obra', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Velador_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('velador_obra', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('GDP') ?>
            
            <!--'GDP -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Gerencia_proyectos_gdp'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('gerencia_proyectos_gdp', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Gdp_asignado2_proyecto'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('gdp_asignado2_proyecto', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Gdp_asignado1_proyecto'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('gdp_asignado1_proyecto', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Gdp_asignado3_proyecto'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('gdp_asignado3_proyecto', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('CONTRATO DE OBRA') ?>
            
            <!--'CONTRATO DE OBRA -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_inicio_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_inicio_obra', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_inicio_obra ))? $project->fecha_inicio_obra->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_real_fin_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_real_fin_obra', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_real_fin_obra ))? $project->fecha_real_fin_obra->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Fecha_contratada_fin_obra'); ?>

                        </label>

                        <div class="col-sm-6">

                            <div class="input-group relative-absolute">
                                <?= $this->Form->input('fecha_contratada_fin_obra', ['type'=>'text', 'label'=>false,'div'=>false, 'class'=>'form-control datepicker', 'value' => (!empty( $project->fecha_contratada_fin_obra ))? $project->fecha_contratada_fin_obra->format('d/m/Y'):""]); ?>
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('SUBCONTRATAS') ?>
            
            <!--'SUBCONTRATAS -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Obra_civil_pre_acabados_herreria_tipo1'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('obra_civil_pre_acabados_herreria_tipo1', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Cocina_muebles_fijos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('cocina_muebles_fijos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                     <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Aire_acondicionado'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('aire_acondicionado', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Calefaccion_hidronica'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('calefaccion_hidronica', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Asador'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('asador', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Alarmas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('alarmas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Automatizacion'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('automatizacion', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_granito'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_granito', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_piedra_natural_otro'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_piedra_natural_otro', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_alucobond_aluminio_compuesto'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_alucobond_aluminio_compuesto', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_piedra_sintetica_cubiertas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_piedra_sintetica_cubiertas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_otros'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_otros', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_canceles'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_canceles', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_herrajes_puertas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_herrajes_puertas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_carpinteria_lambrines'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_carpinteria_lambrines', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_carpinteria_buffeteros'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_carpinteria_buffeteros', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_carpinteria_otros'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_carpinteria_otros', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_herreria2_barandillas_pergolados'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_herreria2_barandillas_pergolados', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_lamparas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_lamparas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_muebles_fijos_bano'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_muebles_fijos_bano', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Elevador'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('elevador', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Cocina_equipos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('cocina_equipos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Equipo_alberca'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('equipo_alberca', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Landscape'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('landscape', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Solatube'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('solatube', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Paneles_solares'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('paneles_solares', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_marmol'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_marmol', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_cantera'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_cantera', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_granulado'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_granulado', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_madera_sintetica'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_madera_sintetica', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_grueso_concreto_lavado'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_grueso_concreto_lavado', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_ventanas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_ventanas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_espejos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_espejos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_carpinteria_puertas'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_carpinteria_puertas', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_carpinteria_muebles_empotrados'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_carpinteria_muebles_empotrados', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_carpinteria_bar'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_carpinteria_bar', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_finos_herreria3_especiales'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_finos_herreria3_especiales', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_acc_apagadores_contactos'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_acc_apagadores_contactos', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Acab_fijos_accesorios_de_bano'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('acab_fijos_accesorios_de_bano', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio]); ?>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?= __('FINAL DE OBRA') ?>
            
            <!--'FINAL DE OBRA -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Entrega_planos_asbuilt'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('entrega_planos_asbuilt',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>   
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Asignado_servicio_postventa'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('asignado_servicio_postventa', [ 'div'=>false, 'class' => 'form-control  bs-select' , 'label' => false, 'empty'=>'-- Selecciona una opción --', 'data-live-search'=>'true', 'options'=>$directorio_interno]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Servicio_postventa'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('servicio_postventa',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                    <div class="um-form-row form-group">
                        <label class="col-sm-6 control-label" >

                        <?=  __('Entrega_garantias'); ?>

                        </label>

                        <div class="col-sm-6">

                        <?= $this->Form->input('entrega_garantias',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $si_no
                                ]);?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <br><br>
        <div class="col-sm-6 button-right">
            <a  class="btn btn-default" href="/projects"><?=__('Cancel')?></a>
        </div>
        <div class="col-sm-6">
            <?= $this->Form->button( __('Save' ) , ['class'=>'btn btn-span btn-md w-btnAddUsers'  ]) ?>
        </div>
    </div>
    
    <?= $this->Form->end() ?>
</div>
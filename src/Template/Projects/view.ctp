
<div class="ibox">
    <div class="ibox-title">

        <h5> <?php echo __('project Details'); ?> </h5>

        <span class="ibox-tools">
            

            <?= $this->Html->link(__('PDF'), ['action' => 'view', '_ext'=>'pdf' , $project->id] , ['class'=>'btn btn-primary btn-xs pull-right']) ?>

            <?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id] , ['class'=>'btn btn-primary btn-xs pull-right']) ?>

        </span>

    </div>

    <div class="ibox-content">
        
  

<dl class="dl-horizontal">

        
                       
                        <dt><?= __('Proyecto Nombre') ?>:</dt> 
                    <dd><?= h($project->proyecto_nombre) ?></dd>
                
          
                       
                        <dt><?= __('Proyecto Ubicacion') ?>:</dt> 
                    <dd><?= h($project->proyecto_ubicacion) ?></dd>
                
          
                       
                        <dt><?= __('Cliente Nombre') ?>:</dt> 
                    <dd><?= h($project->cliente_nombre) ?></dd>
                
          
                       
                        <dt><?= __('Cliente Telefono') ?>:</dt> 
                    <dd><?= h($project->cliente_telefono) ?></dd>
                
          
                       
                        <dt><?= __('Cliente Correo') ?>:</dt> 
                    <dd><?= h($project->cliente_correo) ?></dd>
                
          
                       
                        <dt><?= __('Estudios Otros') ?>:</dt> 
                    <dd><?= h($project->estudios_otros) ?></dd>
                
          
                       
                        <dt><?= __('User') ?>:</dt>
                    <dd><?= $project->has('user') ? $this->Html->link($project->user->id, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></dd>
                
          
                
    


        
                       
        <dt><?= __('Id') ?>:</dt> 
            <dd><?= $this->Number->format($project->id) ?></dd>
         
                       
        <dt><?= __('Proyecto Tamano') ?>:</dt> 
            <dd><?= $this->Number->format($project->proyecto_tamano) ?></dd>
         
                       
        <dt><?= __('Proyecto Complejidad') ?>:</dt> 
            <dd><?= $this->Number->format($project->proyecto_complejidad) ?></dd>
         
                       
        <dt><?= __('Cliente Color') ?>:</dt> 
            <dd><?= $this->Number->format($project->cliente_color) ?></dd>
         
                       
        <dt><?= __('Contrato Tipo Residencial') ?>:</dt> 
            <dd><?= $this->Number->format($project->contrato_tipo_residencial) ?></dd>
         
                       
        <dt><?= __('Contrato Tipo Interiores') ?>:</dt> 
            <dd><?= $this->Number->format($project->contrato_tipo_interiores) ?></dd>
         
                       
        <dt><?= __('Contrato Tipo Supervision') ?>:</dt> 
            <dd><?= $this->Number->format($project->contrato_tipo_supervision) ?></dd>
         
                       
        <dt><?= __('Precio M2') ?>:</dt> 
            <dd><?= $this->Number->format($project->precio_m2) ?></dd>
         
                       
        <dt><?= __('M2 Construccion Contratada') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_construccion_contratada) ?></dd>
         
                       
        <dt><?= __('M2 Construccion Disenada') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_construccion_disenada) ?></dd>
         
                       
        <dt><?= __('M2 Construccion Diferencia') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_construccion_diferencia) ?></dd>
         
                       
        <dt><?= __('M2 Terreno') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_terreno) ?></dd>
         
                       
        <dt><?= __('M2 Interiores') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_interiores) ?></dd>
         
                       
        <dt><?= __('M2 Terrazas') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_terrazas) ?></dd>
         
                       
        <dt><?= __('M2 Volados') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_volados) ?></dd>
         
                       
        <dt><?= __('M2 Cocheras Bodegas') ?>:</dt> 
            <dd><?= $this->Number->format($project->m2_cocheras_bodegas) ?></dd>
         
                       
        <dt><?= __('Gestor') ?>:</dt> 
            <dd><?= $this->Number->format($project->gestor) ?></dd>
         
                       
        <dt><?= __('Status Licencia Constructor') ?>:</dt> 
            <dd><?= $this->Number->format($project->status_licencia_constructor) ?></dd>
         
                       
        <dt><?= __('Estudio Topografico') ?>:</dt> 
            <dd><?= $this->Number->format($project->estudio_topografico) ?></dd>
         
                       
        <dt><?= __('Estudio Mecanica Suelos') ?>:</dt> 
            <dd><?= $this->Number->format($project->estudio_mecanica_suelos) ?></dd>
         
                       
        <dt><?= __('Estudio Hidrologico') ?>:</dt> 
            <dd><?= $this->Number->format($project->estudio_hidrologico) ?></dd>
         
                       
        <dt><?= __('Estudio Geologico') ?>:</dt> 
            <dd><?= $this->Number->format($project->estudio_geologico) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Cocina') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_cocina) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Paisaje') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_paisaje) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Iluminacion Contactos') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_iluminacion_contactos) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Estructural') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_estructural) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Aire Acondicionado') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_aire_acondicionado) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Electrica') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_electrica) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Hidro Sanitaria Gas Pluvial') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_hidro_sanitaria_gas_pluvial) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Alberca') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_alberca) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Automatizacion') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_automatizacion) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Paneles Solares') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_paneles_solares) ?></dd>
         
                       
        <dt><?= __('Proveedor Planos Ing Calef Hidronica') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_planos_ing_calef_hidronica) ?></dd>
         
                       
        <dt><?= __('Proveedor Otros Planos Ingenierias') ?>:</dt> 
            <dd><?= $this->Number->format($project->proveedor_otros_planos_ingenierias) ?></dd>
         
                       
        <dt><?= __('Responsable Podiseno') ?>:</dt> 
            <dd><?= $this->Number->format($project->responsable_podiseno) ?></dd>
         
                       
        <dt><?= __('Responsable Pointeriores') ?>:</dt> 
            <dd><?= $this->Number->format($project->responsable_pointeriores) ?></dd>
         
                       
        <dt><?= __('Responsable Poejecutivo') ?>:</dt> 
            <dd><?= $this->Number->format($project->responsable_poejecutivo) ?></dd>
         
                       
        <dt><?= __('Responsable Pocruce Ingenierias') ?>:</dt> 
            <dd><?= $this->Number->format($project->responsable_pocruce_ingenierias) ?></dd>
         
                       
        <dt><?= __('Cruce Str Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_str_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Str Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_str_vobo) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_vobo) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Str Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_str_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Str Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_str_vobo) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Iluminacion Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_iluminacion_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Ac Iluminacion Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_ac_iluminacion_vobo) ?></dd>
         
                       
        <dt><?= __('Cruce Hid San Gas Plu Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_hid_san_gas_plu_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Hid San Gas Plu Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_hid_san_gas_plu_vobo) ?></dd>
         
                       
        <dt><?= __('Cruce Inst Especiales Responsable') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_inst_especiales_responsable) ?></dd>
         
                       
        <dt><?= __('Cruce Inst Especiales Vobo') ?>:</dt> 
            <dd><?= $this->Number->format($project->cruce_inst_especiales_vobo) ?></dd>
         
                       
        <dt><?= __('Status Construccion Contratar Supervision') ?>:</dt> 
            <dd><?= $this->Number->format($project->status_construccion_contratar_supervision) ?></dd>
         
                       
        <dt><?= __('Tipo Terreno') ?>:</dt> 
            <dd><?= $this->Number->format($project->tipo_terreno) ?></dd>
         
                       
        <dt><?= __('Tipo Suelo') ?>:</dt> 
            <dd><?= $this->Number->format($project->tipo_suelo) ?></dd>
         
                       
        <dt><?= __('Categoria Estructura') ?>:</dt> 
            <dd><?= $this->Number->format($project->categoria_estructura) ?></dd>
         
                       
        <dt><?= __('Encargado Sup Admon') ?>:</dt> 
            <dd><?= $this->Number->format($project->encargado_sup_admon) ?></dd>
         
                       
        <dt><?= __('Encargado Sup Oper') ?>:</dt> 
            <dd><?= $this->Number->format($project->encargado_sup_oper) ?></dd>
         
                       
        <dt><?= __('Supervisor Asignado') ?>:</dt> 
            <dd><?= $this->Number->format($project->supervisor_asignado) ?></dd>
         
                       
        <dt><?= __('Constructor Jefe') ?>:</dt> 
            <dd><?= $this->Number->format($project->constructor_jefe) ?></dd>
         
                       
        <dt><?= __('Constructor Residente Obra') ?>:</dt> 
            <dd><?= $this->Number->format($project->constructor_residente_obra) ?></dd>
         
                       
        <dt><?= __('Contratista Asignado Obra') ?>:</dt> 
            <dd><?= $this->Number->format($project->contratista_asignado_obra) ?></dd>
         
                       
        <dt><?= __('Velador Obra') ?>:</dt> 
            <dd><?= $this->Number->format($project->velador_obra) ?></dd>
         
                       
        <dt><?= __('Gerencia Proyectos Gdp') ?>:</dt> 
            <dd><?= $this->Number->format($project->gerencia_proyectos_gdp) ?></dd>
         
                       
        <dt><?= __('Gdp Asignado1 Proyecto') ?>:</dt> 
            <dd><?= $this->Number->format($project->gdp_asignado1_proyecto) ?></dd>
         
                       
        <dt><?= __('Gdp Asignado2 Proyecto') ?>:</dt> 
            <dd><?= $this->Number->format($project->gdp_asignado2_proyecto) ?></dd>
         
                       
        <dt><?= __('Gdp Asignado3 Proyecto') ?>:</dt> 
            <dd><?= $this->Number->format($project->gdp_asignado3_proyecto) ?></dd>
         
                       
        <dt><?= __('Obra Civil Pre Acabados Herreria Tipo1') ?>:</dt> 
            <dd><?= $this->Number->format($project->obra_civil_pre_acabados_herreria_tipo1) ?></dd>
         
                       
        <dt><?= __('Elevador') ?>:</dt> 
            <dd><?= $this->Number->format($project->elevador) ?></dd>
         
                       
        <dt><?= __('Cocina Muebles Fijos') ?>:</dt> 
            <dd><?= $this->Number->format($project->cocina_muebles_fijos) ?></dd>
         
                       
        <dt><?= __('Cocina Equipos') ?>:</dt> 
            <dd><?= $this->Number->format($project->cocina_equipos) ?></dd>
         
                       
        <dt><?= __('Aire Acondicionado') ?>:</dt> 
            <dd><?= $this->Number->format($project->aire_acondicionado) ?></dd>
         
                       
        <dt><?= __('Equipo Alberca') ?>:</dt> 
            <dd><?= $this->Number->format($project->equipo_alberca) ?></dd>
         
                       
        <dt><?= __('Calefaccion Hidronica') ?>:</dt> 
            <dd><?= $this->Number->format($project->calefaccion_hidronica) ?></dd>
         
                       
        <dt><?= __('Landscape') ?>:</dt> 
            <dd><?= $this->Number->format($project->landscape) ?></dd>
         
                       
        <dt><?= __('Asador') ?>:</dt> 
            <dd><?= $this->Number->format($project->asador) ?></dd>
         
                       
        <dt><?= __('Solatube') ?>:</dt> 
            <dd><?= $this->Number->format($project->solatube) ?></dd>
         
                       
        <dt><?= __('Alarmas') ?>:</dt> 
            <dd><?= $this->Number->format($project->alarmas) ?></dd>
         
                       
        <dt><?= __('Paneles Solares') ?>:</dt> 
            <dd><?= $this->Number->format($project->paneles_solares) ?></dd>
         
                       
        <dt><?= __('Automatizacion') ?>:</dt> 
            <dd><?= $this->Number->format($project->automatizacion) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Marmol') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_marmol) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Granito') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_granito) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Cantera') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_cantera) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Piedra Natural Otro') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_piedra_natural_otro) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Granulado') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_granulado) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Alucobond Aluminio Compuesto') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_alucobond_aluminio_compuesto) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Madera Sintetica') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_madera_sintetica) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Piedra Sintetica Cubiertas') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_piedra_sintetica_cubiertas) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Concreto Lavado') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_concreto_lavado) ?></dd>
         
                       
        <dt><?= __('Acab Grueso Otros') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_grueso_otros) ?></dd>
         
                       
        <dt><?= __('Acab Finos Ventanas') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_ventanas) ?></dd>
         
                       
        <dt><?= __('Acab Finos Canceles') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_canceles) ?></dd>
         
                       
        <dt><?= __('Acab Finos Espejos') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_espejos) ?></dd>
         
                       
        <dt><?= __('Acab Finos Herrajes Puertas') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_herrajes_puertas) ?></dd>
         
                       
        <dt><?= __('Acab Finos Carpinteria Puertas') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_carpinteria_puertas) ?></dd>
         
                       
        <dt><?= __('Acab Finos Carpinteria Lambrines') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_carpinteria_lambrines) ?></dd>
         
                       
        <dt><?= __('Acab Finos Carpinteria Muebles Empotrados') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_carpinteria_muebles_empotrados) ?></dd>
         
                       
        <dt><?= __('Acab Finos Carpinteria Buffeteros') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_carpinteria_buffeteros) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Carpinteria Bar') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_carpinteria_bar) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Carpinteria Otros') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_carpinteria_otros) ?></dd>
         
                       
        <dt><?= __('Acab Finos Herreria2 Barandillas Pergolados') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_herreria2_barandillas_pergolados) ?></dd>
         
                       
        <dt><?= __('Acab Finos Herreria3 Especiales') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_finos_herreria3_especiales) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Lamparas') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_lamparas) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Acc Apagadores Contactos') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_acc_apagadores_contactos) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Muebles Fijos Bano') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_muebles_fijos_bano) ?></dd>
         
                       
        <dt><?= __('Acab Fijos Accesorios De Bano') ?>:</dt> 
            <dd><?= $this->Number->format($project->acab_fijos_accesorios_de_bano) ?></dd>
         
                       
        <dt><?= __('Asignado Servicio Postventa') ?>:</dt> 
            <dd><?= $this->Number->format($project->asignado_servicio_postventa) ?></dd>
         
               
            
                       
        <dt><?= __('Proyecto Inicio') ?>:</dt> 

                <dd><?= h($project->proyecto_inicio) ?></dd>
          
                       
        <dt><?= __('Proyecto Final Entrega Ejecutivo') ?>:</dt> 

                <dd><?= h($project->proyecto_final_entrega_ejecutivo) ?></dd>
          
                       
        <dt><?= __('Cruce Str Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_str_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Cruce Ac Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_ac_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Cruce Ac Str Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_ac_str_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Cruce Ac Iluminacion Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_ac_iluminacion_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Cruce Hid San Gas Plu Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_hid_san_gas_plu_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Cruce Inst Especiales Fecha Vobo') ?>:</dt> 

                <dd><?= h($project->cruce_inst_especiales_fecha_vobo) ?></dd>
          
                       
        <dt><?= __('Dia Hora Sup Bernardo') ?>:</dt> 

                <dd><?= h($project->dia_hora_sup_bernardo) ?></dd>
          
                       
        <dt><?= __('Fecha Etapa 6a') ?>:</dt> 

                <dd><?= h($project->fecha_etapa_6a) ?></dd>
          
                       
        <dt><?= __('Fecha Etapa 6b') ?>:</dt> 

                <dd><?= h($project->fecha_etapa_6b) ?></dd>
          
                       
        <dt><?= __('Fecha Etapa 6c') ?>:</dt> 

                <dd><?= h($project->fecha_etapa_6c) ?></dd>
          
                       
        <dt><?= __('Fecha Etapa 6d') ?>:</dt> 

                <dd><?= h($project->fecha_etapa_6d) ?></dd>
          
                       
        <dt><?= __('Fecha Inicio Obra') ?>:</dt> 

                <dd><?= h($project->fecha_inicio_obra) ?></dd>
          
                       
        <dt><?= __('Fecha Contratada Fin Obra') ?>:</dt> 

                <dd><?= h($project->fecha_contratada_fin_obra) ?></dd>
          
                       
        <dt><?= __('Fecha Real Fin Obra') ?>:</dt> 

                <dd><?= h($project->fecha_real_fin_obra) ?></dd>
          
                       
        <dt><?= __('Modified') ?>:</dt> 

                <dd><?= h($project->modified) ?></dd>
          
                       
        <dt><?= __('Created') ?>:</dt> 

                <dd><?= h($project->created) ?></dd>
          
            
            
                  
        <dt><?= __('Servicio Vip') ?>:</dt>
                <dd><?= $project->servicio_vip ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Muros Contencion Barda Perimetral') ?>:</dt>
                <dd><?= $project->muros_contencion_barda_perimetral ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Muros Contencion Casa') ?>:</dt>
                <dd><?= $project->muros_contencion_casa ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Alberca Cimentacion Misma Etapa') ?>:</dt>
                <dd><?= $project->alberca_cimentacion_misma_etapa ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Etapa 6a Buffer Obra Civil') ?>:</dt>
                <dd><?= $project->etapa_6a_buffer_obra_civil ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Etapa 6b  Buffer Preacabados') ?>:</dt>
                <dd><?= $project->etapa_6b__buffer_preacabados ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Etapa 6c Buffer Acab Gruesos') ?>:</dt>
                <dd><?= $project->etapa_6c_buffer_acab_gruesos ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Etapa 6d Buffer Acab Finos') ?>:</dt>
                <dd><?= $project->etapa_6d_buffer_acab_finos ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Entrega Planos Asbuilt') ?>:</dt>
                <dd><?= $project->entrega_planos_asbuilt ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Servicio Postventa') ?>:</dt>
                <dd><?= $project->servicio_postventa ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Entrega Garantias') ?>:</dt>
                <dd><?= $project->entrega_garantias ? __('Yes') : __('No'); ?></dd>
             
                  
        <dt><?= __('Deleted') ?>:</dt>
                <dd><?= $project->deleted ? __('Yes') : __('No'); ?></dd>
             
               
    


</dl>

<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>
</div>
</div>


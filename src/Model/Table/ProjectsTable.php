<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('projects');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('proyecto_nombre', 'create')
            ->notEmpty('proyecto_nombre');

        $validator
            ->requirePresence('proyecto_ubicacion', 'create')
            ->notEmpty('proyecto_ubicacion');

        $validator
            ->integer('proyecto_tamano')
            ->requirePresence('proyecto_tamano', 'create')
            ->notEmpty('proyecto_tamano');

        $validator
            ->integer('proyecto_complejidad')
            ->requirePresence('proyecto_complejidad', 'create')
            ->notEmpty('proyecto_complejidad');

        $validator
            ->date('proyecto_inicio')
            ->requirePresence('proyecto_inicio', 'create')
            ->notEmpty('proyecto_inicio');

        $validator
            ->date('proyecto_final_entrega_ejecutivo')
            ->requirePresence('proyecto_final_entrega_ejecutivo', 'create')
            ->notEmpty('proyecto_final_entrega_ejecutivo');

        $validator
            ->requirePresence('cliente_nombre', 'create')
            ->notEmpty('cliente_nombre');

        $validator
            ->requirePresence('cliente_telefono', 'create')
            ->notEmpty('cliente_telefono');

        $validator
            ->requirePresence('cliente_correo', 'create')
            ->notEmpty('cliente_correo');

        $validator
            ->integer('cliente_color')
            ->requirePresence('cliente_color', 'create')
            ->notEmpty('cliente_color');

        $validator
            ->boolean('servicio_vip')
            ->requirePresence('servicio_vip', 'create')
            ->notEmpty('servicio_vip');

        $validator
            ->integer('contrato_tipo_residencial')
            ->requirePresence('contrato_tipo_residencial', 'create')
            ->notEmpty('contrato_tipo_residencial');

        $validator
            ->integer('contrato_tipo_interiores')
            ->requirePresence('contrato_tipo_interiores', 'create')
            ->notEmpty('contrato_tipo_interiores');

        $validator
            ->integer('contrato_tipo_supervision')
            ->requirePresence('contrato_tipo_supervision', 'create')
            ->notEmpty('contrato_tipo_supervision');

        $validator
            ->decimal('precio_m2')
            ->requirePresence('precio_m2', 'create')
            ->notEmpty('precio_m2');

        $validator
            ->integer('m2_construccion_contratada')
            ->requirePresence('m2_construccion_contratada', 'create')
            ->notEmpty('m2_construccion_contratada');

        $validator
            ->integer('m2_construccion_disenada')
            ->allowEmpty('m2_construccion_disenada');

        $validator
            ->integer('m2_construccion_diferencia')
            ->allowEmpty('m2_construccion_diferencia');

        $validator
            ->integer('m2_terreno')
            ->allowEmpty('m2_terreno');

        $validator
            ->integer('m2_interiores')
            ->allowEmpty('m2_interiores');

        $validator
            ->integer('m2_terrazas')
            ->allowEmpty('m2_terrazas');

        $validator
            ->integer('m2_volados')
            ->allowEmpty('m2_volados');

        $validator
            ->integer('m2_cocheras_bodegas')
            ->allowEmpty('m2_cocheras_bodegas');

        $validator
            ->integer('gestor')
            ->allowEmpty('gestor');

        $validator
            ->integer('status_licencia_constructor')
            ->allowEmpty('status_licencia_constructor');

        $validator
            ->integer('estudio_topografico')
            ->allowEmpty('estudio_topografico');

        $validator
            ->integer('estudio_mecanica_suelos')
            ->allowEmpty('estudio_mecanica_suelos');

        $validator
            ->integer('estudio_hidrologico')
            ->allowEmpty('estudio_hidrologico');

        $validator
            ->integer('estudio_geologico')
            ->allowEmpty('estudio_geologico');

        $validator
            ->allowEmpty('estudios_otros');

        $validator
            ->integer('proveedor_planos_cocina')
            ->allowEmpty('proveedor_planos_cocina');

        $validator
            ->integer('proveedor_planos_paisaje')
            ->allowEmpty('proveedor_planos_paisaje');

        $validator
            ->integer('proveedor_planos_ing_iluminacion_contactos')
            ->allowEmpty('proveedor_planos_ing_iluminacion_contactos');

        $validator
            ->integer('proveedor_planos_ing_estructural')
            ->allowEmpty('proveedor_planos_ing_estructural');

        $validator
            ->integer('proveedor_planos_ing_aire_acondicionado')
            ->allowEmpty('proveedor_planos_ing_aire_acondicionado');

        $validator
            ->integer('proveedor_planos_ing_electrica')
            ->allowEmpty('proveedor_planos_ing_electrica');

        $validator
            ->integer('proveedor_planos_ing_hidro_sanitaria_gas_pluvial')
            ->allowEmpty('proveedor_planos_ing_hidro_sanitaria_gas_pluvial');

        $validator
            ->integer('proveedor_planos_ing_alberca')
            ->allowEmpty('proveedor_planos_ing_alberca');

        $validator
            ->integer('proveedor_planos_ing_automatizacion')
            ->allowEmpty('proveedor_planos_ing_automatizacion');

        $validator
            ->integer('proveedor_planos_ing_paneles_solares')
            ->allowEmpty('proveedor_planos_ing_paneles_solares');

        $validator
            ->integer('proveedor_planos_ing_calef_hidronica')
            ->allowEmpty('proveedor_planos_ing_calef_hidronica');

        $validator
            ->integer('proveedor_otros_planos_ingenierias')
            ->allowEmpty('proveedor_otros_planos_ingenierias');

        $validator
            ->integer('responsable_podiseno')
            ->allowEmpty('responsable_podiseno');

        $validator
            ->integer('responsable_pointeriores')
            ->allowEmpty('responsable_pointeriores');

        $validator
            ->integer('responsable_poejecutivo')
            ->allowEmpty('responsable_poejecutivo');

        $validator
            ->integer('responsable_pocruce_ingenierias')
            ->allowEmpty('responsable_pocruce_ingenierias');

        $validator
            ->integer('cruce_str_responsable')
            ->allowEmpty('cruce_str_responsable');

        $validator
            ->integer('cruce_str_vobo')
            ->allowEmpty('cruce_str_vobo');

        $validator
            ->date('cruce_str_fecha_vobo')
            ->allowEmpty('cruce_str_fecha_vobo');

        $validator
            ->integer('cruce_ac_responsable')
            ->allowEmpty('cruce_ac_responsable');

        $validator
            ->integer('cruce_ac_vobo')
            ->allowEmpty('cruce_ac_vobo');

        $validator
            ->date('cruce_ac_fecha_vobo')
            ->allowEmpty('cruce_ac_fecha_vobo');

        $validator
            ->integer('cruce_ac_str_responsable')
            ->allowEmpty('cruce_ac_str_responsable');

        $validator
            ->integer('cruce_ac_str_vobo')
            ->allowEmpty('cruce_ac_str_vobo');

        $validator
            ->date('cruce_ac_str_fecha_vobo')
            ->allowEmpty('cruce_ac_str_fecha_vobo');

        $validator
            ->integer('cruce_ac_iluminacion_responsable')
            ->allowEmpty('cruce_ac_iluminacion_responsable');

        $validator
            ->integer('cruce_ac_iluminacion_vobo')
            ->allowEmpty('cruce_ac_iluminacion_vobo');

        $validator
            ->date('cruce_ac_iluminacion_fecha_vobo')
            ->allowEmpty('cruce_ac_iluminacion_fecha_vobo');

        $validator
            ->integer('cruce_hid_san_gas_plu_responsable')
            ->allowEmpty('cruce_hid_san_gas_plu_responsable');

        $validator
            ->integer('cruce_hid_san_gas_plu_vobo')
            ->allowEmpty('cruce_hid_san_gas_plu_vobo');

        $validator
            ->date('cruce_hid_san_gas_plu_fecha_vobo')
            ->allowEmpty('cruce_hid_san_gas_plu_fecha_vobo');

        $validator
            ->integer('cruce_inst_especiales_responsable')
            ->allowEmpty('cruce_inst_especiales_responsable');

        $validator
            ->integer('cruce_inst_especiales_vobo')
            ->allowEmpty('cruce_inst_especiales_vobo');

        $validator
            ->date('cruce_inst_especiales_fecha_vobo')
            ->allowEmpty('cruce_inst_especiales_fecha_vobo');

        $validator
            ->integer('status_construccion_contratar_supervision')
            ->allowEmpty('status_construccion_contratar_supervision');

        $validator
            ->integer('tipo_terreno')
            ->allowEmpty('tipo_terreno');

        $validator
            ->integer('tipo_suelo')
            ->allowEmpty('tipo_suelo');

        $validator
            ->boolean('muros_contencion_barda_perimetral')
            ->allowEmpty('muros_contencion_barda_perimetral');

        $validator
            ->integer('categoria_estructura')
            ->allowEmpty('categoria_estructura');

        $validator
            ->boolean('muros_contencion_casa')
            ->allowEmpty('muros_contencion_casa');

        $validator
            ->boolean('alberca_cimentacion_misma_etapa')
            ->allowEmpty('alberca_cimentacion_misma_etapa');

        $validator
            ->integer('encargado_sup_admon')
            ->allowEmpty('encargado_sup_admon');

        $validator
            ->integer('encargado_sup_oper')
            ->allowEmpty('encargado_sup_oper');

        $validator
            ->integer('supervisor_asignado')
            ->allowEmpty('supervisor_asignado');

        $validator
            ->dateTime('dia_hora_sup_bernardo')
            ->allowEmpty('dia_hora_sup_bernardo');

        $validator
            ->boolean('etapa_6a_buffer_obra_civil')
            ->allowEmpty('etapa_6a_buffer_obra_civil');

        $validator
            ->date('fecha_etapa_6a')
            ->allowEmpty('fecha_etapa_6a');

        $validator
            ->boolean('etapa_6b__buffer_preacabados')
            ->allowEmpty('etapa_6b__buffer_preacabados');

        $validator
            ->date('fecha_etapa_6b')
            ->allowEmpty('fecha_etapa_6b');

        $validator
            ->boolean('etapa_6c_buffer_acab_gruesos')
            ->allowEmpty('etapa_6c_buffer_acab_gruesos');

        $validator
            ->date('fecha_etapa_6c')
            ->allowEmpty('fecha_etapa_6c');

        $validator
            ->boolean('etapa_6d_buffer_acab_finos')
            ->allowEmpty('etapa_6d_buffer_acab_finos');

        $validator
            ->date('fecha_etapa_6d')
            ->allowEmpty('fecha_etapa_6d');

        $validator
            ->integer('constructor_jefe')
            ->allowEmpty('constructor_jefe');

        $validator
            ->integer('constructor_residente_obra')
            ->allowEmpty('constructor_residente_obra');

        $validator
            ->integer('contratista_asignado_obra')
            ->allowEmpty('contratista_asignado_obra');

        $validator
            ->integer('velador_obra')
            ->allowEmpty('velador_obra');

        $validator
            ->integer('gerencia_proyectos_gdp')
            ->allowEmpty('gerencia_proyectos_gdp');

        $validator
            ->integer('gdp_asignado1_proyecto')
            ->allowEmpty('gdp_asignado1_proyecto');

        $validator
            ->integer('gdp_asignado2_proyecto')
            ->allowEmpty('gdp_asignado2_proyecto');

        $validator
            ->integer('gdp_asignado3_proyecto')
            ->allowEmpty('gdp_asignado3_proyecto');

        $validator
            ->date('fecha_inicio_obra')
            ->allowEmpty('fecha_inicio_obra');

        $validator
            ->date('fecha_contratada_fin_obra')
            ->allowEmpty('fecha_contratada_fin_obra');

        $validator
            ->date('fecha_real_fin_obra')
            ->allowEmpty('fecha_real_fin_obra');

        $validator
            ->integer('obra_civil_pre_acabados_herreria_tipo1')
            ->allowEmpty('obra_civil_pre_acabados_herreria_tipo1');

        $validator
            ->integer('elevador')
            ->allowEmpty('elevador');

        $validator
            ->integer('cocina_muebles_fijos')
            ->allowEmpty('cocina_muebles_fijos');

        $validator
            ->integer('cocina_equipos')
            ->allowEmpty('cocina_equipos');

        $validator
            ->integer('aire_acondicionado')
            ->allowEmpty('aire_acondicionado');

        $validator
            ->integer('equipo_alberca')
            ->allowEmpty('equipo_alberca');

        $validator
            ->integer('calefaccion_hidronica')
            ->allowEmpty('calefaccion_hidronica');

        $validator
            ->integer('landscape')
            ->allowEmpty('landscape');

        $validator
            ->integer('asador')
            ->allowEmpty('asador');

        $validator
            ->integer('solatube')
            ->allowEmpty('solatube');

        $validator
            ->integer('alarmas')
            ->allowEmpty('alarmas');

        $validator
            ->integer('paneles_solares')
            ->allowEmpty('paneles_solares');

        $validator
            ->integer('automatizacion')
            ->allowEmpty('automatizacion');

        $validator
            ->integer('acab_grueso_marmol')
            ->allowEmpty('acab_grueso_marmol');

        $validator
            ->integer('acab_grueso_granito')
            ->allowEmpty('acab_grueso_granito');

        $validator
            ->integer('acab_grueso_cantera')
            ->allowEmpty('acab_grueso_cantera');

        $validator
            ->integer('acab_grueso_piedra_natural_otro')
            ->allowEmpty('acab_grueso_piedra_natural_otro');

        $validator
            ->integer('acab_grueso_granulado')
            ->allowEmpty('acab_grueso_granulado');

        $validator
            ->integer('acab_grueso_alucobond_aluminio_compuesto')
            ->allowEmpty('acab_grueso_alucobond_aluminio_compuesto');

        $validator
            ->integer('acab_grueso_madera_sintetica')
            ->allowEmpty('acab_grueso_madera_sintetica');

        $validator
            ->integer('acab_grueso_piedra_sintetica_cubiertas')
            ->allowEmpty('acab_grueso_piedra_sintetica_cubiertas');

        $validator
            ->integer('acab_grueso_concreto_lavado')
            ->allowEmpty('acab_grueso_concreto_lavado');

        $validator
            ->integer('acab_grueso_otros')
            ->allowEmpty('acab_grueso_otros');

        $validator
            ->integer('acab_finos_ventanas')
            ->allowEmpty('acab_finos_ventanas');

        $validator
            ->integer('acab_finos_canceles')
            ->allowEmpty('acab_finos_canceles');

        $validator
            ->integer('acab_finos_espejos')
            ->allowEmpty('acab_finos_espejos');

        $validator
            ->integer('acab_finos_herrajes_puertas')
            ->allowEmpty('acab_finos_herrajes_puertas');

        $validator
            ->integer('acab_finos_carpinteria_puertas')
            ->allowEmpty('acab_finos_carpinteria_puertas');

        $validator
            ->integer('acab_finos_carpinteria_lambrines')
            ->allowEmpty('acab_finos_carpinteria_lambrines');

        $validator
            ->integer('acab_finos_carpinteria_muebles_empotrados')
            ->allowEmpty('acab_finos_carpinteria_muebles_empotrados');

        $validator
            ->integer('acab_finos_carpinteria_buffeteros')
            ->allowEmpty('acab_finos_carpinteria_buffeteros');

        $validator
            ->integer('acab_fijos_carpinteria_bar')
            ->allowEmpty('acab_fijos_carpinteria_bar');

        $validator
            ->integer('acab_fijos_carpinteria_otros')
            ->allowEmpty('acab_fijos_carpinteria_otros');

        $validator
            ->integer('acab_finos_herreria2_barandillas_pergolados')
            ->allowEmpty('acab_finos_herreria2_barandillas_pergolados');

        $validator
            ->integer('acab_finos_herreria3_especiales')
            ->allowEmpty('acab_finos_herreria3_especiales');

        $validator
            ->integer('acab_fijos_lamparas')
            ->allowEmpty('acab_fijos_lamparas');

        $validator
            ->integer('acab_fijos_acc_apagadores_contactos')
            ->allowEmpty('acab_fijos_acc_apagadores_contactos');

        $validator
            ->integer('acab_fijos_muebles_fijos_bano')
            ->allowEmpty('acab_fijos_muebles_fijos_bano');

        $validator
            ->integer('acab_fijos_accesorios_de_bano')
            ->allowEmpty('acab_fijos_accesorios_de_bano');

        $validator
            ->boolean('entrega_planos_asbuilt')
            ->allowEmpty('entrega_planos_asbuilt');

        $validator
            ->boolean('servicio_postventa')
            ->allowEmpty('servicio_postventa');

        $validator
            ->integer('asignado_servicio_postventa')
            ->allowEmpty('asignado_servicio_postventa');

        $validator
            ->boolean('entrega_garantias')
            ->allowEmpty('entrega_garantias');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function getProjects(){
        $result = $this->find()
                ->select(['id', 'id' ])
                ->hydrate(false)
                ->toArray();
        return $result;
        $rows = [];
        foreach($result as $row) {
                $rows[$row['id']] = 'id'; 
        }
        return $rows;
    }

}

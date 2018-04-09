<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string $proyecto_nombre
 * @property string $proyecto_ubicacion
 * @property int $proyecto_tamano
 * @property int $proyecto_complejidad
 * @property \Cake\I18n\Time $proyecto_inicio
 * @property \Cake\I18n\Time $proyecto_final_entrega_ejecutivo
 * @property string $cliente_nombre
 * @property string $cliente_telefono
 * @property string $cliente_correo
 * @property int $cliente_color
 * @property bool $servicio_vip
 * @property int $contrato_tipo_residencial
 * @property int $contrato_tipo_interiores
 * @property int $contrato_tipo_supervision
 * @property float $precio_m2
 * @property int $m2_construccion_contratada
 * @property int $m2_construccion_disenada
 * @property int $m2_construccion_diferencia
 * @property int $m2_terreno
 * @property int $m2_interiores
 * @property int $m2_terrazas
 * @property int $m2_volados
 * @property int $m2_cocheras_bodegas
 * @property int $gestor
 * @property int $status_licencia_constructor
 * @property int $estudio_topografico
 * @property int $estudio_mecanica_suelos
 * @property int $estudio_hidrologico
 * @property int $estudio_geologico
 * @property string $estudios_otros
 * @property int $proveedor_planos_cocina
 * @property int $proveedor_planos_paisaje
 * @property int $proveedor_planos_ing_iluminacion_contactos
 * @property int $proveedor_planos_ing_estructural
 * @property int $proveedor_planos_ing_aire_acondicionado
 * @property int $proveedor_planos_ing_electrica
 * @property int $proveedor_planos_ing_hidro_sanitaria_gas_pluvial
 * @property int $proveedor_planos_ing_alberca
 * @property int $proveedor_planos_ing_automatizacion
 * @property int $proveedor_planos_ing_paneles_solares
 * @property int $proveedor_planos_ing_calef_hidronica
 * @property int $proveedor_otros_planos_ingenierias
 * @property int $responsable_podiseno
 * @property int $responsable_pointeriores
 * @property int $responsable_poejecutivo
 * @property int $responsable_pocruce_ingenierias
 * @property int $cruce_str_responsable
 * @property int $cruce_str_vobo
 * @property \Cake\I18n\Time $cruce_str_fecha_vobo
 * @property int $cruce_ac_responsable
 * @property int $cruce_ac_vobo
 * @property \Cake\I18n\Time $cruce_ac_fecha_vobo
 * @property int $cruce_ac_str_responsable
 * @property int $cruce_ac_str_vobo
 * @property \Cake\I18n\Time $cruce_ac_str_fecha_vobo
 * @property int $cruce_ac_iluminacion_responsable
 * @property int $cruce_ac_iluminacion_vobo
 * @property \Cake\I18n\Time $cruce_ac_iluminacion_fecha_vobo
 * @property int $cruce_hid_san_gas_plu_responsable
 * @property int $cruce_hid_san_gas_plu_vobo
 * @property \Cake\I18n\Time $cruce_hid_san_gas_plu_fecha_vobo
 * @property int $cruce_inst_especiales_responsable
 * @property int $cruce_inst_especiales_vobo
 * @property \Cake\I18n\Time $cruce_inst_especiales_fecha_vobo
 * @property int $status_construccion_contratar_supervision
 * @property int $tipo_terreno
 * @property int $tipo_suelo
 * @property bool $muros_contencion_barda_perimetral
 * @property int $categoria_estructura
 * @property bool $muros_contencion_casa
 * @property bool $alberca_cimentacion_misma_etapa
 * @property int $encargado_sup_admon
 * @property int $encargado_sup_oper
 * @property int $supervisor_asignado
 * @property \Cake\I18n\Time $dia_hora_sup_bernardo
 * @property bool $etapa_6a_buffer_obra_civil
 * @property \Cake\I18n\Time $fecha_etapa_6a
 * @property bool $etapa_6b__buffer_preacabados
 * @property \Cake\I18n\Time $fecha_etapa_6b
 * @property bool $etapa_6c_buffer_acab_gruesos
 * @property \Cake\I18n\Time $fecha_etapa_6c
 * @property bool $etapa_6d_buffer_acab_finos
 * @property \Cake\I18n\Time $fecha_etapa_6d
 * @property int $constructor_jefe
 * @property int $constructor_residente_obra
 * @property int $contratista_asignado_obra
 * @property int $velador_obra
 * @property int $gerencia_proyectos_gdp
 * @property int $gdp_asignado1_proyecto
 * @property int $gdp_asignado2_proyecto
 * @property int $gdp_asignado3_proyecto
 * @property \Cake\I18n\Time $fecha_inicio_obra
 * @property \Cake\I18n\Time $fecha_contratada_fin_obra
 * @property \Cake\I18n\Time $fecha_real_fin_obra
 * @property int $obra_civil_pre_acabados_herreria_tipo1
 * @property int $elevador
 * @property int $cocina_muebles_fijos
 * @property int $cocina_equipos
 * @property int $aire_acondicionado
 * @property int $equipo_alberca
 * @property int $calefaccion_hidronica
 * @property int $landscape
 * @property int $asador
 * @property int $solatube
 * @property int $alarmas
 * @property int $paneles_solares
 * @property int $automatizacion
 * @property int $acab_grueso_marmol
 * @property int $acab_grueso_granito
 * @property int $acab_grueso_cantera
 * @property int $acab_grueso_piedra_natural_otro
 * @property int $acab_grueso_granulado
 * @property int $acab_grueso_alucobond_aluminio_compuesto
 * @property int $acab_grueso_madera_sintetica
 * @property int $acab_grueso_piedra_sintetica_cubiertas
 * @property int $acab_grueso_concreto_lavado
 * @property int $acab_grueso_otros
 * @property int $acab_finos_ventanas
 * @property int $acab_finos_canceles
 * @property int $acab_finos_espejos
 * @property int $acab_finos_herrajes_puertas
 * @property int $acab_finos_carpinteria_puertas
 * @property int $acab_finos_carpinteria_lambrines
 * @property int $acab_finos_carpinteria_muebles_empotrados
 * @property int $acab_finos_carpinteria_buffeteros
 * @property int $acab_fijos_carpinteria_bar
 * @property int $acab_fijos_carpinteria_otros
 * @property int $acab_finos_herreria2_barandillas_pergolados
 * @property int $acab_finos_herreria3_especiales
 * @property int $acab_fijos_lamparas
 * @property int $acab_fijos_acc_apagadores_contactos
 * @property int $acab_fijos_muebles_fijos_bano
 * @property int $acab_fijos_accesorios_de_bano
 * @property bool $entrega_planos_asbuilt
 * @property bool $servicio_postventa
 * @property int $asignado_servicio_postventa
 * @property bool $entrega_garantias
 * @property int $user_id
 * @property bool $deleted
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 */
class Project extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}

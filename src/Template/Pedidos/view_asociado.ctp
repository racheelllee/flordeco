
<?php if(!in_array($pedido->estatus_id, [5,6])){ ?>
<div class="row">
      <div class="col-xs-6">
      </div>
      <div class="col-xs-6">
          <?= $this->Form->create(null); ?>

          <div class="col-xs-12" style="padding-left: 0px;">
              <div class="col-xs-2 pull-right">               
                 <br>
                  <?= $this->Form->button(__('Guardar')) ?><?= $this->Form->input('old_status_id', array('type'=>'hidden', 'label'=>false, 'value'=>$pedido->estatus_id)) ?>                  
              </div>
              <div class="col-xs-4 pull-right" style="padding-left: 0px;">
                  Asociado <br>
              <?= $this->Form->input('asociado_id', array('options'=>$asociados, 'label'=>false, 'value'=>$pedido->asociado_id, 'empty'=>'-- Seleccione --')) ?>
              </div>
              <div class="col-xs-4 pull-right" style="padding-left: 0px;">
                Estatus <br>
                  <?= $this->Form->input('estatus_id', array('options'=>$estatusesAsociado, 'label'=>false, 'value'=>$pedido->estatus_id)) ?>
              </div>
          </div>
          <?= $this->Form->end() ?>
      </div>
</div>
<?php } ?>


<div class="row">
        <div class="col-xs-2">
            <h3>Pedido</h3><h2><?= $pedido->id ?></h2>
        </div>
        <div class="col-xs-4">
            <h3>Fecha de Entrega</h3><h2><?= $pedido->fecha_entrega->format('d/m/Y') ?></h2>
        </div>
</div>
<hr>
<?php foreach($pedido->partidas as $key => $partida) { if(!$partida->adicional){ ?>
    <div class="row">
        <div class="col-xs-2" style="text-align: center; padding: 20px;">
            <img src="<?php echo $this->Image->resize('img/productos/original', (isset($partida->partida_producto->imagenes[0]->nombre)? $partida->partida_producto->imagenes[0]->nombre : 'nodisponible.jpg'), null, null, true);?>" style="width:100%;">
        </div>
        <div class="col-xs-10">
            <div class="col-xs-8 pedido-title-product">
                <?= $partida->producto ?>
            </div>
            <div class="col-xs-4 pedido-title-subproduct">
                <?= $partida->sku ?>&nbsp;
            </div>

            <div class="col-xs-12">
                <br>
                <?= $partida->partida_producto->descripcion_larga ?>
                <br>
                <b>Cantidad:</b> <?= $partida->cantidad ?>
                <br>
                <b>Mensaje Personalizado:</b> <?= ($partida->mensaje_personalizado && $partida->mensaje_personalizado != 'false')? $partida->mensaje_personalizado : 'Sin mensaje' ?>
            </div>
        </div>
    </div>
<?php }} ?>
<div class="row">
    <div class="col-xs-12">
        <h2>Adicionales</h2>
    </div>
</div>

<?php foreach($pedido->partidas as $key => $partida) { if($partida->adicional){ ?>
        <div class="detalle-adicionales-caja col-xs-3" data-id="<?= $partida->partida_producto->id ?>">
            <div class="col-xs-6 detalle-relacionados-img" style="background-image: url(/img/productos/original/<?=$partida->partida_producto->imagenes[0]->nombre?>);">
            </div>
            <div class="col-xs-6 detalle-adicionales-text">
                <?= $partida->partida_producto->nombre ?> <br> 
                <span style="font-size: 12px;"><?= $partida->partida_producto->descripcion_corta ?></span> <br> 
            </div>
            <div class="detalle-adicionales-cantidad"><?= $partida->cantidad ?></div>
        </div>
    
<?php }} ?>

<div class="row">
    <div class="col-xs-12">
        <h2>Datos de Entrega</h2>
    </div>
</div>
<div class="row detalle-envio">
    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12" style="padding: 0px; border-right: 1px solid #c7c8cc;">

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <h5 class="envioypago-title">Datos del Envío</h5>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Nombre:
        </div>
        <div class="col-xs-6"><?= $pedido->nombre_destinatario ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Télefono:
        </div>
        <div class="col-xs-6"><?= $pedido->telefono_destinatario ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Fecha de Envío:
        </div>
        <div class="col-xs-6"><?= $pedido->fecha_entrega->format('d/m/Y') ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Horario de Entrega:
        </div>
        <div class="col-xs-6"><?= $pedido->horario_entrega ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Mensaje de la Tarjeta:
        </div>
        <div class="col-xs-6"><?= $pedido->mensaje_tarjeta ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Firma:
        </div>
        <div class="col-xs-6"><?= $pedido->firma ?></div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-6">
          Es Arreglo Funeral:
        </div>
        <div class="col-xs-6"><?= ($pedido->arreglo_funeral)? 'Si' : 'No' ?></div>
      </div>


    </div>

    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12" style="padding: 0px;">

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <h5 class="envioypago-title">Dirección de Envío</h5>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Dirección:
        </div>
        <div class="col-xs-6">
          <?= $pedido->calle ?> #<?= $pedido->numero_exterior ?>, <?= $pedido->colonia ?>, C.P.<?= $pedido->codigo_postal ?>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Ciudad:
        </div>
        <div class="col-xs-6"><?= $pedido->ciudad ?></div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Estado:
        </div>
        <div class="col-xs-6"><?= $pedido->estado ?></div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Pais:
        </div>
        <div class="col-xs-6"><?= $pedido->pais ?></div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Tipo de Domicilio:
        </div>
        <div class="col-xs-6"><?= $pedido->tipo_domicilio ?></div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6">
          Referencias de Envío:
        </div>
        <div class="col-xs-6"><?= $pedido->referencias_direccion ?></div>
      </div>

    </div>
</div>
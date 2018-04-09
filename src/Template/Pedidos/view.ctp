
<?php if(!in_array($pedido->estatus_id, [5,6])){ ?>
<div class="row">
      <div class="col-xs-6">
      </div>
      <div class="col-xs-6">
          <?= $this->Form->create(null); ?>

          <div class="col-xs-12" style="padding-left: 0px;">
              <div class="col-xs-2 pull-right">
                <?php if ($this->UserAuth->isAdmin()) { ?>
                 <br>
                  <?= $this->Form->button(__('Guardar')) ?><?= $this->Form->input('old_status_id', array('type'=>'hidden', 'label'=>false, 'value'=>$pedido->estatus_id)) ?>
                  <?php } else { echo "&nbsp;"; } ?>
              </div>
              <div class="col-xs-4 pull-right" style="padding-left: 0px;">
                  Asociado <br>
              <?= $this->Form->input('asociado_id', array('options'=>$asociados, 'label'=>false, 'value'=>$pedido->asociado_id, 'empty'=>'-- Seleccione --')) ?>
              </div>
              <div class="col-xs-4 pull-right" style="padding-left: 0px;">
                Estatus <br>
                  <?= $this->Form->input('estatus_id', array('options'=>$estatuses, 'label'=>false, 'value'=>$pedido->estatus_id)) ?>
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
        <div class="col-xs-6">
            <h3>Cliente</h3><h2><?= $pedido->nombre_cliente ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Fecha de Entrega</h3><h2><?= $pedido->fecha_entrega->format('d/m/Y') ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Total</h3><h2>$<?= number_format($pedido->monto, 2) ?></h2>
        </div>
</div>
<hr>
<?php foreach($pedido->partidas as $key => $partida) { if(!$partida->adicional){ ?>
    <div class="row">
        <div class="col-xs-2" style="text-align: center; padding: 20px;">
            <img src="<?= $this->Image->resize('img/productos/original', (isset($partida->partida_producto->imagenes[0]->nombre)? $partida->partida_producto->imagenes[0]->nombre : 'nodisponible.jpg'), null, null, true);?>" style="width:100%;">
        </div>
        <div class="col-xs-10">
            <div class="col-xs-8 pedido-title-product">
                <?= $partida->producto ?>
            </div>
            <div class="col-xs-4 pedido-title-subproduct">
                <?= $partida->sku ?>&nbsp;
            </div>

            <div class="col-xs-8">
                <br>
                <?= (!empty($partida->partida_producto->descripcion_larga))? $partida->partida_producto->descripcion_larga : $partida->partida_producto->descripcion_corta ?>
                <br>
                <b>Mensaje Personalizado:</b> <?= ($partida->mensaje_personalizado && $partida->mensaje_personalizado != 'false')? $partida->mensaje_personalizado : 'Sin mensaje' ?>
            </div>
            <div class="col-xs-4">
                <div class="col-xs-4">
                  <br><b>Cantidad</b> <br><?= $partida->cantidad ?>
                </div>
                <div class="col-xs-4">
                  <br><b>Precio</b> <br>$<?= number_format($partida->precio, 2); ?>
                </div>
                <div class="col-xs-4">
                  <br><b>Subtotal</b> <br>$<?= number_format($partida->precio * $partida->cantidad, 2); ?>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>
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
                $<?= number_format($partida->precio, 2); ?>
            </div>
            <div class="detalle-adicionales-cantidad"><?= $partida->cantidad ?></div>
        </div>
    
<?php }} ?>

<div class="row">
        <div class="col-xs-12"><hr></div>
        <div class="col-xs-2"></div>
        <div class="col-xs-2">
            <h3>Subtotal</h3><h2>$<?= number_format($pedido->subtotal, 2); ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Cupon</h3><h2>$<?= number_format($pedido->cupon, 2); ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Puntos</h3><h2>$<?= number_format($pedido->puntos_aplicados, 2); ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Envio</h3><h2>$<?= number_format($pedido->envio, 2); ?></h2>
        </div>
        <div class="col-xs-2">
            <h3>Total</h3><h2>$<?= number_format($pedido->monto, 2) ?></h2>
        </div>
        <div class="col-xs-12"><hr></div>
</div>

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

<br><br>


<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Envio" id="Envio-tab" role="tab" data-toggle="tab" aria-controls="Envio" aria-expanded="true">Datos de Envio</a>
    </li>
    <li role="presentation" class="">
        <a href="#Comentarios" id="Comentarios-tab" role="tab" data-toggle="tab" aria-controls="Comentarios" aria-expanded="true">Comentarios</a>
    </li>
    <li role="presentation" class="">
        <a href="#cargoExtra" id="cargoExtra-tab" role="tab" data-toggle="tab" aria-controls="cargoExtra" aria-expanded="true">Aplicar Cargo Extra</a>
    </li>

</ul>



<div id="myTabContent" class="tab-content">

  <div role="tabpanel" class="tab-pane fade in active" id="Envio" aria-labelledBy="Envio-tab">
      <br>

      <?php if($pedido->recoger_sucursal == false){ ?>

      <?= $this->Form->create(null, ['action'=>'guardar_datos_envio']); ?>
      <div class="row">
          <div class="col-xs-6">

          <?php
          echo $this->Form->input('id', ['value'=>$pedido->id, 'type'=>'hidden']);
          echo $this->Form->input('guia_de_envio', ['label'=>'Guia de Envio', 'value'=>$pedido->guia_de_envio]);
          echo $this->Form->input('proveedor_mensajeria', ['label'=>'Proveedor de Mensajeria', 'value'=>$pedido->proveedor_mensajeria]);
          ?>
          </div>
          <div class="col-xs-6">
          <?php
          echo $this->Form->input('recibido_por', ['label'=>'Recibido por', 'value'=>$pedido->recibido_por]);

          if($pedido->fecha_entrega != '' && !is_null($pedido->fecha_entrega)){
              echo $this->Form->input('fecha_entrega',array('class ' => 'form-control', 'type'=>'text', 'label' => 'Fecha de Entrega', 'value'=>$pedido->fecha_entrega->i18nFormat('dd-MM-YYYY')));
          }else{
              echo $this->Form->input('fecha_entrega',array('class ' => 'form-control', 'type'=>'text', 'label' => 'Fecha de Entrega'));
          }
          ?>
          </div>
      </div>
      <div class="row">
          <div class="col-xs-6">
              <?= $this->Form->button(__('Guardar Datos de Envio')) ?>
          </div>
      </div>

      <?= $this->Form->end() ?>

      <?php }else{ echo '<center> <b>RECOGER EN '.$pedido->sucursale->nombre.' </b> </center>'; } ?>


  </div>

  <div role="tabpanel" class="tab-pane fade in " id="Comentarios" aria-labelledBy="Comentarios-tab">
      <br>
      <?php foreach ($pedido->pedidos_comentarios as $comentarios): ?>
      <div class="row">
          <div class="col-xs-4">
              <h3><?php echo $comentarios->user->first_name.' '.$comentarios->user->last_name; ?></h3>
              <?php echo $comentarios->created->i18nFormat('dd-MM-YYYY HH:mm'); ?>
          </div>
          <div class="col-xs-6">
              <?php echo $comentarios->mensaje; ?>
          </div>
      </div>
      <br>
      <legend></legend>
      <?php endforeach; ?>


      <br>

      <?= $this->Form->create(null, ['action' => 'agregar_comentario']); ?>
          <div class="row">
              <div class="col-xs-12">
                  <?= $this->Form->input('pedido_id', array('type'=>'hidden', 'value'=>$pedido->id)) ?>
                  <?= $this->Form->input('mensaje', array('type'=>'textarea', 'label'=>'Comentario')) ?>
              </div>
              <div class="col-xs-12" align="right">
                  <?= $this->Form->button(__('Agregar Comentario')) ?>
              </div>

          </div>
      <?= $this->Form->end() ?>

  </div>
    
    <div role="tabpanel" class="tab-pane fade in " id="cargoExtra" aria-labelledBy="cargoExtra-tab">

        <br>
      <?php foreach ($cobrosExtras as $cobro): ?>
      <div class="row">
          <div class="col-xs-4">
              <h3><?php echo $cobro->usuario->first_name." ".$cobro->usuario->last_name; ?></h3>
              <?php echo $cobro->created->i18nFormat('dd-MM-YYYY HH:mm'); ?>
          </div>
          <div class="col-xs-6">
              <?php echo $cobro->nombre_completo; ?> <br>
              <?php echo "No. de Tarjeta: XXXXXXXXX". substr($cobro->no_tarjeta, -3) ?> <br>
              <?php echo "Monto: $".$cobro->monto; ?> <br>
              <?php echo $cobro->comentario; ?> <br>
          </div>
      </div>
      <br>
      <legend></legend>
      <?php endforeach; ?>


      <br>

      <?php if(!in_array($pedido->estatus_id, [5,6])){ ?>      

       <?= $this->Form->create(null, ['action'=>'aplicarCargoExtra']); ?>
      <div class="row">
          <div class="col-xs-4">
              
          <?php          
          echo $this->Form->input('monto', ['label'=>'Monto', 'type'=>'number', 'required'=>true]);
          echo $this->Form->input('comentario', ['label'=>'Comentario', 'required'=>true]);
          echo $this->Form->input('pedido_id', array('type'=>'hidden', 'value'=>$pedido->id));
          ?>
          </div>
          <div class="col-xs-4">

          <?php
          echo $this->Form->input('nombre_completo', ['label'=>'Nombre Completo', 'required'=>true]);
          echo $this->Form->input('no_tarjeta', ['label'=>'Número de Tarjeta', 'type'=>'number', 'minlength'=>'16', 'maxlength'=>'16']);
          ?>
              <div class="row">
                  <div class="col-xs-6">
                      <?php
                      echo $this->Form->input('fecha_ex_mes', ['label'=>'Fecha de Expiración (MM)', 'type'=>'number', 'required'=>true, 'maxlength'=>'2']);
                      ?>
                  </div>
                  <div class="col-xs-6">
                      <?php
                      echo $this->Form->input('fecha_ex_year', ['label'=>'Fecha de Expiración (YY)', 'type'=>'number', 'required'=>true, 'maxlength'=>'2']);
                      ?>
                  </div>
              </div>
              <?php
            echo $this->Form->input('no_seguridad', ['label'=>'Número de Seguridad*', 'type'=>'number', 'required'=>true, 'maxlength'=>'3']);
          ?>
          </div>
         
      </div>
      <div class="row">
          <div class="col-xs-6">
              <?= $this->Form->button(__('Guardar')) ?>
          </div>
      </div>

      <?= $this->Form->end() ?>

      <?php } ?>

  </div>
</div>


<script type="text/javascript">
    $('#fecha-entrega').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"

    });
</script>
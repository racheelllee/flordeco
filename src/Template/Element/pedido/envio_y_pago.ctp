<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>

  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso">
      <span class="detalle-pedido-circulo">1</span><br><?= __('Inicio') ?>
    </div>
  </div>
  
  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso active_pedido">
      <span class="detalle-pedido-circulo">2</span><br><?= __('Envío y Pago') ?>
    </div>
  </div>

  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso">
      <span class="detalle-pedido-circulo">3</span><br><?= __('Confirmación') ?>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>
</div>

<div class="row">
  <div class="col-xs-12 envioypago-zonahoraria">
    <?= __('Hora Local de') ?> <?= $ciudad->nombre ?> <span class="reloj-zona-horaria"></span>
  </div>

  <div class="col-xs-12" style="padding: 0px;">
    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12" style="padding: 0px; border-right: 1px solid #c7c8cc;">

      <!-- DATOS PERSONALES -->
      <?php if($datos_personales){ ?>

        <div class="col-xs-12" style="margin-bottom: 15px;">
          <h5 class="envioypago-title">Datos Personales</h5>
        </div>

        <div class="col-xs-12" style="margin-bottom: 15px;">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
              <?php echo $this->Form->input('user.telefono_local', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Teléfono (LDI + LD + NúMERO)')); ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
              <?php 
                echo $this->Form->input(
                  'user.telefono_tipo_id',
                  array('options' => $telefono_tipos, 'label' => false)
                );
              ?>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
              <?php echo $this->Form->input('user.ciudad', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'¿De qué ciudad nos visitas?')); ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
              <?php 
                echo $this->Form->input(
                  'user.pais_id',
                  array('options' => $paises, 'label' => false)
                );
              ?>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12 login-pedido-labeldiv">
              ¿Cómo te enteraste de nosotros?
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
              <?php 
                echo $this->Form->input(
                  'user.medio_id',
                  array('options' => $medios, 'label' => false)
                );
              ?>
            </div>
          </div>

        </div>
      <?php } ?>

      <!-- HORARIO DE ENVIO -->
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 carrito-info">
        <label class="carrito-label">Fecha de Envío</label><?= (!empty($detalle_envio['fecha']))? date('d-m-Y', strtotime($detalle_envio['fecha'])) : __('No definido') ?>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 carrito-info">
        <label class="carrito-label">Horario</label><?= (!empty($detalle_envio['horario_text']))? $detalle_envio['horario_text'] : __('No definido') ?> <span class="carrito-editar-fecha">Cambiar</span>
      </div>

      <!-- DATOS PERSONALES -->
      <div class="col-xs-12" style="margin-bottom: 15px; margin-top: 15px;">
        <h5 class="envioypago-title">Dirección de Envío</h5>
      </div>

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <?php echo $this->Form->Button(__('+ Agregar Dirección'), [
                        'div'=>false, 
                        'type'=>'button',
                        'class'=>'btn continuar-pedido', 
                        'style'=>'font-size: 12px;',
                        'data-toggle' => 'modal', 
                        'data-target' => '#modalMapa',
                        'data-href' => '/productos/buscar_direccion']); ?>


        
        <br>
        <label class="label_text">Seleccionar dirección de envío</label>
        
        <?php echo $this->Form->input('envio_a', array('class'=>'textbox_1', 'label'=>false, 'options' => $direcciones_envio, 'value' => $direccion_actual)); ?>
        <label class="error" style="display:none;" id="envio-a-error">Selecciona una dirección de envío</label>
        <label class="carrito-info" style="margin-top:10px;">Referencias de la Dirección de Envío</label>
        <?= $this->Form->textarea('referencias_direccion', ['id'=>'referencias_direccion']); ?>
      </div>

      <!-- MENSAJE  -->
      <div class="col-xs-12" style="margin-bottom: 15px; margin-top: 15px;">
        <h5 class="envioypago-title">Mensaje en la Tarjeta</h5>
      </div>

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <input type="checkbox" name="sin_mensaje" id="sin_mensaje" value="1"><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Sin Mensaje</label>

        <?php 
            echo $this->Form->input(
              'mensaje_tarjeta_id',
              ['options' => $mensaje_tarjetas, 
              'empty' => __('¿No sabes qué escribir? Selecciona un mensaje'),
              'label' => false]
            );
        ?>

        <?= $this->Form->textarea('mensaje_tarjeta', ['id'=>'mensaje-tarjeta', 'class'=>'requerido']); ?>
        <br>
        <label class="error" style="display:none;" id="mensaje-tarjeta-error">Selecciona o escribe un mensaje para la tarjeta</label>
        
        <div style="margin-top:10px;">
          <input type="checkbox" name="anonimo" id="anonimo" value="1"><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Anonimo</label>
        </div>

        <?php echo $this->Form->input('firma', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Firma')); ?>

        <label class="error" style="display:none;" id="firma-error">Favor especificar la firma</label>
        
        <div style="margin-top:10px;">
          <input type="checkbox" name="arreglo_funeral" value="1" id="arreglo_funeral"><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Seleccionar si es Arreglo Funeral</label>
        </div>

        <div style="margin-top:10px;">
          <input type="checkbox" name="recordatorio" value="1" id="recordatorio"><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Seleccionar si Desea recordatorio</label>
        </div>
      </div>
      
      <!-- MENSAJE  -->
      <div class="col-xs-12" style="margin-bottom: 15px; margin-top: 15px;">
        <h5 class="envioypago-title">Mensaje del Pedido</h5>
      </div>
      <div class="col-xs-12" style="margin-bottom: 15px;">
        <?= $this->Form->textarea('enviar_mensaje', ['id'=>'mensaje-pedido']); ?>
      </div>




    </div>
    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12" style="padding: 0px;">

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <h5 class="envioypago-title">Escoge tu Forma de Pago</h5>
        <?php echo $this->Form->input('forma_pago_id', ['type'=>'hidden', 'value'=> '0' ]); ?>
      </div>

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <?php foreach ($FormasdePagos as $forma){ ?>
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 formapago formapago-inactivo" data-id="<?= $forma->id ?>" id="formapago-<?= $forma->id ?>">
            <img src="/img/formaspago/<?= $forma->imagen ?>" style="width:80%;">
            <?= $forma->nombre ?>
          </div>
        <?php } ?>
      </div>

      <div class="col-xs-12" style="margin-bottom: 15px;">
        <?php foreach ($FormasdePagos as $forma){ ?>
          <div class="col-xs-12 formapago-descripcion" id="formapago-descripcion-<?= $forma->id ?>" style="display:none;">
            <?= $forma->descripcion; ?>
          </div>
        <?php } ?>
      </div>
       

    </div>
  </div>

</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <button class="hacer-pedido navegacion-pedido" data-next="confirmar" type="button"> <?=__('Continuar')?> </button>

  </div>

</div>


<?= $this->element('Productos/modalMapa'); ?>

<script type="text/javascript">

  /* EVENTOS CHECKBOX */
  $('#sin_mensaje').click(function() {
      var disabled = true;

      if (!$(this).is(':checked')) { disabled = false; }

      $('#mensaje-tarjeta-id').prop('disabled', disabled);
      $('#mensaje-tarjeta').prop('disabled', disabled);
  });

  $('#anonimo').click(function() {
      var disabled = true;

      if (!$(this).is(':checked')) { disabled = false; }

      $('#firma').prop('disabled', disabled);
  });


  /* FORMAS DE PAGO */
  $('#forma-pago-id').val(1);
  $('#formapago-1').removeClass('formapago-inactivo');
  $('#formapago-descripcion-1').show();
  $('#forma-pago-id').val(1);

  $('.formapago').click(function() {
      var id = $(this).data('id');

      $('.formapago').addClass('formapago-inactivo');
      $(this).removeClass('formapago-inactivo');

      $('.formapago-descripcion').hide();
      $('#formapago-descripcion-' + id).show();

      $('#forma-pago-id').val(id);

      if(id != 3){
        $('#btn-finalizar').show();
        $('#paypal-button-container').hide();
      }else{
        $('#btn-finalizar').hide();
        $('#paypal-button-container').show();
      }

  });

  $('#mensaje-tarjeta-id').change(function() {

      var content = $("#mensaje-tarjeta-id option:selected").text();

      if($(this).val() == ''){ content = ''; }

      $('#mensaje-tarjeta').val(content);

  });
</script>


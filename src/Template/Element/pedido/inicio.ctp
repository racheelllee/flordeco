<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>

  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso active_pedido">
      <span class="detalle-pedido-circulo">1</span><br><?= __('Inicio') ?>
    </div>
  </div>
  
  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso">
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

<div class="row" style="padding: 20;">
  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>

  <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12 login-pedido">

    <div class="col-xs-12 login-pedido-title" style="padding-top: 20px;">
      <h1>Hola!</h1>Ingresa a tu Cuenta
    </div>

    <div class="col-xs-12" style="padding: 0px;">
      <hr>
    </div>

    <div class="col-xs-12">

        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12">
        </div>
        
        <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <?php echo $this->Form->create($userEntity, ['url'=>'/login', 'id'=>'loginForm', 'class'=>'m-t']); ?>
          
          <div class="col-xs-12">
            <?php echo $this->Form->input('Users.email', ['type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Correo Electrónico'), 'class'=>'login-pedido-input']); ?>
          </div>
          <div class="col-xs-12 pto">
            <?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Contraseña'), 'class'=>'login-pedido-input']); ?>
          </div>
          
          <div class="col-xs-12" align="center">
            <?php echo $this->Form->Button(__('Continuar'), ['div'=>false, 'class'=>'continuar-pedido']); ?>
          </div>
        
        <?php echo $this->Form->end(); ?>
        </div>


        <div class="col-xs-12" align="center"  style="padding-top: 20px;"> 
          <?php echo $this->Form->Button('<i class="fa fa-facebook-square" aria-hidden="true"></i> '.__('Continuar con Facebook'), ['div'=>false, 'class'=>'continuar-pedido-facebook', 'onclick'=>"javascript:login_popup('fb');return false;"]); ?>
        </div>

        
</div>




    </div>
  </div>

  <div class="col-xs-3"></div>
</div>

<div class="row" style="margin-top: 15px;">
  <div class="col-xs-12">
    <hr>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 login-pedido-title">
    ¿Aún no tienes?<h1>Crea una Cuenta</h1>
  </div>
  <div class="col-xs-12">
    <?= $this->Form->create(null, ['action'=>'registrarme', 'id' => 'formulario_registrarme']); ?> 

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('first_name', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Nombre *')); ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('last_name', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Apellido *')); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('email', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Email *')); ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('password', array('class'=>'login-pedido-input requerido', 'label'=>false, 'type'=>'password', 'placeholder'=>'Contraseña *')); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12 login-pedido-labeldiv">
          Confirmar Contraseña
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('confirmar_password', array('class'=>'login-pedido-input requerido', 'label'=>false, 'type'=>'password', 'placeholder'=>'')); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('telefono_local', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'Teléfono (LDI + LD + NúMERO)')); ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php 
            echo $this->Form->input(
              'telefono_tipo_id',
              array('options' => $telefono_tipos, 'label' => false)
            );
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php echo $this->Form->input('ciudad', array('class'=>'login-pedido-input requerido', 'label'=>false, 'placeholder'=>'¿De qué ciudad nos visitas?')); ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php 
            echo $this->Form->input(
              'pais_id',
              array('options' => $paises, 'label' => false)
            );
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12 login-pedido-labeldiv">
          ¿Cómo te enteraste de nosotros?
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
          <?php 
            echo $this->Form->input(
              'medio_id',
              array('options' => $medios, 'label' => false)
            );
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-12"></div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">

            <input type="checkbox" name="terminos_condiciones" value="1"><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Acepto Términos y Condiciones</label>
          
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">

            <input type="checkbox" name="recibir_promociones" value="1" checked><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Acepto recibir promociones de Flordeco</label>

        </div>
      </div>
      

      <div class="col-xs-12" align="center" style="margin-top:20px;">
        <div class="g-recaptcha" data-sitekey="6LcZTioUAAAAAD5gJA6muXSakLE39WMVThd7EL6T"></div>
      </div>
      <div class="col-xs-12" align="center" style="margin-top:20px;">
        <?php echo $this->Form->Button(__('Continuar'), ['div'=>false, 'class'=>'continuar-pedido']); ?>
      </div>

    <?= $this->Form->end() ?>

    

  </div>
</div>

<script language="JavaScript">
var newwindow;
function login_popup(url) {
  var screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
  screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
  outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
  outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
  width = 580,
  height = 500,
  left = parseInt(screenX + ((outerWidth - width) / 2), 10),
  top = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
  
  features = (
    'width=' + width +
    ',height=' + height +
    ',left=' + left +
    ',top=' + top+
    ',scrollbars=yes'
  );
  
  newwindow=window.open(urlForJs+'login/'+url,'',features);

  if(window.focus) {
    newwindow.focus()
  }
  return false;
}
</script>



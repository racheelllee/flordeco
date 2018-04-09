<div id="header">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <a href="/" title="Flordeco" class="ca-logo">
        <?php echo $this->Html->image('logo.png', ['alt' => 'Flordeco', 'class' => 'img-responsive']); ?>
        </a>
        <div class="tpu">
          <div class="ca-lang ca-grep">
            <nav class="navbar navbar-white navbar-static yamm">
              <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-user" class="navbar-toggle nomargin nopadding">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger glyphicon-pink"></span>
                </button>
                <button type="button" class="navbar-toggle nomargin nopadding">
                <a rel="nofollow" href="tel:018006001100">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-earphone glyphicon-pink"></span>
                </a>
                </button>
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-shoppingcart" class="navbar-toggle nomargin nopadding">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-shopping-cart glyphicon-pink-disabled" style="padding:8px;"></span>
                </button>
                <!--<a class="navbar-brand visible-sm visible-xs" href="/" title="enviaflores.com"><img class="img-responsive" src="/img/logo.png" alt="Envia Flores"></a>-->
              </div>
              <!--navbar-header-->
              <div id="navbar-collapse-user" class="navbar-collapse collapse fright">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" rel="nofollow" href="#">Idioma<span class="caret font-pink"></span></a>
                    <ul class="dropdown-menu size-button">
                      <li><a class="change-language" rel="nofollow" href="#" data-id="es_ES">Español</a></li>
                      <li><a class="change-language" rel="nofollow" href="#" data-id="en_US">English</a></li>
                    </ul>
                    <script type="text/javascript">
                      $('.change-language').on('click', function(ev){
                          $.get('/categorias/changeLang/' + $(this).data('id'), function(res){
                            location.reload(true);
                          });
                      });
                    </script>
                  </li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" rel="nofollow" href="#"><span class="font-pink">Moneda<span class="caret"></span></span></a>
                    <ul class="dropdown-menu size-button">
                      <li><a class="change-currency" rel="nofollow" data-id="1" href="#">Pesos</a></li>
                      <li><a class="change-currency" rel="nofollow" data-id="2" href="#">Dólares</a></li>
                    </ul>
                    <script type="text/javascript">
                      $('.change-currency').on('click', function(ev){
                          $.get('/categorias/changeCurrency/' + $(this).data('id'), function(res){
                            location.reload(true);
                          });
                      });
                    </script>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <div class="ca-user ca-grep">
            <div class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" rel="nofollow" href="#">
              <i class="fa fa-user" style="color: #ad0098" aria-hidden="true"></i>
              <span class="font-pink" style="color: #ad0098; font-weight: bold;">Mi Cuenta<span class="caret"></span></span></a>
              <ul class="dropdown-menu size-button">
                <?php if($this->UserAuth->isLogged()): ?>
                <?php $logeado = $this->UserAuth->getUser(); ?>
                <?php $idusuarioinvitado = isset($idusuarioinvitado) ? $idusuarioinvitado : false; ?>
                <?php if( $idusuarioinvitado !=  $logeado['User']['id'] ): ?>
                <li><a rel="nofollow" href="/myprofile"><?= __('Mi Perfil') ?></a></li>
                <li><a rel="nofollow" href="/logout"><?= __('Salir') ?></a></li>
                <?php else: ?>
                <li><a rel="nofollow" href="/login/" data-toggle="modal" data-target="#modal-login" data-remote="false"><?= __('Iniciar sesión') ?></a></li>
                <?php endif; ?>
                <?php else: ?>
                <li><a rel="nofollow" href="/login/" data-toggle="modal" data-target="#modal-login" data-remote="false"><?= __('Iniciar sesión') ?></a></li>
                <?php endif ?>
              </ul>
            </div>
          </div>
          <div class="ca-car ca-grep">
            <a class="shopping-cart" href="<?= (isset($ciudad_url))? '/carrito/'.$ciudad_url : '#' ?>">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <?php
              if($this->request->session()->check('carrito') && isset($ciudad_url)){
                $articulos_ = array();
                $articulos_ = $this->request->session()->read('carrito');
                $total_articulos = count($articulos_[$ciudad_url]);
              }else{
                $total_articulos = 0;
              }
              ?>
            &nbsp;<span><?=$total_articulos?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- menu para mobile -->
<div id="nav" class="clearfix navbar">
  <div class="container">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav">
        <li class="dropdown" style="border:none;"><a class="menu" href="#"><i class="fa fa-phone-square bastion" aria-hidden="true"></i>Contacto</a></li>
        <?php
          $url = (isset($url_base))? $url_base : '';
          $subC = 0;  
          
          if($url){
            foreach ($categorias_principales as $categoriaP){
                echo '<li class="dropdown"><a class=menu href="'.$url.'/categoria/'.$categoriaP['url'].'">'.$categoriaP['nombre'].'</a><ul class="dropdown-menu menu">';
                 foreach ($categorias_secundarias as $categoriaS){
                    if($categoriaP['id'] == $categoriaS['categoria_id']){
                      echo '<li class="dropdown-submenu"><a tabindex="-1" class=dropdown-toggle href="'.$url.'/categoria/'.$categoriaS['url'] . '">' . $categoriaS['nombre'] .'</a>';
                    foreach ($categorias_secundarias as $categoriaSub){
                      if($categoriaS['id'] == $categoriaSub['categoria_id']){
                        if($subC == 0){
                          echo '<ul class=dropdown-menu>';
                          $subC = 1;
                        }
                        echo '<li><a href="'.$url.'/categoria/'.$categoriaSub['url'] . '">' . $categoriaSub['nombre'] .'</a></li>';
                      }
                    }
                      if($subC == 1){
                        echo '</ul></li>';
                        $subC = 0;
                      }else 
                        echo '</li>';
                    }
                  }
                  echo'</li></ul>';
            }
          }else{
            foreach ($categorias_principales as $categoriaP){
                echo '<li class="dropdown"><a class=menu href="#" data-toggle="modal" data-target="#modal-ciudad" data-remote="false" data-url="'.$categoriaP['url'].'">'.$categoriaP['nombre'].'</a><ul class="dropdown-menu menu">';
                 foreach ($categorias_secundarias as $categoriaS){
                    if($categoriaP['id'] == $categoriaS['categoria_id']){
                      echo '<li class="dropdown-submenu"><a tabindex="-1" class=dropdown-toggle href="#" data-toggle="modal" data-target="#modal-ciudad" data-remote="false" data-url="'.$categoriaS['url'].'">' . $categoriaS['nombre'] .'</a>';
                    foreach ($categorias_secundarias as $categoriaSub){
                      if($categoriaS['id'] == $categoriaSub['categoria_id']){
                        if($subC == 0){
                          echo '<ul class=dropdown-menu>';
                          $subC = 1;
                        }
                        echo '<li><a href="#" data-toggle="modal" data-target="#modal-ciudad" data-remote="false" data-url="'.$categoriaSub['url'].'">' . $categoriaSub['nombre'] .'</a></li>';
                      }
                    }
                      if($subC == 1){
                        echo '</ul></li>';
                        $subC = 0;
                      }else 
                        echo '</li>';
                    }
                  }
                  echo'</li></ul>';
            }
          }
          ?> 
      </ul>
    </div>
  </div>
</div>
<div id="modal-ciudad" class="modal inmodal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title detalle-producto-paso"><?= __('Selecciona tu ciudad') ?></h4>
      </div>
      <div class="modal-body">
        <?= $this->Form->create(null, array('id' => 'form-ciudad')); ?>
        <?=
          $this->Form->input(
              'menu_categoria',
              [
                  'id' => 'menu-categoria',
                  'type' => 'hidden',
              ]
          );
          ?>
        <div class="col-md-12" style="padding:http://flordeco.dev.webpoint.com.mx 0px; margin-bottom:10px; margin-top:16px;">
          <?=
            $this->Form->select(
                'estado_id',
                $estados,
                [
                    'id' => 'menu-estado-id',
                    'empty' => __('Estado'),
                    'class' => 'textbox_1 form-control',
                ]
            );
            ?>
        </div>
        <div class="col-md-12" style="padding: 0px; margin-bottom:20px;">
          <?=
            $this->Form->select(
                'municipio_id',
                [],
                [
                    'id' => 'menu-municipio-id',
                    'empty' => __('Ciudad'),
                    'class' => 'textbox_1 form-control'
                ]
            );
            ?>
        </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>
<div id="modal-login" class="modal inmodal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div id="logearme_form">
        <!-- Inicia de Registrarme -->
        <div class="row mx-log">
          <div id="login-message" style="color: red; text-align: center;"></div>
          <br>
          <?php echo $this->Form->create($userEntity, ['url'=>'/login', 'id'=>'loginForm', 'class'=>'m-t']); ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php echo $this->Form->input('Users.email', ['type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Correo Electrónico'), 'class'=>'textbox_1']); ?>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pto">
            <?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Contraseña'), 'class'=>'textbox_1']); ?>
          </div>
          <?php if(USE_REMEMBER_ME) { ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            <?php if(!isset($userEntity['remember'])) {
              $userEntity['remember'] = true;
              } ?>
            <?php echo $this->Form->input('Users.remember', ['type'=>'checkbox', 'label'=>__('Recordar Sesión')]); ?>
          </div>
          <?php } ?>
          <?php if($this->UserAuth->canUseRecaptha('login')) {
            $this->Form->unlockField('recaptcha_challenge_field');
            $this->Form->unlockField('recaptcha_response_field');
            $errors = $userEntity->errors();
            $error = "";
            if(isset($errors['captcha']['_empty'])) {
                $error = $errors['captcha']['_empty'];
            } else if(isset($errors['captcha']['mustMatch'])) {
                $error = $errors['captcha']['mustMatch'];
            }?>
          <div class="um-form-row form-group" align="center">
            <label class="col-sm-4 control-label required"><?php echo __('Prove you\'re not a robot');?></label>
            <div class="col-sm-8">
              <?php echo $this->UserAuth->showCaptcha($error);?>
            </div>
          </div>
          <?php } ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            <?php echo $this->Form->Button(__('Iniciar Sesión'), ['div'=>false, 'class'=>'btn btn-primary block full-width m-b', 'id'=>'loginSubmitBtn', 'style'=>'background:#E4680A; border:0;']); ?>
            <br><br>
            <?php /*$this->Html->link(__('¿Recuperar Contraseña?'), '/forgotPassword', ['class'=>'block full-width m-b', 'style'=>'color:#E4680A;']);*/ ?>
            <?php //echo $this->Html->link(__('Email Verification'), '/emailVerification', ['class'=>'btn btn-default pull-right um-btn']); ?>
            <script type="text/javascript">
              $('#loginForm').on('submit', function(ev){
                $('#login-message').html('');
                $('#loginSubmitBtn').prop('disabled', 'disabled');
                ev.preventDefault();
                $.post("/login", $('#loginForm').serialize())
                .done(function(data) {
                  $('#loginSubmitBtn').prop('removeAttr');
                  //$('#loginForm')[0].reset();
                  $('#users-password').val('');
                  var data = JSON.parse(data);
                  if (data.error) {
                    $('#login-message').html('Error al iniciar sesión');
                  } else {
                    location.reload();
                  }
                });
              });
            </script>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center"> 
          <?php echo $this->Form->Button('<i class="fa fa-facebook-square" aria-hidden="true"></i> '.__('Facebook'), ['div'=>false, 'class'=>'continuar-pedido-facebook', 'onclick'=>"javascript:login_popup('fb');return false;"]); ?>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-contactanos" class="modal inmodal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content animated bounceInRight">
      <form method="post" action="/contacto/" accept-charset="utf-8" class="sxs">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><?= __('Contáctanos') ?></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" class="form-control contacto-input" required><br>
            <input type="email" name="email" placeholder="Email" class="form-control contacto-input" required><br>
            <input type="text" name="asunto" placeholder="Asunto" class="form-control contacto-input" required><br>
            <textarea name="mensaje" placeholder="Mensaje" class="form-control contacto-input" rows=6 required></textarea><br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal"><?= __('Cerrar') ?></button>
          <button type="submit" class="btn btn-primary"><?= __('Enviar Mensaje') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  // $('ul.nav li.dropdown').hover(function() {
  //   $(this).find('.menu').stop(true, true).delay(0).fadeIn(0);
  // }, function() {
  //   $(this).find('.menu').stop(true, true).delay(0).fadeOut(0);
  // });
  
  $( ".llamanos").click(function() {
    $(".phones").fadeIn();
  });
  $( ".cerrar-phone").click(function() {
    $(".phones").fadeOut();
  });
  
</script>
<?php echo $this->element('Usermgmt.message'); ?>
<script type="text/javascript">
  function actualizaCiduades() {
      $('#menu-estado-id').prop('disabled', 'disabled');
      $('#menu-municipio-id').prop('disabled', 'disabled');
      $.get('/categorias/ciudades/' + $('#menu-estado-id').val() + '.json', function(res){
          if (res) {
              $('#menu-municipio-id').empty();
              $.each(JSON.parse(res), function(item, value){
                  $('#menu-municipio-id').append($('<option>', { 
                      value: item,
                      text : value 
                  }));
              });
          }
      }).always(function(){
  
          $('#menu-estado-id').removeAttr('disabled');
          $('#menu-municipio-id').removeAttr('disabled');
      });
  }
  
  
  $('*[data-target="#modal-ciudad"]').click(function(){
  
    var categoria = $(this).data('url');
    $('#menu-categoria').val(categoria);
  
  });
  
  
  $('#menu-estado-id').on('change', function(ev){
      actualizaCiduades();
  });
  
  $('#menu-municipio-id').on('change', function(ev){
  
    var categoria = $('#menu-categoria').val();
    window.location = '/estado-de-' + slug($("#menu-estado-id option:selected").text()) + '/ciudad/' + $('#menu-municipio-id').val() + '/categoria/' + categoria;
  });
  
</script>
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
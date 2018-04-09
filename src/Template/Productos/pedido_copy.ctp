<?php
  $carrito = array();
  $carrito = $this->request->session()->read('carrito');
  $logeado = 0;
  ?>
  <!--<ul>
    <li><a href="">paso 1</a></li>
    <li><a href="">paso 2</a></li>
    <li><a href="">paso 3</a></li>
  </ul>-->
 
<div id="content" class="secbg">
  <div class="container">
    <!--<?= $this->Form->create($pedido, array('id' => 'formulario')); ?>-->
    <div id="carrito_2">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="step_01">
          <?php 
            $classb2="";
            if($this->UserAuth->isLogged()) { 
                $classb2="";
                $logeado = $this->UserAuth->getUser(); $logeado = 1; ?>
          <div class="block_1 ">
            <!-- <a class="btntx step2" href="#">Continuar</a> -->
            <div class="title_1"><span>1</span>Hola <?php echo $usuario['first_name']; ?></div>
            <br>
            <?php if($direcciones_envio->toArray() != null){ ?>
            <div id='datos_usuario'>
              <h3>No. cliente: <?php echo $usuario['id']; ?></h3>
              <!-- LOGEADO PERO SIN DIRECCION ENVIO -->
              <?php if(count($direcciones_envio->toArray()) > 1){ ?>
              <br>
              <label class="label_text">Seleccionar dirección de envío</label>
              
              
              <div class="row lpt">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php echo $this->Form->input('envio_a', array('class'=>'textbox_1', 'label'=>false, 'options' => $direcciones_envio, 'value' => $direccion_envio->id)); ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="btnbox" style="margin-top:-22px;">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="#" id="aplicar_direccion_envio">Aplicar</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if(isset($direccion_envio)) { ?>
              
              <!--********************** Datos ya registrados *********************************-->
              <div class="row lpt">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="radio" class="radio_1 recoger_sucursal" value="0" name="recoger_sucursal_check" checked> Enviar a Domicilio</li> &nbsp;&nbsp;&nbsp;
                    <input type="radio" class="radio_1 recoger_sucursal" value="1" name="recoger_sucursal_check"> Recoger en Sucursal</li>
                </div>
              </div>
              
              <h4>DIRECCIÓN DE ENVÍO</h4>
              <ul class="dir-env">
                <li><label class="label_text">Calle: <span><?php echo $direccion_envio->calle; ?></span></label></li>
                <li><label class="label_text">No. Exterior: <span><?php echo $direccion_envio->numero_exterior; ?></span></label></li>

                <li><label class="label_text">No. Interior: <span><?php echo $direccion_envio->numero_interior; ?></span></label></li>

                <li><label class="label_text">Entre Calles: <span><?php echo $direccion_envio->entre_calles; ?></span></label></li>
                <li><label class="label_text">Código Postal:<span><?php echo $direccion_envio->codigo_postal; ?></span></label></li>
                <li><label class="label_text">Colonia: <span><?php echo $direccion_envio->colonia; ?></span></label></li>
                <li><label class="label_text">Ciudad: <span><?php echo $direccion_envio->ciudad; ?></span></label></li>
                <li><label class="label_text">Estado: <span><?php echo $direccion_envio->estado; ?></span></label></li>
              </ul>
              <?php } ?>
              <?php if($usuario['rfc'] != '') { ?>
              <h4>DATOS DE FACTURACIÓN</h4>

              <ul class="dir-env">
                <li><label class="label_text">RFC:<span> <?php echo $usuario['rfc']; ?> </span></label></li>
                <li><label class="label_text">Razón Social:<span> <?php echo $usuario['razon_social']; ?> </span></label></li>

                <li><label class="label_text">Calle: <span><?php echo $usuario['calle']; ?></span></label></li>

                <li><label class="label_text">No. Exterior: <span><?php echo $usuario['numero_exterior']; ?></span></label></li>
                <li><label class="label_text"> No. Interior: <span><?php echo $usuario['numero_interior']; ?></span></label></li>
                <li><label class="label_text">Entre Calles: <span><?php echo $usuario['entre_calles']; ?></span></label></li>
                <li><label class="label_text">Código Postal: <span><?php echo $usuario['codigo_postal']; ?></span></label></li>
                <li><label class="label_text">Colonia: <span><?php echo $usuario['colonia']; ?></span></label></li>
                <li><label class="label_text">Ciudad: <span><?php echo $usuario['ciudad']; ?></span></label></li>
                <li><label class="label_text">Estado: <span><?php echo $usuario['estado']; ?></span></label></li>
              </ul>
              <?php } ?>
                <div class="row">
                    <a class="btn btn-default" href="#" id="editar_datos_envio">Editar Mis Datos</a>
                    <a class="ps_1 btn btn-info">Continuar</a>
                </div>
            </div>
            <!-- FINALIZA LOGEADO PERO SIN DIRECCION ENVIO -->
            <!--********************** Edicion datos *********************************-->
            <div  style="display:none;" id='editar_datos_usuario'>
              <!-- EDICION DE DATOS LOGEADO CON DIRECCION -->
              <form id="nuevos_datos_envio">
                <h4>DIRECCIÓN DE ENVIO</h4>
                <div class="form-align">
                  <label class="label_text">Calle *</label>
                  <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=> $direccion_envio->calle)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">No. Exterior *</label>
                  <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=> $direccion_envio->numero_exterior)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">No. Interior</label>
                  <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>false, 'value'=> $direccion_envio->numero_interior)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Entre Calles *</label>
                  <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=> $direccion_envio->entre_calles)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Código Postal *</label>
                  <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$this->request->session()->read('codigo_postal'))); ?>
                  <div><a href="#" id="buscar_codigo_postal" class="cp-et"><i class="fa fa-search"></i></a></div>
                </div>
                
                <div class="form-align">
                  <label class="label_text">Colonia *</label>
                  <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=> $direccion_envio->colonia)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Estado *</label>
                  <?php echo $this->Form->input('estado_', array('class'=>'textbox_1', 'label'=>false, 'options'=>$estados_busqueda, 'empty' => 'Selecciona un estado', 'value'=>$direccion_envio['estado'])); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Ciudad *</label>
                  <?php echo $this->Form->input('ciudad', array('class'=>'textbox_1', 'label'=>false, 'options'=>$ciudades_direccion, 'empty' => 'Selecciona una ciudad', 'value'=>$direccion_envio['ciudad'])); ?>
                </div>
                <?php if($usuario['rfc'] == ''){ ?>
                <div class="form-align">
                  <ul class="radiobox dbl ldb">
                    <li><p>¿Agregar datos de Facturacion?</p></li>
                    <li><input type="radio" class="radio_1" value="1" name="facturar_" id="facturar">Si</li>
                    <li><input type="radio" class="radio_1" value="0" name="facturar_" id="facturar" checked>No</li>
                  </ul>
                </div>
                <?php } ?>
                <div <?php if($usuario['rfc'] == ''){ ?> style="display : none;" <?php } ?>  id="datos_factura">
                  <h4>DATOS DE FACTURACIÓN</h4>
                  <div class="form-align">
                    <label class="label_text">RFC *</label>
                    <?php echo $this->Form->input('rfc', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['rfc'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Razon Social *</label>
                    <?php echo $this->Form->input('razon_social', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['razon_social'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Calle *</label>
                    <?php echo $this->Form->input('calle_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['calle'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">No. Exterior *</label>
                    <?php echo $this->Form->input('no_exterior_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['numero_exterior'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">No. Interior</label>
                    <?php echo $this->Form->input('no_interior_fiscal', array('class'=>'textbox_1', 'label'=>false, 'value' => $usuario['numero_interior'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Entre Calles *</label>
                    <?php echo $this->Form->input('entre_calles_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['entre_calles'])); ?>
                  </div>
                  <div class="form-align">
                      <label class="label_text">Código Postal *</label>
                      <?php echo $this->Form->input('codigo_postal_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['codigo_postal'])); ?>
                  </div>
                    <!--
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <br>
                          <div><a href="#" id="editar_codigo_postal_fiscal"><i class="fa fa-pencil"></i> Editar Codigo Postal</a></div>
                      </div>  
                      --> 
                  <div class="form-align">
                    <label class="label_text">Colonia *</label>
                    <?php echo $this->Form->input('colonia_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['colonia'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Ciudad *</label>
                    <?php echo $this->Form->input('ciudad_id_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['ciudad'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Estado *</label>
                    <?php echo $this->Form->input('estado_id_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value' => $usuario['estado'])); ?>
                  </div>
                </div>
              </form>
              <div class="btnbox">
                  <div class="row">
                    <a href="#" id="cancelar_datos_envio">Cancelar</a>
                    <a href="#" id="finalizar_edicion">Finalizar Edición</a>
                  </div>
              </div>
            </div>
            <!-- FINALIZA EDICION DE DATOS LOGEADO CON DIREECION-->
            <?php } ?>
            <!-- DATOS DE LOGEADO SIN DIRECCION -->
            <?php if($direcciones_envio->toArray() == null){ ?>
            <div id="datos_usuario_nuevos">
              <h4>DIRECCIÓN DE ENV&iacute;O</h4>
              <form id="nuevos_datos_envio">
                <div class="form-align">
                  <label class="label_text">Calle *</label>
                  <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
                </div>
                <div class="form-align">
                    <label class="label_text">No. Exterior *</label>
                    <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
                </div>
                <div class="form-align">
                    <label class="label_text">No. Interior</label>
                    <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>false)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Entre Calles *</label>
                  <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Código Postal *</label>
                  <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$this->request->session()->read('codigo_postal'))); ?>
                  <div><a href="#" id="buscar_codigo_postal" class="cp-et"><i class="fa fa-search"></i></a></div>
                </div>
                <div class="form-align">
                  <label class="label_text">Colonia *</label>
                  <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Estado *</label>
                  <?php echo $this->Form->input('estado_', array('class'=>'textbox_1', 'label'=>false, 'options'=>$estados_busqueda, 'empty' => 'Selecciona un estado', 'value'=>$direccion_envio['estado'])); ?>
                </div>
                <div class="form-align">
                  <label class="label_text">Ciudad *</label>
                  <?php echo $this->Form->input('ciudad', array('class'=>'textbox_1', 'label'=>false, 'options'=>$ciudades_direccion, 'empty' => 'Selecciona una ciudad', 'value'=>$direccion_envio['ciudad'])); ?>
                </div>
                <?php if($usuario['rfc'] == ''){ ?>
                <div class="form-align">
                  <ul class="radiobox dbl ldb">
                    <li><p>¿Agregar datos de Facturacion?</p></li>
                    <li><input type="radio" class="radio_1" value="1" name="facturar_" id="facturar">Si</li>
                    <li><input type="radio" class="radio_1" value="0" name="facturar_" id="facturar" checked>No</li>
                  </ul>
                </div>
                <?php } ?>
                <div <?php if($usuario['rfc'] == ''){ ?> style="display : none;" <?php } ?> id="datos_factura">
                  <h4>DATOS DE FACTURACIÓN</h4>
                  <div class="form-align">
                    <label class="label_text">RFC *</label>
                    <?php echo $this->Form->input('rfc', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['rfc'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Razon Social *</label>
                    <?php echo $this->Form->input('razon_social', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['razon_social'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Calle *</label>
                    <?php echo $this->Form->input('calle_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['calle'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">No. Exterior *</label>
                    <?php echo $this->Form->input('no_exterior_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['numero_exterior'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">No. Interior</label>
                    <?php echo $this->Form->input('no_interior_fiscal', array('class'=>'textbox_1', 'label'=>false, 'value'=>$usuario['numero_interior'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Entre Calles *</label>
                    <?php echo $this->Form->input('entre_calles_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['entre_calles'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Código Postal *</label>
                    <?php echo $this->Form->input('codigo_postal_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['codigo_postal'])); ?>
                  </div>
                    <!--
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <br>
                          <div><a href="#" id="editar_codigo_postal_fiscal"><i class="fa fa-pencil"></i> Editar Codigo Postal</a></div>
                      </div>  
                      --> 
                  <div class="form-align">
                    <label class="label_text">Colonia *</label>
                    <?php echo $this->Form->input('colonia_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['colonia'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Ciudad *</label>
                    <?php echo $this->Form->input('ciudad_id_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['ciudad'])); ?>
                  </div>
                  <div class="form-align">
                    <label class="label_text">Estado *</label>
                    <?php echo $this->Form->input('estado_id_fiscal', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'value'=>$usuario['estado'])); ?>
                  </div>
              </form>
            </div>
            <div class="btnbox">
                <div class="row">
                  <a href="#" id="guardar_datos_nuevos">Guardar Datos</a>
                </div>
              </div>
            <?php $classb2="";
              } ?>
            <!-- FINALIZA DATOS DE LOGEADO SIN DIRECCION -->
          </div>
          <?php }else{ ?>
          <div class="block_1">
            <div class="title_1"><span>1</span>Registro</div>
            <!--
              <div class="btnbox">
                  <div class="row">
              
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="/login/" data-toggle="modal" data-target="#modal-login">Ya estoy Registrado</a></div>
              
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="reg" href="#">Registrarme</a></div>
              
                  </div>
              </div>
              -->
            <br>     
            <ul id="myTab" class="nav nav-tabs mune" role="tablist">
              <li role="presentation" class="active" id="registrarme_active">
                <a id="registrarme"> Registrarme </a>
              </li>
              <li role="presentation" class="" id="logearme_active">
                <a id="logearme"> Ya estoy Registrado </a>
              </li>
            </ul>
            <div id="logearme_form" style="display:none;">
              <!-- Inicia de Registrarme -->
              <div class="row mx-log">
                <?php echo $this->Form->create($userEntity, ['url'=>'/login', 'id'=>'loginForm', 'class'=>'m-t']); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php echo $this->Form->input('Users.email', ['type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Correo Electronico'), 'class'=>'textbox_1']); ?>
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
                  <?php echo $this->Html->link(__('¿Recuperar Contraseña?'), '/forgotPassword', ['class'=>'block full-width m-b', 'style'=>'color:#E4680A;']); ?>
                  <?php //echo $this->Html->link(__('Email Verification'), '/emailVerification', ['class'=>'btn btn-default pull-right um-btn']); ?>
                </div>
                <?php echo $this->Form->end(); ?>
                <?php echo $this->element('Usermgmt.provider'); ?>
              </div>
            </div>
            <?= $this->Form->create(null, ['action'=>'registrarme', 'id' => 'formulario_registrarme']); ?> 
            <!--********************** Inicia de Registrarme *********************************-->
            <div id="registrarme_form">
              <div class="form-align">
                <?php echo $this->Form->input('first_name', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Nombre *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('last_name', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Apellido *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('telefono_local', array('class'=>'textbox_1 requerido', 'label'=>false, 'data-mask'=>'(999) 999-9999', 'placeholder'=>'Teléfono *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('telefono_celular', array('class'=>'textbox_1 requerido', 'label'=>false, 'data-mask'=>'(999) 999-9999', 'placeholder'=>'Celular *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('email', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Email *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('password', array('class'=>'textbox_1 requerido', 'label'=>false, 'type'=>'password', 'placeholder'=>'Contraseña *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('confirmar_password', array('class'=>'textbox_1 requerido', 'label'=>false, 'type'=>'password', 'placeholder'=>'Confirmar contraseña *')); ?>
              </div>
              <h4>DIRECCIÓN DE ENVÍO</h4>
              <div class="form-align">
                <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Calle *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'No. Exterior *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>false, 'placeholder'=>'No. Interior')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Entre Calles *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Código Postal *', 'value'=>$this->request->session()->read('codigo_postal'))); ?>
                  <a href="#" id="buscar_codigo_postal"><i class="fa fa-search"></i></a>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Colonia *')); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('estado_envio', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Estado *', 'options'=>$estados_busqueda, 'empty' => 'Selecciona un estado', 'value'=>$direccion->estado)); ?>
              </div>
              <div class="form-align">
                <?php echo $this->Form->input('ciudad_envio', array('class'=>'textbox_1 requerido', 'label'=>false, 'placeholder'=>'Ciudad *', 'options'=>$ciudades_direccion, 'empty' => 'Selecciona una ciudad',  'value'=>$direccion->ciudad)); ?>
              </div>
              <div class="form-align">
                <ul class="radiobox">
                  <li><p>¿Requieres Factura?</p></li>
                  <li><input type="radio" class="radio_1" value="1" name="facturar" id="facturar">Si</li>
                  <li><input type="radio" class="radio_1" value="0" name="facturar" id="facturar" checked>No</li>
                </ul>
            </div>
              <!--********************** Datos de Facturación *********************************-->
              <div style="display:none;" id="datos_factura">
                <div class="form-align">
                  <?php echo $this->Form->input('rfc', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'placeholder'=>'RFC *')); ?>
                </div>
                <div class="form-align">
                  <?php echo $this->Form->input('razon_social', array('class'=>'textbox_1 requerido_factura', 'label'=>false, 'placeholder'=>'Razón Social *')); ?>
                </div>
                <div class="form-align">
                  <ul class="radiobox dbl">
                    <li><p>¿Su Dirección fiscal es igual a la de su envío?</p></li>
                    <li><input type="radio" class="radio_1" value="si" id="enviar_direccion_fiscal" name="enviar_direccion_fiscal" checked>Si</li>
                    <li><input type="radio" class="radio_1" value="no" id="enviar_direccion_fiscal" name="enviar_direccion_fiscal">No</li>
                  </ul>
                </div>
              </div>
              <div style="display:none;" id="direccion_fiscal">
                  <h4>DIRECCIÓN FISCAL</h4>
                  <div class="form-align">
                    <?php echo $this->Form->input('calle_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Calle *')); ?>
                  </div>
                  <div class="form-align">
                    <?php echo $this->Form->input('no_exterior_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'No. Exterior *')); ?>
                  </div>
                  <div class="form-align">
                    <?php echo $this->Form->input('no_interior_fiscal', array('class'=>'textbox_1', 'label'=>false, 'placeholder'=>'No. Interior')); ?>
                  </div>
                  <div class="form-align">
                    <?php echo $this->Form->input('entre_calles_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Entre Calles *')); ?>
                  </div>
                  <div class="form-align">
                    <?php echo $this->Form->input('codigo_postal_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Código Postal *')); ?>
                  </div>
                  <!--
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <br>
                        <div><a href="#" id="editar_codigo_postal_fiscal"><i class="fa fa-pencil"></i> Editar Codigo Postal</a></div>
                    </div>   
                    -->
                <div class="form-align">
                  <?php echo $this->Form->input('colonia_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Colonia *')); ?>
                </div>
                <div class="form-align">
                  <?php echo $this->Form->input('ciudad_id_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Ciudad *')); ?>
                </div>
                <div class="form-align">
                  <?php echo $this->Form->input('estado_id_fiscal', array('class'=>'textbox_1 requerido_factura2', 'label'=>false, 'placeholder'=>'Estado *')); ?>
                </div>
              </div>
              <?= $this->Form->end() ?>
              <div class="btnbox">
                  <a class="reg" href="#" id="finalizar_registro">Registrar</a>
              </div>
            </div>
            <!-- Fin de Registrarme -->
          </div>
          <?php } ?>
        </div>
        <?= $this->Form->create($pedido, array('id' => 'formulario')); ?>

        <input type="hidden" name="recoger_sucursal" id="recoger_sucursal" value="0">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="step_02">
          <div class="block_2 <?php echo $classb2;?>">
            <div class="title_1"><span>2</span>Forma de Pago</div>
            <div class="formas_pg">
            <?php 
              foreach ($FormasdePagos as $FormadePago): 
              ?>
            <div class="blk_1" style="margin-bottom:-50px;">
              <input type="radio" class="radio_1 pjd" value="<?php echo $FormadePago->id; ?>" name="formasdepago_id" data-forma="forma_<?php echo $FormadePago->id; ?>">
              <input type="hidden" id="redcompensaforma_<?php echo $FormadePago->id; ?>" value="<?php echo $FormadePago->redcompensa; ?>" name="redcompensa_<?php echo $FormadePago->id; ?>">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <p><strong><?php echo $FormadePago->nombre; ?></strong></p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4"><img src="/img/<?php echo $FormadePago->imagen; ?>"></div>
              </div>
              <?php if($FormadePago->redcompensa){?>
              <span style="font-size:10px;color: #9d0d04;">Utiliza esta forma de pago y obtendras una RedCompensa del 3% de descuento</span>
              <?} ?>
              <block id="forma_<?php echo $FormadePago->id; ?>"style="display:none;">
                <p><?php echo $FormadePago->descripcion; ?></p>
              </block>
              <hr>
            </div>
            <?php endforeach; ?>
             <div class="btnbox">
                <div class="row">
            
            <a class="ps_2-back btn btn-default">Regresar</a>        
            <a class="ps_2 btn btn-info">Continuar</a>
                </div>
              </div>
          </div>

          </div>
        </div>



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="step_03">
          <div class="block_3">
            <div class="title_1"><span>3</span>Confirmar Pedido</div>
            <div class="pedido_sn">
              <div class="line_2">
                  <h4>Tu compra es de:</h4>
                  <table>
                    <tr>
                      <th><p>Cantidad</p></th>
                      <th><p>SKU</p></th>
                      <th><p>Titulo</p></th>
                      <th><p>Precio</p></th>
                    </tr>
                    <?php 
                      //$envio=0;
                      $ahorro=0;
                      $subtotal=0;
                      $totalCupon=0;
                      foreach ($carrito as $articulo): 
                          $ahorro=$articulo['cantidad']*$articulo['ahorro'];
                          $subtotal+=((($articulo['cantidad'] * $articulo['precio']) - $ahorro) / 1.16);
                          $totalCupon+=$articulo['descuento_cupon'];
                          //$envio+=$articulo['cantidad']*$articulo['envio'];
                      ?>
                    <tr>
                      <td><p> <?php echo $articulo['cantidad'];?></p></td>
                      <td><p> <?php echo $articulo['sku'];?></p></td>
                      <td><p><?php echo $articulo['producto'];?></p></td>
                      <td><p>$<?php echo number_format(((($articulo['cantidad'] * $articulo['precio']) - $ahorro) / 1.16),2); ?></p></td>
                    </tr>
                    <?php endforeach; ?>
                  </table>
              </div>
              <div class="line_2">
                <div class="ptotales">
                  <span>Sub-Total</span><p>$<?php echo number_format($subtotal,2); ?></p>
                  <input type="hidden" id="subtotal" value="<?php echo $subtotal; ?>">
                </div>
              </div>
              <input type="hidden" id="redcompensaTotal" value="0" name="redcompensa">
              <?php if($this->request->session()->check('cupon')){ ?>
              <div class="line_2">
                <span>Cupon</span><span>- $<?php echo number_format($totalCupon,2); ?></span>
              </div>
              <?php } ?>
              <div class="line_2">
                <div class="ptotales">
                  <span>Envío</span><p id="calculo_envio">$<?php echo number_format($envio,2); ?> </p>
                  <input type="hidden" id="envio" value="<?php echo $envio; ?>">
                </div>
              </div>
              <div class="line_2">
                <div class="ptotales">
                  <span>IVA</span><p id="calculo_iva">$<?php $iva=($subtotal+$envio-$totalCupon)* .16; echo number_format($iva,2); ?></p>
                  <input type="hidden" id="iva" value="<?php echo ($subtotal+$envio-$totalCupon)* .16; ?>">
                </div>
              </div>
              <div class="line_3">
                <div class="ptotales">
                  <span>Total</span><p id="calculo_total">
                  $<?php echo number_format($subtotal + $envio - $totalCupon + $iva,2); ?> <b>MXN</b></p>
                  <input type="hidden" id="total" value="<?php echo $subtotal + $envio - $totalCupon + $iva; ?>">
                </div>
              </div>
              <label class="label_text cmss">Comentarios del pedido</label>
              <div class="form-group">
                <textarea  class="textbox_1 form-control yuz" name="comentario"></textarea>
              </div>
              <div class="btnbox fnc">
                <a href="#" class="btn btn-warning" id="finalizar_compra">Finalizar Compra</a>
              </div>
              <a class="ps_3 btn btn-default">Regresar</a> 
            </div>
            <?php if($envio_exitoso != 0){ ?>
            <div class="blk_1">
              <h4><span>GRACIAS POR TU COMPRA</span>Su Pedido  No.<?php echo $envio_exitoso; ?>Ha sido Recibido</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu risus quis nunc sollicitudin mattis mollis in quam. Sues apendisse imperdiet, velit id tincidunt inte rdum, eros </p>
              <?php if($file){ echo '<a href="'.$file.'">Recibo de compra</a>'; } ?>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
<div id="modal-login" class="modal inmodal fade" style="z-index:99999;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    </div>
  </div>
</div>

<div class="modal inmodal fade" id="buscar-codigo-postal" tabindex="-1" role="dialog"  aria-hidden="true" style="z-index:99999;">
  <!--el modal-->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#1e547f; color:white;">
        <button type="button" class="close" data-dismiss="modal" style="color:white;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div style="float:left; margin-right:30px; margin-top:-4px;">
          <h4 class="modal-title">Encuentra tu Código Postal el bueno</h4>
        </div>
        <div style="font-size:12px;margin-right:15px;">El código postal es importante para calcular el env&iacute;o</div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="col-sm-5 control-label" style="padding:7px 20px;">Estado</label>      
            <div class="col-md-7">
              <?php echo $this->Form->input('busca_estado', array('options'=>$estados_busqueda, 'empty'=>'Selecciona un estado', 'label'=>false)); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-5 control-label" style="padding:7px 20px;">Ciudad</label>      
            <div class="col-md-7">
              <?php echo $this->Form->input('busca_ciudad', array('options'=>[], 'empty'=>'Selecciona una ciudad','label'=>false)); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-5 control-label" style="padding:7px 20px;">Colonia</label>      
            <div class="col-md-7">
              <?php echo $this->Form->input('busca_colonia', array('options'=>[], 'empty'=>'Selecciona una colonia','label'=>false)); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-5 control-label" style="padding:7px 20px;">Código Postal</label>      
            <div class="col-md-7"><input type="text" class="form-control" id="busca_cp" readonly></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"><button type="button" class="form-control" style="background-color:#e56809; color:white;" id="aplicar_codigo_postal">Aplicar</button></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#password').keyup(function(){
  
      $('#confirmar-password').val('');
  
  });
  
  $('#confirmar-password').change(function(){
      
      if($('#password').val() != $('#confirmar-password').val()){
          alert('El password no coincide. Intentalo de nuevo');
          $('#password').val('');
          $('#confirmar-password').val('');
      }
  
  });
  
  
  $('#estado-envio').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_ciudad"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#ciudad-envio').html('').append('')
              $('#ciudad-envio').append('<option value="">Selecciona una ciudad</option>');      
              $.each(data.data, function(k,v){
                      $('#ciudad-envio').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#estado').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_ciudad"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#ciudad').html('').append('')
              $('#ciudad').append('<option value="">Selecciona una ciudad</option>');      
              $.each(data.data, function(k,v){
                      $('#ciudad').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#busca-estado').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_ciudad"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#busca-ciudad').html('').append('')
              $('#busca-ciudad').append('<option value="">Selecciona una ciudad</option>');      
              $.each(data.data, function(k,v){
                      $('#busca-ciudad').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#busca-ciudad').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_colonia"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#busca-colonia').html('').append('')
              $('#busca-colonia').append('<option value="">Selecciona una colonia</option>');      
              $.each(data.data, function(k,v){
                      $('#busca-colonia').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#busca-colonia').change(function(){
      var selected = $(this).val();
      
      $('#busca_cp').val(selected);
  
  });
  
  $('#aplicar_codigo_postal').click(function(){
      
      $('#codigo-postal').val($('#busca_cp').val());
  
      $('#colonia').val($('#busca-colonia :selected').text());
  
       <?php if($logeado == 0){ ?>
  
          $('#ciudad-envio').html('').append('');
  
          $( "#busca-ciudad option" ).each(function() {
              var valor = $(this).val(); 
              var texto = $(this).text();
            
              $('#ciudad-envio').append('<option value="'+valor+'">'+texto+'</option>');      
          });
  
  
          $('#ciudad-envio').val($('#busca-ciudad').val());
          $('#estado-envio').val($('#busca-estado').val());
  
          /*
          var codigo_postal = $('#codigo-postal').val();
  
          $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
  
                      location.reload(true);
                      
                  }
          });
          */
  
  
      <?php }else{ ?>
  
  
          $('#ciudad').html('').append('');
  
          $( "#busca-ciudad option" ).each(function() {
              var valor = $(this).val(); 
              var texto = $(this).text();
            
              $('#ciudad').append('<option value="'+valor+'">'+texto+'</option>');      
          });
  
          $('#ciudad').val($('#busca-ciudad').val());
          $('#estado').val($('#busca-estado').val());
  
      <?php } ?>
  
      $('#buscar-codigo-postal').modal('hide');
  
  });
  
  
  $('#editar_datos_envio').click(function(){
      $("#datos_usuario").css("display", "none");
      $("#editar_datos_usuario").css("display", "block");
  });
  $('#cancelar_datos_envio').click(function(){
      location.reload(true);
  });
  
  $('#logearme').click(function(){
      $("#logearme_form").css("display", "block");
      $("#registrarme_form").css("display", "none");
  
      $('#logearme_active').addClass('active');
      $('#registrarme_active').removeClass('active');
  });
  
  $('#registrarme').click(function(){
      $("#logearme_form").css("display", "none");
      $("#registrarme_form").css("display", "block");
  
      $('#logearme_active').removeClass('active');
      $('#registrarme_active').addClass('active');
  });
  
  $(document).on({click: function(e){
      //e.preventDefault();
      var _this = $(this);
      var forma = _this.data('forma');
      
      $("block").css("display", "none");
      $("#"+forma).css("display", "block");
  
  }}, '.radio_1'); 

  $(document).on({click: function(e){
      //e.preventDefault();
      var _this = $(this);
    
      if(_this.val() == 1){
          
          $("#calculo_envio").html('$0.00');
         
          var cupon = '<?php echo $totalCupon ?>';
          var iva = (parseFloat($("#subtotal").val()) - parseFloat(cupon)) * .16;

          $("#calculo_iva").html('$'+numberFormat(parseFloat(iva)));
          $("#calculo_total").html('$'+numberFormat(parseFloat($("#subtotal").val()) - parseFloat(cupon) + parseFloat(iva))+' <b>MXN</b>');
      }else{

          var envio = '<?php echo $envio ?>'; 
          var cupon = '<?php echo $totalCupon ?>';
          var iva = (parseFloat($("#subtotal").val()) + parseFloat(envio) - parseFloat(cupon)) * .16;

          $("#calculo_iva").html('$'+numberFormat(parseFloat(iva)));
          $("#calculo_total").html('$'+numberFormat(parseFloat($("#subtotal").val()) + parseFloat(envio) - parseFloat(cupon) + parseFloat(iva))+' <b>MXN</b>');

          $("#calculo_envio").html('$'+numberFormat(parseFloat(envio)));
      }

      $("#recoger_sucursal").val(_this.val());
     
  
      function numberFormat(n){
          return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
      }
  
  }}, '.recoger_sucursal');
  
  $(document).on({click: function(e){
     
      var _this = $(this);
      
      if(_this.val()=='1')
      {
          $("#datos_factura").css("display", "block");
      }else{
          $("#datos_factura").css("display", "none");
      }
     
  }}, '#facturar');
  
  $(document).on({click: function(e){
     
      var _this = $(this);
      
      if(_this.val()=='no')
      {
          $("#direccion_fiscal").css("display", "block");
      }else{
          $("#direccion_fiscal").css("display", "none");
      }
     
  }}, '#enviar_direccion_fiscal');
  
  
  $('#estado-id').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_municipio"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#municipio-id').html('').append('')
                  
              //$('#ciudad-id').append('<option value="">Selecciona una Ciudad</option>');  
              $.each(data.data, function(k,v){
                      $('#municipio-id').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#estado-id-fiscal').change(function(){
      var selected = $(this).val();
      
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "busqueda_municipio"]); ?>',
          data: {selected:selected},
          dataType: 'json',
          success: function(data){
              
              
              $('#ciudad-id-fiscal').html('').append('')
                  
              //$('#ciudad-id').append('<option value="">Selecciona una Ciudad</option>');  
              $.each(data.data, function(k,v){
                      $('#ciudad-id-fiscal').append('<option value="'+k+'">'+v+'</option>');          
              })
          
              
          }
      })
  
  });
  
  $('#finalizar_compra').click(function(){
     
      var carrito = '<?php echo count($carrito); ?>';
      var codigo = '<?php echo count($this->request->session()->read("codigo_postal")); ?>'; 
  
      var forma_pago = $('input:radio[name=formasdepago_id]:checked').val();
  
          
  
      if(carrito > 0)
      {
          if($('#datos_usuario_nuevos').is(":visible")){
  
              alert('Da clic en guardar datos de direccion de envío');
  
          }else{
  
              if(forma_pago != undefined){
  
                  if($('#editar_datos_usuario').is(":visible")){
  
                      alert('Finaliza o cancela la edicion de datos');
  
                  }else{
  
                      if(codigo == 0){
  
                          alert('El codigo postal es muy importante para calcular el envío');
  
                      }else{
  
                          $("#formulario").submit();
                      }
  
                  }
                  
  
              }else{
  
                  alert('Selecciona una forma de pago');
  
              }
  
          }
          
      }else{
          alert('No hay productos en el carrito');
      }
      
  
  });
  
  $('.requerido, .requerido_factura').keyup(function(){
  
          if($(this).val() == ''){
  
              $(this).addClass('obligatorio');
              valido = 0;
  
          }else{
  
              $(this).removeClass('obligatorio');
  
          }
  
  });
  
  
  $('#finalizar_registro').click(function(){
  
      var valido = 1;
  
      $(".requerido").each(function (index) { 
          
          if($(this).val() == ''){
  
              $(this).addClass('obligatorio');
              valido = 0;
  
          }else{
  
              $(this).removeClass('obligatorio');
  
          }
          
      }); 
  
      if($('#datos_factura').is(":visible")){
  
          $(".requerido_factura").each(function (index) { 
          
              if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
              }else{
  
                  $(this).removeClass('obligatorio');
  
              }
          
          }); 
      }
  
      if($('#direccion_fiscal').is(":visible")){
  
          $(".requerido_factura2").each(function (index) { 
          
              if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
              }else{
  
                  $(this).removeClass('obligatorio');
  
              }
          
          }); 
      }
  
  
      if(valido == 1){
  
          $("#formulario_registrarme").submit();
          
      }
      
  });
  
  
  
  $('#finalizar_edicion, .reg').click(function(){
  
      var valido = 1;
  
      $(".requerido").each(function (index) { 
          
          if($(this).val() == ''){
  
              $(this).addClass('obligatorio');
              valido = 0;
  
          }else{
  
              $(this).removeClass('obligatorio');
  
          }
          
      }); 
  
      if($('#datos_factura').is(":visible")){
  
          $(".requerido_factura").each(function (index) { 
          
              if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
              }else{
  
                  $(this).removeClass('obligatorio');
  
              }
          
          }); 
      }
  
  
      if(valido == 1){
  
      
          $.ajax({
      
                      type: 'POST',
                      url: '<?php echo $this->Url->build(["action" => "editar_datos_usuario"]); ?>',
                      data: $('#nuevos_datos_envio').serialize(),
                      dataType: 'json',
                      success: function(data){
  
                          location.reload(true);
  
                      }
          });
  
      }else{
  
          alert('Faltan datos obligatorios. Todos los campos con * son obligatorios');
  
      }
      
  });
  
  $('#guardar_datos_nuevos').click(function(){
      
  
      var valido = 1;
  
      $(".requerido").each(function (index) { 
          
          if($(this).val() == ''){
  
              $(this).addClass('obligatorio');
              valido = 0;
  
          }else{
  
              $(this).removeClass('obligatorio');
  
          }
          
      }); 
  
      if($('#datos_factura').is(":visible")){
  
          $(".requerido_factura").each(function (index) { 
          
              if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
              }else{
  
                  $(this).removeClass('obligatorio');
  
              }
          
          }); 
      }
  
  
      if(valido == 1){
  
      
          //var input = $("#datos_usuario_nuevos input").map(function() { return $(this).val(); }).get();
          
  
          $.ajax({
      
                      type: 'POST',
                      url: '<?php echo $this->Url->build(["action" => "editar_datos_usuario"]); ?>',
                      data: $('#nuevos_datos_envio').serialize(),
                      dataType: 'json',
                      success: function(data){
  
                          location.reload(true);
  
                      }
          });
  
          
  
          
      }else{
  
          alert('Faltan datos obligatorios. Todos los campos con * son obligatorios');
  
      }
  
      
  });
  
  
  jQuery.fn.reset = function () {
      $(this).each (function() { this.reset(); });
  }
  $('#formulario').each (function(){
      this.reset();
  });
  
  $("#formulario").reset();
  
  $('#editar_codigo_postal').click(function(){
      $('#modal-codigo-postal').modal();
  });
  
  $('#editar_codigo_postal_fiscal').click(function(){
      $('#modal-codigo-postal-fiscal').modal();
  });
  
  $('#editar_codigo_postal_').click(function(){
      $('#modal-codigo-postal-').modal();
  });
  
  
  $('#buscar_codigo_postal').click(function(){
      $('#buscar-codigo-postal').modal();
  });
  
  
  $('#codigo-postal').change(function(){
     
      var codigo_postal = $('#codigo-postal').val();
      var direccion_id = $('#envio-a').val();
      
      if (codigo_postal != '' && codigo_postal != 0)
      {
          if(direccion_id == undefined)
          {
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
    
                      if(data != null){
  
                          var codigo = data.codigo;
                          var ciudad = data.ciudad;
                          var estado = data.estado;
  
                          $.ajax({
  
                              type: 'POST',
                              url: '<?php echo $this->Url->build(["action" => "busqueda_ciudad"]); ?>',
                              data: {selected:estado},
                              dataType: 'json',
                              success: function(data){
                                  
                                  
                                  <?php if($logeado == 0){ ?>
  
                                      
  
                                      $('#ciudad-envio').html('').append('');
                                      $('#ciudad-envio').append('<option value="">Selecciona una ciudad</option>');      
                                      $.each(data.data, function(k,v){
  
                                          if(ciudad == k){
                                              $('#ciudad-envio').append('<option value="'+k+'" selected>'+v+'</option>');    
                                          }else{
                                              $('#ciudad-envio').append('<option value="'+k+'">'+v+'</option>');      
                                          }
  
                                                 
                                      })
  
  
                                     
  
                                  <?php }else{ ?>
  
                                     
  
                                      $('#ciudad').html('').append('');
                                      $('#ciudad').append('<option value="">Selecciona una ciudad</option>'); 
  
                                      $.each(data.data, function(k,v){
  
                                          if(ciudad == k){
                                              $('#ciudad').append('<option value="'+k+'" selected>'+v+'</option>');    
                                          }else{
                                              $('#ciudad').append('<option value="'+k+'">'+v+'</option>');     
                                          }
                                               
                                      })
  
  
                                  <?php } ?>
  
  
                                  
                              
                                  
                              }
                          })
              
                          $('#codigo-postal').val(codigo);
  
                          //$('#ciudad').val(ciudad);
                          $('#estado').val(estado);
  
                          $('#ciudad-envio').val(ciudad);
                          $('#estado-envio').val(estado); 
                      }else{
                          $('#ciudad-envio').append('<option value="">Selecciona una ciudad</option>');    
                          $('#ciudad-envio').val('');
                          $('#estado-envio').val('');
  
                          $('#ciudad').append('<option value="">Selecciona una ciudad</option>');
                          $('#ciudad').val('');
                          $('#estado').val('');
  
                          $('#codigo-postal').val('');
                          alert('Codigo Postal no valido');
                      }
                      
                  }
              });
          }else{
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal,
                      direccion_id:direccion_id
                  },
                  dataType: 'json',
                  success: function(data){
  
                      var codigo = data.codigo;
                      var ciudad = data.ciudad;
                      var estado = data.estado;
  
                      if(data != null){
  
                          $.ajax({
  
                              type: 'POST',
                              url: '<?php echo $this->Url->build(["action" => "busqueda_ciudad"]); ?>',
                              data: {selected:estado},
                              dataType: 'json',
                              success: function(data){
  
                                  
  
                                      $('#ciudad').html('').append('');
                                      $('#ciudad').append('<option value="">Selecciona una ciudad</option>');      
                                      $.each(data.data, function(k,v){
  
                                          if(ciudad == k){
                                              $('#ciudad').append('<option value="'+k+'" selected>'+v+'</option>');    
                                          }else{
                                              $('#ciudad').append('<option value="'+k+'">'+v+'</option>');     
                                          }
                                                
                                      })
  
                                  
                              }
                          })
  
                          $('#codigo-postal').val(codigo);
                          $('#ciudad').val(ciudad);
                          $('#estado').val(estado);
  
                      }else{
                        
                          $('#codigo-postal').val('');
                          $('#ciudad').append('<option value="">Selecciona una ciudad</option>');
                          $('#ciudad').val('');
                          $('#estado').val('');
                          alert('Codigo Postal no valido');
                      }
                      
                  }
              });
          }
  
      }else{
          $('#codigo-postal').val('');
          $('#ciudad').append('<option value="">Selecciona una ciudad</option>');
          $('#ciudad').val('');
          $('#estado').val('');
          alert('Codigo Postal no valido');
      }
  
  });
  
  /*
  $('#guarda_codigo_postal').click(function(){
     
      var codigo_postal = $('#codigo_postal').val();
      var direccion_id = $('#envio-a').val();
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
          if(direccion_id == undefined)
          {
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
  
  
                      if(data != null){
  
                          <?php if($logeado == 0){ ?>
  
                              location.reload(true);
  
                          <?php }else{ ?>
  
                              $('#codigo-postal').val(data.codigo);
                              $('#ciudad').val(data.ciudad);
                              $('#estado').val(data.estado);
  
                          <?php } ?>
                          
  
                          $('#modal-codigo-postal').modal('hide');
                          $('#codigo_postal').val('');
  
                      }else{
                          alert('Codigo Postal no valido');
                      }
                      
                      //alert(data);
                  }
              });
          }else{
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal,
                      direccion_id:direccion_id
                  },
                  dataType: 'json',
                  success: function(data){
  
  
                      if(data != null){
  
                          //location.reload(true);
  
                          $('#codigo-postal').val(data.codigo);
                          $('#ciudad').val(data.ciudad);
                          $('#estado').val(data.estado);
  
                          $('#modal-codigo-postal').modal('hide');
                          $('#codigo_postal').val('');
  
                      }else{
                          alert('Codigo Postal no valido');
                      }
                      
                      //alert(data);
                  }
              });
          }
  
      }else{
          alert('Codigo Postal no valido');
      }
  
  }); */
  
  $('#aplicar_direccion_envio').click(function(){
     
      var direccion_id = $('#envio-a').val();
  
          $.ajax({
  
              type: 'POST',
              url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
              data: {
                  direccion_id:direccion_id
              },
              dataType: 'json',
              success: function(data){
  
                 location.reload(true);     
              
              }
          });
  
  });
  
  $('#guarda_codigo_postal_').click(function(){
     
      var codigo_postal = $('#codigo_postal_').val();
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal_fiscal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
  
  
                      if(data.codigo != null){
  
                          $('#codigo-postal').val(data.codigo);
                          $('#ciudad').val(data.ciudad);
                          $('#estado').val(data.estado);
  
                          $('#modal-codigo-postal-').modal('hide');
                          $('#codigo_postal_').val('');
  
                      }else{
                          alert('Codigo Postal no valido');
                          $('#codigo_postal_').val('');
                      }
                      
                      //alert(data);
                  }
              });
          
      }else{
          alert('Codigo Postal no valido');
      }
  }); 
  
  $('#codigo-postal-fiscal').change(function(){
     
      var codigo_postal = $('#codigo-postal-fiscal').val();
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal_fiscal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
  
  
                      if(data.codigo != null){
  
                          $('#codigo-postal-fiscal').val(data.codigo);
                          $('#ciudad-id-fiscal').val(data.ciudad);
                          $('#estado-id-fiscal').val(data.estado);
  
                      }else{
                          $('#ciudad-id-fiscal').val('');
                          $('#estado-id-fiscal').val('');
                          //alert('Codigo Postal no valido');
                      }
                      
                  }
              });
          
      }else{
          $('#ciudad-id-fiscal').val('');
          $('#estado-id-fiscal').val('');
          //alert('Codigo Postal no valido');
      }
  });  
  
  /*
  $('#guarda_codigo_postal_fiscal').click(function(){
     
      var codigo_postal = $('#codigo_postal_fiscal').val();
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
              $.ajax({
  
                  type: 'POST',
                  url: '<?php echo $this->Url->build(["action" => "codigo_postal_fiscal"]); ?>',
                  data: {
                      codigo_postal:codigo_postal
                  },
                  dataType: 'json',
                  success: function(data){
  
  
                      if(data.codigo != null){
  
                          $('#codigo-postal-fiscal').val(data.codigo);
                          $('#ciudad-id-fiscal').val(data.ciudad);
                          $('#estado-id-fiscal').val(data.estado);
  
                          $('#modal-codigo-postal-fiscal').modal('hide');
                          $('#codigo_postal_fiscal').val('');
  
                      }else{
                          alert('Codigo Postal no valido');
                          $('#codigo_postal_fiscal').val('');
                      }
                      
                      //alert(data);
                  }
              });
          
      }else{
          alert('Codigo Postal no valido');
      }
  });
  */
  /*
  var codigo = '<?php echo count($this->request->session()->read("codigo_postal")); ?>'; 
  var logeado = '<?php echo $logeado; ?>';
  var direccion = '<?php echo count($direcciones_envio->toArray()); ?>';
  if(codigo == 0)
  {
      $('#modal-codigo-postal').modal();
  }else if(codigo == 0 && direccion == 1){
  
          var direccion_id = '<?php $direccionArray = array_keys($direcciones_envio->toArray()); echo $direccionArray[0]; ?>';
  
          $.ajax({
  
              type: 'POST',
              url: '<?php echo $this->Url->build(["action" => "codigo_postal"]); ?>',
              data: {
                  direccion_id:direccion_id
              },
              dataType: 'json',
              success: function(data){
  
                 location.reload(true);     
                  
              }
          });    
  }*/




  $( ".ps_1" ).click(function() {
    $("#step_01").animate({
      opacity: 0,
      top: "200px"
    }, 500, function() {
      $("#step_01").hide();
      $("#step_02").show().animate({
      opacity: 1,
      top: "0"
    }, 500, function() {});
    });
  });
  $( ".ps_2" ).click(function() {
    $("#step_02").animate({
      opacity: 0,
      top: "200px"
    }, 500, function() {
      $("#step_02").hide();
      $("#step_03").show().animate({
      opacity: 1,
      top: "0"
    }, 500, function() {});
    });
  });
  $( ".ps_3" ).click(function() {
    $("#step_03").animate({
      opacity: 0,
      top: "200px"
    }, 500, function() {
      $("#step_03").hide();
      $("#step_02").show().animate({
      opacity: 1,
      top: "0"
    }, 500, function() {});
    });
  });
  $( ".ps_2-back" ).click(function() {
    $("#step_02").animate({
      opacity: 0,
      top: "200px"
    }, 500, function() {
      $("#step_02").hide();
      $("#step_01").show().animate({
      opacity: 1,
      top: "0"
    }, 500, function() {});
    });
  });
    $(document).on({click: function(e){
      var _this = $(this);
      if (_this.attr("checked") == "checked"){
            $(".ps_2").fadeIn();
      }
      else{
        $(".ps_2").fadeOut();
      }
         
  }}, '.pjd');

  
</script>
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
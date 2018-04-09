<?php
  /* Cakephp 3.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
  Website- http://ektanjali.com
  Plugin Demo- http://cakephp3-user-management.ektanjali.com/
  Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
  Plugin Copyright No- 11498/2012-CO/L
  
  UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.
  
  By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.
  
  The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on a temporary or permanent basis, without the prior written consent of Chetan Varshney.
  
  The Product source code may be altered (at your risk)
  
  All Product copyright notices within the scripts must remain unchanged (and visible).
  
  If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.
  
  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.
  
  THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT. */
  ?>
<style>
  .arc_red{
  color:red;
  font-size: 12px;
  }
</style>
<div id="content">
  <div class="container">
    <div id="usuario">
      <div class="title_1">
        <h2>¡Hola <?php echo h($user['first_name']).' '.h($user['last_name']);?>!</h2>
        N&uacute;mero de Cliente: <?php echo h($user['id']);?>
      </div>
      <div class="title_2">
        <h3>Mis Datos</h3>
        <p>Informaci&oacute;n de Registro</p>
      </div>
      <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'editProfile'], 'id'=>'datos_usuario']); ?>
      <div class="block_1">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">Nombre</label>
                <?php echo $this->Form->input('first_name', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['first_name'])); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">Apellido</label>
                <?php echo $this->Form->input('last_name', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['last_name'])); ?>
              </div>
            </div>
            <label class="label_text">Contraseña</label>
            <?php echo $this->Form->input('password', array('class'=>'textbox_1', 'label'=>false, 'value'=>$user['password'], 'readonly'=>'readonly')); ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
            <label class="label_text">Correo Electrónico</label>
            <?php echo $this->Form->input('email', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['email'])); ?>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">Tel&eacute;fono Local</label>
                <?php echo $this->Form->input('telefono_local', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['telefono_local'])); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">Tel&eacute;fono Celular</label>
                <?php echo $this->Form->input('telefono_celular', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['telefono_celular'])); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="btnbox">
          <a href="#" class="submit_1 guardar_datos" data-formulario="datos_usuario">Guardar</a>
          <!-- <input type="submit" value="Guardar" class="submit_1 guardar_datos">--> 
        </div>
      </div>
      <?php echo $this->Form->end() ?>
      <div class="title_2" id="direcciones">
        <h3>Mi Dirección de Envío</h3>
        <p></p>
      </div>
      <div class="block_2">
        <div class="row">
          <?php foreach ($direcciones as $direccion) { ?>
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="blk_1">
              <p style="font-size:12px;"><?php echo $direccion->calle; ?> #<?php echo $direccion->numero_exterior; ?><br>
                <?php echo $direccion->colonia; ?><br> 
                <?php echo ucwords(strtolower($direccion->ciudad)).', '.ucwords(strtolower($direccion->estado)); ?><br>C.P. <?php echo $direccion->codigo_postal; ?>
              </p>
              <div class="btnbox">
                <a href="#direcciones" class="left editar-direccion" data-tag="editar_direccion_<?php echo $direccion->id; ?>">Editar</a>
                <?= $this->Form->postLink('Borrar', ['controller' => 'Users', 'action' => 'deleteDireccion', $direccion->id], ['confirm' => __('Seguro que quiere borrar la direccion.'), 'title' => __('Delete'), "escape" => false, 'class'=>'left borrar-direccion', 'style'=>'margin-left:10px;']) ?>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div id="agregar_direccion">
        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'editDireccion'], 'id'=>'datos_direccion']); ?>
        <div class="title_2">
          <h3>
            Agregar una Nueva Dirección 
            <spam class="arc_red">(Todos los datos con * son requeridos)</spam>
          </h3>
        </div>
        <div class="block_1 nobg">
          <div class="row" style="margin-top:20px;">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <?php echo $this->Form->input('cliente_id', array('class'=>'textbox_1', 'label'=>false, 'type'=>'hidden', 'value'=>$user['id'])   ); ?>
              <label class="label_text">Calle <span class="arc_red">*</span></label>
              <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">No. Exterior <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>  false)); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">No. Interior</label>
                  <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>  false)); ?>
                </div>
              </div>
              <label class="label_text">Entre Calles</label>
              <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1', 'label'=>false)); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">Colonia <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false)); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">C&oacute;digo Postal <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 codigo-postal-direccion requerido', 'label'=>false, 'data-tag'=>'direccion')); ?>
                  <a href="#direcciones" class="editar_codigo_postal" data-tag="direccion"><i class="fa fa-refresh"></i></a>
                  <!--<span style="font-size: 10px; color: #9d0d04;">Obligatorio para el calculo de su    envio</span>-->
                </div>
              </div>
              <label class="label_text">Ciudad</label>
              <?php echo $this->Form->input('ciudad', array('class'=>'textbox_1 ciudad-direccion', 'label'=>false, 'readonly'=>'readonly')); ?>
              <label class="label_text">Estado</label>
              <?php echo $this->Form->input('estado', array('class'=>'textbox_1 estado-direccion', 'label'=>false, 'readonly'=>'readonly')); ?>
            </div>
          </div>
          <div class="btnbox"><a href="#agregar_direccion" class="submit_1 guardar_datos" style="padding:10px; line-height: 35px;" data-formulario="datos_direccion">Guardar</a></div>
        </div>
        <?php echo $this->Form->end() ?>
      </div>
      <?php foreach ($direcciones as $direccion) { ?>
      <div id="editar_direccion_<?php echo $direccion->id; ?>" class="edit_direccion"style="display:none;">
        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'editDireccion'], 'id'=>'datos_direccion'.$direccion->id]); ?>
        <div class="title_2">
          <h3>
            Editar Dirección 
            <spam class="arc_red">(Todos los datos con * son requeridos)</spam>
          </h3>
        </div>
        <div class="block_1 nobg">
          <div class="row" style="margin-top:20px;">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <?php echo $this->Form->input('id', array('class'=>'textbox_1', 'label'=>false, 'type'=>'hidden', 'value'=>$direccion->id)); ?>
              <label class="label_text">Calle <span class="arc_red">*</span></label>
              <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$direccion->calle)); ?>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">No. Exterior <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>  false, 'value'=>$direccion->numero_exterior)); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">No. Interior</label>
                  <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>  false, 'value'=>$direccion->numero_interior)); ?>
                </div>
              </div>
              <label class="label_text">Entre Calles</label>
              <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1', 'label'=>false, 'value'=>$direccion->entre_calles)); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <label class="label_text">Colonia <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$direccion->colonia)); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="position:relative;">
                  <label class="label_text">C&oacute;digo Postal <span class="arc_red">*</span></label>
                  <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 requerido codigo-postal-direccion codigo-postal-'.$direccion->id, 'label'=>false, 'value'=>$direccion->codigo_postal, 'data-tag'=>$direccion->id)); ?>
                  <a href="#direcciones" class="editar_codigo_postal" data-tag="<?php echo $direccion->id ?>"><i class="fa fa-refresh"></i></a>
                </div>
              </div>
              <label class="label_text">Ciudad</label>
              <?php echo $this->Form->input('ciudad', array('class'=>'textbox_1 ciudad-'.$direccion->id, 'label'=>false, 'value'=>$direccion->ciudad, 'readonly'=>'readonly')); ?>
              <label class="label_text">Estado</label>
              <?php echo $this->Form->input('estado', array('class'=>'textbox_1 estado-'.$direccion->id, 'label'=>false, 'value'=>$direccion->estado, 'readonly'=>'readonly')); ?>
            </div>
          </div>
          <div class="btnbox"><a href="#agregar_direccion" class="submit_1 guardar_datos" style="padding:10px; line-height: 35px;" data-formulario="datos_direccion<?php echo $direccion->id; ?>">Guardar</a>
            <a href="/myprofile" class="submit_1" style="padding:10px; line-height: 35px;">Cancelar</a>
          </div>
        </div>
        <?php echo $this->Form->end() ?>
      </div>
      <?php } ?>
      <?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'editProfile'], 'id'=>'datos_fiscales']); ?>
      <div class="title_2" id="direccion_fiscal">
        <h3>
          Mis Datos Fiscales 
          <spam class="arc_red">(Todos los datos con * son requeridos)</spam>
        </h3>
        <p></p>
      </div>
      <div class="block_1 nobg">
        <div class="row" style="margin-top:20px;">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <label class="label_text">RFC <span class="arc_red">*</span></label>
            <?php echo $this->Form->input('rfc', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['rfc'])); ?>
            <label class="label_text">Raz&oacute;n Social <span class="arc_red">*</span></label>
            <?php echo $this->Form->input('razon_social', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['razon_social'])); ?>
            <label class="label_text">Calle <span class="arc_red">*</span></label>
            <?php echo $this->Form->input('calle', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['calle'])); ?>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">No. Exterior <span class="arc_red">*</span></label>
                <?php echo $this->Form->input('numero_exterior', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['numero_exterior'])); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">No. Interior</label>
                <?php echo $this->Form->input('numero_interior', array('class'=>'textbox_1', 'label'=>false, 'value'=>$user['numero_interior'])); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="label_text">Entre Calles</label>
                <?php echo $this->Form->input('entre_calles', array('class'=>'textbox_1', 'label'=>false, 'value'=>$user['entre_calles'])); ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="position:relative;">
                    <label class="label_text">C&oacute;digo Postal <span class="arc_red">*</span></label>
                    <?php echo $this->Form->input('codigo_postal', array('class'=>'textbox_1 requerido codigo-postal-direccion codigo-postal-fiscal', 'label'=>false, 'value'=>$user['codigo_postal'], 'data-tag'=>'fiscal')); ?>
                    <a href="#direccion_fiscal" class="editar_codigo_postal" data-tag="fiscal"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
            <label class="label_text">Colonia <span class="arc_red">*</span></label>
            <?php echo $this->Form->input('colonia', array('class'=>'textbox_1 requerido', 'label'=>false, 'value'=>$user['colonia'])); ?>
            <label class="label_text">Ciudad</label>
            <?php echo $this->Form->input('ciudad', array('class'=>'textbox_1 ciudad-fiscal', 'label'=>false, 'value'=>$user['ciudad'], 'readonly'=>'readonly')); ?>
            <label class="label_text">Estado</label>
            <?php echo $this->Form->input('estado', array('class'=>'textbox_1 estado-fiscal', 'label'=>false, 'value'=>$user['estado'], 'readonly'=>'readonly')); ?>
          </div>
        </div>
        <div class="btnbox"><a href="#direccion_fiscal" class="submit_1 guardar_datos" style="padding:10px; line-height: 35px;" data-formulario="datos_fiscales">Guardar</a></div>
      </div>
      <?php echo $this->Form->end() ?>
      <div class="title_2">
        <h3>Mis Pedidos</h3>
        <p></p>
      </div>
      <div class="block_3">
        <div class="table-responsive">
          <table cellpadding="0" cellspacing="0" border="0" class="table_1">
            <thead>
              <tr>
                <th width="20%">N&uacute;mero de Orden</th>
                <th width="20%">Fecha</th>
                <th width="20%">Estatus</th>
                <th width="20%">Total</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pedidos as $pedido) { ?>
              <tr>
                <td>#<?php echo $pedido->id; ?></td>
                <td><?php echo $pedido->fecha; ?></td>
                <td><?php echo $pedido->estatus->nombre; ?></td>
                <td>$ <?php echo number_format($pedido->monto,2); ?> MXN</td>
                <td><?php echo $this->Html->Link('Ver', "/myorder/".$pedido->id,  ["escape" => false]) ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).on({click: function(e){
      var _this = $(this);
  
      var codigo_postal = $('.codigo-postal-'+_this.data('tag')).val();
          
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
                  $.ajax({
      
                      type: 'POST',
                      url: '/productos/codigo_postal_fiscal',
                      data: {
                          codigo_postal:codigo_postal
                      },
                      dataType: 'json',
                      success: function(data){
  
  
                          if(data.codigo != null){
  
                                  $('.ciudad-'+_this.data('tag')).val(data.ciudad);
                                  $('.estado-'+_this.data('tag')).val(data.estado);
                            
  
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
  
   }}, '.editar_codigo_postal');
  
  
  $(document).on({change: function(e){
      var _this = $(this);
  
      var codigo_postal = $('.codigo-postal-'+_this.data('tag')).val();
          
  
      if (codigo_postal != '' && codigo_postal != 0)
      {
                  $.ajax({
      
                      type: 'POST',
                      url: '/productos/codigo_postal_fiscal',
                      data: {
                          codigo_postal:codigo_postal
                      },
                      dataType: 'json',
                      success: function(data){
  
  
                          if(data.codigo != null){
  
                                  $('.ciudad-'+_this.data('tag')).val(data.ciudad);
                                  $('.estado-'+_this.data('tag')).val(data.estado);
                            
  
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
  
   }}, '.codigo-postal-direccion');
  
  $(document).on({click: function(e){
         
          var _this = $(this);
  
          $('.edit_direccion').css('display', 'none');
  
          $('#agregar_direccion').css('display', 'none');
          $('#'+_this.data('tag')).css('display', 'block');
         
  }}, '.editar-direccion');
  
  
  $('#estado-id').change(function(){
          var selected = $(this).val();
          //$.ajax({url:'/mensajes/listMensajes', dataType: 'json', success: function(result){
          $.ajax({
  
              type: 'POST',
              url: '/productos/busqueda_municipio',
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
  
  $('.requerido').keyup(function(){
  
              if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
              }else{
  
                  $(this).removeClass('obligatorio');
  
              }
  
  });
  
  $('.guardar_datos').click(function(){
  
      
      var valido = 1;
      $("#"+$(this).data('formulario')).find('.requerido').each(function() {
          
          if($(this).val() == ''){
  
                  $(this).addClass('obligatorio');
                  valido = 0;
  
          }else{
  
                  $(this).removeClass('obligatorio');
  
          }
  
      });
  
      if(valido == 1){
  
          $( "#"+$(this).data('formulario') ).submit();
  
      }else{
          alert('Todos los datos con * son requeridos')
      }
  
  });
  
</script>
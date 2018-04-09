<div id="content">
  <div class="container">
    <div id="carrito_1">
      <div class="row carrito-title-resumen">
        <div class="col-xs-12">
          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span><?= __('Resumen de Compra') ?></span>
        </div>
      </div>

      <!--<div class="row carrito-titles">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <h5><?= __('Detalle de Producto') ?></h5>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <h5><?= __('Precio') ?></h5>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <h5><?= __('Cantidad') ?></h5>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <h5><?= __('Total') ?></h5>
        </div>
      </div>-->

      <?php foreach ($carrito as $key => $producto) { ?>
      <table class="cartDetail">
        <tbody>
          <tr>
          <th></th>
          <th><h5><?= __('Detalle de Producto') ?></h5></th>
          <th><h5><?= __('Cantidad') ?></h5></th>
          <th><h5><?= __('Precio') ?></h5></th>
          <th><h5><?= __('Total') ?></h5></th>
          <th></th>
          </tr>
          <tr>
          <td>
            <?php if(isset($producto['imagenes'][0])) { ?>
            <img src="/img/productos/original/<?php echo $producto['imagenes'][0]['nombre']; ?>">
            <?php } ?>
          </td>
          <td><p><?= $producto['nombre'] ?></p></td>
          <td>
          <?= $this->Form->input('cantidad', [
            'type' => 'select',
            'label' => false,
            'div' => false,
            'options' => [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10],
            'class' => 'select-simple cantidad',
            'style' => 'margin-bottom: 0px;',
            'value' => $producto['cantidad'],
            'data-posicion' => $key
            ]); ?> 
          </td>
          <td>
            <p>
              $<?= number_format((($currency==1)? $producto['precio'] : $producto['precio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </p>
          </td>
          <td>
            <p>
            $<?= number_format((($currency==1)? $producto['precio'] * $producto['cantidad'] : $producto['precio'] / $tipocambio * $producto['cantidad']), 2) ?> <?= $monedas[$currency] ?>
            </p>
          </td>
          <td>
            <div class="carrito-eliminar" data-posicion="<?= $key ?>">
              <?= __('Eliminar') ?>
            </div>
          </td>
          </tr>
        </tbody>
      </table>
      <hr>
      <div class="caDetail">
        <h4>¿Requiere factura?</h4>
        <div class="caSplit">
          <section>
            <label for="factura1">
              <span>Si</span>
              <input id="factura1" type="radio" name="factura" value="1">
            </label>
          </section>
          <section>
            <label for="factura2">
              <span>No</span>
              <input id="factura2" type="radio" name="factura" value="0" checked="checked">
            </label>
          </section>
        </div>
        <h4>Detalle de Envío</h4>
        <div class="caSplit">
          <section>
            <h6>Fecha de Envío</h6><?= date('d-m-Y', strtotime($detalle_envio['fecha'])) ?>
          </section>
          <section>
            <h6>Horario</h6><?= $detalle_envio['horario_text'] ?> <span class="carrito-editar-fecha">Cambiar</span>
          </section>
        </div>



        <h4>Código de promoción</h4>
          <div class="caSplit">
            <section>
              <?php if(!isset($resumen['cupon_detalles'])){ ?>
                <div>
                  <?= $this->Form->input('codigo_promocion', [
                    'type' => 'text',
                    //'maxlength' => '5',
                    'label' => false,
                    'div' => false,
                    'class' => 'input-simple',
                    'placeholder' => __('Inserte el código'),
                    'style' => 'padding: 0px;'
                    ]); ?> 
                </div>
            </section>
            <section>
              <span class="carrito-codigo-promocion" id="btn_guarda_cupon">Aplicar</span>
              <?php }else{ ?>
                <?= $resumen['cupon_detalles']['codigo'] ?>
              <?php } ?>
            </section>
          </div>
        
      </div>
      <div class="caTotales">
          <div class="caSplit">
            <section>
              Subtotal
            </section>
            <section>
              $<?= number_format((($currency==1)? $resumen['subtotal'] : $resumen['subtotal'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </section>
          </div>

          <div class="caSplit">
            <section>
              Cupon
            </section>
            <section>
              $<?= number_format((($currency==1)? $resumen['cupon'] : $resumen['cupon'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </section>
          </div>

          <div class="caSplit">
            <section>
              Puntos
            </section>
            <section>
              $<?= number_format((($currency==1)? $resumen['puntos'] : $resumen['puntos'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </section>
          </div>

          <div class="caSplit">
            <section>
              Envío (<?= $ciudad['nombre'] ?>)
            </section>
            <section>
              $<?= number_format((($currency==1)? $resumen['envio'] : $resumen['envio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </section>
          </div>

          <div class="caSplit">
            <section>
              Total
            </section>
            <section>
              $<?= number_format((($currency==1)? $resumen['total'] : $resumen['total'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </section>
          </div>
        </div>
         
              

              <!--<div class="row carrito-detalle-producto">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="text-align:center;">  
                    <?php if(isset($producto['imagenes'][0])) { ?>
                    <img src="/img/productos/original/<?php echo $producto['imagenes'][0]['nombre']; ?>">
                    <?php } ?>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 carrito-detalle">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= $producto['nombre'] ?></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?= $producto['sku'] ?></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="carrito-eliminar" data-posicion="<?= $key ?>"><i class="fa fa-times" aria-hidden="true"></i> <?= __('Eliminar') ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 carrito-detalle">
                  $<?= number_format((($currency==1)? $producto['precio'] : $producto['precio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <?= $this->Form->input('cantidad', [
                    'type' => 'select',
                    'label' => false,
                    'div' => false,
                    'options' => [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10],
                    'class' => 'select-simple cantidad',
                    'style' => 'margin-bottom: 0px;',
                    'value' => $producto['cantidad'],
                    'data-posicion' => $key
                    ]); ?> 
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 carrito-detalle">
                  $<?= number_format((($currency==1)? $producto['precio'] * $producto['cantidad'] : $producto['precio'] / $tipocambio * $producto['cantidad']), 2) ?> <?= $monedas[$currency] ?>
                </div>
              </div>
      <?php } ?>
      <div class="row carrito-detalle-producto">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carrito-resumen-title">
              Detalle de Envío
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 carrito-info">
              <label class="carrito-label">Fecha de Envío</label><?= date('d-m-Y', strtotime($detalle_envio['fecha'])) ?>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 carrito-info">
              <label class="carrito-label">Horario</label><?= $detalle_envio['horario_text'] ?> <span class="carrito-editar-fecha">Cambiar</span>
            </div>
          </div>
          <div class="row" style="margin-top:10px;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carrito-resumen-title">
              Código de Promoción
            </div>
            <?php if(!isset($resumen['cupon_detalles'])){ ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 carrito-info">
              <?= $this->Form->input('codigo_promocion', [
                'type' => 'text',
                //'maxlength' => '5',
                'label' => false,
                'div' => false,
                'class' => 'input-simple',
                'placeholder' => __('Inserte el código'),
                'style' => 'padding: 0px;'
                ]); ?> 
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 carrito-info" style="padding-top: 10px;">
              <span class="carrito-codigo-promocion" id="btn_guarda_cupon">Aplicar</span>
            </div>
            <?php }else{ ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 carrito-info" style="margin-top: 10px;">
              <?= $resumen['cupon_detalles']['codigo'] ?>
            </div>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 carrito-resumen-title">
              ¿Requiere factura?
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 carrito-info">
              <div class="divradio">
                <input id="factura1" type="radio" name="factura" value="1"><label for="factura1"><span><span></span></span>Si</label>
              </div>
              <div class="divradio">
                <input id="factura2" type="radio" name="factura" value="0" checked="checked"><label for="factura2"><span><span></span></span>No</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="row">
            <div class="col-xs-6 carrito-info carrito-resumen" style="padding-top: 18px;">
              Subtotal
            </div>
            <div class="col-xs-6 carrito-info  carrito-resumen" style="padding-top: 18px;">
              $<?= number_format((($currency==1)? $resumen['subtotal'] : $resumen['subtotal'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 carrito-info carrito-resumen" style="padding-top: 18px;">
              Cupon
            </div>
            <div class="col-xs-6 carrito-info  carrito-resumen" style="padding-top: 18px;">
              $<?= number_format((($currency==1)? $resumen['cupon'] : $resumen['cupon'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 carrito-info carrito-resumen" style="padding-top: 18px;">
              Puntos
            </div>
            <div class="col-xs-6 carrito-info  carrito-resumen" style="padding-top: 18px;">
              $<?= number_format((($currency==1)? $resumen['puntos'] : $resumen['puntos'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 carrito-info carrito-resumen" style="padding-top: 18px;">
              Envío (<?= $ciudad['nombre'] ?>)
            </div>
            <div class="col-xs-6 carrito-info  carrito-resumen" style="padding-top: 18px;">
              $<?= number_format((($currency==1)? $resumen['envio'] : $resumen['envio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 carrito-info carrito-resumen" style="padding-top: 18px;">
              Total
            </div>
            <div class="col-xs-6 carrito-info  carrito-resumen" style="padding-top: 18px;">
              $<?= number_format((($currency==1)? $resumen['total'] : $resumen['total'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
            </div>
          </div>
        </div>
      </div>-->
      <div class="row" style="clear:both;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <button class="carrito-regresar"> 
          <?=__('Regresar')?> 
          </button>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php if($this->UserAuth->isLogged()) { ?>
          <div class="col-xs-12"><a href="/pedido/<?= $ciudad->url ?>/envioypago" class="hacer-pedido"><?=__('Hacer Pedido')?> </a></div>
          <?php } else{ ?>
          <div class="col-xs-12"><a href="/pedido/<?= $ciudad->url ?>/inicio" class="hacer-pedido"><?=__('Hacer Pedido')?> </a></div>
          <?php  } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var aplicaCupon = function() {
  
      var cupon = $('#codigo-promocion').val();
      var ciudadUrl = '<?= $ciudad_url ?>';
  
      if (cupon != ''){
          $.ajax({
  
              type: 'POST',
              url: '<?php echo $this->Url->build(["action" => "cupon"]); ?>',
              data: {
                  cupon:cupon,
                  ciudadUrl:ciudadUrl
              },
              dataType: 'json',
              success: function(data){
                  if (data == 1)
                  {
                      location.reload(true);
                  }else{
                      alert('Lo sentimos, tu código de promoción no es valido');
                      $('#codigo-promocion').val('');
                  }
                  
              }
          })
      }else{
          alert('Ingrese un código de promoción valido');
          $('#codigo-promocion').val('');
      }
  }
  
  $('#btn_guarda_cupon').click(function(){
      aplicaCupon();
  });
  
  
  $(document).on({change: function(e){
      //e.preventDefault();
      var _this = $(this);
      var accion = 'editar_articulo';
      var posicion = _this.data('posicion');
      var cantidad = _this.val();
      
  
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "editar_carrito", $ciudad->url]); ?>',
          data: {
              accion:accion,
              posicion:posicion, 
              cantidad:cantidad
          },
          dataType: 'json',
          success: function(data){
              location.reload(true);
          }
      })
  
  }}, '.cantidad');
  
  $(document).on({click: function(e){
      //e.preventDefault();
      var _this = $(this);
      var accion = 'eliminar_articulo';
      var posicion = _this.data('posicion');
  
      $.ajax({
  
          type: 'POST',
          url: '<?php echo $this->Url->build(["action" => "editar_carrito", $ciudad->url]); ?>',
          data: {
              accion:accion,
              posicion:posicion
          },
          dataType: 'json',
          success: function(data){
              location.reload(true);
          }
      })
  
  }}, '.carrito-eliminar');
   
  
</script>
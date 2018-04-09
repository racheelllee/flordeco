<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>
  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso">
      <span class="detalle-pedido-circulo">1</span><br><?= __('Inicio') ?>
    </div>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso">
      <span class="detalle-pedido-circulo">2</span><br><?= __('Envío y Pago') ?>
    </div>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2  col-xs-4">
    <div class="detalle-pedido-paso active_pedido">
      <span class="detalle-pedido-circulo">3</span><br><?= __('Confirmación') ?>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3  col-xs-12"></div>
</div>
<div class="row carrito-title-resumen" style="margin-top:30px;">
  <div class="col-xs-12">
    <i class="fa fa-cart-arrow-down iconos-barra-title" aria-hidden="true"></i> <span style="margin-left:40px;"><?= __('Resumen de Compra') ?></span>
  </div>
</div>
<br>
<table class="cartDetail">
  <tbody>
    <tr>
      <th></th>
      <th>
        <h5><?= __('Detalle de Producto') ?></h5>
      </th>
      <th>
        <h5><?= __('Cantidad') ?></h5>
      </th>
      <th>
        <h5><?= __('Precio') ?></h5>
      </th>
      <th>
        <h5><?= __('Total') ?></h5>
      </th>
    </tr>
    <?php foreach ($carrito as $key => $producto) { ?>
    <tr>
      <td>
        <?php if(isset($producto['imagenes'][0])) { ?>
        <img src="/img/productos/original/<?php echo $producto['imagenes'][0]['nombre']; ?>">
        <?php } ?>
      </td>
      <td>
        <p><?= $producto['nombre'] ?></p>
      </td>
      <td style="text-align:center;">
        <?= $producto['cantidad']; ?> 
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
    </tr>
    <?php } ?>
  </tbody>
</table>
<hr>
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
<!--<div class="row carrito-titles">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= __('Detalle de Producto') ?>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <?= __('Precio') ?>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <?= __('Cantidad') ?>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <?= __('Total') ?>
  </div>
  </div>-->
<!--
  <div class="row carrito-detalle-producto">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="text-align:center;">  
        <?php if(isset($producto['imagenes'][0])) { ?>
        <img src="/img/productos/original/<?php echo $producto['imagenes'][0]['nombre']; ?>" alt="">
        <?php } ?>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 carrito-detalle" style="padding-top:40px;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= $producto['nombre'] ?></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= $producto['sku'] ?></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= (isset($producto['mensaje_personalizado']) && $producto['mensaje_personalizado'] != 'false')? $producto['mensaje_personalizado'] : '' ?></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 carrito-detalle" style="padding-top: 55px; font-size: 20px;">
      $<?= number_format((($currency==1)? $producto['precio'] : $producto['precio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 carrito-detalle" style="padding-top: 55px; font-size: 20px;">
      <?= $producto['cantidad']; ?> 
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 carrito-detalle" style="padding-top: 55px; font-size: 20px; text-align: right;">
      $<?= number_format((($currency==1)? $producto['precio'] * $producto['cantidad'] : $producto['precio'] / $tipocambio * $producto['cantidad']), 2) ?> <?= $monedas[$currency] ?>
    </div>
  </div>
  
  <div class="row carrito-detalle-producto">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="row">
        <div class="col-xs-6 carrito-info carrito-resumen">
          Subtotal
        </div>
        <div class="col-xs-6 carrito-info  carrito-resumen">
          $<?= number_format((($currency==1)? $resumen['subtotal'] : $resumen['subtotal'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 carrito-info carrito-resumen">
          Cupon
        </div>
        <div class="col-xs-6 carrito-info  carrito-resumen">
          $<?= number_format((($currency==1)? $resumen['cupon'] : $resumen['cupon'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 carrito-info carrito-resumen">
          Puntos
        </div>
        <div class="col-xs-6 carrito-info  carrito-resumen">
          $<?= number_format((($currency==1)? $resumen['puntos'] : $resumen['puntos'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 carrito-info carrito-resumen">
          Envío (<?= $ciudad['nombre'] ?>)
        </div>
        <div class="col-xs-6 carrito-info  carrito-resumen">
          $<?= number_format((($currency==1)? $resumen['envio'] : $resumen['envio'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 carrito-info carrito-resumen">
          Total
        </div>
        <div class="col-xs-6 carrito-info  carrito-resumen">
          $<?= number_format((($currency==1)? $resumen['total'] : $resumen['total'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
        </div>
      </div>
    </div>
  </div>-->
<div class="row">
  <div class="col-xs-12 envioypago-zonahoraria">
    <?= __('Hora Local de') ?> <?= $ciudad->nombre ?> <span class="reloj-zona-horaria"></span>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h5 class="envioypago-title">Datos del Envío</h5>

    <div class="col-xs-6 label-datos-confirmacion">
      Nombre:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="nombre_destinatario"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Télefono:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="telefono_destinatario"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Fecha de Envío:
    </div>
    <div class="col-xs-6 dato-confirmacion">
      <?= (!empty($detalle_envio['fecha']))? date('d-m-Y', strtotime($detalle_envio['fecha'])) : __('No definido') ?>
    </div>

    <div class="col-xs-6 label-datos-confirmacion">
      Horario de Entrega:
    </div>
    <div class="col-xs-6 dato-confirmacion">
      <?= (!empty($detalle_envio['horario_text']))? $detalle_envio['horario_text'] : __('No definido') ?> 
    </div>

    <div class="col-xs-6 label-datos-confirmacion">
      Mensaje de la Tarjeta:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="mensaje_tarjeta"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Firma:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="firma"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Es Arreglo Funeral:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="arreglo_funeral"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Recordatorio:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="recordatorio"></div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h5 class="envioypago-title">Dirección de Envío</h5>

    <div class="col-xs-6 label-datos-confirmacion">
      Dirección:
    </div>
    <div class="col-xs-6 dato-confirmacion">
      <span data-datatext="calle"></span> #<span data-datatext="numero_exterior"></span>, <span data-datatext="colonia"></span>, C.P.<span data-datatext="codigo_postal"></span>
    </div>

    <div class="col-xs-6 label-datos-confirmacion">
      Ciudad:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="ciudad"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Estado:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="estado"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Pais:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="pais"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Tipo de Domicilio:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="direccion_tipo_id"></div>

    <div class="col-xs-6 label-datos-confirmacion">
      Referencias de Envío:
    </div>
    <div class="col-xs-6 dato-confirmacion" data-datatext="referencias_direccion"></div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h5 class="envioypago-title">Forma de Pago</h5>
      <div class="label-datos-confirmacion" data-datatext="forma_pago"></div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h5 class="envioypago-title">Generar Factura</h5>
    </span> <span class="dato-confirmacion">El pedido tendrá un límite de </span> <span class="label-datos-confirmacion">21 días </span> <span class="dato-confirmacion">en el sistema para generar su factura a partir de que </span> <span class="label-datos-confirmacion">se autorice el pago. </span>
  </div>
</div>

<div class="row">
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <button class="carrito-regresar navegacion-pedido" data-next="envio_y_pago" type="button"> <?=__('Regresar')?> </button>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <button class="hacer-pedido" id="btn-finalizar"> <?=__('Confirmar Pedido')?> </button>
    <input type="hidden" name="paypal" id="paypal-data">
    <div id="paypal-button-container" style="margin-top: 25px; margin-left: 55px; display:none;"></div>
  </div>
</div>
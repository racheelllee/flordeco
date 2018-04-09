<p>
  Número de orden: <strong><?= $pedido->id ?></strong><br><br>

  <strong>Información del Producto</strong><br><br>
  <p><table>
    <tr>
      <td><?= __('Detalle de Producto') ?></td>
      <td><?= __('Precio') ?></td>
      <td><?= __('Cantidad') ?></td>
      <td><?= __('Total') ?></td>
    </tr>
    <?php foreach ($pedido->partidas as $partida) { ?>
      <tr>
        <td><?= $partida->sku.' '.$partida->producto.'<br>'.$partida->mensaje_personalizado ?></td>
        <td>$<?= number_format($partida->precio,2) ?></td>
        <td><?= $partida->cantidad ?></td>
        <td>$<?= number_format($partida->precio * $partida->cantidad,2) ?></td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="3" align="right">Subtotal</td>
      <td>$<?= number_format($pedido->subtotal,2) ?></td>
    </tr>
    <tr>
      <td colspan="3" align="right">Envío (<?= $pedido->zona->nombre ?>)</td>
      <td>$<?= number_format($pedido->envio,2) ?></td>
    </tr>
    <tr>
      <td colspan="3" align="right">Total</td>
      <td>$<?= number_format($pedido->monto,2) ?></td>
    </tr>
  </table></p>

  <p>
  <strong>Datos del Cliente</strong><br>
  Nombre: <strong><?= $pedido->nombre_cliente ?></strong><br>
  Correo: <strong><?= $pedido->correo_electronico ?></strong><br><br>

  <strong>Datos Destinatario</strong><br>
  Nombre: <strong><?= $pedido->nombre_destinatario ?></strong><br>
  Telefono: <strong><?= $pedido->telefono_destinatario ?></strong><br>
  Dirección: <strong><?= $pedido->calle.' #'.$pedido->numero_exterior.', CP. '.$pedido->codigo_postal.', Col '.$pedido->colonia.', Ciudad '.$pedido->ciudad.', Estado '.$pedido->estado.', País '.$pedido->pais ?></strong><br>
  Referencia: <strong><?= $pedido->referencias_direccion ?></strong><br><br>

  <strong>Datos de Envío</strong><br>
  Fecha: <strong><?= $pedido->fecha_entrega->format('d-m-Y') ?></strong><br>
  Horario: <strong><?= $pedido->horario_entrega ?></strong><br><br>


  Mensaje en la Tarjeta: <strong><?= $pedido->mensaje_tarjeta ?></strong><br>
  Firma: <strong><?= $pedido->firma ?></strong><br><br>

  Forma de Pago: <strong><?= $pedido->formasdepago->nombre ?></strong><br>
  </p>
  <p>
  <strong>Importante:</strong><br><i>
  ● Si seleccionaste la opción “Pedido Anonimo” o no tiene firma la tarjeta, no te preocupes nosotros cuidaremos de mantenerlo secreto.<br>
  ● Si a tu pedido agregaste un comentario lo tomaremos en cuenta. <br>
  ● Si quieres hacer algún cambio a tu pedido comunicate con nosotros a los teléfonos de Flordeco</i>
  </p>
</p>
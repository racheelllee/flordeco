<h2> <?= $pedido->nombre_cliente ?> </h2>
<h3><span class="gris">Flordeco agradece tu compra</span></h3>
<h3><span class="gris">Tu número de orden es:</span> <?= $pedido->id ?> </h3>
<p>
Actualmente tu orden está en estatus de: <strong class="morado"> <?= $pedido->estatus->nombre ?> </strong> <br>
La forma de pago escogida es: <strong class="morado">  <?= $pedido->formasdepago->nombre ?> </strong> <br>
El total a pagar es: <strong class="morado"> $<?= number_format($pedido->monto,2) ?> </strong>
</p>
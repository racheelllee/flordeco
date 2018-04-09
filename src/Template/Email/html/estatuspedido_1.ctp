<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php $URL=$this->Url->build('/', true); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?= $this->fetch('title') ?></title>

    <style type="text/css">

    	table {
		    border-collapse: collapse;
		    width: 100%;
		}

		table, th, td {
		    border: 1px solid black;
		    color: #444 !important;
		    font-size: 10px !important;
		    font-family: sans-serif !important;
		    padding: 2px !important;
		}

		p{
			font-size: 10px !important;
			font-family: sans-serif !important;
			color: #444 !important;
		}

		h2{
			color: #9b2b97 !important;
			font-family: sans-serif !important;
		}

		h3{
			font-size: 14px !important;
			color: #9b2b97 !important;
			font-family: sans-serif !important;
		}

		h4{
			font-size: 11px !important;
			color: #9c2a98 !important;
			font-family: sans-serif !important;
			background-color: #f9c569 !important;
			padding: 2px !important;
		}

		.gris{
			color: #444 !important;
		}
		.morado{
			color: #9b2b97 !important;
		}

	</style>
</head>

<body>


	<img src="<?php echo $URL?>email/header-pendiente.png" style="width:100%;">

	<?= $this->element('email_estatus_pedido/info_general', ['pedido'=>$pedido]) ?>

	<?= $respuesta ?>

	<?php if($pedido->forma_pago_id == '5'){ ?>

		<p><strong>Para continuar con tu proceso de pago te pedimos hagas lo siguiente:</strong></p>

		<h3>1.- Realiza tu pago</h3>
		<p>
		Para <strong>Deposito Bancario</strong>: Acude a hacer tu pago al banco <br>
		NOTA:Incluye tu número de orden en la referencia del deposito, solo indicarle esto al cajero en ventanilla
		</p>
		<p>
		Para <strong>Transferencia Electrónica</strong>: En tu banca por internet realiza tu pago<br>
		NOTA Incluye el número de pedido como referencia de pago
		</p>
		<p>
		Consulta las cuentas para depósito <a href="<?php echo $URL?>"><strong>AQUI</strong></a>
		</p>

		<h3>2.- Confirma tu pago</h3>
		<p>Reporta tu pago a este link <a href="<?php echo $URL?>reportarpago"><strong><?php echo $URL?>reportarpago</strong></a></p>

		<p>Una vez reportado tu pago te confirmaremos en el transcurso del dia.</p>

		<h3>3.- Recibe tu confirmación de pago</h3>
		<p>Espera a que te la enviemos por correo y tu estado en el detalle de tu pedido cambiará a CONFIRMADO</p>
	<?php } ?>

	<img src="<?php echo $URL?>email/body-1.png" style="width:100%;">


	<!-- IMPORTANTE -->

	<h3 style="color:red;">MUY IMPORTANTE</h3>

	<h4>Si tu pedido es para HOY</h4>
	<p>
	Si escogiste:<br>
	<strong>- El rango de 12:00pm a 4:00pm</strong><br>
	        Tu reporte de pago debe estar confirmado ANTES de las 10:30am del mismo dia<br>

	<strong>- El rango de 4:00pm a 7:00pm</strong><br>
	        Tu reporte de pago debe estar confirmado ANTES de las 2:30pm del mismo dia<br>
	</p>


	<h4>Si tu pedido es para MAÑANA</h4>
	<p>
	Si escogiste:<br>
	<strong>- El rango de 8:00am a 12:00pm</strong><br>
	Tu reporte de pago DEBERA estar confirmado HOY antes de las 6:00pm
	</p>

	<h4>Si tu pedido es para el SABADO</h4>
	<p>
	Tu reporte de pago DEBERA estar confirmado el VIERNES antes de las 5:00pm
	</p>

	<h4>Si tu pedido es para el DOMINGO</h4>
	<p>
	Tu reporte de pago DEBERÁ estar confirmado el SÁBADO antes de las 10:30am
	</p>
	<p><strong>
	Te recordamos que para otras fechas cuentas con 24hrs para realizar el pago, de otra manera el tu orden sera cancelada
	</strong></p>


	<!-- ARREGLO FUNERARIO -->
	<?php if($pedido->arreglo_funeral){ ?>
		<h4>Para la entrega de tu arreglo funeral es importante que nos respondas las siguientes preguntas.</h4>

		<p>
		<strong>1.- ¿El nombre de quien se entrega el presente funerario (destinatario) es la persona finada?</strong><br>
		Si la respuesta es NO te pedimos que nos envíes el nombre de la persona finada a la cuenta ventas@flordeco.com<br><br>

		<strong>2.- ¿Si el envio es para funeraria, la fecha de entrega coincide con el inicio del servicio funeral?</strong><br>

		Si la respuesta es NO te pedimos te comuniques a los teléfonos de FLORDECO para   verificar la posibilidad de entrega de tu presente. Si no sabes la respuesta nosotros podemos verificar esto por ti, pero es probable que tu envío no se entregue en el dia pedido y tendremos que ajustarlo.
		</p>
	<?php } ?>

	<h3>REVISA AQUI LA INFORMACIÓN DE TU PEDIDO</h3>
	<?= $this->element('email_estatus_pedido/info_pedido', ['pedido'=>$pedido]) ?>
	<br>
	<p align="center">
	<strong class="morado">¡ Muchas gracias por preferirnos !</strong><br><br>

	<strong class="morado">Flordeco Florerias</strong>
	</p>
	<br>
	<img src="<?php echo $URL?>email/footer-correo.png" style="width:100%;">

</body>
</html>


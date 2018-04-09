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


	<img src="<?php echo $URL?>email/header-confirmado.png" style="width:100%;">

	<?= $this->element('email_estatus_pedido/info_general', ['pedido'=>$pedido]) ?>

	<h3>¿Que sigue?</h3>

	<p>Esperar la fecha de entrega de tu regalo. El dia de entrega te avisaremos por este medio el cambio de estatus de tu regalo, hasta notificarte las buenas noticias con la entrega final!</p>


	<img src="<?php echo $URL?>email/body-3.png" style="width:100%;">

	<p>Con gusto cualquier duda que tengas las puedes hacer llegar en el detalle de tu pedido, por la pagina web, por correo o a los tels de Flordeco. Procura siempre mencionar tu numero de pedido para darte un mejor servicio.</p>

	<p><strong>Recuerda que por seguridad de tus datos</strong> si llama alguien en tu nombre es OBLIGATORIO mencionarnos el numero de pedido ya que de otra manera no podremos darle información.</p>


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


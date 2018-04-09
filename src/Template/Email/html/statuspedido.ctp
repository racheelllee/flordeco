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
?><center><img src="<?php echo FRONT_WWW; ?>/img/logo.png"></center>
<div style="height: 40px; width: 100%; color: #ffffff; background-color: #24a9a4; padding-top:15px; padding-left:10px;font-family: Helvetica,Arial,sans-serif; font-size: 18px; ">¡Gracias por tu compra!</div>

<div style="width: 100%; text-align: center; margin-top: -10px;  font-size: 20px; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;"><table width="220" height="100" style="background-color: #014272;  border-style: solid; border-color: #ffffff; color: #ffffff; margin-right: 18px;" align="right"><tr><td >STATUS:<br> <b><?=$status ?></b></td></tr></table></div>

<table width="100%" style=" font-size: 16px;"><tr><td>
Cliente: <b style="color: #46A5A2;"><?=$pedido->nombre_cliente ?></b><br>
Núm. de Cliente:  <b style="color: #e26a0a;"><?=$pedido->cliente_id ?></b>
</td><td>
PEDIDO: <b style="color: #46A5A2;"><?=$pedido->id ?></b><br> <?=$pedido->fecha ?></td></tr></table>


<br>
	<p  style="font-size:14px;">Hola <?=$pedido->nombre_cliente ?>,</p>

<p  style="font-size:14px;"><?=$texto ?></p>


<p>Si deseas revisar los datos de tu pedido, por favor ingresa a: <a href="<?php echo FRONT_WWW; ?>/"><?php echo FRONT_WWW; ?></a> e inicia sesión.</p>
		
<p>Gracias por elegir <img src="<?php echo FRONT_WWW; ?>/img/logo.png" style="width:70px;padding-top:20px;margin-top:20px;"></p>
<div style="height: 40px; width: 100%; color: #ffffff; background-color: #24a9a4;  font-size:14px;">
  
</div>



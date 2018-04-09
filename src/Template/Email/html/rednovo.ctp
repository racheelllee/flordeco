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
?><center></center>
<div style="height: 40px; width: 100%; color: #ffffff; background-color: #e26a0a; vertical-align:middle; font-family: Helvetica,Arial,sans-serif; font-size: 18px; ">Gracias por tu compra</div>

<div style="width: 100%; text-align: center; margin-top: -10px;  font-size: 20px; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;"><table width="220" height="100" style="background-color: #024272;  border-style: solid; border-color: #ffffff; color: #ffffff; margin-right: 18px;" align="right"><tr><td >STATUS:<br> <b><?=$status ?></b></td></tr></table></div>

<table width="100%" style=" font-size: 16px;"><tr><td>
Cliente: <b style="color: #e26a0a;"><?=$pedido->nombre_cliente ?></b><br>
Núm. de Cliente  :  <b style="color: #e26a0a;"><?=$pedido->cliente_id ?></b>
</td><td>
PEDIDO: <b style="color: #e26a0a;"><?=$pedido->id ?></b><br> <?=$pedido->fecha ?></td></tr></table>


<br>
	<p>Hola <?=$pedido->nombre_cliente ?>,</p>

<p><?=$texto ?></p>



		<div class="line_2"> 
			<span style="font-size:12px;"><br>
			<h4 style="color: #19517d;"><b>Tu compra es de:</b></h4>

			<table style="80%" >
			    <tr>
			        <td align="center" style="padding:5px;"><b>Cantidad</b></td><td align="center" style="padding:5px;"><b>SKU</b></td>
			        <td style="padding:5px;"><b>Titulo</b></td>
			        <td align="center" style="padding:5px;"><b>Precio</b></td>
			    </tr>
			<?php 
		
		foreach ($partidas as $partida): 
		
			?>


 <tr>
                    <td align="center" style="padding:5px;"> <?php echo $partida->cantidad;?></td>
                    <td align="center" style="padding:5px;"> <?php echo $partida->sku;?></td>
                    <td style="padding:5px;"><?php echo $partida->producto;?><br><?php echo $partida->atributos;?></td>
                    <td align="right" style="padding:5px;">$<?php echo number_format($partida->precio/1.16,2); ?></td>

			    
			<?php endforeach; ?>
                </tr><tr>
    <td colspan="2"></td>
        <td align="right">
        <div class="line_2"><span>Sub-Total</span> 
        <?php if($pedido->cupon){ ?>
        <div class="line_2"><span>Cupon</span>
        <?php } ?>
        <div class="line_2"><span>Envio</span> 
        <div class="line_2"><span>IVA</span>
        <div class="line_3"><span>Total</span>
    </td>



		
	
			</span>
		</div>
				 <div class="line_2"><span>Sub-Total</span><strong>$<?php echo number_format($pedido->monto/1.16,2); ?>
                <input type="hidden" id="subtotal" value="<?php echo $subtotal; ?>"><br>
                 </strong></div>
               
             
                <?php if($pedido->cupon){ ?>

                    <div class="line_2"><span>Cupon</span><strong><span style="color: #9d0d04;">- $<?php echo number_format($pedido->cupon,2); ?></span></strong></div><br>

                <?php } ?>
                <div class="line_2"><span>Envio</span><strong>$<?php echo number_format($pedido->envio,2); ?> <br>
           
             </strong></div>
                <div class="line_2"><span>IVA</span><strong id="calculo_iva">$<?php $iva=($pedido->monto/1.16)* .16; echo number_format($iva,2); ?><br>
               
                </strong></div>
                <div class="line_3"><span>Total</span><strong id="calculo_total">$<?php echo number_format($pedido->monto,2); ?> <b>MXN</b></strong><br>
                <input type="hidden" id="total" value="<?php echo $subtotal + $envio - $totalCupon + $iva; ?>">
                </div><br>

</td>
 </tr>
    </table>


					<h4>DIRECCIÓN DE ENVIO</h4>

                <label class="label_text">Calle: <span style="color:#787878;"><?php echo $pedido->calle; ?></span></label><br>
                <label class="label_text">No. Exterior: <span style="color:#787878;"><?php echo $pedido->numero_exterior; ?></span> No. Interior: <span style="color:#787878;"><?php echo $pedido->numero_interior; ?></span></label><br>
                <label class="label_text">Entre Calles: <span style="color:#787878;"><?php echo $pedido->entre_calles; ?></span></label><br>
                <label class="label_text">Codigo Postal: <span style="color:#787878;"><?php echo $pedido->codigo_postal; ?></span></label><br>
                <label class="label_text">Colonia: <span style="color:#787878;"><?php echo $pedido->colonia; ?></span></label><br>
                <label class="label_text">Ciudad: <span style="color:#787878;"><?php echo $pedido->ciudad; ?></span></label><br>
                <label class="label_text">Estado: <span style="color:#787878;"><?php echo $pedido->estado; ?></span></label><br>

                <br>
                <?php if($pedido->facturar){ ?>
                 <h4>DATOS DE FACTURACIÓN</h4>
                <label class="label_text">RFC:<span style="color:#787878;"> <?php echo $cliente->rfc; ?> </span></label><br>
                <label class="label_text">Razon Social:<span style="color:#787878;"> <?php echo $cliente->razon_social; ?> </span></label><br>
                <label class="label_text">Calle: <span style="color:#787878;"><?php echo $cliente->calle; ?></span></label><br>
                <label class="label_text">No. Exterior: <span style="color:#787878;"><?php echo $cliente->numero_exterior; ?></span> No. Interior: <span style="color:#787878;"><?php echo $cliente->numero_interior; ?></span></label><br>
                <label class="label_text">Entre Calles: <span style="color:#787878;"><?php echo $cliente->entre_calles; ?></span></label><br>
                <label class="label_text">Codigo Postal: <span style="color:#787878;"><?php echo $cliente->codigo_postal; ?></span></label><br>
                <label class="label_text">Colonia: <span style="color:#787878;"><?php echo $cliente->colonia; ?></span></label><br>
                <label class="label_text">Ciudad: <span style="color:#787878;"><?php echo $cliente->ciudado; ?></span></label><br>
                <label class="label_text">Estado: <span style="color:#787878;"><?php echo $cliente->estado; ?></span></label><br>
<?php } ?>


<?php
$content = explode("\n", $content);

foreach ($content as $line):
    echo '<p> ' . $line . "</p>\n";
endforeach;
?>  




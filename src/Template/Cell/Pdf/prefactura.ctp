<style type="text/css">
<!--
-->
</style>
<page pageset="old">		
<!-- empieza header-->
<div style="display:inline">
<div id="page_1">

<div style="float:left; width:750px; margin-left:10px; font-size: 8px; font-face:'Arial';">
  <div style="float:left; width:100%;">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8px; font-face:'Arial';" >
    <tbody>
        <tr>
        <td rowspan="7" style="width:30%;"><img src="<?php echo WWW_ROOT ?>/img/logo_prefactura.png"></td>
      
        <td  rowspan="7" align="center" style="width:70%;">
          <p><strong>NOMBRE DEL EMISOR, S.A. DE C.V. </strong><br>
          <strong>SUCURSAL</strong><br>
          Calle, Número<br>
          Colonia, Ciudad, Estado, País <br>
          AEA041220KM3 <br>
          Leyenda extra ... <br>
          <br>
          </p>
        </td>

        </tr>
    </tbody>
  </table>
  </div>


  <div style="float:left; width:100%;">
  <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8px; font-face:'Arial';" >
    <tbody>
      <tr>
      <td rowspan="9" style="width:70%;"> 
        <br><br><br><br>
        <?php echo $factura->cliente->nombre; ?><br>
        <?php echo $factura->cliente->calle.' '.$factura->cliente->numero; ?><br>
        <?php echo $factura->cliente->colonia; ?><br>
        <?php echo $factura->estado; ?>, 
        <?php echo $factura->municipio; ?>, 
        C.P. <?php echo $factura->cliente->codigo_postal; ?><br>
        País <?php echo $factura->pais; ?><br>
        RFC <?php echo $factura->cliente->rfc; ?>
        <br>
      </td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%;"><strong> Folio </strong></td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;">&nbsp;</td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;"><strong>  Numero y Año de Aprobación </strong></td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;">&nbsp;</td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;"><strong> Fecha </strong></td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;"><?php echo $factura->fecha; ?></td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;"><strong>  Versión y No. de Certificado </strong></td>
      </tr>
      <tr>
        <td  align="center" style="border: #000000 1px solid; width:30%; border-top:0px;">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  </div>

  <div style="float:left; width:100%; margin-top:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8px; font-face:'Arial';" >
    <tbody>
      <tr>
        <td style="width:10%; border: #000000 1px solid;" align="center"> 
          Cantidad
        </td>
        <td style="width:10%; border: #000000 1px solid; border-left:0px;" align="center"> 
          Unidad
        </td>
        <td style="width:40%; border: #000000 1px solid; border-left:0px;" align="center"> 
          Descripci&oacute;n</td>
        <td style="width:20%; border: #000000 1px solid; border-left:0px;" align="center"> 
          Precio Unitario
        </td>
        <td style="width:20%; border: #000000 1px solid;  border-left:0px;" align="center"> 
          Importe
        </td>
      </tr>

      <?php foreach ($factura->clientes_servicios as $servicio): ?>
      <tr>
        <td style="width:10%; border: #000000 1px solid; border-top:0px;" align="center"> 
          <?php echo $servicio->cantidad;?>
        </td>
        <td style="width:10%; border: #000000 1px solid; border-left:0px; border-top:0px;" align="center"> 
          <?php echo $factura->unidades[$servicio->unidad_id];?>
        </td>
        <td style="width:40%; border: #000000 1px solid; border-left:0px; border-top:0px;" align="center"> 
          &nbsp;&nbsp; <?php echo $servicio->descripcion;?>
        </td>
        <td style="width:20%; border: #000000 1px solid; border-left:0px; border-top:0px;" align="right"> 
          $<?php 
            if($factura->moneda_id == 1){ // 1-USD 2-MXN

                echo number_format($servicio->precio_usd,2);

            }else{ 

                echo number_format($servicio->precio_mxn,2); 

            } ?> &nbsp;&nbsp;
        </td>
        <td style="width:20%; border: #000000 1px solid;  border-left:0px; border-top:0px;" align="right"> 
          $<?php if($factura->moneda_id == 1){ echo number_format($servicio->precio_usd * $servicio->cantidad,2); }else{ echo number_format($servicio->precio_mxn * $servicio->cantidad,2); } ?> &nbsp;&nbsp;
        </td>
      </tr>

      <?php endforeach; ?>


    </tbody>
    </table>
  </div>

  <div style="float:left; width:100%; margin-top:5px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8px; font-face:'Arial';" >
    <tbody>
      <tr>
        <td style="width:80%;" align="right"> <strong>Subtotal: </strong>&nbsp;&nbsp; </td>
        <td style="width:20%; border: #000000 1px solid;" align="right"> $<?php echo number_format($factura->subtotal,2); ?> &nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td style="width:80%;" align="right"> <strong>IVA (16%): </strong>&nbsp;&nbsp; </td>
        <td style="width:20%; border: #000000 1px solid; border-top: 0px;" align="right"> $<?php echo number_format($factura->iva,2); ?>&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td style="width:80%;" align="right"> <strong>Total: </strong>&nbsp;&nbsp; </td>
        <td style="width:20%; border: #000000 1px solid; border-top: 0px;" align="right"> $<?php echo number_format($factura->total,2); ?>&nbsp;&nbsp;</td>
      </tr>
    </tbody>
    </table>
  </div>


  <div style="float:left; width:100%; margin-top:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8px; font-face:'Arial';" >
    <tbody>
      <tr>
      <td style="width:100%; border: #000000 1px solid; border-bottom: 0px;"> Importe Total con Letra: </td>
      </tr>
      <tr>

      <td style="width:100%; border: #000000 1px solid; border-top: 0px;" align="center"> <?php echo $factura->cantidad_letra; ?> </td>
      </tr>
    </tbody>
    </table>
  </div>

</div>


</div>


</div>
</page>

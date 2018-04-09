<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>

<?php $this->end(); ?>

<div class="row">

        <div class="col-xs-2">
            Pedido <br> <spam style="font-size:25px;"><?= h($pedido->id) ?></spam>
        </div>
        <div class="col-xs-4">
            <!--Nombre del -->Cliente: <?= h($pedido->cliente_id) ?> <br> <spam style="font-size:25px;"><?= h($pedido->nombre_cliente) ?></spam>
        </div>
        <div class="col-xs-6">
            <?= $this->Form->create(null); ?>

            <div class="col-xs-12" style="padding-left: 0px;">
            	<div class="col-xs-4" style="padding-left: 0px;">
                    Asociado <br>
            		<?= $this->Form->input('asociado_id', array('options'=>$asociados, 'label'=>false, 'value'=>$pedido->asociado_id, 'empty'=>'-- Seleccione --')) ?>
                </div>
                <div class="col-xs-4" style="padding-left: 0px;">
                	Estatus <br>
                    <?= $this->Form->input('estatus_id', array('options'=>$estatuses, 'label'=>false, 'value'=>$pedido->estatus_id)) ?>
                </div>
                <div class="col-xs-4">
                	<?php if ($this->UserAuth->isAdmin()) { ?>
                	 <br>
                    <?= $this->Form->button(__('Guardar')) ?><?= $this->Form->input('old_status_id', array('type'=>'hidden', 'label'=>false, 'value'=>$pedido->estatus_id)) ?>
                    <?php } else { echo "&nbsp;"; } ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
</div>
<br>
<legend></legend>
Información de Contacto
<br><br>
<div class="row">
        <div class="col-xs-4">
            Correo Electrónico <br> <b><?= h($pedido->correo_electronico) ?></b>
        </div>
        <div class="col-xs-4">
            Teléfono Local <br>  <b><?= h($pedido->telefono_local) ?></b>
        </div>
        <div class="col-xs-4">
            Teléfono Celular <br> <b><?= h($pedido->telefono_celular) ?></b>
        </div>
</div>

<br>
<legend></legend>
Datos de Entrega
<br><br>

<?php

    $calleDireccionEnvio =  h($pedido->calle) ;
    $numero_exteriorDireccionEnvio = h($pedido->numero_exterior);
    $numero_interiorDireccionEnvio =   h($pedido->numero_interior);
    $entre_callesDireccionEnvio = h($pedido->entre_calles);
    $coloniaDireccionEnvio = h($pedido->colonia);
    $ciudadDireccionEnvio = h($pedido->ciudad);
    $estadoDireccionEnvio =   h($pedido->estado) ;
    $codigo_postalDireccionEnvio =  h($pedido->codigo_postal);
    $nombre_destinatario =  h($pedido->nombre_destinatario);
    $fecha_entrega = (is_null($pedido->fecha_entrega)) ? '' : date('d-m-Y', strtotime($pedido->fecha_entrega->format('Y-m-d'))).' '.$pedido->horario_entrega;

?>
<div class="row">
        <div class="col-xs-4">
            Nombre de quien Recibe <br> <b><?= $nombre_destinatario ?> </b>
        </div>
        <div class="col-xs-4">
            &nbsp;
        </div>
        <div class="col-xs-4">
            Fecha y Horario <br> <b><?= $fecha_entrega ?> </b>
        </div>
</div>
<br>
<div class="row">
        <div class="col-xs-4">
            Calle y Número <br> <b><?= $calleDireccionEnvio ?></b> Ext. <b><?= $numero_exteriorDireccionEnvio  ?></b> Int. <b><?= $numero_interiorDireccionEnvio ?> </b>
        </div>
        <div class="col-xs-4">
            Entre Calles <br> <b><?= $entre_callesDireccionEnvio  ?></b>
        </div>
        <div class="col-xs-4">
            Colonia <br> <b><?= $coloniaDireccionEnvio  ?></b>
        </div>
</div>
<br>
<div class="row">
        <div class="col-xs-4">
            Ciudad: <br> <b><?= $ciudadDireccionEnvio ?></b>
        </div>
        <div class="col-xs-4">
            Estado: <br> <b><?= $estadoDireccionEnvio ?></b>
        </div>
        <div class="col-xs-4">
            Código Postal: <br> <b><?= $codigo_postalDireccionEnvio  ?></b>
        </div>
</div>
<legend></legend>
Mensajes de pedido
<br><br>
<div class="row">
        <div class="col-xs-4">
            Es funeral: <b><?= (($pedido->arreglo_funeral) ? 'SI' : 'NO') ?> </b>
        </div>
        <div class="col-xs-4">
            Requiere factura: <b><?= (($pedido->facturar) ? 'SI' : 'NO') ?> </b>
        </div>
        <div class="col-xs-4">
            &nbsp;
        </div>
</div>
<br>
<div class="row">
        <div class="col-xs-12">
            Mensaje: <br> <b><?= h($pedido->mensaje_tarjeta) ?> </b>
        </div>
</div>
<br>
<div class="row">
        <div class="col-xs-12">
            Firma: <br> <b><?= h($pedido->firma) ?></b>
        </div>
</div>
<!--
<br><br>
Respuesta de Procesador de Pago
<br>
<div class="row">
        <div class="col-xs-12">
            <b><pre><?= h($pedido->respuesta_pago) ?></pre></b>
        </div>
</div>
-->
<!--

<div class="row">

            <p><?= $pedido->has('formasdepago') ? $this->Html->link($pedido->formasdepago->nombre, ['controller' => 'Formasdepagos', 'action' => 'view', $pedido->formasdepago->id]) : '' ?></p>



                                                    <h6><?= __('Respuesta Pago') ?></h6>
                    <p><?= h($pedido->respuesta_pago) ?></p>

            <div class="col-xs-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($pedido->id) ?></p>
                    <h6><?= __('Monto') ?></h6>
                <p><?= $this->Number->format($pedido->monto) ?></p>
                    <h6><?= __('Estatus Id') ?></h6>
                <p><?= $this->Number->format($pedido->estatus_id) ?></p>
                </div>
            <div class="col-xs-2">
                    <h6><?= __('Fecha') ?></h6>
                <p><?= h($pedido->fecha) ?></p>
                </div>
</div>
-->
<br><br>

<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Partidas" id="Partidas-tab" role="tab" data-toggle="tab" aria-controls="Partidas" aria-expanded="true">Productos</a>
    </li>
<!--
    <li role="presentation" class="">
        <a href="#Facturacion" id="Facturacion-tab" role="tab" data-toggle="tab" aria-controls="Facturacion" aria-expanded="true">Datos de Facturación</a>
    </li>
-->

    <li role="presentation" class="">
        <a href="#Envio" id="Envio-tab" role="tab" data-toggle="tab" aria-controls="Envio" aria-expanded="true">Datos de Envio</a>
    </li>


    <li role="presentation" class="">
        <a href="#Comentarios" id="Comentarios-tab" role="tab" data-toggle="tab" aria-controls="Comentarios" aria-expanded="true">Comentarios</a>
    </li>

</ul>

<div id="myTabContent" class="tab-content">

<!-- INICIA PEDIDOS -->
<div role="tabpanel" class="tab-pane fade in active" id="Partidas" aria-labelledBy="Partidas-tab">
    <div class="related row">
        <div class = "col-xs-12"><br>
            <?php if (!empty($pedido->partidas)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:right;"><?= __('Cantidad') ?></th>
                        <th style="text-align:center;"><?= __('Producto') ?></th>
                        <th style="text-align:right;"><?= __('Precio Unitario') ?></th>
                        <th style="text-align:right;"><?= __('Subtotal') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; foreach ($pedido->partidas as $partidas): ?>
                    <tr>
                        <td style="text-align:right;"><?= h($partidas->cantidad) ?></td>
                        <td><?= h($partidas->sku).' - '.h($partidas->producto) ?></td>
                        <td style="text-align:right;">$<?php echo number_format($partidas->precio,2); ?></td>
                        <td style="text-align:right;">$<?php echo number_format($partidas->precio*$partidas->cantidad,2); $subtotal += ($partidas->precio*$partidas->cantidad); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <div class="row">
            <div class="col-xs-12" align="right">
            <table class="table" style="width:20%;">
                <tr>
                    <td>Sub-Total</td>
                    <td style="text-align:right;">$<?= number_format($subtotal,2) ?></td>
                </tr>
                <tr>
                    <td>Cupon (solo informativo)</td>
                    <td style="text-align:right;">-$<?= number_format($pedido->cupon,2) ?></td>
                </tr>

                <tr>
                    <td>Envio</td>
                    <td style="text-align:right;">$<?= number_format($pedido->envio,2) ?></td>
                </tr>
                <tr>
                    <td>IVA</td>
                    <td style="text-align:right;">$<?= number_format($pedido->iva,2) ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td style="text-align:right;">$<?= number_format($pedido->monto,2) ?></td>
                </tr>

            </table>


            </div>
            </div>


         <?php else: ?>
            <h4><?= __('No existen Pedidos asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<!-- FINALIZA PEDIDOS -->
<!--
<div role="tabpanel" class="tab-pane fade in" id="Facturacion" aria-labelledBy="Facturacion-tab">
    <br><br>
    <?php if($pedido->facturar == false){ echo '<center> <b>No requiere Facturacion</b> </center>';}else{ ?>

    <?php

        if( !isset( $direccionFactura )){

            $razon_social = h($pedido->user->razon_social);
            $rfc = h($pedido->user->rfc) ;
            $calle = h($pedido->user->calle);
            $numero_exterior = h($pedido->user->numero_exterior) ;
            $numero_interior = h($pedido->user->numero_interior) ;
            $entre_calles = h($pedido->user->entre_calles) ;
            $colonia = h($pedido->user->colonia) ;
            $ciudad = h($pedido->user->ciudad) ;
            $estado = h($pedido->user->estado) ;
            $codigo_postal = h($pedido->user->codigo_postal)  ;

        }else{

            $razon_social = h($direccionFactura->razon_social);
            $rfc = h($direccionFactura->rfc) ;
            $calle = h($direccionFactura->calle);
            $numero_exterior = h($direccionFactura->numero_exterior) ;
            $numero_interior = h($direccionFactura->numero_interior) ;
            $entre_calles = h($direccionFactura->entre_calles) ;
            $colonia = h($direccionFactura->colonia) ;
            $ciudad = h($direccionFactura->ciudad) ;
            $estado = h($direccionFactura->estado) ;
            $codigo_postal = h($direccionFactura->codigo_postal)  ;

        }
    ?>

    <div class="row">
        <div class="col-xs-4">
            Razon Social <br> <b><?=  $razon_social  ?></b>
        </div>
        <div class="col-xs-4">
            RFC <br> <b><?= $rfc  ?></b>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-4">
            Calle y Numero <br> <b><?= $calle ?></b> Ext. <b><?= $numero_exterior  ?></b> Int. <b><?= $numero_interior  ?> </b>
        </div>
        <div class="col-xs-4">
            Entre Calles <br> <b><?=  $entre_calles ?></b>
        </div>
        <div class="col-xs-4">
            Colonia <br> <b><?= $colonia  ?></b>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-4">
            Ciudad: <br> <b><?=  $ciudad  ?></b>
        </div>
        <div class="col-xs-4">
            Estado: <br> <b><?= $estado  ?></b>
        </div>
        <div class="col-xs-4">
            Codigo Postal: <br> <b><?= $codigo_postal  ?></b>
        </div>
    </div>
    <?php } ?>
</div>
-->
<div role="tabpanel" class="tab-pane fade in" id="Envio" aria-labelledBy="Envio-tab">
    <br>

    <?php if($pedido->recoger_sucursal == false){ ?>

    <?= $this->Form->create(null, ['action'=>'guardar_datos_envio']); ?>
    <div class="row">
        <div class="col-xs-6">

        <?php
        echo $this->Form->input('id', ['value'=>$pedido->id, 'type'=>'hidden']);
        echo $this->Form->input('guia_de_envio', ['label'=>'Guia de Envio', 'value'=>$pedido->guia_de_envio]);
        echo $this->Form->input('proveedor_mensajeria', ['label'=>'Proveedor de Mensajeria', 'value'=>$pedido->proveedor_mensajeria]);
        ?>
        </div>
        <div class="col-xs-6">
        <?php
        echo $this->Form->input('recibido_por', ['label'=>'Recibido por', 'value'=>$pedido->recibido_por]);

        if($pedido->fecha_entrega != '' && !is_null($pedido->fecha_entrega)){
            echo $this->Form->input('fecha_entrega',array('class ' => 'form-control', 'type'=>'text', 'label' => 'Fecha de Entrega', 'value'=>$pedido->fecha_entrega->i18nFormat('dd-MM-YYYY')));
        }else{
            echo $this->Form->input('fecha_entrega',array('class ' => 'form-control', 'type'=>'text', 'label' => 'Fecha de Entrega'));
        }
        ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?= $this->Form->button(__('Guardar Datos de Envio')) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>

    <?php }else{ echo '<center> <b>RECOGER EN '.$pedido->sucursale->nombre.' </b> </center>'; } ?>


</div>

<div role="tabpanel" class="tab-pane fade in " id="Comentarios" aria-labelledBy="Comentarios-tab">
    <br>
    <?php foreach ($pedido->pedidos_comentarios as $comentarios): ?>
    <div class="row">
        <div class="col-xs-4">
            <h3><?php echo $comentarios->user->first_name.' '.$comentarios->user->last_name; ?></h3>
            <?php echo $comentarios->created->i18nFormat('dd-MM-YYYY HH:mm'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $comentarios->mensaje; ?>
        </div>
    </div>
    <br>
    <legend></legend>
    <?php endforeach; ?>


    <br>

    <?= $this->Form->create(null, ['action' => 'agregar_comentario']); ?>
        <div class="row">
            <div class="col-xs-12">
                <?= $this->Form->input('pedido_id', array('type'=>'hidden', 'value'=>$pedido->id)) ?>
                <?= $this->Form->input('mensaje', array('type'=>'textarea', 'label'=>'Comentario')) ?>
            </div>
            <div class="col-xs-12" align="right">
                <?= $this->Form->button(__('Agregar Comentario')) ?>
            </div>

        </div>
    <?= $this->Form->end() ?>

</div>


<script type="text/javascript">
    $('#fecha-entrega').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"

    });
</script>

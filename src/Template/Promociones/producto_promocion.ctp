<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>



<div class="page-padding">

    <div class="row"> 
            <?php setlocale(LC_MONETARY, 'en_US.UTF-8');?>
            <div class="col-xs-1">
            <h4><?= __('Proveedor') ?></h4>
            <p><?= $producto->proveedor->nombre; ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Envio Gratis') ?></h4>
            <p><?php  if ($producto->envio_gratis){echo "Si";}else{echo "No";} ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Vendor') ?></h4>
            <p><?= money_format('%.2n', $producto->costo) ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Margen') ?></h4>
            <p><?= $this->Number->format($producto->margen) ?>%</p>
            </div>
            <div class="col-xs-1"> 
            <h4><?= __('MSRP') ?></h4>
            <p><?= money_format('%.2n', $producto->precio) ?></p>
            </div>
            <div class="col-xs-1"> 
            <h4><?= __('Ganancia') ?></h4>
            <p><?php 
                $iva_producto = $producto['precio'] - $producto['precio'] / 1.16;
                 echo money_format('%.2n', $producto->costo*($producto->margen)/100) ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Actualizacion') ?></h4>
            <p><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></p>
            </div>
          
    </div>
<br>
    <div class="row">
        <div class="col-xs-12">
        <fieldset>
        <?= $this->Form->create($promocion); ?>
        
        
        
            <div class="col-xs-4">
                <?php
                    echo $this->Form->input('producto_id', ['type'=>'hidden', 'value'=>$producto_id]);
                    echo $this->Form->input('promocion_id', ['options'=>$promociones]);
                ?>
            </div>
            <div class="col-xs-2"> <br>
                <?= $this->Form->button(__('Asignar Promoci&oacute;n')) ?>
            </div>
        <?= $this->Form->end() ?>

            <div class="col-xs-2"> <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-promociones"> Agregar Nueva Promoci&oacute;n</button>
            </div>

        </fieldset>
        </div>

        
        <div class="col-xs-12">
            <legend><?= __('Listado de Promociones') ?></legend>
            <div class="row">
                <div class="col-xs-2">
                    Promocion
                </div>
                <div class="col-xs-2">
                    Periodo de Promocion
                </div>
                <div class="col-xs-1">
                    Monto($)
                </div>
                <div class="col-xs-1">
                    Descuento(%)
                </div>
                <!-- <div class="col-xs-1" style="text-align:center;">
                    Envio Gratis
                </div> -->
                <div class="col-xs-2" style="text-align:center;">
                    Precio Venta
                </div>
                <div class="col-xs-1" style="text-align:center;">
                    Ganancia
                </div>
            </div>


            
            <?php 

                $precio_producto =  $producto->precio;
                $precio_anterior =  $producto->precio;
                $old=$precio_anterior;

                $ganancia =  $producto->costo*($producto->margen)/100;
                $costo_envio = $envio->precio;

                foreach ($promociones_productos as $promocion_) {
                $fecha_actual = strtotime(date('d-m-Y'));
                $fecha_fin = strtotime($promocion_->promocion->fecha_fin->i18nFormat('dd-MM-YYYY'));

                if($fecha_fin >= $fecha_actual){
                    if($promocion_->promocion->monto > 0){
                        $ganancia = $ganancia - $promocion_->promocion->monto;
                          
                       $precio_producto = $precio_producto -  $promocion_->promocion->monto;

                         
                        $costo_pago = ($precio_producto) *.04;
                        $noventayseis = $precio_producto - $costo_pago;
                        $tcostos= $noventayseis-$costo_envio;
                      
                        $iva = $tcostos - ($tcostos/1.16);
                        $subtotal= $tcostos - $iva;
                        $margen = (($subtotal - $producto->costo)/$producto->costo);
                        $ganancia =$producto->costo *$margen;
                                  
                         

                    }else{
                           $ganancia = $ganancia - (($promocion_->promocion->descuento/100) * $precio_producto);
                  
                          

                        $precio_producto = $precio_producto -  (($promocion_->promocion->descuento/100) * $precio_producto);

                        
                        $costo_pago = ($precio_producto) *.04;
                        $noventayseis = $precio_producto - $costo_pago;
                        $tcostos= $noventayseis-$costo_envio;
                      
                        $iva = $tcostos - ($tcostos/1.16);
                        $subtotal= $tcostos - $iva;
                        $margen = (($subtotal - $producto->costo)/$producto->costo);
                        $ganancia =$producto->costo *$margen;

                      
                          

                         
                    }
                    $old=$precio_anterior;
                    $precio_anterior= $precio_producto;
                }
            ?>
            <br>
            <div class="row" <?php if($fecha_actual > $fecha_fin){ echo 'style="color:red;"'; } ?> >
                <div class="col-xs-2">
                    <b><?php echo $promocion_->promocion->nombre; ?></b>
                </div>
                <div class="col-xs-2">
                    <?php echo $promocion_->promocion->fecha_inicio->i18nFormat('dd-MM-YYYY'); ?> - <?php echo $promocion_->promocion->fecha_fin->i18nFormat('dd-MM-YYYY'); ?>
                </div>
                
                <div class="col-xs-1">
                    $<?php echo number_format($promocion_->promocion->monto,2); ?>
                </div>
                <div class="col-xs-1">
                    <?php echo number_format($promocion_->promocion->descuento,2); ?>%
                </div>
                <!-- <div class="col-xs-1" style="text-align:center;">
                    <?php if($promocion_->promocion->envio == true) { ?>
                    <b><i class="fa fa-check"></i></b>
                    <?php } ?>
                </div> -->

                <div class="col-xs-2" style="text-align:center;">
                    $<?php echo number_format($precio_producto,2); ?>
                </div>

                <div class="col-xs-1" style="text-align:center;">
                    $<?php echo number_format($ganancia,2); ?>
                </div>

                <div class="col-xs-1">

                    <button type="button" class="btn btn-primary edita_promocion" data-promocion-id="<?php echo $promocion_->promocion->id; ?>" data-precio-old="<?php echo $old; ?>"><i class="fa fa-pencil"></i></button>
                </div>

                <div class="col-xs-1">
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'eliminar_promocion', $promocion_->id], ['title' => __('Elimnar Promocion'), "escape" => false, 'class'=>'btn btn-primary']) ?>
                </div>
            </div>

            <?php } ?>

        </div>
    </div>
</div>


                            <div class="modal inmodal fade" id="modal-promociones-edicion" tabindex="-1" role="dialog"  aria-hidden="true"
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="margin-top:100px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Editar Promoci&oacute;n</h4>
                                        </div>

                                        <?= $this->Form->create($nueva_promocion, ['controller' => 'promociones', 'action' => 'edit_promocion_producto', 'id'=>'form_edicion_producto']); ?>

                                            <?php echo $this->Form->input('asignar_producto', ['type'=>'hidden', 'value'=>$producto_id]); ?>
                                        <div class="modal-body">
                                            
    <div class="row"> 
          
            <div class="col-xs-1">
                <h4><?= __('Proveedor') ?></h4>
                <p><?= $producto->proveedor->nombre; ?></p>
            </div>
            <div class="col-xs-2">
                <h4><?= __('Envio Gratis') ?></h4>
                <p><?php  if ($producto->envio_gratis){echo "Si";}else{echo "No";} ?></p>
            </div>
            <div class="col-xs-1">
                <h4><?= __('Vendor') ?></h4>
                <p><?= money_format('%.2n', $producto->costo) ?></p>
            </div>
            <div class="col-xs-1">
                <h4><?= __('Margen') ?></h4>
                <p><?= $this->Number->format($producto->margen) ?>%</p>
            </div>
            <div class="col-xs-1"> 
                <h4><?= __('MSRP') ?></h4>
                <p id="msrp_edit_show"><?= money_format('%.2n', $precio_producto) ?></p>
            </div>
            <div class="col-xs-1"> 
                <h4><?= __('Ganancia') ?></h4>
                <p id="ganancia_edit_show"><?php 
                
                 echo money_format('%.2n', $ganancia); ?></p>
            </div>
            <div class="col-xs-1">
                <h4><?= __('Actualizacion') ?></h4>
                <p><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></p>
            </div>
          
    </div>
                                          <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-4">
                                                         <?php echo $this->Form->input('id', ['id'=>'id_edit', 'type'=>'hidden']); ?>
                                                    <?php echo $this->Form->input('nombre', ['id'=>'nombre_edit']); ?>
                                                    </div>
                                                    <div class="col-xs-4">
                                                    <br>
                                                    <?php //echo $this->Form->input('envio', ['label'=>'Envio Gratis', 'id'=>'envio_edit']); ?>
                                                    </div>
                                                    <div class="col-xs-4">
                                                    
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12">   
                                                
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('fecha_inicio',array('class ' => 'form-control', 'type'=>'text', 'id'=>'fecha_inicio_edit')); ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('fecha_fin',array('class ' => 'form-control', 'type'=>'text', 'id'=>'fecha_fin_edit')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"> 
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('precio_oferta' , ['id'=>'precio_oferta_edit']); ?>
                                                    <?php echo $this->Form->input('precio',array('type'=>'hidden','value'=>$precio_producto,'id'=>'precio_edit')); ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <b>Monto:</b> <div id="edit_monto"></div><br>
                                                    <b>Descuento:</b> <div id="edit_descuento"></div><br>
                                                    <b>Ganancia Final:</b> <div id="edit_ganancia_final"></div><br>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"> 
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('monto', ['value'=>0,'id'=>'monto_edit']); ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('descuento', ['value'=>0,'id'=>'descuento_edit']); ?>
                                                    </div>
                                                 
                                                </div>   
                                                
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                            <?= $this->Form->button(__('Guardar')) ?>
                                        </div>

                                        <?= $this->Form->end() ?>

                                    </div>
                                </div>
                            </div>


                            <div class="modal inmodal fade" id="modal-promociones" tabindex="-1" role="dialog"  aria-hidden="true"
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="margin-top:100px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Agregar Promoci&oacute;n</h4>
                                        </div>

                                        <?= $this->Form->create($nueva_promocion, ['controller' => 'promociones', 'action' => 'add']); ?>

                                            <?php echo $this->Form->input('asignar_producto', ['type'=>'hidden', 'value'=>$producto_id]); ?>
                                        <div class="modal-body">
                                            

 <div class="row"> 
          
            <div class="col-xs-1">
            <h4><?= __('Proveedor') ?></h4>
            <p><?= $producto->proveedor->nombre; ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Envio Gratis') ?></h4>
            <p><?php  if ($producto->envio_gratis){echo "Si";}else{echo "No";} ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Vendor') ?></h4>
            <p><?= money_format('%.2n', $producto->costo) ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Margen') ?></h4>
            <p><?= $this->Number->format($producto->margen) ?>%</p>
            </div>
            <div class="col-xs-1"> 
            <h4><?= __('MSRP') ?></h4>
            <p><?php 
        if($precio_producto){
           echo  money_format('%.2n', $precio_producto);
         }   else{

            echo  money_format('%.2n', $producto->precio);
            }


             ?></p>
            </div>
            <div class="col-xs-1"> 
            <h4><?= __('Ganancia') ?></h4>
            <p><?php 
                
                  if($ganancia){
           echo  money_format('%.2n', $ganancia);
          }  else{

           echo money_format('%.2n', $producto->costo*($producto->margen)/100);
            }



                  ?></p>
            </div>
            <div class="col-xs-1">
            <h4><?= __('Actualizacion') ?></h4>
            <p><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></p>
            </div>
          
    </div>




                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-4">
                                                    <?php echo $this->Form->input('nombre'); ?>
                                                    </div>
                                                    <div class="col-xs-4">
                                                    <br>
                                                    <?php echo $this->Form->input('envio', ['label'=>'Envio Gratis']); ?>
                                                    </div>
                                                    <div class="col-xs-4">
                                                    
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12">   
                                                
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('fecha_inicio',array('class ' => 'form-control', 'type'=>'text')); ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('fecha_fin',array('class ' => 'form-control', 'type'=>'text')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"> 
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('precio_oferta'); ?>
                                                    <?php 
                                                        if($precio_producto){
                                                        echo $this->Form->input('precio',array('type'=>'hidden','value'=>$precio_producto)); 
                                                    }else{
echo $this->Form->input('precio',array('type'=>'hidden','value'=>$producto->precio));

                                                    }
                                                     ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <b>Monto:</b> <div id="monto"></div><br>
                                                    <b>Descuento:</b> <div id="descuento"></div><br>
                                                      <b>Ganancia Final:</b> <div id="ganancia_final"></div><br>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"> 
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('monto', ['value'=>0]); ?>
                                                    </div>
                                                    <div class="col-xs-3">
                                                    <?php echo $this->Form->input('descuento', ['value'=>0]); ?>
                                                    </div>
                                                 
                                                </div>   
                                                
                                            </div>
                                            
                                            

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                            <?= $this->Form->button(__('Guardar')) ?>
                                        </div>

                                        <?= $this->Form->end() ?>

                                    </div>
                                </div>
                            </div>

<script type="text/javascript">

    $(document).on({click: function(e){ 

        var promocion_id = $(this).data('promocion-id');
        var old = $(this).data('precio-old');
        console.log(old);
         

            $.ajax({
        
                        type: 'POST',
                        url: '<?php echo $this->Url->build(["action" => "busqueda_promocion"]); ?>',
                        data: {
                            promocion_id:promocion_id
                        },
                        dataType: 'json',
                        success: function(data){
                            

                            $('#id_edit').val(data.id);
                            $('#nombre_edit').val(data.nombre);
                            $('#fecha_inicio_edit').val(data.fecha_inicio);
                            $('#fecha_fin_edit').val(data.fecha_fin);
                            $('#monto_edit').val(data.monto);
                            $('#descuento_edit').val(data.descuento);
                            $('#precio_edit').val(old);
                            $('#msrp_edit_show').html('$'+old);

                            var ganancia=calcula_ganancia_edit();
                            //console.log($('#ganancia_edit_show').html());
                            $('#ganancia_edit_show').html('$'+ganancia);
                            
                            
                            if(data.envio == true){
                                $('#envio_edit').attr('checked',true);
                            }else{
                                $('#envio_edit').attr('checked',false);
                            }


                            $('#modal-promociones-edicion').modal();
                        }
            });

                      
            
    }}, '.edita_promocion');

    $('#fecha_inicio_edit').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

    $('#fecha_fin_edit').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });


    $('#fecha-inicio').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });

    $('#fecha-fin').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy"

    });


    $('#precio-oferta').change(function () {

        var precio        =  parseFloat($("#precio").val());
        var precio_oferta = parseFloat($("#precio-oferta").val())

        var monto= precio-precio_oferta;
        $('#monto').html((monto).toFixed(2));
        $('#descuento').html(((monto/precio)*100).toFixed(2));


    var costo_pago= precio_oferta*.04;

    var costo_envio=<?= $envio->precio ?>;

    var costo= <?php echo $producto->costo;?>; 

  //  console.log('Costo Pago:'+costo_pago);

    var noventayseis = precio_oferta - costo_pago;
    //console.log('Noventayseis:'+noventayseis);

    var tcostos=noventayseis-costo_envio;
    //console.log('tcostos:'+tcostos);

    var iva = tcostos-(tcostos/(1.16));

    var subtotal=tcostos-iva;
    //console.log('subtotal:'+subtotal);

    var margen  = ((subtotal - costo)/costo);

    $('#ganancia_final').html((margen*costo).toFixed(2));
        

});

        $('#precio_oferta_edit').change(function () {


        var precio        =  parseFloat($("#precio_edit").val());
        var precio_oferta = parseFloat($("#precio_oferta_edit").val())

        var monto= precio-precio_oferta;
        $('#edit_monto').html((monto).toFixed(2));
        $('#edit_descuento').html(((monto/precio)*100).toFixed(2));
           

        var costo_pago= precio_oferta*.04;

        var costo_envio=<?= $envio->precio ?>;

        var costo= <?php echo $producto->costo;?>; 

      //  console.log('Costo Pago:'+costo_pago);

        var noventayseis = precio_oferta - costo_pago;
        //console.log('Noventayseis:'+noventayseis);

        var tcostos=noventayseis-costo_envio;
        //console.log('tcostos:'+tcostos);

        var iva = tcostos-(tcostos/(1.16));

        var subtotal=tcostos-iva;
        //console.log('subtotal:'+subtotal);

        var margen  = ((subtotal - costo)/costo);

        $('#edit_ganancia_final').html((margen*costo).toFixed(2));
        
        
});

function calcula_ganancia_edit(){

        var precio        =  parseFloat($("#precio_edit").val());
        var precio_oferta = precio;

        var monto= 0;
        
           

        var costo_pago= precio_oferta*.04;

        var costo_envio=<?= $envio->precio ?>;

        var costo= <?php echo $producto->costo;?>; 

        console.log('Costo Pago:'+costo_pago);

        var noventayseis = precio_oferta - costo_pago;
        //console.log('Noventayseis:'+noventayseis);

        var tcostos=noventayseis-costo_envio;
        //console.log('tcostos:'+tcostos);

        var iva = tcostos-(tcostos/(1.16));

        var subtotal=tcostos-iva;
        //console.log('subtotal:'+subtotal);

        var margen  = ((subtotal - costo)/costo);
        return (margen*costo).toFixed(2);

}

</script>
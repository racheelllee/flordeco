<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>




<div class="page-padding">
    <?= $this->Form->create($precio); ?>
    <fieldset>
        <legend><?= $producto->nombre ?></legend>
<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
   
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?php
        echo $this->Form->input('producto_id', ['type'=>'hidden','value' => $producto->id]);
        echo $this->Form->input('proveedor_id', ['options' => $proveedores]);

        ?>
        </div>     
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?php
        echo $this->Form->input('existencia');

        ?>
        </div>   
           
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= $this->Form->input('costo',['label'=>'Costo']); ?>
        
            <?= $this->Form->input('margen',['label'=>'Margen']) ?>
            <?= $this->Form->input('margen_real',['label'=>'Ganancia Real sin IVA']) ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?= $this->Form->input('precio_meta') ?>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?php echo $this->Form->input('precio',['label'=>'MSRP','readonly']);?>
        </div>
        <button type="button" class="btn " id="recalculo" >Recalcular Margen</button>
    </div>

    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
    <?= $this->Form->input('margen_vs_vendor',['readonly','label'=>'Margen real (%)']) ?>
        <?php

        echo $this->Form->input('envio_gratis');
         echo $this->Form->input('costo_envio',['type'=>'hidden','value'=>$envio->precio]);

         $costo_medio_de_envio=0;

        echo $this->Form->input('costo_medio_de_envio',['readonly', 'value'=>$costo_medio_de_envio]);

        echo $this->Form->input('iva',['readonly','value'=>0]);

        echo $this->Form->input('costo_de_pago',['readonly','value'=>0]);
        //echo $this->Form->input('subtotal_de_costos',['readonly','value'=>0]);
        
        echo $this->Form->input('total_de_costos',['readonly','value'=>0]);
        ?>
        <?= $this->Form->button(__('Guardar')) ?>
    </div>
</div>

<?php
$user = $this->UserAuth->getUser();
echo $this->Form->input('usuario_id', ['type'=>'hidden','value' => $user['User']['id']]);
?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
 

  $(document).ready(function() {

//Si cambia el costo (Vendor) recalculo.
$('#costo').change(function () {
    //calculo();
    //calculo(1);
});

//Click envio gratis   
$('#envio-gratis').click(function () {
     if($("#envio-gratis").is(':checked')) {  
               $("#costo-medio-de-envio").val($("#costo-envio").val());
         
        } else {  
            $("#costo-medio-de-envio").val('0');
        
        }  
        calculo();
});

//Cambio en margen
$('#margen').change(function () {
    $("#margen-real").val($("#costo").val()*($("#margen").val()/100));
    calculo();
});

//Cambio en margen real (pesos)
$('#margen-real').change(function () {
    $("#margen").val(  $("#margen-real").val()/$("#costo").val()*100  );
    calculo();
});

//Recalcular en base a Precio Meta.
$('#recalculo').click(function () {
    $("#precio").val($('#precio-meta').val());
    calculo_desde_precio_final();
});


function calculo(){
    
    
    var costo        =  parseFloat($("#costo").val());
    var porcentaje = parseFloat($("#margen").val());
    var costo_envio  =  parseFloat($("#costo-medio-de-envio").val()  );
    
    console.log('Costo:'+costo);
    console.log('Porcentaje:'+porcentaje);

    var margen  = (costo*porcentaje)/100 ;
    var suma=costo+margen;

    var iva = suma*<?php echo $iva;?>;
    console.log('IVA:'+iva);
    $("#iva").val((iva).toFixed(4));

    $("#margen-real").val(margen);

    suma=suma+iva+costo_envio;
    console.log('Subtotal:'+suma);
    

    var noventayseis = suma;
    console.log('Noventayseis:'+noventayseis);

    var costo_pago= (noventayseis/96)*4;
    $("#costo-de-pago").val((costo_pago).toFixed(4));
    console.log('Costo Pago:'+costo_pago);

    var total_costos=suma+costo_pago-margen;
    $("#total-de-costos").val((total_costos).toFixed(4));

    var msrp=noventayseis+costo_pago;
    $("#precio").val((msrp).toFixed(4));
    console.log('MSRP:'+msrp);


    $("#margen-vs-vendor").val(((1-(total_costos/msrp))*100).toFixed(4));
    //$("#margen-vs-vendedor-porcentaje").val(((msrp)-(total_costos)).toFixed(4));
    

    
 }

 function calculo_desde_precio_final(){
    
    
    var costo        =  parseFloat($("#costo").val());
    var precio_meta = parseFloat($("#precio-meta").val());
    var costo_envio  =  parseFloat($("#costo-medio-de-envio").val()  );

    //var porcentaje = parseFloat($("#margen").val());
    
    
    console.log('Costo:'+costo);
    console.log('Meta:'+precio_meta);

    $("#precio").val((precio_meta).toFixed(4));

    var costo_pago= precio_meta*.04;
    $("#costo-de-pago").val((costo_pago).toFixed(4));
    console.log('Costo Pago:'+costo_pago);

    var noventayseis = precio_meta - costo_pago;
    console.log('Noventayseis:'+noventayseis);

    var tcostos=noventayseis-costo_envio;
    console.log('tcostos:'+tcostos);

    var iva = tcostos-(tcostos/(1+<?php echo $iva;?>));
    console.log('IVA:'+iva);
    $("#iva").val((iva).toFixed(4));

    var subtotal=tcostos-iva;
    console.log('subtotal:'+subtotal);


    var margen  = ((subtotal - costo)/costo)*100;
    console.log('margen:'+margen);
    $("#margen").val((margen).toFixed(4));

    var margen_real = (margen*costo)/100;
    $("#margen-real").val((margen_real).toFixed(4));

    var total_costos = precio_meta-margen_real;
    $("#total-de-costos").val((total_costos).toFixed(4));

    $("#margen-vs-vendor").val(((1-(total_costos/precio_meta))*100).toFixed(4));

    

    
    

    
 }

//Al iniciar calculo para mostrar datos
if($("#envio-gratis").is(':checked')) {  
       $("#costo-medio-de-envio").val($("#costo-envio").val());
 
} else {  
    $("#costo-medio-de-envio").val('0');

}  
calculo();

});



</script>
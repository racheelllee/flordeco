<?php //debug($producto);
$scriptsSimilares="";
$scriptsComplementos="";?>

    <div id="content">
        <div class="container">
            <div id="prod_details">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h4 style="color: green;"><b>1 producto agregado al carrito</b></h4>
<br>

<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
 <a href="/p/<?= $producto->url ?>"><img id="xtpz" src="/img/productos/original/<?php echo $producto->imagenes[0]->nombre; ?>" alt=""></a>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                   <a href="/p/<?= $producto->url ?>"><?= $producto->nombre ?></a><br>
              
                        <b><div style="color: #014272" id="precioDiv">$ <?= number_format($producto->precio,0) ?> MXN</div></b>
                            </div>
                        </div>

                        
                     
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                        <div class="highlight">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <?php 

   $total_precio = 0;
   if($this->request->session()->check('carrito')){
            $articulos_ = array();
            $articulos_ = $this->request->session()->read('carrito');
            $total_articulos = 0;
            foreach ($articulos_ as $articulo_) {
                $total_articulos += $articulo_['cantidad'];
                $total_precio += $articulo_['precio'];
            }
         }else{
            $total_articulos = 0;
            $total_precio = 0;
        }
                                ?>
                               <!-- Subtotal del pedido:  <b>$<?= $total_precio?></b><br>-->


                              
                                <b><?= $total_articulos?></b> productos en tu carrito<br><br>
                                </div>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span>
                                <a href="/carrito" class="btn btn-default uff">
                                    Editar Carrito de Compras
                                </a> 
                                 <a href="/pedido" class="btn btn-warning uff">
                                    Finalizar Compra
                                </a>
                                </span>
                             </div>
                         </div>

<p style="margin:10px 0;">
Los precios incluyen IVA.
</p>
<p>

En el siguiente carrusel puedes seleccionar articulos que complementan tu compra.<br>
Regala a tus amigos un CUPON de <a tabindex="0" data-toggle="popover" role="button" data-trigger="focus" title="Cup&oacute;n AMIGO" data-content=" Regala a tus amigos un descuento autom&aacute;tico de $100 pesos, utilizando el c&oacute;digo: AMIGO en compras mayores a $1,000 pesos.
 Este c&oacute;digo podr&aacute; ser redimido una vez por cliente registrado. El c&oacute;digo se ingresa en el carrito de compra">$100</a> pesos para comprar. C&oacute;digo: <b>AMIGO</b> 
</p>



<div class="tooltip top" role="tooltip">
  <div class="tooltip-arrow"></div>
  <div class="tooltip-inner">
   
  </div>
</div>



</div>
                    </div>
<div>




                         <br>
                    </div>
                </div>
              

    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                        <div class="prod_slider">
                            <?php echo $this->element('complementos',['titulo' => 'Complementa tu compra',
                                                                        'id' => '2', 
                                                                        'complementos' => $producto->complementos]);

                                $similares=$producto->categorias[0]->productos;
                                shuffle($similares);
                                $similares=array_slice($similares, 0, 20);

                                echo $this->element('complementos',['titulo' => 'Productos Similares',
                                                                        'id' => '3',
                                                                            'complementos' => $similares]);
                            ?>
                        </div>
                    </div>
                </div>

                    
<br></div></div>
            
          
            <br>
        </div>
    </div>


    <script type="text/javascript">
    $(function () {
        $('[data-toggle="popover"]').popover()

    })
   



    $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});


$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });




        $('.purchase_btn').click(function(){
           
            var id_producto = '<?= $producto->id ?>';
            var cantidad = $('#cantidad').val();
            var atributos = $('Select').map(function(){ 
        
                return {"atributo": this.getAttribute('atributo_nombre'),
                        "valor": this.options[this.selectedIndex].text}; 
            }).get();


            

            $.ajax({
    
                type: 'GET',
                url: '<?php echo $this->Url->build(["action" => "promociones",$producto->url]); ?>',
                dataType: 'json',
                success: function(data){ 

                    var ahorro = data['producto']['ahorro'];

                    
                    $.ajax({
    
                        type: 'POST',
                        url: '<?php echo $this->Url->build(["action" => "agregar_carrito"]); ?>',
                        data: {
                            id_producto:id_producto,
                            cantidad:cantidad,
                            //atributos:JSON.stringify(atributos)
                            atributos:atributos,
                            ahorro:ahorro
                        },
                        dataType: 'json',
                        success: function(data){

                            location.href = "/carrito";
                    
                        }
                    })



                }
            })

            //console.log(atributos);
            //return false;
            

        });

$("#item").hover(function(){
    $('#precio').removeClass('hidden');
},function(){
    $('#precio').addClass('hidden');
});


        $.ajax({
    
                type: 'GET',
                url: '<?php echo $this->Url->build(["action" => "promociones",$producto->url]); ?>',
                dataType: 'json',
                success: function(data){
                    jQuery.each(data['promociones'], function(i, promo) {

                        if(i==0){
                            $("#promosDiv").append("<div class='price_1'>Precio Regular: <span> $ "+ numberFormat(promo['precio']) +" MXN</span></div>");    

                        }else{
                            $("#promosDiv").append("<div class='price_1'>Oferta: <span>$ "+ numberFormat(promo['precio']) +" MXN</span></div>");    
                        }
                             if(i>0){
                                 $("#superofertaDiv").append("Super Oferta");
                             }           
                    }); 

                    $("#precioDiv").html("$ "+ numberFormat(data['producto']['precio']) +" MXN");
                    
                    if(data['producto']['ahorro'] >0){
                        $("#ahorroDiv").html("Ahorro Total: $ "+ numberFormat(data['producto']['ahorro']) + " MXN");
                    }
                    
                    if(data['validez'] !=''){
                        $("#promoValidaDiv").html("Promoción válida al: "+ data['validez'] + " o agotar existencias");
                    }
                    


                }
            })

        
        <?php echo $scriptsSimilares; ?>
        <?php echo $scriptsComplementos; ?>

    </script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<?php
  $carrito = array();
  $carrito = $this->request->session()->read('carrito');
  $logeado = 0;
?>


<div id="content">
  <div class="container">
  
    <div id="carrito_2">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="step_01">
          <?php 
            
            if($this->UserAuth->isLogged() ) { $logeado = 1;

                echo $this->Form->create(null, array('id' => 'form-finalizar'));

                  echo '<div id="envio_y_pago" class="tab-navegacion">';
                  echo $this->element('pedido/envio_y_pago');
                  echo '</div>';

                  echo '<div id="confirmar" class="tab-navegacion" style="display:none;">';
                  echo $this->element('pedido/confirmar');
                  echo '</div>';

                echo $this->Form->end();
          
            }else{

              echo $this->element('pedido/inicio');

            } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var direcciones = <?= json_encode($direcciones)?>;
  var formas_pago = <?= json_encode($FormasdePagos)?>;

  var total_a_pagar = <?= $resumen['total'] ?>;

  /* RELOJ ZONA HORARIA */
  function relojZonaHoraria() {
    var timezone = '<?= $ciudad->timezone ?>';
    var time = moment().tz(timezone).format('LTS');
    $('.reloj-zona-horaria').html(time);
  }
  relojZonaHoraria();
  setInterval(relojZonaHoraria, 1000);


  /* NAVEGACION */
  $('.navegacion-pedido').click(function(){
    var next = $(this).data('next');

    if(next == 'confirmar'){
      if(!actualizarConfirmacion()){
        return  false;
      }
    }


    $('.tab-navegacion').hide();
    $('#' + next).show();
  });

  function actualizarConfirmacion() {

    var return_ = true;

    var direccion_id = $('#envio-a').val();

    if(direccion_id == null){ $('#envio-a-error').show(); return_ = false; }

    $.each(direcciones, function( index, value ) {
      
      if(value.id == direccion_id){

        $.each(value, function( index, data ) {
          
          $('[data-datatext="' + index + '"]').text(data);

          if(index == 'direccion_tipo_id'){
            $('[data-datatext="' + index + '"]').text(value.direccion_tipo.nombre);
          }

        });

      } 

    });

    
    $('[data-datatext="referencias_direccion"]').text($('#referencias_direccion').val());

    if (!$('#sin_mensaje').is(':checked')) { 
      var mensaje = $('#mensaje-tarjeta').val();

      if(mensaje == ''){ $('#mensaje-tarjeta-error').show(); return_ = false; }

      $('[data-datatext="mensaje_tarjeta"]').text(mensaje);
    }else{
      $('[data-datatext="mensaje_tarjeta"]').text('Sin Mensaje');
    }

    if (!$('#anonimo').is(':checked')) { 
      var firma = $('#firma').val();

      if(firma == ''){ $('#firma-error').show(); return_ = false; }

      $('[data-datatext="firma"]').text(firma);
    }else{
      $('[data-datatext="firma"]').text('Anonimo');
    }

    if ($('#arreglo_funeral').is(':checked')) { 
      $('[data-datatext="arreglo_funeral"]').text('<?= __('Si') ?>');
    }else{
      $('[data-datatext="arreglo_funeral"]').text('<?= __('No') ?>');
    }

    if ($('#recordatorio').is(':checked')) {
      $('[data-datatext="recordatorio"]').text('<?= __('Si') ?>');
    }else{
      $('[data-datatext="recordatorio"]').text('<?= __('No') ?>');
    }

    var forma_pago_id = $('#forma-pago-id').val();

    $.each(formas_pago, function( index, value ) {
      
      if(value.id == forma_pago_id){
        
        $('[data-datatext="forma_pago"]').text(value.nombre);

      }

    });

    if(forma_pago_id == 1 || forma_pago_id == 2){ console.log('vpc_CardName-'+forma_pago_id); console.log($('#vpc_CardName-'+forma_pago_id).val());
      if($('#vpc_CardName-'+forma_pago_id).val() == '' || $('#vpc_CardNum-'+forma_pago_id).val() == '' || $('#vpc_month-'+forma_pago_id).val() == '' || $('#vpc_year-'+forma_pago_id).val() == '' || $('#vpc_CardSecurityCode-'+forma_pago_id).val() == ''){

        alert('Completa la información de tu tarjeta');
        return_ = false;
      }
    }


    return return_
  }


  /* FINALIZAR COMPRA */
  $('#btn-finalizar').click(function(){
     
      var carrito = '<?php echo count($carrito); ?>';
  
      if(carrito > 0)
      {
          
        $("#form-finalizar").submit();
          
      }else{
          alert('No hay productos en el carrito');
      }
  
  });
  
  $('.requerido').keyup(function(e){
  
          if($(this).val() == ''){
  
              $(this).addClass('obligatorio');
              valido = 0;
  
          }else{
  
              $(this).removeClass('obligatorio');
              $('#'+e.target.id+'-error').hide();
        
          }
  
  });
  

  /*  PAYPAL  */
  // Render the PayPal button

  paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'Ac-tkWJFwI4WJlcthW5tCDaiNWjRmmeMOewxM5Ks4_5NR6Kqgdms22oFST41aQU07zlEipfz95n0HP3t',
                production: '<insert production client id>'
            },

            style: {
                label: 'pay',
                branding: true, // optional
                size:  'responsive', // small | medium | large | responsive
                shape: 'rect',   // pill | rect
                color: 'blue'   // gold | blue | silve | black
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: total_a_pagar, currency: 'MXN' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    $('#paypal-data').val(JSON.stringify(data));
                    $("#form-finalizar").submit();
                }).catch(function(err) { console.log(err);
                    alert('Lo sentimos tu pago no se logro');
                });
            }

  }, '#paypal-button-container');
  
</script>
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>


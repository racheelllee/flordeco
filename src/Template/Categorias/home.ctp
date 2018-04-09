<?php
  $displayModal = false;
  if (!empty($this->request->session()->read('modalShow'))) { $displayModal = true; }
  
  ?>
<style type="text/css"> 
  .welcome-content { background-image: url('../img/alberca-font.jpg'); background-repeat: no-repeat; height: 450px;}
  .welcome-dialog { width: 60% !important; }
  .welcome-body > h1,p { text-align: center; color: white; font-family: Arial;}
  .welcome-body > h1 { font-size: 35px !important; font-weight: bold; margin-top: 50px; margin-bottom: 80px;}
  .welcome-body > p { font-size: 18px; margin-bottom: 10px; }
  .welcome-footer { border-top: transparent; }
  .welcome-footer > button { margin-top: 90px; position: absolute; right: 10px; }
</style>
<div id="content" class="home-content">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carousel slide" id="carousel1">
      <div class="carousel-inner" style="width:100%">
        <?php 
          $cont = 0;
          foreach ($banners as $banner) {
          if($banner['principal'] == 1 && $cont == 0){
              echo '<div class="item active">
                  <a target="'.((!empty($banner["url"]))? '_blank':'').'" href="'.((!empty($banner["url"]))? $banner["url"]:'#').'" ><img class="img-responsive" style="width: 100%;" src="/' . $banner['imagen'] . '"/></a>
              </div>';
              $cont = 1;
          }elseif ($banner['principal'] == 1) {
              echo '<div class="item">
              <a target="'.((!empty($banner["url"]))? '_blank':'').'" href="'.((!empty($banner["url"]))? $banner["url"]:'#').'"><img class="img-responsive" style="width: 100%;" src="/' . $banner['imagen'] . '"/></a>
              </div>';
          }
          }
          $cont = 0;
          ?>
      </div>
      <a data-slide="prev" href="#carousel1" class="left carousel-control">
      <span class="icon-prev"></span>
      </a>
      <a data-slide="next" href="#carousel1" class="right carousel-control">
      <span class="icon-next"></span>
      </a>
    </div>
  </div>
  <div class="row backgroundrosadoFdeco">
    <div class="container">
      <div class="col-md-12">
        <div class="col-md-6">
          <img class="blamsi" src="/img/inicia-aqui-tu-compra.png">
        </div>
        <div class="col-md-6" style="padding: 33px 0px;">
          <div class="col-md-4" style="padding: 0px;">
            <?=
              $this->Form->select(
                  'estado_id',
                  $estados,
                  [
                      'id' => 'estado-id',
                      'empty' => __('Estado'),
                      'class' => 'select-estado',
                  ]
              );
              ?>
          </div>
          <div class="col-md-4" style="padding: 0px;">
            <?=
              $this->Form->select(
                  'municipio_id',
                  [],
                  [
                      'id' => 'municipio-id',
                      'empty' => __('Ciudad'),
                      'class' => 'select-ciudad'
                  ]
              );
              ?>
          </div>
          <div class="col-md-4" style="padding: 0px;">
            <button class="btn button-ver-catalogo" id="go-to-city">Ver Catálogo</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $('#estado-id').on('change', function(ev){
        $('#estado-id').prop('disabled', 'disabled');
        $('#municipio-id').prop('disabled', 'disabled');
        $.get('/categorias/ciudades/' + $('#estado-id').val() + '.json', function(res){
            if (res) {
                $('#municipio-id').empty();
                $.each(JSON.parse(res), function(item, value){
                    $('#municipio-id').append($('<option>', { 
                        value: item,
                        text : value 
                    }));
                });
            }
        }).always(function(){
            $('#estado-id').removeAttr('disabled');
            $('#municipio-id').removeAttr('disabled');
        });
    });
    
    var slug = function(str) {
      str = str.replace(/^\s+|\s+$/g, ''); // trim
      str = str.toLowerCase();
      
      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to   = "aaaaeeeeiiiioooouuuunc------";
      for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }
    
      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes
    
        return str;
    };
    
    //$('#estado-id').trigger('change');
    $('#go-to-city').on('click', function(ev){
        if ( ! $('#municipio-id').val()) { return false; }
        $('#estado-id').prop('disabled', 'disabled');
        $('#municipio-id').prop('disabled', 'disabled');
        window.location = '/estado-de-' + slug($("#estado-id option:selected").text()) + '/ciudad/' + $('#municipio-id').val();
    });
  </script>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 montserrat">
        <?= $home_content->page_content ?>
        <!-- <h2 align="center" style="color:#bf6fb2;"><b>Flores y regalos más cerca de ti</b><h2>
          <h3 align="center" style="color:#bf6fb2;"><b>- Para todo tipo de ocasión -</b><h3>
          
          <div class="row" style="margin-top:20px;">
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/cumple.jpg">
                  </div> 
                  <div class="home-title">Cumpleaños</div> 
                  <div class="home-subtitle">Flores y globos especiales</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/amor.jpg">
                  </div> 
                  <div class="home-title">Amor</div> 
                  <div class="home-subtitle">Flores y globos especiales</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/aniversario.jpg">
                  </div> 
                  <div class="home-title">Aniversario</div> 
                  <div class="home-subtitle">Flores y globos especiales</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/aliviate.jpg">
                  </div> 
                  <div class="home-title">Aliviate Pronto</div> 
                  <div class="home-subtitle">Flores y globos especiales</div>           
          
              </div>
          </div>
          
          <hr>
          
          <div class="row" style="margin-top:20px;">
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/canasta.jpg">
                  </div> 
                  <div class="home-title">Canastas</div> 
                  <div class="home-subtitle">Florales / Frutales / Vino y Gourmet</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/candy.jpg">
                  </div> 
                  <div class="home-title">Candy Bag</div> 
                  <div class="home-subtitle">Chocolates / Tamarindos</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/globos.jpg">
                  </div> 
                  <div class="home-title">Globos</div> 
                  <div class="home-subtitle">Todo tipo de Ocasión</div>           
          
              </div>
          
              <div class="col-lg-3">
                  
                  <div class="div-home">
                      <img class="home-img" src="/img/home/regalos.jpg">
                  </div> 
                  <div class="home-title">Regalos</div> 
                  <div class="home-subtitle">Todo tipo de Ocasión</div>           
          
              </div>
          </div>
          
          <hr>
          
          <div class="row" style="margin-top:20px;">
              <div class="col-lg-4">
                  
                  <div class="">
                      <img class="home-img" src="/img/home/politicas-de-envio.jpg">
                  </div> 
                  <div class="home-title">Políticas de Envío</div> 
                  <div class="home-subtitle">Flordeco comienza desde el proceso de selección de flores, diseño y transporte de cada uno de los arreglos</div>           
          
              </div>
          
              <div class="col-lg-4">
                  
                  <div class="">
                      <img class="home-img" src="/img/home/cobertura.jpg">
                  </div> 
                  <div class="home-title">Cobertura</div> 
                  <div class="home-subtitle">Contamos con mas de 40 sucursales distribuidas en todo México, estando cada vez más cerca de ti</div>           
          
              </div>
          
              <div class="col-lg-4">
                  
                  <div class="">
                      <img class="home-img" src="/img/home/garantia.jpg">
                  </div> 
                  <div class="home-title">Garantía de Satisfacción</div> 
                  <div class="home-subtitle">Creemos que un cliente satisfecho es nuestra capital más importante, para ello nos esforzamos dia con dia</div>           
          
              </div>
          
          </div> -->
      </div>
    </div>
  </div>
  <img class="imgResp ca-divi" src="/img/franja-arreglos.png">
  <div class="row">
    <div class="container">
      <div class="col-md-12">
        <div class="col-md-4 col-sm-4">
          <img class="scribs" src="/img/newsletter.png">
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="combine">
            <input type="email" class="form-control input-left-home" placeholder="Correo Electrónico">
            <button class="btn button-ver-catalogo" id="go-to-city">SUSCRIBIRME</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal inmodal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg welcome-dialog">
    <div class="modal-content welcome-content">
      <div class="modal-body welcome-body">
        <h1>¡Bienvenido!</h1>
        <p>Gracias por registrarte, a partir de este momento puedes hacer válido nuestro cupón de promoción de un 5 % de descuento en tu primer compra en línea.</p>
        <p>Código: DBP17</p>
      </div>
      <div class="modal-footer welcome-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery.mb.YTPlayer.js"></script>
<?php if($displayModal == true): ?>
<script type="text/javascript">
  $(document).ready(function(){
      
      $(".player").mb_YTPlayer();
  
      $(".video-controls .pause").click(function() {
          $(".player").pauseYTP();
          $(".video-controls .pause").addClass('hidden');
          $(".video-controls .play").removeClass('hidden');
      });
  
      $(".video-controls .play").click(function() {
          $(".player").playYTP();
          $(".video-controls .play").addClass('hidden');
          $(".video-controls .pause").removeClass('hidden');
      });
      $(".video-controls .fullscreen").click(function() {
          $(".player").fullscreen();
      });
  
      $('#myModal').modal("show");
  
  });
</script>
<?php endif; ?>
<?php $this->request->session()->delete('modalShow');  ?>
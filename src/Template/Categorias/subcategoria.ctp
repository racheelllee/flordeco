<?php
  $actual_link = "$_SERVER[REQUEST_URI]";
  //debug($actual_link);
  $link_no_query = strtok($actual_link, "?");
  //$query = parse_url($actual_link, PHP_URL_QUERY);
  //$query_params = array('marca' => 'Alcatel');
  $query_params = $_GET;
  $scriptsproductos="";
  $uri = $_SERVER['REQUEST_URI'];
  ?>
<script type="text/javascript">
  var params = <?php
    if (sizeof($query_params) > 0){
        echo json_encode($query_params);
    }
    else{
        echo "{}";
    } ?>;

  var base_url = "<?php echo $link_no_query; ?>";
</script>
<script type="text/javascript" src="/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="/js/tmpl.js"></script>
<script type="text/javascript" src="/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="/js/draggable-0.1.js"></script>
<script src="/js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="/js/highlight.pack.js"></script>
<script src="/js/demo.js"></script>
<script src="/js/jquery.infinitescroll.min.js"></script>
<script type="text/javascript" src="/js/jquery.navgoco.js"></script>
<link href="/css/nouislider.min.css" rel="stylesheet">
<!-- In <head> -->
<!-- In <body> -->
<script src="/js/nouislider.min.js"></script>
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="listado_1">

          <?php if($categoria){ ?>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner_ciudad_categoria" style="<?= ($categoria->imagen_fondo)? 'background: url(/'.$categoria->imagen_fondo.');' : ''; ?>" >
                <?= $categoria->descripcion; ?>
              </div>
            </div>

          <?php }else{ ?>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner_ciudad_categoria" style="<?= ($ciudad->imagen_fondo)? 'background: url(/'.$ciudad->imagen_fondo.');' : ''; ?>" >
                <?= $ciudad->descripcion; ?>
              </div>
            </div>
          <?php } ?>
          <hr>
          <?= $this->fetch('lista') ?>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="mdl">
  <div class="boletin">
    <img src="/img/mail-icon_1x.png">
    <button type="button" class="close mdl-cls"><span aria-hidden="true">&times;</span></button>
    <div id="mc_embed_signup">

    </div>
  </div>
  <!--End mc_embed_signup-->
</div>

<script type="text/javascript">
  $( ".oreja-boletin" ).click(function() {
      $(".mdl").fadeIn('slow', function(){
        $(".boletin").slideDown();
      });


  });

  $( "#mc-embedded-subscribe, .mdl-cls" ).click(function() {
    setTimeout( function(){
      $(".boletin").slideUp('slow', function(){
        $(".mdl").fadeOut();
      });
    }  , 300 );
  });


      $(document).ready(function() {


          // Initialize navgoco with default options

          $("#demo1").navgoco({
          caretHtml: '',
          accordion: false,
          openClass: 'open',
          save: true,
          cookie: {
              name: 'navgoco',
              expires: false,
              path: '/'
          },
          slide: {
              duration: 400,
              easing: 'swing'
          },
          // Add Active class to clicked menu item
          onClickAfter: active_menu_cb,
      });

          $("#nav_2 a.menu_res").click(function (e) {
              e.preventDefault();
              $("#nav_2 ul").slideToggle(300);
              $("#nav_2 ul").addClass("done");
          });


          var $container = $('#posts-list');

          $container.infinitescroll({
            navSelector  : '.next',    // selector for the paged navigation
            nextSelector : '.next a',  // selector for the NEXT link (to page 2)
            itemSelector : '.post-item',     // selector for all items you'll retrieve
            debug         : true,
            dataType      : 'html',
            loading: {
                finishedMsg: '',
                img: '/img/350.GIF'
              }
            }
          );

      });

      var priceSlider = document.getElementById('priceSlider');

      var maximo = '<?= isset($precios["max"]) ? $precios["max"] : 0 ; ?>';
      var minimo = '<?= isset($precios["min"]) ? $precios["min"] : 0 ; ?>';

      var maximo_global = '<?= isset($precios_globales["max"]) ? : 0 ?>';
      var minimo_global = '<?= isset($precios_globales["min"]) ? : 0 ?>';

      noUiSlider.create(priceSlider, {
          start: [ parseFloat(minimo), parseFloat(maximo)],
          connect: true,
          range: {
              'min': parseFloat(minimo_global),
              'max': parseFloat(maximo_global)
          }
      });

      var min_price = document.getElementById('min_price');
      var max_price = document.getElementById('max_price');

      priceSlider.noUiSlider.on('update', function( values, handle ) {

          var value = values[handle];

          if ( handle ) {
              max_price.value = value;
          }else {
              min_price.value = value;
          }
      });


      min_price.addEventListener('change', function(){
          priceSlider.noUiSlider.set([this.value, null]);
      });

      max_price.addEventListener('change', function(){
          priceSlider.noUiSlider.set([null, this.value]);

      });

      priceSlider.noUiSlider.on('change', function(values, handle){
          filterByPrice(values[0], values[1]);
      //console.log("changed"+values[1]);
      });

      priceSlider.noUiSlider.on('set', function(values, handle){
          filterByPrice(values[0], values[1]);
      //console.log("changed"+values[1]);
      });

    <?php
        $uri = $_SERVER['REQUEST_URI'];
    	$uris = explode('/', $uri);
    	$prod_url = (isset($uris[2])) ? $uris[2] : '';
    ?>

      function filterByPrice(price_min, price_max){
          //console.log(e.textContent);
          params['precio'] = price_min+"-"+price_max;
          window.location.href = base_url +'?'+$.param(params);
      }
      $(document).ready(function(){
     $("#min_price").parseNumber({format:"#,###.00", locale:"us"});
     $("#min_price").formatNumber({format:"#,###.00", locale:"us"});
     $("#max_price").parseNumber({format:"#,###.00", locale:"us"});
     $("#max_price").formatNumber({format:"#,###.00", locale:"us"});
      });

      /*
      function filterByBrand(e){
          console.log(e.textContent);
          params['marca'] = e.textContent;
          window.location.href = base_url +'?'+$.param(params);
      }*/


      $(document).on({click: function(e){
              //e.preventDefault();
              var _this = $(this);
              var nombre = _this.data('nombre');
              var valor = _this.data('valor');
              var id = _this.data('id');
              var idNombre = _this.data('idnombre');

              if(nombre == 'marca'){
                  params[nombre] = valor;
                   window.location.href = base_url +'?'+$.param(params);
              }
              else{
                  params['art'+idNombre] = id;
                  window.location.href = base_url +'?'+$.param(params);
              }

          }}, '.filtro');

      $(document).on({click: function(e){
              //e.preventDefault();
              var _this = $(this);
              var url = _this.data('url');

              window.location.href = base_url +'?'+$.param(url);

          }}, '.todas');

      $(document).on({click: function(e){
              //e.preventDefault();
              var _this = $(this);
              var nombre = _this.data('nombre');
              var valor = _this.data('valor');

                  params[nombre] = valor;
                   window.location.href = base_url +'?'+$.param(params);

          }}, '.odn');


  <?php echo $scriptsproductos; ?>
</script>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $this->fetch('title') ?> | FlorDeco</title>



  <meta name="keywords" content="tienda en linea de mexico, tienda en linea monterrey, tienda en linea computadoras monterrey, tienda en linea computadoras mexico, tienda en linea aparatos gym, tienda en linea apareatos electronicos monterrey, tienda en linea aparatos electronicos mexico, tienda en linea relojes, tienda en linea bicicletas, tienda en linea perfumes, tienda en linea electrodomesticos, venta de computadoras, aparatos electronicos, Linea Blanca, aparatos para gimnasio, fragancias, perfumes, apple, televisiones, bicicletas, tecnologia y computo, relojes, electrodomesticos tienda en linea tienda online">
  <meta name="rights" content="www.flordeco.com">
  <meta name="description" content="FlorDeco, la tienda en línea mexicana que te ofrece miles de artículos para que compres rápido y fácil desde donde te encuentres. Tu tiempo es lo mas valioso.">
  <meta name="author" content="www.flordeco.com">
  <meta name="DC.Creator" content="FlorDeco Mexico">
  <meta name="subject" content="Retail">
  <meta name="Language" content="Spanish">
  <meta http-equiv="Expires" content="never">
  <meta http-equiv="CACHE-CONTROL" content="Public">
  <meta name="copyright" content="FlorDeco">
  <meta name="Designer" content="FlorDeco">
  <meta name="Publisher" content="Tienda Online, FlorDeco">
  <meta name="Revisit-After" content="1 day">
  <meta name="distribution" content="Global">
  <meta name="city" content="Ciudad de Mexico">
  <meta name="country" content="Mexico">
  <meta http-equiv="content-language" content="es-mx">
  <meta name="abstract" content="Tienda departamental">
  <meta name="rating" content="General">
  <meta name="classification" content="Online Store">

  

        <?php
            echo $this->Html->meta('icon');
            /* Bootstrap CSS */
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');

        ?>

<link rel="stylesheet" href="/fonts/fonts.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/bootstrap-theme.css">
<link rel="stylesheet" href="/css/owl.carousel.css">
<link rel="stylesheet" href="/css/owl.theme.css">
<link rel="stylesheet" href="/css/owl.transitions.css">
<link rel="stylesheet" href="/css/style_front.css">
<link rel="stylesheet" href="/css/responsive.css">


<script type="text/javascript" src="/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/owl.carousel.js"></script>
<script src="/js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="/js/jquery.sticky.js" type="text/javascript"></script>
<?= $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN); ?>



<?= $this->Html->css('/css/plugins/fullcalendar/fullcalendar.css?q='.QRDN); ?>
<?= $this->Html->script('/js/plugins/fullcalendar/moment.min.js?q='.QRDN); ?>
<?= $this->Html->script('/js/plugins/fullcalendar/moment-timezone.min.js?q='.QRDN); ?>
<?= $this->Html->script('/js/plugins/fullcalendar/moment-timezone-with-data.min.js?q='.QRDN); ?>
<?= $this->Html->script('/js/plugins/fullcalendar/fullcalendar.min.js?q='.QRDN); ?>
<?= $this->Html->script('/js/plugins/fullcalendar/lang-all.js?q='.QRDN); ?>

<?= $this->Html->script('/js/plugins/validate/jquery.validate.min.js?q='.QRDN); ?>


<script language="javascript">
  var urlForJs="<?php echo SITE_URL ?>";
</script>

<script type="text/javascript">

    $(document).ready(function() {

$(document).ready(function() {
    $('.hover').bind('touchstart touchend', function(e) {
        e.preventDefault();
        $(this).toggleClass('hover_effect');
    });
});
      
     
      var owl = $("#owl-demo");
     
      owl.owlCarousel({
          items : 5, //10 items above 1000px browser width
          itemsDesktop : [1200,5], //5 items between 1000px and 901px
          itemsDesktopSmall : [1000,4], // betweem 900px and 601px
          itemsTablet: [600,3], //2 items between 600 and 0
          itemsMobile : [480,2], // itemsMobile disabled - inherit from itemsTablet option
      pagination: false,
      });
      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      })
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
         
    $("#nav_2 a.menu_res").click(function (e) {
      e.preventDefault();
      $("#nav_2 ul").slideToggle(300);
      $("#nav_2 ul").addClass("done");
    });


   $("#nav").sticky({topSpacing:0});
   $(".bannerder").sticky({topSpacing:120});
   $(".bannerizq").sticky({topSpacing:120});
      $(".floating").sticky({topSpacing:120});




    });

    function numberFormat(n,moneda){
            if (typeof(moneda)==='undefined') moneda = '';
            var f =Math.floor(n);
            if((f - n) > .5){
                n=f+1;
            }else{
                n=f;
            }

            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")+moneda;
        }


    function getpromoproducto(url,moneda){
            
            if (typeof(moneda)==='undefined') moneda = '';
            $.ajax({
    
                type: 'GET',
                url: '<?php echo $this->Url->build(["controller" => "productos" , "action" => "promociones"]); ?>/'+url,
                dataType: 'json',
                success: function(data){
                    var oferta=0;
                    var precio=data['producto']['precio'];
                    jQuery.each(data['promociones'], function(i, promo) {
                        precio=promo['precio'];
                        oferta=1;
                        if(i==0){
                            $("#promosDiv_"+url).append("<div class='price_1'>Precio Regular: <span> $ "+ numberFormat(promo['precio']) +" "+moneda+"</span></div>");    

                        }else{
                            $("#promosDiv_"+url).append("<div class='price_1'>Oferta: <span>$ "+ numberFormat(promo['precio']) +" "+moneda+"</span></div>");    
                        }
                        
                        if(i>0){
                            $("#superofertaDiv_"+url).append("Super Oferta");
                        }   
                               
                    }); 

                    $("#precioDiv_"+url).html("$ "+ numberFormat(data['producto']['precio'],moneda));

                    if(oferta ==1){
                        $("#ofertaImg_"+url).attr("src","/img/oferta_white.png");
                        //alert('oferta: '+$("#ofertaImg_"+url).attr("src"));
                    }
                }
            });
        }



</script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    </head>

    <body>
        <!-- Contenido -->
        <?php echo $this->element('header'); ?>
        <?php //echo $this->fetch('tb_flash') ?>
        <?php echo $this->fetch('content'); ?>
        <!-- Contenido -->
        <?php echo $this->element('footer'); ?>



<script>


    $('.btn-carrito').click(function(e){
            e.preventDefault();
            var _this = $(this)
            var id_producto = _this.data('id');
            var cantidad = 1;
            var atributos = '';
            var url_producto = _this.data('url');

            $.ajax({
    
                type: 'GET',
                url: '/Productos/promociones/'+url_producto,
                dataType: 'json',
                success: function(data){ 

                    var ahorro = data['producto']['ahorro'];

                    $.ajax({
    
                        type: 'POST',
                        url: '<?php echo $this->Url->build(["controller" => "Productos","action" => "agregar_carrito"]); ?>',
                        data: {
                            id_producto:id_producto,
                            cantidad:cantidad,
                            atributos:atributos,
                            ahorro:ahorro
                        },
                        dataType: 'json',
                        success: function(data){

                            location.href = data;
                    
                        }
                    })



                }
            })

            
        });
    </script>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $this->fetch('title') ?></title>

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
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/owl.carousel.js"></script>

<script type="text/javascript">
    

    $(document).ready(function() {
     
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
    });


</script>

    </head>

    <body>
        <!-- Contenido -->
        <?php echo $this->element('headercarrito'); ?>
        <?php //echo $this->fetch('tb_flash') ?>
        <?php echo $this->fetch('content'); ?>
        <!-- Contenido -->
        <?php echo $this->element('footercarrito'); ?>
        
    </body>
</html>

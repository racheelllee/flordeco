 <?php 
        $actual_link = "$_SERVER[REQUEST_URI]";
        $link_no_query = strtok($actual_link, "?");
        //$query = parse_url($actual_link, PHP_URL_QUERY);
        //$query_params = array('marca' => 'Alcatel');
        $query_params = $_GET;
        $scriptsproductos="";
?>
<script type="text/javascript">
    var params = <?php
                    if (sizeof($query_params) > 0){
                        echo json_encode($query_params);
                    }
                    else{
                        echo "{}";
                    }?>;

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
                <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
                    <div id="sidebar">
                        <?php $i = 0; ?>
                     
                
                        <h3> Marca</h3>
                        <ul>
                            <li><a href="/productos/buscar/<?= $this->request->data['data']['Producto']['buscar'] ?>" class="<?php if(is_null($marca_id)){ echo 'active'; }?>">Todas</a></li>
                            <?php foreach($marcas as $marca => $value): ?>

                                <li><a onclick="filterByBrand(this)" class="<?php if($marca_id == $value){ echo 'active'; }?> marca" id="<?= $marca ?>" href="/productos/buscar/<?= $this->request->data['data']['Producto']['buscar'] ?>/<?= $value ?>"><?= $marca ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        
                       

                    
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    
                   
                    <div id="listado_1">
                    <div style="text-align: center; width: 100%;">  Vista de Productos: 
                <span class="glyphicon glyphicon-th-large" style="color: #6b6b6b;"></span>
               <a href="/productos/buscarlista/<?= $this->request->data['data']['Producto']['buscar'] ?>/<?= $marca_id;?>"> <span class="glyphicon glyphicon-th-list" style="color: #bcbcbc;"></span></a>
                </div>
                  <hr>
                            
                                   <?= $this->fetch('lista') ?>
                    
                    
                  
                    <div class="detailbox">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                               
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                             
                            </div>
                        </div>
                    </div>
                    
                   
                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div></div>
            </div>
        </div>
    </div>


<?php echo $this->element('modal-cotizar', ['direcciones_envio'=>$direcciones_envio]) ?>

<script type="text/javascript">
    

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

      <?php $uri = $_SERVER['REQUEST_URI']; 
        $uris = explode('/', $uri);
        $prod_url = $uris[2];
    ?>

 
<?php echo $scriptsproductos; ?>
</script>
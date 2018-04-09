<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $this->fetch('title') ?></title>

    <script language="javascript">
        var urlForJs="<?php echo SITE_URL ?>";
    </script>
    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <?php
        echo $this->Html->meta('icon');
        /* Bootstrap CSS */
        echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min.css?q='.QRDN);
        
        /* Usermgmt Plugin CSS */
        echo $this->Html->css('/usermgmt/css/umstyle.css?q='.QRDN);
        
        /* Bootstrap Datepicker is taken from https://github.com/eternicode/bootstrap-datepicker */
        echo $this->Html->css('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css?q='.QRDN);

        /* Bootstrap Datepicker is taken from https://github.com/smalot/bootstrap-datetimepicker */
        echo $this->Html->css('/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css?q='.QRDN);
        
        /* Chosen is taken from https://github.com/harvesthq/chosen/releases/ */
        echo $this->Html->css('/plugins/chosen/chosen.min.css?q='.QRDN);

        /* Jquery latest version taken from http://jquery.com */
        //echo $this->Html->script('/plugins/jquery-1.11.2.min.js');
        
        /* Bootstrap JS */
        //echo $this->Html->script('/plugins/bootstrap/js/bootstrap.min.js?q='.QRDN);

        /* Bootstrap Datepicker is taken from https://github.com/eternicode/bootstrap-datepicker */
        echo $this->Html->script('/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?q='.QRDN);

        /* Bootstrap Datepicker is taken from https://github.com/smalot/bootstrap-datetimepicker */
        echo $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js?q='.QRDN);
        
        /* Bootstrap Typeahead is taken from https://github.com/biggora/bootstrap-ajax-typeahead */
        echo $this->Html->script('/plugins/bootstrap-ajax-typeahead/js/bootstrap-typeahead.min.js?q='.QRDN);
        
        /* Chosen is taken from https://github.com/harvesthq/chosen/releases/ */
        echo $this->Html->script('/plugins/chosen/chosen.jquery.min.js?q='.QRDN);

        /* Usermgmt Plugin JS */
        echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);
        echo $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN);

        echo $this->Html->script('/usermgmt/js/chosen/chosen.ajaxaddition.jquery.js?q='.QRDN);


        echo $this->Html->script('/plugins/tableHeadFixer.js?q='.QRDN);


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

    <!-- <link href="/font-awesome/css/font-awesome.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.6/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/font-awesome/dataTables.fontAwesome.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
    <!-- Related to dataTables -->
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/chosen.min.css" rel="stylesheet">


    <!-- Local style only for demo purpose -->
    <style>
        .directive-list {
            list-style: none;
        }
        .directive-list li {
            background: #f3f3f4;
            padding: 10px 20px;
            margin: 4px;
        }
    </style>
        
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    <script src="/js/helper.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
      <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js
"></script>
    <script type="text/javascript" src="/js/typeahead.bundle.js"></script>



</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
<?php
use Cake\Utility\Inflector;
$actionUrl = Inflector::camelize($this->request['controller']).'/'.$this->request['action'];
$activeClass = 'active';
$inactiveClass = '';

$usuario=$this->UserAuth->getUser(); 
?>
                    <div class="dropdown profile-element"> <span>
                            <img class="img-circle" alt="<?php echo h($usuario['User']['first_name'].' '.$usuario['User']['last_name']); ?>" src="<?php echo $this->Image->resize('library/'.IMG_DIR, $usuario['User']['photo'], 80, null, true);?>">
                            
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $usuario['User']['first_name']." ".$usuario['User']['last_name'];?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $usuario['User']['email'];?><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <?php 
                            /*if($this->UserAuth->HP('Users', 'myprofile', 'Usermgmt')) {
                                echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Mi perfil'), ['controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'Usermgmt'])."</li>";
                            }
                            if($this->UserAuth->HP('Users', 'editProfile', 'Usermgmt')) {
                                echo "<li class='".(($actionUrl=='Users/editProfile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Editar Perfil'), ['controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'Usermgmt'])."</li>";
                            }
                            if($this->UserAuth->HP('Users', 'changePassword', 'Usermgmt')) {
                                echo "<li class='".(($actionUrl=='Users/changePassword') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Cambiar Contraseña'), ['controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'Usermgmt'])."</li>";
                            }
                            if($this->UserAuth->HP('Users', 'deleteAccount', 'Usermgmt') && ALLOW_DELETE_ACCOUNT && !$this->UserAuth->isAdmin()) {
                                echo "<li>".$this->Form->postlink(__('Delete Account'), ['controller'=>'Users', 'action'=>'deleteAccount', 'plugin'=>'Usermgmt'], ['escape'=>false, 'confirm'=>__('Are you sure you want to delete your account?')])."</li>";
                            }*/
                        ?>
                            <li class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        WP
                    </div>
                </li>
                
            
            <?php if($this->UserAuth->isLogged()) {  
                echo $this->element('menu');
              #  echo $this->element('Usermgmt.dashboard');
    
             } ?>
             </ul>
            

        </div>
    </nav>

        <div id="page-wrapper" class="white-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"> </span>
                </li>
                <li>
                    <a href="/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <!-- Contenido -->
            <?php echo $this->element('Usermgmt.message'); ?>
            <?php //echo $this->fetch('tb_flash') ?>
            <?php echo $this->fetch('content'); ?>
            <!-- Contenido -->
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
    });

    $('.datetimepicker').datetimepicker({
        format: 'HH:ii',
        autoclose: true,
        startView: 1,
        maxView: 1,
        language:"fr",
        pickDate: false
    });

    $(".um-panel-header").addClass("ibox-title").removeClass("um-panel-header");
    $(".um-panel-title-right").addClass("ibox-tools col-md-2 pull-right").removeClass("um-panel-title-right");
    $(".um-panel-title").addClass("h3").removeClass("um-panel-title");
    $(".alert-error").addClass("alert-danger").removeClass("alert-error");


    function number_format(number, decimals, decPoint, thousandsSep){
    decimals = decimals || 0;
    number = parseFloat(number);
 
    if(!decPoint || !thousandsSep){
        decPoint = '.';
        thousandsSep = ',';
    }
 
    var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
    var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
    var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
    var formattedNumber = "";
 
    while(numbersString.length > 3){
        formattedNumber += thousandsSep + numbersString.slice(-3)
        numbersString = numbersString.slice(0,-3);
    }
 
    return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
    }

    function replaceAll(text, busca, reemplaza){
    while (text.toString().indexOf(busca) != -1)
    text = text.toString().replace(busca,reemplaza);
    return text;
    }

</script>



</body>


</html>

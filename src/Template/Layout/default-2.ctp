<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?=  $this->Html->css('bootstrap.min.css?q='.QRDN) ?>
    <?=  $this->Html->css('font-awesome/css/font-awesome.css?q='.QRDN) ?>
    <?=  $this->Html->css('plugins/toastr/toastr.min.css?q='.QRDN) ?>
    <?=  $this->Html->css('animate.css?q='.QRDN) ?>
   
    <?= $this->Html->css('umstyle.css?q='.QRDN); ?>
    <?=  $this->Html->css('style.css?q='.QRDN) ?>
    <?= $this->Html->css('plugins/chosen/chosen.css?q='.QRDN); ?>

    <?= $this->Html->css('/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css?q='.QRDN); ?>
    <?= $this->Html->css('/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css?q='.QRDN); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?=  $this->Html->script('jquery-2.1.1.js?q='.QRDN) ?>
    

    <?= $this->Html->script('plugins/chosen/chosen.jquery.js?q='.QRDN) ?>
    <?= $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js?q='.QRDN); ?>
    <?= $this->Html->script('/plugins/bootstrap-datepicker/bootstrap-datepicker.js?q='.QRDN); ?>
  
    <?= $this->Html->script('umscript.js?q='.QRDN); ?>
    <?= $this->Html->script('ajaxValidation.js?q='.QRDN); ?>
    <?= $this->Html->script('chosen.ajaxaddition.jquery.js?q='.QRDN); ?>
    <?= $this->Html->script('/plugins/bootstrap-ajax-typeahead/js/bootstrap-typeahead.min.js?q='.QRDN); ?>
    

    <script language="javascript">
        var urlForJs="<?php echo SITE_URL ?>";
    </script>

     
      
</head>
<body>
        
    
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    
                        
                    <?php
                    if($this->UserAuth->isLogged()) {
                      
                        echo $this->element("navigation");
                    }
                    ?>

                    
                </ul>

            </div>
        </nav>



        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
            
                        <li>
                            <a href="/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

           


                
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                  
                        <?php echo $this->element('Usermgmt.message'); ?>
                        <?= $this->fetch("content") ?>

                  
                
                </div>
                
            </div>
        </div>

        <div class="footer">
                   
                    <div>
                        <strong>Copyright</strong> Webpoint &copy; 2014-<?= date("Y") ?>
                    </div>
        </div>

        </div>



    </div>





<?=  $this->Html->script('bootstrap.min.js?q='.QRDN) ?>
<?=  $this->Html->script('plugins/metisMenu/jquery.metisMenu.js?q='.QRDN) ?>
<?=  $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js?q='.QRDN) ?>


<?=  $this->Html->script('plugins/pace/pace.min.js?q='.QRDN) ?>


<?=  $this->Html->script('plugins/toastr/toastr.min.js?q='.QRDN) ?>

<?=  $this->Html->script('inspinia.js?q='.QRDN) ?>



<script type="text/javascript">
$(document).ready(function(){

$(".panel-primary").addClass("ibox").removeClass("panel-primary").removeClass('panel');

$(".panel-heading").addClass("ibox-title").removeClass("panel-heading");


$(".panel-body").addClass("ibox-content").removeClass("panel-body");


$(".panel-title-right a").addClass("btn").addClass("btn-primary").removeClass("btn-default");
$(".panel-title-right").addClass("ibox-tools").removeClass("panel-title-right");

});
    
</script>



</body>
</html>



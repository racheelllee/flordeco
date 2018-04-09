<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
//$this->start('tb_sidebar');
?>

<div class="page-padding">
  <div class="row" id="producto_ralacionado">
    <div class="col-md-12 col-xs-12 col-lg-12">

      <br><br>

    
        <div class="row">
            <div class="col-md-2 col-xs-2 col-lg-2">
                <b>CÓDIGO</b>
            </div>
            
            <div class="col-md-4 col-xs-4 col-lg-4">
                <b>Producto</b>
            </div>
    
        </div>

        <legend></legend> 


        <?php foreach ($productos_relacionados as $producto_ralacionado) { ?>
        <div class="row">
            <div class="col-md-2 col-xs-2 col-lg-2">
                <?php echo $producto_ralacionado->complemento->sku; ?>
            </div>
        
            <div class="col-md-4 col-xs-4 col-lg-4">
                <b><?php echo $producto_ralacionado->complemento->nombre; ?></b>
            </div>

            <div class="col-md-2 col-xs-2 col-lg-2">
                <?= $this->Html->link('<i class="fa fa-trash"></i>','#producto_ralacionado',['data-id'=>$producto_ralacionado->id,'title' => __('Eliminar Producto Relacionado'), 'escape' => false, 'class'=>'btn btn-primary eliminar_producto_relacionado']) ?>
            </div>
        </div>
        <br>
        <?php } ?>
    

    
    </div>

  </div>
  <br><br>





</div>
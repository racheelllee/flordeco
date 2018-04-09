<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="height:70px;">
                    <div class="col-md-4">
            <h2><?php echo __('Promociones'); ?></h2>
        </div> 
                    <div class="ibox-tools col-md-4 pull-right">
           <?= $this->Html->link(__('Agregar Promoción',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
        </div>
                </div><br>
    <div class="ibox-content">
        <!-- Inicia element  -->
        <?php echo $this->element('all_promociones'); ?> 
      
<!-- termina element -->
</div>
</div>

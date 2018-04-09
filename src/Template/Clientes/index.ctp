<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
            <h2><?php echo __('Clientes'); ?></h2>
        </div>
                    <div class="ibox-tools col-md-4 pull-right">
           <?= $this->Html->link(__('Agregar Cliente',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
        </div>
                </div>
    <div class="ibox-content">
       <?php echo $this->element('all_clientes'); ?> 


</div>
</div>

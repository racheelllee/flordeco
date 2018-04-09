<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-4">
                            <h2><?php echo __('Productos'); ?></h2>
                        </div>
                        <div class="ibox-tools col-md-4 pull-right">
                            <?= $this->Html->link(__('Agregar Producto',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
                        </div>
                    </div>
                    <br>
                    <div class="ibox-content">
                        <?php echo $this->element('all_productos'); ?>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>/*
    $('#activo').change(function () {

        $("#producto_activo").submit();
            
    });*/
</script>
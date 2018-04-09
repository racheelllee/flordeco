<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-12">
                            <h2><?php echo __('Agregar Día Bloqueado'); ?></h2>
                        </div>
                        <div class="ibox-tools col-md-4 pull-right">
                            
                        </div>
                    </div>
                    <br>
                    <div class="ibox-content">
                       
                        <?= $this->Form->create(null, []); ?>
                            <?php echo $this->Form->input('fecha', ['type'=>'text', 'label'=>'Selecciona una Fecha', 'div'=>false, 'class'=>'form-control datepicker']);?>
                            <?= $this->Form->button('Agregar', ['class'=>'btn btn-primary pull-right', 'escape'=>false, 'style'=>'margin-left:10px;']) ?>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
</div>

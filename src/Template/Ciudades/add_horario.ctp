<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-12">
                            <h2><?php echo __('Agregar Horario'); ?></h2>
                        </div>
                        <div class="ibox-tools col-md-4 pull-right">
                            
                        </div>
                    </div>
                    <br>
                    <div class="ibox-content">
                       
                        <?= $this->Form->create(null, []); ?>

                            <?php echo $this->Form->input('titulo', ['type'=>'text', 'label'=>'Nombre', 'div'=>false, 'class'=>'form-control']);?>

                            <?php echo $this->Form->input('ciudad_horario_entrega_tipo_id', ['label'=>'Tipo Horario', 'div'=>false, 'class'=>'form-control', 'options'=>$horarios_tipos]);?>

                            <?php echo $this->Form->input('fecha', ['type'=>'text', 'label'=>'Selecciona una Fecha (solo aplica a el tipo "solo el día")', 'div'=>false, 'class'=>'form-control datepicker']);?>

                            <?php echo $this->Form->input('desde', ['type'=>'text', 'label'=>'Horario desde', 'div'=>false, 'class'=>'form-control datetimepicker']);?>

                            <?php echo $this->Form->input('hasta', ['type'=>'text', 'label'=>'Horario hasta', 'div'=>false, 'class'=>'form-control datetimepicker']);?>

                            <?php echo $this->Form->input('disponible_hasta', ['type'=>'text', 'label'=>'Horario disponible hasta', 'div'=>false, 'class'=>'form-control datetimepicker']);?>



                            <?= $this->Form->button('Agregar', ['class'=>'btn btn-primary pull-right', 'escape'=>false, 'style'=>'margin-left:10px;']) ?>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
    });

    $('.datetimepicker').datetimepicker({
        format: 'hh:ii',
        autoclose: true,
        startView: 1,
        maxView: 1,
        language:"fr",
        pickDate: false
    });
</script>
<div class="row">
    <div class="col-md-12" style="padding: 20px;">
        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('nombre', [
                    'required' => 'required',
                    'class'=>'form-control', 
                    'label'=>'Nombre', 
                    'div'=>false, 
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('estado_id', [
                    'options' => $estados,
                    'required' => 'required',
                    'class'=>'form-control', 
                    'label'=>'Estado', 
                    'div'=>false,
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('ciudad_id', [
                    'options' => $ciudades,
                    'required' => 'required',
                    'class'=>'form-control', 
                    'label'=>'Ciudad', 
                    'div'=>false,
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('banner_id', [
                    'label'=>'Banner', 
                    'class'=>'form-control',
                    'empty' => 'Seleccione',
                    'options' => $banners
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('posicion', [
                    'type' => 'text',
                    'label'=>'Posición', 
                    'class'=>'form-control'
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('num_columna', [
                    'type' => 'text',
                    'label'=>'Número de Columna', 
                    'class'=>'form-control'
                ]) ?>
            </div>
        </div>

        <?= $this->Tinymce->textarea('detalles',['type'=>'textarea', 'label'=>false, 'div'=>false, 'style'=>'height:300px', 'class'=>'form-control'], ['language'=>'en'], 'umcode'); ?>

    </div>
</div>
<div class="modal-footer">
  <div class="col-lg-offset-3 col-md-6" style="text-align: center;">
        <a href="/sucursales">
            <button type="button" class="btn btn-default"><?= __('Cancelar') ?></button>
        </a>
    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-span btn-md w-btnAddUsers', 'type' => 'submit']) ?>
  </div>
</div>

<script type="text/javascript">
    var estadoId = '<?= $sucursale->estado_id ?>';
    var municipioId = '<?= $sucursale->municipio_id ?>';
</script>
<script type="text/javascript" src="/js/utils.js"></script>
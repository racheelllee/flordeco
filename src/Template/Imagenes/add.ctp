<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?= $this->Form->create($imagen, ['type' => 'file']); ?>
<div class="row">
    <div class="col-lg-12">
        <label class="control-label">Agregar Imagen</label>
        <?php
            echo $this->Form->input('producto_id', ['type'=>'hidden','value' => $producto_id]);
            echo $this->Form->input('nombre',array('name' => 'imagenes[]', 'type'=>'file', 'label'=>false, 'multiple' => true, 'class'=>'file', 'required'=>false));
        ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      
            <div class="col-xs-6">
                <a href="/imagenes/index/<?= $producto_id?>" class="btn btn-warning"><i class="fa fa-return"></i> Cancelar</a>
            </div>
            <div class="col-xs-6 pull-right">
                <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-success pull-right']) ?>
            </div>
     
    </div>
</div>

<?= $this->Form->end() ?>
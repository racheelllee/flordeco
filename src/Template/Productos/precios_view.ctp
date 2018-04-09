<div id="precioShow">
<div class="col-md-12 col-xs-12 col-lg-12" style="text-align:right;">

          
           <a  href="#" onclick="showEdit();" class="btn btn-primary pull-right">Editar Precio</a>

</div>
<div class="row"> 
            <?php setlocale(LC_MONETARY, 'en_US.UTF-8');?>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Proveedor') ?></h4>
            <p><?= $producto->proveedor->nombre; ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Costo') ?></h4>
            <p><?= money_format('%.2n', $producto->costo) ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Margen') ?></h4>
            <p><?= $this->Number->format($producto->margen) ?>%</p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2"> 
            <h4><?= __('Precio') ?></h4>
            <p><?= money_format('%.2n', $producto->precio) ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2"> 
            <h4><?= __('Envio gratis') ?></h4>
            <p><?= $sino[$producto->envio_gratis]; ?></p>
            </div>
            <div class="col-md-2 col-xs-2 col-lg-2">
            <h4><?= __('Actualizacion') ?></h4>
            <p><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></p>
            </div>
          
</div>

</div>

<div id="precioEdit" style="display: none;">
<div class="page-padding">
    <?= $this->Form->create($producto); ?>
    <fieldset>
        <legend><?= $producto->nombre ?></legend>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?php
        echo $this->Form->input('producto_id', ['type'=>'hidden','value' => $producto->id]);
        echo $this->Form->input('proveedor_id', ['options' => $proveedores]);

        ?>
        </div>     
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?php echo $this->Form->input('envio_gratis'); ?>
        </div>
    </div>   
    <div class="row">
           
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
            <?= $this->Form->input('costo',['label'=>'Costo']); ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
            <?= $this->Form->input('margen',['label'=>'Margen']) ?>
        </div>
        
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
            <?php echo $this->Form->input('precio',['label'=>'Precio','readonly']);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?= $this->Form->button(__('Cancelar'),['type'=>'reset','onclick'=>'hideEdit();','class'=>"btn btn-warning"]) ?>
        </div>     
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <?= $this->Form->button(__('Guardar'),['class'=>"btn btn-primary pull-right"]) ?>
        </div>
    </div> 

<?php
$user = $this->UserAuth->getUser();
echo $this->Form->input('usuario_id', ['type'=>'hidden','value' => $user['User']['id']]);
?>
    </fieldset>
    
    <?= $this->Form->end() ?>
</div>
</div>

<script type="text/javascript">
 
$('#costo').change(function () {
    cambiaPrecio();
});

$('#margen').change(function () {
    cambiaPrecio();
});

function cambiaPrecio(){
    if($('#costo').val() >= 0 && $('#margen').val() >= 0){
        var costo = $('#costo').val()*1;
        var margen= ($('#margen').val()/100)*costo*1;
        $('#precio').val(costo+margen);
    }
}

function showEdit(){
    $('#precioShow').hide();
    $('#precioEdit').show();
}

function hideEdit(){
    $('#precioShow').show();
    $('#precioEdit').hide();
}
</script>
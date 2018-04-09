<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<div class="page-padding">
    <?= $this->Form->create($productosProveedor); ?>
    <fieldset>
        <legend><?= __('Agregar {0}', ['Proveedor']) ?></legend>
        
        <?php
                echo $this->Form->input('producto_id', ['type' =>'hidden','value'=> $productosProveedor->producto_id]);
                        echo $this->Form->input('proveedor_id', ['options' => $proveedores]);
                        echo $this->Form->input('costo');
                        echo $this->Form->input('margen');
                        echo $this->Form->input('precio');
                        echo $this->Form->input('activo');
                        echo $this->Form->input('existencia');
                        #echo $this->Form->input('user_id');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
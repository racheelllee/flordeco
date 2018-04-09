<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
        <li><?= $this->Html->link(__('Listar Proveedores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Precios'), ['controller' => 'Precios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Precio'), ['controller' => 'Precios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<div class="page-padding">
    <div class="row">
        <div class="col-lg-8">
            <?= $this->Form->create($proveedor); ?>
            <fieldset>
                <legend><?= __('Proveedor') ?></legend>
        
                 <div class="row">
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('nombre', ['label'=>'Nombre Comercial']);
                            //echo $this->Form->input('productos._ids', ['options' => $productos]);
                            echo $this->Form->input('contacto_comercial');
                            echo $this->Form->input('puesto');
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('tiempo_de_entrega', ['label'=>'Tiempo de Entrega']);
                            echo $this->Form->input('correo_electronico');
                            echo $this->Form->input('telefono1', ['label'=>'Telefono']);
                        ?>
                    </div>
                </div>
                        
            </fieldset>

            <fieldset>
                <legend></legend>
        
                 <div class="row">
                    <div class="col-lg-6">
                        <?php
                        $opcion_proveedor = array('Proveedor envia sin costo' => 'Proveedor envia sin costo', 
                                                'Proveedor envia producto aumentando un costo de' => 'Proveedor envia producto aumentando un costo de');

                            echo $this->Form->input('condiciones_pago', ['label'=>'Condiciones de Pago']);
                            echo $this->Form->input('no_cuenta', ['label'=>'No. de Cuenta']);
                        ?>

                        <div class="row">
                            <div class="col-lg-8">
                                <?php echo $this->Form->input('opcion_proveedor', ['options' => $opcion_proveedor, 'label'=>'Proveedor Envio']); ?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('costo_opcion_proveedor', ['label'=>'Costo']); ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('banco');
                            echo $this->Form->input('clabe_interbancaria');
                        ?>
                        <br>
                        <?php  echo $this->Form->input('envio_guia', ['label'=>'Enviamos guia de envio a proveedor']); ?>
                        
                        
                    </div>
                </div>
                        
            </fieldset>

            <br><br>
            <fieldset>
                <legend><?= __('Direccion Bodega') ?></legend>
        
                 <div class="row">
                    <div class="col-lg-6">
                        <?php
                         echo $this->Form->input('calle_bodega', ['label'=>'Calle']);
                          
                            echo $this->Form->input('entre_calles_bodega', ['label'=>'Entre Calles']);
                            echo $this->Form->input('ciudad_bodega', ['label'=>'Ciudad']);
                            echo $this->Form->input('codigo_postal_bodega', ['label'=>'Codigo Postal']);
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('numero_exterior_bodega', ['label'=>'No. Exterior']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('numero_interior_bodega', ['label'=>'No. Interior']); ?>
                            </div>
                        </div>
                        <?php
                            echo $this->Form->input('colonia_bodega', ['label'=>'Colonia']);
                            echo $this->Form->input('estado_bodega', ['label'=>'Estado']);

                        ?>
                    </div>
                </div>
                        
            </fieldset>

            <br><br> 

            <fieldset>
                <legend><?= __('Datos Fiscales') ?></legend>
        
                 <div class="row">
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('rfc', ['label'=>'RFC']);

                            echo $this->Form->input('codigo_postal_fiscal', ['label'=>'Codigo Postal']);
                            echo $this->Form->input('calle_fiscal', ['label'=>'Calle']);
                            echo $this->Form->input('entre_calles_fiscal', ['label'=>'Entre Calles']);
                            echo $this->Form->input('ciudad_fiscal', ['label'=>'Ciudad']);
                            echo $this->Form->input('estado_fiscal', ['label'=>'Estado']);
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        echo $this->Form->input('nombre_fiscal', ['label'=>'Razon Social']);
                            echo $this->Form->input('telefono2', ['label'=>'Telefono']);
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('numero_exterior_fiscal', ['label'=>'No. Exterior']); ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('numero_interior_fiscal', ['label'=>'No. Interior']); ?>
                            </div>
                        </div>
                        <?php
                            echo $this->Form->input('colonia_fiscal', ['label'=>'Colonia']);
                            echo $this->Form->input('contacto_credito_cobranza');
                        ?>
                    </div>
                </div>
                        
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


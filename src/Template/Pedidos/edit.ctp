<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<div class="page-padding">
    <?= $this->Form->create($pedido); ?>
    <fieldset>
        <legend><?= __('Editar {0}', ['Pedido']) ?></legend>
        
        <?php
                echo $this->Form->input('cliente_id', ['options' => $clientes]);
                        echo $this->Form->input('fecha');
                        echo $this->Form->input('monto');
                        echo $this->Form->input('formasdepago_id', ['options' => $formasdepagos]);
                        echo $this->Form->input('estatus_id');
                        echo $this->Form->input('nombre_cliente');
                        echo $this->Form->input('correo_electronico');
                        echo $this->Form->input('telefono_local');
                        echo $this->Form->input('telefono_celular');
                        echo $this->Form->input('nombre_quien_recibe');
                        echo $this->Form->input('calle');
                        echo $this->Form->input('numero_exterior');
                        echo $this->Form->input('numero_interior');
                        echo $this->Form->input('entre_calles');
                        echo $this->Form->input('colonia');
                        echo $this->Form->input('municipio_id', ['options' => $municipios]);
                        echo $this->Form->input('codigo_postal');
                        echo $this->Form->input('estado_id', ['options' => $estados]);
                        echo $this->Form->input('pais_id', ['options' => $paises]);
                        echo $this->Form->input('respuesta_pago');
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
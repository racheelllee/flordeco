<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<div class="page-padding">
    <?= $this->Form->create($banner ,['enctype' => 'multipart/form-data' ]); ?>
    <fieldset>
        <legend><?= __('Agregar {0}', ['Banner']) ?></legend>
        
        <?php
                echo $this->Form->input('nombre');

                echo 'Tipo:' . $this->Form->input(
                    'principal',
                    array('options' => $tipos, 'default' => '0', 'empty' => 'Seleccione el tipo')
                );

                echo $this->Form->input('url');
                
                echo  $this->Form->input('imagen_file', ['type' => 'file']) ;

                
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>

<br>
<br>
    <p  class="bannerPrincipalMedidas">
        Las medidas recomendadas para el banner principal son de 950px X 550px

    </p>
<br>
    <p class="bannerSliderMedidas">
         Las medidas recomendadas para los banners inferiores son de 220px X 150px

    </p>
</div>


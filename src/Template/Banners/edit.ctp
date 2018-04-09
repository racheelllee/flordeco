<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="page-padding">
    <?= $this->Form->create($banner, ['enctype' => 'multipart/form-data' ]); ?>
    <fieldset>
        <legend><?= __('Editar {0}', ['Banner']) ?></legend>
        
        <?php
            echo $this->Form->input('nombre');
            // echo "Banner Principal:". $this->Form->checkbox('principal');

            $tipos = array('1' => 'Banner Principal', '2' => 'Banner Secundario', '3' => 'Banner Flotante');
            
            echo 'Tipo:' . $this->Form->input(
                'principal',
                array('options' => $tipos, 'label' => false)
            );

            echo $this->Form->input('url');

            if (isset($banner->imagen)) {

               echo '<img src="'.$this->Image->resize('/', "$banner->imagen", 220, 220, true).'">';

               echo '<br>';
               echo '<br>';

            }else { echo '<img src="'.$this->Image->resize('/', "$banner->imagen_file", 220, 220, true).'">'; echo '<br>'; echo '<br>'; }

            
            echo  $this->Form->input('imagen_file', ['type' => 'file', 'label'=> false]) ;
            echo '<br>';
           
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
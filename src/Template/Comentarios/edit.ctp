<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="page-padding">
    <?= $this->Form->create($comentario); 

    ?>
    <fieldset>
        <legend><?= __('Editar {0}', ['Comentario']) ?></legend>
        <div class="form-group">  <label for="user-id">Producto</label>
       <?= $comentario->producto->nombre?>
        </select></div>
             <div class="form-group">  <label for="user-id">Usuario</label>
       <?= $comentario->usuario->first_name?> <?= $comentario->usuario->last_name?> (<?= $comentario->usuario->email?>)
        </select></div>
    
        <?php
                        echo $this->Form->input('calificacion');
                        echo $this->Form->input('comentarios');
                        echo $this->Form->input('fecha');
                        echo $this->Form->input('autorizado');
                        
                        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
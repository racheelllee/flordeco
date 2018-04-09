<?php
if($saved){
  echo $producto->$columna;
}else{

  echo $this->Form->input($columna,['id' => 'campo_'.$columna.'_'.$producto->id, 'value'=>$producto->$columna]);
  echo $this->Form->button('Guardar',['class'=>'btn btn-primary', 'data-columna'=>'campo_'.$columna.'_'.$producto->id, 'onclick' => 'editAjax(this); return false;']);
}

?>
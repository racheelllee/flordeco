<div class="col-lg-12">
  <div class="col-lg-5"></div>
  <div class="col-lg-7">
    <?= $this->Form->create($categoria, [
        'class' => 'form-inline',
        'method' => 'GET'
    ]); ?>
      <div class="form-group">
        <?= $this->Form->input('rango_precio', [
            'type' => 'select',
            'label' => false,
            'div' => false,
            'value' => $this->request->query('rango_precio'),
            'options' => $rangosPrecios,
            'class' => 'select-simple'
        ]); ?> 
      </div>
      <div class="form-group">
        <?= $this->Form->input('tipo_flor', [
            'type' => 'select',
            'label' => false,
            'div' => false,
            'value' => $this->request->query('tipo_flor'),
            'options' => $tipoFlores,
            'class' => 'select-simple'
        ]); ?> 
      </div>
      <div class="form-group">
        <div class="inner-addon left-addon">
          <?= $this->Form->input('nombre_producto', [
              'type' => 'text',
              'label' => false,
              'div' => false,
              'value' => $this->request->query('nombre_producto'),
              'class' => 'input-simple'
          ]); ?> 

        <i class="glyphicon glyphicon-search"></i>
        </div>
      </div>
      <button type="submit" class="btn btn-default">Buscar</button>
    <?= $this->Form->end() ?>
  </div>
</div>
<div class="clearfix">
    &nbsp;
    <br>
</div>
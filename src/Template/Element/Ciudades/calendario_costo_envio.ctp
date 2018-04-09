<table class="table">
  <thead>
    <tr>
      <th class="width-column"></th>
    </tr>
  </thead>
  <tbody>

    <?= $this->Form->create($estado, ['url' => '/ciudades/editEstado/'.$estado->id]); ?>
    <tr>
      <td class="width-column"> Estado de <?= $estado->nombre ?>  </td>
      <td> Costos </td>
      <td class="width-action">
        <?= $this->Form->button('Actualizar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
      </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <div class="col-md-1 div-costo-envio">
          <?= $this->Form->input('costo_envio', [
              'class' => 'form-control',
              'label' => 'COSTO ENVIO',
              'div' => false,
          ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
          <?= $this->Form->input('costo_envio1', [
              'class' => 'form-control',
              'label' => '+ LUN',
              'div' => false,
          ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio2', [
                'class' => 'form-control',
                'label' => '+ MAR',
                'div' => false,
            ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio3', [
                'class' => 'form-control',
                'label' => '+ MIE',
                'div' => false,
            ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio4', [
                'class' => 'form-control',
                'label' => '+ JUE',
                'div' => false,
            ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio5', [
                'class' => 'form-control',
                'label' => '+ VIE',
                'div' => false,
            ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio6', [
                'class' => 'form-control',
                'label' => '+ SAB',
                'div' => false,
            ]); ?>
        </div>
        <div class="col-md-1 div-costo-envio">
            <?= $this->Form->input('costo_envio7', [
                'class' => 'form-control',
                'label' => '+ DOM',
                'div' => false,
            ]); ?>
        </div>
      </td>
      <td>
        
      </td>
    </tr>
    <?= $this->Form->end() ?>
  </tbody>
</table> 


  <?php if ($ciudades) { ?>

    <table class="table">
      <thead>
        <tr>
          <th class="width-column"></th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($ciudades as $key => $ciudad) { ?>
          <?= $this->Form->create($ciudad, ['url' => '/ciudades/edit/'.$ciudad->id]); ?>
          <tr>
            <td class="width-column"> <?= $ciudad->nombre ?>  </td>
            <td> Costos </td>
            <td class="width-action">
              <?= $this->Form->button('Actualizar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <div class="col-md-1 div-costo-envio">
                <?= $this->Form->input('costo_envio', [
                    'class' => 'form-control',
                    'label' => 'COSTO ENVIO',
                    'div' => false,
                ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                <?= $this->Form->input('costo_envio1', [
                    'class' => 'form-control',
                    'label' => '+ LUN',
                    'div' => false,
                ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio2', [
                      'class' => 'form-control',
                      'label' => '+ MAR',
                      'div' => false,
                  ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio3', [
                      'class' => 'form-control',
                      'label' => '+ MIE',
                      'div' => false,
                  ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio4', [
                      'class' => 'form-control',
                      'label' => '+ JUE',
                      'div' => false,
                  ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio5', [
                      'class' => 'form-control',
                      'label' => '+ VIE',
                      'div' => false,
                  ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio6', [
                      'class' => 'form-control',
                      'label' => '+ SAB',
                      'div' => false,
                  ]); ?>
              </div>
              <div class="col-md-1 div-costo-envio">
                  <?= $this->Form->input('costo_envio7', [
                      'class' => 'form-control',
                      'label' => '+ DOM',
                      'div' => false,
                  ]); ?>
              </div>
            </td>
            <td align="center" style="font-size:10px;"> <?= ($ciudad->costo_envio)? '' : 'No Configurado' ?> </td>
          </tr>
          <?= $this->Form->end() ?>
        <?php } ?>
        
      </tbody>
    </table> 

  <?php } ?>
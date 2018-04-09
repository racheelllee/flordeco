<table class="table">
  <thead>
    <tr>
      <th class="width-column"></th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td class="width-column"> Estado de <?= $estado->nombre ?>  </td>
      <td> Horarios </td>
      <td class="width-action">
            <?= $this->Form->button('Agregar Horario', [
                      'class'=>'btn btn-primary btn-fsmall', 
                      'escape'=>false,
                      'style' => 'margin-bottom: 0px;',
                      'data-toggle' => 'modal', 'data-target' => '#modal',
                      'data-href' => '/ciudades/addHorario/'.$estado->id
            ]) ?>
      </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <table class="table no-border">

            <?php foreach ($estado->ciudad_horario_entregas as $key => $horario) { ?>

                <tr>
                  <td><?= $horario->titulo ?></td>
                  <td>De <?= $horario->desde->format('H:i') ?> a <?= $horario->hasta->format('H:i') ?></td>
                  <td>Disponible hasta <?= $horario->disponible_hasta->format('H:i') ?></td>
                  <td><?= $horario->ciudad_horario_entrega_tipo->nombre ?> <?= ($horario->ciudad_horario_entrega_tipo_id == 2 && $horario->fecha)? $horario->fecha->format('d/m/Y') : '' ?></td>
                  <td>
                    <?= $this->Form->create(null, ['url' => '/ciudades/deleteHorario']); ?>
                      <?= $this->Form->input('horario_id', ['type'=>'hidden', 'value'=>$horario->id]) ?>
                      <?= $this->Form->button('<i class="fa fa-trash"></i> Eliminar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                    <?= $this->Form->end() ?>
                  </td>
                </tr>

            <?php } ?>


            <?php if(!$estado->ciudad_horario_entregas){ ?>
                <tr>
                  <td colspan="2" align="center" style="font-size:10px;">No Configurado</td>
                </tr>
            <?php } ?>


        </table>
      </td>
      <td></td>
    </tr>
    
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

          <tr>
            <td class="width-column"> <?= $ciudad->nombre ?>  </td>
            <td> Horarios </td>
            <td class="width-action">
                  <?= $this->Form->button('Agregar Horario', [
                            'class'=>'btn btn-primary btn-fsmall', 
                            'escape'=>false,
                            'style' => 'margin-bottom: 0px;',
                            'data-toggle' => 'modal', 'data-target' => '#modal',
                            'data-href' => '/ciudades/addHorario/%20/'.$ciudad->id
                  ]) ?>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <table class="table no-border">

                  <?php foreach ($ciudad->ciudad_horario_entregas as $key => $horario) { ?>

                      <tr>
                        <td><?= $horario->titulo ?></td>
                        <td>De <?= $horario->desde->format('H:i') ?> a <?= $horario->hasta->format('H:i') ?></td>
                        <td>Disponible hasta <?= $horario->disponible_hasta->format('H:i') ?></td>
                        <td><?= $horario->ciudad_horario_entrega_tipo->nombre ?> <?= ($horario->ciudad_horario_entrega_tipo_id == 2 && $horario->fecha)? $horario->fecha->format('d/m/Y') : '' ?></td>
                        <td>
                          <?= $this->Form->create(null, ['url' => '/ciudades/deleteHorario']); ?>
                            <?= $this->Form->input('horario_id', ['type'=>'hidden', 'value'=>$horario->id]) ?>
                            <?= $this->Form->button('<i class="fa fa-trash"></i> Eliminar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                          <?= $this->Form->end() ?>
                        </td>
                      </tr>

                  <?php } ?>


                  <?php if(!$ciudad->ciudad_horario_entregas){ ?>
                      <tr>
                        <td colspan="2" align="center" style="font-size:10px;">No Configurado</td>
                      </tr>
                  <?php } ?>
              </table>
            </td>
            <td></td>
          </tr>

        <?php } ?>
        
      </tbody>
    </table> 

  <?php } ?>
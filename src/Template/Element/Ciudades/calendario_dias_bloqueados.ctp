<table class="table">
  <thead>
    <tr>
      <th class="width-column"></th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td class="width-column"> Estado de <?= $estado->nombre ?>  </td>
      <td> Días Bloqueados </td>
      <td class="width-action">
            <?= $this->Form->button('Agregar Día', [
                      'class'=>'btn btn-primary btn-fsmall', 
                      'escape'=>false,
                      'style' => 'margin-bottom: 0px;',
                      'data-toggle' => 'modal', 'data-target' => '#modal',
                      'data-href' => '/ciudades/addDiaFestivo/'.$estado->id
            ]) ?>
      </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <table class="table no-border">
            <?php foreach ($estado->ciudad_festivos as $key => $festivo) { ?>

                <tr>
                  <td><?= $festivo->fecha->format('d/m/Y') ?></td>
                  <td>
                    <?= $this->Form->create(null, ['url' => '/ciudades/deleteDiaFestivo']); ?>
                      <?= $this->Form->input('ciudad_festivo_id', ['type'=>'hidden', 'value'=>$festivo->id]) ?>
                      <?= $this->Form->button('<i class="fa fa-trash"></i> Eliminar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                    <?= $this->Form->end() ?>
                  </td>
                </tr>

            <?php } ?>

            <?php if(!$estado->ciudad_festivos){ ?>
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
            <td> Días Bloqueados </td>
            <td class="width-action">
                  <?= $this->Form->button('Agregar Día', [
                            'class'=>'btn btn-primary btn-fsmall', 
                            'escape'=>false,
                            'style' => 'margin-bottom: 0px;',
                            'data-toggle' => 'modal', 'data-target' => '#modal',
                            'data-href' => '/ciudades/addDiaFestivo/%20/'.$ciudad->id
                  ]) ?>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <table class="table no-border">
                  <?php foreach ($ciudad->ciudad_festivos as $key => $festivo) { ?>

                      <tr>
                        <td><?= $festivo->fecha->format('d/m/Y') ?></td>
                        <td>
                          <?= $this->Form->create(null, ['url' => '/ciudades/deleteDiaFestivo']); ?>
                            <?= $this->Form->input('ciudad_festivo_id', ['type'=>'hidden', 'value'=>$festivo->id]) ?>
                            <?= $this->Form->button('<i class="fa fa-trash"></i> Eliminar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                          <?= $this->Form->end() ?>
                        </td>
                      </tr>

                  <?php } ?>


                  <?php if(!$ciudad->ciudad_festivos){ ?>
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
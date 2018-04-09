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
    </tr>

    <tr>
      <td></td>
      <td>
        <?= $this->Form->create($estado->ciudad_festivos_semanas[0], ['url' => '/ciudades/addDiaFestivoSemana']); ?>
        <table class="table no-border">
            
              <?= $this->Form->input('estado_id', ['type'=>'hidden', 'value'=>$estado->id]) ?>

              <tr>
                <td align="center">LUN</td>
                <td align="center">MAR</td>
                <td align="center">MIE</td>
                <td align="center">JUE</td>
                <td align="center">VIE</td>
                <td align="center">SAB</td>
                <td align="center">DOM</td>
                <td align="center">
                  
                  <?= $this->Form->button('Actualizar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                  
                </td>
              </tr>
              <tr>
                <td align="center"><?= $this->Form->checkbox('lun', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('mar', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('mie', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('jue', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('vie', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('sab', ['hiddenField' => false]); ?></td>
                <td align="center"><?= $this->Form->checkbox('dom', ['hiddenField' => false]); ?></td>
                <td align="center" style="font-size:10px;"> <?= (isset($estado->ciudad_festivos_semanas[0]))? '' : 'No Configurado' ?> </td>
              </tr>
           
        </table>
        <?= $this->Form->end(); ?>
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
    
          </tr>

          <tr>
            <td></td>
            <td>
                <?= $this->Form->create($ciudad->ciudad_festivos_semanas[0], ['url' => '/ciudades/addDiaFestivoSemana']); ?>
                <table class="table no-border">
                    
                      <?= $this->Form->input('ciudad_id', ['type'=>'hidden', 'value'=>$ciudad->id]) ?>

                      <tr>
                        <td align="center">LUN</td>
                        <td align="center">MAR</td>
                        <td align="center">MIE</td>
                        <td align="center">JUE</td>
                        <td align="center">VIE</td>
                        <td align="center">SAB</td>
                        <td align="center">DOM</td>
                        <td align="center">
                          
                          <?= $this->Form->button('Actualizar', ['class'=>'btn btn-primary btn-fsmall', 'escape'=>false]) ?>
                          
                        </td>
                      </tr>
                      <tr>
                        <td align="center"><?= $this->Form->checkbox('lun', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('mar', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('mie', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('jue', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('vie', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('sab', ['hiddenField' => false]); ?></td>
                        <td align="center"><?= $this->Form->checkbox('dom', ['hiddenField' => false]); ?></td>
                        <td align="center" style="font-size:10px;"> <?= (isset($ciudad->ciudad_festivos_semanas[0]))? '' : 'No Configurado' ?> </td>
                      </tr>
                   
                </table>
                <?= $this->Form->end(); ?>
            </td>
            <td></td>
          </tr>

        <?php } ?>
        
      </tbody>
    </table> 

  <?php } ?>
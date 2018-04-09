<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-4">
                            <h2><?php echo __('Carga de Productos'); ?></h2>
                        </div>
                      
                    </div>
                    <?php if($cant >0):?>
                        <br>
                    <br>
                    <div class="ibox-content">
                        <table class="table">
                            <tr>
                                <th>Procesados</th>
                                <td><?= $cant; ?></td>
                            </tr>
                            <tr>
                                <th>Correctos</th>
                                <td><?= $ok; ?></td>
                            </tr>

                            <tr>
                                <th>Actualizados</th>
                                <td><?= $actualizado; ?></td>
                            </tr>
                            <tr>
                                <th>Cambios de Proveedor</th>
                                <td><?= $nuevo_proveedor; ?></td>
                            </tr>

                            
                            <?php if($nok >0):?>
                            <tr>
                                <th>Incorrectos</th>
                                <td><?= $nok; ?></td>
                            </tr>
                            



                            <tr>
                                <th>SKUs incorrectos</th>
                                <td><?= implode(', ', array_keys($mal));?></td>
                            </tr>
                            <?php endif;?>
                        </table>
                        <br>
                    <?php echo $this->Form->postlink('Editar registros procesados',['action' => 'masiva','estatus_id'=>2]);?>
                    </div>
                    
                    <br>
                    <?php endif;?>
                    <br>
                    <div class="ibox-content">
                    <a href="/files/formato.xlsx">Formato</a>
                    <br>
                    <br>
                        
                        
                         <?= $this->Form->create(null, ['type' => 'file']); ?>
                      


                        <div class="row">
                          <div class="col-lg-6">
                          <?php echo $this->Form->input('proveedor_id', ['options' => $proveedores]);?>

                              <?= $this->Form->input('file',array('type'=>'file', 'label'=>'Archivo')) ?>
                          </div>
                      </div>


        <?= $this->Form->button(__('Subir')) ?>
        <?= $this->Form->end() ?>



                    </div>
                </div>
            </div>
        </div>
</div>

<script>/*
    $('#activo').change(function () {

        $("#producto_activo").submit();
            
    });*/
</script>
<br>
  <div class="row">
        <div class="col-xs-6 w-title w-color666">
        
          <span style="margin-top:30px;"><?php echo __('Carga Masiva de Costos Directos en Cargos');?></span>
        
        </div>
      
        <div class="col-xs-6">
            <?php if($this->UserAuth->HP('Cargos', 'cargaMasiva') && $this->UserAuth->HP('Cargos', 'guardarCargaMasiva')){ ?>
                <?= $this->Form->create(null, ['id'=>'upload-excel', 'type' => 'file', 'url'=>'/cargos/cargaMasiva']); ?>
                    <span id="upload-file-spinner" style="display:none;" class="pull-right"><i class='fa fa-spinner fa-spin fa-5x fa-fw' style='font-size:15px;'></i></span>
                    <div class="fileinput fileinput-new pull-right" data-provides="fileinput">
                        <span class="btn btn-default w-AvenirLight btn-file">
                            <span class="fileinput-new"> <?= __('Carga Masiva de Costos') ?> </span>
                            <span class="fileinput-exists"> <?= __('Carga Masiva de Costos') ?> </span>
                            <input name="upload-file" type="file" id="upload-file"> </span>
                    </div>
                <?= $this->Form->end() ?>
            <?php } ?>
        </div>

    </div>
    <div>
        <?php if(!empty($cargosArray)) { ?>
        <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight" id="UsersTable" width="100%">
            <thead>
                <tr>
                    <?php 
                        echo '<th>Número</th>';
                        echo '<th>Descripción</th>';
                        echo '<th>Costo Directo de Materiales</th>';
                        echo '<th>Costo Directo de Mano de Obra</th>'; 
                    ?>
                    <th style="width:20px;"><?php echo __('Action'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $error = false;
                    foreach($cargosArray as $cargo) { if(isset($cargo['result_upload'])){ $error = true; }

                        echo '<tr>';

                            echo '<td>'.$cargo['numero'].'</td>';

                            echo '<td>'; 
                            echo (!empty($cargo['cargo']))? $cargo['cargo']['descripcion'] : '';
                            echo '</td>';

                            echo '<td align="right">';
                            echo (is_numeric($cargo['costo_directo_material']))? '$'.number_format($cargo['costo_directo_material'], 2) : $cargo['costo_directo_material'];
                            echo '</td>';

                            echo '<td align="right">';
                            echo (is_numeric($cargo['costo_directo_obra']))? '$'.number_format($cargo['costo_directo_obra'], 2) : $cargo['costo_directo_obra'];
                            echo '</td>';

                            echo '<td align="center">';
                                    
                                if(empty($cargo['result_upload'])){
                                    echo '<i class="fa fa-check btn btn-primary btn-xs"></i>';
                                }else{

                                    echo '<i data-container="body" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="'.$this->element('errors_popover', ['errors' => $cargo['result_upload']] ).'" class="fa fa-times btn btn-danger btn-xs"></i>';
                                }

                            echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>

        <?php } else {
            $error = true;
            echo "<p align='center'><br/><br/>".__('No Records Available')."</p>";
        } ?>
    </div>

    <div class="col-md-12" align="center">
        <?php 
           
            if(!$error){
                echo $this->Form->Submit(__('Guardar'), ['div'=>false, 'class'=>'btn btn-span btn-md w-btnAddUsers', 'id'=>'finish-upload']);
            } 

        ?>
    </div>

<script>

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });

    $('#upload-file').change(function(){
        var file = this.files[0];
        var name = file.name;
        var ext = name.split('.').pop().toLowerCase();
        
        if(ext == 'xlsx' || ext == 'xls'){
            $('#upload-file-spinner').css({'display': 'block'}); 
            $('#upload-excel').submit();
        }else{
            alert('Tipo de archivo no valido.');
        }
    });

    $('#finish-upload').on('click', function () {
                
        procesando();

        var cargosArray = <?= json_encode($cargosArray) ?>;

        var cant = 0;
        $.each(cargosArray, function( index, data ) {

            $.ajax({
                type: 'POST',
                url: '/cargos/guardarCargaMasiva/',
                data: data,
                dataType: 'json',
                success: function(response){
                    
                    cant++;
                    if(cant == cargosArray.length){
                        $(location).attr('href','/cargos');
                    }
                    
                }
            });

        });

    });
</script>
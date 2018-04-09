
<style type="text/css">
    .searchLabel, .searchField { clear: both; }
    .usermgmtSearchForm .searchSubmit { float: right; padding: 0 10px 5px; margin-top: 40px; }
    .dataTables_info { display: none; }
    .usermgmtSearchForm .searchSubmit { margin-right: 45px; }
</style>
<style type="text/css"> 
    .dataTables_info{ display: none; }

</style>
<br>
<div id="updateCargosIndex">
    <div class="col-xs-6 w-title w-color666">
          <span style="position: absolute; margin-top:5px;"><?= __('List Project') ?></span>
    </div>
    <div class="col-xs-6 w-title w-color666">
    
        <button style="margin-left: 5px;" id="exportarCargosPdf" type="button" class="btn btn-success pull-right">RESUMEN</button>

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
        <?php }else{ echo '&nbsp;'; } ?>
    </div>
    <div class="ibox-content">
        <?php echo $this->Search->searchForm('Cargos', ['legend'=>false, 'updateDivId'=>'updateCargosIndex']); ?>
    </div>
    <?php echo $this->element('all_cargos'); ?>

</div>

<script type="text/javascript">
    $(function () {
        $('#cargos-cliente-id,#cargos-supervisor-id').select2();
    });
    
    $('#exportarCargosPdf').on('click', function(){
        
        exportaPdf('resumen_cargos');

    });

    function exportaPdf(tipo){
        $('#genericModal').modal('show');
        $.post('/cargos/exporta-pdf-shell/' + location.search, {tipo:tipo}, function(resp){
            $('#genericModal .modal-body').html(resp);
        });
    }

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
</script>

<?php echo $this->element('generic_modal'); ?>


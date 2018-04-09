
<style type="text/css">.usermgmtSearchForm .searchSubmit{margin-right: 45px;}</style>
<div>
        <?php echo $this->element('all_resultado_cargos');?>
        <div class="clearfix"></div>
</div>

<script type="text/javascript">
    $(function () {
        $('#cargos-supervisor-id').select2();
    });

    $('#exportarCargosPdf').on('click', function(){
    	
    	exportaPdf('cargos');

    });

    function exportaPdf(tipo){
        $('#genericModal').modal('show');
        $.post('/cargos/exporta-pdf-shell/' + location.search, {tipo:tipo}, function(resp){
            $('#genericModal .modal-body').html(resp);
        });
    }

</script>

<?php echo $this->element('generic_modal'); ?>
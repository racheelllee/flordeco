<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="exampleModalLabel">Preparando archivo</h4>
    <h5>Por favor espere...</h5>
</div>
<hr style="margin: 10px;visibility: hidden;">
<div id="pdf-file" style="display: none;">
	<a id="pdf-file-link" href="#" class="btn btn-primary" target="_blank">Descargar archivo</a>
</div>
<div id="pdf-loader">
	<div class="progress progress-striped active">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
    </div>
</div>
<script type="text/javascript">
    function checkFile(){
        $.get('/cotizaciones/descarga-pdf/', function(resp){
        }).done(function(resp){
            // Generar enlace a Archivo
            window.fileReady = true;
            $('#pdf-file-link').attr('href', '/' + resp);
            $('#pdf-loader').hide();
            $('#pdf-file').show();
        }).fail(function(){
            // Seguir esperando
            if ( ! window.fileReady ) { // Por si se cierra el modal y se vuelve a abrir
            	checkFile();
            }
        });
    }
    window.fileReady = false;
    checkFile();
</script>
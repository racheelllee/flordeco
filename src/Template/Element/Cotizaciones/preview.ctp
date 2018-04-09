<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Vista previa</h4>
        <div id="preview-target" class="modal-body"></div>
      </div>
    </div>
  </div>
</div>
<div id="loader-content" style="display: none;">
  <p style="text-align: center;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></p>
</div>
<script type="text/javascript">
  $(this).find(".modal-body").html($('#loader-content').html());
  $("#previewModal").on("show.bs.modal", function(e) {
      var link = $(e.relatedTarget);
      /*
      var data = $('#cotizacion-form').serializeArray();
      data = $.param(data);
      $.each(data, function(index, element){
        if (element['name'] == 'vendedor_asignado_id') {
          data[index]['value'] = $("#vendedor-asignado-id option:selected").text();
        }
      });*/
      $.post(
        '/cotizaciones/preview',
        $('#cotizacion-form').serialize(),
        function(response){
          $('#preview-target').html(response);
        }
      )
  });
  $("#previewModal").on("hidden.bs.modal", function(e) {
      $(this).find(".modal-body").html($('#loader-content').html());
  });
</script>
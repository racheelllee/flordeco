<div class="modal fade" id="fileLoadModal" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div id="modal-loader-content" style="display: none;">
    <p style="text-align: center;">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </p>
</div>

<script type="text/javascript">
    $("#fileLoadModal").find(".modal-body").html($('#modal-loader-content').html());
    $("#fileLoadModal").on("hidden.bs.modal", function(e) {
        $(this).find(".modal-body").html($('#modal-loader-content').html());
    });
</script>
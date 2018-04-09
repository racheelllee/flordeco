<div class="modal fade" id="genericModal" role="dialog">
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
    $("#genericModal").find(".modal-body").html($('#modal-loader-content').html());
    $("#genericModal").on("shown.bs.modal", function(e) {
        $(this).find(".modal-body").html($('#modal-loader-content').html());
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
    });
    $("#genericModal").on("hidden.bs.modal", function(e) {
        $(this).find(".modal-body").html($('#modal-loader-content').html());
    });
</script>
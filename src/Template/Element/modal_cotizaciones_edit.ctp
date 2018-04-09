<div class="modal fade" id="editCustomer-<?= $customer->id ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?= __('Edit Customer') ?></h4>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#editCustomer-<?= $customer->id ?>").on("show.bs.modal", function(e) {
      var link = $(e.relatedTarget);
      $(this).find(".modal-body").load(link.attr("href"), function(e){
        validateThings();
        locationEventListeners();
      });
  });
  $("#editCustomer-<?= $customer->id ?>").on("hidden.bs.modal", function(e) {
      $(this).find(".modal-body").html("<br>");
  });
</script>
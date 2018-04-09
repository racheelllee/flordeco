<div class="modal fade" id="addInteractionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?= __('New Interaction') ?></h4>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#addInteractionModal").on("show.bs.modal", function(e) {
      var link = $(e.relatedTarget);
      $(this).find(".modal-body").load(link.attr("href"), function(){
        $(this).find("form").append('<input type="hidden" name="redirect" value="customers/customers/view/<?=$customer->id?>">');
        $(this).find("form").append('<input type="hidden" name="customer_id" value="<?=$customer->id?>">');
        validateThings();
      });
  });
  $("#addInteractionModal").on("hidden.bs.modal", function(e) {
      $(this).find(".modal-body").html("<br>");
  });
</script>
<style type="text/css">
    .customer-select {
        display: none;
    }

</style>
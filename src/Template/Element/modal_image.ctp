<div class="modal inmodal" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1052;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content animated bounceInRight">
      </div>
    </div>
</div>


<script type="text/javascript">
	$(document).on({click: function(e){        
        
        var spinner = "<div class='text-center'><i class='fa fa-spinner fa-spin fa-5x fa-fw' style='margin:40px; font-size:20px;'></i></div>";
          $("#modal-image .modal-content").html(spinner);
        
          $("#modal-image .modal-content").html('<img src="'+ $(this).data('href') +'" width="100%">');

    }}, '[data-target="#modal-image"]');

</script>
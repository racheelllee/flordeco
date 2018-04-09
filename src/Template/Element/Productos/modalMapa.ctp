<div class="modal container fade" id="modalMapa" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-lg" style="margin: 0px auto; padding: 30px 100px;">
      <div style="padding: 20px;" class="modal-content animated fadeIn panel panel-info">
      </div>
    </div>
</div>


<script type="text/javascript">
	$(document).on({click: function(e){        
        
        var spinner = "<div class='text-center'><i class='fa fa-spinner fa-spin fa-5x fa-fw' style='margin:40px; font-size:20px;'></i></div>";
          $("#modalMapa .modal-content").html(spinner);

          $("#modalMapa .modal-content").load($(this).data('href'), function() {  });

    }}, '[data-target="#modalMapa"]');

   

</script>
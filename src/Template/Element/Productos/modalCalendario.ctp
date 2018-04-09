<div class="modal fade" id="modalCalendario" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-lg modalCalendar">
      <div style="background-color: #b45bab; padding: 20px;" class="modal-content animated fadeIn panel panel-info">
      </div>
    </div>
</div>


<script type="text/javascript">
	$(document).on({click: function(e){        
        
        var spinner = "<div class='text-center'><i class='fa fa-spinner fa-spin fa-5x fa-fw' style='margin:40px; font-size:20px; color:white;'></i></div>";
          $("#modalCalendario .modal-content").html(spinner);
        
          $("#modalCalendario .modal-content").load($(this).data('href'));

    }}, '[data-target="#modalCalendario"]');

</script>
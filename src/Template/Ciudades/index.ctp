
<style type="text/css">
  .dataTables_info{
    display:none;
  }
  .sorting-link a{
    /*color:#333;*/
  }
  .parsley-errors-list
  {
    padding-left: 0;
  }
  .parsley-errors-list li.parsley-required,
  .parsley-errors-list li.parsley-type
  {
    color: #ad0101;
    list-style: none;
    text-align: left;
  }
  .custom-datepicker{
    text-transform: capitalize;
  }
  .save-customers .control-label .required, .form-group .required{
    color: #333;
  }
  .picker__holder
  {
    overflow: hidden !important; 
  }
  .picker__button--clear, .picker__button--close, .picker__button--today{
    text-transform: capitalize;
  }
  table.dataTable>tbody>tr.child span.dtr-title a{
    color: #333;
  }
  ul.pagination{
    font-size: 12px;
  }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.date.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.time.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.date.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.time.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/translations/es_ES.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/parsleyjs/2.7.1/parsley.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/parsleyjs/2.7.1/i18n/es.js"></script>

<script type="text/javascript" src="/plugins/tinymce/js/tinymce/tinymce.min.js"></script>


<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title" style="height:70px;">
          <div class="col-md-4">
            <h2>Ciudades</h2>
          </div>
          <div class="ibox-tools col-md-4 pull-right">
            <a
              class="btn btn-primary pull-right"
              href="/ciudades/add"
              data-remote="false"
              data-toggle="modal"
              data-target="#ciudadesModal">
              <i class="fa fa-plus-circle"></i>
              <?= __('Agregar') ?> <?= __('Ciudad') ?>
            </a>
          </div>
        </div>
        <br>
        <div class="ibox-content">
        
          <?php echo $this->element('all_ciudades'); ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('modal_image'); ?>

<div class="modal fade" id="ciudadesModal" role="dialog">
  <div class="modal-dialog" style="min-width: 800px;">
    <div class="modal-content">
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div id="loader-content" style="display: none;">
    <p style="text-align: center;">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </p>
</div>
<script type="text/javascript">
  $("#ciudadesModal").on("show.bs.modal", function(e) {
        $(this).find(".modal-body").html($('#loader-content').html());
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
  });
</script>

<div class="row">
    <div class="col-md-12" style="padding: 20px;">
        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Nombre') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('nombre', [
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Nombre',
                    'div' => false,
                ]); ?>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Url') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('url', [
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Url',
                    'div' => false,
                ]); ?>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Estado') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('estado_id', [
                    'options' => $estados,
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Estado',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Ciudad Status') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('ciudad_status_id', [
                    'options' => $ciudadStatuses,
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Ciudad Status',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Rango Precio') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('precio', [
                    'options' => $tipoPrecios,
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Tipo de Precio',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="col-md-12">
                <?= $this->Form->input('orden', [
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Orden',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- label class="col-md-4 control-label"><?= __('Costo Envio') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('costo_envio', [
                    'required' => 'required',
                    'class' => 'form-control',
                    'label' => 'Costo Envio',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio1', [
                    'class' => 'form-control',
                    'label' => 'CE + Lun',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio2', [
                    'class' => 'form-control',
                    'label' => 'CE + Mar',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio3', [
                    'class' => 'form-control',
                    'label' => 'CE + Mie',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio4', [
                    'class' => 'form-control',
                    'label' => 'CE + Juv',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio5', [
                    'class' => 'form-control',
                    'label' => 'CE + Vie',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio6', [
                    'class' => 'form-control',
                    'label' => 'CE + Sab',
                    'div' => false,
                ]); ?>
            </div>
            <div class="col-md-1" style="width:14%; margin-right:2px;">
                <?= $this->Form->input('costo_envio7', [
                    'class' => 'form-control',
                    'label' => 'CE + Dom',
                    'div' => false,
                ]); ?>
            </div>
        </div>

        <div class="col-lg-10">
          <label class="control-label">Imagen Fondo</label>
          <?= $this->Form->input('imagen_fondo',array('type'=>'file', 'label'=>false)) ?>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-image" data-href="/<?php echo $ciudad->imagen_fondo; ?>" style="margin-top: 30px;"> <i class="fa fa-eye"></i> </button>
        </div>
        <div class="col-lg-12">
            <!-- label class="col-md-4 control-label"><?= __('Descripcion') ?></label -->
            <div class="col-md-12">
                <?= $this->Form->input('descripcion', [
                    'class' => 'form-control summernote',
                    'label' => 'Descripcion',
                    'div' => false,
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding: 30px;">
            <div class="page-header"><h4>Banners</h4></div>
                <div class="portlet box red">              
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table bannersTable">
                                <thead>
                                    <tr>
                                        <th> Banner </th>
                                        <th> Posición </th>
                                        <th> Número de columnas </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?= $this->Form->input('banner_id', [
                                                'options' => $banners,
                                                'div'=>false,
                                                'class' => 'form-control validateField',
                                                'label' => false,
                                                'style' => 'width:80% !important; margin-left: 5px;'
                                            ]); ?>

                                            <span style="font-size: 8px; color: red;" class="message-error"></span>
                                        </td>
                                        <td>
                                            <?= $this->Form->input('banner_posicion', [
                                                'div'=>false,
                                                'class' => 'form-control validateField',
                                                'label' => false,
                                                'style' => 'width:90% !important'
                                            ]); ?>
                                            <span style="font-size: 8px; color: red;" class="message-error"></span>
                                        </td>
                                        <td>
                                            <?= $this->Form->input('banner_columna', [
                                                'div'=>false,
                                                'class' => 'form-control validateField',
                                                'label' => false,
                                                'style' => 'width:90% !important'
                                            ]); ?>
                                            <span style="font-size: 8px; color: red;" class="message-error"></span>
                                        </td>
                                        <td align="left">
                                            <i class="fa fa-plus-circle fa-2 plus-circle" aria-hidden="true"></i>
                                            <i class="fa fa-spinner fa-spin spinner-loading" style="display: none;"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="modal-footer">
  <div class="col-lg-offset-3 col-md-6" style="text-align: center;">
    <button id="cancel-save-ciudades" type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-span btn-md btn-primary', 'id' => 'save-ciudades-btn']) ?>
  </div>
</div>


<script src="/js/ciudades/ciudades.js"></script>
<script type="text/javascript">
  $(function(){
    $('#save-ciudades').parsley().on('form:success', function() {
        $('#save-ciudades-btn').prop('disabled', 'disabled')
    });
    $('#save-ciudades').parsley();
    $('.custom-datepicker').pickadate({
      'format': 'dd/mm/yyyy',
      'formatSubmit': 'yyyy-mm-dd',
      hiddenName: true,
      selectYears: true,
      selectMonths: true,
    });
    /*$(".phone").inputmask("+52 (99) 9999 9999", {
        placeholder: " ",
        clearMaskOnLostFocus: true
    });*/
    /*$(".postal-code").inputmask("99999", {
        placeholder: " ",
        clearMaskOnLostFocus: true
    });*/
  });
    tinymce.init({
      selector: '.summernote',
      height: 500,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
      ],
      toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
    });
</script>
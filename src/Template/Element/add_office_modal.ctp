<div class="modal fade" id="officesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"><?= __('Add New Office') ?></h4>
      </div>
      <?= $this->Form->create($office, ['url' => '/offices/add', 'class' => 'form-horizontal']) ?>
        <div class="row">
          <div class="col-md-12" style="padding: 20px;">
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Name') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('name', [
                  'type'=>'text', 
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control', 
                  'data-validation' => 'required'
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Street') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('street', [
                  'type'=>'text', 
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control',
                  'data-validation' => 'required'
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Number') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('number', [
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control',
                  'data-validation' => 'required'
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Colony') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('colony', [
                  'type'=>'text', 
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control',
                  'data-validation' => 'required'
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('State') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('state_id', ['label'=>false, 'div'=>false, 'class'=>'form-control states', 'options' => $states]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Municipality') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('municipality_id', ['label'=>false, 'div'=>false, 'class'=>'form-control municipalities', 'options' => $municipalities]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Postal code') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('postal_code', [
                  'type' => 'text', 
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control postal-code',
                  'data-validation' => 'required'
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Email') ?></label>
              <div class="col-md-6">
                <div class="input-group relative-absolute">
                  <span class="input-group-addon">
                      <i class="fa fa-envelope"></i>
                  </span>
                  <div class="input text">
                    <?= $this->Form->input('email', [
                      'label'=>false, 
                      'div'=>false, 
                      'class'=>'form-control', 
                      'data-validation' => 'email',
                      'data-validation' => 'required'
                    ]) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Phone') ?></label>
              <div class="col-md-6">
                <div class="input-group relative-absolute">
                  <span class="input-group-addon">
                      <i class="fa fa-phone"></i>
                  </span>
                  <div class="input text">
                    <?= $this->Form->input('phone', [
                      'label' => false, 
                      'div' => false, 
                      'class' => 'form-control',
                      'data-validation' => 'required'
                    ]) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Año de apertura') ?></label>
              <div class="col-md-6">
                <?= $this->Form->input('opening_year', [
                  'type' => 'text', 
                  'label'=>false, 
                  'div'=>false, 
                  'class'=>'form-control',
                  'data-validation' => 'required',
                  'data-validation' => 'custom',
                  'data-validation-regexp' => '^[12][0-9]{3}$'
                ]) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-lg-offset-3 col-md-6">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-span btn-md w-btnAddUsers" id="addUserSubmitBtn" value="<?= __('Add New Office') ?>">
          </div>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.states').on('change', function(ev){
    var state  = ev.currentTarget.value;
    var target = '.municipalities';
    $(target).prop('disabled', true);
    $.get('offices/municipalities/' + state + '.json', function(response){
      $(target).empty();
      $.each(response.municipalities, function(key, name){
        var optionElement = new Option(name, key);
        $(target).append(optionElement);
      });
      $(target).prop('disabled', false);
    });
  });
</script>
<style type="text/css">
  .input.tel.has-error .help-block.form-error,
  .input.email.has-error .help-block.form-error
  {
    position: absolute;
    z-index: 9;
    top: 28px;
    left: 4px;
  }
  .modal-content .form-group .input .help-block{
    font-size: 10px !important;
    font-family: "AvenirLTStd-Light" !important;
    color: #9E2424;
  }
</style>
      <?= $this->Form->create($office, ['url' => "/offices/edit/{$office->id}", 'class' => 'form-horizontal']) ?>
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
                <?= $this->Form->input('state_id', ['label'=>false, 'div'=>false, 'class'=>"form-control states-{$office->id}", 'options' => $states]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Municipality') ?></label>
              <div class="col-md-6">
                <?php 
                  $list = [];
                  foreach ($office->state->municipalities as $municipality) {
                    $list[$municipality['id']] = $municipality['name'];
                  }
                ?>
                <?= $this->Form->input('municipality_id', ['label'=>false, 'div'=>false, 'class'=>"form-control municipalities-{$office->id}", 'options' => $list]) ?>
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
                      'label'=>false, 
                      'div'=>false, 
                      'class'=>'form-control',
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
          <div class="col-lg-offset-2 col-md-6">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-span btn-md w-btnAddUsers" id="addUserSubmitBtn" value="<?= __('Edit Office') ?>">
          </div>
        </div>
      <?= $this->Form->end() ?>
      <script type="text/javascript">
        $('.states-<?=$office->id?>').on('change', function(ev){
          var state  = ev.currentTarget.value;
          var target = '.municipalities-<?=$office->id?>';
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
        <?php
          $phone_mask="+52 (99) 9999 9999";
          if($office->state_id == 28){$phone_mask="+52 (999) 999 99 99";}
        ?>
        $(".phone").inputmask("<?php echo $phone_mask;?>", {
            placeholder: " ",
            clearMaskOnLostFocus: true
        }); 
        $(".postal-code").inputmask("99999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
        }); 
        $.validate({
            lang: 'es',
            borderColorOnError : '#c2cad8'
        });
      </script>
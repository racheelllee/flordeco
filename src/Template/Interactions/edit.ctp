    <?= $this->Form->create($interaction, ['url' => '/interactions/add','class' => 'form-horizontal', 'novalidate']) ?>
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Interaction Type') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('interaction_type_id', [
                        'options' => $interactionTypes,
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false,                         
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Length (In Hours)') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('length', [
                        'data-validation' => 'required',
                        'min' => '0',
                        'step' => '1',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false, 
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Comments') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('comments', [
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false, 
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Interaction Status') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('interaction_status_id', [
                        'options' => $interactionStatuses,
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false,                         
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Start Date') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('start_date', [
                        'type' => 'text',
                        'value' => '',
                        'data-validation' => 'required',
                        'class'=>'form-control datetimepicker', 
                        'onkeydown'=>'return false;',
                        'label'=>false, 
                        'div'=>false, 
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <p style="text-align: center;margin: 0;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-span btn-md w-btnAddUsers']) ?>
    </p>
    <?= $this->Form->end() ?>
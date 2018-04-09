    <?= $this->Form->create($interaction, ['url' => '/interactions/add','class' => 'form-horizontal', 'novalidate']) ?>
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
            <div class="form-group">
              <label class="col-md-3 control-label"><?= __('Interaction Type') ?></label>
                <div class="col-md-7">
                    <?php $i = 0; ?>
                    <div class="btn-group interaction-types" data-toggle="buttons">
                        <?php foreach ($interactionTypes as $key => $inType): ?>
                            <label class="inter-type-btn btn btn-default <?= $i == 0 ?'active' : '' ?>">
                                <li style="color: #67809F;" class="<?= $inType->icon ?>"></li>
                                <input  type="radio"
                                        name="interaction_type_id"
                                        id="interaction_type_id_<?=$inType->id?>"
                                        autocomplete="off"
                                        value="<?=$inType->id?>"
                                        <?= $i == 0 ? 'checked' : '' ?>
                                >
                                <?= $inType->name ?>
                            </label>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><?= __('Comments') ?></label>
                <div class="col-md-7">
                    <?= $this->Form->input('comments', [
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false, 
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><?= __('Interaction Status') ?></label>
                <div class="col-md-7">
                    <?php $i = 0; ?>
                    <div class="btn-group interaction-status" data-toggle="buttons">
                        <?php foreach ($interactionStatuses as $key => $inStat): ?>
                            <label  class="
                                        inter-stat-btn btn btn-xs btn-default 
                                        <?= $i == 0 ? 'active' : '' ?>">
                                <span style="background-color: <?=$inStat->color?>;">&nbsp;&nbsp;</span>
                                <input  type="radio"
                                        name="interaction_status_id"
                                        id="interaction_status_id_<?=$inStat->id?>"
                                        autocomplete="off"
                                        value="<?=$inStat->id?>"
                                        <?= $i == 0 ? 'checked' : '' ?>
                                >
                                <span><?= $inStat->name ?></span>
                            </label>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><?= __('Marcas') ?></label>
                <div class="col-md-7">
                    <?= $this->Form->input('marcas', [
                        'label'     => false,
                        'div'       => false,
                        'multiple'  => true,
                        'options'   => $marcas,
                        'class'     => 'form-control',
                        'type'      => 'select'
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><?= __('Start Date') ?></label>
                <div class="col-md-7">
                    <?= $this->Form->input('start_date', [
                        'type' => 'text',
                        'value' => date('Y-m-d H:i:s'),
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
    <script type="text/javascript">
        $('#marcas').select2();
        //$('.inter-type-btn').on('click', function(ev){
            //$('.interaction-types .inter-type-btn input').removeAttr('checked');
            //this.querySelector('input').setAttribute('checked', 'checked');
        //});
    </script>
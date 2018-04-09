<div class="modal fade" id="CotizacionesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"><?= __('Add Quote') ?></h4>
      </div>
      <?= $this->Form->create($cotizaciones, ['class' => 'form-horizontal', 'url' => 'customers/customers/add']) ?>
        <div class="row">
          <div class="col-md-12" style="padding: 20px;">
            <div class="row">
              <div class="row">
          <!-- BEGIN FORM-->
                <div class="col-md-12" style="padding: 20px;">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Customer'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('first_name', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $customers]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Customer Contact'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('first_name', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $contacts]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Customer Category'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('first_name', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $customerCategories]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Asiggned Seller'); ?></label>
                        <div class="col-md-6">

                                <?= $this->Form->input('vendedor_asignado_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $assigned]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Branch'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('sucursal_id', ['label'=>false, 'div'=>false, 'class'=>'form-control', 'options' => $branch]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label"><?php echo __('File Quote'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('archivo', ['type'=>'file' ,'label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label"><?php echo __('File Comment'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('archivo_comentarios', ['type' => 'textarea','label'=>false,'div'=>false, 'class'=>'form-control']); ?>
                            
                            
                        </div>
                    </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label"><?php echo __('Sum Total'); ?></label>
                          <div class="col-md-6">

                                <?= $this->Form->input('Users.gender',[
                                    'type'   =>  'radio',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'hidden' =>  false,
                                    'options'   =>  $options
                                ]);?>
                          </div>
                      </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Coin'); ?></label>
                        <div class="col-md-6">
                             <?= $this->Form->input('Users.position', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Discount'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('IVA'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Payment conditions'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Delivery conditions'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('Delivery Time'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo __('General Comments'); ?></label>
                        <div class="col-md-6">
                            <?= $this->Form->input('Users.phone', ['label'=>false, 'div'=>false, 'class'=>'form-control phone']); ?>
                        </div>
                    </div>
                    
                </div>
           
            <!-- END FORM-->
        </div>
            </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript" src="/js/paises.js"></script>
<script type="text/javascript">
  $('#country-id').trigger('change');
</script>
<div id="prod_details">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <br>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 producto_agotado">
               <h1>¡<?= __('Lamentamos el Inconveniente') ?>!</h1>
               <h3><?= __('El producto está agotado en esta ciudad') ?></h3>
            </div>
         </div>

         <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          



               <div class="row">
                <div class="col-xs-12">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-1">
                    <div class="inner-addon right-addon">
                      <?= __('Descripción') ?>
                      <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
                      <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12" id="tab-1">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
                    
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-2">
                    <div class="inner-addon right-addon">
                      <?= __('Políticas de envío') ?>
                      <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
                      <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12" id="tab-2">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
                    
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-3">
                    <div class="inner-addon right-addon">
                      <?= __('Políticas de sustitución') ?>
                      <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
                      <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
                    </div>
                  </div>
                 </div>
                 <div class="col-xs-12" id="tab-3">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
                    
                  </div>
                </div>
              </div>


               
            </div>
            <?php $paso = 1; ?>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
               <div class="right_detail">
                  <h1><?= __('Producto') ?></h1>
                  <div class="img_top clearfix">
                     <p class="txt_1"><span><?= __('SKU') ?></span></p>
                  </div>
              </div>  

              <div class="detalle-producto-paso">
                <span class="detalle-producto-circulo"><?= $paso++; ?></span>Selecciona tu regalo
              </div>

              <div class="row" style="padding: 16px;">

                <div class="col-xs-12 detalle-relacionados-caja">
                  <div class="col-xs-3 detalle-relacionados-img" style="">
                  </div>
                  <div class="col-xs-9 detalle-relacionados-text">
                    <?= __('Producto') ?> <br> 
                    <?= __('SKU') ?> <br> 
                    <span style="font-weight: 500;">$<?= number_format(0, 2) ?> <?= $monedas[$currency] ?></span>

                  </div>
                </div>

              </div>

              


              <div class="detalle-producto-paso">
                <span class="detalle-producto-circulo"><?= $paso++; ?></span><?= __('Fecha de entrega') ?>
              </div>

              <div class="row" style="margin-top:20px; margin-bottom:20px;">
                <div class="col-xs-12">

                        <div class="inner-addon right-addon">
                            <?= $this->Form->input('fecha_envio', ['type'=>'hidden']) ?>
                            <?= $this->Form->input('horario_entrega', ['type'=>'hidden']) ?>
                            <?= $this->Form->input('horario_entrega_preciso', ['type'=>'hidden']) ?>

                            <?= $this->Form->input('fecha_envio_leyenda', [
                                'type' => 'text',
                                'label' => false,
                                'div' => false,
                                'class' => 'input-simple',
                                'placeholder' => __('Selecciona el día de envío'),
                                'disabled' => 'disabled',
                                'style' => 'background-color: white;'
                            ]); ?> 

                          <i class="glyphicon glyphicon-calendar"></i>
                      </div>
                     


                </div>
              </div>



              <button href="#" class="purchase_btn_disabled"> 
                <?=__('Comprar')?> 
              </button>


         </div>

  
      </div>


      

      
      
   </div>
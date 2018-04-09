<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="height:70px;">
                        <div class="col-md-4">
                            <h2><?php echo __('Configuración'); ?></h2>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		  <?php echo $this->Form->create(null, ['id'=>'emailcotizar', 'action' =>'emailcotizar' , 'class'=>'m-t']); ?>

        		  	<div class="row">
        		  				<div class="col-lg-12">

        		  						<?php echo $this->Form->input('Email', [ 'value'=>$emailcotizar->value, 'type'=>'email', 'label'=>__('Email')]); ?>

        		  				</div>
        		  	</div>


        		  	<div class="row">
        		  				<div class="col-lg-12">

   <?php echo $this->Form->input('Modificar', [ 'value' =>'Modificar',  'type'=>'submit', 'label'=>__('Modificar')]); ?>


        		  				</div>
        		  	</div>

        		  <?php echo $this->Form->end(); ?>

        	</div>

        </div>
</div>
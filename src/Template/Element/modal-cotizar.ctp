

<div id="modal-cotizar" class="modal inmodal fade" aria-hidden="true" style="display: none;">
		<div style="width:80% !important;" class="modal-dialog modal-lg">
				<div class="modal-content">
						<div class="middle-box  loginscreen  animated fadeInDown" style="">
								<div>
					 
										<br><br>
						<!-- Contenido -->
												
								<div class="um-panel">
										<div class="um-panel-header text-center">
				
												<span class="um-panel-title "><h2>COTIZAR</h2></span>
				
										</div>
										<div class="um-panel-content" >
														
	<?php echo $this->Form->create(null, ['id'=>'CotizarForm', 'url' => ['controller' => 'Productos', 'action' => 'cotizar'], 'class'=>'m-t']); ?>

		<div class="row">	

				<div class="col-sm-6">	
		
			<?php if($this->UserAuth->isLogged()) { 
					$logeado = $this->UserAuth->getUser();

			?>


											 
			<?php echo $this->Form->input('nombre', [ 'class' => 'requerido', 'value' =>$logeado['User']['first_name'] . " " . $logeado['User']['last_name'] , 'type'=>'text', 'label'=>__('Nombre*')]); ?>



			<?php }else{ ?>

														
					<?php echo $this->Form->input('nombre', [ 'class' => 'requerido', 'type'=>'text', 'label'=>__('Nombre*')]); ?>

			<?php }?>


																		

			<?php echo $this->Form->input('id_producto_cotizar', [ 'class'=>'requerido', 'type'=>'hidden']); ?>
				</div>
				<div class="col-sm-6">


			<?php if($this->UserAuth->isLogged()) { 
					$logeado = $this->UserAuth->getUser();
					$calle = $colonia = $ciudad =  $cp  = "";
					if( count( $direcciones_envio->toArray() ) > 0  ){ 
						$direcciones_envio = $direcciones_envio->toArray();
						$calle =  $direcciones_envio[0]->calle ;
						$colonia = $direcciones_envio[0]->colonia;
						$ciudad = $direcciones_envio[0]->ciudad ;
		 				$cp  = $direcciones_envio[0]->codigo_postal;


					} ?>

					<?php echo $this->Form->input('Email', [ 'class' => 'requerido', 'value' => $logeado['User']['email'] ,  'type'=>'email', 'label'=>__('Email*')]); ?>

			<?php }else {  ?>

					<?php echo $this->Form->input('Email', [ 'class' => 'requerido', 'type'=>'email', 'label'=>__('Email*')]); ?>

			<?php } ?>
				</div>
		
			</div>
								
		
														
				<div class="row">									
					<div class="col-sm-6">
				<?php echo $this->Form->input('calle', [ 'value' => $calle,    'type'=>'text', 'label'=>__('Calle')]); ?>

														
					</div>
				<div class="col-sm-6">
														

				<?php echo $this->Form->input('colonia', [ 'value' => $colonia,   'type'=>'text', 'label'=>__('Colonia')]); ?>
				</div>
													
			</div>

			<div class="row">
														
				<div class="col-sm-6">
				<?php echo $this->Form->input('cp', [ 'value' => $cp ,    'type'=>'text', 'label'=>__('Código Postal')]); ?>

				</div>									
				<div class="col-sm-6">


				<?php echo $this->Form->input('ciudad', [ 'value' => $ciudad , 'class' => 'requerido',   'type'=>'text', 'label'=>__('Ciudad*')]); ?>
				</div>
														
			</div>

			<div class="row">
				<div class="col-sm-6">
				<?php echo $this->Form->input('telefono', [  'class' => 'requerido',   'type'=>'text', 'label'=>__('Teléfono*')]); ?>

				</div>
				<div class="col-sm-6">									

				<?php echo $this->Form->input('celular', [    'type'=>'text', 'label'=>__('Celular')]); ?>
			</div>

			</div>
			<div class="row">

				<div class="col-sm-12">
				<?php echo $this->Form->input('medidas', [    'type'=>'text', 'label'=>__('Medidas (m2)')]); ?>
				</div>

			</div>										
			<div class="row">
				<div class="col-sm-12">
		 		<?php echo $this->Form->input('notes', [ 'label'=>__('Comentarios'), 'type' => 'textarea', 'escape' => false]); ?>
		 		</div>
																	
		 	</div>
		 	<br>
		 	<div class="row">
		 		<div class="col-sm-12 text-right">
				<?php echo $this->Form->Button(__('Solicitar Cotización'), ['div'=>false, 'class'=>'btn btn-primary block full-width m-b', 'id'=>'cotizarSubmitBtn', 'style'=>'background:#E4680A; border:0;']); ?>
				</div>									
			</div>
		 			<br>
			
				<?php echo $this->Form->end(); ?>
										</div>
								</div>            <!-- Contenido -->
								
								</div>
						</div>
				</div>
		</div>
</div>

<script type="text/javascript">
	

	$(document).ready(function(){

				$('#modal-cotizar').on('shown.bs.modal', function (event) { 

			console.log(event.relatedTarget.dataset.productoId);


			$('#id-producto-cotizar').val( event.relatedTarget.dataset.productoId );

		});

		var checkForm = 1;

		$('#CotizarForm').submit(function(event){
			
			if( checkForm == 1) { 
				event.preventDefault()

				console.log(event);
				console.log("Hola mundo cotizar form");
		
				var valido = 1;
	
				$(".requerido").each(function (index) { 
					
				if($(this).val() == ''){
		
					$(this).addClass('obligatorio');
							valido = 0;
	
				}else{
	
					$(this).removeClass('obligatorio');
	
				}


					
				}); 



	 	
	 			if(valido == 1){
						console.log("Valido");
						checkForm = 0;

						$('#CotizarForm').submit();

          
      	}else{
      		console.log("no valido ");
  
         // alert('Faltan datos obligatorios. Todos los campos con * son obligatorios');
  
      	}


      }else{
      	// El formulario es valido 

      }



	


	 });


	});

</script>
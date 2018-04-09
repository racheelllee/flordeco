
<div id="content">
	<div class="container">

			<div class="row carrito-title-resumen">
	          <div class="col-xs-12">
	            <i class="fa fa-gift iconos-barra-title" aria-hidden="true"></i><span style="margin-left:40px;"><?= __('Agregar un Regalo Adicional') ?></span>
	          </div>
	        </div>
			<div id="prod_details">
					
					<?php foreach ($categorias as $key => $categoria) { ?>
						<div class="adicionales-titles"><?= $categoria['categoria']->nombre ?></div>
						<div class="row row-scroll-horizontal" id="<?= $categoria['categoria']->url ?>">
						<?php foreach ($categoria['productos'] as $key => $producto) { ?>
				 
							<div class="detalle-adicionales-caja agregar-adicional" data-id="<?= $producto->id ?>" style="margin-top:10px; max-width: 33%; min-width: 350px;">
								<div class="col-xs-6 detalle-relacionados-img" style="background-image: url(/img/productos/original/<?=$producto->imagenes[0]->nombre?>);">
								</div>
								<div class="col-xs-6 detalle-adicionales-text">
									<?= $producto->nombre ?> <br> 
									<span style="font-size: 12px;"><?= $producto->descripcion_corta ?></span> <br> 
									<span style="font-weight: 500;">$<?= number_format((($currency==1)? $producto[$ciudad->precio] : $producto[$ciudad->precio] / $tipocambio), 2) ?> <?= $monedas[$currency] ?></span>
								</div>
								<div id="overlay-<?= $producto->id ?>" class=""></div>
							</div>

						<?php } ?>
						</div>
					<?php } ?>
				 
			</div>

			<button class="hacer-pedido"> 
                <?=__('Continuar')?> 
            </button>
	</div>
</div>



<script type="text/javascript">

	var adicionales = [];

	$('.hacer-pedido').click(function(){
			
			 var ciudad_url = '<?= $ciudadUrl ?>';
			 var cantidad = 1;

			 

			 	$.ajax({

					 type: 'POST',
					 url: '<?php echo $this->Url->build(["action" => "agregar_adicionales"]); ?>',
					 data: {
					 		 ciudad_url:ciudad_url,
							 adicionales:adicionales,
							 cantidad:cantidad
					 },
					 dataType: 'json',
					 success: function(data){

							 location.href = data;
			 
					 }

			 	});

	 });
	 
	
	 $('.agregar-adicional').click(function(){

	 	var id = $(this).data('id');

	 	var index = adicionales.indexOf(id);
	 	if(index < 0){
	 		adicionales.push(id); 
	 		$('#overlay-'+id).addClass('overlay-adicionales');
	 	}else{
	 		adicionales.splice(index, 1);
	 		$('#overlay-'+id).removeClass('overlay-adicionales');
	 	}

	 	console.log(adicionales);
	 	
	 });
</script>

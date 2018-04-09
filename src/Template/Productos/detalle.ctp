<?php //debug($producto);
	 $scriptsSimilares="";
	 $scriptsComplementos="";?>

<div id="content">
	 <div class="container">
		<?php if(count($producto) > 0){ 

			if($producto->estatus_id != 0 && $producto->estatus_id != 2){

				echo $this->element($element_base);

			}else{

				echo $this->element('Productos/detalle_no_existe');

			}

		}else{ 

			echo $this->element('Productos/detalle_no_existe');

		} ?>
</div>
</div>

<?= $this->element('Productos/modalCalendario'); ?>


<script type="text/javascript">

	var currency = <?= $currency ?>;

	$(function () {
	   $('[data-toggle="popover"]').popover()
	})
	 
	
	 
	 $('.purchase_btn').click(function(){
			
			 var ciudad_url = '<?= $ciudadUrl ?>';
			 var id_producto = '<?= $producto->id ?>';
			 var cantidad = 1;
			 var mensaje_personalizado = $('#mensaje-personalizado').val();

			 if(mensaje_personalizado == undefined){
			 	mensaje_personalizado = false;
			 }

			 var detalle_envio = {
			 	fecha: $('#fecha-envio').val(),
			 	ciudad_horario_entrega_id: $('#horario-entrega').val(),
			 	ciudad_horario_entrega_preciso_id: $('#horario-entrega-preciso').val()
			 };

			 if(detalle_envio.ciudad_horario_entrega_id > 0 || detalle_envio.ciudad_horario_entrega_preciso_id > 0){

			 	$.ajax({

					 type: 'POST',
					 url: '<?php echo $this->Url->build(["action" => "agregar_carrito"]); ?>',
					 data: {
					 		 ciudad_url:ciudad_url,
							 id_producto:id_producto,
							 cantidad:cantidad,
							 mensaje_personalizado:mensaje_personalizado,
							 detalle_envio:detalle_envio
					 },
					 dataType: 'json',
					 success: function(data){

							location.href = data;
			 
					 }

			 	})

			 }else{
			 	alert('<?= __("Favor de Seleccionar una Fecha de Envio") ?>');
			 }
	 });
	 



	// NUEVO CODIGO
	$('#tab-1').hide();
	$('#tab-2').hide();
	$('#tab-3').hide();

	$('.detalle-producto-tabs').click(function() {
		var tab = $(this).data('tab'); 

		if( $('#'+tab).is(":visible") ){
		 	$('#'+tab).hide();
		 
		 	$(this).find( '.glyphicon-chevron-up' ).hide();
		 	$(this).find( '.glyphicon-chevron-down' ).show();
		}else{
		   	$('#'+tab).show();

		   	$(this).find( '.glyphicon-chevron-up' ).show();
		 	$(this).find( '.glyphicon-chevron-down' ).hide();
		}
	});

	$('.ver-producto-relacionado').click(function() {
		var url = $(this).data('url'); 
		var ciudad_url = '<?= $ciudadUrl ?>';

		var url_base = '<?= $url_base ?>';

		location.href = url_base+'/'+url;
	});
	
	 
</script>

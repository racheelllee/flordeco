<style type="text/css">
	.hasEvent > span{
		width: 100%;
	    display: block;
	    text-align: center;
	}
	.hasEvent > p{
		width: 100%;
	    display: block;
	    text-align: right;
	}

	.fc-other-month > p{
	    opacity: 0.3;
	}

	.fc-other-month > span{
	    opacity: 0.3;
	}
</style>

<script>
	var ultimoValido = null;
	var fecha_seleccionada = '<?= $fecha_seleccionada ?>';

	$(document).ready(function() {
	    
	
		
		var events = <?= json_encode($eventos) ?>;
		var noDispobible = <?= json_encode($noDispobible) ?>;

		var calendar =  $('#calendar').fullCalendar({
			lang: 'es',
			defaultDate: moment(new Date('<?= $time->format("Y-m-d") ?>')).format('YYYY-MM-DD'),
			header: {
				left: 'title',
				center: '',
				right: 'month, prev, next'
			},
			editable: false,
			firstDay: 1,
			selectable: true,
			defaultView: 'month',
			
			
            titleFormat: {
                month: 'MMMM YYYY', 
                week: "MMMM YYYY", 
                day: 'MMMM YYYY'           
            },
			allDaySlot: false,
			selectHelper: true,
			select: function(start, end, allDay) {
				
			},
			droppable: false, 
			drop: function(date, allDay) {
			
				
			},
			displayEventEnd: false,
			events: events,
			select: function(start, end, jsEvent, view) {

				var valido = true;

				$('.hasEvent').html('');
				$('.hasEvent').removeClass('hasEvent');

	            if (moment().diff(start.format('YYYY-MM-DD'), 'days') > 0) {
	                $('#calendar').fullCalendar('unselect');
	                valido = false;
	            }	

	            if(moment(end).diff(start, 'days') > 1){
			        $('#calendar').fullCalendar('unselect');
			        valido = false;
			    }	

			    $.each(noDispobible, function( index, value ) { 
				 	if(moment(value.start).format('YYYY-MM-DD') == moment(start).format('YYYY-MM-DD')){
				 		$('#calendar').fullCalendar('unselect');
			        	valido = false;
				 	}
				});

			    if(valido == true){
					var dias = moment(start.format('YYYY-MM-DD')).diff(moment().subtract(1, "days"), 'days'); 

					ultimoValido = start.format('YYYY-MM-DD');
					$("#modalCalendario .modal-content").load('/productos/producto_calendario/<?= $ciudad_id ?>/<?= $producto_id ?>/' + dias + '/1');
			    }else{
			    	$('[data-date="'+ultimoValido+'"]').addClass('hasEvent');
			    }
	        }	
		});

		ultimoValido = '<?= $time->format("Y-m-d") ?>';

		if(fecha_seleccionada){
			$('[data-date="'+ultimoValido+'"]').addClass('hasEvent');

			//$('.hasEvent').html('<p><?= $time->format("d") + 0 ?></p> <span>$<?= ( ( $currency == 2 )? number_format($costo_envio / $tipocambio, 2) : number_format($costo_envio, 2) ).' '.$monedas[$currency] ?></span>');	
		}

		$('.fc-today').removeClass('fc-today');
		
	});

</script>

<div id="calendar" class="detalle-productos-calendario"></div>

<div style="display:<?= ($fecha_seleccionada)? 'block' : 'none'; ?>;">
	<h2 class="h2-calendario-detalle">
		Escoge el rango de horario para entrega

		<button class="btn btn-white info-calendario-detalle" type="button" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="auto top" data-html="true" data-content="Aquí va la información"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
	</h2>

	<div class="rango-entrega-caja"> 

		<?php foreach ($horarios as $key => $horario) { ?>
			
			<div class="rango-entrega" data-position="<?= $key ?>" data-disponible="<?= $horario->disponible ?>" style="<?= (!$horario->disponible)? 'background-color:#d9dade;' : '' ?>">
				<span style="font-weight: 500; color: #8c8a8a;"><?= __($horario->titulo) ?></span>
				<br>
				<span style="font-size: 10px;color: #8c8a8a;"><?= $horario->desde->format('g:i A').' '.__('a').' '.$horario->hasta->format('g:i A') ?></span>
			</div>

		<?php } ?>

	</div>

	<div style="display:none;" id="seleccion-horario">

		<h2 class="h2-calendario-detalle">
			¿Quieres un rango de entrega más preciso?

			<button class="btn btn-white info-calendario-detalle" type="button" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="auto top" data-html="true" data-content="Aquí va la información"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
		</h2>

		<div class="rango-entrega-caja" style="height:auto; padding: 20px;"> 
			<?= $this->Form->input('rango_precio', [
		        'type' => 'select',
		        'label' => false,
		        'div' => false,
		        'empty' => __('Omitir esta opción'),
		        'options' => [],
		        'class' => 'select-simple',
		        'style' => 'margin-bottom: 0px;'
		    ]); ?> 
		</div>
		<br>
		<p align="center">
			<a href="#" class="calendario-detalle-continuar" style="text-decoration:none;"> <?=__('Continuar')?> </a>
		</p>
	
	</div>

</div>

<script type="text/javascript">

	var currency = <?= $currency ?>;

	$(function () {
	   $('[data-toggle="popover"]').popover()
	})

	
	$('.rango-entrega').click(function(){  
        
		var this_ = $(this);

        var position = $(this).data('position');
        var disponible = $(this).data('disponible');

        var horarios = <?= json_encode($horarios) ?>;

        $('.rango-entrega-seleccionado').removeClass('rango-entrega-seleccionado');

        if(disponible){

        	var fecha = moment(ultimoValido).format('DD-MM-YYYY');
        	var desde = moment(horarios[position].desde).format('LT');	
          	var hasta = moment(horarios[position].hasta).format('LT');

        	$('#horario-entrega').val(horarios[position].id);
        	$('#fecha-envio').val(ultimoValido);
        	$('#fecha-envio-leyenda').val('<?= __('Entrega el') ?> '+ fecha +' de '+ desde +' <?= __('a') ?> '+ hasta);
        	$('#horario-entrega-preciso').val('');

        	this_.addClass('rango-entrega-seleccionado');

        	$('#rango-precio').html('').append('');    
        	$('#rango-precio').append('<option value=""><?= __('Omitir esta opción') ?></option>');  
          	$.each(horarios[position].ciudad_horario_entrega_precisos, function(k,v){

          		var desde = moment(v.desde).format('LT');
          		
          		var hasta = moment(v.hasta).format('LT');
          		
          		var costo = v.costo_pesos;

          		var tipocambio = <?= $tipocambio ?>;

          		if(currency == 2){ costo = costo / tipocambio; }

              $('#rango-precio').append('<option value="'+v.id+'"> <?= __('Entrega el') ?> '+ fecha +' de '+ desde +' <?= __('a') ?> '+ hasta +' + $'+costo.toFixed(2)+' <?= $monedas[$currency] ?></option>');   
                    
          	})

          	$('#seleccion-horario').show();

        }else{
        	$('#rango-precio').html('').append('');
          	$('#rango-precio').append('<option value=""><?= __('Omitir esta opción') ?></option>'); 

          	$('#seleccion-horario').hide();
        }

    });

    $('.calendario-detalle-continuar').click(function(){ 
    	var horario_entrega = $('#horario-entrega').val();
    	var rango_precio_preciso = $('#rango-precio').val();

    	if(rango_precio_preciso > 0){
    		var rango_precio_leyenda = $('#rango-precio').find(":selected").text();
			$('#fecha-envio-leyenda').val(rango_precio_leyenda);
		}
    	
    	$('#horario-entrega-preciso').val(rango_precio_preciso);

    	$('#modalCalendario').modal('hide');

    });
</script>

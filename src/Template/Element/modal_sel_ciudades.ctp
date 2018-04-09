<div id="modal-cotizar" class="modal inmodal fade" aria-hidden="true" data-backdrop="static" style="display: none;">
	<div style="width:55% !important;" class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="middle-box  loginscreen  animated fadeInDown" style="">
				<div>
					<br><br>
					<!-- Contenido -->
					<div class="um-panel">
						<div class="um-panel-header text-center">
							<span class="um-panel-title "><h3>Selecciona la ciudad donde deseas entregar</h3></span>
						</div>
					</div>
					<br><br>
					<div class="col-md-12">
						<?=
                            $this->Form->select(
                                'ciudad_url',
                                $ciudades,
                                [
                                    'id' => 'ciudad-url',
                                    'empty' => __('Ciudad'),
                                    'class' => 'select-ciudad'
                                ]
                            );
                        ?>
		            </div>
		            <br><br>
				</div>
				<div class="modal-footer" style="background-color: #FFF; border-color: inherit; border:none;">
		          <button type="button" class="btn btn-span btn-md w-btnSelCiudad" onclick="selCiudad();" id="btnSelCiudad"><?=__('Continuar')?></button>
		        </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function selCiudad()
{
	var ciudad_url = $('#ciudad-url').val();
	if (ciudad_url == '') { return; }

	window.location = '/<?= $estadourl ?>/ciudad/' + ciudad_url;
}

$(document).ready(function(){

	$('#modal-cotizar').on('shown.bs.modal', function (event) {

	});

	$('#modal-cotizar').modal('show');
});
</script>
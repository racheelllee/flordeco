
<div class="section">
	      <div class="container">
	        <div class="row">
	          <div class="col-md-12">
	            
	            <div class="page-header">
		            <h3> <?php echo __('Hi {0}.', [$userEntity['first_name']]) ?> </h3><br><br>

		            <p style="font-size: 16px"><?php echo __('Starting this moment you can access to {0}',[SITE_NAME]) ?> </p>
		         

	            </div>

	            <table style="width:100%;" class="table">
	              <thead>
	                <tr></tr>
	              </thead>
	              <tbody>

	  				
	                <tr>
	                <td colspan="2"> 
	                	<p style="font-size: 16px"> Por favor dirígete a:<p> 

	                	<?php echo $link ?> <br/>

	                	<br/>

	                	<p style="font-size: 16px"> Para que puedas proporcionar una nueva contraseña.</p> 
	                	<br>
	                	<p style="font-size:16px;">
	                		Como ayuda para iniciar el uso del sistema, puedes tener como referencia los siguientes videos:
	                		<br><br>
							Para utilizar la sección de <b>Clientes</b>:
						</p> 
							https://youtu.be/yL_0II4SoWM
							

						<br>
						<p style="font-size:16px;">
							Para utilizar las secciones de <b>Cotizaciones, Cargos y Facturas</b>: 
	                	</p>
	                		https://youtu.be/Ws_P8IhHphQ
	                </td>
	               	</tr>
	               	
	                <tr>

	                
	                </tbody>
	            </table>
	          </div>
	          <div class="col-md-12">
	          		<p  style="font-size: 14px"> <?php echo __('In the face of anywhere problem access, you have question about account or the<br>privileges assigned, please contact the support area.') ?> </p>
	        <p  style="font-size: 14px"> <?php echo __('Atentamente<br>{0}.',[SITE_NAME]); ?> <p>
	          </div>
	        </div>
	      </div>
	    </div>

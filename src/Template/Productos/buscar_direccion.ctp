<!-- https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete?csw=1 -->
<!-- https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform?hl=es-419 -->

<style>
  #map {
    height: 200px;
    margin-bottom: 15px;
  }
  .controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  #pac-input {
    background-color: #fff;
    font-size: 15px;
    font-weight: 300;
    text-overflow: ellipsis;
    margin-bottom: 15px; 
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  .pac-container {
    font-family: Roboto;
    z-index: 1051 !important;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
</style>

<div class="row" style="margin-bottom:15px;">
    <div class="col-xs-12">
      <h5 class="envioypago-title"><?= __('Agregar Dirección') ?></h5>
    </div>
</div>

<form action="/productos/editar_datos_usuario" method="post" id="form-direccion">

  <?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>'0')); ?>

  <div class="row">
      <div class="col-xs-12">
        <label class="login-pedido-label">Nombre del Destinatario</label>
        <?php echo $this->Form->input('nombre_destinatario', array('class'=>'login-pedido-input requerido', 'label'=>false)); ?>
      </div>

      <div class="col-xs-12">
        <label class="login-pedido-label">Télefono del Destinatario</label>
        <?php echo $this->Form->input('telefono_destinatario', array('class'=>'login-pedido-input requerido', 'label'=>false)); ?>
      </div>

      <div class="col-xs-12" style="text-align:right;">
        <input type="checkbox" name="utilizar_mapa" id="utilizar_mapa" value="1" checked><label class="login-pedido-label"><span style="font-size: 20px;"><span></span></span>Utilizar Mapa</label>
      </div>
  </div>

  <div class="row">
      <div class="col-xs-12" id="buscar-direccion">
        <label class="login-pedido-label">Buscar Dirección</label>
        <input id="pac-input" class="login-pedido-input form-control" type="text" placeholder="Ingresa tu Dirección">
        <div id="map"></div>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <label class="login-pedido-label">Calle</label>
        <?php echo $this->Form->input('calle', array('class'=>'login-pedido-input requerido', 'label'=>false,  'data-idmaps'=>'route')); ?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
        <label class="login-pedido-label">Número</label>
        <?php echo $this->Form->input('numero_exterior', array('class'=>'login-pedido-input requerido', 'label'=>false,  'data-idmaps'=>'street_number')); ?>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <label class="login-pedido-label">Colonia</label>
        <?php echo $this->Form->input('colonia', array('class'=>'login-pedido-input requerido', 'label'=>false,  'data-idmaps'=>'sublocality_level_1')); ?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
        <label class="login-pedido-label">Código Postal</label>
        <?php echo $this->Form->input('codigo_postal', array('class'=>'login-pedido-input requerido', 'label'=>false,  'data-idmaps'=>'postal_code')); ?>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
        <label class="login-pedido-label">Tipo de Domicilio</label>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <?php 
            echo $this->Form->input(
              'direccion_tipo_id',
              ['options' => $direcciones_tipos, 
              //'empty' => __('Seleccion el tipo de domicilio'),
              'label' => false]
            );
        ?>
      </div>
  </div>

  <div class="row">
      <div class="col-xs-4">
        <label class="login-pedido-label">Ciudad:</label> <span id="locality"></span>
        <?php echo $this->Form->input('ciudad', array('type'=>'hidden', 'label'=>false, 'data-idmaps'=>'locality')); ?>
      </div>

      <div class="col-xs-4">
        <label class="login-pedido-label">Estado:</label> <span id="administrative_area_level_1"></span>
        <?php echo $this->Form->input('estado', array('type'=>'hidden', 'label'=>false, 'data-idmaps'=>'administrative_area_level_1')); ?>
      </div>

      <div class="col-xs-4">
        <label class="login-pedido-label">País:</label> <span id="country"></span>
        <?php echo $this->Form->input('pais', array('type'=>'hidden', 'label'=>false, 'data-idmaps'=>'country')); ?>
      </div>
  </div>


<div class="row" style="margin-bottom:15px; margin-top:15px;">
    <div class="col-xs-12" style="text-align: right;">
      <button class="btn" type="button" id="cancelar-maps">Cancelar</button>
      <button class="btn btn-guardar" type="button" id="guardar-maps">Guardar</button>
    </div>
</div>
</form>

<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 24.1615115, lng: -107.017747},
      zoom: 13
    });
    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('pac-input'));

    /*var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);*/

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace(); console.log(autocomplete.getPlace());

      var componentForm = {
        street_number: 'long_name',
        sublocality_level_1: 'long_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0]; 
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          
          $('#' + addressType).text(val);
          $('[data-idmaps="' + addressType + '"]').val(val);
        }
      }

      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setIcon(/** @type {google.maps.Icon} */({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
      }));
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, marker);
    });

    autocomplete.setTypes(['address']);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARaUp82tGgNQs0GuIG0Y1jVMvEtjjcvMM&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
  $('#utilizar_mapa').click(function() {
      if (!$(this).is(':checked')) { 
        $('#buscar-direccion').hide();
      }else{
        $('#buscar-direccion').show();
      }
  });

  $('#cancelar-maps').click(function() {
      $('#modalMapa').modal('hide');
  });

  $('#guardar-maps').click(function() {
      $('#form-direccion').submit();
  });


  //https://www.sitepoint.com/basic-jquery-form-validation-tutorial/
  $("#form-direccion").validate({
    rules: {
      nombre_destinatario: "required",
      telefono_destinatario: "required",
      calle: "required",
      numero_exterior: "required",
      colonia: "required",
      codigo_postal: "required",
    },
    messages: {
      nombre_destinatario: "<?= __('Este dato es requerido') ?>",
      telefono_destinatario: "<?= __('Este dato es requerido') ?>",
      calle: "<?= __('Este dato es requerido') ?>",
      numero_exterior: "<?= __('Este dato es requerido') ?>",
      colonia: "<?= __('Este dato es requerido') ?>",
      codigo_postal: "<?= __('Este dato es requerido') ?>",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
</script>
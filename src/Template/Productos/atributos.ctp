<div class="row">
  <div class="col-xs-12 col-sm-12 col-lg-10" id="Atributos">

  </div>
</div>

<script type="text/javascript">
  $( "#Atributos" ).load('/atributos/add/<?php echo $producto->id; ?>', function() {

        $(document).on({click: function(e){        
                    $.ajax({
                        url: '/atributos/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_atributo").serialize(),
                    })
                    .done(function(data) {
                        $('#Atributos').load('/atributos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.agregar_atributo');


        $(document).on({click: function(e){  

              var atributo_id = $(this).data('id');

                  
                    $.ajax({
                        url: '/atributos/delete',
                        type: 'POST',
                        dataType: 'html', 
                        data:{ atributo_id: atributo_id },
                    })
                    .done(function(data) {
                        $('#Atributos').load('/atributos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.eliminar_atributo');


        $(document).on({click: function(e){      

          var id = $(this).data('id');

                    $.ajax({
                        url: '/opciones/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_opciones"+id).serialize(),
                    })
                    .done(function(data) {
                        $('#Atributos').load('/atributos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.agregar_opcion');


        $(document).on({click: function(e){  

              var opcion_id = $(this).data('id');

                  
                    $.ajax({
                        url: '/opciones/delete',
                        type: 'POST',
                        dataType: 'html', 
                        data:{ opcion_id: opcion_id },
                    })
                    .done(function(data) {
                        $('#Atributos').load('/atributos/add/<?php echo $producto->id; ?>');
                    });
        }}, '.eliminar_opcion');

    });

</script>
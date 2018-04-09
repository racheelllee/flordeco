$('#estado-id').on('change', function(ev){
    $('#estado-id').prop('disbled');
    $.get('/categorias/getCiudades/' + $('#estado-id').val() + '.json', function(res){
        if (res) {
            $('#ciudad-id').empty();
            $.each(JSON.parse(res), function(item, value){

                $('#ciudad-id').append($('<option>', { 
                    value: item,
                    text : value 
                }));
            });
            if ($('#estado-id').val() == estadoId && municipioId) {$('#ciudad-id').val(municipioId);}
        }
    }).always(function(){
        $('#estado-id').removeAttr('disbled');
    });
});
$('#estado-id').trigger('change');
  <div id="updateProductosIndex">
    <?php echo $this->Search->searchForm('Productos', ['legend'=>false, 'updateDivId'=>'updateProductosIndex']); ?>
    <?php //echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateProductosIndex']); ?>

    <?php echo $this->Form->create('Productos', ['id'=>'productosForm', 'role'=>'form']); ?>
    <?php echo $this->Form->input('columna', ['type' => 'hidden']);?>
    <br>

    <table class="table table-striped table-bordered table-condensed table-hover" style="background-color: #FFFFFF;">
        <thead style="background-color: #FFFFFF;">
            <tr>
                <th>
                    <?php echo $this->Form->checkbox('checkAll', ['hiddenField' => false, 'class'=>'checkAll']); ?>
                </th>
                <th class="psorting"><?= $this->Paginator->sort('estatus_id', 'Estatus')?>
                <a data-toggle="modal" data-target="#estatus_idModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('sku') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('codigo_fabricante')?></th>
                <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('proveedor_id') ?>
                </th>
                <th class="psorting"><?= $this->Paginator->sort('marca_id') ?>
                    <a data-toggle="modal" data-target="#marcaModal"><i class="fa fa-pencil-square-o"></i></a>
                </th>
                <th class="psorting">Categorias<a data-toggle="modal" data-target="#categoriaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('existencia') ?>
                <a data-toggle="modal" data-target="#existenciaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('garantia') ?>
                <a data-toggle="modal" data-target="#garantiaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Peso y Medidas
                <a data-toggle="modal" data-target="#pesoModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('costo') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('margen') ?>
                <a data-toggle="modal" data-target="#margenModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('margen','Ganancia')?>
                <a data-toggle="modal" data-target="#gananciaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting"><?= $this->Paginator->sort('precio') ?></th>
                <th class="psorting"><?= $this->Paginator->sort('envio_gratis') ?>
                <a data-toggle="modal" data-target="#envio_gratisModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Descripción
                <a data-toggle="modal" data-target="#descripcion_cortaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Push
                <a data-toggle="modal" data-target="#frase_pushModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Descripción Larga
                <a data-toggle="modal" data-target="#descripcion_largaModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">SEO 
                <a data-toggle="modal" data-target="#meta_keywordsModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Imagenes</th>
                <th class="psorting">Atributos
                <a data-toggle="modal" data-target="#atributosModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Complementos
                <a data-toggle="modal" data-target="#complementosModal"><i class="fa fa-pencil-square-o"></i></a></th>
                <th class="psorting">Actualizacion</th>
              
            </tr>
        </thead>
        <tbody style="background-color: #FFFFFF;">
    <?php   if(!empty($productos)) {
                $page = $this->request->params['paging']['Productos']['page'];
                $limit = $this->request->params['paging']['Productos']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($productos as $producto): 
                    $i++;
                #debug($producto);
            ?>
             <tr>
              <td> <?php echo $this->Form->checkbox('check[]', ['hiddenField' => false, 'value'=>$producto->id, 'class'=>'check_producto']); ?></td>
              <td align="center"><p>
             <a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/estatus_id" alt="<?php echo $producto->productosEstatuses['nombre']; ?>"><span class="badge" style="background-color:<?php echo $producto->productosEstatuses['color']; ?>;"> &nbsp;&nbsp; </span></a></p></td>
            <td id="sku_<?php echo $producto->id ?>"><a href="/productos/editmodal/<?php echo $producto->id ?>/sku" class='modal-link' data-id="sku_<?php echo $producto->id ?>">
            <?= h($producto->sku) ?>
            </a></td>
            <td><a href="/productos/editmodal/<?php echo $producto->id ?>/codigo_fabricante"  class='modal-link'>
            <?= h($producto->codigo_fabricante) ?>
            </a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/nombre"><?= h($producto->nombre) ?></a></td>
            <td><?php if(isset($producto->proveedor->nombre)):?>
                    <?php echo h($producto->proveedor->nombre);?>
                <?php endif;?></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/marca_id"><?php if(isset($producto->marca->nombre)):?>
            <?= h($producto->marca->nombre) ?>
        <?php endif;?></a></td>
            <td><a class='frameModal' href="/categorias_productos/add/<?php echo $producto->id ?>/1"><?php 
                if(!isset($producto->categorias[0])){echo '<i class="fa fa-pencil-square-o"></i>';}
                foreach($producto->categorias as $categoria){
                    echo $categoria->nombre ."<br>";
                };?></a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/existencia"><?= h($producto->existencia) ?>
            </a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/garantia">
            <?php 
                if($producto->garantia ==''){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    echo h($producto->garantia); 
                }
            ?>
            </a></td>
            <td><a class='modal-link' href="/productos/editarpeso/<?php echo $producto->id ?>">
            <?php 
                if(($producto->largo =='' || $producto->largo ==0)
                    && ($producto->ancho =='' || $producto->ancho ==0 )
                    && ($producto->alto =='' || $producto->alto ==0 )
                    && ($producto->peso =='' || $producto->peso ==0 )
                 ){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    ?>
                    M:<?php echo $producto->largo; ?>x<?php echo $producto->ancho; ?>x<?php echo $producto->alto; ?><br>
                    P:<?php echo $producto->peso; ?>kg<br>
                    <?php
                }
            ?>
            </a></td>
            <td>  <a class='frameModal' href="/precios/view/<?php echo $producto->id ?>">$<?= number_format($producto->costo,2) ?></a>
</td>
            <td><a class='frameModal' href="/precios/view/<?php echo $producto->id ?>"><?= number_format($producto->margen,2) ?>%</a></td>
            <td><a class='frameModal' href="/precios/view/<?php echo $producto->id ?>">$<?= number_format((($producto->margen/100)*$producto->costo),2) ?></a></td>
            <td><a class='frameModal' href="/precios/view/<?php echo $producto->id ?>">$<?= number_format($producto->precio,2) ?></a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/envio_gratis"><?= $sino[$producto->envio_gratis]; ?></a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/descripcion_corta">
            <?php 
                if($producto->descripcion_corta ==''){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    echo h(substr($producto->descripcion_corta,0,20))."..."; 
                }
            ?>
            </a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/frase_push">
            <?php 
                if($producto->frase_push ==''){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    echo h(substr($producto->frase_push,0,20))."..."; 
                }
            ?></a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/descripcion_larga">
            <?php 
                if($producto->descripcion_larga ==''){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    echo h(substr($producto->descripcion_larga,0,20))."..."; 
                }
            ?></a></td>
            <td><a class='modal-link' href="/productos/editmodal/<?php echo $producto->id ?>/meta_keywords"><?php 
                if($producto->meta_keywords ==''){echo '<i class="fa fa-pencil-square-o"></i>';
                }
                else{
                    echo h(substr($producto->meta_keywords,0,20))."..."; 
                }
            ?></a></td>
            <td><a class='frameModal' href="/imagenes/index/<?php echo $producto->id ?>">Imagenes</a></td>
            <td><a class='frameModal' href="/productos/atributos/<?php echo $producto->id ?>">Atributos</a></td>
            <td><a class='frameModal' href="/productos/relacionados/<?php echo $producto->id ?>">Complementos</a></td>
            <td><?= h($producto->Actualizacion) ?></td>
        </tr>
    <?php endforeach; 

      } else {
            echo "<tr><td colspan=7><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>

<!-- Campos ocultos de edición masiva. -->

<?php echo $this->Form->input('marca_id', ['type' => 'hidden']);?>
<?php echo $this->Form->input('garantia', ['type' => 'hidden']);?>
<?php echo $this->Form->input('existencia', ['type' => 'hidden']);?>
<?php echo $this->Form->input('tiempo_de_entrega', ['type' => 'hidden']);?>
<?php echo $this->Form->input('envio_gratis', ['type' => 'hidden']);?>
<?php echo $this->Form->input('descripcion_corta', ['type' => 'hidden']);?>
<?php echo $this->Form->input('frase_push', ['type' => 'hidden']);?>
<?php echo $this->Form->input('descripcion_larga', ['type' => 'hidden']);?>
<?php echo $this->Form->input('meta_keywords', ['type' => 'hidden']);?>
<?php echo $this->Form->input('estatus_id',['type' => 'hidden']);?>
<?php echo $this->Form->input('categoria_id', ['type' => 'hidden']);?>
<?php echo $this->Form->input('mlargo', ['type' => 'hidden']);?>
<?php echo $this->Form->input('mancho', ['type' => 'hidden']);?>
<?php echo $this->Form->input('malto', ['type' => 'hidden']);?>
<?php echo $this->Form->input('mpeso', ['type' => 'hidden']);?>
<?php echo $this->Form->input('mpeso_volumetrico', ['type' => 'hidden']);?>
<?php echo $this->Form->input('atributo_1', ['type' => 'hidden']);?>
<?php echo $this->Form->input('atributo_2', ['type' => 'hidden']);?>
<?php echo $this->Form->input('atributo_3', ['type' => 'hidden']);?>
<?php echo $this->Form->input('atributo_4', ['type' => 'hidden']);?>
<?php echo $this->Form->input('atributo_5', ['type' => 'hidden']);?>
<?php echo $this->Form->input('margen', ['type' => 'hidden']);?>
<?php echo $this->Form->input('ganancia', ['type' => 'hidden']);?>
<?php echo $this->Form->input('producto_relacionados', ['type' => 'hidden']);?>
<?php echo $this->Form->input('categoria_relacionada', ['type' => 'hidden']);?>

<!-- Terminan Campos ocultos de edición masiva. -->





    <?php echo $this->Form->end();?>
    <?php if(!empty($productos)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>
<script type="text/javascript">
$( document ).ready(function() {
  <?php if((!is_null($categoria_selected)) && ($categoria_selected != '')):?>
    $('#categorias-id').val(<?php echo $categoria_selected;?>).change();
    <?php endif;?>
    });

</script>

<script>
    $(document).on({change: function(e){ 

            var check =  this.checked;

            $('input[class=check_producto]').prop('checked',check);

        }}, '.checkAll');

    $('#accordion').on('show.bs.collapse', function () {
        $('#accordion .in').collapse('hide');
        });



$(function() {
    $(".modal-link").click(function(event) {
        event.preventDefault()
    $('#myModal').removeData("bs.modal");
    $('#myModal').modal({remote: $(this).attr("href")});
    })
});

$('#myModal').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});


function editAjax(boton){
    alert($(boton).attr("data-columna"));
    $.ajax({
           type: "POST",
           url: $(boton).attr("action"),
           data: $(boton).serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
}

$('.ajax-link').click(function(event) {
   event.preventDefault();
   var did=$(this).attr("data-id");
   $.ajax({
           type: "GET",
           url: $(this).attr("href"),
           success: function(data)
           {
                
                //alert(did);
               $("#"+did).html(data); // show response from the php script.
           }
         });

    return false;
});

  function calcula_peso_volumetrico(){
  largo=$('#largo').val();
  ancho=$('#ancho').val();
  alto=$('#alto').val();

  $('#volumen').val(((largo/100)*(ancho/100)*(alto/100)));

  //alert(largo+","+ancho+","+alto);
  if(largo >0 && ancho >0 && alto >0){
    $('#peso-volumetrico').val((largo*ancho*alto)/5000);
  }
}

function calcula_peso_volumetrico_val(){
  largo=$('#val-largo').val();
  ancho=$('#val-ancho').val();
  alto=$('#val-alto').val();
  $('#val-volumen').val(((largo/100)*(ancho/100)*(alto/100)));
  //alert(largo+","+ancho+","+alto);
  if(largo >0 && ancho >0 && alto >0){
    $('#val-peso-volumetrico').val((largo*ancho*alto)/5000);  
  }
}


$('.frameModal').click(function(event){
  event.preventDefault();
  var frameSrc = $(this).attr('href');
  //alert(frameSrc);
  $('#myIframe').attr("src",frameSrc);
  $('#myFrameModal').modal();
});

$( document ).ready(function() {
  <?php if((!is_null($categoria_selected)) && ($categoria_selected != '')):?>
    $('#categorias-id').val(<?php echo $categoria_selected;?>).change();
    <?php endif;?>



    $( "#RelacionadosAllBusqueda" ).load('/complementos_productos/busqueda/null/null/null/null/1', function() {
        $(document).on({click: function(e){        
          
          var palabra = $( "#palabra-busqueda" ).val();
          var categoria = $( "#categoria-busqueda" ).val();
          var proveedor = $( "#proveedor-busqueda" ).val();
          var marca = $( "#marca-busqueda" ).val();

          if(palabra == ''){ palabra = null; }
          if(categoria == ''){ categoria = null; }
          if(proveedor == ''){ proveedor = null; }
          if(marca == ''){ marca = null; }

          

          $('#RelacionadosAllBusqueda').load('/complementos_productos/busqueda/'+palabra+'/'+categoria+'/'+proveedor+'/'+marca+'/1');
          
        }}, '.buscar_productos'); 

        $(document).on({click: function(e){ 

          e.preventDefault();
          $("#productosForm").attr('action', 'masiva_complementos');
          $("#productosForm").submit();

            // var producto_relacionados = new Array();
            // var i = 0;
            // $("input[class=check_producto_relacionado]:checked").each(function(){
              
            //     producto_relacionados.push($(this).val());  

            // });


            // $.ajax({
            //             url: '/complementos_productos/add/',
            //             type: 'POST',
            //             dataType: 'html', 
            //             data: { producto_relacionados:producto_relacionados },
            //         })
            //         .done(function(data) {
            //             $('#RelacionadosLista').load('/complementos_productos/add/');
            //             $('#RelacionadosBusqueda').load('/complementos_productos/busqueda/');

            // });


        }}, '.agregar_producto_relacionado');

        
        //$('#RelacionadosAllBusqueda').load('/complementos_productos/busqueda/');


        $(document).on({change: function(e){ 

            var check =  this.checked;

            $('input[class=check_producto_relacionado]').prop('checked',check);

        }}, '.checkAll');

    });

});



</script>
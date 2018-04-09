<style type="text/css">
  .width-column{
    min-width: 200px !important;
    width: 100%;
    text-align: center;
  }
  .div-img{
    width: 200px;
    height: 200px;
    display: table-cell;
    vertical-align: middle;
    text-align: center;
  }

  .fa-check-circle{
    font-size: 25px !important;
    color: #982f81 !important;
    cursor:pointer
  }

  .fa-circle{
    font-size: 25px !important;
    color: #982f81 !important;
    cursor:pointer
  }

  .click-product{
    padding: 0px !important;
    margin: 0px;
    min-height: 0px;
    background: none;
  }

  .fa-spinner{
    font-size: 25px !important;
    color: #982f81 !important;
  }
</style>

<div id="updateCiudadesProductosIndex">
    <?php echo $this->Search->searchForm('Ciudades', ['legend'=>false, 'updateDivId'=>'updateCiudadesProductosIndex']); ?>
    

    <div class="ibox-content" style="padding: 0px !important;">

        <?php if ($ciudades) { ?>

        <table id="fixTable" class="table table-striped table-condensed table-hover">
            <thead>
              <tr>
                <th class="width-column"></th>

                <?php foreach ($productos as $key => $producto) { ?>
                  <th class="width-column"> 
                    <div class="div-img">
                      <img src="<?php echo $this->Image->resize('img/productos/original', (isset($producto->imagenes[0]->nombre)? $producto->imagenes[0]->nombre : 'nodisponible.jpg'), 150, null, true);?>">
                    </div>
                      
                    <?= $producto->sku ?> <br> <?= $producto->nombre ?> 
                  </th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($ciudades as $key => $ciudad) { ?>

                <tr>
                  <td class="width-column" style="z-index: 1;"> <?= $ciudad->nombre ?>  </td>

                  <?php foreach ($productos as $key => $producto) { ?>
                    <td class="width-column">
                        
                        <?php if(isset($ciudades_productos[$ciudad->id][$producto->id])){ ?>

                          <div class="click-product" data-ciudad="<?=$ciudad->id?>" data-producto="<?=$producto->id?>">
                            <i class="fa fa-check-circle" aria-hidden="true" ></i>
                          </div>

                        <?php }else{ ?>

                          <div class="click-product" data-ciudad="<?=$ciudad->id?>" data-producto="<?=$producto->id?>">
                            <i class="fa fa-circle click-product" aria-hidden="true"></i>
                          </div>

                        <?php } ?>
                        
                    </td>
                  <?php } ?>
                
                </tr>

              <?php } ?>
              
            </tbody>
          </table> 

          <?php } ?>
    </div> 

</div>


<script type="text/javascript">

    $(document).ready(function() {
        $("#fixTable").tableHeadFixer({'left' : 1, 'foot' : true, 'head' : false}); 
    });
  
    var load = "<i class='fa fa-spinner fa-spin fa-5x fa-fw'></i>";

    var check = "<i class='fa fa-check-circle'></i>";

    var no_check = "<i class='fa fa-circle'></i>";



    $( '.click-product' ).click(function() {

        var this_ = $(this);

        var product = {
            ciudad_id : this_.data('ciudad'),
            producto_id : this_.data('producto')
        }; 

        
        this_.attr('data-actions', 0);
        this_.html( load ); 
        
        $.ajax({
            type: 'POST',
            url: '/ciudades/addProducto',
            data: product,
            dataType: 'json',
            success: function(data){

              if(data.id != undefined){
                this_.html( check );
              }else{
                this_.html( no_check );
              }

  
            }
        });

    });

    $(document).ready(function(){

        $('#ciudades-cat-id').val('<?php echo $search_categoria; ?>').change();
    });

</script>


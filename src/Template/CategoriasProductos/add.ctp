
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
//$this->start('tb_sidebar');

?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


<div class="page-padding">
  <div class="row">
    <div class="col-lg-8 col-xs-12 col-lg-12">

      <br><br>
      <form method="post" accept-charset="utf-8" id="form_categoria" action="">    
          
                
      <div class="row">
        <div class="col-lg-6 col-xs-6 col-lg-6">
          <?= $this->Form->input('producto_id', array('type'=>'hidden', 'value'=>$producto_id)) ?>
          <?= $this->Form->input('categoria_id', array('options'=>$categorias, 'label'=>false,'empty'=>' ')) ?>

        </div>
        
        <div class="col-lg-6 col-xs-6 col-lg-6">
           <input type="button" class="btn btn-primary agregar_categoria" value="Agregar"/>  
        </div>
      </div>

    </form>

    </div>
  </div>
  <br><br>
  <div class="row" id="categoria">
    <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-2 col-xs-2 col-lg-2">
            Categoría
          </div>
          <div class="col-lg-2 col-xs-2 col-lg-2">
            Acciones
          </div>
        </div>
        <br>
        <legend></legend>
    </div>
    
    <div class="col-lg-8 col-xs-8 col-lg-8">
      <?php foreach ($categorias_producto as $categoria) { ?>

        <!-- Guarda Filtro -->

        <form method="post" accept-charset="utf-8" id="form_filtros<?php echo $categoria->categoria->id;?>" action="">   
        <?php //echo $this->Form->create(null, ['url' => ['controller' => 'OpcionefiltrosProductos', 'action' => 'add']]); 

          echo $this->Form->input('producto_id', array('type'=>'hidden', 'value'=>$producto_id)) ?>

        <div class="row">
          <div class="col-lg-2 col-xs-2 col-lg-2">
            <br>
            <b> <?php echo $categoria->categoria->nombre; ?> </b>
          </div>
          

          <div class="col-lg-2 col-xs-2 col-lg-2">
            <br>

            <?= $this->Html->link('<i class="fa fa-floppy-o"></i>','#categoria',['data-id'=>$categoria->categoria->id, 'title' => __('Guarda Filtros'), 'escape' => false, 'class'=>'btn btn-primary guarda_filtro']) ?>

              &nbsp;&nbsp; 

        </form> <!-- Fin Guarda Filtro -->     


            <?= $this->Html->link('<i class="fa fa-trash"></i>','#categoria',['data-id'=>$categoria->id, 'title' => __('Eliminar Categoria'), 'escape' => false, 'class'=>'btn btn-primary eliminar_categoria']) ?>

           
          </div>
        </div>

        

      <?php } ?>
    </div>


  </div>


</div>



<script>
$('.guarda_filtro').click(function(e){   

            var id = $(this).data('id');

                    $.ajax({
                        url: '/OpcionefiltrosProductos/add',
                        type: 'POST',
                        dataType: 'html', 
                        data:$("#form_filtros"+id).serialize(),
                    })
                    .done(function(data) {
                        $('#Categorias').load('/categorias_productos/add/<?php echo $producto_id; ?>');
                    });
        });
        
</script>





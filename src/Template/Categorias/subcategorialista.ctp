<?php
$this->extend('/Categorias/subcategoria');

$this->start('selector_vista');
$actual_link = "$_SERVER[REQUEST_URI]";
  //debug($actual_link);
$link_no_query = strtok($actual_link, "?"); 
  //$query = parse_url($actual_link, PHP_URL_QUERY);
  //$query_params = array('marca' => 'Alcatel');
$query_params = $_GET;
$scriptsproductos="";
$uri = $_SERVER['REQUEST_URI'];

?>


 <a href="/sc<?php $uri = substr($uri, 8); echo ($uri);?>"><span class="glyphicon glyphicon-th-large" style="color: #bcbcbc;"></span></a>
                <span class="glyphicon glyphicon-th-list" style="color: #6b6b6b;"></span>


        

<?php $this->end(); ?>



<?php
$this->start('lista');



?>





<div id="posts-list" >
                                    <?php 
                                     $i=0;
                                     foreach ($productos as $producto):
                                         $i++;
                                      ?>
                                    <div class="row post-item">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                            <div class="block_1" > 
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                        <?php if(isset($producto->marca->logo) && (!is_null($producto->marca->logo)) && ($producto->marca->logo !="")):?>
                                                            <img src="/img/marcas/<?= $producto->marca->logo ?>" height="20" > 
                                                        <? endif; ?>
                                                        </td>
                                                        <td>
                                                            <div style="color: #9d0d04; font-size:11px; " align="center"><b><?php if($producto->envio_gratis){echo "Env&iacute;o Gratis";}  ?></b></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <div class="topline ttpu " style="text-align: center;background-image: url('<?php echo $this->Image->resize('/img/productos/original', $producto['imagenes'][0]['nombre'], 150, null, true);?>'); ">
                                                    <a href="/p/<?= $producto->url ?>"><? if(isset($producto['imagenes'][0])): ?>
                                                      <img src="<?php echo $this->Image->resize('/img/productos/original', $producto['imagenes'][0]['nombre'], 150, null, true);?>" alt="<?= $producto->nombre ?>" width="150" border="0" id="ofertaImg_<?= $producto->url ?>" >
                                                    <? else: ?>





                                                    <img src="/img/logo.png" alt="Sin Imagen">
                                                    <? endif; ?>
                                                    </a><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                <span style="font-size: 10px"><?= $producto->codigo_fabricante ?></span>
                                                <div class="detail_1">
                                                    <br>
                                                    <!-- <?php if( $producto->precio > 0 ){ echo 'btn-producto';}  ?> CON ESTA CLASS AGREGA AL CARRITO -->
                                                    <div class="name_1 " data-id="<?= $producto->id ?>" data-url="<?= $producto->url ?>" ><a href="/p/<?= $producto->url ?>"><?= $producto->nombre ?></a></div>
                                                  <div class="name_2" ><?= $producto->descripcion_corta ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                                
                                                <div>
                                                    <div id="promosDiv_<?= $producto->url ?>" class="name_3"></div>
                                                    <div id="superofertaDiv_<?= $producto->url ?>" style="color: #9d0d04;"></div>
                                                </div>
                                                
                                                <?php if(  $producto->IsProductGroup > 0 ){  ?>
                        <div class="include">&nbsp;Desde:</div>
                        <?php } ?>

                                                <div class="price" id="precioDiv_<?= $producto->url ?>">


                                                  <?php if( $producto->precio > 0 ){  ?>
                                                  $<?= number_format($producto->precio,2); ?>

                                                  <?php 
                                                    } ?>

                                                </div>


                                                <div class="include">

                                                  &nbsp;

                                                  <?php if( $producto->precio > 0 ){  ?>

                                                  Incluye IVA

                                                  <?php } ?> 

                                                </div>
                                                <?php if(count($producto->atributos) > 0) { ?>
                                                




                                                <a href="/p/<?= $producto->url ?>" style="color: rgba(16, 16, 16, 0.72);"><div class="btn btn-warning" style="color:#fff;">Ver Detalle</div></a>
                                                <?php }else{ ?>



                                                <?php if( $producto->precio > 0 ){  ?>
                                                <a href="/p/<?= $producto->url ?>" style=""><div class="btn btn-cotizar" data-id="<?= $producto->id ?>" data-url="<?= $producto->url ?>" style="color:#fff;">Ver Detalle</div></a>

                                                <?php } else {  ?>


                                                   <a href="#" style="color:white" data-toggle="modal" data-producto-id="<?php echo $producto->id; ?>" data-target="#modal-cotizar" > <div class="btn btn-cotizar" data-id="<?= $producto->id ?>" data-url="<?= $producto->url ?>" style="color:#fff;">
                        Cotizar  </div></a>


                                                <?php  } ?>
                                                <?php } ?>
                                                <div class="final"></div>
                                            </div>
                                        </div>
                                    </div>
          
                              <hr>

                               <?php 
                                 if($i==50){

    ?>
                </div>
                        <div id="posts-list">
                            <?
                    $i=0;
                    }
                                $scriptsproductos.="getpromoproducto('".$producto->url."');\n";
                                        endforeach; 
                                 ?>
                                 <?= $this->Paginator->next(''); ?>

                       </div>
                        
<script type="text/javascript">

  <?php echo $scriptsproductos  ?>
</script>
<?php $this->end(); ?>
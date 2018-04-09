<?php
$this->extend('/Productos/buscarPadre');


$actual_link = "$_SERVER[REQUEST_URI]";
  //debug($actual_link);
$link_no_query = strtok($actual_link, "?"); 
  //$query = parse_url($actual_link, PHP_URL_QUERY);
  //$query_params = array('marca' => 'Alcatel');
$query_params = $_GET;
$scriptsproductos="";
$uri = $_SERVER['REQUEST_URI'];

?>



<?php
$this->start('lista');



?>





<div id="posts-list">
            <?php 
              $i=0;
              foreach ($productos as $producto):
              
              $i++;
              
               ?>
            <div class="post-item grid-pdcs post-item-mos">
              <div class="block_1" >
                <div class="blk-sub1">
                  <div class="blk-sub2">
                    <?php if($producto['marca']['logo']){
                      ?>
                    <span><img src="/img/marcas/<?= $producto['marca']['logo']; ?>"></span>
                    <?
                      }?>                                                          
                    <p><?php if($producto->envio_gratis){echo "<b class='ribbon'>Env&iacute;o Gratis</b>";}  ?></p>
                  </div>
                  <div class="topline" style="text-align: center;">
                    <a href="/p/<?= $producto->url ?>">
                    <? if(isset($producto['imagenes'][0])): ?>
                    <!--  img src="/img/productos/original/<?=$producto['imagenes'][0]['nombre']; ?>" alt="<?= $producto->nombre ?>" width="150" border="0" style="min-hieght: 200px"></a -->
                      <div class="ttpu" style="background-image: url('/img/productos/original/<?=$producto['imagenes'][0]['nombre']; ?>'); ">
                        <img class="oferta-icon" src="/img/spacer.gif" alt="" id="ofertaImg_<?= $producto->url ?>" >
                      </div>
                    
                    <? else: ?>


                    <div class="ttpu" style="background-image: url(<?php echo $this->Image->resize('/img', "logoPadmont-cuadro.png", 220, 220, true);?>); ">
                        <img class="oferta-icon" src="/img/spacer.gif" alt="" id="ofertaImg_<?= $producto->url ?>" >
                      </div>

                    
                    

                    <? endif; ?>
                    </a>
                    <span class="code-pdc"><?= $producto->codigo_fabricante ?></span>
                    <div class="detail_1">
                      <div class="name_1"><a class="lnk_pdr" href="/p/<?= $producto->url ?>" ><?= strlen($producto->nombre) > 30 ? substr($producto->nombre,0,30)."..." : $producto->nombre;
                        ?></a></div>
                      <div >
                        <div>
                          <div id="promosDiv_<?= $producto->url ?>" class="name_3" ></div>
                          <div id="superofertaDiv_<?= $producto->url ?>"></div>
                        </div>

                         <?php if(  $producto->IsProductGroup  ){  ?>
                        <div class="include">&nbsp;Desde:</div>
                        <?php } ?>

                        <div class="price" id="precioDiv_<?= $producto->url ?>">

                          <?php if( $producto->precio > 0 ){  ?>
                          $<?= number_format($producto->precio,2); ?>

                          <?php } ?>
                        </div>
                        
                        <?php if($producto->precio > 0 ){ ?> 
                        <p class="include">&nbsp;Incluye IVA</p>
                        <?php } ?>


                      </div>
                        <?php if(count($producto->atributos) > 0) { ?>
                          <div class="btn btn-warning">
                            <a href="/p/<?= $producto->url ?>">A&ntilde;adir al Carrito</a>
                          </div>
                        <?php }else{ ?>
                          <?php if( $producto->precio > 0  ) {  ?>
                            <div class="btn btn-warning btn-carrito" data-id="<?= $producto->id ?>" data-url="<?= $producto->url ?>">
                              <a href="#">Agregar al Carrito</a>
                          <?php } else { ?>
                            <div class="btn btn-cotizar" data-id="<?= $producto->id ?>" data-url="<?= $producto->url ?>">
                              <a href="#" style="color:white" data-toggle="modal" data-producto-id="<?php echo $producto->id; ?>" data-target="#modal-cotizar" > Cotizar </a>
                          <?php } ?>
                          </div>
                        <?php } ?>
                      <div class="final"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

          


<?php $this->end(); ?>
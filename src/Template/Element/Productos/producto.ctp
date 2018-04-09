<!-- post-item grid-pdcs post-item-mos -->
<?php if( isset($row['banner']) ): ?>
  <div class="col-lg-<?= $row['columna'][0]? $row['columna'][0] * 3 : 3 ?>">
    <div class="productoooo">
    <a href="<?php echo $row['banner'][0]['url'];?>"><img src="/<?php echo $row['banner'][0]['imagen'];?>" border=0></a>
    </div>
</div>
<?php else: ?>
<div class="col-lg-3">
  <div class="productoooo">
    <div class="block_1" >
      <div class="blk-sub1">
        <div class="topline" style="text-align: center;">
          <a href="<?= $url_base ?>/<?= $row->producto->url ?>">
            <?php if(isset($row->producto['imagenes'][0])): ?>
              <div class="ttpu" style="background-image: url('<?= $this->Image->resize('/img/productos/original', $row->producto['imagenes'][0]['nombre'], 220, null, true);?>'); ">
                <img class="oferta-icon" src="/img/spacer.gif" alt="" id="ofertaImg_<?= $row->producto->url ?>" >
              </div>                      
            <?php else: ?>
              <div class="ttpu" style="background: url('http://via.placeholder.com/220x220') no-repeat;background-position: 50% 50%">
                <img class="oferta-icon" src="/img/spacer.gif" alt="" id="ofertaImg_<?= $row->producto->url ?>" >
              </div>
            <?php endif; ?>
          </a>
          <span class="code-pdc"><?= $row->producto->codigo_fabricante ?></span>
            <div class="detail_1">
              <div class="name_1 " data-id="<?= $row->producto->id ?>" data-url="<?= $row->producto->url ?>">
                <a class="lnk_pdr" href="<?= $url_base ?>/<?= $row->producto->url ?>">
                  <?= strlen($row->producto->nombre) > 40 ? substr($row->producto->nombre,0,40)."..." : $row->producto->nombre; ?>
                </a>
              </div>
              <div>
                <div>
                  <div id="promosDiv_<?= $row->producto->url ?>" class="name_3" ></div>
                  <div id="superofertaDiv_<?= $row->producto->url ?>"></div>
                </div>

                  <?php if(  $row->producto->IsProductGroup  ):  ?>
                    <p class="include">&nbsp;Desde:</p>
                  <?php endif; ?>

                  <div class="price" id="precioDiv_<?= $row->producto->url ?>">
                    <?php if( $row->producto[$ciudad->precio] > 0 ):  ?>
                      $<?= number_format((($currency==1)? $row->producto[$ciudad->precio] : $row->producto[$ciudad->precio] / $tipocambio), 2) ?> <?= $monedas[$currency] ?>
                    <?php endif; ?>
                  </div>
                  <?php if($row->producto[$ciudad->precio] > 0 ): ?> 
                    <p class="include">&nbsp;Incluye IVA</p>
                  <?php endif ?>
              </div>
             <!--  <?php if(count($row->producto->atributos) > 0): ?>
                <div class="btn btn-warning">
                  <a href="<?= $url_base ?>/<?= $row->producto->url ?>">A&ntilde;adir al Carrito</a>
                </div>
              <?php else: ?>
                <?php if( $row->producto[$ciudad->precio] > 0  ):  ?>
                  <a href="<?= $url_base ?>/<?= $row->producto->url ?>" ><div class="btn btn-warning btn-detalles" style="left:60px; color:#fff;">Comprar</div></a>
                <?php endif ?>
              <?php endif; ?> -->
            <div class="final"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
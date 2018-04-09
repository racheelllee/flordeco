<div id="content" class="secbg">
        <div class="container">
            
            <div id="pedidos">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <div class="title_1">
                            <h2>Mi Pedido</h2>
                            <p>Orden <?php echo $pedido->id;?></p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <?php if($pedido->estatus_id != 6){ ?>
                        <div class="steps">
                            <?php if($pedido->estatus_id == 1){ ?>

                            <div class="line_1"><div class="line_2" style="width:0%;"></div></div>
                            <div class="blk_1 col_1 col_2 active">
                                <div class="icon_1"></div>
                                <span>Recibido</span>
                            </div>
                            <div class="blk_1 col_1">
                                <div class="icon_1 icon_2"></div>
                                <span>En Proceso</span>
                            </div>
                            <div class="blk_1 col_1">
                                <div class="icon_1 icon_3"></div>
                                <span>Enviado</span>
                            </div>
                            <div class="blk_1 col_1 col_3">
                                <div class="icon_1 icon_4"></div>
                                <span>Entregado</span>
                            </div>

                            <?php }elseif($pedido->estatus_id == 2 || $pedido->estatus_id == 3){ ?>

                            <div class="line_1"><div class="line_2" style="width:33%;"></div></div>
                            <div class="blk_1 col_1 col_2 active">
                                <div class="icon_1"></div>
                                <span>Recibido</span>
                            </div>
                            <div class="blk_1 col_1 active">
                                <div class="icon_1 icon_2"></div>
                                <span>En Proceso</span>
                            </div>
                            <div class="blk_1 col_1">
                                <div class="icon_1 icon_3 "></div>
                                <span>Enviado</span>
                            </div>
                            <div class="blk_1 col_1 col_3">
                                <div class="icon_1 icon_4"></div>
                                <span>Entregado</span>
                            </div>

                            <?php }elseif($pedido->estatus_id == 4){ ?>

                            <div class="line_1"><div class="line_2" style="width:66%;"></div></div>
                            <div class="blk_1 col_1 col_2 active">
                                <div class="icon_1"></div>
                                <span>Recibido</span>
                            </div>
                            <div class="blk_1 col_1 active">
                                <div class="icon_1 icon_2"></div>
                                <span>En Proceso</span>
                            </div>
                            <div class="blk_1 col_1 active">
                                <div class="icon_1 icon_3 "></div>
                                <span>Enviado</span>
                            </div>
                            <div class="blk_1 col_1 col_3">
                                <div class="icon_1 icon_4"></div>
                                <span>Entregado</span>
                            </div>

                            <?php }elseif($pedido->estatus_id == 5){ ?>

                            <div class="line_1"><div class="line_2" style="width:99%;"></div></div>
                            <div class="blk_1 col_1 col_2 active">
                                <div class="icon_1"></div>
                                <span>Recibido</span>
                            </div>
                            <div class="blk_1 col_1 active">
                                <div class="icon_1 icon_2"></div>
                                <span>En Proceso</span>
                            </div>
                            <div class="blk_1 col_1 active">
                                <div class="icon_1 icon_3 "></div>
                                <span>Enviado</span>
                            </div>
                            <div class="blk_1 col_1 col_3 active">
                                <div class="icon_1 icon_4"></div>
                                <span>Entregado</span>
                            </div>

                            <?php } ?>
                        </div>
                        <?php }else{ ?>
                            <h2 class="cancelado">CANCELADO</H2>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <div class="block_1">
                            <div class="blk_1">

                                <?php if($pedido->recoger_sucursal == false){ ?>

                                <div class="title_2">
                                    <h3>Dirección de Envío</h3>
                                    <p></p>
                                </div>
                                
                               
                                <p><?php echo $pedido->calle;?> #<?php echo $pedido->numero_exterior;?><br><?php echo $pedido->colonia;?> <br>Ciudad <?php echo $pedido->ciudad;?> Estado <?php echo $pedido->estado;?> <br>C.P. <?php echo $pedido->codigo_postal;?> </p>
                               
                                <?php }else{ ?>

                                    <div class="title_2">
                                   
                                    <p></p>
                                </div>

                                <p><strong><?php echo $pedido->sucursale->nombre;?></strong> <br> <?php echo $pedido->sucursale->detalles;?> </p>

                                <?php } ?>
                            </div>
                            <div class="blk_1">
                                <div class="title_2">
                                    <h3>Forma de Pago</h3>
                                    <p></p>
                                </div>
                                <p><strong><?php echo $pedido->formasdepago->nombre;?></strong>
                                <?php if($pedido->file !='' || (!is_null($pedido->file))):?><br><a href="<?php echo $pedido->file;?>" target="_blank">Reimprimir recibo</a><?php endif;?>
                                </p>
                            </div>
                            <div class="blk_1">
                                <div class="title_2">
                                    <h3>Detalle de Productos</h3>
                                    <p></p>
                                </div>
                                <?php $subtotal = 0; foreach ($pedido->partidas as $producto) { ?>
                                    <p><strong><?php echo $producto->producto; ?></strong><?php echo $producto->atributos; ?> <br>Precio: $<?php echo number_format($producto->precio,2); $subtotal += $producto->precio; ?> MXN<span>Cantidad: <?php echo $producto->cantidad; ?></span></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div class="block_2">
                            <h3>Tu Orden</h3>
                            
                            <div class="line_2"><span>Subtotal</span><strong>$<?php echo number_format($subtotal,2);?> MXN</strong></div>
                            <div class="line_2"><span>Cupon</span><strong>-$<?php echo number_format($pedido->cupon,2);?>  MXN</strong></div>
                            
                            <div class="line_2"><span>Envio</span><strong>$<?php echo number_format($pedido->envio,2);?>  MXN</strong></div>
                            <div class="line_2"><span>IVA</span><strong>$<?php echo number_format($pedido->iva,2);?>  MXN</strong></div>
                            <div class="line_3"><span>Total</span><strong>$<?php echo number_format($pedido->monto,2); ?> <b>MXN</b></strong></div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

    <script type="text/javascript">

    

    </script>
<div id="content" class="">
        <div class="container">
        <div id="pedidos">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block_1" style="border: 1px solid #25A2AF;">
                        <div class="blk_1">
                            <div class="title_2 ">
                                <h4><strong>GRACIAS POR TU COMPRA</strong><br>
                                    Tu Pedido No.<?php echo $pedido['id']; ?> ha sido recibido.</h4>
                                    <br>
                                        <p>Usted recibirá un correo electrónico con las especificaciones de su pedido,</p>
                            </div>
                        </div>
                        <?php
                        if (isset($respuesta)) {
                        	echo $respuesta;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </div>
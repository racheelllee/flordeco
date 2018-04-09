<html><head><title>Redirection</title></head><body><div style="margin: auto; text-align: center;">

    <form action="https://ecom.eglobal.com.mx/VPBridgeWeb/servlets/TransactionStartBridge" method="post" name="vm_bancomer_form" >

        <input type="submit"  value="Por favor, espere mientras se redirige a Bancomer" />

        <input type="hidden" name="Ds_Merchant_Amount" value="<?= $monto ?>" /> <!-- Importe -->
        <input type="hidden" name="Ds_Merchant_Currency" value="484" /> <!-- Moneda  484-Pesos Mexicanos -->
        <input type="hidden" name="Ds_Merchant_Order" value="<?= $pedido['id'] ?>" /> <!-- # de pedido -->
        <input type="hidden" name="Ds_Merchant_ProductDescription" value="Carrito de Compras Padmont" /> <!-- Descripcion 125 caracteres -->
        <input type="hidden" name="Ds_Merchant_MerchantCode" value="<?= $numero_afiliacion ?>" /> <!-- Numero de Afiliacion de Padmont con Bancomer 7 caracteres-->
        <input type="hidden" name="Ds_Merchant_MerchantURL" value="http://tienda.padmont.com.mx/productos/confirmation_bancomer/<?= $pedido['id'] ?>" /> <!-- URL Notificacion -->
        <input type="hidden" name="Ds_Merchant_UrlOK" value="https://tienda.padmont.com.mx/productos/order_confirmation/<?= $pedido['id'] ?>/2" /> <!-- URL Transaccion Aceptada -->
        <input type="hidden" name="Ds_Merchant_UrlKO" value="https://tienda.padmont.com.mx/pedido/cancelado" /> <!-- URL Transaccion Denegada -->
        <input type="hidden" name="Ds_Merchant_MerchantName" value="Padmont, S.A. de C.V." /> <!-- Nombre del Comercio (Padmont) -->

        <input type="hidden" name="Ds_Merchant_MerchantSignature" value="<?= $firma_comercio ?>" /> <!-- Firma del Comercio -->
        <input type="hidden" name="Ds_Merchant_Terminal" value="001" /> <!-- Numero de Terminal -->
        <input type="hidden" name="Ds_Merchant_TransactionType" value="0" /> <!-- Tipo de Transaccion 0-Autorizacion 4-Cancelacion(mismo dia) -->


    </form></div>
   <script type="text/javascript">
    document.vm_bancomer_form.submit();
    </script>
</body>
</html>




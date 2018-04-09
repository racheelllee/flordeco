<html><head><title>Redirection</title></head><body><div style="margin: auto; text-align: center;">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="vm_paypal_form" >
        <input type="submit"  value="Por favor, espere mientras se redirige a PayPal" />
        <input type="hidden" name="cmd" value="_ext-enter" />
        <input type="hidden" name="redirect_cmd" value="_xclick" />
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="business" value="info@padmont.com.mx" />
        <input type="hidden" name="receiver_email" value="info@padmont.com.mx" />
        <input type="hidden" name="order_number" value="<?= $pedido['id'] ?>" />
        <input type="hidden" name="invoice" value="<?= $pedido['id'] ?>" />
        <input type="hidden" name="custom" value="9b0a9dfdd63f3ae6f691db0d1dc2cc43" />
        <input type="hidden" name="item_name" value="No. pedido: <?= $pedido['id'] ?>" />
        <input type="hidden" name="amount" value="<?= round($pedido['monto'],2); ?>" />
        <input type="hidden" name="currency_code" value="MXN" />
        <input type="hidden" name="address_override" value="1" />
        <input type="hidden" name="first_name" value="Padmont" />
        <input type="hidden" name="last_name" value="Padmont" />
        <input type="hidden" name="address1" value="" />
        <input type="hidden" name="address2" value="" />
        <input type="hidden" name="zip" value="64000" />
        <input type="hidden" name="city" value="" />
        <input type="hidden" name="state" value="Nuevo León" />
        <input type="hidden" name="country" value="MX" />
        <input type="hidden" name="email" value="info@padmont.com.mx" />
        <input type="hidden" name="night_phone_b" value="81530090" />
        <input type="hidden" name="return" value="https://tienda.padmont.com.mx/productos/order_confirmation/<?= $pedido['id'] ?>/5" />
        <input type="hidden" name="notify_url" value="https://tienda.padmont.com.mx/productos/order_confirmation/<?= $pedido['id'] ?>/5" />
        <input type="hidden" name="cancel_return" value="https://tienda.padmont.com.mx/pedido/cancelado" />
        <input type="hidden" name="ipn_test" value="0" />
        <input type="hidden" name="rm" value="2" />
        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="no_note" value="1" />
    </form></div>
   <script type="text/javascript">
    document.vm_paypal_form.submit();
    </script>
</body>
</html>




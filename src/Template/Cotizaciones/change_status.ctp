<div class="modal-header" style="padding: 0px 15px 15px;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><?= __('Cambio de Estatus') ?></h4>
</div>

<?= $this->Form->create($quote, [
    'method' => 'POST',
    'url' => '/cotizaciones/changeStatus/' . $quote->id,
    'class' => 'change-status',
    'enctype' => 'multipart/form-data'
] ); ?>
    <br>
    <?php if(empty($quote->cargo_id)): ?>
        <label>Cargo</label>
        <?= $this->Form->input('cargo_id', ['type' => 'select','label'=>false, 'div'=>false, 'class'=>'form-control', 'style'=>'margin-bottom: 5px','empty' => 'Seleccionar cargo','options'=> $cargos]); ?>
        <br>
    <?php endif; ?>

    <label>Comentario</label>
    <?= $this->Form->input('comentario_status', [
        'type' => 'textarea',
        'label'=>false,
        'div'=>false,
        'class'=>'form-control',
        'style'=>'width:100%;',
        'placeholder'=>'Comentario'
    ]); ?>

    <br>
    <label>Órdenes de compra</label>
    <div class="row">
        <div class="col-lg-5">
            <?= $this->Form->input('numero_orden_compra', [
                    'div'=>false,
                    'label'=>false,
                    'type' => 'text',
                    'class'=>'form-control numero-orden-compra purchase-order-item number',
                    'style' => 'margin-top: 5px',
                    'placeholder' => 'Número de Orden de Compra',
                ]);
            ?>
        </div>
        <div class="col-lg-5">
            <?= $this->Form->input('monto_orden_compra', [
                    'div'=>false,
                    'label'=>false,
                    'type' => 'number',
                    'class'=>'form-control monto-orden-compra purchase-order-item amount',
                    'style' => 'margin-top: 5px',
                    'placeholder' => 'Monto de la Orden de Compra',
                ]);
            ?>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-span btn-sm add-purchase-order">+</button>
        </div>
        <div class="col-lg-12">
            <span id="orders-warning-message" class="help-block form-error"></span>
        </div>
    </div>
    <div class="purchase-orders">
        <?php foreach ($quote->purchase_orders as $key => $order): ?>
            <div class="row">
                <div class="col-xs-5">
                    <?= $order->numero ?>
                    <input type="hidden" class="purchase-order-item number" name="purchase_orders[<?= $key ?>][numero]" value="<?= $order->numero ?>">
                </div>
                <div class="col-xs-5">
                    $ <?= number_format($order->monto, 2) ?>
                    <input type="hidden" class="purchase-order-item amount" name="purchase_orders[<?= $key ?>][monto]" value="<?= $order->monto ?>">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-span btn-sm remove-purchase-order">-</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <br>
    <label>Archivo  de Órdenes de compra</label>
    <div class="row">
        <div class="col-lg-10">
            <?= $this->Form->input('file_order', [
                'type'  => 'file',
                'label' => false,
                'div'   => false,
                'class' => 'form-control'
            ]); ?>
        </div>
        <div class="col-lg-2">
            <?php if ($quote->file_order): ?>
                <a href="/<?= $quote->file_order ?>" target="_blank">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <br>
    <label>Fechas estimadas de Facturación</label>
    <div class="row">
        <div class="col-lg-3">
            <?= $this->Form->input('billing_date', [
                    'div'=>false,
                    'label'=>false,
                    'type' => 'text',
                    'style' => 'margin-top: 5px',
                    'class'=>'form-control billing-date custom-datepicker',
                    'placeholder' => 'Fecha',
                ]);
            ?>
        </div>
        <div class="col-lg-3">
            <?= $this->Form->input('billing_amount', [
                    'div'=>false,
                    'label'=>false,
                    'type' => 'number',
                    'style' => 'margin-top: 5px',
                    'class'=>'form-control billing-amount',
                    'placeholder' => 'Monto',
                ]);
            ?>
        </div>
        <div class="col-lg-4">
            <?= $this->Form->input('billing_concept', [
                    'div'=>false,
                    'label'=>false,
                    'type' => 'text',
                    'style' => 'margin-top: 5px',
                    'class'=>'form-control billing-concept',
                    'placeholder' => 'Concepto',
                ]);
            ?>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-span btn-sm add-billing-date">+</button>
        </div>
        <div class="col-lg-12">
            <span id="billing-warning-message" class="help-block form-error"></span>
        </div>
    </div>
    <div class="billing-dates">
        <?php foreach ($quote->billing_dates as $key => $billingDate): ?>
            <div class="row">
                <div class="col-xs-3">
                    <?= $billingDate->date->format('d/m/Y') ?>
                    <input type="hidden" class="billing-date date" name="billing_dates[<?= $key ?>][date]" value="<?= $billingDate->date->format('d/m/Y') ?>">
                </div>
                <div class="col-xs-3">
                    $ <?= number_format($billingDate->amount, 2) ?>
                    <input type="hidden" class="billing-amount" name="billing_dates[<?= $key ?>][amount]" value="<?= $billingDate->amount ?>">
                </div>
                <div class="col-xs-4">
                    <?= $billingDate->concept ?>
                    <input type="hidden" class="billing-concept" name="billing_dates[<?= $key ?>][concept]" value="<?= $billingDate->concept ?>">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-danger btn-sm remove-billing-date">-</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <br>
    <?php if ($quote->status_id != 7 && $quote->status_id != 8 ): ?>
        <?= $this->Form->input('fecha_venta', [
            'value' => $quote->fecha_venta ? $quote->fecha_venta->format('d/m/Y') : '',
            'type' => 'text',
            'div'=>false,
            'class'=>'form-control custom-datepicker',
            'label' => 'Fecha de venta',
            'data-validation' => 'required',
            'style' => 'margin-top: 5px'
        ]); ?>
        <br>
    <?php endif ?>

    <?= $this->Form->input('fecha_estimada_compra', [
        'value' => $quote->fecha_estimada_compra ? $quote->fecha_estimada_compra->format('d/m/Y') : '',
        'type' => 'text',
        'div'=>false,
        'class'=>'form-control custom-datepicker',
        'label' => 'Fecha Estimada de compra',
        'data-validation' => 'required',
        'style' => 'margin-top: 5px'
    ]); ?>
    <br>

    <?= $this->Form->input('estatus', [
        'id'    => 'quote-status-' . $quote->id,
        'class' => 'quote-status',
        'value' => $quote->cotizaciones_estatus->codigo,
        'type'  => 'hidden',
    ]); ?>

    <?= $this->Form->input('monto_total', [
        'value' => $quote->monto_total,
        'type'  => 'hidden',
    ]); ?>

    <?php foreach ($status as $s): ?>
        <button style="background-color: <?= $s->color; ?>" 
                class="btn status submit-btn lbl btn-primary btn-xs change-quote-status" 
                data-status-code="<?= $s->codigo ?>"
                data-quote-id="<?= $quote->id ?>"
                type="button"><?= $s->nombre; ?></button>
   <?php endforeach; ?>

<?= $this->Form->end() ?>
<script type="text/javascript">
    $('.custom-datepicker').datepicker({format: 'dd/mm/yyyy'});
    var poCounter = <?= count($quote->purchase_orders) ?>;
    $('.purchase-orders').on('click', '.remove-purchase-order', function(ev){
        $(this).parent().parent().remove();
    });
    $('.add-purchase-order').on('click', function(ev){
        $('#orders-warning-message').html('');
        var a = 0;
        $(".purchase-order-item.amount").each(function() {
            a += parseFloat($(this).val());
        });

        if(a > parseFloat($('#monto-total').val())){
            $('#orders-warning-message').html('El monto supera el total de la cotización');
            return false;
        }
        var monto = $('#monto-orden-compra').val();
        var numero = $('#numero-orden-compra').val();
        if (numero && parseFloat(monto) ) {
            $('.purchase-orders').append(
                '<div class="row">' +
                    '<div class="col-xs-5">' +
                        numero +
                        '<input type="hidden" class="purchase-order-item number" name="purchase_orders[' + poCounter + '][numero]" value="' + numero + '">' +
                    '</div>' +
                    '<div class="col-xs-5">' +
                        '$ ' + numberWithCommas(parseFloat(monto).toFixed(2)) +
                        '<input type="hidden" class="purchase-order-item amount" name="purchase_orders[' + poCounter + '][monto]" value="' + monto + '">' +
                    '</div>' +
                    '<div class="col-xs-2">' +
                        '<button type="button" class="btn btn-span btn-sm remove-purchase-order">-</button>' +
                    '</div>' +
                '</div>'
            );
            poCounter++;
            $('#monto-orden-compra').val('');
            $('#numero-orden-compra').val('');
        } else {
            $('#orders-warning-message').html('Por favor, llene todos los campos');
        }
    });
    $('.change-quote-status').on('click', function(ev){
        $('.change-quote-status').prop('disabled', 'disabled');
        var statusCode = this.dataset.statusCode;
        var quoteId  = this.dataset.quoteId;
        $(this).parent().find('.quote-status').val(statusCode);
        $(this).parent().submit();
    });
</script>
<script type="text/javascript">
    var sdCounter = <?= count($quote->billing_dates) ?>;
    $('.billing-dates').on('click', '.remove-billing-date', function(ev){
        $(this).parent().parent().remove();
    });
    $('.add-billing-date').on('click', function(ev){
        $('#billing-warning-message').html('');

        var a = 0;
        $(".billing-amount").each(function() {
            a += parseFloat($(this).val());
        });

        if(a > parseFloat($('#monto-total').val())){
            $('#billing-warning-message').html('El monto supera el total de la cotización');
            return false;
        }

        var date = $('#billing-date').val();
        var amount = $('#billing-amount').val();
        var concept = $('#billing-concept').val();

        if ( date && parseFloat(amount) && concept ) {
            $('.billing-dates').append(
                '<div class="row">' +
                    '<div class="col-xs-3">' +
                        date +
                        '<input type="hidden" class="billing-date date" name="billing_dates[' + sdCounter + '][date]" value="' + date + '">' +
                    '</div>' +
                    '<div class="col-xs-3">' +
                        '$ ' + numberWithCommas(parseFloat(amount).toFixed(2)) +
                        '<input type="hidden" class="billing-amount" name="billing_dates[' + sdCounter + '][amount]" value="' + amount + '">' +
                    '</div>' +
                    '<div class="col-xs-4">' +
                        concept +
                        '<input type="hidden" class="billing-concept" name="billing_dates[' + sdCounter + '][concept]" value="' + concept + '">' +
                    '</div>' +
                    '<div class="col-xs-2">' +
                        '<button type="button" class="btn btn-danger btn-sm remove-billing-date">-</button>' +
                    '</div>' +
                '</div>'
            );
            sdCounter++;
            $('#billing-date').val('');
            $('#billing-amount').val('');
            $('#billing-concept').val('')
        } else {
            $('#billing-warning-message').html('Por favor, llene todos los campos');
        }
    });
</script>
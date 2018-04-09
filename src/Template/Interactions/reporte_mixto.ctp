<style type="text/css">
    .cs-btn{
        padding:5px;
        color: white;
        border: 0px;
    }
    .exportar{
        border: 1px solid #17aa8f;
        color: #777;
    }
    .botones{
        margin-top: 25px;
        height:30px;
    }
    .title{
        text-align: center;
    }
    .title h3, .title h4{
        font-weight: bold;
        margin-top: 5px;
        margin-bottom: 20px;
    }
</style>
<br>
<div class="col-xs-12 title">
    <h3><?= __('Cotizaciones e Interacciones por Marca') ?></h3>
</div>

<div class="col-xs-12 w-title w-color666">
</div>
<?= $this->Form->create(NULL, [
    'url' => [
        'controller' => 'Interactions',
        'action'=> 'reporteMixto',
        'plugin' => false
    ],
    'type' => 'get',
    'style' => 'margin-top: 20px',
    'novalidate',
]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $this->Form->input('marca',[
                'data-validation' => 'required',
                'empty'     => 'Seleccione...',
                'label'     => 'Marca',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $marcas,
                'value'     => $this->request->query('marca'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('cliente',[
                'empty'     => 'Todos',
                'label'     => 'Cliente',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $clientes,
                'value'     => $this->request->query('cliente'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('desde',[
                'label' =>  'Desde',
                'div'   =>  false,
                'style' =>  'height:28px',
                'value' =>  $desde,
                'class' =>  'form-control datepicker'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('hasta',[
                'label' =>  'Hasta',
                'div'   =>  false,
                'style' =>  'height:28px',
                'value' =>  $hasta,
                'class' =>  'form-control datepicker'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('vendedor',[
                'empty'     => 'Todos',
                'label'     => 'Vendedor',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $vendedores,
                'default'   => $this->request->query('vendedor'),
                'class'     => 'form-control'
            ]); ?>         
        </div>
         <div class="col-md-2">
            <div class="col-lg-6">
                <?= $this->Form->button(__('Buscar' ), [
                    'class' => 'btn btn-primary botones', 
                    'type'  => 'submit', 
                ]) ?>
            </div>
            <div class="col-lg-6">
                <button value="1" class="btn btn-default exportar botones" name="exportar" type="submit">PDF</button>
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>


<hr>

<div class="col-xs-12 title">
    <h4>Interacciones abiertas / sin cotización</h4>
</div>
<table id="interacciones" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th style="min-width: 50px"><?= __('No.') ?></th>
            <th style="min-width:150px"><?= __('Customer') ?></th>
            <th style="min-width:150px"><?= __('Seller') ?></th>
            <th style="min-width:150px"><?= __('Type') ?></th>
            <th><?= __('Fecha') ?></th>
            <th><?= __('Comentario') ?></th>
            <th><?= __('Estatus') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $o = 1; ?>
        <?php foreach ($interacciones as $interaccion): ?>
            <tr>
                <td><?= $o++ ?></td>
                <td><?= h($interaccion->customer->title) ?></td>
                <td>
                    <?=
                        $interaccion->user ?
                        $interaccion->user->first_name . ' ' .
                        $interaccion->user->last_name  . ' ' .
                        $interaccion->user->clast_name : ' '
                    ?>
                </td>
                <td>
                    <?php if ($interaccion->interaction_type): ?>
                        <i class="<?= $interaccion->interaction_type->icon ?>"></i>
                        &nbsp;
                        <?= $interaccion->interaction_type->name ?>
                    <?php endif ?>
                </td>
                <td><?= $interaccion->start_date ? $interaccion->start_date->format('d/m/Y') : '' ?></td>
                <td><?= $this->Generic->shortenText($interaccion->comments, 80) ?></td>
                <td class="centered">
                    <span class="cs-btn" style="background-color: <?= $interaccion->interaction_status->color ?>;">
                        <?= $interaccion->interaction_status ? $interaccion->interaction_status->name : '' ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<hr>
<div class="col-xs-12 title">
    <h4>Cotizaciones en Proceso de Aprobación</h4>
</div>
<table id="enProceso" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th><?= __('No.') ?></th>
            <th><?= __('Customer') ?></th>
            <th><?= __('Fecha Estimada de Compra') ?></th>
            <th><?= __('Fecha de Creación') ?></th>
            <th><?= __('No. de COT'); ?></th>
            <th><?= __('Descripción') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Status') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Importe') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Moneda') ?></th>
            <th><?= __('Contact') ?></th>
            <th><?= __('Observaciones') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Type') ?></th>
            <th style="min-width:150px"><?=  __('Seller') ?></th>
            <th style="min-width:150px"><?=  __('Second Seller') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $o = 1; ?>
        <?php $counter = 0; ?>
        <?php foreach ($cotizacionesEnProceso as $cotizacion): ?>
            <tr>
                <td><?= $o++ ?></td>
                <td>
                    <a href="/customers/customers/view/<?= $cotizacion->customer->id; ?>">
                        <?= h($cotizacion->customer->title) ?>
                    </a>
                </td>
                <td><?= $this->Time->format($cotizacion->fecha_estimada_compra, 'dd/MM/YYYY') ?></td>
                <td><?= $this->Time->format($cotizacion->fecha_registro, 'dd/MM/YYYY') ?></td>
                <td><?= $cotizacion->numero_cotizacion ?></td>
                <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td>
                <td align="center">
                    <span class="btn btn-primary btn-xs cs-btn"
                          style="background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                        <?= $cotizacion->cotizaciones_estatus->nombre ?>
                    </span>
                </td>
                <td>$ <?= number_format($cotizacion->monto_total, 2) ?></td>
                <?php $counter += $cotizacion->monto_pesos; ?>
                <td><?= $cotizacion->moneda->name ?></td>
                <td>
                    <?=
                        $cotizacion->contact ?
                        $cotizacion->contact->first_name  . ' ' . 
                        $cotizacion->contact->middle_name . ' ' .
                        $cotizacion->contact->last_name   : ' '
                    ?>
                </td>
                <td><?= $this->Generic->shortenText($cotizacion->comentarios_generales, 80) ?></td>
                <td align="center">
                  <?php if ($cotizacion->from_interaction): ?>
                    <span style="border: 0px;background-color: #79af5d;" class="btn lbl btn-primary btn-xs">P</span>
                  <?php else: ?>
                    <span style="border: 0px;background-color: #4f8fc6;" class="btn lbl btn-primary btn-xs">D</span>
                  <?php endif ?>
                </td>
                <td>
                    <?=
                        $cotizacion->user ?
                        $cotizacion->user->first_name . ' ' .
                        $cotizacion->user->last_name  . ' ' .
                        $cotizacion->user->clast_name : ' '
                    ?>
                </td>
                <td>
                    <?=
                        $cotizacion->second ?
                        $cotizacion->second->first_name . ' ' .
                        $cotizacion->second->last_name  . ' ' .
                        $cotizacion->second->clast_name : ' '
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
    <div class="col-lg-2"><b>$<?= number_format($counter, 2) ?></b></div>
</div>

<hr>

<div class="col-xs-12 title">
    <h4>Cotizaciones Vendidas</h4>
</div>

<table id="vendidas" class="table table-striped table-bordered table-condensed table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th><?= __('No.') ?></th>
            <th><?= __('Customer') ?></th>
            <th><?= __('Fecha de Venta') ?></th>
            <th><?= __('No. de COT'); ?></th>
            <th><?= __('Descripción') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Status') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Importe') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Moneda') ?></th>
            <th><?= __('Contact') ?></th>
            <th><?= __('Observaciones') ?></th>
            <th style="max-width:40px;text-align: center;"><?= __('Type') ?></th>
            <th style="min-width:150px"><?= __('Seller') ?></th>
            <th style="min-width:150px"><?= __('Second Seller') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $o = 1; ?>
        <?php $counter = 0; ?>
        <?php foreach ($cotizacionesVendidas as $cotizacion): ?>
            <tr>
                <td><?= $o++ ?></td>
                <td>
                    <a href="/customers/customers/view/<?= $cotizacion->customer->id; ?>">
                        <?= h($cotizacion->customer->title) ?>
                    </a>
                </td>
                <td><?= $this->Time->format($cotizacion->fecha_venta, 'dd/MM/YYYY') ?></td>
                <td><?= $cotizacion->numero_cotizacion ?></td>
                <td><?= $this->Generic->shortenText($cotizacion->descripcion, 80) ?></td>
                <td align="center">
                    <span class="btn btn-primary btn-xs cs-btn"
                          style="background-color: <?= $cotizacion->cotizaciones_estatus->color ?>">
                        <?= $cotizacion->cotizaciones_estatus->nombre ?>
                    </span>
                </td>
                <td>$ <?= number_format($cotizacion->monto_total, 2) ?></td>
                <?php $counter += $cotizacion->monto_pesos; ?>
                <td><?= $cotizacion->moneda->name ?></td>
                <td>
                    <?=
                        $cotizacion->contact ?
                        $cotizacion->contact->first_name  . ' ' . 
                        $cotizacion->contact->middle_name . ' ' .
                        $cotizacion->contact->last_name   : ' '
                    ?>
                </td>
                <td><?= $this->Generic->shortenText($cotizacion->comentarios_generales, 80) ?></td>
                <td align="center">
                  <?php if ($cotizacion->from_interaction): ?>
                    <span style="border: 0px;background-color: #79af5d;" class="btn lbl btn-primary btn-xs">P</span>
                  <?php else: ?>
                    <span style="border: 0px;background-color: #4f8fc6;" class="btn lbl btn-primary btn-xs">D</span>
                  <?php endif ?>
                </td>
                <td>
                    <?=
                        $cotizacion->user ?
                        $cotizacion->user->first_name . ' ' .
                        $cotizacion->user->last_name  . ' ' .
                        $cotizacion->user->clast_name : ' '
                    ?>
                </td>
                <td>
                    <?=
                        $cotizacion->second ?
                        $cotizacion->second->first_name . ' ' .
                        $cotizacion->second->last_name  . ' ' .
                        $cotizacion->second->clast_name : ' '
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-3"><b>IMPORTE TOTAL EN MXN</b></div>
    <div class="col-lg-2"><b>$<?= number_format($counter, 2) ?></b></div>
</div>
<hr>

<script type="text/javascript">
    $(function(){
        $('#marca,#cliente,#vendedor').select2();
        $('#interacciones,#enProceso,#vendidas').dataTable({
            bPaginate: true,
            searching: false,
            responsive: true,
            bSort: true,
            oLanguage: window.oLanguage
        });
    });
</script>
<style type="text/css">
    .botones{
        margin-top: 25px;
    }
    .title{
        text-align: center;
    }
    .title h3, .title h4{
        font-weight: bold;
        margin-top: 5px;
        margin-bottom: 20px;
    }
    .table{
        /*width: 100%;*/
    }
    .numero-cargo{
        font-size: 14px !important;
        text-align: center;
    }
    .cargo{
        font-weight: bold;
    }
    .red-text, .red-text a{
        color: #cc3232;
    }
</style>

<br>

<div class="col-xs-12 title">
    <h3><?= __('Resumen de Trabajos en Proceso de Ejecución') ?></h3>
</div>

<?= $this->Form->create(NULL, [
    'url' => [
        'controller' => 'Interactions',
        'action'=> 'trabajosEnProceso',
        'plugin' => false
    ],
    'type' => 'get',
    'style' => 'margin-top: 20px',
    'novalidate',
]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $this->Form->input('Cargos.company_id',[
                'empty'     => 'Seleccione...',
                'label'     => 'Empresa',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $empresas,
                'value'     => $this->request->query('Cargos.company_id'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('Cargos.sucursal_id',[
                'empty'     => 'Todos',
                'label'     => 'Sucursal',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $sucursales,
                'value'     => $this->request->query('Cargos.sucursal_id'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('Cargos.tipo_obra',[
                'empty'     => 'Todos',
                'label'     => 'Tipo de Obra',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $tiposObra,
                'value'     => $this->request->query('Cargos.tipo_obra'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $this->Form->input('Cargos.status_id',[
                'empty'     => 'Todos',
                'label'     => 'Estatus',
                'div'       => false,
                'style'     => 'height:28px',
                'options'   => $statuses,
                'value'     => $this->request->query('Cargos.status_id'),
                'class'     => 'form-control'
            ]); ?>
        </div>
        <div class="col-md-3">
            <div class="col-lg-6">
                <?= $this->Form->button(__('Buscar' ), [
                    'class' => 'btn btn-primary botones', 
                    'type'  => 'submit', 
                ]) ?>
            </div>
            <div class="col-lg-6">
                <a  href="/interactions/trabajos-en-proceso-pdf"
                    id="exportar-pdf" 
                    data-remote="false" 
                    data-toggle="modal" 
                    data-target="#genericModal"
                    >
                        <button class="btn btn-default exportar botones" type="button">PDF</button>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
    </div>
<?= $this->Form->end() ?>

<?php if ($cargos): ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr class="cargo">
                <th><?= __('No.') ?></th>
                <th></th>
                <th><?= __('No. De Cargo') ?></th>
                <th style="min-width: 120px;"><?= __('No. De COT.') ?></th>
                <th><?= __('Cliente') ?></th>
                <th><?= __('Descripción') ?></th>
                <th><?= __('Supervisor Responsable') ?></th>
                <th><?= __('Fecha de apertura') ?></th>
                <th><?= __('Fecha estimada de cierre / terminación') ?></th>
                <th><?= __('Observaciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $n = (($this->Paginator->current() - 1) * $this->Paginator->params()['perPage']) + 1; ?>
            <?php foreach ($cargos as $key => $cargo): ?>
                <?php $redText = ''; ?>
                <?php if ( $cargo->has('fecha_estimada_cierre') && $cargo->fecha_estimada_cierre < $now ): ?>
                    <?php $redText = 'red-text'; ?>
                <?php endif ?>
                <tr class="cargo <?= $redText ?>">
                    <td class="numero-cargo"><?= $n++ ?></td>
                    <td></td>
                    <td><?= $cargo->numero ?></td>
                    <td></td>
                    <td>
                        <?php if ($cargo->has('customer')): ?>
                            <a href="/customers/customers/view/<?= $cargo->customer->id ?>">
                                <?= $cargo->customer->title ?>
                            </a>
                        <?php endif ?>
                    </td>
                    <td><?= $cargo->descripcion ?></td>
                    <td>
                        <?php if ($cargo->has('user')): ?>
                            <?= $cargo->user->first_name ?>
                            <?= $cargo->user->last_name ?>
                            <?= $cargo->user->clast_name ?>
                        <?php endif ?>
                    </td>
                    <td><?= $cargo->has('fecha_apertura') ? $cargo->fecha_apertura->format('d/m/Y') : ''  ?></td>
                    <td><?= $cargo->has('fecha_estimada_cierre') ? $cargo->fecha_estimada_cierre->format('d/m/Y') : ''  ?></td>
                    <td><?= $cargo->observaciones ?></td>
                </tr>
                <?php if ($cargo->cotizaciones): ?>
                    <?php $o = 0; ?>
                    <?php foreach ($cargo->cotizaciones as $key => $cotizacion): ?>
                        <tr class="<?= $redText ?>">
                            <td></td>
                            <td><?= $n - 1 ?><?= $this->Generic->letterFromNumber($o++); ?></td>
                            <td></td>
                            <td><?= $cotizacion->numero_cotizacion ?></td>
                            <td></td>
                            <td><?= $cotizacion->descripcion ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
<?= $this->element('simple_pagination') ?>
<div class="clearfix"></div>
<?= $this->element('generic_modal'); ?>
<script type="text/javascript">
    $('#exportar-pdf').attr('href', '/interactions/trabajos-en-proceso-pdf' + location.search);
</script>
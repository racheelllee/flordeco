<div class="col-md-12">
    <div class="um-form-row form-group">
        <div class="col-md-4">
            <div class="col-xs-10">
                <label class="control-label"><?= __('File Quote'); ?></label>
                <?= $this->Form->input('archivo_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 30px;">
                <?php if ($cotizaciones->archivo): ?>
                    <a href="/<?= $cotizaciones->archivo ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-xs-10">
                <label class="control-label"><?= __('Purchase Order'); ?></label>
                <?= $this->Form->input('file_order_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 30px;">
                <?php if ($cotizaciones->file_order): ?>
                    <a href="/<?= $cotizaciones->file_order ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-8">
            <label class="control-label"><?= __('File Comment'); ?></label>
            <?= $this->Form->input('comentario_archivo', [
                'type'  => 'textarea',
                'label' => false,
                'div'   => false,
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="um-form-row form-group">
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Archivo de explosión de insumos 1'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('explosion_insumos_1_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->explosion_insumos_1): ?>
                    <a href="/<?= $cotizaciones->explosion_insumos_1 ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Archivo de explosión de insumos 2'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('explosion_insumos_2_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->explosion_insumos_2): ?>
                    <a href="/<?= $cotizaciones->explosion_insumos_2 ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Archivo de explosión de insumos 3'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('explosion_insumos_3_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->explosion_insumos_3): ?>
                    <a href="/<?= $cotizaciones->explosion_insumos_3 ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Archivo de explosión de insumos 4'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('explosion_insumos_4_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->explosion_insumos_4): ?>
                    <a href="/<?= $cotizaciones->explosion_insumos_4 ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Archivo de explosión de insumos 5'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('explosion_insumos_5_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->explosion_insumos_5): ?>
                    <a href="/<?= $cotizaciones->explosion_insumos_5 ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <label class="control-label"><?= __('Información adicional'); ?></label>
            </div>
            <div class="col-xs-10">
                <?= $this->Form->input('informacion_adicional_file', [
                    'type'  => 'file',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-xs-2" style="padding-top: 5px;">
                <?php if ($cotizaciones->informacion_adicional): ?>
                    <a href="/<?= $cotizaciones->informacion_adicional ?>" target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <br>
    </div>
</div>

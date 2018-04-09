<div class="modal-header">
	<h4 class="modal-title"><?= __('Agregar Sucursal') ?></h4>
</div>
<?= $this->Form->create($sucursale, ['url' => "/sucursales/add/",'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
    <?= $this->element('Sucursales/form') ?>
<?= $this->Form->end() ?>
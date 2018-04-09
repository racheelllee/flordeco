<div class="modal-header">
	<h4 class="modal-title"><?= __('Editar Sucursal') ?></h4>
</div>
<?= $this->Form->create($sucursale, ['url' => "/sucursales/edit/{$sucursale->id}",'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
    <?= $this->element('Sucursales/form') ?>
<?= $this->Form->end() ?>
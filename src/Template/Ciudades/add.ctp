<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h4 class="modal-title"><?= __('Agregar Ciudad') ?></h4>
</div>
    <?= $this->Form->create($ciudad, [
      'url' => "/ciudades/add/{$ciudad->id}",
      'class' => 'form-horizontal',
      'data-parsley-validate',
      'enctype' => 'multipart/form-data',
      'id' => 'save-ciudades',
      'type' => 'file'
    ]) ?>
    <?= $this->element('Ciudades/form') ?>
<?= $this->Form->end() ?>

<div class="row" style="text-align:right;">
    <div class="col-md-12 col-xs-12 col-lg-12">
        <?= $this->Html->link(__('Agregar Versión'), ['action' => 'versiones_add',$id], ['title' => __('Agregar Versión'), 'class'=>'btn btn-primary pull-right']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12">
<?php setlocale(LC_MONETARY, 'en_US.UTF-8');?>

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?= __('Código') ?></th>
                <th><?= __('Nombre') ?></th>            
                <th><?= __('Precio') ?></th>
                <th><?= __('Actualizacion') ?></th>
                <th><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
<?php foreach($versiones as $producto): ?>
            <tr>
                <td><?= $producto->sku; ?></td>
                <td><?= $producto->nombre; ?></td>
                <td><?= money_format('%.2n', $producto->precio) ?></td>
                <td><?php if(isset($producto->modified)){ echo h($producto->modified->i18nFormat('dd-MM-YYYY')); } ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-pencil"></i> ' . __('Editar'), ['action' => 'versiones_edit', $producto->id],['title' => __('Editar'), "escape" => false]) ?>
                    &nbsp;|&nbsp;
                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> ' . __('Borrar'), ['action' => 'versiones_delete', $producto->id], ['confirm' => __('Esta seguro que desea borrar el producto {0}?', $producto->sku),'title' => __('Borrar'), "escape" => false]) ?>
                </td>
            
            </tr>
        
<?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

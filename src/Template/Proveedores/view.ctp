<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Proveedor'), ['action' => 'edit', $proveedor->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Proveedor'), ['action' => 'delete', $proveedor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proveedor->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Proveedores'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Proveedor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Precios'), ['controller' => 'Precios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Precio'), ['controller' => 'Precios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($proveedor->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($proveedor->nombre) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($proveedor->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Precios" id="Precios-tab" role="tab" data-toggle="tab" aria-controls="Precios" aria-expanded="true">Precios</a>
      </li>
          <li role="presentation" class="">
        <a href="#Productos" id="Productos-tab" role="tab" data-toggle="tab" aria-controls="Productos" aria-expanded="true">Productos</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Precios" aria-labelledBy="Precios-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($proveedor->precios)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Producto Id') ?></th>
                                            <th><?= __('Proveedor Id') ?></th>
                                            <th><?= __('Costo') ?></th>
                                            <th><?= __('Margen') ?></th>
                                            <th><?= __('Precio') ?></th>
                                            <th><?= __('Activo') ?></th>
                                            <th><?= __('Envio Gratis') ?></th>
                                            <th><?= __('Existencia') ?></th>
                                            <th><?= __('Usuario Id') ?></th>
                                            <th><?= __('Actualizacion') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedor->precios as $precios): ?>
                    <tr>
                                            <td><?= h($precios->id) ?></td>
                                            <td><?= h($precios->producto_id) ?></td>
                                            <td><?= h($precios->proveedor_id) ?></td>
                                            <td><?= h($precios->costo) ?></td>
                                            <td><?= h($precios->margen) ?></td>
                                            <td><?= h($precios->precio) ?></td>
                                            <td><?= h($precios->activo) ?></td>
                                            <td><?= h($precios->envio_gratis) ?></td>
                                            <td><?= h($precios->existencia) ?></td>
                                            <td><?= h($precios->usuario_id) ?></td>
                                            <td><?= h($precios->actualizacion) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Precios', 'action' => 'view', $precios->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Precios', 'action' => 'edit', $precios->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Precios', 'action' => 'delete', $precios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $precios->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Precios asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Productos" aria-labelledBy="Productos-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($proveedor->productos)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Usuario Id') ?></th>
                                            <th><?= __('Proveedor Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Arugemnto De Venta') ?></th>
                                            <th><?= __('Descripcion') ?></th>
                                            <th><?= __('Ficha Tecnica') ?></th>
                                            <th><?= __('Sku') ?></th>
                                            <th><?= __('Marca Id') ?></th>
                                            <th><?= __('Modelo') ?></th>
                                            <th><?= __('Activo') ?></th>
                                            <th><?= __('Fecha Publicacion') ?></th>
                                            <th><?= __('Url') ?></th>
                                            <th><?= __('Meta Titulo') ?></th>
                                            <th><?= __('Meta Descripcion') ?></th>
                                            <th><?= __('Meta Keywords') ?></th>
                                            <th><?= __('Largo') ?></th>
                                            <th><?= __('Ancho') ?></th>
                                            <th><?= __('Alto') ?></th>
                                            <th><?= __('Peso') ?></th>
                                            <th><?= __('Peso Volumetrico') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedor->productos as $productos): ?>
                    <tr>
                                            <td><?= h($productos->id) ?></td>
                                            <td><?= h($productos->usuario_id) ?></td>
                                            <td><?= h($productos->proveedor_id) ?></td>
                                            <td><?= h($productos->nombre) ?></td>
                                            <td><?= h($productos->arugemnto_de_venta) ?></td>
                                            <td><?= h($productos->descripcion) ?></td>
                                            <td><?= h($productos->ficha_tecnica) ?></td>
                                            <td><?= h($productos->sku) ?></td>
                                            <td><?= h($productos->marca_id) ?></td>
                                            <td><?= h($productos->modelo) ?></td>
                                            <td><?= h($productos->activo) ?></td>
                                            <td><?= h($productos->fecha_publicacion) ?></td>
                                            <td><?= h($productos->url) ?></td>
                                            <td><?= h($productos->meta_titulo) ?></td>
                                            <td><?= h($productos->meta_descripcion) ?></td>
                                            <td><?= h($productos->meta_keywords) ?></td>
                                            <td><?= h($productos->largo) ?></td>
                                            <td><?= h($productos->ancho) ?></td>
                                            <td><?= h($productos->alto) ?></td>
                                            <td><?= h($productos->peso) ?></td>
                                            <td><?= h($productos->peso_volumetrico) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Productos', 'action' => 'view', $productos->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Productos', 'action' => 'edit', $productos->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Productos', 'action' => 'delete', $productos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productos->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Productos asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>


<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Promocion'), ['action' => 'edit', $promocion->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Promocion'), ['action' => 'delete', $promocion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promocion->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Promociones'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Promocion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($promocion->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($promocion->nombre) ?></p>
                                                    <h6><?= __('Usuario') ?></h6>
                    <p><?= $promocion->has('usuario') ? $this->Html->link($promocion->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $promocion->usuario->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($promocion->id) ?></p>
                    <h6><?= __('Monto') ?></h6>
                <p><?= $this->Number->format($promocion->monto) ?></p>
                    <h6><?= __('Descuento') ?></h6>
                <p><?= $this->Number->format($promocion->descuento) ?></p>
                    <h6><?= __('Envio') ?></h6>
                <p><?= $this->Number->format($promocion->envio) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Fecha Inicio') ?></h6>
                <p><?= h($promocion->fecha_inicio) ?></p>
                    <h6><?= __('Fecha Fin') ?></h6>
                <p><?= h($promocion->fecha_fin) ?></p>
                </div>
        </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Productos" id="Productos-tab" role="tab" data-toggle="tab" aria-controls="Productos" aria-expanded="true">Productos</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Productos" aria-labelledBy="Productos-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($promocion->productos)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Usuario Id') ?></th>
                                            <th><?= __('Proveedor Id') ?></th>
                                            <th><?= __('Sku') ?></th>
                                            <th><?= __('Codigo Fabricante') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Push') ?></th>
                                            <th><?= __('Descripcion Corta') ?></th>
                                            <th><?= __('Descripcion Larga') ?></th>
                                            <th><?= __('Ficha Tecnica') ?></th>
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
                                            <th><?= __('Costo') ?></th>
                                            <th><?= __('Margen') ?></th>
                                            <th><?= __('Precio') ?></th>
                                            <th><?= __('Envio Gratis') ?></th>
                                            <th><?= __('Garantia') ?></th>
                                            <th><?= __('Tiempo De Entrega') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promocion->productos as $productos): ?>
                    <tr>
                                            <td><?= h($productos->id) ?></td>
                                            <td><?= h($productos->usuario_id) ?></td>
                                            <td><?= h($productos->proveedor_id) ?></td>
                                            <td><?= h($productos->sku) ?></td>
                                            <td><?= h($productos->codigo_fabricante) ?></td>
                                            <td><?= h($productos->nombre) ?></td>
                                            <td><?= h($productos->push) ?></td>
                                            <td><?= h($productos->descripcion_corta) ?></td>
                                            <td><?= h($productos->descripcion_larga) ?></td>
                                            <td><?= h($productos->ficha_tecnica) ?></td>
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
                                            <td><?= h($productos->costo) ?></td>
                                            <td><?= h($productos->margen) ?></td>
                                            <td><?= h($productos->precio) ?></td>
                                            <td><?= h($productos->envio_gratis) ?></td>
                                            <td><?= h($productos->garantia) ?></td>
                                            <td><?= h($productos->tiempo_de_entrega) ?></td>
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


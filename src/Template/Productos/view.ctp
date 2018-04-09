<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Producto'), ['action' => 'edit', $producto->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Producto'), ['action' => 'delete', $producto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $producto->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Productos'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Producto'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Marcas'), ['controller' => 'Marcas', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Marca'), ['controller' => 'Marcas', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Atributos'), ['controller' => 'Atributos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Atributo'), ['controller' => 'Atributos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Cupones'), ['controller' => 'Cupones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cupon'), ['controller' => 'Cupones', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Imagenes'), ['controller' => 'Imagenes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Imagen'), ['controller' => 'Imagenes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Preciocomeptencias'), ['controller' => 'Preciocomeptencias', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Preciocomeptencia'), ['controller' => 'Preciocomeptencias', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Precios'), ['controller' => 'Precios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Precio'), ['controller' => 'Precios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Proveedores'), ['controller' => 'Proveedores', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Proveedor'), ['controller' => 'Proveedores', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Promociones'), ['controller' => 'Promociones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Promocion'), ['controller' => 'Promociones', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($producto->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Usuario') ?></h6>
                    <p><?= $producto->has('usuario') ? $this->Html->link($producto->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $producto->usuario->id]) : '' ?></p>
                                                    <h6><?= __('Sku') ?></h6>
                    <p><?= h($producto->sku) ?></p>
                                                    <h6><?= __('Codigo Fabricante') ?></h6>
                    <p><?= h($producto->codigo_fabricante) ?></p>
                                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($producto->nombre) ?></p>
                                                    <h6><?= __('Arugemnto De Venta') ?></h6>
                    <p><?= h($producto->arugemnto_de_venta) ?></p>
                                                    <h6><?= __('Marca') ?></h6>
                    <p><?= $producto->has('marca') ? $this->Html->link($producto->marca->nombre, ['controller' => 'Marcas', 'action' => 'view', $producto->marca->id]) : '' ?></p>
                                                    <h6><?= __('Modelo') ?></h6>
                    <p><?= h($producto->modelo) ?></p>
                                                    <h6><?= __('Url') ?></h6>
                    <p><?= h($producto->url) ?></p>
                                                    <h6><?= __('Meta Titulo') ?></h6>
                    <p><?= h($producto->meta_titulo) ?></p>
                                                    <h6><?= __('Grantia') ?></h6>
                    <p><?= h($producto->grantia) ?></p>
                                                    <h6><?= __('Tiempo De Entrega') ?></h6>
                    <p><?= h($producto->tiempo_de_entrega) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($producto->id) ?></p>
                    <h6><?= __('Proveedor Id') ?></h6>
                <p><?= $this->Number->format($producto->proveedor_id) ?></p>
                    <h6><?= __('Activo') ?></h6>
                <p><?= $this->Number->format($producto->activo) ?></p>
                    <h6><?= __('Largo') ?></h6>
                <p><?= $this->Number->format($producto->largo) ?></p>
                    <h6><?= __('Ancho') ?></h6>
                <p><?= $this->Number->format($producto->ancho) ?></p>
                    <h6><?= __('Alto') ?></h6>
                <p><?= $this->Number->format($producto->alto) ?></p>
                    <h6><?= __('Peso') ?></h6>
                <p><?= $this->Number->format($producto->peso) ?></p>
                    <h6><?= __('Peso Volumetrico') ?></h6>
                <p><?= $this->Number->format($producto->peso_volumetrico) ?></p>
                    <h6><?= __('Costo') ?></h6>
                <p><?= $this->Number->format($producto->costo) ?></p>
                    <h6><?= __('Margen') ?></h6>
                <p><?= $this->Number->format($producto->margen) ?></p>
                    <h6><?= __('Precio') ?></h6>
                <p><?= $this->Number->format($producto->precio) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Fecha Publicacion') ?></h6>
                <p><?= h($producto->fecha_publicacion) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Envio Gratis') ?></h6>
                <p><?= $producto->envio_gratis ? __('Yes') : __('No'); ?></p>
                </div>
    </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Descripcion') ?></h6>
                <?= $this->Text->autoParagraph(h($producto->descripcion)); ?>
            </div>
        </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Ficha Tecnica') ?></h6>
                <?= $this->Text->autoParagraph(h($producto->ficha_tecnica)); ?>
            </div>
        </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Meta Descripcion') ?></h6>
                <?= $this->Text->autoParagraph(h($producto->meta_descripcion)); ?>
            </div>
        </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Meta Keywords') ?></h6>
                <?= $this->Text->autoParagraph(h($producto->meta_keywords)); ?>
            </div>
        </div>
    <ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Atributos" id="Atributos-tab" role="tab" data-toggle="tab" aria-controls="Atributos" aria-expanded="true">Atributos</a>
      </li>
          <li role="presentation" class="">
        <a href="#Cupones" id="Cupones-tab" role="tab" data-toggle="tab" aria-controls="Cupones" aria-expanded="true">Cupones</a>
      </li>
          <li role="presentation" class="">
        <a href="#Imagenes" id="Imagenes-tab" role="tab" data-toggle="tab" aria-controls="Imagenes" aria-expanded="true">Imagenes</a>
      </li>
          <li role="presentation" class="">
        <a href="#Preciocomeptencias" id="Preciocomeptencias-tab" role="tab" data-toggle="tab" aria-controls="Preciocomeptencias" aria-expanded="true">Preciocomeptencias</a>
      </li>
          <li role="presentation" class="">
        <a href="#Precios" id="Precios-tab" role="tab" data-toggle="tab" aria-controls="Precios" aria-expanded="true">Precios</a>
      </li>
          <li role="presentation" class="">
        <a href="#Proveedores" id="Proveedores-tab" role="tab" data-toggle="tab" aria-controls="Proveedores" aria-expanded="true">Proveedores</a>
      </li>
          <li role="presentation" class="">
        <a href="#Categorias" id="Categorias-tab" role="tab" data-toggle="tab" aria-controls="Categorias" aria-expanded="true">Categorias</a>
      </li>
          <li role="presentation" class="">
        <a href="#Promociones" id="Promociones-tab" role="tab" data-toggle="tab" aria-controls="Promociones" aria-expanded="true">Promociones</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Atributos" aria-labelledBy="Atributos-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->atributos)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Producto Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->atributos as $atributos): ?>
                    <tr>
                                            <td><?= h($atributos->id) ?></td>
                                            <td><?= h($atributos->nombre) ?></td>
                                            <td><?= h($atributos->producto_id) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Atributos', 'action' => 'view', $atributos->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Atributos', 'action' => 'edit', $atributos->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Atributos', 'action' => 'delete', $atributos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $atributos->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Atributos asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Cupones" aria-labelledBy="Cupones-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->cupones)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Codigo') ?></th>
                                            <th><?= __('Cliente Id') ?></th>
                                            <th><?= __('Monto') ?></th>
                                            <th><?= __('Porcentaje') ?></th>
                                            <th><?= __('Fecha Inicio') ?></th>
                                            <th><?= __('Fecha Fin') ?></th>
                                            <th><?= __('Categoria Id') ?></th>
                                            <th><?= __('Marca Id') ?></th>
                                            <th><?= __('Producto Id') ?></th>
                                            <th><?= __('Cantidad') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->cupones as $cupones): ?>
                    <tr>
                                            <td><?= h($cupones->id) ?></td>
                                            <td><?= h($cupones->nombre) ?></td>
                                            <td><?= h($cupones->codigo) ?></td>
                                            <td><?= h($cupones->cliente_id) ?></td>
                                            <td><?= h($cupones->monto) ?></td>
                                            <td><?= h($cupones->porcentaje) ?></td>
                                            <td><?= h($cupones->fecha_inicio) ?></td>
                                            <td><?= h($cupones->fecha_fin) ?></td>
                                            <td><?= h($cupones->categoria_id) ?></td>
                                            <td><?= h($cupones->marca_id) ?></td>
                                            <td><?= h($cupones->producto_id) ?></td>
                                            <td><?= h($cupones->cantidad) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Cupones', 'action' => 'view', $cupones->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Cupones', 'action' => 'edit', $cupones->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Cupones', 'action' => 'delete', $cupones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cupones->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Cupones asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Imagenes" aria-labelledBy="Imagenes-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->imagenes)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Producto Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->imagenes as $imagenes): ?>
                    <tr>
                                            <td><?= h($imagenes->id) ?></td>
                                            <td><?= h($imagenes->producto_id) ?></td>
                                            <td><?= h($imagenes->nombre) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Imagenes', 'action' => 'view', $imagenes->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Imagenes', 'action' => 'edit', $imagenes->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Imagenes', 'action' => 'delete', $imagenes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imagenes->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Imagenes asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Preciocomeptencias" aria-labelledBy="Preciocomeptencias-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->preciocomeptencias)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Producto Id') ?></th>
                                            <th><?= __('Compentecia Id') ?></th>
                                            <th><?= __('Precio') ?></th>
                                            <th><?= __('Envio Gratis') ?></th>
                                            <th><?= __('Usuario Id') ?></th>
                                            <th><?= __('Actualizacion') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->preciocomeptencias as $preciocomeptencias): ?>
                    <tr>
                                            <td><?= h($preciocomeptencias->id) ?></td>
                                            <td><?= h($preciocomeptencias->producto_id) ?></td>
                                            <td><?= h($preciocomeptencias->compentecia_id) ?></td>
                                            <td><?= h($preciocomeptencias->precio) ?></td>
                                            <td><?= h($preciocomeptencias->envio_gratis) ?></td>
                                            <td><?= h($preciocomeptencias->usuario_id) ?></td>
                                            <td><?= h($preciocomeptencias->actualizacion) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Preciocomeptencias', 'action' => 'view', $preciocomeptencias->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Preciocomeptencias', 'action' => 'edit', $preciocomeptencias->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Preciocomeptencias', 'action' => 'delete', $preciocomeptencias->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preciocomeptencias->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Preciocomeptencias asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Precios" aria-labelledBy="Precios-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->precios)): ?>
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
                    <?php foreach ($producto->precios as $precios): ?>
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
<div role="tabpanel" class="tab-pane fade in " id="Proveedores" aria-labelledBy="Proveedores-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->proveedores)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->proveedores as $proveedores): ?>
                    <tr>
                                            <td><?= h($proveedores->id) ?></td>
                                            <td><?= h($proveedores->nombre) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Proveedores', 'action' => 'view', $proveedores->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Proveedores', 'action' => 'edit', $proveedores->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Proveedores', 'action' => 'delete', $proveedores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proveedores->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Proveedores asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Categorias" aria-labelledBy="Categorias-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->categorias)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Categoria Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Descripcion') ?></th>
                                            <th><?= __('Meta Descripcion') ?></th>
                                            <th><?= __('Meta Keywords') ?></th>
                                            <th><?= __('Meta Titulo') ?></th>
                                            <th><?= __('Url') ?></th>
                                            <th><?= __('Orden') ?></th>
                                            <th><?= __('Banner') ?></th>
                                            <th><?= __('Imagen Fondo') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->categorias as $categorias): ?>
                    <tr>
                                            <td><?= h($categorias->id) ?></td>
                                            <td><?= h($categorias->categoria_id) ?></td>
                                            <td><?= h($categorias->nombre) ?></td>
                                            <td><?= h($categorias->descripcion) ?></td>
                                            <td><?= h($categorias->meta_descripcion) ?></td>
                                            <td><?= h($categorias->meta_keywords) ?></td>
                                            <td><?= h($categorias->meta_titulo) ?></td>
                                            <td><?= h($categorias->url) ?></td>
                                            <td><?= h($categorias->orden) ?></td>
                                            <td><?= h($categorias->banner) ?></td>
                                            <td><?= h($categorias->imagen_fondo) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Categorias', 'action' => 'view', $categorias->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Categorias', 'action' => 'edit', $categorias->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Categorias', 'action' => 'delete', $categorias->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categorias->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Categorias asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Promociones" aria-labelledBy="Promociones-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($producto->promociones)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Fecha Inicio') ?></th>
                                            <th><?= __('Fecha Fin') ?></th>
                                            <th><?= __('Monto') ?></th>
                                            <th><?= __('Descuento') ?></th>
                                            <th><?= __('Envio') ?></th>
                                            <th><?= __('Usuario Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($producto->promociones as $promociones): ?>
                    <tr>
                                            <td><?= h($promociones->id) ?></td>
                                            <td><?= h($promociones->nombre) ?></td>
                                            <td><?= h($promociones->fecha_inicio) ?></td>
                                            <td><?= h($promociones->fecha_fin) ?></td>
                                            <td><?= h($promociones->monto) ?></td>
                                            <td><?= h($promociones->descuento) ?></td>
                                            <td><?= h($promociones->envio) ?></td>
                                            <td><?= h($promociones->usuario_id) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Promociones', 'action' => 'view', $promociones->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Promociones', 'action' => 'edit', $promociones->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Promociones', 'action' => 'delete', $promociones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promociones->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Promociones asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>


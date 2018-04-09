<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Cliente'), ['action' => 'edit', $cliente->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Cliente'), ['action' => 'delete', $cliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Clientes'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Cliente'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Municipios'), ['controller' => 'Municipios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Municipio'), ['controller' => 'Municipios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Paises'), ['controller' => 'Paises', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pais'), ['controller' => 'Paises', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clienteestatuses'), ['controller' => 'Clienteestatuses', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Clienteestatus'), ['controller' => 'Clienteestatuses', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Cupones'), ['controller' => 'Cupones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cupon'), ['controller' => 'Cupones', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => 'Direcciones', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($cliente->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($cliente->nombre) ?></p>
                                                    <h6><?= __('Correo Electronico') ?></h6>
                    <p><?= h($cliente->correo_electronico) ?></p>
                                                    <h6><?= __('Telefono Local') ?></h6>
                    <p><?= h($cliente->telefono_local) ?></p>
                                                    <h6><?= __('Telefono Celular') ?></h6>
                    <p><?= h($cliente->telefono_celular) ?></p>
                                                    <h6><?= __('Contrasena') ?></h6>
                    <p><?= h($cliente->contrasena) ?></p>
                                                    <h6><?= __('Razon Social') ?></h6>
                    <p><?= h($cliente->razon_social) ?></p>
                                                    <h6><?= __('Rfc') ?></h6>
                    <p><?= h($cliente->rfc) ?></p>
                                                    <h6><?= __('Calle') ?></h6>
                    <p><?= h($cliente->calle) ?></p>
                                                    <h6><?= __('Numero Exterior') ?></h6>
                    <p><?= h($cliente->numero_exterior) ?></p>
                                                    <h6><?= __('Numero Interior') ?></h6>
                    <p><?= h($cliente->numero_interior) ?></p>
                                                    <h6><?= __('Entre Calles') ?></h6>
                    <p><?= h($cliente->entre_calles) ?></p>
                                                    <h6><?= __('Colonia') ?></h6>
                    <p><?= h($cliente->colonia) ?></p>
                                                    <h6><?= __('Municipio') ?></h6>
                    <p><?= $cliente->has('municipio') ? $this->Html->link($cliente->municipio->nombre, ['controller' => 'Municipios', 'action' => 'view', $cliente->municipio->id]) : '' ?></p>
                                                    <h6><?= __('Codigo Postal') ?></h6>
                    <p><?= h($cliente->codigo_postal) ?></p>
                                                    <h6><?= __('Estado') ?></h6>
                    <p><?= $cliente->has('estado') ? $this->Html->link($cliente->estado->nombre, ['controller' => 'Estados', 'action' => 'view', $cliente->estado->id]) : '' ?></p>
                                                    <h6><?= __('Pais') ?></h6>
                    <p><?= $cliente->has('pais') ? $this->Html->link($cliente->pais->nombre, ['controller' => 'Paises', 'action' => 'view', $cliente->pais->id]) : '' ?></p>
                                                    <h6><?= __('Clienteestatus') ?></h6>
                    <p><?= $cliente->has('clienteestatus') ? $this->Html->link($cliente->clienteestatus->nombre, ['controller' => 'Clienteestatuses', 'action' => 'view', $cliente->clienteestatus->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($cliente->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Cupones" id="Cupones-tab" role="tab" data-toggle="tab" aria-controls="Cupones" aria-expanded="true">Cupones</a>
      </li>
          <li role="presentation" class="">
        <a href="#Direcciones" id="Direcciones-tab" role="tab" data-toggle="tab" aria-controls="Direcciones" aria-expanded="true">Direcciones</a>
      </li>
          <li role="presentation" class="">
        <a href="#Pedidos" id="Pedidos-tab" role="tab" data-toggle="tab" aria-controls="Pedidos" aria-expanded="true">Pedidos</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Cupones" aria-labelledBy="Cupones-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($cliente->cupones)): ?>
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
                    <?php foreach ($cliente->cupones as $cupones): ?>
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
<div role="tabpanel" class="tab-pane fade in " id="Direcciones" aria-labelledBy="Direcciones-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($cliente->direcciones)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Cliente Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Calle') ?></th>
                                            <th><?= __('Numero Exterior') ?></th>
                                            <th><?= __('Numero Interior') ?></th>
                                            <th><?= __('Entre Calles') ?></th>
                                            <th><?= __('Colonia') ?></th>
                                            <th><?= __('Municipio Id') ?></th>
                                            <th><?= __('Codigo Postal') ?></th>
                                            <th><?= __('Estado Id') ?></th>
                                            <th><?= __('Pais Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cliente->direcciones as $direcciones): ?>
                    <tr>
                                            <td><?= h($direcciones->id) ?></td>
                                            <td><?= h($direcciones->cliente_id) ?></td>
                                            <td><?= h($direcciones->nombre) ?></td>
                                            <td><?= h($direcciones->calle) ?></td>
                                            <td><?= h($direcciones->numero_exterior) ?></td>
                                            <td><?= h($direcciones->numero_interior) ?></td>
                                            <td><?= h($direcciones->entre_calles) ?></td>
                                            <td><?= h($direcciones->colonia) ?></td>
                                            <td><?= h($direcciones->municipio_id) ?></td>
                                            <td><?= h($direcciones->codigo_postal) ?></td>
                                            <td><?= h($direcciones->estado_id) ?></td>
                                            <td><?= h($direcciones->pais_id) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Direcciones', 'action' => 'view', $direcciones->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Direcciones', 'action' => 'edit', $direcciones->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Direcciones', 'action' => 'delete', $direcciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $direcciones->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Direcciones asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Pedidos" aria-labelledBy="Pedidos-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($cliente->pedidos)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Cliente Id') ?></th>
                                            <th><?= __('Fecha') ?></th>
                                            <th><?= __('Monto') ?></th>
                                            <th><?= __('Formasdepago Id') ?></th>
                                            <th><?= __('Estatus Id') ?></th>
                                            <th><?= __('Nombre Cliente') ?></th>
                                            <th><?= __('Correo Electronico') ?></th>
                                            <th><?= __('Telefono Local') ?></th>
                                            <th><?= __('Telefono Celular') ?></th>
                                            <th><?= __('Nombre Quien Recibe') ?></th>
                                            <th><?= __('Calle') ?></th>
                                            <th><?= __('Numero Exterior') ?></th>
                                            <th><?= __('Numero Interior') ?></th>
                                            <th><?= __('Entre Calles') ?></th>
                                            <th><?= __('Colonia') ?></th>
                                            <th><?= __('Municipio Id') ?></th>
                                            <th><?= __('Codigo Postal') ?></th>
                                            <th><?= __('Estado Id') ?></th>
                                            <th><?= __('Pais Id') ?></th>
                                            <th><?= __('Respuesta Pago') ?></th>
                                            <th><?= __('Facturar') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cliente->pedidos as $pedidos): ?>
                    <tr>
                                            <td><?= h($pedidos->id) ?></td>
                                            <td><?= h($pedidos->cliente_id) ?></td>
                                            <td><?= h($pedidos->fecha) ?></td>
                                            <td><?= h($pedidos->monto) ?></td>
                                            <td><?= h($pedidos->formasdepago_id) ?></td>
                                            <td><?= h($pedidos->estatus_id) ?></td>
                                            <td><?= h($pedidos->nombre_cliente) ?></td>
                                            <td><?= h($pedidos->correo_electronico) ?></td>
                                            <td><?= h($pedidos->telefono_local) ?></td>
                                            <td><?= h($pedidos->telefono_celular) ?></td>
                                            <td><?= h($pedidos->nombre_quien_recibe) ?></td>
                                            <td><?= h($pedidos->calle) ?></td>
                                            <td><?= h($pedidos->numero_exterior) ?></td>
                                            <td><?= h($pedidos->numero_interior) ?></td>
                                            <td><?= h($pedidos->entre_calles) ?></td>
                                            <td><?= h($pedidos->colonia) ?></td>
                                            <td><?= h($pedidos->municipio_id) ?></td>
                                            <td><?= h($pedidos->codigo_postal) ?></td>
                                            <td><?= h($pedidos->estado_id) ?></td>
                                            <td><?= h($pedidos->pais_id) ?></td>
                                            <td><?= h($pedidos->respuesta_pago) ?></td>
                                            <td><?= h($pedidos->facturar) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Pedidos', 'action' => 'view', $pedidos->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Pedidos', 'action' => 'edit', $pedidos->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Pedidos', 'action' => 'delete', $pedidos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pedidos->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Pedidos asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>


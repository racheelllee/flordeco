<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Comentario'), ['action' => 'edit', $comentario->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Comentario'), ['action' => 'delete', $comentario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comentario->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Comentarios'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Comentario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($comentario->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Producto') ?></h6>
                    <p><?= $comentario->has('producto') ? $this->Html->link($comentario->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $comentario->producto->id]) : '' ?></p>
                                                    <h6><?= __('Usuario') ?></h6>
                    <p><?= $comentario->has('usuario') ? $this->Html->link($comentario->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $comentario->usuario->id]) : '' ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($comentario->id) ?></p>
                    <h6><?= __('Calificacion') ?></h6>
                <p><?= $this->Number->format($comentario->calificacion) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Fecha') ?></h6>
                <p><?= h($comentario->fecha) ?></p>
                </div>
            <div class="col-lg-2">
                    <h6><?= __('Autorizado') ?></h6>
                <p><?= $comentario->autorizado ? __('Yes') : __('No'); ?></p>
                </div>
    </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Comentarios') ?></h6>
                <?= $this->Text->autoParagraph(h($comentario->comentarios)); ?>
            </div>
        </div>
    <ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Pedidos" id="Pedidos-tab" role="tab" data-toggle="tab" aria-controls="Pedidos" aria-expanded="true">Pedidos</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Pedidos" aria-labelledBy="Pedidos-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($comentario->pedidos)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Cliente Id') ?></th>
                                            <th><?= __('Fecha') ?></th>
                                            <th><?= __('Monto') ?></th>
                                            <th><?= __('Iva') ?></th>
                                            <th><?= __('Envio') ?></th>
                                            <th><?= __('Cupon') ?></th>
                                            <th><?= __('Cupon Id') ?></th>
                                            <th><?= __('Redcompensa') ?></th>
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
                                            <th><?= __('Guia De Envio') ?></th>
                                            <th><?= __('Ciudad') ?></th>
                                            <th><?= __('Estado') ?></th>
                                            <th><?= __('Recibido Por') ?></th>
                                            <th><?= __('Fecha Entrega') ?></th>
                                            <th><?= __('Modified') ?></th>
                                            <th><?= __('Proveedor Mensajeria') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comentario->pedidos as $pedidos): ?>
                    <tr>
                                            <td><?= h($pedidos->id) ?></td>
                                            <td><?= h($pedidos->cliente_id) ?></td>
                                            <td><?= h($pedidos->fecha) ?></td>
                                            <td><?= h($pedidos->monto) ?></td>
                                            <td><?= h($pedidos->iva) ?></td>
                                            <td><?= h($pedidos->envio) ?></td>
                                            <td><?= h($pedidos->cupon) ?></td>
                                            <td><?= h($pedidos->cupon_id) ?></td>
                                            <td><?= h($pedidos->redcompensa) ?></td>
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
                                            <td><?= h($pedidos->guia_de_envio) ?></td>
                                            <td><?= h($pedidos->ciudad) ?></td>
                                            <td><?= h($pedidos->estado) ?></td>
                                            <td><?= h($pedidos->recibido_por) ?></td>
                                            <td><?= h($pedidos->fecha_entrega) ?></td>
                                            <td><?= h($pedidos->modified) ?></td>
                                            <td><?= h($pedidos->proveedor_mensajeria) ?></td>
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


<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Formasdepago'), ['action' => 'edit', $formasdepago->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Formasdepago'), ['action' => 'delete', $formasdepago->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formasdepago->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Formasdepagos'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Formasdepago'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($formasdepago->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($formasdepago->nombre) ?></p>
                                                    <h6><?= __('Imagen') ?></h6>
                    <p><?= h($formasdepago->imagen) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($formasdepago->id) ?></p>
                </div>
                <div class="col-lg-2">
                    <h6><?= __('Activo') ?></h6>
                <p><?= $formasdepago->activo ? __('Yes') : __('No'); ?></p>
                </div>
    </div>
    <div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('Descripcion') ?></h6>
                <?= $this->Text->autoParagraph(h($formasdepago->descripcion)); ?>
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
            <?php if (!empty($formasdepago->pedidos)): ?>
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
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($formasdepago->pedidos as $pedidos): ?>
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


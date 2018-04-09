<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Municipio'), ['action' => 'edit', $municipio->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Municipio'), ['action' => 'delete', $municipio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $municipio->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Municipios'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Municipio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Estados'), ['controller' => 'Estados', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Estado'), ['controller' => 'Estados', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('Listar Direcciones'), ['controller' => 'Direcciones', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Direccion'), ['controller' => 'Direcciones', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($municipio->id) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Estado') ?></h6>
                    <p><?= $municipio->has('estado') ? $this->Html->link($municipio->estado->id, ['controller' => 'Estados', 'action' => 'view', $municipio->estado->id]) : '' ?></p>
                                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($municipio->nombre) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($municipio->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Clientes" id="Clientes-tab" role="tab" data-toggle="tab" aria-controls="Clientes" aria-expanded="true">Clientes</a>
      </li>
          <li role="presentation" class="">
        <a href="#Direcciones" id="Direcciones-tab" role="tab" data-toggle="tab" aria-controls="Direcciones" aria-expanded="true">Direcciones</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Clientes" aria-labelledBy="Clientes-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($municipio->clientes)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Nombre') ?></th>
                                            <th><?= __('Correo Electronico') ?></th>
                                            <th><?= __('Telefono Local') ?></th>
                                            <th><?= __('Telefono Celular') ?></th>
                                            <th><?= __('Contrasena') ?></th>
                                            <th><?= __('Razon Social') ?></th>
                                            <th><?= __('Rfc') ?></th>
                                            <th><?= __('Calle') ?></th>
                                            <th><?= __('Numero Exterior') ?></th>
                                            <th><?= __('Numero Interior') ?></th>
                                            <th><?= __('Entre Calles') ?></th>
                                            <th><?= __('Colonia') ?></th>
                                            <th><?= __('Municipio Id') ?></th>
                                            <th><?= __('Codigo Postal') ?></th>
                                            <th><?= __('Estado Id') ?></th>
                                            <th><?= __('Pais Id') ?></th>
                                            <th><?= __('Clienteestatus Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($municipio->clientes as $clientes): ?>
                    <tr>
                                            <td><?= h($clientes->id) ?></td>
                                            <td><?= h($clientes->nombre) ?></td>
                                            <td><?= h($clientes->correo_electronico) ?></td>
                                            <td><?= h($clientes->telefono_local) ?></td>
                                            <td><?= h($clientes->telefono_celular) ?></td>
                                            <td><?= h($clientes->contrasena) ?></td>
                                            <td><?= h($clientes->razon_social) ?></td>
                                            <td><?= h($clientes->rfc) ?></td>
                                            <td><?= h($clientes->calle) ?></td>
                                            <td><?= h($clientes->numero_exterior) ?></td>
                                            <td><?= h($clientes->numero_interior) ?></td>
                                            <td><?= h($clientes->entre_calles) ?></td>
                                            <td><?= h($clientes->colonia) ?></td>
                                            <td><?= h($clientes->municipio_id) ?></td>
                                            <td><?= h($clientes->codigo_postal) ?></td>
                                            <td><?= h($clientes->estado_id) ?></td>
                                            <td><?= h($clientes->pais_id) ?></td>
                                            <td><?= h($clientes->clienteestatus_id) ?></td>
                                                                    <td class="actions">
                            <?= $this->Html->link('', ['controller' => 'Clientes', 'action' => 'view', $clientes->id],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['controller' => 'Clientes', 'action' => 'edit', $clientes->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['controller' => 'Clientes', 'action' => 'delete', $clientes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientes->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php else: ?>
            <h4><?= __('No existen Clientes asociados') ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane fade in " id="Direcciones" aria-labelledBy="Direcciones-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($municipio->direcciones)): ?>
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
                    <?php foreach ($municipio->direcciones as $direcciones): ?>
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
</div>


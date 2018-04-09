<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Editar Clienteestatus'), ['action' => 'edit', $clienteestatus->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Eliminar Clienteestatus'), ['action' => 'delete', $clienteestatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clienteestatus->id)]) ?> </li>
    <li><?= $this->Html->link(__('Listar Clienteestatuses'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('Nuevo Clienteestatus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
                </ul>
<?php $this->end(); ?>

<h2><?= h($clienteestatus->nombre) ?></h2>
<div class="row">
        <div class="col-lg-5">
                                    <h6><?= __('Nombre') ?></h6>
                    <p><?= h($clienteestatus->nombre) ?></p>
                                </div>
            <div class="col-lg-2">
                    <h6><?= __('Id') ?></h6>
                <p><?= $this->Number->format($clienteestatus->id) ?></p>
                </div>
            </div>
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#Clientes" id="Clientes-tab" role="tab" data-toggle="tab" aria-controls="Clientes" aria-expanded="true">Clientes</a>
      </li>
         
</ul>

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Clientes" aria-labelledBy="Clientes-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <?php if (!empty($clienteestatus->clientes)): ?>
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
                    <?php foreach ($clienteestatus->clientes as $clientes): ?>
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
</div>


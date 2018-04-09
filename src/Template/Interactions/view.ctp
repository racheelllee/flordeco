<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Interaction'), ['action' => 'edit', $interaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Interaction'), ['action' => 'delete', $interaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $interaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Interactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Interaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Interaction Statuses'), ['controller' => 'InteractionStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Interaction Status'), ['controller' => 'InteractionStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Interaction Types'), ['controller' => 'InteractionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Interaction Type'), ['controller' => 'InteractionTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="interactions view large-9 medium-8 columns content">
    <h3><?= h($interaction->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Interaction Type') ?></th>
            <td><?= $interaction->has('interaction_type') ? $this->Html->link($interaction->interaction_type->name, ['controller' => 'InteractionTypes', 'action' => 'view', $interaction->interaction_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $interaction->has('user') ? $this->Html->link($interaction->user->id, ['controller' => 'Users', 'action' => 'view', $interaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $interaction->has('customer') ? $this->Html->link($interaction->customer->title, ['controller' => 'Customers', 'action' => 'view', $interaction->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interaction Status') ?></th>
            <td><?= $interaction->has('interaction_status') ? $this->Html->link($interaction->interaction_status->name, ['controller' => 'InteractionStatuses', 'action' => 'view', $interaction->interaction_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($interaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Length') ?></th>
            <td><?= $this->Number->format($interaction->length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($interaction->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($interaction->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($interaction->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($interaction->comments)); ?>
    </div>
</div>

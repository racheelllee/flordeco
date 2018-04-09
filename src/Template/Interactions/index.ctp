<div class="row">
    <div class="col-xs-6 w-title w-color666">
      <h3 style="position: absolute; margin-top:30px;"><?php echo __('List of Interactions');?></h3>
    </div>
    <div class="col-xs-6">
        <button class="btn btn-default w-AvenirLight w-btnNewUsers" data-toggle="modal" data-target="#interactionsModal">
            +  <?= __('New interaction') ?>
        </button>
    </div>
</div>
<div class="table-reponsive interactions" style="margin-top:30px;">
    <table id="interactionsTable" >
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interaction_status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interaction_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($interactions as $interaction): ?>
            <tr>
                <td><?= $this->Number->format($interaction->id) ?></td>
                <td><?= h($interaction->title) ?></td>
                <td><?= $this->Number->format($interaction->length) ?></td>
                <td><?= $interaction->has('user') ? $this->Html->link($interaction->user->id, ['controller' => 'Users', 'action' => 'view', $interaction->user->id]) : '' ?></td>
                <td><?= $interaction->has('customer') ? $this->Html->link($interaction->customer->title, ['controller' => 'Customers', 'action' => 'view', $interaction->customer->id]) : '' ?></td>
                <td><?= $interaction->has('interaction_status') ? $this->Html->link($interaction->interaction_status->name, ['controller' => 'InteractionStatuses', 'action' => 'view', $interaction->interaction_status->id]) : '' ?></td>
                <td><?= $interaction->has('interaction_type') ? $this->Html->link($interaction->interaction_type->name, ['controller' => 'InteractionTypes', 'action' => 'view', $interaction->interaction_type->id]) : '' ?></td>
                <td><?= h($interaction->start_date) ?></td>
                <td><?= h($interaction->modified) ?></td>
                <td><?= h($interaction->created) ?></td>
                <td class="actions">
                    <div class='btn-group'>
                        <button 
                                class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' 
                                aria-expanded='false'>
                            <?= __('Actions') ?>
                            <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu pull-right'>
                            <li>
                                <!--a href="#" data-toggle="modal" data-target="#interactionsModal<?=$interaction->id?>">
                                    <?= __('Edit') ?>
                                </a-->
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $interaction->id]) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $interaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $interaction->id)]) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#interactionsTable').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: -1 },
            ]
        });
    });
</script>
<div class="modal fade" id="interactionsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?= __('Add interaction') ?></h4>
      </div>
      <?= $this->render('add', false, compact('dependencies')) ?>
    </div>
  </div>
</div>
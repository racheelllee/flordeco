<div id="interaction-popover-<?= $interaction->id; ?>">
    <?= $this->Form->create(null , ['url'=>'/interactions/edit/' . $interaction->id ] ); ?>
        <?= 
            $this->Form->input(
                'status_change_comment',
                [
                    'type'  => 'textarea',
                    'label' => false,
                    'div'   => false,
                    'class' => 'form-control',
                    'style' => 'width:100%;resize: none;',
                    'value' => $interaction->status_change_comment
                ]
            );
        ?>
        <?= 
            $this->Form->input(
                'interaction_status_id',
                [
                    'id'    => 'interaction-status-id-' . $interaction->id,
                    'type'  => 'hidden',
                    'value' => $interaction->interaction_status_id,
                ]
            );
        ?>
        <?= 
            $this->Form->input(
                'redirect',
                [
                    'type'  => 'hidden',
                    'value' => "/customers/customers/view/" . $interaction->customer_id,
                ]
            );
        ?>
        <?= 
            $this->Form->input(
                'last_status_change_user',
                [
                    'type'  => 'hidden',
                    'value' => $this->UserAuth->getUserId(),
                ]
            );
        ?>
        <?= 
            $this->Form->input(
                'last_status_change_time',
                [
                    'type'  => 'hidden',
                    'value' => date('Y-m-d H:i:s'),
                ]
            );
        ?>
        <?= 
            $this->Form->input(
                'status_previous_to_change',
                [
                    'type'  => 'hidden',
                    'value' => $interaction->interaction_status_id,
                ]
            );
        ?>
        <br>
        <?php foreach ($interactionStatuses as $key => $status): ?>
            <a  href="#" 
                class="btn-xs btn change-interaction-button"
                data-interaction="<?= $interaction->id ?>"
                data-status="<?= $status->id ?>"
                style="
                    color: white;
                    font-size: 10px !important;
                    background-color: <?= $status->color ?>
                    "
                >
                <?=$status->name?>
            </a>
        <?php endforeach ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
	$('.change-interaction-button').on('click', function(ev){
		document.querySelector('#interaction-status-id-' + this.dataset.interaction).value = this.dataset.status;
        $('[data-interaction="' + this.dataset.interaction + '"].interaction-popover').popover('hide')
		$(this).parent().submit();
	});
</script>
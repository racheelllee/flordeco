<?= $this->Form->create($office) ?>
<fieldset>
    <legend><?= __('Edit Office') ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('street');
        echo $this->Form->input('number');
        echo $this->Form->input('colony');
        echo $this->Form->input('municipality_id', ['options' => $municipalities]);
        echo $this->Form->input('state_id', ['options' => $states]);
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
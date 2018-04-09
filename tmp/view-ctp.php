<?php

use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
        ->map(function($field) use ($immediateAssociations) {
            foreach ($immediateAssociations as $alias => $details) {
                if ($field === $details['foreignKey']) {
                    return [$field => $details];
                }
            }
        })
        ->filter()
        ->reduce(function($fields, $value) {
    return $fields + $value;
}, []);

$groupedFields = collection($fields)
        ->filter(function($field) use ($schema) {
            return $schema->columnType($field) !== 'binary';
        })
        ->groupBy(function($field) use ($schema, $associationFields) {
            $type = $schema->columnType($field);
            if (isset($associationFields[$field])) {
                return 'string';
            }
            if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
                return 'number';
            }
            if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
                return 'date';
            }
            return in_array($type, ['text', 'boolean']) ? $type : 'string';
        })
        ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
?>
<CakePHPBakeOpenTagphp
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
CakePHPBakeCloseTag>
<ul class="nav nav-sidebar">
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Editar <?= $singularHumanName ?>'), ['action' => 'edit', <?= $pk ?>]) CakePHPBakeCloseTag> </li>
    <li><CakePHPBakeOpenTag= $this->Form->postLink(__('Eliminar <?= $singularHumanName ?>'), ['action' => 'delete', <?= $pk ?>], ['confirm' => __('Are you sure you want to delete # {0}?', <?= $pk ?>)]) CakePHPBakeCloseTag> </li>
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Listar <?= $pluralHumanName ?>'), ['action' => 'index']) CakePHPBakeCloseTag> </li>
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Nuevo <?= $singularHumanName ?>'), ['action' => 'add']) CakePHPBakeCloseTag> </li>
    <?php
    $done = [];
    foreach ($associations as $type => $data) {
        foreach ($data as $alias => $details) {
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                ?>
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Listar <?= $this->_pluralHumanName($alias) ?>'), ['controller' => '<?= $details['controller'] ?>', 'action' => 'index']) CakePHPBakeCloseTag> </li>
                <li><CakePHPBakeOpenTag= $this->Html->link(__('Agregar <?= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) ?>'), ['controller' => '<?= $details['controller'] ?>', 'action' => 'add']) CakePHPBakeCloseTag> </li>
                <?php
                $done[] = $details['controller'];
            }
        }
    }
    ?>
</ul>
<CakePHPBakeOpenTagphp $this->end(); CakePHPBakeCloseTag>

<h2><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $displayField ?>) CakePHPBakeCloseTag></h2>
<div class="row">
    <?php if ($groupedFields['string']) : ?>
    <div class="col-lg-5">
            <?php foreach ($groupedFields['string'] as $field) : ?>
                <?php
                if (isset($associationFields[$field])) :
                    $details = $associationFields[$field];
                    ?>
        <h6><CakePHPBakeOpenTag= __('<?= Inflector::humanize($details['property']) ?>') CakePHPBakeCloseTag></h6>
                    <p><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></p>
                <?php else : ?>
        <h6><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></h6>
                    <p><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
                <?php endif; ?>
            <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($groupedFields['number']) : ?>
    <div class="col-lg-2">
            <?php foreach ($groupedFields['number'] as $field) : ?>
        <h6><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></h6>
                <p><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
            <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($groupedFields['date']) : ?>
    <div class="col-lg-2">
            <?php foreach ($groupedFields['date'] as $field) : ?>
        <h6><?= "<?= __('" . Inflector::humanize($field) . "') ?>" ?></h6>
                <p><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
            <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($groupedFields['boolean']) : ?>
    <div class="col-lg-2">
            <?php foreach ($groupedFields['boolean'] as $field) : ?>
        <h6><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></h6>
                <p><CakePHPBakeOpenTag= $<?= $singularVar ?>-><?= $field ?> ? __('Yes') : __('No'); CakePHPBakeCloseTag></p>
            <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?php if ($groupedFields['text']) : ?>
    <?php foreach ($groupedFields['text'] as $field) : ?>
<div class="row texts">
            <div class="col-lg-9">
                <h6><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></h6>
                <CakePHPBakeOpenTag= $this->Text->autoParagraph(h($<?= $singularVar ?>-><?= $field ?>)); CakePHPBakeCloseTag>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<ul id="myTab" class="nav nav-tabs" role="tablist">
<?php
//Vamos a usar tabs, asi que recorro los asociados para ponerlos.
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
$active="active";
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    ?>
    <li role="presentation" class="<?= $active; ?>">
        <a href="#<?= $alias; ?>" id="<?= $alias; ?>-tab" role="tab" data-toggle="tab" aria-controls="<?= $alias; ?>" aria-expanded="true"><?= $otherPluralHumanName ?></a>
      </li>
      <?php $active=""; ?>
<?php endforeach; ?>   
</ul>

<div id="myTabContent" class="tab-content">
<?php
$active="active";
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    ?>
<div role="tabpanel" class="tab-pane fade in <?= $active; ?>" id="<?= $alias; ?>" aria-labelledBy="<?= $alias; ?>-tab">
    <div class="related row">
        <div class = "col-lg-12"><br>            
            <CakePHPBakeOpenTagphp if (!empty($<?= $singularVar ?>-><?= $details['property'] ?>)): CakePHPBakeCloseTag>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php foreach ($details['fields'] as $field): ?>
                    <th><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></th>
                        <?php endforeach; ?>
                    <th class="actions"><CakePHPBakeOpenTag= __('Actions') CakePHPBakeCloseTag></th>
                    </tr>
                </thead>
                <tbody>
                    <CakePHPBakeOpenTagphp foreach ($<?= $singularVar ?>-><?= $details['property'] ?> as $<?= $otherSingularVar ?>): CakePHPBakeCloseTag>
                    <tr>
                        <?php foreach ($details['fields'] as $field): ?>
                    <td><CakePHPBakeOpenTag= h($<?= $otherSingularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                        <?php endforeach; ?>
                        <?php $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; ?>
                    <td class="actions">
                            <CakePHPBakeOpenTag= $this->Html->link('', ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', <?= $otherPk ?>],['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Html->link('', ['controller' => '<?= $details['controller'] ?>', 'action' => 'edit', <?= $otherPk ?>], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Form->postLink('', ['controller' => '<?= $details['controller'] ?>', 'action' => 'delete', <?= $otherPk ?>], ['confirm' => __('Are you sure you want to delete # {0}?', <?= $otherPk ?>), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash']) CakePHPBakeCloseTag>                            
                        </td>
                    </tr>
                <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
            </tbody>
        </table>
         <CakePHPBakeOpenTagphp else: CakePHPBakeCloseTag>
            <h4><CakePHPBakeOpenTag= __('No existen <?= $otherPluralHumanName ?> asociados') CakePHPBakeCloseTag></h4>
        <CakePHPBakeOpenTagphp endif; CakePHPBakeCloseTag>
        </div>
    </div>
</div>
<?php $active=""; ?>
<?php endforeach; ?>
</div>


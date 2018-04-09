<?php

use Cake\Utility\Inflector;
?>
<CakePHPBakeOpenTagphp
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
CakePHPBakeCloseTag>
<ul class="nav nav-sidebar">
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Agregar <?= $singularHumanName ?>'), ['action' => 'add']); CakePHPBakeCloseTag></li>
    <?php
    $done = [];
    foreach ($associations as $type => $data):
        foreach ($data as $alias => $details):
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)):
                ?>
    <li><CakePHPBakeOpenTag= $this->Html->link(__('Listar <?= Inflector::humanize($details["controller"]) ?>'), ['controller' => '<?= $details["controller"] ?>', 'action' => 'index']); CakePHPBakeCloseTag></li>
                <li><CakePHPBakeOpenTag= $this->Html->link(__('Agregar <?= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) ?>'), ['controller' => ' <?= $details["controller"] ?>', 'action' => 'add']); CakePHPBakeCloseTag></li>
                <?php
                $done[] = $details['controller'];
            endif;
        endforeach;
    endforeach;
    ?>
</ul>
<CakePHPBakeOpenTagphp $this->end(); CakePHPBakeCloseTag>
<?php
$fields = collection($fields)
        ->filter(function($field) use ($schema) {
            return !in_array($schema->columnType($field), ['binary', 'text']);
        })
        ->take(7);
?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
                        <h2> <?= $pluralHumanName ?></h2>
                    </div>
                    <div class="ibox-tools col-md-4 pull-right">
                        <a href="/<?= $pluralVar ?>/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar <?= $singularHumanName ?></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <?php foreach ($fields as $field): ?>
                                <th><?= $field ?></th>
                                <?php endforeach; ?>
                                <th class="actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <CakePHPBakeOpenTagphp foreach ($<?= $pluralVar ?> as $<?= $singularVar ?>): CakePHPBakeCloseTag>
                            <tr>
                                <?php
                                foreach ($fields as $field) {
                                    $isKey = false;
                                    if (!empty($associations['BelongsTo'])) {
                                        foreach ($associations['BelongsTo'] as $alias => $details) {
                                            if ($field === $details['foreignKey']) {
                                                $isKey = true;
                                                ?>
                                                <td>
                                                    <CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag>
                                                </td>
                                                <?php
                                                break;
                                            }
                                        }
                                    }
                                    if ($isKey !== true) {
                                        if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                                            ?>
                                <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                                            <?php
                                        } else {
                                            ?>
                                <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                                            <?php
                                        }
                                    }
                                }

                                $pk = '$' . $singularVar . '->' . $primaryKey[0];
                                ?>
                                <td class="actions">
                                    <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><CakePHPBakeOpenTag= $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;Editar', ['action' => 'edit', <?= $pk ?>], ['title' => __('Editar'), "escape" => false]) CakePHPBakeCloseTag></li>
                                          <li role="presentation"><CakePHPBakeOpenTag= $this->Form->postLink('<i class="fa fa-trash"></i>&nbsp;Borrar', ['action' => 'delete', <?= $pk ?>], ['confirm' => __('Seguro que quiere borrar # {0}?', <?= $pk ?>), 'title' => __('Delete'), "escape" => false]) CakePHPBakeCloseTag></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                                <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
                             </tbody>
</table>
    </div></div></div></div></div>


<script type="text/javascript">
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "lengthChange": false,
                 "footerCallback": function( tfoot, data, start, end, display ) {
                    $(tfoot).html( "" );
                }
            });
        });

</script>
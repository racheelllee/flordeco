<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
%>
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-md-4">
            <h2><?php echo __('<%= $pluralHumanName %>'); ?></h2>
        </div>
                    <div class="ibox-tools col-md-4 pull-right">
           <?= $this->Html->link(__('Agregar <%= $singularHumanName %>',true), ['action'=>'add'], ['class'=>'btn btn-primary pull-right']) ?>
        </div>
                </div>
    <div class="ibox-content">
        <!-- Inicia element  <?php #echo $this->element('all_<%= $pluralHumanName %>'); ?> -->
      <div id="update<%= $pluralHumanName %>Index">
    <?php echo $this->Search->searchForm('<%= $pluralHumanName %>', ['legend'=>false, 'updateDivId'=>'update<%= $pluralHumanName %>Index']); ?>
    <?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'update<%= $pluralHumanName %>Index']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
             <% foreach ($fields as $field): %>
        <th class="psorting"><?= $this->Paginator->sort('<%= $field %>') ?></th>
    <% endforeach; %>
                <th><?php echo __('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($<%= $pluralVar %>)) {
                $page = $this->request->params['paging']['<%= $pluralHumanName %>']['page'];
                $limit = $this->request->params['paging']['<%= $pluralHumanName %>']['perPage'];
                $i = ($page-1) * $limit;


         foreach ($<%= $pluralVar %> as $<%= $singularVar %>): 
                    $i++;
            ?>
             <tr>
         <%
                foreach ($fields as $field) {
            $isKey = false;
            if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                        $isKey = true;
        %>
            <td>
                <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
            </td>
<%
                        break;
                    }
                }
            }
            if ($isKey !== true) {
                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                } else {
%>
            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                }
            }
        }

        $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
            <td class="actions">
                <div class="dropdown">
                                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                 <li role="presentation"><?= $this->Html->link(__('Ver'), ['action' => 'view', <%= $pk %>]) ?></li>
               <li role="presentation"> <?= $this->Html->link(__('Editar'), ['action' => 'edit', <%= $pk %>]) ?></li>
                <li role="presentation"><?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Esta seguro que desea borrar # {0}?', <%= $pk %>)]) ?></li>
                </ul>
                </div>
                              
            </td>
        </tr>

    <?php endforeach; 

      } else {
            echo "<tr><td colspan=7><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    <?php if(!empty($<%= $pluralVar %>)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Páginas')]);
    } ?>
</div>
<!-- termina element -->
</div>
</div>

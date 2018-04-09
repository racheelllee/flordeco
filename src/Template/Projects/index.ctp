<div class="row">
    <div class="col-xs-6 w-title w-color666">

      <span style="position: absolute; margin-top:30px;"><?php echo __('List of Projects');?></span>

    </div>

    <div class="col-xs-6">
        <?php if($this->UserAuth->HP('Projects', 'add')) { ?>
            <?= $this->Html->link(__('New Project'), ['action' => 'add'],['class'=>'btn btn-default w-AvenirLight w-btnNewUsers', 'escape'=>false] ); ?> 
        <?php } ?>
    </div>

</div>
<div class="">
    <div class="table-reponsive" style="margin-top:30px;">
        <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight" id="UsersTable" width="100%" data-page-length='50' data-order='[[ 1, "asc" ]]'>
            <thead>
                <tr>
                    <th class="sorting" style="min-width:250px;"> <?=  __('Proyecto_nombre'); ?> </th>
                    
                    <th class="sorting" style="min-width:250px;"> <?=  __('Proyecto_ubicacion'); ?> </th>

                    <th class="sorting" style="min-width:150px;"> <?=  __('Proyecto_tamano'); ?> </th>

                    <th class="sorting"> <?=  __('Proyecto_complejidad'); ?> </th>

                    <th class="sorting" style="min-width:250px;"> <?=  __('Proyecto_inicio'); ?> </th>

                    <th class="sorting" style="min-width:250px;"> <?=  __('Proyecto_final_entrega_ejecutivo'); ?> </th>

        
                    <th><?php echo __('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
        <?php   if(!empty($projects)) {
                    
                    foreach($projects as $row) {
                        
                        echo "<tr>";
                            echo "<td>".h($row['proyecto_nombre'])."</td>";
                            echo "<td>".h($row['proyecto_ubicacion'])."</td>";
                            echo "<td>".$proyecto_tamano[$row['proyecto_tamano']]."</td>";
                            
                            echo "<td>".$proyecto_complejidad[$row['proyecto_complejidad']]."</td>";

                            echo "<td>".$this->Time->format($row['proyecto_inicio'], 'dd/MM/YYYY')."</td>";
                            echo "<td>".$this->Time->format($row['proyecto_final_entrega_ejecutivo'], 'dd/MM/YYYY')."</td>";
                            
                            
                            
                            echo "<td>";
                                echo "<div class='col-xs-12' style='text-align: center;'>";
                                    echo "<div class='btn-group'>";
                                        echo "<button class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' aria-expanded='false'>".__('Action')." <span class='caret'></span></button>";
                                        echo "<ul class='dropdown-menu pull-right'>";

                                            if($this->UserAuth->HP('Projects', 'edit')) {
                                                echo "<li>".$this->Html->link(__('Edit Project'), ['controller'=>'Projects', 'action'=>'edit', $row['id']], ['escape'=>false])."</li>";
                                            }
                                            if($this->UserAuth->HP('Projects', 'delete')) {
                                                echo "<li>".$this->Form->postLink(__('Delete Project'), ['controller'=>'Projects', 'action'=>'delete', $row['id']], ['escape'=>false, 'confirm'=>__('Are you sure you want to delete this project?')])."</li>";
                                            }
                                        echo "</ul>";
                                echo "</div>";
                                echo "</div>";
                            echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>".__('No Records Available')."</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td></tr>";
                } ?>
            </tbody>
        </table>
        
    </div>
</div>
<div id="updateUsersIndex">
    <?php echo $this->Search->searchForm('Clientes', ['legend'=>false, 'updateDivId'=>'updateUsersIndex']); ?>
    <?php //echo $this->element('Usermgmt.paginator', ['updateDivId'=>'updateUsersIndex']); ?>
    <table class="table table-striped table-bordered table-condensed table-hover">
     <!-- table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" -->
        <thead>
            <tr>
                <th><?php echo __d('usermgmt', '#'); ?></th>
                <th class=""><?php echo  __d('usermgmt', 'User Id'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Name'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Username'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Email'); ?></th>
                <th><?php echo __d('usermgmt', 'Groups(s)'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Email Verified'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Status'); ?></th>
                <th class=""><?php echo __d('usermgmt', 'Created'); ?></th>
                <th><?php echo __d('usermgmt', 'Action'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($clientes)) {
                $page = $this->request->params['paging']['Clientes']['page'];
                $limit = $this->request->params['paging']['Clientes']['perPage'];
                $i = ($page-1) * $limit;
                foreach($clientes as $row) {
                    //debug($row);
                    $i++;
                    echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".h($row['first_name']).' '.h($row['last_name'])."</td>";
                        echo "<td>".h($row['ciudad'])."</td>";
                        echo "<td>".h($row['email'])."</td>";
                        echo "<td>".$row['user_group_name']."</td>";
                        echo "<td>";
                            if($row['email_verified']) {
                                echo "<span class='label label-success'>".__d('usermgmt', 'Yes')."</span>";
                            } else {
                                echo "<span class='label label-danger'>".__d('usermgmt', 'No')."</span>";
                            }
                        echo"</td>";
                        echo "<td>";
                            if($row['active']) {
                                echo "<span class='label label-success'>".__d('usermgmt', 'Active')."</span>";
                            } else {
                                echo "<span class='label label-danger'>".__d('usermgmt', 'Inactive')."</span>";
                            }
                        echo"</td>";
                        echo "<td>".date('d-M-Y', strtotime($row['created']))."</td>";
                        echo "<td>";
                            echo "<div class='btn-group'>";
                                echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>".__d('usermgmt', 'Action')." <span class='caret'></span></button>";
                                echo "<ul class='dropdown-menu'>";
                                    echo "<li>".$this->Html->link(__d('usermgmt', 'View User'), ['controller'=>'Users', 'action'=>'viewUser', $row['id'], 'page'=>$page], ['escape'=>false])."</li>";
                                    echo "<li>".$this->Html->link(__d('usermgmt', 'Edit User'), ['controller'=>'Users', 'action'=>'editUser', $row['id'], 'page'=>$page], ['escape'=>false])."</li>";
                                    echo "<li>".$this->Html->link(__d('usermgmt', 'Change Password'), ['controller'=>'Users', 'action'=>'changeUserPassword', $row['id'], 'page'=>$page], ['escape'=>false])."</li>";
                                    if($row['id'] != 1 && strtolower($row['username']) != 'admin') {
                                        if($row['active']) {
                                            echo "<li>".$this->Form->postLink(__d('usermgmt', 'Inactivate'), ['controller'=>'Users', 'action'=>'setInactive', $row['id'], 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', 'Are you sure you want to inactivate this user?')])."</li>";
                                        } else {
                                            echo "<li>".$this->Form->postLink(__d('usermgmt', 'Activate'), ['controller'=>'Users', 'action'=>'setActive', $row['id'], 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', 'Are you sure you want to activate this user?')])."</li>";
                                        }
                                        if(!$row['email_verified']) {
                                            echo "<li>".$this->Form->postLink(__d('usermgmt', 'Verify Email'), ['action'=>'verifyEmail', $row['id'], 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', 'Are you sure you want to verify email of this user?')])."</li>";
                                        }
                                        echo "<li>".$this->Form->postLink(__d('usermgmt', 'Delete User'), ['controller'=>'Users', 'action'=>'deleteUser', $row['id'], 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', 'Are you sure you want to delete this user?')])."</li>";
                                    }
                                    echo "<li>".$this->Html->link(__d('usermgmt', 'View Permissions'), ['controller'=>'Users', 'action'=>'viewUserPermissions', $row['id'], 'page'=>$page], ['escape'=>false])."</li>";
                                    echo "<li>".$this->Html->link(__d('usermgmt', 'Send Mail'), ['controller'=>'UserEmails', 'action'=>'sendToUser', $row['id'], 'page'=>$page], ['escape'=>false])."</li>";
                                echo "</ul>";
                            echo "</div>";
                        echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=10><br/><br/>".__d('usermgmt', 'No Records Available')."</td></tr>";
            } ?>
        </tbody>
    </table>
    <?php if(!empty($users)) {
        echo $this->element('Usermgmt.pagination', ['paginationText'=>__d('usermgmt', 'Clientes')]);
    }?>
</div>
<!-- script type="text/javascript">
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

</script -->
<?php
/* Cakephp 3.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://cakephp3-user-management.ektanjali.com/
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT. */
?>
<div id="updateUsersIndex">
	<?php echo $this->Search->searchForm('Users', ['legend'=>false, 'updateDivId'=>'updateUsersIndex']); ?>
	<?php //echo $this->element('Usermgmt.paginator', ['updateDivId'=>'updateUsersIndex']); ?>
	<table class="table table-striped table-bordered table-condensed table-hover">
	 <!-- table ata-order='[[ 1, "asc" ]]' data-page-length='50' class="table table-striped table-bordered table-hover dataTables-example" -->
		<thead>
			<tr>
				<th><?php echo __d('usermgmt', '#'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Name'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Ciudad'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Email'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Teléfono'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Status'); ?></th>
                                <th class=""><?php echo __d('usermgmt', 'Puntos'); ?></th>
				<th class=""><?php echo __d('usermgmt', 'Created'); ?></th>
				<th><?php echo __d('usermgmt', 'Action'); ?></th>
			</tr>
		</thead>
		<tbody>
	<?php	if(!empty($users)) {
				$page = $this->request->params['paging']['Users']['page'];
				$limit = $this->request->params['paging']['Users']['perPage'];
				$i = ($page-1) * $limit;
				foreach($users as $row) {
					$i++;
					echo "<tr>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".h($row['first_name']).' '.h($row['last_name'])."</td>";
						echo "<td>".h($row['ciudad'])."</td>";
						echo "<td>".h($row['email'])."</td>";
						echo "<td>".$row['telefono_local']."</td>";
						echo "<td>";
							if($row['active']) {
								echo "<span class='label label-success'>".__d('usermgmt', 'Active')."</span>";
							} else {
								echo "<span class='label label-danger'>".__d('usermgmt', 'Inactive')."</span>";
							}
						echo"</td>";

                                                echo "<td>".$row['puntos']."</td>";
						
							if(!is_null($row['created'] ) )
						echo "<td>". $row['created'] -> i18nFormat('d-M-Y')."</td>";
						else
							echo "<td>". ""."</td>";

						
						echo "<td>";
							echo "<div class='btn-group'>";
								echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>".__d('usermgmt', 'Action')." <span class='caret'></span></button>";
								echo "<ul class='dropdown-menu'>";
									echo "<li>".$this->Html->link(__d('usermgmt', 'Ver Cliente'), ['controller'=>'Users', 'action'=>'viewUser', $row['id'],1, 'page'=>$page], ['escape'=>false])."</li>";
									echo "<li>".$this->Html->link(__d('usermgmt', 'Editar Cliente'), ['controller'=>'Users', 'action'=>'editUser', $row['id'],1, 'page'=>$page], ['escape'=>false])."</li>";
									echo "<li>".$this->Html->link(__d('usermgmt', 'Cambiar Password'), ['controller'=>'Users', 'action'=>'changeUserPassword', $row['id'],1, 'page'=>$page], ['escape'=>false])."</li>";
									if($row['id'] != 1 && strtolower($row['username']) != 'admin') {
										if($row['active']) {
											echo "<li>".$this->Form->postLink(__d('usermgmt', 'Inactivo'), ['controller'=>'Users', 'action'=>'setInactive', $row['id'],1, 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', '¿Esta seguro que desea desactivar este usuario?')])."</li>";
										} else {
											echo "<li>".$this->Form->postLink(__d('usermgmt', 'Activar'), ['controller'=>'Users', 'action'=>'setActive', $row['id'],1, 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', '¿Esta seguro que desea activar este usuario?')])."</li>";
										}
										if(!$row['email_verified']) {
											echo "<li>".$this->Form->postLink(__d('usermgmt', 'Verificar Email'), ['action'=>'verifyEmail', $row['id'],1, 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', '¿Esta seguro que quiere verificar este email?')])."</li>";
										}
										echo "<li>".$this->Form->postLink(__d('usermgmt', 'Eliminar Cliente'), ['controller'=>'Users', 'action'=>'deleteUser', $row['id'],1, 'page'=>$page], ['escape'=>false, 'confirm'=>__d('usermgmt', '¿Esta seguro que desea Eliminar este Cliente?')])."</li>";
									}
									#echo "<li>".$this->Html->link(__d('usermgmt', 'View Permissions'), ['controller'=>'Users', 'action'=>'viewUserPermissions', $row['id'],1, 'page'=>$page], ['escape'=>false])."</li>";
									#echo "<li>".$this->Html->link(__d('usermgmt', 'Send Mail'), ['controller'=>'UserEmails', 'action'=>'sendToUser', $row['id'],1, 'page'=>$page], ['escape'=>false])."</li>";
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
		echo $this->element('Usermgmt.pagination', ['paginationText'=>__d('usermgmt', '')]);
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
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
<script type="text/javascript">
	$(function(){
		$('.contcheckall').change(function() {
			if($(this).is(':checked')) {
				$(".contcheck").prop("checked", true);
			} else {
				$(".contcheck").prop("checked", false);
			}
		});
		$('.grpcheckall').change(function() {
			if($(this).is(':checked')) {
				$(".grpcheck").prop("checked", true);
			} else {
				$(".grpcheck").prop("checked", false);
			}
		});
		$('#perOptions').click(function() {
			$('#perOptionsDetails').slideToggle();
		});
	});
	function validateForm() {
		if(!$(".contcheck").is(':checked')) {
			alert('Please select atleast one controller to get permissions');
			return false;
		} else {
		}
		return true;
	}
</script>
<style type="text/css">
	.input.checkbox {
		margin:0;
	}
	.input.checkbox input {
		margin:0;
		position:relative;
	}
</style>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Parent Group Permissions Matrix') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo "<a id='perOptions' href='javascript:void(0)'>Choose Options</a>"; ?>
		</span>
		<span class="um-panel-title-right">
			<div id='per_loading_text' style='color:red;text-decoration: blink;'>Please wait while page is loading...</div>
		</span>
	</div>
	<div class="um-panel-content">
		<div style='padding:10px'>
			<?php echo $this->Html->image(SITE_URL.'usermgmt/img/approve.png', ['alt'=>__('Yes')]); ?> = <?php echo __("The group has permission of controller's action");?><br/><?php echo $this->Html->image(SITE_URL.'usermgmt/img/remove.png', ['alt'=>__('No')]); ?> = <?php echo __("The group has not permission of controller's action");?><br/>
		</div>
		<div style="padding:10px; display:<?php if(!empty($selectedControllers)) { echo 'none'; } ?>" id="perOptionsDetails">
			<?php echo $this->Form->create($userGroupPermissionEntity, ['onSubmit'=>'return validateForm()']); ?>
			<div style="float:left">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th><?php
								$checked = false;
								if(!empty($userGroupPermissionEntity['sel_cont_all'])) {
									$checked = true;
								}
								echo $this->Form->input('UserGroupPermissions.sel_cont_all' ,['type'=>'checkbox', 'div'=>false, 'label'=>false, 'checked'=>false, 'class'=>'contcheckall']); ?>
							</th>
							<th><?php echo __('Plugin'); ?></th>
							<th><?php echo __('Controller'); ?></th>
						</tr>
					</thead>
					<tbody>
				<?php	if(!empty($allControllers)) {
							foreach($allControllers as $key=>$controller) {
								$checked = false;
								if(!empty($selectedControllers[$controller])) {
									$checked = true;
								}
								echo "<tr>";
									echo "<td>";
										echo $this->Form->input('UserGroupPermissions.ControllerList.'.$key.'.name', ['type'=>'checkbox', 'div'=>false, 'label'=>false, 'hiddenField'=>false, 'checked'=>$checked, 'class'=>'contcheck', 'value'=>$controller]);
									echo "</td>";
									echo "<td>";
										if(strpos($controller, '.') !== false) {
											list($plugin, $controllerName) = explode('.', $controller);
											echo $plugin;
										} else {
											$controllerName = $controller;
										}
									echo "</td>";
									echo "<td>".$controllerName."</td>";
								echo "</tr>";
							}
						} ?>
					</tbody>
				</table>
			</div>
			<div style="float:left">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th><?php
								$checked = false;
								if(!empty($userGroupPermissionEntity['sel_grp_all'])) {
									$checked = true;
								}
								echo $this->Form->input('UserGroupPermissions.sel_grp_all', ['type'=>'checkbox', 'div'=>false, 'label'=>false, 'checked'=>$checked, 'class'=>'grpcheckall']); ?>
							</th>
							<th><?php echo __('Group');?></th>
						</tr>
					</thead>
					<tbody>
				<?php	if(!empty($userGroups)) {
							foreach($userGroups as $group) {
								$checked = false;
								if(!empty($selectedUserGroupIds[$group['id']])) {
									$checked = true;
								}
								echo "<tr>";
									echo "<td>";
										echo $this->Form->input('UserGroupPermissions.GroupList.'.$group['id'].'.grpcheck', ['type'=>'checkbox', 'div'=>false, 'label'=>false, 'hiddenField'=>false, 'checked'=>$checked, 'class'=>'grpcheck']);
									echo "</td>";
									echo "<td>".$group['name']."</td>";
								echo "</tr>";
							}
						} ?>
					</tbody>
				</table>
			</div>
			<div style="float:left">
				<?php echo $this->Form->Submit(__('Get Permissions'), ['class'=>'btn btn-primary']); ?>
			</div>
			<div class="clearfix"></div>
			<?php echo $this->Form->end(); ?>
		</div>
<?php	if(!empty($selectedControllers)) { ?>
			<table class="table table-striped table-bordered table-condensed table-hover groupMatrix" style='width:auto'>
				<thead>
					<tr id='per_float_header' style='background-color:#CACACA'>
						<th><div style='width:100px'><?php echo __('Plugin');?></div></th>
						<th><div style='width:100px'><?php echo __('Controller');?></div></th>
						<th><div style='width:130px'><?php echo __('Action');?></div></th>
						<?php foreach($selectedUserGroups as $group) {
							echo "<th style='padding:0;text-align:center;'><div class='break-word' style='width:65px'>".$group['name']."</div></th>";
						} ?>
					</tr>
				</thead>
				<tbody>
			<?php	foreach($selectedControllers as $cont=>$actions) {
						if(strpos($cont, '.') !== false) {
							list($plugin, $controller) = explode('.', $cont);
							$idx = $plugin.'.'.$controller;
						} else {
							$plugin = null;
							$controller = $cont;
							$idx = $controller;
						}
						foreach($actions as $action) {
							echo "<tr>";
								echo "<td><div class='break-word' style='width:100px'>".$plugin."</div></td>";
								echo "<td><div class='break-word' style='width:100px'>".$controller."</div></td>";
								echo "<td><div class='break-word' style='width:130px'>".$action;
								if(!empty($funcDesc[$plugin][$controller][$action])) {
									echo "<br/><span style='color:red;font-size:10px;font-style:italic'>".$funcDesc[$plugin][$controller][$action]."</span>";
								}
								echo "</div></td>";
								foreach($selectedUserGroups as $group) {
									echo "<td style='text-align:center;padding:5px' class='permission'><div style='width:55px;height:20px'>";
										if(isset($dbPermissions[$idx.'.'.$action][$group['id']]) && $dbPermissions[$idx.'.'.$action][$group['id']] == 1) {
											echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/approve.png', ['alt'=>__('Yes')]), ['action'=>'changePermission', $controller, $action, $group['id'], $plugin], ['escape'=>false, 'class'=>'changePermission', 'title'=>$group['name'].' (Click to change permission)']);
										} else {
											echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/remove.png', ['alt'=>__('No')]), ['action'=>'changePermission', $controller, $action, $group['id'], $plugin], ['escape'=>false, 'class'=>'changePermission', 'title'=>$group['name'].' (Click to change permission)']);
										}
									echo "</div></td>";
								}
							echo "</tr>";
						}
						if(!empty($actions)) {
							echo "<tr><td colspan='".(count($selectedUserGroups) + 3)."'><br/></td></tr>";
						}
					} ?>
				</tbody>
			</table>
		<?php } ?>
	</div>
</div>
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
<?php
namespace Usermgmt\Controller;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;
use Cake\Core\Configure;

class UserGroupPermissionsController extends UsermgmtAppController {
	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	var $components = ['Usermgmt.ControllerList'];
	/**
	 * Called before the controller action. You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		if(isset($this->Security) && ($this->request->is('ajax') || $this->request['action'] == 'permissionGroupMatrix' || $this->request['action'] == 'permissionSubGroupMatrix')) {
			$this->Security->config('unlockedActions', [$this->request['action']]);
		}
	}
	/**
	 * It displays all parent group permissions with controller and action names in matrix view
	 *
	 * @access public
	 * @return void
	 */
	public function permissionGroupMatrix() {
		$userGroupPermissionEntity = $this->UserGroupPermissions->newEntity($this->request->data);
		$allControllers = $this->ControllerList->getControllerClasses();
		$this->loadModel('Usermgmt.UserGroups');
		$userGroups = $this->UserGroups->getParentGroupDetails();
		$selectedControllers = $selectedUserGroups = $dbPermissions = $selectedUserGroupIds = [];
		if($this->request->is('post')) {
			if(!empty($userGroupPermissionEntity['ControllerList'])) {
				$controllersList = $this->ControllerList->getControllerAndActions();
				$cond = $controllerNames = [];
				foreach($userGroupPermissionEntity['ControllerList'] as $key=>$val) {
					if($val['name']) {
						$selectedControllers[$val['name']] = (isset($controllersList[$val['name']])) ? $controllersList[$val['name']] : [];
						if(strpos($val['name'], '.') !== false) {
							list(, $controllerNames[$key]) = explode('.', $val['name']);
						} else {
							$controllerNames[$key] = $val['name'];
						}
					}
				}
				$cond['UserGroupPermissions.controller IN'] = $controllerNames;
				if(!empty($userGroupPermissionEntity['GroupList'])) {
					foreach($userGroupPermissionEntity['GroupList'] as $key=>$val) {
						if($val['grpcheck']) {
							$selectedUserGroupIds[$key] = $key;
						}
					}
					foreach($userGroups as $userGroup) {
						if(in_array($userGroup['id'], $selectedUserGroupIds)) {
							$selectedUserGroups[] = $userGroup;
						}
					}
				} else {
					foreach($userGroups as $userGroup) {
						$selectedUserGroupIds[$userGroup['id']] = $userGroup['id'];
						$selectedUserGroups[] = $userGroup;
					}
				}
				$cond['UserGroupPermissions.user_group_id IN'] = $selectedUserGroupIds;
				$userGroupPermissions = $this->UserGroupPermissions->find()->where($cond)->order(['UserGroupPermissions.plugin'=>'ASC', 'UserGroupPermissions.controller'=>'ASC', 'UserGroupPermissions.action'=>'ASC'])->hydrate(false)->toArray();
				foreach($userGroupPermissions as $row) {
					$idx = $row['controller'].'.'.$row['action'];
					if($row['plugin']) {
						$idx = $row['plugin'].'.'.$idx;
					}
					$dbPermissions[$idx][$row['user_group_id']] = $row['allowed'];
				}
			}
		}
		$funcDesc = $this->getFunctionDesc($selectedControllers);
		$this->set(compact('userGroupPermissionEntity', 'allControllers', 'userGroups', 'selectedControllers', 'selectedUserGroupIds', 'selectedUserGroups', 'funcDesc', 'dbPermissions'));
	}
	/**
	 * It displays all sub group permissions with controller and action names in matrix view
	 *
	 * @access public
	 * @return void
	 */
	public function permissionSubGroupMatrix() {
		$userGroupPermissionEntity = $this->UserGroupPermissions->newEntity($this->request->data);
		$allControllers = $this->ControllerList->getControllerClasses();
		$this->loadModel('Usermgmt.UserGroups');
		$userGroups = $this->UserGroups->getSubGroupDetails();
		$selectedControllers = $selectedUserGroups = $dbPermissions = $selectedUserGroupIds = $parentUserGroupIds = $parentPermissions = [];
		if($this->request->is('post')) {
			if(!empty($userGroupPermissionEntity['ControllerList'])) {
				$controllersList = $this->ControllerList->getControllerAndActions();
				$cond = $controllerNames = [];
				foreach($userGroupPermissionEntity['ControllerList'] as $key=>$val) {
					if($val['name']) {
						$selectedControllers[$val['name']] = (isset($controllersList[$val['name']])) ? $controllersList[$val['name']] : [];
						if(strpos($val['name'], '.') !== false) {
							list(, $controllerNames[$key]) = explode('.', $val['name']);
						} else {
							$controllerNames[$key] = $val['name'];
						}
					}
				}
				$cond['UserGroupPermissions.controller IN'] = $controllerNames;
				if(!empty($userGroupPermissionEntity['GroupList'])) {
					foreach($userGroupPermissionEntity['GroupList'] as $key=>$val) {
						if($val['grpcheck']) {
							$selectedUserGroupIds[$key] = $key;
						}
					}
					foreach($userGroups as $userGroup) {
						if(in_array($userGroup['id'], $selectedUserGroupIds)) {
							$selectedUserGroups[] = $userGroup;
						}
					}
				} else {
					foreach($userGroups as $userGroup) {
						$selectedUserGroupIds[$userGroup['id']] = $userGroup['id'];
						$selectedUserGroups[] = $userGroup;
					}
				}
				$cond['UserGroupPermissions.user_group_id IN'] = $selectedUserGroupIds;
				$userGroupPermissions = $this->UserGroupPermissions->find()->where($cond)->order(['UserGroupPermissions.plugin'=>'ASC', 'UserGroupPermissions.controller'=>'ASC', 'UserGroupPermissions.action'=>'ASC'])->hydrate(false)->toArray();
				foreach($userGroupPermissions as $row) {
					$idx = $row['controller'].'.'.$row['action'];
					if($row['plugin']) {
						$idx = $row['plugin'].'.'.$idx;
					}
					$dbPermissions[$idx][$row['user_group_id']] = $row['allowed'];
				}

				$parentUserGroupIds = $this->UserGroups->getParentGroupIds($selectedUserGroupIds);
				$parentResult = $this->UserGroupPermissions->find()->where(['UserGroupPermissions.controller IN'=>$controllerNames, 'UserGroupPermissions.user_group_id IN'=>$parentUserGroupIds, 'allowed'=>1])->order(['UserGroupPermissions.plugin'=>'ASC', 'UserGroupPermissions.controller'=>'ASC', 'UserGroupPermissions.action'=>'ASC'])->hydrate(false)->toArray();
				foreach($parentResult as $row) {
					$idx = $row['controller'].'.'.$row['action'];
					if($row['plugin']) {
						$idx = $row['plugin'].'.'.$idx;
					}
					$parentPermissions[$idx][$row['user_group_id']] = $row['allowed'];
				}
			}
		}
		$funcDesc = $this->getFunctionDesc($selectedControllers);
		$this->set(compact('userGroupPermissionEntity', 'allControllers', 'userGroups', 'selectedControllers', 'selectedUserGroupIds', 'selectedUserGroups', 'funcDesc', 'dbPermissions', 'parentPermissions'));
	}
	/**
	 * It is used to change permission from matrix chart by ajax
	 *
	 * @access public
	 * @return void
	 */
	public function changePermission($controller=null, $action=null, $userGroupId=null, $plugin=null) {
		if(empty($plugin)) {
			$plugin = null;
		}
		if($controller && $action && $userGroupId) {
			if($this->request->is('post')) {
				$this->loadModel('Usermgmt.UserGroups');
				$userGroup = $this->UserGroups->find()->where(['UserGroups.id'=>$userGroupId])->hydrate(false)->first();
				if(!empty($userGroup)) {
					if(empty($plugin)) {
						$userGroupPermission = $this->UserGroupPermissions->find()->where(['UserGroupPermissions.plugin is NULL', 'UserGroupPermissions.controller'=>$controller, 'UserGroupPermissions.action'=>$action, 'UserGroupPermissions.user_group_id'=>$userGroupId])->first();
					} else {
						$userGroupPermission = $this->UserGroupPermissions->find()->where(['UserGroupPermissions.plugin'=>$plugin, 'UserGroupPermissions.controller'=>$controller, 'UserGroupPermissions.action'=>$action, 'UserGroupPermissions.user_group_id'=>$userGroupId])->first();
					}
					$parentUserGroupPermission = [];
					if($userGroup['parent_id']) {
						if(empty($plugin)) {
							$parentUserGroupPermission = $this->UserGroupPermissions->find()->where(['UserGroupPermissions.plugin IS NULL', 'UserGroupPermissions.controller'=>$controller, 'UserGroupPermissions.action'=>$action, 'UserGroupPermissions.user_group_id'=>$userGroup['parent_id']])->hydrate(false)->first();
						} else {
							$parentUserGroupPermission = $this->UserGroupPermissions->find()->where(['UserGroupPermissions.plugin'=>$plugin, 'UserGroupPermissions.controller'=>$controller, 'UserGroupPermissions.action'=>$action, 'UserGroupPermissions.user_group_id'=>$userGroup['parent_id']])->hydrate(false)->first();
						}
					}
					$allowed = 1;
					$save = false;
					if($userGroup['parent_id']) {
						if(empty($userGroupPermission)) {
							if(!empty($parentUserGroupPermission['allowed'])) {
								$allowed = 0;
							}
							$save = true;
						} else {
							if(!empty($parentUserGroupPermission)) {
								if($parentUserGroupPermission['allowed'] != $userGroupPermission['allowed']) {
									$this->UserGroupPermissions->delete($userGroupPermission);
								} else {
									if($userGroupPermission['allowed']) {
										$allowed = 0;
									}
									$save = true;
								}
							} else {
								if($userGroupPermission['allowed']) {
									$allowed = 0;
								}
								$save = true;
							}
						}
					} else {
						if(!empty($userGroupPermission['allowed'])) {
							$allowed = 0;
						}
						$save = true;
					}
					if($save) {
						$userGroupPermissionEntity = $this->UserGroupPermissions->newEntity();
						if(!empty($userGroupPermission)) {
							$userGroupPermissionEntity['id'] = $userGroupPermission['id'];
						}
						$userGroupPermissionEntity['user_group_id'] = $userGroupId;
						$userGroupPermissionEntity['plugin'] = $plugin;
						$userGroupPermissionEntity['controller'] = $controller;
						$userGroupPermissionEntity['action'] = $action;
						$userGroupPermissionEntity['allowed'] = $allowed;
						$this->UserGroupPermissions->save($userGroupPermissionEntity, ['validate'=>false]);
					}
					$this->__deleteCache();
					if($this->request->is('ajax')) {
						if($allowed) {
							echo '<img alt="Yes" src="'.SITE_URL.'usermgmt/img/approve.png">';
						} else {
							echo '<img alt="No" src="'.SITE_URL.'usermgmt/img/remove.png">';
						}
					}
				}
			}
		}
		exit;
	}
	/**
	 *  It is used to get permissions of logged in user or a guest in view helper
	 *
	 * @access public
	 * @return void
	 */
	public function getPermissions() {
		$this->loadModel('Usermgmt.UserGroups');
		if($this->UserAuth->isLogged()) {
			$permissions = $this->UserGroups->getPermissions($this->UserAuth->getGroupId());
		} else {
			$permissions = $this->UserGroups->getPermissions(GUEST_GROUP_ID);
		}
		$this->response->body($permissions);
		return $this->response;
	}
	/**
	 * It is used to delete cache of permissions and used when any permission gets changed by Admin
	 *
	 * @access private
	 * @return void
	 */
	private function __deleteCache() {
		$iterator = new \RecursiveDirectoryIterator(CACHE);
		foreach(new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST) as $file) {
			$path_info = pathinfo($file);
			if(!in_array($path_info['basename'], ['.svn', '.', '..'])) {
				if($path_info['dirname'] == TMP.'cache') {
					if(!is_dir($file->getPathname()) && strpos($path_info['basename'], 'UserMgmt_rules_for_group') !== false) {
						@unlink($file->getPathname());
					}
				}
			}
		}
	}
	/**
	 * It is used to get controller's action comment
	 *
	 * @access private
	 * @return void
	 */
	private function getFunctionDesc($controllers) {
		$funcDesc = [];
		if(!empty($controllers)) {
			require_once(USERMGMT_PATH.DS.'vendor'.DS.'DocBlock.php');
			foreach($controllers as $controller=>$actions) {
				if(strpos($controller, '.') !== false) {
					list($plugin, $controllerName) = explode('.', $controller);
				} else {
					$plugin = null;
					$controllerName = $controller;
				}
				if(empty($plugin)) {
					$base = Configure::read('App.namespace');
					$controllerClass = $base.'\Controller\\'.$controllerName.'Controller';
				} else {
					$controllerClass = $plugin.'\Controller\\'.$controllerName.'Controller';
				}
				foreach($actions as $action) {
					$reference = new \ReflectionMethod($controllerClass, $action);
					$docCmnt = new \DocBlock($reference->getDocComment());
					$funcDesc[$plugin][$controllerName][$action] = $docCmnt->desc;
				}
			}
		}
		return $funcDesc;
	}
}
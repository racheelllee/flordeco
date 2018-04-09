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
use Cake\Utility\Inflector;
$actionUrl = Inflector::camelize($this->request['controller']).'/'.$this->request['action'];
$activeClass = 'active';
$inactiveClass = '';
?>
<!-- <div class="dashboard-menu">
	<div class="navbar navbar-default um-navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<?php echo $this->Html->link(__d('usermgmt','Dashboard'), ['controller'=>'Users', 'action'=>'dashboard', 'plugin'=>'Usermgmt'], ['class'=>'navbar-brand']);?>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class='nav navbar-nav'> -->
		<?php	if($this->UserAuth->isLogged()) {
					if($this->UserAuth->isAdmin()) {
						echo "<li >";
							echo $this->Html->link('<i class="fa fa-user"></i>'.__d('usermgmt','Users').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
							echo "<ul class='nav nav-second-level'>";
								if($this->UserAuth->HP('Users', 'addUser', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='Users/addUser') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Add User'), ['controller'=>'Users', 'action'=>'addUser', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('Users', 'addMultipleUsers', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='Users/addMultipleUsers') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Add Multiple Users'), ['controller'=>'Users', 'action'=>'addMultipleUsers', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('Users', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='Users/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','All Users'), ['controller'=>'Users', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('Users', 'online', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='Users/online') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Online Users'), ['controller'=>'Users', 'action'=>'online', 'plugin'=>'Usermgmt'])."</li>";
								}
							echo "</ul>";
						echo "</li>";
						echo "<li >";
							echo $this->Html->link('<i class="fa fa-group"></i>'.__d('usermgmt','Groups').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
							echo "<ul class='nav nav-second-level'>";
								if($this->UserAuth->HP('UserGroups', 'add', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserGroups/add') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Add Group'), ['controller'=>'UserGroups', 'action'=>'add', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserGroups', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserGroups/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','All Groups'), ['controller'=>'UserGroups', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
							echo "</ul>";
						echo "</li>";
						echo "<li >";
							echo $this->Html->link('<i class="fa fa-th-large"></i>'.__d('usermgmt','Admin').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
							echo "<ul class='nav nav-second-level'>";
								if($this->UserAuth->HP('UserGroupPermissions', 'permissionGroupMatrix', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserGroupPermissions/permissionGroupMatrix') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Group Permissions'), ['controller'=>'UserGroupPermissions', 'action'=>'permissionGroupMatrix', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserGroupPermissions', 'permissionSubGroupMatrix', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserGroupPermissions/permissionSubGroupMatrix') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Subgroup Permissions'), ['controller'=>'UserGroupPermissions', 'action'=>'permissionSubGroupMatrix', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserSettings', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserSettings/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','All Settings'), ['controller'=>'UserSettings', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserSettings', 'cakelog', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserSettings/cakelog') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Cake Logs'), ['controller'=>'UserSettings', 'action'=>'cakelog', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('Users', 'deleteCache', 'Usermgmt')) {
									echo "<li>".$this->Html->link(__d('usermgmt','Delete Cache'), ['controller'=>'Users', 'action'=>'deleteCache', 'plugin'=>'Usermgmt'])."</li>";
								}
							echo "</ul>";
						echo "</li>";
						echo "<li >";
							echo $this->Html->link('<i class="fa fa-envelope"></i>'.__d('usermgmt','Email').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
							echo "<ul class='nav nav-second-level'>";
								if($this->UserAuth->HP('UserEmails', 'send', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserEmails/send') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Send Email'), ['controller'=>'UserEmails', 'action'=>'send', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserEmails', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','View Sent Emails'), ['controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserContacts', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserContacts/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Contact Enquiries'), ['controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserEmailTemplates', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserEmailTemplates/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Email Templates'), ['controller'=>'UserEmailTemplates', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('UserEmailSignatures', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='UserEmailSignatures/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Email Signatures'), ['controller'=>'UserEmailSignatures', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
							echo "</ul>";
						echo "</li>";
						echo "<li >";
							echo $this->Html->link('<i class="fa fa-files-o"></i>'.__d('usermgmt','Pages').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
							echo "<ul class='nav nav-second-level'>";
								if($this->UserAuth->HP('StaticPages', 'add', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='StaticPages/add') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Add Page'), ['controller'=>'StaticPages', 'action'=>'add', 'plugin'=>'Usermgmt'])."</li>";
								}
								if($this->UserAuth->HP('StaticPages', 'index', 'Usermgmt')) {
									echo "<li class='".(($actionUrl=='StaticPages/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','All Pages'), ['controller'=>'StaticPages', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
								}
							echo "</ul>";
						echo "</li>";
					}
					// echo "<li >";
					
					// 	echo $this->Html->link('<i class="fa fa-edit"></i>'.__d('usermgmt','My Account').' <span class="fa arrow"></span>', '#', ['escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']);
					// 	echo "<ul class='nav nav-second-level'>";
					// 		if($this->UserAuth->HP('Users', 'myprofile', 'Usermgmt')) {
					// 			echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','My Profile'), ['controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'Usermgmt'])."</li>";
					// 		}
					// 		if($this->UserAuth->HP('Users', 'editProfile', 'Usermgmt')) {
					// 			echo "<li class='".(($actionUrl=='Users/editProfile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Edit Profile'), ['controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'Usermgmt'])."</li>";
					// 		}
					// 		if($this->UserAuth->HP('Users', 'changePassword', 'Usermgmt')) {
					// 			echo "<li class='".(($actionUrl=='Users/changePassword') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Change Password'), ['controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'Usermgmt'])."</li>";
					// 		}
					// 		if($this->UserAuth->HP('Users', 'deleteAccount', 'Usermgmt') && ALLOW_DELETE_ACCOUNT && !$this->UserAuth->isAdmin()) {
					// 			echo "<li>".$this->Form->postlink(__d('usermgmt','Delete Account'), ['controller'=>'Users', 'action'=>'deleteAccount', 'plugin'=>'Usermgmt'], ['escape'=>false, 'confirm'=>__d('usermgmt','Are you sure you want to delete your account?')])."</li>";
					// 		}
					// 	echo "</ul>";
					// echo "</li>";
				}
				/*
				echo "<li class='".(($actionUrl=='UserContacts/contactUs') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt',"Contact Us"), '/contactUs')."</li>";
				
				if($this->UserAuth->isLogged()) {
					echo "<li>".$this->Html->link('<i class="fa fa-group"></i>'.__d('usermgmt','Sign Out'), ['controller'=>'Users', 'action'=>'logout', 'plugin'=>'Usermgmt'],['escape'=>false])."</li>";
				} else {
					echo "<li class='".(($actionUrl=='Users/login') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__d('usermgmt','Sign In'), ['controller'=>'Users', 'action'=>'login', 'plugin'=>'Usermgmt'])."</li>";
				} 
				*/
				?>
				<!-- </ul>
			</div>
		</div>
	</div>
</div> -->
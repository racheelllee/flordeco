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
namespace Usermgmt\Controller\Component;
use Cake\Controller\Component;
use Cake\Core\App;
use Cake\Core\Plugin;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;

class ControllerListComponent extends Component {
	/**
	 * Used to get all controllers with all methods for permissions
	 *
	 * @access public
	 * @return array
	 */
	public function getControllerAndActions() {
		$controllerClasses = $this->getControllerClasses();
		$controllersList = [];
		$coreControllerClassName = 'Cake\Controller\Controller';
		$coreControllerMethods = $this->getClassPublicMethods($coreControllerClassName);
		foreach($controllerClasses as $controller) {
			if(strpos($controller, '.') !== false) {
				list($plugin, $controllerName) = explode('.', $controller);
			} else {
				$plugin = null;
				$controllerName = $controller;
			}
			$controllerMethods = $this->__getControllerMethods($controllerName, $plugin);
			$methods = array_diff($controllerMethods, $coreControllerMethods);
			if(!empty($methods)) {
				$controllersList[$controller] = $methods;
			}
		}
		return $controllersList;
	}
	private function __getControllerMethods($controllerName, $plugin=null) {
		$methods = [];
		if(empty($plugin)) {
			$base = Configure::read('App.namespace');
			$controllerClassName = $base.'\Controller\\'.$controllerName.'Controller';
		} else {
			$controllerClassName = $plugin.'\Controller\\'.$controllerName.'Controller';
		}
		$methods = $this->getClassPublicMethods($controllerClassName);
		return $methods;
	}
	private function getClassPublicMethods($className) {
		$class = new \ReflectionClass($className);
		$methods = [];
		foreach($class->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
			if($method->class == $className) {
				$methods[] = $method->name;
			}
		}
		return $methods;
	}
	/**
	 *  Used to get controller classes list
	 *
	 * @access public
	 * @return array
	 */
	public function getControllerClasses() {
		$path = App::path('Controller');
		$dir = new Folder($path[0]);
		$controllers = $dir->findRecursive('.*Controller\.php');
		$controllerClasses = [];
		foreach($controllers as $controller) {
			$tmp = pathinfo($controller);
			$controllerClasses[] = str_replace('Controller.php', '', $tmp['basename']);
		}
		$plugins = Plugin::loaded();
		foreach($plugins as $plugin) {
			$path = App::path('Controller', $plugin);
			$dir = new Folder($path[0]);
			$controllers = $dir->findRecursive('.*Controller\.php');
			foreach($controllers as $controller) {
				$tmp = pathinfo($controller);
				$controllerClasses[] = $plugin.'.'.str_replace('Controller.php', '', $tmp['basename']);
			}
		}
		return $controllerClasses;
	}
}
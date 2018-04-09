<?php 
	/* Modelo dummy para mantener consistencia en español :( */
?>
<?php
namespace App\Model\Table;

use App\Model\Entity\Mensaje;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsuariosTable extends Table {

	public function initialize(array $config) {
		$this->table('users');
	}
	
}
<?php
class FbRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper {
	var $sessionHandler = null;

	protected function storeState($state) {
		$this->sessionHandler->write('state', $state);
	}
	protected function loadState() {
		return $this->state = $this->sessionHandler->read('state');
	}
}
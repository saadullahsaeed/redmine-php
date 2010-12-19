<?php
class AccountController extends AppController {
	var $name = 'Account';
	
	var $uses = array('Token', 'User');
	
	function login() {
		if (empty($this->data['User']['password'])) {
			$this->logout_user();
		} else {
			$this->authenticate_user();
		}
	}
	
	function logout_user() {
            $current_user = $this->User->current();
      		if ($current_user['User']['logged']) {
      		    $this->Token->deleteAll(array('Token.user_id' => $current_user['User']['id'], 'Token.action' => 'autologin'));
      		    $this->logged_user(null);
      	    }
	}
	
	function authenticate_user() {
		$this->password_authentication();
	}
	
	function password_authentication() {
		$user = $this->User->try_to_login($this->data['User']['username'], $this->data['User']['password']);
		
		if (empty($user)) {
			$this->invalid_credentials();
		} else {
			$this->successful_authentication($user);
		}
	}
	
	function invalid_credentials() {
		$this->Session->setFlash(__("Failed login for", true)." '".$this->data['User']['username']."'", 'default', array('class' => 'flash error'));
	}
	
	function successful_authentication($user) {
		 $this->logged_user($user);
	}
}
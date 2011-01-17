<?php
class AccountController extends AppController {
	var $name = 'Account';
	
	var $uses = array('Token', 'User');
	
	function beforeFilter() {
		$this->Auth->allow('register');
	}
	
	function login() {
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }
}
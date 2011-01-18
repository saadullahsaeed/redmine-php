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
	
	function register() {
		if (empty($this->data)) {
			$this->data['User']['language'] = $this->Setting->value('default_language');
		} else {
			$this->data['User']['admin'] = false;
			$this->data['User']['status'] = User::STATUS_REGISTERED;
			
			switch ($this->Setting->value('self_registration')) {
				case 1:
					$this->register_by_email_activation($this->data);
					break;
				case 3:
					$this->register_automatically($this->data);
					break;
				default:
					$this->register_manually_by_administrator($this->data);
					break;
			}
		}
    }
	
	function register_automatically($data) {
		$data['User']['status'] = User::STATUS_ACTIVE;
		$data['User']['last_login_on'] = date('Y-m-d H:i:s');
		if ($this->User->save($data)) {
			$this->Session->setFlash(__('Your account has been activated. You can now log in.', true));
			$this->redirect(array('controller' => 'account', 'action' => 'login'));
		}
	}
}
<?php
class UsersController extends AppController {
	var $name = 'Users';
	
	var $helpers = array('Users');
	
	var $uses = array('User');
	
	function show($id) {
		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
		$this->set('user', $user);
	}
}
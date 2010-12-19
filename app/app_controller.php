<?php
class AppController extends Controller {
	var $helpers = array('Javascript', 'Html', 'Form', 'Session');
	
	var $uses = array('User');
	
	function logged_user($user) {
		if (!empty($user)) {
			$this->User->current_user = $user;
			$this->Session->write('user_id', $user['User']['id']);
		} else {
			$this->User->current_user = $this->User->anonymous();
		}
	}
}
<?php
class User extends AppModel {
    var $name = 'User';
	
	var $current_user;
	
	# Account statuses
 	var $STATUS_ANONYMOUS = 0;
  	var $STATUS_ACTIVE = 1;
  	var $STATUS_REGISTERED = 2;
  	var $STATUS_LOCKED = 3;
	
	function current() {
		if (empty($this->$current_user)) {
			$this->current_user = $this->anonymous();
		} else if ($anonymous_user['User']['lastname'] != 'Anonymous') {
			$this->current_user['User']['logged'] = true;
		}
		return $this->current_user;
	}
	
  	/**
  	 * Returns the anonymous user. If the anonymous user does not exist, it is created. There can be only one anonymous user per database.
  	 */
  	function anonymous() {
		$anonymous_user = $this->findByLastname('Anonymous');
		if (empty($anonymous_user)) {
			$anonymous_user['User']['lastname'] = 'Anonymous';
			$anonymous_user['User']['firstname'] = '';
			$anonymous_user['User']['mail'] = '';
			$anonymous_user['User']['login'] = '';
			$anonymous_user['User']['status'] = 0;
			if(!$this->save($anonymous_user)) {
				// TODO 'Unable to create the anonymous user.'
			}
		}
		$anonymous_user['User']['logged'] = false;
		return $anonymous_user;
	}
	
	function logged() {
		return $this->current_user['User']['logged'];
	}
	
	function try_to_login($login, $password) {
		if (empty($password)) return null;
		
		$user = $this->findByLogin($login);
		
		if (!empty($user)) {
			if ($user['User']['status'] != $STATUS_ACTIVE) return null;
		}
	}
	
	function hash_password($clear_password) {
		//TODO return Digest::SHA1.hexdigest(clear_password || "");
	}
}
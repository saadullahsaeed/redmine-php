<?php
class User extends AppModel {
    var $name = 'User';
	
 	const STATUS_ANONYMOUS = 0;
  	const STATUS_ACTIVE = 1;
  	const STATUS_REGISTERED = 2;
  	const STATUS_LOCKED = 3;
	
	var $hasMany = array('Member');    
	
	var $validate = array(
        'login' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'This field is invalid'
			),			
			'login' => array(
				'rule' => '/^[a-z0-9_\-@\.]*$/i',				
				'message' => 'This field is invalid'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Value has already been taken'
			),
			'lenght' => array(
				'rule' => array('maxLength', 30),
				'message' => 'This field is too long'
			)
        ),
		'password' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'This field is invalid'
			),
			'identicalFieldValues' => array( 
				'rule' => array('identicalFieldValues', 'password_confirmation'), 
				'message' => "Password doesn't match confirmation." 
			) 
        ),
		'password_confirmation' => array(
			'rule' => 'alphaNumeric',
			'required' => true
        ),
		'firstname' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'This field is invalid'
			),
			'lenght' => array(
				'rule' => array('maxLength', 30),
				'message' => 'This field is too long'
			)
        ),
		'lastname' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'This field is invalid'
			),
			'lenght' => array(
				'rule' => array('maxLength', 30),
				'message' => 'This field is too long'
			)
        ),
        'mail' => array(
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'This field is invalid'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Value has already been taken'
			),
			'lenght' => array(
				'rule' => array('maxLength', 60),
				'message' => 'This field is too long'
			)
        )
    );
	
	function member_of($user, $project) {
		$members = $this->Member->find('first', array('conditions' => array('Member.user_id' => $user['User']['id'], 'Member.project_id' => $project['Project']['id'])));
		return !empty($members);
	}
	
	/*
	var $current_user;
	
	# Account statuses

        const HASH_TYPE = 'sha1';
	
	function current() {
		if (empty($this->current_user)) {
			$this->current_user = $this->anonymous();
		} else if ($anonymous_user['User']['lastname'] != 'Anonymous') {
			$this->current_user['User']['logged'] = true;
		}
		return $this->current_user;
	}
	
  	/**
  	 * Returns the anonymous user. If the anonymous user does not exist, it is created. There can be only one anonymous user per database.
  	 * /
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
			if ($user['User']['status'] != STATUS_ACTIVE) return null;
		}
	}
	
	function hash_password($clear_password) {
		return Security::hash($clear_password, self::HASH_TYPE);
	}*/
}
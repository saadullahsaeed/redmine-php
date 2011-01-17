<?php
class AppController extends Controller {
	var $helpers = array('Javascript', 'Html', 'Form', 'Session', 'Menu', 'Users');
	
	var $uses = array('User');
	
	var $components = array(
		'Auth' => array(
            'loginAction' => array(
                'controller' => 'account',
                'action' => 'login'
            ),
			'fields' => array(
				'username' => 'login', 
				'password' => 'hashed_password'
			)
        ),
		'Session'
	);
	
	function beforeRender() {
		$logged_user = $this->logged_user();

		$top_menu[] = array(__('Home', true), array('controller' => 'welcome'));
		
		if (empty($logged_user)) {
			$account_menu[] = array(__('Sign in', true), array('controller' => 'account', 'action' => 'login'));
			$account_menu[] = array(__('Register', true), array('controller' => 'account', 'action' => 'register'));
		} else {
			$account_menu[] = array(__('My account', true), array('controller' => 'my', 'action' => 'account'));
			$account_menu[] = array(__('Logout', true), array('controller' => 'account', 'action' => 'logout'));
			$top_menu[] = array(__('My page', true), array('controller' => 'my', 'action' => 'page'));
		}		
		
		$top_menu[] = array(__('Projects', true), array('controller' => 'projects', 'action' => 'index'));
		$top_menu[] = array(__('Help', true), 'http://www.redmine.org/guide');
		
		$this->set('account_menu', $account_menu);
		$this->set('top_menu', $top_menu);
		$this->set('logged_user', $logged_user);
	}
	
	function logged_user() {
		$logged_user = $this->Auth->user();
		$user = $this->User->find('first', array('conditions' => array('User.id' => $logged_user['User']['id']), 'recursive' => 3));
		return $user;
	}
}
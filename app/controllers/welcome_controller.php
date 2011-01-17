<?php
class WelcomeController extends AppController {
	var $name = 'Welcome';
	
	var $uses = array();
	
	function beforeFilter() {
		$this->Auth->allow('index');
	}
	
	function index() {	
	}
}
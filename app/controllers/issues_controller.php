<?php
class IssuesController extends AppController {
	var $name = 'Issues';
	
	function new_issue($identifier = '') {
		$this->render('new');
		// TODO identifier empty because of route ?
		// debug($identifier);
    }	
}
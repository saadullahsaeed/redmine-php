<?php
class ProjectsController extends AppController {
    var $name = 'Projects';
    var $helpers = array('Projects');
	var $uses = array('Project', 'User');
	
	function beforeFilter() {
		$this->Auth->allow('index');
	}

    function index() {
		$logged_user = $this->logged_user();
		$user = $this->User->findById($logged_user['User']['id']);
		$projects = $this->Project->visible_by($user);
		$this->set('projects', $projects);
    }

    function overview($id) {
        $project = $this->Project->findById($id);
        $this->set('project', $project);

		$this->set('title_for_layout', $project['Project']['name']);
		
		$this->set('main_menu', array(
			array(
				'label' => __('Overview', true),
				'url' => array('controller' => 'projects', 'action' => 'overview', $id),
				'class' => 'overview selected'
			)
		));
    }
	/*
	function isAuthorized() {
        if ($this->action == 'overview') {

        }
        return true;
    }*/
}
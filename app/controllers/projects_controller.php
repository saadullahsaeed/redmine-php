<?php
class ProjectsController extends AppController {
    var $name = 'Projects';
    var $helpers = array('Projects');
	var $uses = array('Project', 'Role');
	
	function beforeFilter() {
		$this->Auth->allow('index');
	}

    function index() {
		$logged_user = $this->logged_user();		
		$projects = $this->Project->list_for_tree($logged_user);
		$this->set('projects', $projects);
    }

    function show($identifier) {
        $logged_user = $this->logged_user();
		$project = $this->Project->visible($logged_user, 'first', array('conditions' => array('Project.identifier' => $identifier)));
		
		if (!empty($project)) {

			$main_menu = $this->Project->menu($logged_user, $project);
			
			$sub_projects = $this->Project->visible($logged_user, 'all', array('conditions' => array('Project.parent_id' => $project['Project']['id'])));
			
			$this->set('main_menu', $main_menu);
			$this->set('project', $project);
			$this->set('sub_projects', $sub_projects);
			$this->set('title_for_layout', $project['Project']['name']);
		} else {
			$this->Session->setFlash(__('You are not authorized to access that location.', true));
			$this->redirect(array('controller' => 'errors', 'action' => 'index'));
		}
    }
}
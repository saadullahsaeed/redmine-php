<?php
class ProjectsController extends AppController {
    var $name = 'Projects';
    var $helpers = array('Projects');
	
	function beforeFilter() {
		$this->Auth->allow('index');
	}

    function index() {
        $projects = $this->Project->tree(array('Project.is_public' => 1));
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
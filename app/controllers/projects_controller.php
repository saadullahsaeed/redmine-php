<?php
class ProjectsController extends AppController {
    var $name = 'Projects';
    var $helpers = array('Projects');

    function index() {
        $projects = $this->Project->find('all', array('conditions' => array('Project.is_public' => 1)));
        debug(projects);
        $this->set('projects', $projects);
        $this->set('title_for_layout', __('Projects', true));
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
}
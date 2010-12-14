<?php
class ProjectsController extends AppController {
    var $name = 'Projects';

    function index() {
        $projects = $this->Project->find('all',
            array('conditions' => array('Project.is_public' => 1)));
        $this->set('projects', $projects);

        $this->pageTitle = __('Projects', true);
    }

    function view($id) {
        $project = $this->Project->findById($id);
        $this->set('project', $project);

        $this->pageTitle = $project['Project']['name'];
    }
}
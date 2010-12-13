<?php
class ProjectsController extends AppController {
    var $name = 'Project';

    function list() {
        $projects = $this->Project->find('all',
            array('conditions' => array('Project.is_public' => 1)));
        $this->set('projects', $projects);
    }
}
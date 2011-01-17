<?php
class Project extends AppModel {
    var $name = 'Project';

    var $order = 'name';
	
	const STATUS_ACTIVE = 1;

    var $actsAs = array('NestedSet' => array(
        'left'  => 'lft',
        'right' => 'rgt'
    ));
	
	function visible_by($user) {
		if($user['User']['admin'] == 1) {
			$projects = $this->tree(array('Project.status' => self::STATUS_ACTIVE));
		} else if (empty($user) || empty($user['Member'])) {
			$projects = $this->tree(array('Project.status' => self::STATUS_ACTIVE, 'Project.is_public' => 1));
        } else if(!empty($user['Member'])) {
			foreach($user['Member'] as $member) {
				$project_ids[] = $member['project_id'];
			}
			$projects = $this->tree(array('Project.status' => self::STATUS_ACTIVE, 'Project.is_public = 1 or Project.id in (' . implode(',', $project_ids) . ')'));
		}
		return $projects;
	}
}
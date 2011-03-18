<?php
class Project extends AppModel {
    var $name = 'Project';

    var $order = 'name';
	
	const STATUS_ACTIVE = 1;
	
	var $hasMany = array('Member');

    var $actsAs = array('NestedSet' => array(
        'left'  => 'lft',
        'right' => 'rgt'
    ));
	
	function list_for_tree($user, $conditions = array()) {	
		$conditions = array_merge($conditions, $this->visible_by($user));
		return $this->tree($conditions);
	}
	
	function visible($user, $type = 'all', $params = array()) {
		$params['conditions'] = array_merge($params['conditions'], $this->visible_by($user));
		return $this->find($type, $params);
	}
	
	function visible_by($user) {
		$conditions['Project.status'] = self::STATUS_ACTIVE;
		if($user['User']['admin'] == 1) {
		
		} else if(!empty($user['Member'])) {
			foreach($user['Member'] as $member) {
				$project_ids[] = $member['project_id'];
			}
			$conditions[] = '(Project.is_public = 1 or Project.id in (' . implode(',', $project_ids) . '))';
		} else {
			$conditions['Project.is_public'] = 1;
        }
		return $conditions;
	}
	
	function menu($user, $project) {
		$menu[] = array(__('Overview', true), array('controller' => 'projects', 'action' => 'show', $project['Project']['identifier']), array('class' => 'overview selected'));
		
		App::import('model', 'Role');
		$role = new Role();
		$permissions = $role->get_permissions($user, $project);
		
		if (in_array ('new_issue', $permissions) || $user['User']['admin'] == 1) {
			$menu[] = array(__('New issue', true), array('controller' => 'issues', 'action' => 'new', $project['Project']['identifier']), array('class' => 'new-issue'));
		}
		
		if (in_array ('repository', $permissions) || $user['User']['admin'] == 1) {
			$menu[] = array(__('Repository', true), array('controller' => 'projects', 'action' => 'repository', $project['Project']['identifier']), array('class' => 'repository'));
		}
		
		return $menu;
	}
}
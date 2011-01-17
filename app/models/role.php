<?php
class Role extends AppModel {
    var $name = 'Role';
/*
    var $actsAs = array(
        'Translate' => array(
            'name'
        )
    );
*/
    var $hasMany = array(
        'MemberRole' => array(
            'dependent'=> true
        )
    ); 
	
	function get_permissions($user, $project) {
		$conditions['id'] = 3;
		
		$dbo = $this->getDataSource();
		
		$joins = array();
        
        foreach ($this->hasMany as $name => $value) {
			$joins[] = array(
                'table' => $dbo->fullTableName($this->$name),
                'alias' => $this->$name->name,
                'type' => 'left',
                'foreignKey' => $value['foreignKey'],
                'conditions' => array(
                    $this->$name->name . '.' . $value['foreignKey'] . ' = ' . $this->name . '.' . $this->primaryKey
                )
            );
			
            foreach ($this->$name->belongsTo as $nameBelongs => $valueBelongs) {
				if ($nameBelongs != $this->name) {
					$joins[] = array(
						'table' => $dbo->fullTableName($this->$name->$nameBelongs),
						'alias' => $this->$name->$nameBelongs->name,
						'type' => 'left',
						'foreignKey' => $valueBelongs['foreignKey'],
						'conditions' => array(
							$this->$name->$nameBelongs->name . '.' . $this->$name->$nameBelongs->primaryKey  . ' = ' . $this->$name->name . '.' . $valueBelongs['foreignKey']
						)
					);
				}
			}
        }

		$options = array(
			'fields' => array($this->name . '.permissions'),
			'table' => $dbo->fullTableName($this),
			'alias' => $this->name,
			'limit' => null,
			'offset' => null,
			'joins' => $joins,
			'conditions' => array('Member.user_id' => $user['User']['id'], 'Member.project_id' => $project['Project']['id']),
			'order' => null,
			'group' => null
		);
		$query = $dbo->buildStatement($options, $this);
		
		$roles = $this->query($query);
		
		$permissions = array();
		
		foreach ($roles as $role) {
			$perms = explode(',', $role['Role']['permissions']);
			$permissions = array_merge($permissions, $perms);
		}

		return $permissions;
	}
}
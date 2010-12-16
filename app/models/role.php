<?php
class Role extends AppModel {
    var $name = 'Role';

    var $actsAs = array(
        'Translate' => array(
            'name'
        )
    );

    var $hasMany = array(
        'MemberRole' => array(
            'dependent'=> true
        )
    ); 
}
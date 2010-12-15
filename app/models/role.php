<?php
class Role extends AppModel {
    var $name = 'Role';

    var $hasMany = array(
        'MemberRole' => array(
            'dependent'=> true
        )
    ); 
}
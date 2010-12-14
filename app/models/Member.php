<?php
class Member extends AppModel {
    var $name = 'Member';

    var $belongsTo = array('User', 'Project');

    var $hasMany = array(
        'MemberRole' => array(
            'dependent'=> true
        )
    ); 
}
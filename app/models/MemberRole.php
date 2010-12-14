<?php
class MemberRole extends AppModel {
    var $name = 'MemberRole';

    var $belongsTo = array('Member', 'Role');
}
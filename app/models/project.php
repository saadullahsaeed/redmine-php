<?php
class Project extends AppModel {
    var $name = 'Project';

    var $order = 'name';

    var $actsAs = array('NestedSet' => array(
        'left'  => 'lft',
        'right' => 'rgt'
    ));
}
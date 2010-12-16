<?php
class Project extends AppModel {
    var $name = 'Project';

    var $order = 'name';

    var $actsAs = array('Tree' => array(
        'left'  => 'lft',
        'right' => 'rgt'
    ));
}
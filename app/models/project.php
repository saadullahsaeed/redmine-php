<?php
class Project extends AppModel {
    var $name = 'NestedSet';

    var $order = 'name';

    var $actsAs = array('Tree' => array(
        'left'  => 'lft',
        'right' => 'rgt'
    ));
}
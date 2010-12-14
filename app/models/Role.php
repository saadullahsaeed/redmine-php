<?php
class Role extends AppModel {
    var $name = 'Role';

    var $hasMany = 'Member'; 
}
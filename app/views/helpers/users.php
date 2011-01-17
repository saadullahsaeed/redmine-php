<?php
class UsersHelper extends AppHelper {
	var $helpers = array('Html');

	/**
	* Renders a tree of projects as a nested set of unordered lists
	* The given collection may be a subset of the whole project tree
	* (eg. some intermediate nodes are private and can not be seen)
	*/
	function link_to_user($user, $options = array()) {
		if (!empty($user)) {
			$name = $user['User'][$options['format']];
			$s = $this->Html->link($name, array('controller' => 'users', 'action' => 'show', $user['User']['id']));
		}
		return $s;
	}
}
<?php
App::import('Behavior', 'Tree');
class NestedSetBehavior extends TreeBehavior {

  function roots(&$Model, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null) {
    $conditions = array($scope, $Model->escapeField($parent) => null);
    return $Model->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive'));
  }

  function tree(&$Model, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $id = null) {
	if ($id == null) {
		$nodes = $this->roots($Model, $fields, $order, $limit, $page, $recursive);
	} else {
		$nodes = $this->children($Model, $id, true, $fields, $order, $limit, $page, $recursive);
	}
	foreach ($nodes as $node) {
		$node[$Model.'s'] = tree(&$Model, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $node[$Model][$Model->primaryKey]);
	}
  }
}
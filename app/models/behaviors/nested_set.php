<?php
App::import('Behavior', 'Tree');
class NestedSetBehavior extends TreeBehavior {

  function roots(&$Model, $conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null) {
    extract($this->settings[$Model->alias]);
	$conditions = array($Model->escapeField($parent) . ' is null', $conditions);
    return $Model->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive'));
  }

  function tree(&$Model, $originalConditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $id = null) {
	extract($this->settings[$Model->alias]);
	if ($id == null) {
		$nodes = $this->roots($Model, $originalConditions, $fields, $order, $limit, $page, $recursive);
	} else {
		$conditions = array($Model->escapeField($parent) => $id, $originalConditions);
		$nodes = $Model->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive'));
	}
	foreach ($nodes as $i => $node) {
		$children = $this->tree($Model, $originalConditions, $fields, $order, $limit, $page, $recursive, $node[$Model->name][$Model->primaryKey]);
		if (!empty($children)) {
			$node[$Model->name][Inflector::pluralize($Model->name)] = $children;
			$nodes[$i] = $node;
		}
	}
	return $nodes;
  }
}
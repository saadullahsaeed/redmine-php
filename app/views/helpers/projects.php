<?php
class ProjectsHelper extends AppHelper {
  var $helpers = array('Html');

  /**
   * Renders a tree of projects as a nested set of unordered lists
   * The given collection may be a subset of the whole project tree
   * (eg. some intermediate nodes are private and can not be seen)
   */
  function render_project_hierarchy($projects, $logged_user = null, $root = true) {
    $s = '';
	$s .= "<ul class='projects ".($root?'root':null)."'>\n";
    foreach ($projects as $project) {
		$classes = ($root?'root':'child');
		$s .= "<li class='$classes'><div class='$classes'>";
		$classes = 'project';
		if (!empty($logged_user)) {
			App::import('model', 'User');
			$user = new User();
			if ($user->member_of($logged_user, $project)) $classes .= ' my-project';
		}
		$s .= $this->Html->link($project['Project']['name'], array('controller' => 'projects', 'action' => 'show', $project['Project']['identifier']), array('class' => $classes));
        $s .= "<div class='wiki description'>".$project['Project']['description']."</div>";
        $s .= "</div>\n";
		if (!empty($project['Project']['Projects'])) {
			$s .= $this->render_project_hierarchy($project['Project']['Projects'], $logged_user, false);
		}
		$s .= "</li>";
    }
	$s .= "</ul>";
    return $s;
  }
}
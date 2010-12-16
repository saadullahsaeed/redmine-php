<?php
class ProjectsHelper extends AppHelper {
  var $helpers = array('Html');

  /**
   * Renders a tree of projects as a nested set of unordered lists
   * The given collection may be a subset of the whole project tree
   * (eg. some intermediate nodes are private and can not be seen)
   */
  function render_project_hierarchy($projects, $root = true) {
    $s = '';
	$s .= "<ul class='projects ".($root?'root':null)."'>\n";
    foreach ($projects as $project) {
		$classes = ($root?'root':'child');
		$s .= "<li class='$classes'><div class='$classes'>";
		// link_to_project(project, {}, :class => "project #{User.current.member_of?(project) ? 'my-project' : nil}")
		$s .= $this->Html->link($project['Project']['name'], array('controller' => 'projects', 'action' => 'overview', $project['Project']['id']), array('class'=>'project'));
        $s .= "<div class='wiki description'>".$project['Project']['description']."</div>";
        $s .= "</div>\n";
		$s .= render_project_hierarchy($project['Projects'], false)
		$s .= "</li>";
    }
	$s .= "</ul>";
    return $s;
  }
}
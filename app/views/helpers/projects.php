<?php
class ProjectsHelper extends AppHelper {
  var $helpers = array('Html');

  var $project;

  /**
   * Renders a tree of projects as a nested set of unordered lists
   * The given collection may be a subset of the whole project tree
   * (eg. some intermediate nodes are private and can not be seen)
   */
  function render_project_hierarchy($projects) {
    $s = '';
    if (!empty($projects)) {
      $ancestors = array();
      foreach ($projects as $project) {
        $this->project = $project;
        //if (empty($ancestors) || $project->is_descendant_of(end($ancestors)) {
          $s .= "<ul class='projects ".(empty($ancestors)?'root':null)."'>\n";
        //} else {

        //}
        $classes = (empty($ancestors)?'root':'child');
        $s .= "<li class='$classes'><div class='$classes'>";
        // link_to_project(project, {}, :class => "project #{User.current.member_of?(project) ? 'my-project' : nil}")
        $s .= $this->Html->link($project['Project']['name'], array('controller' => 'projects', 'action' => 'overview', $project['Project']['id']), array('class'=>'project'));
        $s .= "<div class='wiki description'>".$project['Project']['description']."</div>";
        $s .= "</div>\n";
        $ancestors[] = $project;
      }
    }
    return $s;
  }
}

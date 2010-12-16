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
      $orginal_project = $this->project;
      foreach ($projects as $project) {
        $this->project = $project;
        $ancestor = end($ancestors);
        if (empty($ancestors) || $project['Project']['parent_id'] == $ancestor['Project']['id']) {
          $s .= "<ul class='projects ".(empty($ancestors)?'root':null)."'>\n";
        } else {
          $ancestor = array_pop($ancestors);
          $s .= "</li>";
          while (!empty($ancestors) && $project['Project']['parent_id'] != $ancestor['Project']['id']) {
            array_pop($ancestors);
            $s .= "</ul></li>\n";
          }
        }
        $classes = (empty($ancestors)?'root':'child');
        $s .= "<li class='$classes'><div class='$classes'>";
        // link_to_project(project, {}, :class => "project #{User.current.member_of?(project) ? 'my-project' : nil}")
        $s .= $this->Html->link($project['Project']['name'], array('controller' => 'projects', 'action' => 'overview', $project['Project']['id']), array('class'=>'project'));
        $s .= "<div class='wiki description'>".$project['Project']['description']."</div>";
        $s .= "</div>\n";
        $ancestors[] = $project;
      }
      for($i = 0; $i < count($ancestors); $i++) $s .= "</li></ul>\n";
      $this->project = $orginal_project;
    }
    return $s;
  }
}

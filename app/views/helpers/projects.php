<?php
var $helpers = array('Html');
class ProjectsHelper extends AppHelper {

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
          // $s .= "<ul class='projects #{ ancestors.empty? ? 'root' : nil}'>\n";
        //}
      }
    }
    return $s;
  }
}

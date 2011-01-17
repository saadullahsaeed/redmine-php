<?php
class MenuHelper extends AppHelper {
  var $helpers = array('Html');

  function render_menu($menu = array()) {
    $s = "<ul>\n";
    foreach ($menu as $item) {
		$s .= "\t<li>";
		$s .= $this->Html->link($item[0], $item[1]);
		$s .= "</li>\n";
    }
	$s .= '</ul>';
    return $s;
  }
}
<?php
class MenuHelper extends AppHelper {
  var $helpers = array('Html');

  function render_menu($menu = array()) {
    $s = "<ul>\n";
    foreach ($menu as $item) {
		$s .= "\t<li>";
		if(empty($item[2])) $item[2] = null;
		$s .= $this->Html->link($item[0], $item[1], $item[2]);
		$s .= "</li>\n";
    }
	$s .= '</ul>';
    return $s;
  }
}
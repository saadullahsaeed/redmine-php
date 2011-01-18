<?php
class Setting extends AppModel {
    var $name = 'Setting';
	
	function value($name) {
		$setting = $this->findByName($name);
		$value = null;
		if (!empty($setting)) $value = $setting['Setting']['value'];
		return $value;
	}
}
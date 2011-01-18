<?php
class SettingHelper extends AppHelper {

	function value($name) {
		App::import('model', 'Setting');
		$setting = new Setting();
		return $setting->value($name);
	}
}
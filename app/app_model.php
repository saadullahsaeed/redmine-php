<?php
class AppModel extends Model { 

	function invalidate($field, $value = true) {
		return parent::invalidate($field, __($value, true));
	}
}
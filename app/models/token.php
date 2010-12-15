<?php
class Token extends AppModel {
    var $name = 'Token';

    var $belongsTo = array('User');
    
    function beforeSave() {
	    $this->data['Token']['value'] =  Security::generateAuthKey();
		return true;
	}
}
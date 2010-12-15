<?php
class Token extends AppModel {
    var $name = 'Token';

    var $belongsTo = array('User');
    
    Security::generateAuthKey()
    
    function beforeSave() {
	    $this->data['Token']['value'] =  Security::generateAuthKey();
		return true;
	}
}
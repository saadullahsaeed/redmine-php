<?php
class AppModel extends Model { 

	function invalidate($field, $value = true) {
		return parent::invalidate($field, __($value, true));
	}
	
	function identicalFieldValues($field=array(), $compare_field=null) { 
        foreach ($field as $key => $value) { 
            $v1 = $value; 
            $v2 = $this->data[$this->name][ $compare_field ];                  
            if($v1 !== $v2) { 
                return false; 
            } else { 
                continue; 
            } 
        } 
        return true; 
    }
}
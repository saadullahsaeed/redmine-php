<?php
class ErrorsController extends AppController
{
    var $name = 'Errors';
	
	var $uses = array();

    function index($erreur = null) {        
        $this->set('erreur', $erreur);
    }
}
<?php
class ErrorsController extends AppController
{
    var $name = 'Errors';

    function index($erreur = 400) {        
        $this->set('erreur', $erreur);
    }
}
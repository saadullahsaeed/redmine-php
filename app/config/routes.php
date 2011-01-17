<?php
    Router::connect('/', array('controller' => 'welcome', 'action' => 'index'));
    Router::connect('/login', array('controller' => 'account', 'action' => 'login'));
    Router::connect('/logout', array('controller' => 'account', 'action' => 'logout'));
	Router::connect('/users/:id', array('controller' => 'users', 'action' => 'show'), array('id' => '[0-9]+'));
	Router::connect('/projects/:identifier', array('controller' => 'projects', 'action' => 'show'), array('identifier' => '[0-9a-zA-Z]+'));
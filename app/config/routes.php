<?php
    Router::connect('/', array('controller' => 'welcome', 'action' => 'index'));
    Router::connect('/login', array('controller' => 'account', 'action' => 'login'));
    Router::connect('/logout', array('controller' => 'account', 'action' => 'logout'));
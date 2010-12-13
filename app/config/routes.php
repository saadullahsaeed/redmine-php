<?php
    Router::connect('/', array('controller' => 'welcome', 'action' => 'index'));
    Router::connect('/projects', array('controller' => 'projects', 'action' => 'list'));
<?php
	Configure::write('debug', 2);
	Configure::write('log', true);
	Configure::write('App.encoding', 'UTF-8');
	define('LOG_ERROR', 2);
	Configure::write('Session.save', 'php');
	Configure::write('Session.cookie', 'REDMINE-PHP');
	Configure::write('Session.timeout', '120');
	Configure::write('Session.start', true);
	Configure::write('Session.checkAgent', true);
	Configure::write('Security.level', 'medium');
	Configure::write('Security.salt', 'DYhG93b0qyJfIxfs2guVoUubbwvniR2G0FgaC9mi');
	Configure::write('Security.cipherSeed', '76859309657453542491749683645');
	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');
	Cache::config('default', array('engine' => 'File'));
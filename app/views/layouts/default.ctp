<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://developers.facebook.com/schema/">
<head profile="http://gmpg.org/xfn/11">
    <title><?php __("Redmine PHP")?></title>
    <?php echo $html->charset(); ?>
    <?php echo $html->css('application'); ?>
    <?php echo $javascript->link('http://code.jquery.com/jquery-pack.min.js'); ?>
    <?php echo $javascript->link('script'); ?>
</head>
<body>
<div id="wrapper">
	<div id="top-menu">
		<div id="account">
			<ul>
				<li><?php echo $this->Html->link(__('Sign in', false), array('controller' => 'account', 'action' => 'login')); ?></li>
				<li><?php echo $this->Html->link(__('Register', false), array('controller' => 'account', 'action' => 'register')); ?></li>
			</ul>
	    </div>
    
    	<ul>
    		<li><?php echo $this->Html->link(__('Home', false), array('controller' => 'welcome')); ?></li>
			<li><?php echo $this->Html->link(__('Projects', false), array('controller' => 'projects')); ?></li>
			<li><a href="http://www.redmine.org/guide" class="help"><?php __("Help")?></a></li>
		</ul>
	</div>
	<div id="header">
		<h1><?php __("Redmine PHP")?></h1>
	</div>
	<?php echo $content_for_layout; ?>
	<div id="footer">
		<?php __("Redmine PHP")?>  &copy; <?php echo date('Y')?> <?php echo $html->link('Steve Grosbois', 'http://www.steve-grosbois.com') ;?>
	</div>
</div>
</body>
</html>
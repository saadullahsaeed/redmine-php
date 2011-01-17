<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://developers.facebook.com/schema/">
<head profile="http://gmpg.org/xfn/11">
    <title><?php __('Redmine PHP')?> - <?php __($title_for_layout)?></title>
    <?php echo $html->charset(); ?>
    <?php echo $html->css('application'); ?>
    <?php echo $javascript->link('http://code.jquery.com/jquery-pack.min.js'); ?>
    <?php echo $javascript->link('script'); ?>
</head>
<body>
<div id="wrapper">
	<div id="top-menu">
		<div id="account">
			<?php echo $this->Menu->render_menu($account_menu); ?>
	    </div>
		<?php if(!empty($logged_user)) { ?>
			<div id="loggedas"><?php __('Logged in as'); echo ' '; echo $this->Users->link_to_user($logged_user, array('format' => 'login'));?></div>
		<?php } ?>
		<?php echo $this->Menu->render_menu($top_menu); ?>
	</div>
	<div id="header">
		<h1><?php if (empty($h1)) __($title_for_layout); else __($h1)?></h1>    
    	<?php if (!empty($main_menu)) { ?>
    		<div id="main-menu">
				<?php echo $this->Menu->render_menu($main_menu); ?>
    		</div>
		<?php } ?>
	</div>
	<div id="main" class="<?php if(empty($sidebar)) echo 'nosidebar'; ?>">
		<div id="sidebar"><?php echo $sidebar; ?></div>
		<div id="content">
			<?php 
			$flash = $session->flash('auth');
			if(empty($flash)) {
				$flash = $session->flash();
			}
			if(!empty($flash)) { ?>
				<?php echo $flash; ?>
			<?php } ?>
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<div id="footer">
		<?php __("Powered by")?> <?php __("Redmine PHP")?>  &copy; 2010-<?php echo date('Y')?> <?php echo $html->link('Steve Grosbois', 'http://www.steve-grosbois.com') ;?>
	</div>
        <?php echo $this->element('sql_dump'); ?>
</div>
</body>
</html>
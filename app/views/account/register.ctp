<h2><?php __('Register'); ?></h2>
<?php echo $this->Form->create('User', array('class' => 'tabular', 'url' => array('controller' => 'account', 'action' => 'register'))); ?>
	<div class="box">
		<p>
			<label for="UserLogin"><?php __('Username'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('login', array('size' => 25, 'label' => false, 'div' => false)); ?>
		</p>
		<p>
			<label for="UserPassword"><?php __('Password'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('password', array('type' => 'password', 'size' => 25, 'label' => false, 'div' => false)); ?><br/>
			<em><?php printf(__('Must be at least %s characters long.', true), $this->Setting->value('password_min_length')); ?></em>
		</p>
		<p>
			<label for="UserPasswordConfirmation"><?php __('Confirmation'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('password_confirmation', array('type' => 'password', 'size' => 25, 'label' => false, 'div' => false)); ?>
		</p>
		<p>
			<label for="UserFirstname"><?php __('Firstname'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('firstname', array('id' => 'user_firstname', 'size' => 30, 'label' => false, 'div' => false)); ?>
		</p>
		<p>
			<label for="UserLastname"><?php __('Lastname'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('lastname', array('id' => 'user_lastname', 'size' => 30, 'label' => false, 'div' => false)); ?>
		</p>
		<p>
			<label for="UserMail"><?php __('Email'); ?> <span class="required">*</span></label>
			<?php echo $this->Form->input('mail', array('id' => 'user_mail', 'size' => 30, 'label' => false, 'div' => false)); ?>
		</p>
		<p>
			<label for="UserLanguage"><?php __('Language'); ?></label>
			<?php echo $this->Form->input('language', array('label' => false, 'div' => false, 'options' => $this->Application->lang_options_for_select())); ?>
		</p>
	</div>
<?php echo $this->Form->end(__('Submit', true)); ?>
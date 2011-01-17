<div id="login-form">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'account', 'action' => 'login'))); ?>
		<table>
			<tr>
			    <td align="right"><label for="login"><?php __('Username');?>:</label></td>
			    <td align="left"><?php echo $this->Form->input('login', array('label' => false)); ?></td>
			</tr>
			<tr>
			    <td align="right"><label for="hashed_password"><?php __('Password');?>:</label></td>
			    <td align="left"><?php echo $this->Form->input('hashed_password', array('type' => 'password', 'label' => false)); ?></td>
			</tr>
			<tr>
			    <td align="left">
			    </td>
			    <td align="right">
			        <input type="submit" name="login" value="<?php __('Login');?> &#187;" tabindex="5"/>
			    </td>
			</tr>
		</table>
	<?php echo $this->Form->end(); ?>
</div>
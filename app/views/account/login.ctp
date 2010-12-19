<div id="login-form">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'account', 'action' => 'login'))); ?>
		<table>
			<tr>
			    <td align="right"><label for="username"><?php __('Username');?>:</label></td>
			    <td align="left"><?php echo $this->Form->input('username', array('label' => false)); ?></td>
			</tr>
			<tr>
			    <td align="right"><label for="password"><?php __('Password');?>:</label></td>
			    <td align="left"><?php echo $this->Form->input('password', array('type' => 'password', 'label' => false)); ?></td>
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
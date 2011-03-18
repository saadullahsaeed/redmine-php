<div class="contextual">
	<?php // TODO : Only if current user is admin !!!
	echo $html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']), array('class' => 'icon icon-edit')) ;?>
</div>
<h2><?php echo $this->Users->name($user)?></h2>
<div class="splitcontentleft">
</div>
<div class="splitcontentright">
</div>

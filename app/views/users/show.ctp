<div class="contextual">
	<?php if ($logged_user['User']['admin'] == 1) echo $html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']), array('class' => 'icon icon-edit')) ;?>
</div>

<h2><?php echo $this->Users->name($user)?></h2>

<div class="splitcontentleft">
<ul>
</ul>
</div>

<div class="splitcontentright">
</div>

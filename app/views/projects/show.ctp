<h2><?php echo __('Overview')?></h2> 

<div class="splitcontentleft">
	<div class="wiki">
		<?php echo $project['Project']['description'] ?>
	</div>	
	<ul>
	<?php if(!empty($project['Project']['homepage'])) { 
		echo '<li>';
		__('Homepage'); 
		echo ': ';
		echo $this->Html->link($project['Project']['homepage']);
		echo '</li>';
	} ?>
	<?php if(!empty($sub_projects)) { 
		echo '<li>';
		__('Subprojects');
		echo ': ';
		foreach ($sub_projects as $sub_project) {
			$links[] = $this->Html->link($sub_project['Project']['name'], array('controller' => 'projects', 'action' => 'show', $sub_project['Project']['identifier']), array('class'=>'project'));
		}
		echo implode(', ', $links);
		echo '</li>';
	} ?>
	</ul>	
</div>
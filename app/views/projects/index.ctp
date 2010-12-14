<div class="nosidebar" id="main">
    <div id="content">
        <h2><?php __('Projects')?></h2>
        <ul class="projects root">
            <?php foreach ($projects as $project): ?>
            <li class="root">
                <div class="root">
                    <?php echo $this->Html->link($project['Project']['name'], array('controller' => 'projects', 'action' => 'overview', $project['Project']['id']), array('class'=>'project')); ?>
                    <div class="wiki description"><?php echo $project['Project']['description']?></div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
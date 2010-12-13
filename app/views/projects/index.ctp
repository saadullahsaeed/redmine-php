<div class="nosidebar" id="main">
    <div id="content">
        <h2><?php __('Projects')?></h2>
        <ul class="projects root">
            <?php foreach ($projects as $project): ?>
            <li class="root">
                <div class="root">
                    <a href="/projects/<?php echo $project['Project']['id']?>" class="project"><?php echo $project['Project']['name']?></a>
                    <div class="wiki description"><?php echo $project['Project']['description']?></div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
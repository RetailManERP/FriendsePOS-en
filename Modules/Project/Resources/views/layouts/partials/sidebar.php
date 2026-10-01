<li class="bg-maroon treeview <?php echo e(in_array($request->segment(1), ['project']) ? 'active active-sub' : '', false); ?>">
	<a href="#">
        <i class="fa fa-project-diagram"></i>
        <span class="title">
        	<?php echo app('translator')->get('project::lang.project'); ?>
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
    	<li class="<?php echo e($request->segment(2) == 'project' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']), false); ?>">
                <i class="fas fa-folder-open"></i>
                <span class="title"><?php echo app('translator')->get('project::lang.projects'); ?></span>
            </a>
        </li>
        <li class="<?php echo e($request->segment(2) == 'project-task' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\TaskController::class, 'index']), false); ?>">
                <i class="fa fa-tasks"></i>
                <span class="title"><?php echo app('translator')->get('project::lang.my_tasks'); ?></span>
            </a>
        </li>
    </ul>
</li>

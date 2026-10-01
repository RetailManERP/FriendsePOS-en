<div class="project-task-actionbar">
    <div class="btn-group btn-group-toggle project-task-view-switcher" data-toggle="buttons">
        <label class="btn btn-info btn-sm
            <?php if((!empty($project->settings) && !isset($project->settings['task_view'])) || (isset($project->settings['task_view']) &&
                    $project->settings['task_view'] == 'list_view')): ?>
                active
            <?php endif; ?>">
            <input type="radio" name="task_view" value="list_view" class="task_view"
               <?php if((!empty($project->settings) && !isset($project->settings['task_view'])) || (isset($project->settings['task_view']) &&
                    $project->settings['task_view'] == 'list_view')): ?>
                    checked
                <?php endif; ?>>
            <i class="fa fa-list tw-mr-1"></i> <?php echo app('translator')->get('project::lang.list_view'); ?>
        </label>
        <label class="btn btn-info btn-sm
            <?php if(isset($project->settings['task_view']) &&
            $project->settings['task_view'] == 'kanban'): ?>
                active
            <?php endif; ?>">
            <input type="radio" name="task_view" value="kanban" class="task_view"
                <?php if(isset($project->settings['task_view']) &&
                $project->settings['task_view'] == 'kanban'): ?>
                    checked
                <?php endif; ?>>
            <i class="fas fa-columns tw-mr-1"></i> <?php echo app('translator')->get('project::lang.kanban_board'); ?>
        </label>
    </div>
    <?php if(!empty($can_create_task)): ?>
        <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm task_btn" data-href="<?php echo e(action([\Modules\Project\Http\Controllers\TaskController::class, 'create'], ['project_id' => $project->id]), false); ?>">
            <i class="fa fa-plus tw-mr-1"></i>
            <?php echo app('translator')->get('project::lang.create_task'); ?>
        </button>
    <?php endif; ?>
</div>
<div class="table-responsive project-task-table-wrap
    <?php if(isset($project->settings['task_view']) &&
        $project->settings['task_view'] != 'list_view'): ?>
        hide
    <?php endif; ?>">
    <?php
        $task_custom_field_labels = [
            'custom_field_1' => __('project::lang.task_custom_field_1'),
            'custom_field_2' => __('project::lang.task_custom_field_2'),
            'custom_field_3' => __('project::lang.task_custom_field_3'),
            'custom_field_4' => __('project::lang.task_custom_field_4'),
        ];
        $task_setting_labels = json_decode($busines->prj_setting ?? '', true)['task_custom_fields'] ?? [];
        foreach ($task_custom_field_labels as $field_key => $field_value) {
            if (!empty($task_setting_labels[$field_key])) {
                $task_custom_field_labels[$field_key] = $task_setting_labels[$field_key];
            }
        }
    ?>
    <table class="table table-bordered table-striped" id="project_task_table">
        <thead>
            <tr>
                <th class="tw-w-[80px]"> <?php echo app('translator')->get('messages.action'); ?></th>
                <th class="col-md-4"> <?php echo app('translator')->get('project::lang.subject'); ?></th>
                <th class="col-md-2"> <?php echo app('translator')->get('project::lang.assigned_to'); ?></th>
                <th> <?php echo app('translator')->get('project::lang.priority'); ?></th>
                <th> <?php echo app('translator')->get('business.start_date'); ?></th>
                <th><?php echo app('translator')->get('project::lang.due_date'); ?></th>
                <th><?php echo app('translator')->get('sale.status'); ?></th>
                <th><?php echo app('translator')->get('project::lang.assigned_by'); ?></th>
                <th><?php echo e($task_custom_field_labels['custom_field_1'], false); ?></th>
                <th><?php echo e($task_custom_field_labels['custom_field_2'], false); ?></th>
                <th><?php echo e($task_custom_field_labels['custom_field_3'], false); ?></th>
                <th><?php echo e($task_custom_field_labels['custom_field_4'], false); ?></th>
            </tr>
        </thead>
    </table>
</div>

<div class="custom-kanban-board
    <?php if(isset($project->settings['task_view']) &&
    $project->settings['task_view'] != 'kanban'): ?>
        hide
    <?php endif; ?>">
    <div class="page">
        <div class="main">
            <div class="meta-tasks-wrapper">
                <div id="myKanban" class="meta-tasks"></div>
            </div>
        </div>
    </div>
</div>

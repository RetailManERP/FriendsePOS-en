<div class="panel box box-info">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#project_task_time_log" class="collapsed" aria-expanded="false">
                <?php echo app('translator')->get('project::lang.time_logs'); ?>
            </a>
        </h4>
        <?php if(!empty($can_create_timelog)): ?>
            <div class="box-tools pull-right">
                <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm add_time_log pull-right" data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectTimeLogController::class, 'create'], ['task_id' => $project_task->id, 'project_id' => $project_task->project_id]), false); ?>">
                    <?php echo app('translator')->get('messages.add'); ?>&nbsp;
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div id="project_task_time_log" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> <?php echo app('translator')->get('project::lang.start_date_time'); ?></th>
                        <th><?php echo app('translator')->get('project::lang.end_date_time'); ?></th>
                        <th><?php echo app('translator')->get('project::lang.work_hour'); ?></th>
                        <th><?php echo app('translator')->get('role.user'); ?></th>
                        <th><?php echo app('translator')->get('brand.note'); ?></th>
                    </tr>
                </thead>
                <tbody id="task-timelog">
                    <?php if ($__env->exists('project::task.partials.time_log_table_body')) echo $__env->make('project::task.partials.time_log_table_body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

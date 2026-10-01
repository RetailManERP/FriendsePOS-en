<?php if(!empty($can_create_timelog)): ?>
    <div class="tw-flex tw-justify-end tw-mb-4">
        <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm time_log_btn" data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectTimeLogController::class, 'create'], ['project_id' => $project->id]), false); ?>">
            <i class="fa fa-plus tw-mr-1"></i>
            <?php echo app('translator')->get('project::lang.log_time'); ?>
        </button>
    </div>
<?php endif; ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="time_logs_table">
        <thead>
            <tr>
                <th> <?php echo app('translator')->get('messages.action'); ?></th>
                <th><i class="fa fa-tasks tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('project::lang.task'); ?></th>
                <th><i class="fa fa-play tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('project::lang.start_date_time'); ?></th>
                <th><i class="fa fa-stop tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('project::lang.end_date_time'); ?></th>
                <th><i class="fa fa-clock tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('project::lang.work_hour'); ?></th>
                <th><i class="fa fa-user tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('role.user'); ?></th>
                <th><i class="fa fa-sticky-note tw-mr-1 tw-text-gray-400"></i> <?php echo app('translator')->get('brand.note'); ?></th>
            </tr>
        </thead>
    </table>
</div>

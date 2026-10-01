<div class="float-end">
    <button type="button" class="btn btn-sm btn-primary btn-add-schedule float-end">
        <?php echo app('translator')->get('messages.add'); ?>&nbsp;
        <i class="fa fa-plus"></i>
    </button>
    <input type="hidden" name="schedule_create_url" id="schedule_create_url" value="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'create']), false); ?>?schedule_for=lead&contact_id=<?php echo e($contact->id, false); ?>">
    <input type="hidden" name="lead_id" value="<?php echo e($contact->id, false); ?>" id="lead_id">
    <input type="hidden" name="view_type" value="lead_info" id="view_type">
</div> <br><br>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-th-skin" id="lead_schedule_table" style="width: 100%">
        <thead>
            <tr>
                <th> <?php echo app('translator')->get('messages.action'); ?></th>
                <th><?php echo app('translator')->get('crm::lang.title'); ?></th>
                <th><?php echo app('translator')->get('sale.status'); ?></th>
                <th><?php echo app('translator')->get('crm::lang.schedule_type'); ?></th>
                <th><?php echo app('translator')->get('crm::lang.start_datetime'); ?></th>
                <th><?php echo app('translator')->get('crm::lang.end_datetime'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.assigned_to'); ?></th>
            </tr>
        </thead>
    </table>
</div>

<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-sm btn-primary schedule_log_add float-end m-5" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'create'], ['schedule_id' => $schedule->id]), false); ?>">
		    <i class="fas fa-plus"></i>
		    <?php echo app('translator')->get('messages.add'); ?>
		</button>
	</div>
</div>
<div class="table-responsive followup_timeline">

</div>

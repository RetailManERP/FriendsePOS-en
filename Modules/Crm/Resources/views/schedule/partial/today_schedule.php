<?php $__empty_18 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
<div class="external-event 
	<?php if($schedule->status == 'scheduled'): ?>
		bg-yellow
	<?php elseif($schedule->status == 'open'): ?>
		bg-blue
	<?php elseif($schedule->status == 'canceled'): ?>
		bg-red
	<?php elseif($schedule->status == 'completed'): ?>
		bg-green
	<?php else: ?>
		bg-yellow
	<?php endif; ?> width-100" style="display: flex;">
	<div style="width: 75%;">
		<?php echo e($schedule->title, false); ?>

		<br>
		<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'show'], ['follow-ups' => $schedule->id ]), false); ?>" class="text-white mr-8" data-bs-toggle="tooltip" title="<?php echo e(__('crm::lang.view_follow_up'), false); ?>"><i class="fas fa-eye"></i></a>
		<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'create'], ['schedule_id' => $schedule->id]), false); ?>" class="add-schedule-log text-white" class="text-white" data-bs-toggle="tooltip" title="<?php echo e(__('crm::lang.add_schedule_log'), false); ?>"><i class="fas fa-business-time"></i></a>
	</div>
	
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
	<?php echo app('translator')->get('crm::lang.no_schedule_for_today'); ?>
<?php endif; ?>

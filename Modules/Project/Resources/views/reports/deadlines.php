
<?php $__env->startSection('title', __('project::lang.deadlines_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
		<?php echo app('translator')->get('project::lang.deadlines_report'); ?>
		<small>- <?php echo e($project->name, false); ?></small>
	</h1>
</section>

<section class="content">
	<?php echo $__env->make('project::reports.partials._switcher', ['current_route' => 'deadlines', 'project' => $project, 'projects' => $projects], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php if($end_date_status): ?>
		<?php
			$dr = $end_date_status['days_remaining'];
			$cls = $dr < 0 ? 'tw-bg-red-50 tw-border-red-200 tw-text-red-700' : ($dr <= 7 ? 'tw-bg-yellow-50 tw-border-yellow-200 tw-text-yellow-800' : 'tw-bg-green-50 tw-border-green-200 tw-text-green-700');
		?>
		<div class="tw-rounded-xl tw-border tw-p-4 tw-mb-5 <?php echo e($cls, false); ?>">
			<div class="tw-flex tw-items-center tw-gap-3">
				<i class="fas fa-calendar-check tw-text-xl"></i>
				<div>
					<div class="tw-text-sm tw-font-semibold"><?php echo app('translator')->get('project::lang.project_end_date_status'); ?></div>
					<div class="tw-text-sm">
						<?php echo app('translator')->get('project::lang.end_date'); ?>: <strong><?php echo e(\Carbon::createFromTimestamp(strtotime($end_date_status['end_date']))->format(session('business.date_format')), false); ?></strong>
						—
						<?php if($dr < 0): ?>
							<?php echo e(abs($dr), false); ?> <?php echo app('translator')->get('project::lang.days_overdue'); ?>
						<?php elseif($dr === 0): ?>
							<?php echo app('translator')->get('home.today'); ?>
						<?php else: ?>
							<?php echo e($dr, false); ?> <?php echo app('translator')->get('project::lang.days_remaining'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-5">
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-red-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-red-700 tw-font-semibold tw-mb-1"><?php echo app('translator')->get('project::lang.tasks_overdue'); ?></div>
			<div class="tw-text-3xl tw-font-bold tw-text-red-600"><?php echo e($overdue->count(), false); ?></div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-yellow-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-yellow-700 tw-font-semibold tw-mb-1"><?php echo app('translator')->get('project::lang.tasks_upcoming'); ?></div>
			<div class="tw-text-3xl tw-font-bold tw-text-yellow-600"><?php echo e($upcoming->count(), false); ?></div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-green-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-green-700 tw-font-semibold tw-mb-1"><?php echo app('translator')->get('project::lang.tasks_completed'); ?></div>
			<div class="tw-text-3xl tw-font-bold tw-text-green-600"><?php echo e($completed->count(), false); ?></div>
		</div>
	</div>

	<?php
		$sections = [
			['title' => __('project::lang.tasks_overdue'), 'tasks' => $overdue, 'color' => 'tw-bg-red-50', 'badge' => 'tw-bg-red-500'],
			['title' => __('project::lang.tasks_upcoming'), 'tasks' => $upcoming, 'color' => 'tw-bg-yellow-50', 'badge' => 'tw-bg-yellow-500'],
			['title' => __('project::lang.tasks_completed'), 'tasks' => $completed, 'color' => 'tw-bg-green-50', 'badge' => 'tw-bg-green-500'],
		];
	?>

	<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($sec['tasks']->count() > 0): ?>
			<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-mb-4 tw-overflow-hidden">
				<div class="tw-px-4 tw-py-3 tw-border-b tw-border-gray-200 tw-font-semibold tw-text-gray-700 tw-flex tw-items-center tw-gap-2 <?php echo e($sec['color'], false); ?>">
					<?php echo e($sec['title'], false); ?>

					<span class="tw-inline-block <?php echo e($sec['badge'], false); ?> tw-text-white tw-text-xs tw-px-2 tw-py-0.5 tw-rounded-full"><?php echo e($sec['tasks']->count(), false); ?></span>
				</div>
				<div class="table-responsive">
					<table class="table tw-mb-0">
						<thead>
							<tr>
								<th><?php echo app('translator')->get('project::lang.task_id'); ?></th>
								<th><?php echo app('translator')->get('project::lang.subject'); ?></th>
								<th><?php echo app('translator')->get('project::lang.due_date'); ?></th>
								<th><?php echo app('translator')->get('sale.status'); ?></th>
								<th><?php echo app('translator')->get('project::lang.priority'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $sec['tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($task->task_id, false); ?></td>
									<td><?php echo e($task->subject, false); ?></td>
									<td><?php echo e(!empty($task->due_date) ? \Carbon::createFromTimestamp(strtotime($task->due_date))->format(session('business.date_format')) : '-', false); ?></td>
									<td><?php echo e(__('project::lang.' . $task->status), false); ?></td>
									<td><?php echo e(ucfirst($task->priority ?? '-'), false); ?></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php if($no_due->count() > 0): ?>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-4">
			<div class="tw-font-semibold tw-text-gray-700 tw-mb-2"><?php echo app('translator')->get('project::lang.no_due_date'); ?> (<?php echo e($no_due->count(), false); ?>)</div>
			<ul class="tw-list-disc tw-list-inside tw-text-sm tw-text-gray-600 tw-mb-0">
				<?php $__currentLoopData = $no_due; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($task->task_id, false); ?> — <?php echo e($task->subject, false); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	<?php endif; ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
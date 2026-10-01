
<?php $__env->startSection('title', __('project::lang.time_log_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
		<?php echo app('translator')->get('project::lang.time_log_report'); ?>
		<small>- <?php echo e($project->name, false); ?></small>
	</h1>
</section>

<section class="content">
	<?php echo $__env->make('project::reports.partials._switcher', ['current_route' => 'timelog', 'project' => $project, 'projects' => $projects], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php
		$grand_h = floor($grand_total_seconds / 3600);
		$grand_m = floor(($grand_total_seconds % 3600) / 60);
	?>

	<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5 tw-mb-5 tw-text-center">
		<div class="tw-text-sm tw-text-gray-500 tw-mb-1"><?php echo app('translator')->get('project::lang.total_time'); ?></div>
		<div class="tw-text-3xl tw-font-bold tw-text-purple-600">
			<?php echo e(sprintf('%02d:%02d', $grand_h, $grand_m), false); ?>

		</div>
	</div>

	<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-overflow-hidden">
		<?php if($rows->isEmpty()): ?>
			<div class="tw-p-6 tw-text-center tw-text-gray-500"><?php echo app('translator')->get('project::lang.no_record_found'); ?></div>
		<?php else: ?>
			<div class="table-responsive">
				<table class="table table-striped table-th-skin tw-mb-0">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('project::lang.members'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.total_time'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.time_log'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$secs = (int) $row->total_seconds;
								$h = floor($secs / 3600);
								$m = floor(($secs % 3600) / 60);
							?>
							<tr>
								<td><?php echo e($row->user_name, false); ?></td>
								<td class="text-right"><?php echo e(sprintf('%02d:%02d', $h, $m), false); ?></td>
								<td class="text-right"><?php echo e($row->log_count, false); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
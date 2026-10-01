
<div class="project-panel project-report-switcher">
	<div class="project-panel-body">
	<div class="row">
	<div class="col-md-2">
		<a href="<?php echo e(url('project/project-reports'), false); ?>" class="btn btn-default btn-sm">
			<i class="fa fa-arrow-left"></i> <?php echo app('translator')->get('project::lang.project_reports'); ?>
		</a>
	</div>
	<div class="col-md-4">
		<select id="report_project_switcher" class="form-control select2" data-current-report="<?php echo e($current_route, false); ?>" style="width: 100%;">
			<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($id, false); ?>" <?php echo e($id == $project->id ? 'selected' : '', false); ?>><?php echo e($name, false); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<div class="col-md-6 text-right">
		<?php
			$tabs = [
				'budget' => ['label' => __('project::lang.budget_report'), 'icon' => 'fa-wallet'],
				'invoices' => ['label' => __('project::lang.invoices_report'), 'icon' => 'fa-file-invoice-dollar'],
				'deadlines' => ['label' => __('project::lang.deadlines_report'), 'icon' => 'fa-calendar-times'],
				'timelog' => ['label' => __('project::lang.time_log_report'), 'icon' => 'fa-user-clock'],
			];
		?>
		<?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<a href="<?php echo e(url('project/project-reports/' . $slug), false); ?>?project_id=<?php echo e($project->id, false); ?>"
			   class="btn btn-sm <?php echo e($current_route === $slug ? 'btn-primary' : 'btn-default', false); ?>">
				<i class="fas <?php echo e($tab['icon'], false); ?>"></i> <?php echo e($tab['label'], false); ?>

			</a>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		var switcher = document.getElementById('report_project_switcher');
		if (!switcher) {
			return;
		}

		switcher.addEventListener('change', function () {
			var pid = switcher.value;
			var report = switcher.getAttribute('data-current-report');
			if (pid && report) {
				window.location.href = "<?php echo e(url('project/project-reports'), false); ?>/" + report + "?project_id=" + pid;
			}
		});
	});
</script>

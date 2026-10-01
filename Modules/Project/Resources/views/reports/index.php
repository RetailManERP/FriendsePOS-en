
<?php $__env->startSection('title', __('project::lang.project_reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1><?php echo app('translator')->get('project::lang.project_reports'); ?></h1>
</section>
<section class="content">

	
	<div class="project-report-selector">
		<div class="project-panel-body">
		<?php echo Form::open(['url' => action([\Modules\Project\Http\Controllers\ReportController::class, 'index']), 'method' => 'get', 'id' => 'project_report_location_form']); ?>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				<label for="project_report_location_id">
					<i class="fas fa-map-marker-alt"></i>
					<?php echo app('translator')->get('business.business_location'); ?>:
				</label>
				<?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'id' => 'project_report_location_id', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				<label for="project_picker">
					<i class="fa fa-briefcase"></i>
					<?php echo app('translator')->get('project::lang.select_a_project'); ?>:
				</label>
				<?php echo Form::select('project_picker', $projects, null, ['class' => 'form-control select2', 'id' => 'project_picker', 'placeholder' => __('project::lang.select_a_project'), 'style' => 'width: 100%;']); ?>

				<small class="text-muted"><?php echo app('translator')->get('project::lang.select_project_first'); ?></small>
				</div>
			</div>
		</div>
		<?php echo Form::close(); ?>

		</div>
	</div>

	
	<div class="project-report-grid">
		<a href="#" data-base-url="<?php echo e(url('project/project-reports/budget'), false); ?>" class="project-report-card project-report-tile is-disabled">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-wallet"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.budget_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.budget_vs_actual'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>

		<a href="#" data-base-url="<?php echo e(url('project/project-reports/invoices'), false); ?>" class="project-report-card project-report-tile is-disabled">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-file-invoice-dollar"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.invoices_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.invoiced'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>

		<a href="#" data-base-url="<?php echo e(url('project/project-reports/deadlines'), false); ?>" class="project-report-card project-report-tile is-disabled">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-calendar-times"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.deadlines_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.tasks_overdue'); ?> / <?php echo app('translator')->get('project::lang.tasks_upcoming'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>

		<a href="#" data-base-url="<?php echo e(url('project/project-reports/timelog'), false); ?>" class="project-report-card project-report-tile is-disabled">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-user-clock"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.time_log_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.by_employees'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>
	</div>

	
	<h4 class="project-section-title">
		<?php echo app('translator')->get('project::lang.time_log_report'); ?>
	</h4>
	<div class="project-report-grid">
		<a href="<?php echo e(action([\Modules\Project\Http\Controllers\ReportController::class, 'getEmployeeTimeLogReport']) . (!empty($location_id) ? '?location_id=' . $location_id : ''), false); ?>" class="project-report-tile">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-user-clock"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.time_log_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.by_employees'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>
		<a href="<?php echo e(action([\Modules\Project\Http\Controllers\ReportController::class, 'getProjectTimeLogReport']) . (!empty($location_id) ? '?location_id=' . $location_id : ''), false); ?>" class="project-report-tile">
			<div class="card">
				<div class="card-body">
				<div class="project-report-icon">
					<i class="fas fa-project-diagram"></i>
				</div>
				<h4><?php echo app('translator')->get('project::lang.time_log_report'); ?></h4>
				<p><?php echo app('translator')->get('project::lang.by_projects'); ?></p>
				<span class="text-primary">
					<?php echo app('translator')->get('messages.view'); ?> <i class="fa fa-arrow-right"></i>
				</span>
				</div>
			</div>
		</a>
	</div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
	$(document).ready(function () {
		$('#project_report_location_id').on('change', function () {
			$('#project_report_location_form').submit();
		});

		// Enable per-project report cards once a project is selected.
		$('#project_picker').on('change', function () {
			var pid = $(this).val();
			$('.project-report-card').each(function () {
				var base = $(this).data('base-url');
				if (pid) {
					$(this).attr('href', base + '?project_id=' + pid);
					$(this).removeClass('is-disabled');
				} else {
					$(this).attr('href', '#');
					$(this).addClass('is-disabled');
				}
			});
		});
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('repair::lang.repair') . ' '. __('business.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('repair::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>
    	<?php echo app('translator')->get('repair::lang.repair_workshop_management'); ?>
    	<small><?php echo app('translator')->get('business.dashboard'); ?></small>
    </h1>
</section>
<!-- Main content -->
<section class="content no-print">
	
	<?php if(!empty($kpi_data)): ?>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fas fa-clipboard-list"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.open_jobs'); ?></span>
					<span class="info-box-number"><?php echo e($kpi_data['total_open'] ?? 0, false); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.completed_this_month'); ?></span>
					<span class="info-box-number"><?php echo e($kpi_data['total_completed_month'] ?? 0, false); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.overdue_jobs'); ?></span>
					<span class="info-box-number"><?php echo e($kpi_data['overdue_count'] ?? 0, false); ?></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-yellow">
				<span class="info-box-icon"><i class="fas fa-clock"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.avg_turnaround'); ?></span>
					<span class="info-box-number"><?php echo e($kpi_data['avg_turnaround'] ?? 0, false); ?> <?php echo app('translator')->get('repair::lang.days'); ?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-purple">
				<span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.revenue_this_month'); ?></span>
					<span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($kpi_data['total_revenue_month'] ?? 0, false); ?></span></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-teal">
				<span class="info-box-icon"><i class="fas fa-plus-circle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo app('translator')->get('repair::lang.created_today'); ?></span>
					<span class="info-box-number"><?php echo e($kpi_data['created_today'] ?? 0, false); ?></span>
				</div>
			</div>
		</div>
		<?php if(!empty($kpi_data['priority_breakdown'])): ?>
			<?php $__currentLoopData = $kpi_data['priority_breakdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box 
					<?php if($priority == 'urgent'): ?> bg-red
					<?php elseif($priority == 'high'): ?> bg-orange
					<?php elseif($priority == 'normal'): ?> bg-blue
					<?php else: ?> bg-gray
					<?php endif; ?>">
					<span class="info-box-icon"><i class="fas fa-flag"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"><?php echo e(ucfirst($priority), false); ?> <?php echo app('translator')->get('repair::lang.priority'); ?></span>
						<span class="info-box-number"><?php echo e($count, false); ?></span>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title"><?php echo app('translator')->get('repair::lang.job_sheets_by_status'); ?></h4>
				</div>
				<div class="box-body">
					<div class="row">
				        <?php $__empty_18 = true; $__currentLoopData = $job_sheets_by_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="small-box" style="background-color: <?php echo e($job_sheet->color, false); ?>;color: #fff;">
						            <div class="inner">
						              	<p><?php echo e($job_sheet->status_name, false); ?></p>
						              	<h3><?php echo e($job_sheet->total_job_sheets, false); ?></h3>
						            </div>
					          	</div>
					        </div>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
					    	<div class="col-md-12">
	    						<div class="alert alert-info">
					                <h4><?php echo app('translator')->get('repair::lang.no_report_found'); ?></h4>
					            </div>
				           	</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if(in_array('service_staff', $enabled_modules)): ?>
		<div class="row">
		    <div class="col-xs-12">
		        <?php $__env->startComponent('components.widget'); ?>
		            <?php $__env->slot('title'); ?>
		                <?php echo app('translator')->get('repair::lang.job_sheets_by_service_staff'); ?>
		            <?php $__env->endSlot(); ?>
		            <div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
									<th><?php echo app('translator')->get('repair::lang.total_job_sheets'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $job_sheets_by_service_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($loop->iteration, false); ?></td>
										<td><?php echo e($job_sheet->service_staff, false); ?></td>
										<td><?php echo e($job_sheet->total_job_sheets, false); ?></td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
		        <?php echo $__env->renderComponent(); ?>
		    </div>
		</div>
	<?php endif; ?>
	<div class="row">
	    <div class="col-xs-12">
	        <?php $__env->startComponent('components.widget'); ?>
	            <?php $__env->slot('title'); ?>
	                <?php echo app('translator')->get('repair::lang.trending_brands'); ?>
	            <?php $__env->endSlot(); ?>
	            <?php echo $trending_brand_chart->container(); ?>

	        <?php echo $__env->renderComponent(); ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-xs-12">
	        <?php $__env->startComponent('components.widget'); ?>
	            <?php $__env->slot('title'); ?>
	                <?php echo app('translator')->get('repair::lang.trending_devices'); ?>
	            <?php $__env->endSlot(); ?>
	            <?php echo $trending_devices_chart->container(); ?>

	        <?php echo $__env->renderComponent(); ?>
	    </div>
	</div>
	<div class="row">
	    <div class="col-xs-12">
	        <?php $__env->startComponent('components.widget'); ?>
	            <?php $__env->slot('title'); ?>
	                <?php echo app('translator')->get('repair::lang.trending_device_models'); ?>
	            <?php $__env->endSlot(); ?>
	            <?php echo $trending_dm_chart->container(); ?>

	        <?php echo $__env->renderComponent(); ?>
	    </div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<?php echo $trending_devices_chart->script(); ?>

	<?php echo $trending_dm_chart->script(); ?>

	<?php echo $trending_brand_chart->script(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
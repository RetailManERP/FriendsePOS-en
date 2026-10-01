<?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h2 class="box-title">
					<i class="fas fa-receipt"></i>
					<?php echo e($sell->job_sheet_no, false); ?>

				</h2>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<strong><?php echo app('translator')->get('product.brand'); ?>: </strong> <?php echo e($sell->manufacturer, false); ?>

					</div>
					<div class="col-md-6">
						<strong><?php echo app('translator')->get('repair::lang.device'); ?>: </strong> <?php echo e($sell->repair_device, false); ?>

					</div>
				</div>
				<div class="row mt-10">
					<div class="col-md-6">
						<strong><?php echo app('translator')->get('repair::lang.model'); ?>: </strong> <?php echo e($sell->repair_model, false); ?>

					</div>
					<div class="col-md-6">
						<strong>
							<?php echo app('translator')->get('repair::lang.serial_no'); ?>:
						</strong> <?php echo e($sell->serial_no, false); ?>

					</div>
				</div>
				<div class="row mt-10">
					<div class="col-md-6">
						<strong>
							<?php echo e(__('repair::lang.current_repair_status'), false); ?>:
						</strong>
						<span class="label" style="background-color: <?php echo e($sell->repair_status_color, false); ?>;">
							<?php echo e($sell->repair_status, false); ?>

						</span>
					</div>
					<div class="col-md-6">
						<strong>
							<?php echo e(__('lang_v1.due_date'), false); ?>:
						</strong>
						<?php if(!empty($sell->delivery_date)): ?>
							<?php echo e(\Carbon::parse($sell->delivery_date)->toDayDateTimeString(), false); ?>

						<?php endif; ?>
					</div>
				</div>
				<div class="row mt-10">
					<div class="col-md-12 col-xs-12">
						<strong>
							<span><?php echo e(__('repair::lang.activities'), false); ?>:</span>
						</strong>
						<?php if ($__env->exists('repair::customer_repair.repair_activities', ['activities' => $sell['activities']])) echo $__env->make('repair::customer_repair.repair_activities', ['activities' => $sell['activities']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

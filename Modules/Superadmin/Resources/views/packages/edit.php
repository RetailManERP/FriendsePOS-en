
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.packages'); ?> <small><?php echo app('translator')->get('superadmin::lang.edit_package'); ?></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>


<!-- Main content -->
<section class="content">
	<?php echo Form::open(['route' => ['packages.update', $packages->id], 'method' => 'put', 'id' => 'edit_package_form']); ?>

	<div class="box box-primary">
		<div class="box-body">

	    	<div class="row">
				
				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('name', __('lang_v1.name').':'); ?>

						<?php echo Form::text('name',$packages->name, ['class' => 'form-control', 'required']); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('description', __('superadmin::lang.description').':'); ?>

						<?php echo Form::text('description', $packages->description, ['class' => 'form-control', 'required']); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('location_count', __('superadmin::lang.location_count').':'); ?>

						<?php echo Form::number('location_count', $packages->location_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('user_count', __('superadmin::lang.user_count').':'); ?>

						<?php echo Form::number('user_count', $packages->user_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('employee_count', __('superadmin::lang.employee_count').':'); ?>

						<?php echo Form::number('employee_count', $packages->employee_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('workstation_count', __('superadmin::lang.workstation_count').':'); ?>

						<?php echo Form::number('workstation_count', $packages->workstation_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('product_count', __('superadmin::lang.product_count').':'); ?>

						<?php echo Form::number('product_count', $packages->product_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('invoice_count', __('superadmin::lang.invoice_count').':'); ?>

						<?php echo Form::number('invoice_count', $packages->invoice_count, ['class' => 'form-control', 'required', 'min' => 0]); ?>


						<span class="help-block">
							<?php echo app('translator')->get('superadmin::lang.infinite_help'); ?>
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('interval', __('superadmin::lang.interval').':'); ?>


						<?php echo Form::select('interval', $intervals, $packages->interval, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('interval_count	', __('superadmin::lang.interval_count').':'); ?>

						<?php echo Form::number('interval_count', $packages->interval_count, ['class' => 'form-control', 'required']); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('trial_days	', __('superadmin::lang.trial_days').':'); ?>

						<?php echo Form::number('trial_days', $packages->trial_days, ['class' => 'form-control', 'required', 'min' => 0]); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('price', __('superadmin::lang.price').':'); ?>

						<?php echo Form::text('price', $packages->price, ['class' => 'form-control input_number', 'required']); ?>

					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('sort_order	', __('superadmin::lang.sort_order').':'); ?>

						<?php echo Form::number('sort_order', $packages->sort_order, ['class' => 'form-control', 'required']); ?>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('is_private', 1, $packages->is_private, ['class' => 'form-check-input']); ?>

                        <?php echo e(__('superadmin::lang.private_superadmin_only'), false); ?>

					</label>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('is_one_time', 1, $packages->is_one_time, ['class' => 'form-check-input']); ?>

                        <?php echo e(__('superadmin::lang.one_time_only_subscription'), false); ?>

					</label>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('enable_custom_link', 1, $packages->enable_custom_link, ['class' => 'form-check-input', 'id' => 'enable_custom_link']); ?>

                        <?php echo e(__('superadmin::lang.enable_custom_subscription_link'), false); ?>

					</label>
					</div>
				</div>
				<div id="custom_link_div" <?php if(empty($packages->enable_custom_link)): ?> class="hide" <?php endif; ?>>
					<div class="col-sm-4">
						<div class="form-group">
							<?php echo Form::label('custom_link', __('superadmin::lang.custom_link').':'); ?>

							<?php echo Form::text('custom_link', $packages->custom_link, ['class' => 'form-control']); ?>

						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<?php echo Form::label('custom_link_text', __('superadmin::lang.custom_link_text').':'); ?>

							<?php echo Form::text('custom_link_text', $packages->custom_link_text, ['class' => 'form-control']); ?>

						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module => $module_permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $__currentLoopData = $module_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$value = isset($packages->custom_permissions[$permission['name']]) ? $packages->custom_permissions[$permission['name']] : false;
					?>
					    <div class="col-sm-3">
                        <?php if(isset($permission['field_type']) && in_array($permission['field_type'], ['number', 'input'])): ?>
						<div class="form-group">
							<?php echo Form::label("custom_permissions[$permission[name]]", $permission['label'].':'); ?> 
                            <?php if(isset($permission['tooltip'])): ?>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . $permission['tooltip'] . '"></i>';
                }
            ?>
                            <?php endif; ?>
                            
							<?php echo Form::text("custom_permissions[$permission[name]]", $value, ['class' => 'form-control', 'type' => $permission['field_type']]); ?> 
						</div>
                        <?php else: ?>
                        <div class="form-check">
						<label class="form-check-label">
<?php echo Form::checkbox("custom_permissions[$permission[name]]", 1, $value, ['class' => 'form-check-input']); ?>

	                        <?php echo e($permission['label'], false); ?>

						</label>
						</div>
                        <?php endif; ?>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<div class="col-sm-3 ">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('is_active', 1, $packages->is_active, ['class' => 'form-check-input']); ?>

                        <?php echo e(__('superadmin::lang.is_active'), false); ?>

					</label>
					</div>
				</div>
				<div class="col-sm-3 ">
					<div class="form-check">
						<label class="form-check-label">
<?php echo Form::checkbox('mark_package_as_popular', 1, $packages->mark_package_as_popular, ['class' => 'form-check-input']); ?>

							<?php echo e(__('superadmin::lang.mark_package_as_popular'), false); ?>

						</label>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('price', __('superadmin::lang.only_for_businesses').':'); ?>

						<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('superadmin::lang.tooltip_only_for_businesses') . '"></i>';
                }
            ?>
                        <?php echo Form::select('businesses[]', $businesses, json_decode($packages->businesses), [
                            'class' => 'form-control select2',
                            'multiple',
                        ]); ?>

					</div>
				</div>	
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('update_subscriptions', 1, false, ['class' => 'form-check-input']); ?>

                        <?php echo e(__('superadmin::lang.update_existing_subscriptions'), false); ?>

					</label>
					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('superadmin::lang.update_existing_subscriptions_tooltip') . '"></i>';
                }
            ?>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form#edit_package_form').validate();
		});
		$('#enable_custom_link').on('change', function(event){
		   if ($(this).is(':checked')) {
		       $("div#custom_link_div").removeClass('hide');
		   } else {
		       $("div#custom_link_div").addClass('hide');
		   }
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
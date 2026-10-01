
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages')); ?>

<?php $__env->startSection('css'); ?>
<style>
	.pkg-admin-card {
		background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
		padding: 1.5rem; transition: transform .2s, box-shadow .2s;
		display: flex; flex-direction: column; height: 100%;
	}
	.pkg-admin-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.07); }
	.pkg-admin-card.pkg-popular { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99,102,241,.12); }
	.pkg-admin-card .pkg-header { text-align: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9; }
	.pkg-admin-card .pkg-header h4 { font-weight: 700; color: #1e293b; margin: 0 0 .35rem; font-size: 1.1rem; }
	.pkg-admin-card .pkg-badges { display: flex; gap: .35rem; justify-content: center; flex-wrap: wrap; margin-bottom: .5rem; }
	.pkg-admin-card .pkg-badges .badge { font-size: .68rem; padding: .2rem .5rem; border-radius: 999px; font-weight: 600; }
	.pkg-admin-card .pkg-price { font-size: 1.5rem; font-weight: 700; color: #6366f1; }
	.pkg-admin-card .pkg-price small { font-size: .75rem; color: #94a3b8; font-weight: 500; }
	.pkg-admin-card .pkg-features { flex: 1; margin-bottom: 1rem; }
	.pkg-admin-card .pkg-features .feat-row { display: flex; align-items: center; gap: .5rem; padding: .3rem 0; font-size: .85rem; color: #475569; }
	.pkg-admin-card .pkg-features .feat-row i { color: #10b981; font-size: .7rem; width: 16px; text-align: center; }
	.pkg-admin-card .pkg-features .feat-row .feat-val { font-weight: 600; color: #1e293b; }
	.pkg-admin-card .pkg-stats { display: flex; gap: 1rem; justify-content: center; padding: .75rem 0; border-top: 1px solid #f1f5f9; margin-bottom: .75rem; }
	.pkg-admin-card .pkg-stats .stat { text-align: center; }
	.pkg-admin-card .pkg-stats .stat .stat-val { font-size: 1.1rem; font-weight: 700; color: #1e293b; display: block; }
	.pkg-admin-card .pkg-stats .stat .stat-lbl { font-size: .68rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .5px; }
	.pkg-admin-card .pkg-actions { display: flex; gap: .5rem; justify-content: center; }
	.pkg-admin-card .pkg-actions .btn { font-size: .78rem; border-radius: .5rem; }
	.pkg-admin-card .pkg-desc { font-size: .8rem; color: #64748b; text-align: center; margin-top: auto; padding-top: .5rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
		<h1><?php echo app('translator')->get('superadmin::lang.packages'); ?> <small><?php echo app('translator')->get('superadmin::lang.all_packages'); ?></small></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="row mb-3">
		<div class="col-md-8 col-sm-8">
			<form method="GET" action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'index']), false); ?>" id="package-filter-form">
				<div class="row g-2">
					<div class="col-md-5">
						<?php echo Form::select('business_id', $businesses, request('business_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('business.business_name'), 'id' => 'business_id_filter']); ?>

					</div>
					<div class="col-md-7">
						<div class="input-group">
							<input type="text" name="search" id="package-search" class="form-control" placeholder="<?php echo app('translator')->get('messages.search'); ?>" value="<?php echo e(request('search'), false); ?>" aria-label="<?php echo app('translator')->get('messages.search'); ?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4 col-sm-4 text-end">
			<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'create']), false); ?>" 
				class="btn btn-primary">
				<i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
		</div>
	</div>

	<div class="row g-3">
		<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$show_employee_limit = !empty($package->custom_permissions['essentials_module']);
			?>
			<div class="col-xl-4 col-md-6">
				<div class="pkg-admin-card <?php if($package->mark_package_as_popular == 1): ?> pkg-popular <?php endif; ?>">
					<div class="pkg-header">
						<div class="pkg-badges">
							<?php if($package->mark_package_as_popular == 1): ?>
								<span class="badge" style="background:#eef2ff;color:#6366f1;">
									<i class="fas fa-star me-1"></i><?php echo app('translator')->get('superadmin::lang.popular'); ?>
								</span>
							<?php endif; ?>
							<?php if($package->is_active == 1): ?>
								<span class="badge" style="background:#ecfdf5;color:#059669;"><?php echo app('translator')->get('superadmin::lang.active'); ?></span>
							<?php else: ?>
								<span class="badge" style="background:#fef2f2;color:#dc2626;"><?php echo app('translator')->get('superadmin::lang.inactive'); ?></span>
							<?php endif; ?>
							<?php if($package->is_private): ?>
								<span class="badge" style="background:#fffbeb;color:#d97706;">
									<i class="fas fa-lock me-1"></i><?php echo app('translator')->get('superadmin::lang.private_superadmin_only'); ?>
								</span>
							<?php endif; ?>
							<?php if($package->is_one_time): ?>
								<span class="badge" style="background:#ecfeff;color:#0891b2;">
									<i class="fas fa-dot-circle me-1"></i><?php echo app('translator')->get('superadmin::lang.one_time_only_subscription'); ?>
								</span>
							<?php endif; ?>
						</div>
						<h4><?php echo e($package->name, false); ?></h4>
						<div class="pkg-price">
							<?php if($package->price != 0): ?>
								<span class="display_currency" data-currency_symbol="true"><?php echo e($package->price, false); ?></span>
								<small>/ <?php echo e($package->interval_count, false); ?> <?php echo e(__('lang_v1.' . $package->interval), false); ?></small>
							<?php else: ?>
								<?php echo app('translator')->get('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . __('lang_v1.' . $package->interval)]); ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="pkg-features">
						<div class="feat-row">
							<i class="fas fa-map-marker-alt"></i>
							<span class="feat-val"><?php echo e($package->location_count == 0 ? __('superadmin::lang.unlimited') : $package->location_count, false); ?></span>
							<?php echo app('translator')->get('business.business_locations'); ?>
						</div>
						<div class="feat-row">
							<i class="fas fa-users"></i>
							<span class="feat-val"><?php echo e($package->user_count == 0 ? __('superadmin::lang.unlimited') : $package->user_count, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.users'); ?>
						</div>
						<?php if($show_employee_limit): ?>
						<div class="feat-row">
							<i class="fas fa-user-tie"></i>
							<span class="feat-val"><?php echo e($package->employee_count == 0 ? __('superadmin::lang.unlimited') : $package->employee_count, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.employee_count'); ?>
						</div>
						<?php endif; ?>
						<?php if(isset($package->workstation_count)): ?>
						<div class="feat-row">
							<i class="fas fa-desktop"></i>
							<span class="feat-val"><?php echo e($package->workstation_count == 0 ? __('superadmin::lang.unlimited') : $package->workstation_count, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.workstations'); ?>
						</div>
						<?php endif; ?>
						<div class="feat-row">
							<i class="fas fa-cubes"></i>
							<span class="feat-val"><?php echo e($package->product_count == 0 ? __('superadmin::lang.unlimited') : $package->product_count, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.products'); ?>
						</div>
						<div class="feat-row">
							<i class="fas fa-file-invoice"></i>
							<span class="feat-val"><?php echo e($package->invoice_count == 0 ? __('superadmin::lang.unlimited') : $package->invoice_count, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.invoices'); ?>
						</div>
						<?php if($package->trial_days != 0): ?>
						<div class="feat-row">
							<i class="fas fa-calendar-day"></i>
							<span class="feat-val"><?php echo e($package->trial_days, false); ?></span>
							<?php echo app('translator')->get('superadmin::lang.trial_days'); ?>
						</div>
						<?php endif; ?>
						<?php if(!empty($package->custom_permissions)): ?>
							<?php $__currentLoopData = $package->custom_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(isset($permission_formatted[$permission])): ?>
								<?php if(!empty($permission_numeric[$permission])): ?>
									<?php if($value !== '' && $value !== null): ?>
									<div class="feat-row">
										<i class="fas fa-layer-group"></i>
										<span class="feat-val"><?php echo e(($value === 0 || $value === '0') ? __('superadmin::lang.unlimited') : $value, false); ?></span>
										<?php echo e($permission_formatted[$permission], false); ?>

									</div>
									<?php endif; ?>
								<?php elseif(!empty($value)): ?>
								<div class="feat-row">
									<i class="fas fa-check"></i>
									<?php echo e($permission_formatted[$permission], false); ?>

								</div>
								<?php endif; ?>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>

					<div class="pkg-stats">
						<div class="stat">
							<span class="stat-val"><?php echo e(max($subscriber_counts[$package->id] ?? 0, $assigned_business_counts[$package->id] ?? 0), false); ?></span>
							<span class="stat-lbl"><?php echo app('translator')->get('superadmin::lang.subscribers'); ?></span>
						</div>
						<div class="stat">
							<span class="stat-val"><span class="display_currency" data-currency_symbol="true"><?php echo e($package_revenue[$package->id] ?? 0, false); ?></span></span>
							<span class="stat-lbl"><?php echo app('translator')->get('superadmin::lang.revenue'); ?></span>
						</div>
					</div>

					<div class="pkg-actions">
						<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'edit'], [$package->id]), false); ?>" class="btn btn-outline-primary btn-sm" title="<?php echo app('translator')->get('messages.edit'); ?>">
							<i class="fas fa-edit me-1"></i> <?php echo app('translator')->get('messages.edit'); ?>
						</a>
						<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'destroy'], [$package->id]), false); ?>" class="btn btn-outline-danger btn-sm link_confirmation" title="<?php echo app('translator')->get('messages.delete'); ?>">
							<i class="fas fa-trash me-1"></i> <?php echo app('translator')->get('messages.delete'); ?>
						</a>
					</div>

					<?php if($package->description): ?>
					<div class="pkg-desc"><?php echo e($package->description, false); ?></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>

	<div class="row mt-3">
		<div class="col-md-12">
			<?php echo e($packages->appends(request()->only('search', 'business_id'))->links(), false); ?>

		</div>
	</div>

    <div class="modal fade brands_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
(function() {
	var form = document.getElementById('package-filter-form');
	if (!form) return;

	// Auto-submit when business filter changes
	$('#business_id_filter').on('change', function() {
		form.submit();
	});
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
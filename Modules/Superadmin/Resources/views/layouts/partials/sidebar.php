<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
	<li class="bg-red treeview <?php echo e(in_array($request->segment(1), ['superadmin']) ? 'active active-sub' : '', false); ?>">
	    <a href="#">
	        <i class="fa fa-building"></i>
	        <span class="title"><?php echo app('translator')->get('superadmin::lang.superadmin'); ?></span>
	        <span class="float-end-container">
	            <i class="fa fa-angle-left float-end"></i>
	        </span>
	    </a>

	    <ul class="treeview-menu">
			<li class="<?php echo e(empty($request->segment(2)) ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']), false); ?>">
					<i class="fa fa-tachometer-alt"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.superadmin'); ?>
					</span>
			  	</a>
			</li>

			<li class="<?php echo e($request->segment(2) == 'business' ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']), false); ?>">
					<i class="fa fa-store"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.all_business'); ?>
					</span>
			  	</a>
			</li>
			<!-- superadmin subscription -->
			<li class="<?php echo e($request->segment(2) == 'superadmin-subscription' ? 'active active-sub' : '', false); ?>">
			<a href = "<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'index']), false); ?>"><i class="fa fa-sync"></i>
			<span class="title"><?php echo app('translator')->get('superadmin::lang.subscription'); ?></span>
			</a>
			</li>

			<li class="<?php echo e($request->segment(2) == 'packages' ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'index']), false); ?>">
					<i class="fa fa-credit-card"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.subscription_packages'); ?>
					</span>
			  	</a>
			</li>

			<li class="<?php echo e($request->segment(2) == 'coupons' ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'index']), false); ?>">
					<i class="fa fa-ticket-alt"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.coupons'); ?>
					</span>
			  	</a>
			</li>

			

			<li class="<?php echo e($request->segment(2) == 'settings' ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class, 'edit']), false); ?>">
					<i class="fa fa-cogs"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?>
					</span>
			  	</a>
			</li>

			<li class="<?php echo e($request->segment(2) == 'communicator' ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'index']), false); ?>">
					<i class="fa fa-headset"></i>
					<span class="title">
						<?php echo app('translator')->get('superadmin::lang.communicator'); ?>
					</span>
			  	</a>
			</li>

        </ul>
	</li>
<?php endif; ?>

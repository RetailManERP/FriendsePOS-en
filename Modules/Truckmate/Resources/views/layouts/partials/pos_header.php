<?php if($__is_truckmate_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("truckmate.create")): ?>
		<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']). '?sub_type=truckmate', false); ?>" title="<?php echo e(__('truckmate::lang.add_truckmate'), false); ?>" data-toggle="tooltip" data-placement="bottom" class="btn bg-purple btn-flat m-6 btn-xs m-5 pull-right">
			<i class="fa fa-wrench fa-lg"></i>
			<strong><?php echo app('translator')->get('truckmate::lang.truckmate'); ?></strong>
		</a>
	<?php endif; ?>
<?php endif; ?>
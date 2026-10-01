<?php if($__is_truckmate_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("truckmate.create")): ?>
		<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']). '?sub_type=truckmate', false); ?>" title="<?php echo e(__('truckmate::lang.add_truckmate'), false); ?>" data-toggle="tooltip" data-placement="bottom" class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
			<i class="fa fa-wrench fa-lg"></i><span class='hidden-xs'>
			<strong><?php echo app('translator')->get('truckmate::lang.truckmate'); ?></strong>
		</a>
	<?php endif; ?>
<?php endif; ?>
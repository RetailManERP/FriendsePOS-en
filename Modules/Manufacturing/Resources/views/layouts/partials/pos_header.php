<?php if($__is_mfg_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("manufacturing.access_production")): ?>
		<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'create']), false); ?>" title="<?php echo e(__('manufacturing::lang.add_production'), false); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" class="btn bg-purple btn-sm pos-slide-menu__item">
			<i class="fa fa-industry"></i>
			<span><?php echo e(__('manufacturing::lang.add_production'), false); ?></span>
		</a>
	<?php endif; ?>
<?php endif; ?>

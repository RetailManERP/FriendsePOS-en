<?php if($__is_mfg_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("manufacturing.access_production")): ?>
		<li class="nav-item">
			<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'create']), false); ?>" title="<?php echo e(__('manufacturing::lang.add_production'), false); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" class="nav-icon-btn">
				<i class="fas fa-industry"></i>
			</a>
		</li>
	<?php endif; ?>
<?php endif; ?>

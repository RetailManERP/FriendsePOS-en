<?php if($__is_repair_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("repair.create")): ?>
		<li class="nav-item">
			<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']). '?sub_type=repair', false); ?>" title="<?php echo e(__('repair::lang.add_repair'), false); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" class="nav-icon-btn">
				<i class="fas fa-wrench"></i>
			</a>
		</li>
	<?php endif; ?>
<?php endif; ?>

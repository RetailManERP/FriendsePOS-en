<?php if($__is_repair_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("repair.create")): ?>
		<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']). '?sub_type=repair', false); ?>" title="<?php echo e(__('repair::lang.add_repair'), false); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" class="btn bg-purple btn-sm">
			<i class="fa fa-wrench m-auto"></i>
		</a>
	<?php endif; ?>
<?php endif; ?>

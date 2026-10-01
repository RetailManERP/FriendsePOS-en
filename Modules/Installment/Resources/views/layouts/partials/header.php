<?php if($__is_repair_enabled): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("repair.create")): ?>
		<a href="<?php echo e(action('SellPosController@create'). '?sub_type=repair', false); ?>" title="<?php echo e(__('repair::lang.add_repair'), false); ?>" data-bs-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat m-8 btn-sm mt-10 float-start">
			<i class="fa fa-wrench fa-lg"></i>
			<strong><?php echo app('translator')->get('repair::lang.repair'); ?></strong>
		</a>
	<?php endif; ?>
<?php endif; ?>

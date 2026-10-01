<div class="col-md-12">
	<form action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id]), false); ?>" method="POST">
	 	<?php echo e(csrf_field(), false); ?>

	 	<input type="hidden" name="gateway" value="<?php echo e($k, false); ?>">
		 <input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
		 <input type="hidden" name="coupon_code" value="<?php echo e(request()->get('code') ?? null, false); ?>">

	 	<button type="submit" class="btn btn-success"> <i class="fas fa-handshake"></i> <?php echo e($v, false); ?></button>
	</form>
	<p class="help-block"><?php echo app('translator')->get('superadmin::lang.offline_pay_helptext'); ?></p>
	<p class="help-block"><?php echo nl2br($offline_payment_details) ?? ''; ?></p>
</div>

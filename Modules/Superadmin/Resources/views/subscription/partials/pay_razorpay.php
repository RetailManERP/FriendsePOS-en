<div class="col-md-12">

	<form action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id]), false); ?>" method="POST">
		<!-- Note that the amount is in paise -->
		<script
		    src="https://checkout.razorpay.com/v1/checkout.js"
		    data-key="<?php echo e(env('RAZORPAY_KEY_ID'), false); ?>"
		    data-amount="<?php echo e($package->price*100, false); ?>"
		    data-buttontext="Pay with Razorpay"
		    data-name="<?php echo e(env('APP_NAME'), false); ?>"
		    data-description="<?php echo e($package->name, false); ?>"
		    data-theme.color="#3c8dbc"
		></script>
		<?php echo e(csrf_field(), false); ?>

		<input type="hidden" name="gateway" value="<?php echo e($k, false); ?>">
		<input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
		<input type="hidden" name="coupon_code" value="<?php echo e(request()->get('code') ?? null, false); ?>">
	</form>
</div>

<?php
$code = strtolower($system_currency->code);
?>

<div class="col-md-12">
	<form action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id]), false); ?>" method="POST">
	 	<?php echo e(csrf_field(), false); ?>

	 	<input type="hidden" name="gateway" value="<?php echo e($k, false); ?>">
	 	<input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
		<input type="hidden" name="coupon_code" value="<?php echo e(request()->get('code') ?? null, false); ?>">
		<script
		        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		        data-key="<?php echo e(env('STRIPE_PUB_KEY'), false); ?>"
		        data-amount="<?php if(in_array($code, ['bif','clp','djf','gnf','jpy','kmf','krw','mga','pyg','rwf','ugx','vnd','vuv','xaf','xof','xpf'])): ?> <?php echo e($package->price, false); ?> <?php else: ?> <?php echo e($package->price*100, false); ?> <?php endif; ?>"
		        data-name="<?php echo e(env('APP_NAME'), false); ?>"
		        data-description="<?php echo e($package->name, false); ?>"
		        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
		        data-locale="auto"
		        data-currency="<?php echo e($code, false); ?>">
		</script>
	</form>
</div>

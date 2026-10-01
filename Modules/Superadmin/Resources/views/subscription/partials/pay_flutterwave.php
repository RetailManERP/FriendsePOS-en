<div class="col-md-12">
    <?php if($system_currency->country == 'Nigeria'): ?>
        <?php
            $currency_code = 'NGN';
        ?>
    <?php elseif($system_currency->country == 'Ghana'): ?>
        <?php
            $currency_code = 'GHS';
        ?>
    <?php else: ?>
        <?php
            $currency_code = $system_currency->code
        ?>
    <?php endif; ?>
    <form>
        <script src="https://checkout.flutterwave.com/v3.js"></script>
        <button type="button" class="btn btn-sm text-white btn-warning" onClick="makePayment()">
            <i class="fas fa-money-bill-alt text-white"></i>
            <?php echo e($v, false); ?>

        </button>
    </form>
</div>
<script>
    function makePayment() {
        FlutterwaveCheckout({
            public_key: "<?php echo e(env('FLUTTERWAVE_PUBLIC_KEY'), false); ?>",
            tx_ref: "<?php echo e(Str::random(15), false); ?>", //generate randomly
            amount: <?php echo e($package->price, false); ?>,
            currency: "<?php echo e($currency_code, false); ?>",
            payment_options: "card, mobilemoneyghana, ussd",
            redirect_url: "<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'postFlutterwavePaymentCallback']), false); ?>",// specified redirect URL
            meta: {
                package_id: "<?php echo e($package->id, false); ?>",
                gateway: "<?php echo e($v, false); ?>",
                business_id: "<?php echo e($user['business_id'], false); ?>",
                user_id: "<?php echo e($user['id'], false); ?>",
                coupon_code: "<?php echo e(request()->get('code') ?? null, false); ?>",
            },
            customer: {
                email: "<?php echo e($user['email'], false); ?>"
            },
            customizations: {
                title: "<?php echo e(Session::get('business.name'), false); ?>",
                logo: "<?php echo e(asset('uploads/business_logos/'.Session::get('business.logo')), false); ?>",
            },
        });
    }
</script>

<div class="col-md-12">
    <form method="POST" action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'getRedirectToPaystack']), false); ?>">
        <?php echo e(csrf_field(), false); ?>

        <!-- customer details -->
        <input type="hidden" name="email" value="<?php echo e($user['email'], false); ?>">

        <!-- order info -->
        <input type="hidden" name="amount" value="<?php echo e($package->price*100, false); ?>">
        <input type="hidden" name="quantity" value="1">

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


        <input type="hidden" name="currency" value="<?php echo e($currency_code, false); ?>"> 

        <!-- additional info -->
        <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['package_id' => $package->id, 'gateway' => $v, 'business_id' => $user['business_id'], 'user_id' => $user['id'], 'coupon_code' => request()->get('code') ?? null ]), false); ?>" > 

        <!-- transaction ref -->
        <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef(), false); ?>"> 

        <button class="btn btn-sm text-white" type="submit" style="background: #08A5DB;border-color: #08A5DB;">
            <i class="fas fa-align-left text-white"></i>
            <?php echo e($v, false); ?>

        </button>
    </form>
</div>

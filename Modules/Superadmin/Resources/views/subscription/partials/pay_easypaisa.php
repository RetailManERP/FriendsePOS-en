<div class="col-md-12">
    <form method="POST" action="<?php echo e(route('easypaisa.redirect'), false); ?>">
        <?php echo e(csrf_field(), false); ?>

        <input type="hidden" name="package_id" value="<?php echo e($package->id, false); ?>">
        <input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
        <input type="hidden" name="coupon_code" value="<?php echo e(request()->get('code') ?? '', false); ?>">
        <button class="btn btn-sm text-white" type="submit" style="background: #00a652; border-color: #00a652;">
            <i class="fas fa-wallet text-white"></i>
            <?php echo e($v, false); ?>

        </button>
    </form>
</div>

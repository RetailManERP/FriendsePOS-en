<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-12">
            <h4><i class="fa fa-shopping-cart"></i> <?php echo app('translator')->get('woocommerce::lang.order_webhooks'); ?></h4>
            <hr>
        </div>
        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.order_created'); ?></h4>
        </div>
    	<div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('woocommerce_wh_oc_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

            	<?php echo Form::text('woocommerce_wh_oc_secret', !empty($business->woocommerce_wh_oc_secret) ? $business->woocommerce_wh_oc_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'orderCreated'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.order_updated'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_ou_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_ou_secret', !empty($business->woocommerce_wh_oc_secret) ? $business->woocommerce_wh_ou_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'orderUpdated'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.order_deleted'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_od_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_od_secret', !empty($business->woocommerce_wh_oc_secret) ? $business->woocommerce_wh_od_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'orderDeleted'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.order_restored'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_or_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_or_secret', !empty($business->woocommerce_wh_oc_secret) ? $business->woocommerce_wh_or_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'orderRestored'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        
        <div class="col-xs-12">
            <br>
            <h4><i class="fa fa-cubes"></i> <?php echo app('translator')->get('woocommerce::lang.product_webhooks'); ?></h4>
            <hr>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.product_created'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_pc_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_pc_secret', !empty($business->woocommerce_wh_pc_secret) ? $business->woocommerce_wh_pc_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'productCreated'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.product_updated'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_pu_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_pu_secret', !empty($business->woocommerce_wh_pu_secret) ? $business->woocommerce_wh_pu_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'productUpdated'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('woocommerce::lang.product_deleted'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_wh_pd_secret',  __('woocommerce::lang.webhook_secret') . ':'); ?>

                <?php echo Form::text('woocommerce_wh_pd_secret', !empty($business->woocommerce_wh_pd_secret) ? $business->woocommerce_wh_pd_secret : null, ['class' => 'form-control','placeholder' => __('woocommerce::lang.webhook_secret')]); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong><?php echo app('translator')->get('woocommerce::lang.webhook_delivery_url'); ?>:</strong>
                <p><?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController::class, 'productDeleted'], ['business_id' => session()->get('business.id')]), false); ?></p>
            </div>
        </div>

    </div>
</div>

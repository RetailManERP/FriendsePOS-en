

<?php $__env->startSection('title', 'Shopify Customer'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo e(trim($customer->first_name . ' ' . $customer->last_name) ?: 'Shopify Customer', false); ?> <small>Customer details</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Customer Details</h3>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyCustomerController::class, 'index']), false); ?>" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Shopify ID</dt><dd><?php echo e($customer->shopify_customer_id, false); ?></dd>
                <dt>Store</dt><dd><?php echo e($customer->store->shop_name ?? '-', false); ?></dd>
                <dt>Email</dt><dd><?php echo e($customer->email ?: '-', false); ?></dd>
                <dt>Phone</dt><dd><?php echo e($customer->phone ?: '-', false); ?></dd>
                <dt>Location</dt><dd><?php echo e(trim(($customer->state ?: '') . ' ' . ($customer->country ?: '')) ?: '-', false); ?></dd>
                <dt>Total Orders</dt><dd><?php echo e($customer->total_orders, false); ?></dd>
                <dt>Total Spent</dt><dd><?php echo e(number_format((float) $customer->total_spent, 2), false); ?></dd>
                <dt>Synced</dt><dd><?php echo e(optional($customer->synced_at)->toDayDateTimeString() ?? 'Never', false); ?></dd>
            </dl>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Orders</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $customer->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>#<?php echo e($order->order_number, false); ?></td>
                                <td><?php echo e($order->financial_status ?: '-', false); ?></td>
                                <td><?php echo e($order->currency, false); ?> <?php echo e(number_format((float) $order->total_price, 2), false); ?></td>
                                <td><?php echo e(optional($order->order_date)->toDateString() ?? '-', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="4" class="text-center text-muted">No orders found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
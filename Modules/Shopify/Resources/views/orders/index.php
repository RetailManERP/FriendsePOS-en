

<?php $__env->startSection('title', 'Shopify Orders'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Shopify Orders <small>Orders imported from connected stores</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Orders</h3>
            <div class="box-tools">
                <form class="form-inline" method="GET" action="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyOrderController::class, 'index']), false); ?>">
                    <input type="text" name="search" value="<?php echo e(request('search'), false); ?>" class="form-control input-sm" placeholder="Order or email">
                    <select name="status" class="form-control input-sm">
                        <option value="">All statuses</option>
                        <?php $__currentLoopData = ['fulfilled', 'partial', 'unfulfilled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status, false); ?>" <?php if(request('status') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status), false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Store</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Fulfillment</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>#<?php echo e($order->order_number, false); ?></td>
                                <td><?php echo e($order->store->shop_name ?? '-', false); ?></td>
                                <td><?php echo e($order->customer->email ?? '-', false); ?></td>
                                <td><?php echo e($order->financial_status ?: '-', false); ?></td>
                                <td><?php echo e($order->fulfillment_status ?: '-', false); ?></td>
                                <td><?php echo e($order->currency, false); ?> <?php echo e(number_format((float) $order->total_price, 2), false); ?></td>
                                <td><?php echo e(optional($order->order_date)->toDateString() ?? '-', false); ?></td>
                                <td>
                                    <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyOrderController::class, 'show'], $order->id), false); ?>" class="btn btn-xs btn-primary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="8" class="text-center text-muted">No Shopify orders found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($orders->appends(request()->query())->links(), false); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('title', 'Shopify Order'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Order #<?php echo e($order->order_number, false); ?> <small>Shopify order details</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Order Details</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-success btn-sm convert-order" data-id="<?php echo e($order->id, false); ?>">
                    <i class="fa fa-exchange"></i> Convert to POS Sale
                </button>
                <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyOrderController::class, 'index']), false); ?>" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Shopify ID</dt><dd><?php echo e($order->shopify_order_id, false); ?></dd>
                <dt>Store</dt><dd><?php echo e($order->store->shop_name ?? '-', false); ?></dd>
                <dt>Customer</dt><dd><?php echo e($order->customer->email ?? '-', false); ?></dd>
                <dt>Financial Status</dt><dd><?php echo e($order->financial_status ?: '-', false); ?></dd>
                <dt>Fulfillment Status</dt><dd><?php echo e($order->fulfillment_status ?: '-', false); ?></dd>
                <dt>Total</dt><dd><?php echo e($order->currency, false); ?> <?php echo e(number_format((float) $order->total_price, 2), false); ?></dd>
                <dt>Order Date</dt><dd><?php echo e(optional($order->order_date)->toDayDateTimeString() ?? '-', false); ?></dd>
            </dl>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Line Items</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Mapped Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $order->lineItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php echo e($item->title, false); ?></td>
                                <td><?php echo e($item->quantity, false); ?></td>
                                <td><?php echo e($item->price, false); ?></td>
                                <td><?php echo e($item->total_discount, false); ?></td>
                                <td><?php echo e($item->product->title ?? '-', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="5" class="text-center text-muted">No line items found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    $('.convert-order').on('click', function () {
        var btn = $(this);
        btn.prop('disabled', true);
        $.post('<?php echo e(url("shopify/orders/convert"), false); ?>/' + btn.data('id'), {_token: '<?php echo e(csrf_token(), false); ?>'})
            .done(function (response) {
                alert(response.message || 'Order converted');
            })
            .fail(function (xhr) {
                alert((xhr.responseJSON && xhr.responseJSON.message) || 'Conversion failed');
            })
            .always(function () {
                btn.prop('disabled', false);
            });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
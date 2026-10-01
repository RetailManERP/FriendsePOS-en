

<?php $__env->startSection('title', 'Shopify Product'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo e($product->title, false); ?> <small>Shopify product details</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Product Details</h3>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyProductController::class, 'index']), false); ?>" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Shopify ID</dt><dd><?php echo e($product->shopify_product_id, false); ?></dd>
                <dt>Store</dt><dd><?php echo e($product->store->shop_name ?? '-', false); ?></dd>
                <dt>Handle</dt><dd><?php echo e($product->handle, false); ?></dd>
                <dt>Vendor</dt><dd><?php echo e($product->vendor ?: '-', false); ?></dd>
                <dt>Type</dt><dd><?php echo e($product->product_type ?: '-', false); ?></dd>
                <dt>Status</dt><dd><?php echo e($product->status, false); ?></dd>
                <dt>Synced</dt><dd><?php echo e(optional($product->synced_at)->toDayDateTimeString() ?? 'Never', false); ?></dd>
            </dl>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Variants</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Variant</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Cost</th>
                            <th>Stock</th>
                            <th>Barcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php echo e($variant->title, false); ?></td>
                                <td><?php echo e($variant->sku ?: '-', false); ?></td>
                                <td><?php echo e($variant->price, false); ?></td>
                                <td><?php echo e($variant->cost, false); ?></td>
                                <td><?php echo e($variant->inventory_quantity, false); ?></td>
                                <td><?php echo e($variant->barcode ?: '-', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="6" class="text-center text-muted">No variants found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('title', 'Shopify Products'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Shopify Products <small>Products imported from connected stores</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Products</h3>
            <div class="box-tools">
                <form class="form-inline" method="GET" action="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyProductController::class, 'index']), false); ?>">
                    <input type="text" name="search" value="<?php echo e(request('search'), false); ?>" class="form-control input-sm" placeholder="Search products">
                    <select name="status" class="form-control input-sm">
                        <option value="">All statuses</option>
                        <?php $__currentLoopData = ['active', 'draft', 'archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <th>Product</th>
                            <th>Store</th>
                            <th>Vendor</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Variants</th>
                            <th>Synced</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($product->title, false); ?></strong><br>
                                    <small class="text-muted"><?php echo e($product->handle, false); ?></small>
                                </td>
                                <td><?php echo e($product->store->shop_name ?? '-', false); ?></td>
                                <td><?php echo e($product->vendor ?: '-', false); ?></td>
                                <td><?php echo e($product->product_type ?: '-', false); ?></td>
                                <td><span class="label label-info"><?php echo e($product->status, false); ?></span></td>
                                <td><?php echo e($product->variants->count(), false); ?></td>
                                <td><?php echo e(optional($product->synced_at)->diffForHumans() ?? 'Never', false); ?></td>
                                <td>
                                    <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyProductController::class, 'show'], $product->id), false); ?>" class="btn btn-xs btn-primary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">No Shopify products found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($products->appends(request()->query())->links(), false); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
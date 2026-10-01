
<?php $__env->startSection('title', 'Shopify Product Mappings'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Shopify Product Mappings
        <small>Map BitorePOS products to Shopify products</small>
    </h1>
</section>

<section class="content">
    <div class="box box-solid">
        <div class="box-header">
            <div class="box-tools">
                <form method="GET" class="form-inline">
                    <select name="store_id" class="form-control" onchange="this.form.submit()">
                        <option value="">All Stores</option>
                        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($store->id, false); ?>" <?php echo e($storeId == $store->id ? 'selected' : '', false); ?>>
                                <?php echo e($store->shop_name, false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>BitorePOS Product</th>
                        <th>Variation</th>
                        <th>Shopify Product ID</th>
                        <th>Shopify Variant ID</th>
                        <th>Inventory Item ID</th>
                        <th>Direction</th>
                        <th>Last Synced</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $mappings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e($mapping->product->name ?? 'N/A', false); ?></td>
                        <td><?php echo e($mapping->variation->name ?? 'Default', false); ?> (<?php echo e($mapping->variation->sub_sku ?? '', false); ?>)</td>
                        <td><code><?php echo e($mapping->shopify_product_id, false); ?></code></td>
                        <td><code><?php echo e($mapping->shopify_variant_id ?? '-', false); ?></code></td>
                        <td><code><?php echo e($mapping->shopify_inventory_item_id ?? '-', false); ?></code></td>
                        <td>
                            <span class="label label-<?php echo e($mapping->sync_direction == 'bidirectional' ? 'primary' : ($mapping->sync_direction == 'push' ? 'success' : 'info'), false); ?>">
                                <?php echo e(ucfirst($mapping->sync_direction), false); ?>

                            </span>
                        </td>
                        <td><?php echo e($mapping->last_synced_at ? $mapping->last_synced_at->diffForHumans() : 'Never', false); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('mappings.products.destroy', $mapping->id), false); ?>" style="display:inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="8" class="text-center">No product mappings found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php echo e($mappings->links(), false); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
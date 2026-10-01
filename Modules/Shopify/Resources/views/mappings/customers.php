
<?php $__env->startSection('title', 'Shopify Customer Mappings'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Shopify Customer Mappings
        <small>Map BitorePOS contacts to Shopify customers</small>
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
                        <th>BitorePOS Contact</th>
                        <th>Email</th>
                        <th>Shopify Customer ID</th>
                        <th>Store</th>
                        <th>Last Synced</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $mappings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e($mapping->contact->name ?? 'N/A', false); ?></td>
                        <td><?php echo e($mapping->contact->email ?? '-', false); ?></td>
                        <td><code><?php echo e($mapping->shopify_customer_id, false); ?></code></td>
                        <td><?php echo e($mapping->store->shop_name ?? '-', false); ?></td>
                        <td><?php echo e($mapping->last_synced_at ? $mapping->last_synced_at->diffForHumans() : 'Never', false); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="5" class="text-center">No customer mappings found</td>
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
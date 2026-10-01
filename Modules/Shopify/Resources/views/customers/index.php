

<?php $__env->startSection('title', 'Shopify Customers'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>Shopify Customers <small>Customers imported from connected stores</small></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Customers</h3>
            <div class="box-tools">
                <form class="form-inline" method="GET" action="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyCustomerController::class, 'index']), false); ?>">
                    <input type="text" name="search" value="<?php echo e(request('search'), false); ?>" class="form-control input-sm" placeholder="Search customers">
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Store</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e(trim($customer->first_name . ' ' . $customer->last_name) ?: '-', false); ?></strong><br>
                                    <small class="text-muted"><?php echo e($customer->email ?: '-', false); ?></small>
                                </td>
                                <td><?php echo e($customer->store->shop_name ?? '-', false); ?></td>
                                <td><?php echo e($customer->phone ?: '-', false); ?></td>
                                <td><?php echo e($customer->country ?: '-', false); ?></td>
                                <td><?php echo e($customer->total_orders, false); ?></td>
                                <td><?php echo e(number_format((float) $customer->total_spent, 2), false); ?></td>
                                <td>
                                    <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyCustomerController::class, 'show'], $customer->id), false); ?>" class="btn btn-xs btn-primary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="7" class="text-center text-muted">No Shopify customers found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($customers->appends(request()->query())->links(), false); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
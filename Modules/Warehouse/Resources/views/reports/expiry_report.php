
<?php $__env->startSection('title', __('warehouse::lang.expiry_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.expiry_report'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <form method="GET" action="<?php echo e(route('warehouse.reports.expiry'), false); ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('warehouse::lang.expiring_in_days', ['days' => '']); ?>:</label>
                        <input type="number" name="days" class="form-control" value="<?php echo e($days, false); ?>" min="1" max="365">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> <?php echo app('translator')->get('messages.filter'); ?></button>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.sku'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.expiry_date'); ?></th>
                    <th>Days Left</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $expiring_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <?php
                        $days_left = \Carbon\Carbon::parse($item->expiry_date)->diffInDays(now(), false);
                        $is_expired = \Carbon\Carbon::parse($item->expiry_date)->isPast();
                    ?>
                    <tr class="<?php echo e($is_expired ? 'bg-danger' : ($days_left <= 7 ? 'bg-warning' : ''), false); ?>">
                        <td><?php echo e($item->warehouse_name, false); ?></td>
                        <td>
                            <?php echo e($item->product_name, false); ?>

                            <?php if($item->variation_name && $item->variation_name !== 'DUMMY'): ?>
                                - <?php echo e($item->variation_name, false); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->sub_sku, false); ?></td>
                        <td><?php echo e($item->lot_number ?? '-', false); ?></td>
                        <td><?php echo e(number_format($item->quantity, 2), false); ?></td>
                        <td><?php echo e($item->expiry_date, false); ?></td>
                        <td>
                            <?php if($is_expired): ?>
                                <span class="text-danger font-bold">Expired</span>
                            <?php else: ?>
                                <?php echo e(abs($days_left), false); ?> days
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr><td colspan="7" class="text-center text-muted"><?php echo app('translator')->get('warehouse::lang.no_expiring_items'); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
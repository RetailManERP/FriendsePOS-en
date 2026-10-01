
<?php $__env->startSection('title', __('warehouse::lang.stock_summary_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.stock_summary_report'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.total_products'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.total_quantity'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.total_reserved'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.available'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $stock_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e($row->warehouse_name, false); ?></td>
                        <td><?php echo e($row->total_products, false); ?></td>
                        <td><?php echo e(number_format($row->total_quantity, 2), false); ?></td>
                        <td><?php echo e(number_format($row->total_reserved, 2), false); ?></td>
                        <td><?php echo e(number_format($row->total_quantity - $row->total_reserved, 2), false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
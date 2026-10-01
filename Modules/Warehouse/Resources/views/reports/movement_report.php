
<?php $__env->startSection('title', __('warehouse::lang.movement_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.movement_report'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <form method="GET" action="<?php echo e(route('warehouse.reports.movements'), false); ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('lang_v1.date_range'); ?>:</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo e($start_date, false); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo e($end_date, false); ?>">
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

        <h4><?php echo app('translator')->get('warehouse::lang.movements_by_type'); ?></h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.movement_type'); ?></th>
                    <th>Count</th>
                    <th><?php echo app('translator')->get('warehouse::lang.total_quantity'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $movements_by_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo app('translator')->get('warehouse::lang.movement_' . $movement->type); ?></td>
                        <td><?php echo e($movement->count, false); ?></td>
                        <td><?php echo e(number_format($movement->total_qty, 2), false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr><td colspan="3" class="text-center text-muted"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
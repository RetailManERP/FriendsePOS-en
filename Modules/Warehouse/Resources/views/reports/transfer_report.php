
<?php $__env->startSection('title', __('warehouse::lang.transfer_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.transfer_report'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <form method="GET" action="<?php echo e(route('warehouse.reports.transfers'), false); ?>">
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

        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-aqua"><span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
                    <div class="info-box-content"><span class="info-box-text">Total</span><span class="info-box-number"><?php echo e($transfer_stats['total'], false); ?></span></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-green"><span class="info-box-icon"><i class="fas fa-check"></i></span>
                    <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('warehouse::lang.status_completed'); ?></span><span class="info-box-number"><?php echo e($transfer_stats['completed'], false); ?></span></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-yellow"><span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('warehouse::lang.status_pending'); ?></span><span class="info-box-number"><?php echo e($transfer_stats['pending'], false); ?></span></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-blue"><span class="info-box-icon"><i class="fas fa-truck"></i></span>
                    <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('warehouse::lang.status_in_transit'); ?></span><span class="info-box-number"><?php echo e($transfer_stats['in_transit'], false); ?></span></div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.reference_no'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.source_warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.destination_warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?></th>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(route('warehouse.transfers.show', $transfer->id), false); ?>"><?php echo e($transfer->reference_no, false); ?></a></td>
                        <td><?php echo e($transfer->source_name, false); ?></td>
                        <td><?php echo e($transfer->destination_name, false); ?></td>
                        <td>
                            <?php $badges = ['draft' => 'secondary', 'pending' => 'warning', 'in_transit' => 'info', 'partial' => 'primary', 'completed' => 'success', 'cancelled' => 'danger']; ?>
                            <span class="badge bg-<?php echo e($badges[$transfer->display_status] ?? 'secondary', false); ?>"><?php echo app('translator')->get('warehouse::lang.status_' . $transfer->display_status); ?></span>
                        </td>
                        <td><?php echo e(\Carbon\Carbon::parse($transfer->transaction_date)->format('Y-m-d'), false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
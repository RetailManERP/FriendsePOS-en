
<?php $__env->startSection('title', __('slaughterhouse::lang.slaughter_batch') . ' - ' . $batch->batch_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.slaughter_batch'); ?> <small><?php echo e($batch->batch_no, false); ?></small></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $batch->batch_no]); ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.location'); ?></th><td><?php echo e(optional($batch->location)->name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.eid_season'); ?></th><td><?php echo e(optional($batch->eidSeason)->name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.slaughter_date'); ?></th><td><?php echo e(optional($batch->slaughter_date)->format('d-m-Y'), false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.eid_day'); ?></th><td><?php echo e($batch->eid_day ? 'Day '.$batch->eid_day : '-', false); ?></td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.shift_name'); ?></th><td><?php echo e($batch->shift_name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.total_animals'); ?></th><td><?php echo e($batch->total_animals, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.total_live_weight'); ?></th><td><?php echo e($batch->total_live_weight, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $batch->status); ?></span></td></tr>
                </table>
            </div>
        </div>
        <?php if(! empty($batch->notes)): ?>
            <strong><?php echo app('translator')->get('slaughterhouse::lang.notes'); ?></strong>
            <p><?php echo e($batch->notes, false); ?></p>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('slaughterhouse::lang.eid_bookings')]); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('slaughterhouse::lang.booking_no'); ?></th>
                            <th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th>
                            <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $batch->bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php echo e($booking->booking_no, false); ?></td>
                                <td><?php echo e($booking->customer_name, false); ?></td>
                                <td><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->fulfillment_status); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="3" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('slaughterhouse::lang.carcasses_in_chiller')]); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Carcass</th>
                            <th>Hot Weight</th>
                            <th>Cold Weight</th>
                            <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $batch->carcasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carcass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php echo e($carcass->carcass_no, false); ?></td>
                                <td><?php echo e($carcass->hot_weight, false); ?></td>
                                <td><?php echo e($carcass->cold_weight, false); ?></td>
                                <td><?php echo e($carcass->status, false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
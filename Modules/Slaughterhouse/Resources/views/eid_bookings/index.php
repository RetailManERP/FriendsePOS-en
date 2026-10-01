
<?php $__env->startSection('title', __('slaughterhouse::lang.eid_bookings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.eid_bookings'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['method' => 'get']); ?>

        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('eid_season_id', __('slaughterhouse::lang.eid_season') . ':'); ?>

                    <?php echo Form::select('eid_season_id', $seasons, request('eid_season_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo Form::label('preferred_day', __('slaughterhouse::lang.preferred_day') . ':'); ?>

                    <?php echo Form::select('preferred_day', [1 => 'Day 1', 2 => 'Day 2', 3 => 'Day 3'], request('preferred_day'), ['class' => 'form-control', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('fulfillment_status', __('slaughterhouse::lang.fulfillment_status') . ':'); ?>

                    <?php echo Form::select('fulfillment_status', ['booked' => __('slaughterhouse::lang.booked'), 'allocated' => __('slaughterhouse::lang.allocated'), 'in_slaughter' => __('slaughterhouse::lang.in_slaughter'), 'cutting' => __('slaughterhouse::lang.cutting'), 'packing' => __('slaughterhouse::lang.packing'), 'ready' => __('slaughterhouse::lang.ready'), 'delivered' => __('slaughterhouse::lang.delivered'), 'cancelled' => __('slaughterhouse::lang.cancelled')], request('fulfillment_status'), ['class' => 'form-control', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.eid_bookings')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'create']), false); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_eid_booking'); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.booking_no'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.mobile'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.animal_type'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.share_count'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.preferred_day'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.payment_status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.fulfillment_status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'show'], $booking->id), false); ?>"><?php echo e($booking->booking_no, false); ?></a></td>
                            <td><?php echo e($booking->customer_name, false); ?></td>
                            <td><?php echo e($booking->mobile, false); ?></td>
                            <td><?php echo e(ucfirst(str_replace('_', ' ', $booking->animal_type)), false); ?></td>
                            <td><?php echo e($booking->share_count, false); ?> / <?php echo e($booking->total_shares, false); ?></td>
                            <td>Day <?php echo e($booking->preferred_day, false); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->payment_status); ?></span></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->fulfillment_status); ?></span></td>
                            <td>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'show'], $booking->id), false); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->get('slaughterhouse::lang.view'); ?></a>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'edit'], $booking->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="9" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($bookings->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
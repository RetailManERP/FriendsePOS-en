
<?php $__env->startSection('title', __('slaughterhouse::lang.slaughterhouse') . ' - ' . __('slaughterhouse::lang.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.slaughterhouse'); ?> <small><?php echo app('translator')->get('slaughterhouse::lang.dashboard'); ?></small></h1>
</section>

<section class="content">
    <?php echo Form::open(['method' => 'get']); ?>

        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('slaughterhouse::lang.location') . ':'); ?>

                    <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

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


    <div class="row">
        <?php $__currentLoopData = [
            ['active_seasons', 'fa-calendar-alt', 'bg-primary'],
            ['pending_bookings', 'fa-calendar-check', 'bg-warning'],
            ['ready_bookings', 'fa-box', 'bg-success'],
            ['today_batches', 'fa-layer-group', 'bg-info'],
            ['awaiting_animals', 'fa-list', 'bg-purple'],
            ['carcasses_in_chiller', 'fa-snowflake', 'bg-aqua'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-2 col-sm-6">
                <div class="info-box <?php echo e($card[2], false); ?>">
                    <span class="info-box-icon"><i class="fa fas <?php echo e($card[1], false); ?>"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('slaughterhouse::lang.' . $card[0]); ?></span>
                        <span class="info-box-number"><?php echo e($stats[$card[0]], false); ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.recent_bookings')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.booking_no'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.preferred_day'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $recent_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'show'], $booking->id), false); ?>"><?php echo e($booking->booking_no, false); ?></a></td>
                                    <td><?php echo e($booking->customer_name, false); ?></td>
                                    <td><?php echo e($booking->preferred_day, false); ?></td>
                                    <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->fulfillment_status); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('slaughterhouse::lang.upcoming_batches')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.batch_no'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.slaughter_date'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.total_animals'); ?></th>
                                <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $upcoming_batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterBatchController::class, 'show'], $batch->id), false); ?>"><?php echo e($batch->batch_no, false); ?></a></td>
                                    <td><?php echo e(optional($batch->slaughter_date)->format('d-m-Y'), false); ?></td>
                                    <td><?php echo e($batch->total_animals, false); ?></td>
                                    <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $batch->status); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
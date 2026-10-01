
<?php $__env->startSection('title', __('slaughterhouse::lang.eid_booking') . ' - ' . $booking->booking_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.eid_booking'); ?> <small><?php echo e($booking->booking_no, false); ?></small></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $booking->booking_no]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php echo Form::open(['url' => action([\Modules\Slaughterhouse\Http\Controllers\SlaughterQurbaniTokenController::class, 'issue'], $booking->id), 'method' => 'post', 'style' => 'display:inline']); ?>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-ticket-alt"></i> <?php echo app('translator')->get('slaughterhouse::lang.issue_token'); ?>
                    </button>
                <?php echo Form::close(); ?>

                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'edit'], $booking->id), false); ?>" class="btn btn-primary">
                    <i class="fa fa-edit"></i> <?php echo app('translator')->get('slaughterhouse::lang.edit'); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th><td><?php echo e($booking->customer_name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.mobile'); ?></th><td><?php echo e($booking->mobile, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.eid_season'); ?></th><td><?php echo e(optional($booking->season)->name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.token_no'); ?></th><td><?php echo e(optional($booking->token)->token_no ?: $booking->token_no, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.preferred_day'); ?></th><td>Day <?php echo e($booking->preferred_day, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.preferred_slot'); ?></th><td><?php echo e($booking->preferred_slot, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.address'); ?></th><td><?php echo e($booking->address, false); ?></td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.booking_type'); ?></th><td><?php echo e(ucfirst(str_replace('_', ' ', $booking->booking_type)), false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.animal_type'); ?></th><td><?php echo e(ucfirst(str_replace('_', ' ', $booking->animal_type)), false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.share_count'); ?></th><td><?php echo e($booking->share_count, false); ?> / <?php echo e($booking->total_shares, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.booking_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($booking->booking_amount, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.advance_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($booking->advance_amount, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('slaughterhouse::lang.balance_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($booking->balance_amount, false); ?></span></td></tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.payment_status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.fulfillment_status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.delivery_type'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.delivery_status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.net_meat_weight'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.package_count'); ?></th>
                    </tr>
                    <tr>
                        <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->payment_status); ?></span></td>
                        <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->fulfillment_status); ?></span></td>
                        <td><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->delivery_type); ?></td>
                        <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $booking->delivery_status); ?></span></td>
                        <td><?php echo e($booking->net_meat_weight, false); ?></td>
                        <td><?php echo e($booking->package_count, false); ?></td>
                    </tr>
                </table>
                <?php if(! empty($booking->notes)): ?>
                    <strong><?php echo app('translator')->get('slaughterhouse::lang.notes'); ?></strong>
                    <p><?php echo e($booking->notes, false); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('slaughterhouse::lang.animal_numbers')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.animal_number'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.service_option'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.total_price'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.current_stage'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.display_zone'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $booking->animalNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'show'], $animal->id), false); ?>"><?php echo e($animal->animal_number, false); ?></a></td>
                            <td><?php echo e(optional($animal->serviceOption)->name, false); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($animal->total_price, false); ?></span></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $animal->current_stage); ?></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $animal->display_zone); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="5" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'create']), false); ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_animal_number'); ?>
        </a>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
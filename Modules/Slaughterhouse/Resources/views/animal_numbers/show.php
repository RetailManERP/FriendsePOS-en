
<?php $__env->startSection('title', __('slaughterhouse::lang.animal_number') . ' - ' . $animal_number->animal_number); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.animal_number'); ?> <small><?php echo e($animal_number->animal_number, false); ?></small></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $animal_number->animal_number]); ?>
        <table class="table table-bordered">
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.booking_no'); ?></th><td><?php echo e(optional($animal_number->booking)->booking_no, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.token_no'); ?></th><td><?php echo e(optional($animal_number->token)->token_no, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.service_option'); ?></th><td><?php echo e(optional($animal_number->serviceOption)->name, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_type'); ?></th><td><?php echo e(optional($animal_number->cuttingType)->name, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.total_price'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($animal_number->total_price, false); ?></span></td><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_instructions'); ?></th><td><?php echo e($animal_number->cutting_instructions, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.current_stage'); ?></th><td><?php echo app('translator')->get('slaughterhouse::lang.' . $animal_number->current_stage); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.display_zone'); ?></th><td><?php echo app('translator')->get('slaughterhouse::lang.' . $animal_number->display_zone); ?></td></tr>
        </table>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('slaughterhouse::lang.floor_scanning')]); ?>
        <table class="table table-bordered">
            <thead><tr><th><?php echo app('translator')->get('slaughterhouse::lang.current_stage'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.station_code'); ?></th><th><?php echo app('translator')->get('messages.date'); ?></th></tr></thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $animal_number->scanEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr><td><?php echo e($event->from_stage, false); ?> -> <?php echo e($event->to_stage, false); ?></td><td><?php echo e($event->station_code, false); ?></td><td><?php echo e(optional($event->scanned_at)->format('d-m-Y H:i'), false); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr><td colspan="3" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
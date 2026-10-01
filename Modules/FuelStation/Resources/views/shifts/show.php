
<?php $__env->startSection('title', __('fuelstation::lang.shift_details')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.shift_details'); ?> — <?php echo e($shift->shift_no, false); ?></h1></section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.shift_details')]); ?>
        <div class="row">
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.operator'); ?>:</strong> <?php echo e(optional($shift->operator)->user_full_name ?? '-', false); ?></div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.location'); ?>:</strong> <?php echo e(optional($shift->location)->name ?? '-', false); ?></div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?>:</strong> <?php echo e(optional($shift->dispenser)->name ?? '-', false); ?></div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.status'); ?>:</strong> <?php echo app('translator')->get('fuelstation::lang.shift_status_' . $shift->status); ?></div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.start_time'); ?>:</strong> <?php echo e(optional($shift->start_time)->format('d-m-Y H:i'), false); ?></div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.end_time'); ?>:</strong> <?php echo e($shift->end_time ? $shift->end_time->format('d-m-Y H:i') : '-', false); ?></div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.total_liters'); ?>:</strong> <?php echo e(number_format($shift->total_liters, 2), false); ?> L</div>
            <div class="col-md-3"><strong><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->total_amount, false); ?></span></div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('fuelstation::lang.nozzle_readings')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.nozzle'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.opening_reading'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.closing_reading'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.test_quantity'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.rate_per_liter'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $shift->readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(optional($reading->nozzle)->name ?? '-', false); ?></td>
                        <td><?php echo e(optional($reading->tank)->name ?? '-', false); ?></td>
                        <td><?php echo e(number_format($reading->opening_reading, 2), false); ?></td>
                        <td><?php echo e(number_format($reading->closing_reading, 2), false); ?></td>
                        <td><?php echo e(number_format($reading->test_quantity, 2), false); ?></td>
                        <td><?php echo e(number_format($reading->liters_sold, 2), false); ?></td>
                        <td><?php echo e(number_format($reading->rate_per_liter, 2), false); ?></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($reading->amount, false); ?></span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('fuelstation::lang.collection')]); ?>
        <div class="row">
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.cash_received'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->cash_received, false); ?></span></div>
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.card_amount'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->card_amount, false); ?></span></div>
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.bank_amount'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->bank_amount, false); ?></span></div>
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.credit_amount'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->credit_amount, false); ?></span></div>
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.expected_cash'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->expected_cash, false); ?></span></div>
            <div class="col-md-2"><strong><?php echo app('translator')->get('fuelstation::lang.short_excess'); ?>:</strong> <span class="display_currency" data-currency_symbol="true"><?php echo e($shift->short_excess, false); ?></span></div>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () { __currency_convert_recursively($('section.content')); });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
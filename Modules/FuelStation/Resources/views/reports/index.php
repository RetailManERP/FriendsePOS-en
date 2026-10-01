
<?php $__env->startSection('title', __('fuelstation::lang.reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.reports'); ?></h1></section>

<section class="content">
    <?php
        $reports = [
            'daily-sales' => ['fa-chart-line', 'report_daily_sales'],
            'shift-closing' => ['fa-stop-circle', 'report_shift_closing'],
            'nozzle-reading' => ['fa-tachometer-alt', 'report_nozzle_reading'],
            'tank-stock' => ['fa-oil-can', 'report_tank_stock'],
            'tank-adjustment' => ['fa-sliders-h', 'report_tank_adjustment'],
            'dispenser-sales' => ['fa-gas-pump', 'report_dispenser_sales'],
            'staff-sales' => ['fa-user-tie', 'report_staff_sales'],
            'credit-customer' => ['fa-hand-holding-usd', 'report_credit_customer'],
            'cash-short-excess' => ['fa-balance-scale', 'report_cash_short_excess'],
            'integration-log' => ['fa-plug', 'report_integration_log'],
        ];
    ?>
    <div class="row">
        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelReportController::class, 'show'], [$slug]), false); ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa <?php echo e($meta[0], false); ?>"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('fuelstation::lang.' . $meta[1]); ?></span>
                        <span class="info-box-number"><i class="fa fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
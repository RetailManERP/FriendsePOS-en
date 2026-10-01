
<?php $__env->startSection('title', __('tailorpro::lang.reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-chart-bar" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.reports'); ?></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="info-box" style="border-radius:10px; cursor:pointer;" onclick="window.location='<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, 'orderReport']), false); ?>'">
                <span class="info-box-icon bg-purple"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.order_report'); ?></span>
                    <span class="info-box-number"><?php echo app('translator')->get('tailorpro::lang.order_report_desc'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box" style="border-radius:10px; cursor:pointer;" onclick="window.location='<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, 'fabricConsumptionReport']), false); ?>'">
                <span class="info-box-icon bg-green"><i class="fas fa-box-open"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.fabric_consumption_report'); ?></span>
                    <span class="info-box-number"><?php echo app('translator')->get('tailorpro::lang.fabric_consumption_report_desc'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box" style="border-radius:10px; cursor:pointer;" onclick="window.location='<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, 'tailorPerformance']), false); ?>'">
                <span class="info-box-icon bg-yellow"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.tailor_performance_report'); ?></span>
                    <span class="info-box-number"><?php echo app('translator')->get('tailorpro::lang.tailor_performance_report_desc'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
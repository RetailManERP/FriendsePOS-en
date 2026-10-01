
<?php $__env->startSection('title', $report->report_type . '-Report #' . $report->id); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e($report->report_type, false); ?>-Report #<?php echo e($report->id, false); ?>

        <small><?php echo e($report->report_date, false); ?></small>
    </h1>
</section>

<section class="content">
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Summary</h5>
            <span class="badge bg-<?php echo e($report->sync_status === 'submitted' ? 'success' : 'warning', false); ?>">
                <?php echo e(strtoupper($report->sync_status), false); ?>

            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Type:</strong> <?php echo e($report->report_type === 'Z' ? __('fijifrcs::fijifrcs.z_report') : __('fijifrcs::fijifrcs.x_report'), false); ?></p>
                    <p><strong>Z #:</strong> <?php echo e($report->z_number ?: '—', false); ?></p>
                    <p><strong><?php echo e(__('fijifrcs::fijifrcs.period'), false); ?>:</strong> <?php echo e($report->period_start, false); ?> → <?php echo e($report->period_end, false); ?></p>
                    <p><strong>FRCS Report ID:</strong> <code><?php echo e($report->frcs_report_id ?: '—', false); ?></code></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Normal Sales:</strong> <?php echo e($report->receipts_normal_count, false); ?></p>
                    <p><strong>Refunds:</strong> <?php echo e($report->receipts_refund_count, false); ?></p>
                    <p><strong>Training:</strong> <?php echo e($report->receipts_training_count, false); ?></p>
                    <p><strong>Proforma:</strong> <?php echo e($report->receipts_proforma_count, false); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><h5 class="card-title mb-0">Totals</h5></div>
        <div class="card-body">
            <table class="table table-sm">
                <tr><th>Sales (Excl. VAT)</th><td class="text-end"><?php echo e(number_format($report->total_sales_excl_vat, 2), false); ?></td></tr>
                <tr><th>VAT</th><td class="text-end"><?php echo e(number_format($report->total_vat, 2), false); ?></td></tr>
                <tr><th>Sales (Incl. VAT)</th><td class="text-end"><strong><?php echo e(number_format($report->total_sales_incl_vat, 2), false); ?></strong></td></tr>
                <tr><th>Refunds</th><td class="text-end"><?php echo e(number_format($report->total_refunds, 2), false); ?></td></tr>
                <tr><th>Discounts</th><td class="text-end"><?php echo e(number_format($report->total_discounts, 2), false); ?></td></tr>
                <tr><th>Standard-rated taxable</th><td class="text-end"><?php echo e(number_format($report->total_standard_taxable, 2), false); ?></td></tr>
                <tr><th>Standard VAT</th><td class="text-end"><?php echo e(number_format($report->total_standard_vat, 2), false); ?></td></tr>
                <tr><th>Zero-rated</th><td class="text-end"><?php echo e(number_format($report->total_zero_rated, 2), false); ?></td></tr>
                <tr><th>Exempt</th><td class="text-end"><?php echo e(number_format($report->total_exempt, 2), false); ?></td></tr>
            </table>
        </div>
    </div>

    <?php if(! empty($report->totals_by_payment_method)): ?>
        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.totals_by_payment'), false); ?></h5></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <?php $__currentLoopData = $report->totals_by_payment_method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method => $amt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><th><?php echo e($method, false); ?></th><td class="text-end"><?php echo e(number_format((float) $amt, 2), false); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php if($report->error_message): ?>
        <div class="alert alert-danger"><?php echo e($report->error_message, false); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('fijifrcs.reports.index'), false); ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> <?php echo e(__('fijifrcs::fijifrcs.back'), false); ?>

    </a>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.receipts')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.receipts'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipts'); ?></h5>
            <div>
                <form action="<?php echo e(route('zimbrafiscal.receipts.bulk-submit'), false); ?>" method="POST" class="d-inline" onsubmit="return confirm('Submit all pending transactions to ZIMRA?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fas fa-paper-plane"></i> <?php echo app('translator')->get('zimbrafiscal::lang.bulk_submit'); ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="<?php echo e(route('zimbrafiscal.receipts.index'), false); ?>" class="row g-2 mb-3">
                <div class="col-auto">
                    <select name="status" class="form-select form-select-sm">
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key, false); ?>" <?php echo e(request('status') === $key ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="receipt_type" class="form-select form-select-sm">
                        <option value="">All Types</option>
                        <?php $__currentLoopData = $receipt_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rt, false); ?>" <?php echo e(request('receipt_type') === $rt ? 'selected' : '', false); ?>><?php echo e($rt, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="date" name="start_date" class="form-control form-control-sm" value="<?php echo e(request('start_date'), false); ?>" placeholder="Start Date">
                </div>
                <div class="col-auto">
                    <input type="date" name="end_date" class="form-control form-control-sm" value="<?php echo e(request('end_date'), false); ?>" placeholder="End Date">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-filter"></i> <?php echo app('translator')->get('zimbrafiscal::lang.filter'); ?>
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_global_no'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_type'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.invoice_no'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_date'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_currency'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_total'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.submission_status'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.fdms_receipt_id'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><strong><?php echo e($receipt->receipt_global_no ?? '-', false); ?></strong></td>
                            <td>
                                <?php
                                    $typeColor = match($receipt->receipt_type) {
                                        'FiscalInvoice' => 'primary',
                                        'CreditNote' => 'danger',
                                        'DebitNote' => 'warning',
                                        default => 'secondary',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($typeColor, false); ?>"><?php echo e($receipt->receipt_type, false); ?></span>
                            </td>
                            <td><?php echo e($receipt->invoice_no ?? '-', false); ?></td>
                            <td><?php echo e($receipt->receipt_date ? \Carbon\Carbon::parse($receipt->receipt_date)->format('Y-m-d H:i') : '-', false); ?></td>
                            <td><?php echo e($receipt->receipt_currency, false); ?></td>
                            <td><strong><?php echo e(number_format($receipt->receipt_total, 2), false); ?></strong></td>
                            <td>
                                <?php
                                    $statusColor = match($receipt->submission_status) {
                                        'submitted' => 'success',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        'offline_queued' => 'info',
                                        default => 'secondary',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($statusColor, false); ?>"><?php echo e(ucfirst($receipt->submission_status), false); ?></span>
                            </td>
                            <td><?php echo e($receipt->fdms_receipt_id ?? '-', false); ?></td>
                            <td>
                                <a href="<?php echo e(route('zimbrafiscal.receipts.show', $receipt->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($receipt->submission_status === 'failed'): ?>
                                <form action="<?php echo e(route('zimbrafiscal.receipts.retry', $receipt->id), false); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-xs btn-outline-warning">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($receipts->hasPages()): ?>
                <div class="mt-3">
                    <?php echo e($receipts->appends(request()->query())->links(), false); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
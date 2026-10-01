
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.receipt_detail')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>
        <?php echo app('translator')->get('zimbrafiscal::lang.receipt_detail'); ?>
        <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?> — <?php echo e($receipt->receipt_type, false); ?></small>
    </h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Receipt Info -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipt'); ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_type'); ?>:</td>
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
                        </tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_global_no'); ?>:</td><td><strong><?php echo e($receipt->receipt_global_no ?? '-', false); ?></strong></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter_label'); ?>:</td><td><?php echo e($receipt->receipt_counter ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_no'); ?>:</td><td><?php echo e($receipt->fiscalDay ? '#' . $receipt->fiscalDay->fiscal_day_no : '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.invoice_no'); ?>:</td><td><?php echo e($receipt->invoice_no ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_date'); ?>:</td><td><?php echo e($receipt->receipt_date ? \Carbon\Carbon::parse($receipt->receipt_date)->format('Y-m-d H:i:s') : '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_currency'); ?>:</td><td><?php echo e($receipt->receipt_currency, false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_total'); ?>:</td><td><strong><?php echo e(number_format($receipt->receipt_total, 2), false); ?></strong></td></tr>
                        <tr>
                            <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.submission_status'); ?>:</td>
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
                        </tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.fdms_receipt_id'); ?>:</td><td><?php echo e($receipt->fdms_receipt_id ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?>:</td><td><?php echo e($receipt->device ? $receipt->device->device_id : '-', false); ?></td></tr>
                    </table>

                    <?php if($receipt->submission_status === 'failed'): ?>
                    <div class="alert alert-danger mt-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.error_message'); ?>:</strong> <?php echo e($receipt->submission_error, false); ?>

                        <?php if($receipt->error_code): ?>
                            <br><strong><?php echo app('translator')->get('zimbrafiscal::lang.error_code'); ?>:</strong> <?php echo e($receipt->error_code, false); ?>

                        <?php endif; ?>
                    </div>
                    <form action="<?php echo e(route('zimbrafiscal.receipts.retry', $receipt->id), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fas fa-redo"></i> <?php echo app('translator')->get('zimbrafiscal::lang.retry_submission'); ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Buyer Data -->
            <?php if($receipt->buyer_data && count((array)$receipt->buyer_data) > 0): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-user"></i> <?php echo app('translator')->get('zimbrafiscal::lang.buyer_data'); ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <?php $__currentLoopData = (array)$receipt->buyer_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value): ?>
                            <tr><td class="text-muted"><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?>:</td><td><?php echo e($value, false); ?></td></tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!-- Credit/Debit Note Reference -->
            <?php if($receipt->credit_debit_note && count((array)$receipt->credit_debit_note) > 0): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-link"></i> <?php echo app('translator')->get('zimbrafiscal::lang.credit_debit_note_info'); ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <?php $__currentLoopData = (array)$receipt->credit_debit_note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value): ?>
                            <tr><td class="text-muted"><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?>:</td><td><?php echo e($value, false); ?></td></tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!-- Signatures & QR -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-signature"></i> Signatures & QR</h5>
                </div>
                <div class="card-body">
                    <?php if($receipt->device_signature): ?>
                    <div class="mb-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.device_signature'); ?>:</strong>
                        <code class="d-block text-break" style="font-size: 0.7rem;"><?php echo e($receipt->device_signature, false); ?></code>
                    </div>
                    <?php endif; ?>
                    <?php if($receipt->server_signature): ?>
                    <div class="mb-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.server_signature'); ?>:</strong>
                        <code class="d-block text-break" style="font-size: 0.7rem;"><?php echo e($receipt->server_signature, false); ?></code>
                    </div>
                    <?php endif; ?>
                    <?php if($receipt->receipt_hash): ?>
                    <div class="mb-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.receipt_hash'); ?>:</strong>
                        <code class="d-block text-break" style="font-size: 0.7rem;"><?php echo e($receipt->receipt_hash, false); ?></code>
                    </div>
                    <?php endif; ?>
                    <?php if($receipt->previous_receipt_hash): ?>
                    <div class="mb-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.previous_hash'); ?>:</strong>
                        <code class="d-block text-break" style="font-size: 0.7rem;"><?php echo e($receipt->previous_receipt_hash, false); ?></code>
                    </div>
                    <?php endif; ?>
                    <?php if($receipt->qr_code): ?>
                    <div class="mb-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.qr_code'); ?>:</strong>
                        <code class="d-block text-break" style="font-size: 0.7rem;"><?php echo e($receipt->qr_code, false); ?></code>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Receipt Lines, Taxes, Payments -->
        <div class="col-lg-7">
            <!-- Receipt Lines -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-list"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipt_lines'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($receipt->lines && count($receipt->lines) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.line_no'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.item_name'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.unit_price'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.quantity'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.discount'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.line_total'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_code'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_percent'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.hs_code'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $receipt->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($line->line_no, false); ?></td>
                                    <td><?php echo e($line->name, false); ?></td>
                                    <td><?php echo e(number_format($line->price, 2), false); ?></td>
                                    <td><?php echo e($line->quantity, false); ?></td>
                                    <td><?php echo e($line->discount_amount ? number_format($line->discount_amount, 2) : '-', false); ?></td>
                                    <td><strong><?php echo e(number_format($line->total, 2), false); ?></strong></td>
                                    <td><?php echo e($line->tax_code ?? '-', false); ?></td>
                                    <td><?php echo e($line->tax_percent !== null ? $line->tax_percent . '%' : '-', false); ?></td>
                                    <td><?php echo e($line->hs_code ?? '-', false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tax Breakdown -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-percentage"></i> <?php echo app('translator')->get('zimbrafiscal::lang.tax_breakdown'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($receipt->receipt_taxes && count($receipt->receipt_taxes) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_code'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_id'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_percent'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_amount'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.sales_amount_with_tax'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $receipt->receipt_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($tax['taxCode'] ?? '-', false); ?></td>
                                    <td><?php echo e($tax['taxID'] ?? '-', false); ?></td>
                                    <td><?php echo e(($tax['taxPercent'] ?? 0), false); ?>%</td>
                                    <td><?php echo e(number_format($tax['taxAmount'] ?? 0, 2), false); ?></td>
                                    <td><strong><?php echo e(number_format($tax['salesAmountWithTax'] ?? 0, 2), false); ?></strong></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payments -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-money-bill-wave"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipt_payments'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($receipt->receipt_payments && count($receipt->receipt_payments) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.line_type'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $receipt->receipt_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($payment['moneyTypeCode'] ?? '-', false); ?></td>
                                    <td><strong><?php echo e(number_format($payment['paymentAmount'] ?? 0, 2), false); ?></strong></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- POS Transaction Link -->
            <?php if($receipt->transaction): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-cash-register"></i> POS Transaction</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">Transaction ID:</td><td><?php echo e($receipt->transaction_id, false); ?></td></tr>
                        <tr><td class="text-muted">Invoice No:</td><td><?php echo e($receipt->transaction->invoice_no ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted">Type:</td><td><?php echo e($receipt->transaction->type ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted">Status:</td><td><?php echo e($receipt->transaction->status ?? '-', false); ?></td></tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <a href="<?php echo e(route('zimbrafiscal.receipts.index'), false); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('zimbrafiscal::lang.back'); ?>
    </a>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
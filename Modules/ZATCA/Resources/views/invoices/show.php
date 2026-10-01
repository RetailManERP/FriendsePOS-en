
<?php $__env->startSection('title', 'ZATCA Invoice Detail'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>
        ZATCA Invoice #<?php echo e($invoice->invoice_number, false); ?>

        <small>
            <span class="badge <?php echo e($invoice->getSyncStatusBadgeClass(), false); ?>"><?php echo e($invoice->getSyncStatusLabel(), false); ?></span>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('zatca.invoices.index'), false); ?>">ZATCA Invoices</a></li>
        <li class="breadcrumb-item active"><?php echo e($invoice->invoice_number, false); ?></li>
    </ol>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Invoice Summary -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Invoice Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="40%">Invoice Number</th><td><?php echo e($invoice->invoice_number, false); ?></td></tr>
                                <tr><th>Invoice Date</th><td><?php echo e($invoice->invoice_date->format('Y-m-d'), false); ?></td></tr>
                                <tr><th>Due Date</th><td><?php echo e($invoice->due_date ? $invoice->due_date->format('Y-m-d') : '-', false); ?></td></tr>
                                <tr>
                                    <th>Invoice Type</th>
                                    <td><?php echo e($invoice->getInvoiceTypeLabel(), false); ?></td>
                                </tr>
                                <?php if($invoice->original_invoice_number): ?>
                                <tr>
                                    <th>Original Invoice</th>
                                    <td><?php echo e($invoice->original_invoice_number, false); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($invoice->note_reason): ?>
                                <tr>
                                    <th>Note Reason</th>
                                    <td><?php echo e($invoice->note_reason, false); ?></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Sub Type</th>
                                    <td><span class="badge <?php echo e($invoice->invoice_sub_type === 'B2B' ? 'bg-primary' : 'bg-secondary', false); ?>"><?php echo e($invoice->invoice_sub_type, false); ?></span></td>
                                </tr>
                                <tr><th>Payment Method</th><td><?php echo e($invoice->payment_method ?? '-', false); ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="40%">Buyer Name</th><td><?php echo e($invoice->buyer_name ?: '-', false); ?></td></tr>
                                <tr><th>Buyer VAT</th><td><?php echo e($invoice->buyer_vat ?: '-', false); ?></td></tr>
                                <tr><th>Buyer Address</th><td><?php echo e($invoice->buyer_address ?: '-', false); ?></td></tr>
                                <tr><th>Currency</th><td>SAR</td></tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Line Items</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Discount</th>
                                <th>Tax Cat.</th>
                                <th class="text-end">Tax %</th>
                                <th class="text-end">Tax Amt</th>
                                <th class="text-end">Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i + 1, false); ?></td>
                                <td><?php echo e($item->item_name, false); ?></td>
                                <td><?php echo e($item->quantity, false); ?></td>
                                <td><?php echo e($item->unit_code, false); ?></td>
                                <td class="text-end"><?php echo e(number_format($item->unit_price, 2), false); ?></td>
                                <td class="text-end"><?php echo e(number_format($item->discount_amount, 2), false); ?></td>
                                <td><span class="badge bg-secondary"><?php echo e($item->tax_category, false); ?></span></td>
                                <td class="text-end"><?php echo e($item->tax_rate, false); ?>%</td>
                                <td class="text-end"><?php echo e(number_format($item->tax_amount, 2), false); ?></td>
                                <td class="text-end"><strong><?php echo e(number_format($item->line_total, 2), false); ?></strong></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="8" class="text-end"><strong>Subtotal (Excl. VAT)</strong></td>
                                <td colspan="2" class="text-end"><strong><?php echo e(number_format($invoice->total_excluding_vat, 2), false); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-end">Total Discount</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->total_discount, 2), false); ?></td>
                            </tr>
                            <?php if($invoice->tax_amount_15 > 0): ?>
                            <tr>
                                <td colspan="8" class="text-end">VAT @ 15%</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->tax_amount_15, 2), false); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($invoice->tax_amount_5 > 0): ?>
                            <tr>
                                <td colspan="8" class="text-end">VAT @ 5%</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->tax_amount_5, 2), false); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($invoice->taxable_amount_0 > 0): ?>
                            <tr>
                                <td colspan="8" class="text-end">Zero-rated Amount</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->taxable_amount_0, 2), false); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($invoice->exempt_amount > 0): ?>
                            <tr>
                                <td colspan="8" class="text-end">Exempt Amount</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->exempt_amount, 2), false); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr class="fw-bold">
                                <td colspan="8" class="text-end">Total VAT</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->total_vat, 2), false); ?></td>
                            </tr>
                            <tr class="fw-bold table-primary">
                                <td colspan="8" class="text-end">Total (Incl. VAT)</td>
                                <td colspan="2" class="text-end"><?php echo e(number_format($invoice->total_including_vat, 2), false); ?> SAR</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Actions -->
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">Actions</h5></div>
                <div class="card-body">
                    <?php if($invoice->canBeRetried()): ?>
                        <form action="<?php echo e(route('zatca.invoices.retry', $invoice->id), false); ?>" method="POST" class="mb-2">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-warning w-100">
                                <i class="fas fa-sync"></i> <?php echo e($invoice->sync_status === 'pending' ? 'Sync to ZATCA' : 'Retry Now', false); ?>

                            </button>
                        </form>
                    <?php elseif($invoice->sync_status === 'submitting'): ?>
                        <div class="alert alert-info mb-2">
                            This invoice is currently being submitted to ZATCA.
                        </div>
                    <?php endif; ?>
                    <?php if($invoice->xml_content): ?>
                        <a href="<?php echo e(route('zatca.invoices.download-xml', $invoice->id), false); ?>" class="btn btn-outline-secondary w-100 mb-2">
                            <i class="fas fa-code"></i> Download XML
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('zatca.invoices.download-pdf', $invoice->id), false); ?>" class="btn btn-outline-danger w-100 mb-2">
                        <i class="fas fa-file-pdf"></i> Download PDF
                    </a>
                    <a href="<?php echo e(route('zatca.invoices.index'), false); ?>" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <!-- ZATCA Sync Status -->
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">ZATCA Sync Status</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th>Status</th>
                            <td><span class="badge <?php echo e($invoice->getSyncStatusBadgeClass(), false); ?>"><?php echo e($invoice->getSyncStatusLabel(), false); ?></span></td>
                        </tr>
                        <tr>
                            <th>Local Validation</th>
                            <td><span class="badge <?php echo e($invoice->getValidationStatusBadgeClass(), false); ?>"><?php echo e(ucfirst($invoice->validation_status ?? 'pending'), false); ?></span></td>
                        </tr>
                        <tr>
                            <th>Validated At</th>
                            <td><?php echo e($invoice->validated_at ? $invoice->validated_at->format('Y-m-d H:i:s') : 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <th>Submitted At</th>
                            <td><?php echo e($invoice->submitted_at ? $invoice->submitted_at->format('Y-m-d H:i:s') : 'Not synced', false); ?></td>
                        </tr>
                        <tr>
                            <th>Retry Count</th>
                            <td><?php echo e($invoice->retry_count, false); ?></td>
                        </tr>
                        <tr>
                            <th>Submission Attempts</th>
                            <td><?php echo e($invoice->submission_attempt_count ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <th>Last Attempt</th>
                            <td><?php echo e($invoice->last_submission_attempt_at ? $invoice->last_submission_attempt_at->format('Y-m-d H:i:s') : 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <th>Next Retry</th>
                            <td><?php echo e($invoice->next_retry_at ? $invoice->next_retry_at->format('Y-m-d H:i:s') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th>Retryable</th>
                            <td>
                                <span class="badge <?php echo e($invoice->is_retryable ? 'bg-warning text-dark' : 'bg-secondary', false); ?>">
                                    <?php echo e($invoice->is_retryable ? 'Yes' : 'No', false); ?>

                                </span>
                            </td>
                        </tr>
                        <?php if($invoice->failure_category): ?>
                        <tr>
                            <th>Failure Category</th>
                            <td><span class="badge <?php echo e($invoice->getFailureCategoryBadgeClass(), false); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $invoice->failure_category)), false); ?></span></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($invoice->zatca_status): ?>
                        <tr>
                            <th>ZATCA Status</th>
                            <td><?php echo e($invoice->zatca_status, false); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($invoice->error_message): ?>
                        <tr>
                            <th>Last Error</th>
                            <td><span class="text-danger"><?php echo e($invoice->error_message, false); ?></span></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <!-- QR Code -->
            <?php if($invoice->qr_code): ?>
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">QR Code</h5></div>
                <div class="card-body text-center">
                    <div class="bg-light p-2 rounded text-start" style="word-break: break-all; font-family: monospace; font-size: 0.75rem;">
                        <?php echo e($invoice->qr_code, false); ?>

                    </div>
                    <br><small class="text-muted">Base64 TLV payload stored for the invoice QR.</small>
                </div>
            </div>
            <?php endif; ?>

            <?php if($invoice->validation_errors): ?>
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">Validation Errors</h5></div>
                <div class="card-body">
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $invoice->validation_errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e(is_array($error) ? ($error['message'] ?? json_encode($error)) : $error, false); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- Hashing -->
            <?php if($invoice->invoice_hash): ?>
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">Integrity</h5></div>
                <div class="card-body">
                    <label class="form-label fw-bold">Invoice Hash (SHA-256)</label>
                    <div class="bg-light p-2 rounded" style="word-break: break-all; font-family: monospace; font-size: 0.8rem;">
                        <?php echo e($invoice->invoice_hash, false); ?>

                    </div>

                </div>
            </div>
            <?php endif; ?>

            <!-- Related Transaction -->
            <?php if($invoice->transaction): ?>
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">POS Transaction</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th>Ref No</th><td><?php echo e($invoice->transaction->invoice_no, false); ?></td></tr>
                        <tr><th>Type</th><td><?php echo e($invoice->transaction->type, false); ?></td></tr>
                        <tr><th>Date</th><td><?php echo e($invoice->transaction->transaction_date, false); ?></td></tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- XML Preview -->
    <?php if($invoice->signed_xml_content || $invoice->xml_content): ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                XML Preview
                <button class="btn btn-sm btn-outline-secondary float-end" type="button" data-bs-toggle="collapse" data-bs-target="#xmlPreview">
                    <i class="fas fa-code"></i> Toggle
                </button>
            </h5>
        </div>
        <div class="collapse" id="xmlPreview">
            <div class="card-body">
                <pre class="bg-dark text-light p-3 rounded" style="max-height: 400px; overflow: auto; font-size: 0.8rem;"><code><?php echo e($invoice->signed_xml_content ?: $invoice->xml_content, false); ?></code></pre>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- API Logs -->
    <?php if($invoice->apiLogs->count()): ?>
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">API Log History</h5></div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Endpoint</th>
                        <th>Method</th>
                        <th>HTTP Status</th>
                        <th>Duration</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $invoice->apiLogs->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 250px;"><?php echo e($log->endpoint, false); ?></span></td>
                        <td><span class="badge bg-info"><?php echo e($log->method, false); ?></span></td>
                        <td><?php echo e($log->http_status, false); ?></td>
                        <td><?php echo e($log->response_time_ms, false); ?>ms</td>
                        <td>
                            <span class="badge <?php echo e($log->is_success ? 'bg-success' : 'bg-danger', false); ?>">
                                <?php echo e($log->is_success ? 'Success' : 'Failed', false); ?>

                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
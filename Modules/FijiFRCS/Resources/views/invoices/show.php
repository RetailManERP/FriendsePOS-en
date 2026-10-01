
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.fiscal_receipts')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Receipt #<?php echo e($invoice->invoice_number, false); ?>

        <small><?php echo e($invoice->frcs_receipt_number ?: 'Not yet submitted', false); ?></small>
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
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Receipt Details</h5>
                    <span class="fijifrcs-status-pill fijifrcs-status-<?php echo e($invoice->sync_status, false); ?>">
                        <?php echo e(strtoupper($invoice->sync_status), false); ?>

                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Date:</strong> <?php echo e($invoice->invoice_date, false); ?> <?php echo e($invoice->invoice_time, false); ?></p>
                            <p><strong>Type:</strong> <?php echo e(config('fijifrcs.receipt_types')[$invoice->receipt_type] ?? $invoice->receipt_type, false); ?></p>
                            <p><strong>Currency:</strong> <?php echo e($invoice->currency_code, false); ?></p>
                            <p><strong>Payment:</strong> <?php echo e($invoice->payment_method, false); ?></p>
                            <?php if($invoice->originalInvoice): ?>
                                <p><strong><?php echo e(__('fijifrcs::fijifrcs.original_receipt'), false); ?>:</strong>
                                    <a href="<?php echo e(route('fijifrcs.invoices.show', $invoice->originalInvoice->id), false); ?>">
                                        <?php echo e($invoice->originalInvoice->invoice_number, false); ?>

                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Seller TIN:</strong> <?php echo e($invoice->seller_tin, false); ?></p>
                            <p><strong>Seller:</strong> <?php echo e($invoice->seller_name, false); ?></p>
                            <p><strong>Buyer:</strong> <?php echo e($invoice->buyer_name ?: '—', false); ?></p>
                            <p><strong>Buyer TIN:</strong> <?php echo e($invoice->buyer_tin ?: '—', false); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.line_items'), false); ?></h5></div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(__('fijifrcs::fijifrcs.item_name'), false); ?></th>
                                <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.quantity'), false); ?></th>
                                <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.unit_price'), false); ?></th>
                                <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.discount'), false); ?></th>
                                <th><?php echo e(__('fijifrcs::fijifrcs.tax_category'), false); ?></th>
                                <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.tax_amount'), false); ?></th>
                                <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.line_total'), false); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->item_name, false); ?></td>
                                    <td class="text-end"><?php echo e($item->quantity, false); ?></td>
                                    <td class="text-end"><?php echo e(number_format($item->unit_price, 2), false); ?></td>
                                    <td class="text-end"><?php echo e(number_format($item->discount_amount, 2), false); ?></td>
                                    <td><?php echo e($item->tax_category, false); ?> (<?php echo e($item->tax_rate, false); ?>%)</td>
                                    <td class="text-end"><?php echo e(number_format($item->tax_amount, 2), false); ?></td>
                                    <td class="text-end"><?php echo e(number_format($item->line_total, 2), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr><th colspan="6" class="text-end"><?php echo e(__('fijifrcs::fijifrcs.total_excluding_vat'), false); ?></th>
                                <td class="text-end"><?php echo e(number_format($invoice->total_excluding_vat, 2), false); ?></td></tr>
                            <tr><th colspan="6" class="text-end"><?php echo e(__('fijifrcs::fijifrcs.total_vat'), false); ?></th>
                                <td class="text-end"><?php echo e(number_format($invoice->total_vat, 2), false); ?></td></tr>
                            <tr><th colspan="6" class="text-end"><?php echo e(__('fijifrcs::fijifrcs.total_including_vat'), false); ?></th>
                                <td class="text-end"><strong><?php echo e(number_format($invoice->total_including_vat, 2), false); ?></strong></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <?php if($invoice->error_message): ?>
                <div class="alert alert-danger">
                    <strong><?php echo e(__('fijifrcs::fijifrcs.error_message'), false); ?>:</strong>
                    <pre class="mb-0"><?php echo e($invoice->error_message, false); ?></pre>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0">FRCS Submission</h5></div>
                <div class="card-body">
                    <p><strong><?php echo e(__('fijifrcs::fijifrcs.frcs_receipt_number'), false); ?>:</strong> <code><?php echo e($invoice->frcs_receipt_number ?: '—', false); ?></code></p>
                    <p><strong><?php echo e(__('fijifrcs::fijifrcs.verification_code'), false); ?>:</strong> <code><?php echo e($invoice->frcs_verification_code ?: '—', false); ?></code></p>
                    <p><strong><?php echo e(__('fijifrcs::fijifrcs.icv'), false); ?>:</strong> <?php echo e($invoice->icv_value ?: '—', false); ?></p>
                    <p><strong>Submitted At:</strong> <?php echo e($invoice->submitted_at ?: '—', false); ?></p>
                    <p><strong>Retries:</strong> <?php echo e($invoice->retry_count, false); ?></p>
                </div>
            </div>

            <?php if($invoice->qr_code): ?>
                <div class="card mb-3 text-center">
                    <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.qr_code'), false); ?></h5></div>
                    <div class="card-body">
                        <code class="small d-block text-break"><?php echo e($invoice->qr_code, false); ?></code>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-grid gap-2">
                <?php if(in_array($invoice->sync_status, ['pending', 'failed', 'rejected'])): ?>
                    <form method="POST" action="<?php echo e(route('fijifrcs.invoices.retry', $invoice->id), false); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-warning w-100"><i class="fa fa-redo"></i> <?php echo e(__('fijifrcs::fijifrcs.retry_submission'), false); ?></button>
                    </form>
                <?php endif; ?>
                <a href="<?php echo e(route('fijifrcs.invoices.download-pdf', $invoice->id), false); ?>" class="btn btn-outline-primary">
                    <i class="fa fa-file-pdf"></i> <?php echo e(__('fijifrcs::fijifrcs.download_pdf'), false); ?>

                </a>
                <a href="<?php echo e(route('fijifrcs.invoices.download-payload', $invoice->id), false); ?>" class="btn btn-outline-secondary">
                    <i class="fa fa-file-code"></i> <?php echo e(__('fijifrcs::fijifrcs.download_payload'), false); ?>

                </a>
                <a href="<?php echo e(route('fijifrcs.invoices.index'), false); ?>" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> <?php echo e(__('fijifrcs::fijifrcs.back'), false); ?>

                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
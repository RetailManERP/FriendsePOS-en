
<?php $__env->startSection('title', 'ZATCA Invoices'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>ZATCA Invoices <small>E-Invoice Synchronization</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <form method="GET" class="col-md-10">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <?php $__currentLoopData = $sync_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value, false); ?>" <?php echo e(request('status') === $value ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Invoice Type</label>
                            <select name="type" class="form-select form-select-sm">
                                <?php $__currentLoopData = $invoice_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value, false); ?>" <?php echo e(request('type') === $value ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo e(request('date_from'), false); ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo e(request('date_to'), false); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
                            <a href="<?php echo e(route('zatca.invoices.index'), false); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </form>
                <div class="col-md-2 text-end">
                    <form action="<?php echo e(route('zatca.invoices.bulk-sync'), false); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Sync all pending invoices to ZATCA?')">
                            <i class="fas fa-sync"></i> Sync All Pending
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice List -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>B2B/B2C</th>
                            <th>Buyer</th>
                            <th class="text-end">Excl. VAT</th>
                            <th class="text-end">VAT</th>
                            <th class="text-end">Total</th>
                            <th>Validation</th>
                            <th>Status</th>
                            <th>Next Retry</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('zatca.invoices.show', $invoice->id), false); ?>">
                                    <?php echo e($invoice->invoice_number, false); ?>

                                </a>
                            </td>
                            <td><?php echo e($invoice->invoice_date->format('Y-m-d'), false); ?></td>
                            <td><?php echo e($invoice->getInvoiceTypeLabel(), false); ?></td>
                            <td>
                                <span class="badge <?php echo e($invoice->invoice_sub_type === 'B2B' ? 'bg-primary' : 'bg-secondary', false); ?>">
                                    <?php echo e($invoice->invoice_sub_type, false); ?>

                                </span>
                            </td>
                            <td><?php echo e(Str::limit($invoice->buyer_name, 20) ?: '-', false); ?></td>
                            <td class="text-end"><?php echo e(number_format($invoice->total_excluding_vat, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($invoice->total_vat, 2), false); ?></td>
                            <td class="text-end"><strong><?php echo e(number_format($invoice->total_including_vat, 2), false); ?></strong></td>
                            <td>
                                <span class="badge <?php echo e($invoice->getValidationStatusBadgeClass(), false); ?>">
                                    <?php echo e(ucfirst($invoice->validation_status ?? 'pending'), false); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge <?php echo e($invoice->getSyncStatusBadgeClass(), false); ?>">
                                    <?php echo e($invoice->getSyncStatusLabel(), false); ?>

                                </span>
                            </td>
                            <td>
                                <?php echo e($invoice->next_retry_at ? $invoice->next_retry_at->format('Y-m-d H:i') : '-', false); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('zatca.invoices.show', $invoice->id), false); ?>" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($invoice->canBeRetried()): ?>
                                    <form action="<?php echo e(route('zatca.invoices.retry', $invoice->id), false); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-sm btn-warning" title="Retry"><i class="fas fa-redo"></i></button>
                                    </form>
                                <?php endif; ?>
                                <?php if($invoice->xml_content): ?>
                                    <a href="<?php echo e(route('zatca.invoices.download-xml', $invoice->id), false); ?>" class="btn btn-sm btn-outline-secondary" title="Download XML">
                                        <i class="fas fa-code"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('zatca.invoices.download-pdf', $invoice->id), false); ?>" class="btn btn-sm btn-outline-danger" title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">
                                <i class="fas fa-file-invoice"></i> No ZATCA invoices found.
                                <br>
                                <small>Invoices will appear here once synced from your POS transactions.</small>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($invoices->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($invoices->appends(request()->query())->links(), false); ?>

        </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
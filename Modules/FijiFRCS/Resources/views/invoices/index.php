
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.fiscal_receipts')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e(__('fijifrcs::fijifrcs.fiscal_receipts'), false); ?></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-2">
                    <label><?php echo e(__('fijifrcs::fijifrcs.sync_status'), false); ?></label>
                    <select name="sync_status" class="form-select form-select-sm">
                        <option value="">All</option>
                        <?php $__currentLoopData = $sync_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s, false); ?>" <?php if(request('sync_status') == $s): echo 'selected'; endif; ?>><?php echo e(ucfirst($s), false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label><?php echo e(__('fijifrcs::fijifrcs.receipt_type'), false); ?></label>
                    <select name="receipt_type" class="form-select form-select-sm">
                        <option value="">All</option>
                        <?php $__currentLoopData = $receipt_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($code, false); ?>" <?php if(request('receipt_type') == $code): echo 'selected'; endif; ?>><?php echo e($label, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label><?php echo e(__('fijifrcs::fijifrcs.date_from'), false); ?></label>
                    <input type="date" name="date_from" value="<?php echo e(request('date_from'), false); ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label><?php echo e(__('fijifrcs::fijifrcs.date_to'), false); ?></label>
                    <input type="date" name="date_to" value="<?php echo e(request('date_to'), false); ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label>Search</label>
                    <input type="text" name="search" value="<?php echo e(request('search'), false); ?>" class="form-control form-control-sm" placeholder="Receipt #, FRN, buyer TIN">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-primary btn-sm w-100"><?php echo e(__('fijifrcs::fijifrcs.filter'), false); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-2">
        <form method="POST" action="<?php echo e(route('fijifrcs.invoices.bulk-sync'), false); ?>">
            <?php echo csrf_field(); ?>
            <button class="btn btn-outline-primary btn-sm">
                <i class="fa fa-cloud-upload-alt"></i> <?php echo e(__('fijifrcs::fijifrcs.sync_all_pending'), false); ?>

            </button>
        </form>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-sm table-striped mb-0">
                <thead>
                    <tr>
                        <th><?php echo e(__('fijifrcs::fijifrcs.invoice_date'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.invoice_number'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.frcs_receipt_number'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.receipt_type'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.buyer_name'), false); ?></th>
                        <th class="text-end"><?php echo e(__('fijifrcs::fijifrcs.total_including_vat'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.sync_status'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.actions'), false); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($inv->invoice_date, false); ?></td>
                            <td><?php echo e($inv->invoice_number, false); ?></td>
                            <td><code><?php echo e($inv->frcs_receipt_number ?: '—', false); ?></code></td>
                            <td><?php echo e($inv->receipt_type, false); ?></td>
                            <td><?php echo e($inv->buyer_name ?: '—', false); ?></td>
                            <td class="text-end"><?php echo e(number_format($inv->total_including_vat, 2), false); ?></td>
                            <td>
                                <span class="fijifrcs-status-pill fijifrcs-status-<?php echo e($inv->sync_status, false); ?>">
                                    <?php echo e(strtoupper($inv->sync_status), false); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('fijifrcs.invoices.show', $inv->id), false); ?>" class="btn btn-xs btn-outline-primary">View</a>
                                <?php if(in_array($inv->sync_status, ['pending', 'failed', 'rejected'])): ?>
                                    <form method="POST" action="<?php echo e(route('fijifrcs.invoices.retry', $inv->id), false); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-xs btn-outline-warning">Retry</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="8" class="text-center p-3 text-muted"><?php echo e(__('fijifrcs::fijifrcs.no_data'), false); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3"><?php echo e($invoices->links(), false); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
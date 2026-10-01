
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.fiscal_day_detail')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>
        <?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day'); ?> #<?php echo e($fiscal_day->fiscal_day_no, false); ?>

        <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small>
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
        <!-- Fiscal Day Info -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_detail'); ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_no'); ?>:</td><td><strong>#<?php echo e($fiscal_day->fiscal_day_no, false); ?></strong></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?>:</td><td><?php echo e($fiscal_day->device ? $fiscal_day->device->device_id : '-', false); ?></td></tr>
                        <tr>
                            <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?>:</td>
                            <td>
                                <?php
                                    $statusColor = match($fiscal_day->status) {
                                        'FiscalDayOpened' => 'success',
                                        'FiscalDayCloseInitiated' => 'warning',
                                        'FiscalDayClosed' => 'secondary',
                                        default => 'info',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($statusColor, false); ?>"><?php echo e($fiscal_day->status, false); ?></span>
                            </td>
                        </tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.opened_at'); ?>:</td><td><?php echo e($fiscal_day->opened_at ? \Carbon\Carbon::parse($fiscal_day->opened_at)->format('Y-m-d H:i:s') : '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.closed_at'); ?>:</td><td><?php echo e($fiscal_day->closed_at ? \Carbon\Carbon::parse($fiscal_day->closed_at)->format('Y-m-d H:i:s') : '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter'); ?>:</td><td><?php echo e($fiscal_day->receipt_counter, false); ?></td></tr>
                    </table>

                    <?php if($fiscal_day->status === 'FiscalDayOpened'): ?>
                    <form action="<?php echo e(route('zimbrafiscal.fiscal-days.close', $fiscal_day->id), false); ?>" method="POST" onsubmit="return confirm('<?php echo app('translator')->get('zimbrafiscal::lang.confirm_close_day'); ?>')">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-stop-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.close_fiscal_day'); ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Day Signatures -->
            <?php if($fiscal_day->day_signatures): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-signature"></i> <?php echo app('translator')->get('zimbrafiscal::lang.day_signatures'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if(is_array($fiscal_day->day_signatures)): ?>
                        <?php $__currentLoopData = $fiscal_day->day_signatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-2">
                                <strong><?php echo e($key, false); ?>:</strong>
                                <code class="d-block text-break" style="font-size: 0.75rem;"><?php echo e(is_string($value) ? $value : json_encode($value), false); ?></code>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <code class="text-break" style="font-size: 0.75rem;"><?php echo e(json_encode($fiscal_day->day_signatures, JSON_PRETTY_PRINT), false); ?></code>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Counters & Receipts -->
        <div class="col-lg-7">
            <!-- Fiscal Counters -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calculator"></i> <?php echo app('translator')->get('zimbrafiscal::lang.fiscal_counters'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($fiscal_day->counters && count($fiscal_day->counters) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Counter Type</th>
                                    <th>Currency</th>
                                    <th>Tax ID</th>
                                    <th>Tax %</th>
                                    <th>Money Type</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $fiscal_day->counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($counter->counter_type, false); ?></td>
                                    <td><?php echo e($counter->currency ?? '-', false); ?></td>
                                    <td><?php echo e($counter->tax_id ?? '-', false); ?></td>
                                    <td><?php echo e($counter->tax_percent !== null ? $counter->tax_percent . '%' : '-', false); ?></td>
                                    <td><?php echo e($counter->money_type ?? '-', false); ?></td>
                                    <td><strong><?php echo e(number_format($counter->value, 2), false); ?></strong></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <?php if($fiscal_day->fiscal_day_counters): ?>
                            <pre style="font-size: 0.75rem; max-height: 300px; overflow-y: auto;"><?php echo e(json_encode($fiscal_day->fiscal_day_counters, JSON_PRETTY_PRINT), false); ?></pre>
                        <?php else: ?>
                            <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Receipts in this Fiscal Day -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipts'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($fiscal_day->receipts && count($fiscal_day->receipts) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter_label'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_type'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.invoice_no'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_total'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $fiscal_day->receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>#<?php echo e($receipt->receipt_counter, false); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo e($receipt->receipt_type, false); ?></span></td>
                                    <td><?php echo e($receipt->invoice_no ?? '-', false); ?></td>
                                    <td><?php echo e($receipt->receipt_currency, false); ?> <?php echo e(number_format($receipt->receipt_total, 2), false); ?></td>
                                    <td>
                                        <?php
                                            $rcptColor = match($receipt->submission_status) {
                                                'submitted' => 'success',
                                                'pending' => 'warning',
                                                'failed' => 'danger',
                                                'offline_queued' => 'info',
                                                default => 'secondary',
                                            };
                                        ?>
                                        <span class="badge bg-<?php echo e($rcptColor, false); ?>"><?php echo e(ucfirst($receipt->submission_status), false); ?></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('zimbrafiscal.receipts.show', $receipt->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
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
        </div>
    </div>

    <a href="<?php echo e(route('zimbrafiscal.fiscal-days.index'), false); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('zimbrafiscal::lang.back'); ?>
    </a>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
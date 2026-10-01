
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.fiscal_days')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_days'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
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
            <h5 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.fiscal_days'); ?></h5>
            <div>
                <form action="<?php echo e(route('zimbrafiscal.fiscal-days.open'), false); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fas fa-play-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.open_fiscal_day'); ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="<?php echo e(route('zimbrafiscal.fiscal-days.index'), false); ?>" class="row g-2 mb-3">
                <div class="col-auto">
                    <select name="status" class="form-select form-select-sm">
                        <option value=""><?php echo app('translator')->get('zimbrafiscal::lang.all'); ?></option>
                        <option value="FiscalDayOpened" <?php echo e(request('status') === 'FiscalDayOpened' ? 'selected' : '', false); ?>>FiscalDayOpened</option>
                        <option value="FiscalDayCloseInitiated" <?php echo e(request('status') === 'FiscalDayCloseInitiated' ? 'selected' : '', false); ?>>FiscalDayCloseInitiated</option>
                        <option value="FiscalDayClosed" <?php echo e(request('status') === 'FiscalDayClosed' ? 'selected' : '', false); ?>>FiscalDayClosed</option>
                    </select>
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
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_no'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.opened_at'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.closed_at'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $fiscal_days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><strong>#<?php echo e($day->fiscal_day_no, false); ?></strong></td>
                            <td><?php echo e($day->device ? $day->device->device_id : '-', false); ?></td>
                            <td>
                                <?php
                                    $statusColor = match($day->status) {
                                        'FiscalDayOpened' => 'success',
                                        'FiscalDayCloseInitiated' => 'warning',
                                        'FiscalDayClosed' => 'secondary',
                                        default => 'info',
                                    };
                                ?>
                                <span class="badge bg-<?php echo e($statusColor, false); ?>"><?php echo e($day->status, false); ?></span>
                            </td>
                            <td><?php echo e($day->opened_at ? \Carbon\Carbon::parse($day->opened_at)->format('Y-m-d H:i') : '-', false); ?></td>
                            <td><?php echo e($day->closed_at ? \Carbon\Carbon::parse($day->closed_at)->format('Y-m-d H:i') : '-', false); ?></td>
                            <td><?php echo e($day->receipt_counter, false); ?></td>
                            <td>
                                <a href="<?php echo e(route('zimbrafiscal.fiscal-days.show', $day->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-eye"></i> <?php echo app('translator')->get('zimbrafiscal::lang.view'); ?>
                                </a>
                                <?php if($day->status === 'FiscalDayOpened'): ?>
                                <form action="<?php echo e(route('zimbrafiscal.fiscal-days.close', $day->id), false); ?>" method="POST" class="d-inline" onsubmit="return confirm('<?php echo app('translator')->get('zimbrafiscal::lang.confirm_close_day'); ?>')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-xs btn-outline-danger">
                                        <i class="fas fa-stop-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.close_fiscal_day'); ?>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($fiscal_days->hasPages()): ?>
                <div class="mt-3">
                    <?php echo e($fiscal_days->appends(request()->query())->links(), false); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
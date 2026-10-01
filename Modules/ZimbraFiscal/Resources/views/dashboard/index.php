
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.dashboard')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimbabwe_fiscal'); ?></small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <?php if(!$is_configured): ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong><?php echo app('translator')->get('zimbrafiscal::lang.device_not_configured'); ?></strong>
            <a href="<?php echo e(route('zimbrafiscal.device.index'), false); ?>"><?php echo app('translator')->get('zimbrafiscal::lang.register_device'); ?></a>
        </div>
    <?php endif; ?>

    <!-- Status Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary"><?php echo app('translator')->get('zimbrafiscal::lang.receipts_submitted'); ?></p>
                            <h4 class="my-1 text-success"><?php echo e($stats['total_receipts_submitted'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-success text-white rounded-circle p-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary"><?php echo app('translator')->get('zimbrafiscal::lang.receipts_pending'); ?></p>
                            <h4 class="my-1 text-warning"><?php echo e($stats['pending_receipts'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-warning text-white rounded-circle p-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary"><?php echo app('translator')->get('zimbrafiscal::lang.receipts_failed'); ?></p>
                            <h4 class="my-1 text-danger"><?php echo e($stats['failed_receipts'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-danger text-white rounded-circle p-3">
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary"><?php echo app('translator')->get('zimbrafiscal::lang.offline_queued'); ?></p>
                            <h4 class="my-1 text-info"><?php echo e($stats['offline_queued'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-info text-white rounded-circle p-3">
                            <i class="fas fa-wifi fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Device Info & Quick Actions -->
        <div class="col-lg-4">
            <!-- Device Info Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-server"></i> <?php echo app('translator')->get('zimbrafiscal::lang.device_status'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($device): ?>
                        <table class="table table-sm table-borderless">
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_name'); ?>:</td><td><strong><?php echo e($device->taxpayer_name ?? '-', false); ?></strong></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_tin'); ?>:</td><td><?php echo e($device->taxpayer_tin ?? '-', false); ?></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?>:</td><td><?php echo e($device->device_id, false); ?></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_serial_no'); ?>:</td><td><?php echo e($device->device_serial_no, false); ?></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.operating_mode'); ?>:</td><td><span class="badge bg-primary"><?php echo e($device->operating_mode ?? 'N/A', false); ?></span></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.environment'); ?>:</td><td><span class="badge bg-<?php echo e($device->env === 'production' ? 'danger' : 'warning', false); ?>"><?php echo e(ucfirst($device->env), false); ?></span></td></tr>
                            <tr>
                                <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?>:</td>
                                <td>
                                    <span class="badge bg-<?php echo e($device->status === 'active' ? 'success' : ($device->status === 'registered' ? 'info' : 'warning'), false); ?>">
                                        <?php echo e(ucfirst($device->status), false); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.last_config_sync'); ?>:</td><td><?php echo e($device->last_config_sync ? \Carbon\Carbon::parse($device->last_config_sync)->diffForHumans() : 'Never', false); ?></td></tr>
                            <?php if($device->certificate_valid_till): ?>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.certificate_valid_till'); ?>:</td><td><?php echo e(\Carbon\Carbon::parse($device->certificate_valid_till)->format('Y-m-d'), false); ?></td></tr>
                            <?php endif; ?>
                        </table>
                        <div class="mt-2">
                            <a href="<?php echo e(route('zimbrafiscal.device.index'), false); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-cog"></i> <?php echo app('translator')->get('zimbrafiscal::lang.device_management'); ?>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-server fa-3x text-muted mb-3"></i>
                            <p><?php echo app('translator')->get('zimbrafiscal::lang.no_active_device'); ?></p>
                            <a href="<?php echo e(route('zimbrafiscal.device.index'), false); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> <?php echo app('translator')->get('zimbrafiscal::lang.register_device'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Fiscal Day Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('zimbrafiscal::lang.current_fiscal_day'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($stats['current_fiscal_day']): ?>
                        <?php $cfd = $stats['current_fiscal_day']; ?>
                        <table class="table table-sm table-borderless">
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_no'); ?>:</td><td><strong>#<?php echo e($cfd->fiscal_day_no, false); ?></strong></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?>:</td><td><span class="badge bg-success"><?php echo e($cfd->status, false); ?></span></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.opened_at'); ?>:</td><td><?php echo e($cfd->opened_at ? \Carbon\Carbon::parse($cfd->opened_at)->format('Y-m-d H:i') : '-', false); ?></td></tr>
                            <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter'); ?>:</td><td><?php echo e($cfd->receipt_counter, false); ?></td></tr>
                        </table>
                        <form action="<?php echo e(route('zimbrafiscal.fiscal-days.close', $cfd->id), false); ?>" method="POST" class="d-inline" onsubmit="return confirm('<?php echo app('translator')->get('zimbrafiscal::lang.confirm_close_day'); ?>')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-stop-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.close_fiscal_day'); ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_open_fiscal_day'); ?></p>
                        <?php if($is_configured): ?>
                        <form action="<?php echo e(route('zimbrafiscal.fiscal-days.open'), false); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-play-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.open_fiscal_day'); ?>
                            </button>
                        </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.quick_actions'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('zimbrafiscal.receipts.index'), false); ?>" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-receipt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.receipts'); ?>
                        </a>
                        <a href="<?php echo e(route('zimbrafiscal.fiscal-days.index'), false); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.fiscal_days'); ?>
                        </a>
                        <a href="<?php echo e(route('zimbrafiscal.api-logs'), false); ?>" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-history"></i> <?php echo app('translator')->get('zimbrafiscal::lang.api_logs'); ?>
                        </a>
                        <a href="<?php echo e(route('zimbrafiscal.settings'), false); ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-cogs"></i> <?php echo app('translator')->get('zimbrafiscal::lang.settings'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-8">

            <!-- Failed Receipts -->
            <?php if(count($failed_receipts) > 0): ?>
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.failed_submissions'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.invoice_no'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_type'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_date'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_total'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.error_message'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $failed_receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($receipt->invoice_no ?? '-', false); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo e($receipt->receipt_type, false); ?></span></td>
                                    <td><?php echo e($receipt->receipt_date ? \Carbon\Carbon::parse($receipt->receipt_date)->format('Y-m-d') : '-', false); ?></td>
                                    <td><?php echo e($receipt->receipt_currency, false); ?> <?php echo e(number_format($receipt->receipt_total, 2), false); ?></td>
                                    <td><small class="text-danger"><?php echo e(\Illuminate\Support\Str::limit($receipt->submission_error, 50), false); ?></small></td>
                                    <td>
                                        <form action="<?php echo e(route('zimbrafiscal.receipts.retry', $receipt->id), false); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-xs btn-warning">
                                                <i class="fas fa-redo"></i> <?php echo app('translator')->get('zimbrafiscal::lang.retry_submission'); ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent Fiscal Days -->
            <?php if(count($recent_fiscal_days) > 0): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.recent_fiscal_days'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.fiscal_day_no'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.opened_at'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.closed_at'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.receipt_counter'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recent_fiscal_days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong>#<?php echo e($day->fiscal_day_no, false); ?></strong></td>
                                    <td>
                                        <?php
                                            $dayStatusColor = match($day->status) {
                                                'FiscalDayOpened' => 'success',
                                                'FiscalDayCloseInitiated' => 'warning',
                                                'FiscalDayClosed' => 'secondary',
                                                default => 'info',
                                            };
                                        ?>
                                        <span class="badge bg-<?php echo e($dayStatusColor, false); ?>"><?php echo e($day->status, false); ?></span>
                                    </td>
                                    <td><?php echo e($day->opened_at ? \Carbon\Carbon::parse($day->opened_at)->format('Y-m-d H:i') : '-', false); ?></td>
                                    <td><?php echo e($day->closed_at ? \Carbon\Carbon::parse($day->closed_at)->format('Y-m-d H:i') : '-', false); ?></td>
                                    <td><?php echo e($day->receipt_counter, false); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('zimbrafiscal.fiscal-days.show', $day->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent API Logs -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history"></i> <?php echo app('translator')->get('zimbrafiscal::lang.recent_api_logs'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.endpoint'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.response_time'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.error_message'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $recent_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><small><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></small></td>
                                    <td><code><?php echo e($log->endpoint, false); ?></code></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($log->is_success ? 'success' : 'danger', false); ?>">
                                            <?php echo e($log->is_success ? 'OK' : 'FAIL', false); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($log->response_time_ms, false); ?>ms</td>
                                    <td><small><?php echo e(\Illuminate\Support\Str::limit($log->error_message, 40), false); ?></small></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if(count($recent_logs) > 0): ?>
                    <a href="<?php echo e(route('zimbrafiscal.api-logs'), false); ?>" class="btn btn-sm btn-outline-secondary">
                        <?php echo app('translator')->get('zimbrafiscal::lang.api_logs'); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- API Performance -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('zimbrafiscal::lang.api_performance'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3><?php echo e($stats['total_api_calls'], false); ?></h3>
                            <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.total_api_calls'); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-<?php echo e($stats['api_success_rate'] >= 90 ? 'success' : ($stats['api_success_rate'] >= 70 ? 'warning' : 'danger'), false); ?>">
                                <?php echo e($stats['api_success_rate'], false); ?>%
                            </h3>
                            <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.api_success_rate'); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h3><?php echo e($stats['offline_queued'], false); ?></h3>
                            <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.offline_queued'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
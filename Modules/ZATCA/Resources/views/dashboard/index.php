
<?php $__env->startSection('title', 'ZATCA E-Invoicing Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1>ZATCA E-Invoicing <small>Zakat, Tax & Customs Authority - Saudi Arabia</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <?php if(!$has_onboarding): ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>No Business Location Onboarded!</strong> 
            Please <a href="<?php echo e(route('zatca.onboarding.create'), false); ?>">complete the onboarding process</a> to start using ZATCA e-invoicing.
        </div>
    <?php endif; ?>

    <!-- Settings Check -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-cog"></i> ZATCA Module Settings</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php $__currentLoopData = $settings_checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-2">
                        <span class="text-<?php echo e($check['status'] ? 'success' : 'danger', false); ?>">
                            <i class="fas fa-<?php echo e($check['icon'], false); ?>"></i>
                        </span>
                        <?php echo e($check['label'], false); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a href="<?php echo e(route('zatca.settings.index'), false); ?>" class="btn btn-sm btn-primary mt-2">
                <i class="fas fa-wrench"></i> Apply Settings
            </a>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary">Invoices Synced</p>
                            <h4 class="my-1 text-success"><?php echo e($stats['total_invoices_synced'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Pending Invoices</p>
                            <h4 class="my-1 text-warning"><?php echo e($stats['pending_invoices'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Failed Invoices</p>
                            <h4 class="my-1 text-danger"><?php echo e($stats['failed_invoices'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Onboarded Locations</p>
                            <h4 class="my-1 text-info"><?php echo e($stats['onboarded_locations'], false); ?> / <?php echo e($stats['total_locations'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-info text-white rounded-circle p-3">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('zatca.onboarding.index'), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-building"></i> Manage Onboarding
                        </a>
                        <a href="<?php echo e(route('zatca.invoices.index'), false); ?>" class="btn btn-outline-success">
                            <i class="fas fa-file-invoice"></i> View Invoices
                        </a>
                        <form action="<?php echo e(route('zatca.invoices.bulk-sync'), false); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-warning w-100" onclick="return confirm('Sync all pending invoices?')">
                                <i class="fas fa-sync"></i> Sync All Pending
                            </button>
                        </form>
                        <a href="<?php echo e(route('zatca.settings.index'), false); ?>" class="btn btn-outline-info">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <a href="<?php echo e(route('zatca.settings.api-logs'), false); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-history"></i> API Logs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sync Mode Info -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-sync-alt"></i> Sync Mode</h5>
                </div>
                <div class="card-body">
                    <?php if($settings->sync_mode === 'disable'): ?>
                        <span class="badge bg-secondary fs-6">Manual</span>
                        <p class="mt-2 mb-0 text-muted">Invoices are synced manually when you click the Sync button.</p>
                    <?php elseif($settings->sync_mode === 'instant'): ?>
                        <span class="badge bg-success fs-6">Instant</span>
                        <p class="mt-2 mb-0 text-muted">Invoices sync automatically upon creation.</p>
                    <?php else: ?>
                        <span class="badge bg-info fs-6">Daily</span>
                        <p class="mt-2 mb-0 text-muted">Invoices sync automatically at end of day via cron job.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Failed Invoices -->
        <div class="col-lg-8">
            <?php if($failed_invoices->count() > 0): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-exclamation-triangle text-danger"></i> Recent Failed Invoices</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Error</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $failed_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($inv->invoice_number, false); ?></td>
                                    <td><?php echo e($inv->invoice_date->format('Y-m-d'), false); ?></td>
                                    <td>SAR <?php echo e(number_format($inv->total_including_vat, 2), false); ?></td>
                                    <td><small class="text-danger"><?php echo e(Str::limit($inv->error_message, 50), false); ?></small></td>
                                    <td>
                                        <form action="<?php echo e(route('zatca.invoices.retry', $inv->id), false); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-warning"><i class="fas fa-redo"></i> Retry</button>
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

            <!-- Recent API Logs -->
            <div class="card <?php echo e($failed_invoices->count() > 0 ? 'mt-3' : '', false); ?>">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history"></i> Recent API Activity</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Endpoint</th>
                                    <th>Status</th>
                                    <th>Response Time</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $recent_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><code><?php echo e($log->endpoint, false); ?></code></td>
                                    <td>
                                        <?php if($log->is_success): ?>
                                            <span class="badge bg-success"><?php echo e($log->http_status, false); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><?php echo e($log->http_status ?: 'ERR', false); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($log->response_time_ms, false); ?>ms</td>
                                    <td><?php echo e($log->created_at->diffForHumans(), false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">No API activity yet.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
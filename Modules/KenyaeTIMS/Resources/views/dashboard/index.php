
<?php $__env->startSection('title', 'Kenya eTIMS Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1>Kenya eTIMS <small>KRA Electronic Tax Invoice Management</small></h1>
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
            <strong>Device Not Configured!</strong> 
            Please <a href="<?php echo e(route('kenyaetims.device.index'), false); ?>">register and initialize your OSCU/VSCU device</a> to start using eTIMS.
        </div>
    <?php endif; ?>

    <!-- Status Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary">Sales Submitted</p>
                            <h4 class="my-1 text-success"><?php echo e($stats['total_sales_submitted'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Pending Sales</p>
                            <h4 class="my-1 text-warning"><?php echo e($stats['pending_sales'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Failed Sales</p>
                            <h4 class="my-1 text-danger"><?php echo e($stats['failed_sales'], false); ?></h4>
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
                            <p class="mb-0 text-secondary">Items Registered</p>
                            <h4 class="my-1 text-info"><?php echo e($stats['total_items_registered'], false); ?></h4>
                        </div>
                        <div class="widget-icon-large bg-gradient-info text-white rounded-circle p-3">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Device Info -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-server"></i> Device Status</h5>
                </div>
                <div class="card-body">
                    <?php if($device): ?>
                        <table class="table table-sm table-borderless">
                            <tr><td class="text-muted">TIN/PIN:</td><td><strong><?php echo e($device->tin, false); ?></strong></td></tr>
                            <tr><td class="text-muted">Branch ID:</td><td><?php echo e($device->bhf_id, false); ?></td></tr>
                            <tr><td class="text-muted">Serial No:</td><td><?php echo e($device->dvc_srl_no, false); ?></td></tr>
                            <tr><td class="text-muted">Type:</td><td><span class="badge bg-primary"><?php echo e($device->scu_type, false); ?></span></td></tr>
                            <tr><td class="text-muted">Environment:</td><td><span class="badge bg-<?php echo e($device->env === 'production' ? 'danger' : 'warning', false); ?>"><?php echo e(ucfirst($device->env), false); ?></span></td></tr>
                            <tr>
                                <td class="text-muted">Status:</td>
                                <td>
                                    <span class="badge bg-<?php echo e($device->status === 'active' ? 'success' : ($device->status === 'pending' ? 'warning' : 'danger'), false); ?>">
                                        <?php echo e(ucfirst($device->status), false); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr><td class="text-muted">Last Init:</td><td><?php echo e($device->last_init_at ? $device->last_init_at->diffForHumans() : 'Never', false); ?></td></tr>
                            <tr><td class="text-muted">Last Sync:</td><td><?php echo e($device->last_code_sync_at ? $device->last_code_sync_at->diffForHumans() : 'Never', false); ?></td></tr>
                        </table>
                        <div class="mt-2">
                            <a href="<?php echo e(route('kenyaetims.device.index'), false); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-cog"></i> Manage Device
                            </a>
                            <form action="<?php echo e(route('kenyaetims.settings.sync'), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-sync"></i> Sync with KRA
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-server fa-3x text-muted mb-3"></i>
                            <p>No device registered yet.</p>
                            <a href="<?php echo e(route('kenyaetims.device.index'), false); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Register Device
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('kenyaetims.items.index'), false); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-box"></i> Manage Items
                        </a>
                        <a href="<?php echo e(route('kenyaetims.sales.index'), false); ?>" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-receipt"></i> View Sales
                        </a>
                        <a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-history"></i> API Logs
                        </a>
                        <a href="<?php echo e(route('kenyaetims.notices'), false); ?>" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-bell"></i> KRA Notices
                            <?php if($stats['unread_notices'] > 0): ?>
                                <span class="badge bg-danger"><?php echo e($stats['unread_notices'], false); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-8">
            <!-- Failed Sales -->
            <?php if(count($failed_sales) > 0): ?>
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-exclamation-triangle"></i> Failed Submissions (Requires Attention)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Error</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $failed_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sale->invoice_no, false); ?></td>
                                    <td><?php echo e($sale->sale_date->format('Y-m-d'), false); ?></td>
                                    <td><?php echo e(number_format($sale->total_amt, 2), false); ?></td>
                                    <td><small class="text-danger"><?php echo e(\Illuminate\Support\Str::limit($sale->error_message, 50), false); ?></small></td>
                                    <td>
                                        <form action="<?php echo e(route('kenyaetims.sales.retry', $sale->id), false); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-xs btn-warning">
                                                <i class="fas fa-redo"></i> Retry
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

            <!-- Recent API Logs -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history"></i> Recent API Activity</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Endpoint</th>
                                    <th>Status</th>
                                    <th>Response Time</th>
                                    <th>Message</th>
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
                                    <td><small><?php echo e(\Illuminate\Support\Str::limit($log->result_msg, 40), false); ?></small></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No API activity yet.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if(count($recent_logs) > 0): ?>
                    <a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>" class="btn btn-sm btn-outline-secondary">
                        View All Logs <i class="fas fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- API Success Rate -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar"></i> API Performance</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3><?php echo e($stats['total_api_calls'], false); ?></h3>
                            <p class="text-muted">Total API Calls</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-<?php echo e($stats['api_success_rate'] >= 90 ? 'success' : ($stats['api_success_rate'] >= 70 ? 'warning' : 'danger'), false); ?>">
                                <?php echo e($stats['api_success_rate'], false); ?>%
                            </h3>
                            <p class="text-muted">Success Rate</p>
                        </div>
                        <div class="col-md-4">
                            <h3><?php echo e($stats['total_purchases_submitted'], false); ?></h3>
                            <p class="text-muted">Purchases Submitted</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
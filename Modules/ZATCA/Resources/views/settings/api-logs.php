
<?php $__env->startSection('title', 'ZATCA API Logs'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>ZATCA API Logs <small>Request & Response Audit Trail</small></h1>
</section>

<section class="content">
    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All</option>
                        <option value="1" <?php echo e(request('status') === '1' ? 'selected' : '', false); ?>>Successful</option>
                        <option value="0" <?php echo e(request('status') === '0' ? 'selected' : '', false); ?>>Failed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Endpoint</label>
                    <input type="text" name="endpoint" class="form-control form-control-sm" value="<?php echo e(request('endpoint'), false); ?>" placeholder="e.g. invoices/reporting">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Environment</label>
                    <select name="environment" class="form-select form-select-sm">
                        <option value="">All</option>
                        <option value="sandbox" <?php echo e(request('environment') === 'sandbox' ? 'selected' : '', false); ?>>Sandbox</option>
                        <option value="simulation" <?php echo e(request('environment') === 'simulation' ? 'selected' : '', false); ?>>Simulation</option>
                        <option value="core" <?php echo e(request('environment') === 'core' ? 'selected' : '', false); ?>>Core</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Request / Correlation ID</label>
                    <input type="text" name="request_id" class="form-control form-control-sm" value="<?php echo e(request('request_id'), false); ?>" placeholder="REQ123 / CORR123">
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
                    <a href="<?php echo e(route('zatca.settings.api-logs'), false); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body text-center py-2">
                    <h5 class="mb-0"><?php echo e($stats['total'] ?? 0, false); ?></h5>
                    <small class="text-muted">Total Requests</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body text-center py-2">
                    <h5 class="mb-0 text-success"><?php echo e($stats['successful'] ?? 0, false); ?></h5>
                    <small class="text-muted">Successful</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body text-center py-2">
                    <h5 class="mb-0 text-danger"><?php echo e($stats['failed'] ?? 0, false); ?></h5>
                    <small class="text-muted">Failed</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body text-center py-2">
                    <h5 class="mb-0"><?php echo e($stats['avg_response_time'] ?? 0, false); ?>ms</h5>
                    <small class="text-muted">Avg Response Time</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Timestamp</th>
                            <th>Method</th>
                            <th>Endpoint</th>
                            <th>Environment</th>
                            <th>HTTP Status</th>
                            <th>Response Time</th>
                            <th>Request ID</th>
                            <th>Invoice</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr class="<?php echo e($log->is_success ? '' : 'table-danger', false); ?>">
                            <td><?php echo e($log->id, false); ?></td>
                            <td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td>
                            <td><span class="badge bg-info"><?php echo e($log->method, false); ?></span></td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;" title="<?php echo e($log->endpoint, false); ?>">
                                    <?php echo e($log->endpoint, false); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?php echo e(strtoupper($log->api_environment ?: '-'), false); ?></span>
                            </td>
                            <td>
                                <span class="badge <?php echo e($log->http_status >= 200 && $log->http_status < 300 ? 'bg-success' : ($log->http_status >= 400 ? 'bg-danger' : 'bg-warning'), false); ?>">
                                    <?php echo e($log->http_status ?: 'N/A', false); ?>

                                </span>
                            </td>
                            <td><?php echo e($log->response_time_ms, false); ?>ms</td>
                            <td>
                                <?php if($log->request_id || $log->correlation_id): ?>
                                    <small class="d-block text-monospace"><?php echo e($log->request_id ?: '-', false); ?></small>
                                    <?php if($log->correlation_id): ?>
                                        <small class="text-muted text-monospace"><?php echo e($log->correlation_id, false); ?></small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($log->zatca_invoice_id): ?>
                                    <a href="<?php echo e(route('zatca.invoices.show', $log->zatca_invoice_id), false); ?>">
                                        <?php echo e($log->invoice ? $log->invoice->invoice_number : '#' . $log->zatca_invoice_id, false); ?>

                                    </a>
                                <?php elseif($log->invoice_number): ?>
                                    <span title="<?php echo e($log->invoice_uuid, false); ?>"><?php echo e($log->invoice_number, false); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge <?php echo e($log->is_success ? 'bg-success' : 'bg-danger', false); ?>">
                                    <?php echo e($log->is_success ? 'OK' : 'FAIL', false); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('zatca.settings.api-log-detail', $log->id), false); ?>" class="btn btn-sm btn-outline-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">
                                <i class="fas fa-server"></i> No API logs found.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($logs->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($logs->appends(request()->query())->links(), false); ?>

        </div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('zatca.settings.index'), false); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Settings</a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
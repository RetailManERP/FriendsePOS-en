
<?php $__env->startSection('title', 'eTIMS API Logs'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS API Logs <small>Request & Response History</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.settings'), false); ?>">Settings</a></li>
        <li class="breadcrumb-item active">API Logs</li>
    </ol>
</section>

<section class="content">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-history"></i> API Call Logs</h5>
            <div class="ms-auto">
                <form class="d-flex gap-2" method="GET" action="<?php echo e(route('kenyaetims.api-logs'), false); ?>">
                    <select name="endpoint" class="form-select form-select-sm" style="width: auto">
                        <option value="">All Endpoints</option>
                        <?php $__currentLoopData = $endpoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ep, false); ?>" <?php echo e(request('endpoint') == $ep ? 'selected' : '', false); ?>><?php echo e($ep, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select name="status" class="form-select form-select-sm" style="width: auto">
                        <option value="">All Status</option>
                        <option value="success" <?php echo e(request('status') == 'success' ? 'selected' : '', false); ?>>Success</option>
                        <option value="failed" <?php echo e(request('status') == 'failed' ? 'selected' : '', false); ?>>Failed</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i></button>
                    <a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-times"></i></a>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Endpoint</th>
                            <th>Status</th>
                            <th>Result Code</th>
                            <th>HTTP Code</th>
                            <th>Response Time</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($log->id, false); ?></td>
                            <td><code><?php echo e($log->endpoint, false); ?></code></td>
                            <td>
                                <?php if($log->is_successful): ?>
                                    <span class="badge bg-success">Success</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Failed</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($log->result_cd ?? '-', false); ?></td>
                            <td><?php echo e($log->http_status_code ?? '-', false); ?></td>
                            <td><?php echo e($log->response_time_ms ? $log->response_time_ms . 'ms' : '-', false); ?></td>
                            <td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td>
                            <td>
                                <a href="<?php echo e(route('kenyaetims.api-log-detail', $log->id), false); ?>" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No API log entries found.</td>
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
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('fijifrcs::fijifrcs.api_logs')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header"><h1><?php echo e(__('fijifrcs::fijifrcs.api_logs'), false); ?></h1></section>

<section class="content">
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-3">
                    <label><?php echo e(__('fijifrcs::fijifrcs.endpoint'), false); ?></label>
                    <input type="text" name="endpoint" value="<?php echo e(request('endpoint'), false); ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label><?php echo e(__('fijifrcs::fijifrcs.status'), false); ?></label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All</option>
                        <option value="success" <?php if(request('status') == 'success'): echo 'selected'; endif; ?>>Success</option>
                        <option value="failed" <?php if(request('status') == 'failed'): echo 'selected'; endif; ?>>Failed</option>
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
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-primary btn-sm w-100"><?php echo e(__('fijifrcs::fijifrcs.filter'), false); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th><?php echo e(__('fijifrcs::fijifrcs.timestamp'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.endpoint'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.http_method'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.http_status'), false); ?></th>
                        <th>Env</th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.response_time'), false); ?> (ms)</th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.status'), false); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($log->created_at, false); ?></td>
                            <td><code><?php echo e($log->endpoint, false); ?></code></td>
                            <td><?php echo e($log->method, false); ?></td>
                            <td><?php echo e($log->http_status, false); ?></td>
                            <td><?php echo e(strtoupper($log->environment), false); ?></td>
                            <td><?php echo e($log->response_time_ms, false); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($log->is_success ? 'success' : 'danger', false); ?>">
                                    <?php echo e($log->is_success ? 'OK' : 'ERR', false); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('fijifrcs.settings.api-log-detail', $log->id), false); ?>" class="btn btn-xs btn-outline-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="8" class="text-center p-3 text-muted"><?php echo e(__('fijifrcs::fijifrcs.no_data'), false); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3"><?php echo e($logs->links(), false); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
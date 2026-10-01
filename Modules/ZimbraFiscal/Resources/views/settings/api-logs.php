
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.api_logs')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.api_logs'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-history"></i> <?php echo app('translator')->get('zimbrafiscal::lang.api_logs'); ?></h5>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="<?php echo e(route('zimbrafiscal.api-logs'), false); ?>" class="row g-2 mb-3">
                <div class="col-auto">
                    <input type="text" name="endpoint" class="form-control form-control-sm" placeholder="Endpoint..." value="<?php echo e(request('endpoint'), false); ?>">
                </div>
                <div class="col-auto">
                    <select name="success" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="1" <?php echo e(request('success') === '1' ? 'selected' : '', false); ?>><?php echo app('translator')->get('zimbrafiscal::lang.success'); ?></option>
                        <option value="0" <?php echo e(request('success') === '0' ? 'selected' : '', false); ?>><?php echo app('translator')->get('zimbrafiscal::lang.failed'); ?></option>
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
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.date'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.method'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.endpoint'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.http_status'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.response_time'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.error_message'); ?></th>
                            <th><?php echo app('translator')->get('zimbrafiscal::lang.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><small><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></small></td>
                            <td><span class="badge bg-secondary"><?php echo e($log->method ?? 'GET', false); ?></span></td>
                            <td><code><?php echo e(\Illuminate\Support\Str::limit($log->endpoint, 50), false); ?></code></td>
                            <td><?php echo e($log->http_status_code ?? '-', false); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($log->is_success ? 'success' : 'danger', false); ?>">
                                    <?php echo e($log->is_success ? 'OK' : 'FAIL', false); ?>

                                </span>
                            </td>
                            <td><?php echo e($log->response_time_ms ?? '-', false); ?>ms</td>
                            <td><small class="text-danger"><?php echo e(\Illuminate\Support\Str::limit($log->error_message, 40), false); ?></small></td>
                            <td>
                                <a href="<?php echo e(route('zimbrafiscal.api-log-detail', $log->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3"><?php echo app('translator')->get('zimbrafiscal::lang.no_data'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($logs->hasPages()): ?>
                <div class="mt-3">
                    <?php echo e($logs->appends(request()->query())->links(), false); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
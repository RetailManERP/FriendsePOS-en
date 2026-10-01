
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.api_log_detail')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.api_log_detail'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Log Info</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">ID:</td><td><?php echo e($log->id, false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.date'); ?>:</td><td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.method'); ?>:</td><td><span class="badge bg-secondary"><?php echo e($log->method ?? 'GET', false); ?></span></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.endpoint'); ?>:</td><td><code><?php echo e($log->endpoint, false); ?></code></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.http_status'); ?>:</td><td><?php echo e($log->http_status_code ?? '-', false); ?></td></tr>
                        <tr>
                            <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?>:</td>
                            <td>
                                <span class="badge bg-<?php echo e($log->is_success ? 'success' : 'danger', false); ?>">
                                    <?php echo e($log->is_success ? 'Success' : 'Failed', false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.response_time'); ?>:</td><td><?php echo e($log->response_time_ms ?? '-', false); ?>ms</td></tr>
                        <?php if($log->error_code): ?>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.error_code'); ?>:</td><td><span class="text-danger"><?php echo e($log->error_code, false); ?></span></td></tr>
                        <?php endif; ?>
                        <?php if($log->error_message): ?>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.error_message'); ?>:</td><td><span class="text-danger"><?php echo e($log->error_message, false); ?></span></td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <!-- Request Payload -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-upload"></i> <?php echo app('translator')->get('zimbrafiscal::lang.request_payload'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($log->request_body): ?>
                        <pre style="max-height: 400px; overflow-y: auto; font-size: 0.75rem; background: #f8f9fa; padding: 10px; border-radius: 4px;"><?php echo e(is_string($log->request_body) ? json_encode(json_decode($log->request_body), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : json_encode($log->request_body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), false); ?></pre>
                    <?php else: ?>
                        <p class="text-muted">No request payload.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Response Body -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-download"></i> <?php echo app('translator')->get('zimbrafiscal::lang.response_body'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($log->response_body): ?>
                        <pre style="max-height: 400px; overflow-y: auto; font-size: 0.75rem; background: #f8f9fa; padding: 10px; border-radius: 4px;"><?php echo e(is_string($log->response_body) ? json_encode(json_decode($log->response_body), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : json_encode($log->response_body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), false); ?></pre>
                    <?php else: ?>
                        <p class="text-muted">No response body.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <a href="<?php echo e(route('zimbrafiscal.api-logs'), false); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('zimbrafiscal::lang.back'); ?>
    </a>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
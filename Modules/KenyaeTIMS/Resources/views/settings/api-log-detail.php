
<?php $__env->startSection('title', 'API Log Detail'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>API Log #<?php echo e($log->id, false); ?> <small><?php echo e($log->endpoint, false); ?></small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>">API Logs</a></li>
        <li class="breadcrumb-item active">#<?php echo e($log->id, false); ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Log Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted">Endpoint:</td>
                            <td><code><?php echo e($log->endpoint, false); ?></code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status:</td>
                            <td>
                                <?php if($log->is_successful): ?>
                                    <span class="badge bg-success">Success</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Failed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Result Code:</td>
                            <td><?php echo e($log->result_cd ?? 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Result Message:</td>
                            <td><?php echo e($log->result_msg ?? 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">HTTP Status:</td>
                            <td><?php echo e($log->http_status_code ?? 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Response Time:</td>
                            <td><?php echo e($log->response_time_ms ? $log->response_time_ms . 'ms' : 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Device ID:</td>
                            <td><?php echo e($log->etims_device_id ?? 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Business ID:</td>
                            <td><?php echo e($log->business_id ?? 'N/A', false); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Created:</td>
                            <td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td>
                        </tr>
                    </table>

                    <?php if($log->error_message): ?>
                    <div class="alert alert-danger mt-2 mb-0">
                        <strong>Error:</strong> <?php echo e($log->error_message, false); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Request Payload -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-arrow-up"></i> Request Payload</h5>
                </div>
                <div class="card-body">
                    <?php if($log->request_payload): ?>
                        <pre class="bg-light p-3 rounded" style="max-height: 400px; overflow-y: auto;"><code><?php echo e(json_encode(json_decode($log->request_payload), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), false); ?></code></pre>
                    <?php else: ?>
                        <p class="text-muted mb-0">No request payload recorded.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Response Body -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-arrow-down"></i> Response Body</h5>
                </div>
                <div class="card-body">
                    <?php if($log->response_body): ?>
                        <pre class="bg-light p-3 rounded" style="max-height: 400px; overflow-y: auto;"><code><?php echo e(json_encode(json_decode($log->response_body), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), false); ?></code></pre>
                    <?php else: ?>
                        <p class="text-muted mb-0">No response body recorded.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Logs</a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
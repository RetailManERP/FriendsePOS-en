
<?php $__env->startSection('title', 'API Log Detail'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>
        API Log #<?php echo e($log->id, false); ?>

        <small>
            <span class="badge <?php echo e($log->is_success ? 'bg-success' : 'bg-danger', false); ?>">
                <?php echo e($log->is_success ? 'Successful' : 'Failed', false); ?>

            </span>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('zatca.settings.api-logs'), false); ?>">API Logs</a></li>
        <li class="breadcrumb-item active">#<?php echo e($log->id, false); ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- Request Summary -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-arrow-up"></i> Request</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th width="35%">Timestamp</th>
                            <td><?php echo e($log->created_at->format('Y-m-d H:i:s'), false); ?></td>
                        </tr>
                        <tr>
                            <th>HTTP Method</th>
                            <td><span class="badge bg-info"><?php echo e($log->method, false); ?></span></td>
                        </tr>
                        <tr>
                            <th>Endpoint</th>
                            <td style="word-break: break-all;"><?php echo e($log->endpoint, false); ?></td>
                        </tr>
                        <?php if($log->request_url): ?>
                        <tr>
                            <th>Request URL</th>
                            <td style="word-break: break-all;"><?php echo e($log->request_url, false); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->api_environment): ?>
                        <tr>
                            <th>Environment</th>
                            <td>
                                <span class="badge bg-secondary"><?php echo e(strtoupper($log->api_environment), false); ?></span>
                                <?php if($log->portal_mode): ?>
                                    <small class="text-muted ms-1">Portal: <?php echo e($log->portal_mode, false); ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->zatca_invoice_id): ?>
                        <tr>
                            <th>Related Invoice</th>
                            <td>
                                <a href="<?php echo e(route('zatca.invoices.show', $log->zatca_invoice_id), false); ?>">
                                    <?php echo e($log->invoice ? $log->invoice->invoice_number : '#' . $log->zatca_invoice_id, false); ?>

                                </a>
                            </td>
                        </tr>
                        <?php elseif($log->invoice_number || $log->invoice_uuid): ?>
                        <tr>
                            <th>Invoice Reference</th>
                            <td>
                                <?php echo e($log->invoice_number ?: '-', false); ?>

                                <?php if($log->invoice_uuid): ?>
                                    <br><small class="text-muted text-monospace"><?php echo e($log->invoice_uuid, false); ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->onboarding_id && $log->onboarding): ?>
                        <tr>
                            <th>Related Onboarding</th>
                            <td>
                                <a href="<?php echo e(route('zatca.onboarding.show', $log->onboarding_id), false); ?>">
                                    #<?php echo e($log->onboarding_id, false); ?> - <?php echo e($log->onboarding->organization_name, false); ?>

                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->request_id): ?>
                        <tr>
                            <th>Request ID</th>
                            <td><code><?php echo e($log->request_id, false); ?></code></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->correlation_id): ?>
                        <tr>
                            <th>Correlation ID</th>
                            <td><code><?php echo e($log->correlation_id, false); ?></code></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->request_payload_hash): ?>
                        <tr>
                            <th>Request Hash</th>
                            <td><code><?php echo e($log->request_payload_hash, false); ?></code></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->response_payload_hash): ?>
                        <tr>
                            <th>Response Hash</th>
                            <td><code><?php echo e($log->response_payload_hash, false); ?></code></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <!-- Request Headers -->
            <?php if($log->request_headers): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Request Headers</h5>
                </div>
                <div class="card-body">
                    <pre class="bg-dark text-light p-3 rounded mb-0" style="max-height: 300px; overflow: auto; font-size: 0.8rem;"><code><?php echo e(is_array($log->request_headers) ? json_encode($log->request_headers, JSON_PRETTY_PRINT) : $log->request_headers, false); ?></code></pre>
                </div>
            </div>
            <?php endif; ?>

            <!-- Request Payload -->
            <?php if($log->request_payload): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Request Payload</h5>
                </div>
                <div class="card-body">
                    <pre class="bg-dark text-light p-3 rounded mb-0" style="max-height: 400px; overflow: auto; font-size: 0.8rem;"><code><?php echo e($log->request_payload, false); ?></code></pre>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Response -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-arrow-down"></i> Response</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th width="35%">HTTP Status</th>
                            <td>
                                <span class="badge <?php echo e($log->http_status >= 200 && $log->http_status < 300 ? 'bg-success' : ($log->http_status >= 400 ? 'bg-danger' : 'bg-warning'), false); ?>">
                                    <?php echo e($log->http_status ?: 'N/A', false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Response Time</th>
                            <td><?php echo e($log->response_time_ms, false); ?>ms</td>
                        </tr>
                        <tr>
                            <th>Success</th>
                            <td>
                                <?php if($log->is_success): ?>
                                    <i class="fas fa-check-circle text-success"></i> Yes
                                <?php else: ?>
                                    <i class="fas fa-times-circle text-danger"></i> No
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if($log->result_status): ?>
                        <tr>
                            <th>Result Status</th>
                            <td><?php echo e($log->result_status, false); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($log->result_message): ?>
                        <tr>
                            <th>Result Message</th>
                            <td><span class="text-danger"><?php echo e($log->result_message, false); ?></span></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <!-- Response Headers -->
            <?php if($log->response_headers): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Response Headers</h5>
                </div>
                <div class="card-body">
                    <pre class="bg-dark text-light p-3 rounded mb-0" style="max-height: 300px; overflow: auto; font-size: 0.8rem;"><code><?php echo e(is_array($log->response_headers) ? json_encode($log->response_headers, JSON_PRETTY_PRINT) : $log->response_headers, false); ?></code></pre>
                </div>
            </div>
            <?php endif; ?>

            <!-- Response Payload -->
            <?php if($log->response_payload): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Response Payload</h5>
                </div>
                <div class="card-body">
                    <?php
                        $responsePayload = $log->response_payload;
                        if (is_string($responsePayload)) {
                            $decoded = json_decode($responsePayload, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $responsePayload = json_encode($decoded, JSON_PRETTY_PRINT);
                            }
                        }
                    ?>
                    <pre class="bg-dark text-light p-3 rounded mb-0" style="max-height: 400px; overflow: auto; font-size: 0.8rem;"><code><?php echo e($responsePayload, false); ?></code></pre>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('zatca.settings.api-logs'), false); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to API Logs</a>
        <?php if($log->zatca_invoice_id): ?>
            <a href="<?php echo e(route('zatca.invoices.show', $log->zatca_invoice_id), false); ?>" class="btn btn-outline-primary ms-2">
                <i class="fas fa-file-invoice"></i> View Invoice
            </a>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
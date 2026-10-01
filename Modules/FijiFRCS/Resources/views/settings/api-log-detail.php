
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.api_log_detail')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header"><h1><?php echo e(__('fijifrcs::fijifrcs.api_log_detail'), false); ?> #<?php echo e($log->id, false); ?></h1></section>

<section class="content">
    <div class="card mb-3">
        <div class="card-body">
            <p><strong><?php echo e(__('fijifrcs::fijifrcs.timestamp'), false); ?>:</strong> <?php echo e($log->created_at, false); ?></p>
            <p><strong><?php echo e(__('fijifrcs::fijifrcs.endpoint'), false); ?>:</strong> <code><?php echo e($log->endpoint, false); ?></code></p>
            <p><strong>URL:</strong> <code><?php echo e($log->request_url, false); ?></code></p>
            <p><strong><?php echo e(__('fijifrcs::fijifrcs.http_method'), false); ?>:</strong> <?php echo e($log->method, false); ?></p>
            <p><strong><?php echo e(__('fijifrcs::fijifrcs.http_status'), false); ?>:</strong> <?php echo e($log->http_status, false); ?></p>
            <p><strong><?php echo e(__('fijifrcs::fijifrcs.response_time'), false); ?>:</strong> <?php echo e($log->response_time_ms, false); ?> ms</p>
            <p><strong>Result:</strong> <?php echo e($log->result_status, false); ?> — <?php echo e($log->result_message, false); ?></p>
            <p><strong>Correlation ID:</strong> <code><?php echo e($log->correlation_id, false); ?></code></p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.request_headers'), false); ?></h5></div>
        <div class="card-body">
            <pre class="mb-0"><?php echo e(json_encode($log->request_headers, JSON_PRETTY_PRINT), false); ?></pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.request_body'), false); ?></h5></div>
        <div class="card-body">
            <pre class="mb-0" style="max-height:400px;overflow:auto;"><?php echo e($log->request_payload, false); ?></pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.response_body'), false); ?></h5></div>
        <div class="card-body">
            <pre class="mb-0" style="max-height:400px;overflow:auto;"><?php echo e($log->response_payload, false); ?></pre>
        </div>
    </div>

    <a href="<?php echo e(route('fijifrcs.settings.api-logs'), false); ?>" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> <?php echo e(__('fijifrcs::fijifrcs.back'), false); ?>

    </a>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
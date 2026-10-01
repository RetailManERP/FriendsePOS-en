
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.module_name')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e(__('fijifrcs::fijifrcs.module_name'), false); ?>

        <small>Fiji Revenue & Customs Service - VMS / EFD</small>
    </h1>
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
            <strong>No EFD Activated!</strong>
            Please <a href="<?php echo e(route('fijifrcs.onboarding.create'), false); ?>">register and activate an EFD</a> with FRCS to start submitting fiscal receipts.
        </div>
    <?php endif; ?>

    
    <div class="card mb-3">
        <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-cog"></i> Module Settings</h5></div>
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
            <a href="<?php echo e(route('fijifrcs.settings.index'), false); ?>" class="btn btn-sm btn-primary mt-2">
                <i class="fas fa-wrench"></i> Configure
            </a>
        </div>
    </div>

    
    <div class="row">
        <?php $__currentLoopData = [
            ['Receipts Submitted', 'total_receipts_submitted', 'success', 'check-circle'],
            ['Pending', 'pending_receipts', 'warning', 'clock'],
            ['Failed', 'failed_receipts', 'danger', 'times-circle'],
            ['Refunds', 'refund_receipts', 'info', 'undo'],
            ['API Calls', 'total_api_calls', 'secondary', 'plug'],
            ['API Success Rate', 'api_success_rate', 'primary', 'percent'],
            ['Activated EFDs', 'activated_efds', 'success', 'cash-register'],
            ['Total EFDs', 'total_efds', 'secondary', 'list'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 text-secondary"><?php echo e($tile[0], false); ?></p>
                            <h4 class="my-1 text-<?php echo e($tile[2], false); ?>">
                                <?php echo e($stats[$tile[1]], false); ?><?php echo e($tile[1] === 'api_success_rate' ? '%' : '', false); ?>

                            </h4>
                        </div>
                        <div class="text-<?php echo e($tile[2], false); ?>">
                            <i class="fas fa-<?php echo e($tile[3], false); ?> fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if($failed_invoices->isNotEmpty()): ?>
        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0 text-danger"><i class="fas fa-exclamation-circle"></i> Recent Failed Receipts</h5></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead><tr><th>Receipt #</th><th>Date</th><th>Total (FJD)</th><th>Error</th><th></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $failed_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($inv->invoice_number, false); ?></td>
                                <td><?php echo e($inv->invoice_date, false); ?></td>
                                <td><?php echo e(number_format($inv->total_including_vat, 2), false); ?></td>
                                <td class="text-danger"><?php echo e(\Str::limit($inv->error_message, 60), false); ?></td>
                                <td><a href="<?php echo e(route('fijifrcs.invoices.show', $inv->id), false); ?>" class="btn btn-xs btn-outline-primary">View</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-stream"></i> Recent API Activity</h5></div>
        <div class="card-body p-0">
            <?php if($recent_logs->isEmpty()): ?>
                <div class="p-3 text-muted"><?php echo e(__('fijifrcs::fijifrcs.no_data'), false); ?></div>
            <?php else: ?>
                <table class="table table-sm mb-0">
                    <thead><tr><th>Time</th><th>Endpoint</th><th>Status</th><th>HTTP</th><th>ms</th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $recent_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($log->created_at, false); ?></td>
                                <td><code><?php echo e($log->endpoint, false); ?></code></td>
                                <td>
                                    <?php if($log->is_success): ?>
                                        <span class="badge bg-success">OK</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">ERR</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($log->http_status, false); ?></td>
                                <td><?php echo e($log->response_time_ms, false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
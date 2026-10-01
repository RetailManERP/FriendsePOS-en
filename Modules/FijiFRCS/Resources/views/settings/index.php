
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.settings')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header"><h1><?php echo e(__('fijifrcs::fijifrcs.settings'), false); ?></h1></section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('fijifrcs.settings.update'), false); ?>">
        <?php echo csrf_field(); ?>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">Taxpayer Defaults</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.tin'), false); ?></label>
                    <input type="text" name="tin" value="<?php echo e($settings->tin, false); ?>" class="form-control">
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.vat_registration_number'), false); ?></label>
                    <input type="text" name="vat_registration_number" value="<?php echo e($settings->vat_registration_number, false); ?>" class="form-control">
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.environment'), false); ?></label>
                    <select name="environment" class="form-select">
                        <?php $__currentLoopData = $environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($code, false); ?>" <?php if($settings->environment == $code): echo 'selected'; endif; ?>><?php echo e($label, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.legal_name'), false); ?></label>
                    <input type="text" name="business_legal_name" value="<?php echo e($settings->business_legal_name, false); ?>" class="form-control">
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.trading_name'), false); ?></label>
                    <input type="text" name="business_trading_name" value="<?php echo e($settings->business_trading_name, false); ?>" class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.sync_configuration'), false); ?></h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.sync_mode'), false); ?></label>
                    <select name="sync_mode" class="form-select">
                        <?php $__currentLoopData = $sync_modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($code, false); ?>" <?php if($settings->sync_mode == $code): echo 'selected'; endif; ?>><?php echo e($label, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.cron_schedule'), false); ?></label>
                    <input type="text" name="cron_schedule" value="<?php echo e($settings->cron_schedule, false); ?>" class="form-control">
                </div>
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="sync_sales_returns" value="1" class="form-check-input" id="sr" <?php if($settings->sync_sales_returns): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="sr"><?php echo e(__('fijifrcs::fijifrcs.sync_sales_returns'), false); ?></label>
                </div>
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="validate_tax_rates" value="1" class="form-check-input" id="vt" <?php if($settings->validate_tax_rates): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="vt"><?php echo e(__('fijifrcs::fijifrcs.validate_tax_rates'), false); ?></label>
                </div>
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="require_buyer_tin_above_threshold" value="1" class="form-check-input" id="rbt" <?php if($settings->require_buyer_tin_above_threshold): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="rbt"><?php echo e(__('fijifrcs::fijifrcs.require_buyer_tin_above_threshold'), false); ?></label>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.buyer_tin_threshold_amount'), false); ?></label>
                    <input type="number" step="0.01" name="buyer_tin_threshold_amount" value="<?php echo e($settings->buyer_tin_threshold_amount, false); ?>" class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.receipt_settings'), false); ?></h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="include_qr_on_receipt" value="1" class="form-check-input" id="qr" <?php if($settings->include_qr_on_receipt): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="qr"><?php echo e(__('fijifrcs::fijifrcs.include_qr_on_receipt'), false); ?></label>
                </div>
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="print_fiscal_logo" value="1" class="form-check-input" id="logo" <?php if($settings->print_fiscal_logo): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="logo"><?php echo e(__('fijifrcs::fijifrcs.print_fiscal_logo'), false); ?></label>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.receipt_paper_size'), false); ?></label>
                    <select name="receipt_paper_size" class="form-select">
                        <?php $__currentLoopData = ['58mm','80mm','A4','A5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sz, false); ?>" <?php if($settings->receipt_paper_size == $sz): echo 'selected'; endif; ?>><?php echo e($sz, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">Reports &amp; Notifications</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="auto_z_report_daily" value="1" class="form-check-input" id="zr" <?php if($settings->auto_z_report_daily): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="zr"><?php echo e(__('fijifrcs::fijifrcs.auto_z_report_daily'), false); ?></label>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.z_report_time'), false); ?></label>
                    <input type="time" name="z_report_time" value="<?php echo e(\Carbon\Carbon::parse($settings->z_report_time)->format('H:i'), false); ?>" class="form-control">
                </div>
                <div class="col-md-4 form-check pt-4">
                    <input type="checkbox" name="notify_sync_errors" value="1" class="form-check-input" id="ns" <?php if($settings->notify_sync_errors): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="ns"><?php echo e(__('fijifrcs::fijifrcs.notify_sync_errors'), false); ?></label>
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.notification_email'), false); ?></label>
                    <input type="email" name="notification_email" value="<?php echo e($settings->notification_email, false); ?>" class="form-control">
                </div>
                <div class="col-md-3 form-check pt-4">
                    <input type="checkbox" name="allow_offline_buffer" value="1" class="form-check-input" id="ob" <?php if($settings->allow_offline_buffer): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="ob"><?php echo e(__('fijifrcs::fijifrcs.allow_offline_buffer'), false); ?></label>
                </div>
                <div class="col-md-3">
                    <label><?php echo e(__('fijifrcs::fijifrcs.offline_buffer_max_minutes'), false); ?></label>
                    <input type="number" name="offline_buffer_max_minutes" value="<?php echo e($settings->offline_buffer_max_minutes, false); ?>" class="form-control">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary"><i class="fa fa-save"></i> <?php echo e(__('fijifrcs::fijifrcs.save_settings'), false); ?></button>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
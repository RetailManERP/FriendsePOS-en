
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.device_management')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.device_management'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Add Device Form -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.add_device'); ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('zimbrafiscal.device.store'), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="device_id" class="form-label"><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?> <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['device_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="device_id" name="device_id" value="<?php echo e(old('device_id'), false); ?>" required>
                            <small class="text-muted">Assigned by ZIMRA during device registration.</small>
                            <?php $__errorArgs = ['device_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message, false); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="activation_key" class="form-label"><?php echo app('translator')->get('zimbrafiscal::lang.activation_key'); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['activation_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="activation_key" name="activation_key" value="<?php echo e(old('activation_key'), false); ?>" required>
                            <small class="text-muted">Provided by ZIMRA for device activation.</small>
                            <?php $__errorArgs = ['activation_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message, false); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="device_serial_no" class="form-label"><?php echo app('translator')->get('zimbrafiscal::lang.device_serial_no'); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['device_serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="device_serial_no" name="device_serial_no" value="<?php echo e(old('device_serial_no'), false); ?>" maxlength="20" required>
                            <?php $__errorArgs = ['device_serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message, false); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="env" class="form-label"><?php echo app('translator')->get('zimbrafiscal::lang.environment'); ?> <span class="text-danger">*</span></label>
                            <select class="form-select" id="env" name="env" required>
                                <?php $__currentLoopData = $environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key, false); ?>" <?php echo e(old('env') === $key ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="location_id" class="form-label"><?php echo app('translator')->get('zimbrafiscal::lang.business_location'); ?></label>
                            <select class="form-select" id="location_id" name="location_id">
                                <option value="">-- All Locations --</option>
                                <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc_id => $loc_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($loc_id, false); ?>" <?php echo e(old('location_id') == $loc_id ? 'selected' : '', false); ?>><?php echo e($loc_name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo app('translator')->get('zimbrafiscal::lang.save'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Device List -->
        <div class="col-lg-7">
            <?php $__empty_18 = true; $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-microchip"></i>
                        Device #<?php echo e($device->device_id, false); ?>

                        <span class="badge bg-<?php echo e($device->status === 'active' ? 'success' : ($device->status === 'registered' ? 'info' : 'warning'), false); ?>">
                            <?php echo e(ucfirst($device->status), false); ?>

                        </span>
                        <span class="badge bg-<?php echo e($device->env === 'production' ? 'danger' : 'warning', false); ?>"><?php echo e(ucfirst($device->env), false); ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_serial_no'); ?>:</td><td><?php echo e($device->device_serial_no, false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_name'); ?>:</td><td><?php echo e($device->taxpayer_name ?? '-', false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_tin'); ?>:</td><td><?php echo e($device->taxpayer_tin ?? '-', false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.vat_number'); ?>:</td><td><?php echo e($device->vat_number ?? '-', false); ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.branch_name'); ?>:</td><td><?php echo e($device->device_branch_name ?? '-', false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.operating_mode'); ?>:</td><td><?php echo e($device->operating_mode ?? '-', false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.certificate_valid_till'); ?>:</td><td><?php echo e($device->certificate_valid_till ? \Carbon\Carbon::parse($device->certificate_valid_till)->format('Y-m-d') : '-', false); ?></td></tr>
                                <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.last_config_sync'); ?>:</td><td><?php echo e($device->last_config_sync ? \Carbon\Carbon::parse($device->last_config_sync)->diffForHumans() : 'Never', false); ?></td></tr>
                            </table>
                        </div>
                    </div>

                    <!-- Applicable Taxes -->
                    <?php if($device->applicable_taxes && count($device->applicable_taxes) > 0): ?>
                    <div class="mt-2">
                        <strong><?php echo app('translator')->get('zimbrafiscal::lang.applicable_taxes'); ?>:</strong>
                        <div class="mt-1">
                            <?php $__currentLoopData = $device->applicable_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-outline-secondary me-1 mb-1">
                                    <?php echo e($tax['taxName'] ?? $tax['taxCode'] ?? '?', false); ?> (<?php echo e($tax['taxPercent'] ?? 0, false); ?>%)
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <hr>
                    <div class="d-flex flex-wrap gap-1">
                        <?php if($device->status === 'pending'): ?>
                            
                            <form action="<?php echo e(route('zimbrafiscal.device.verify', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-info">
                                    <i class="fas fa-user-check"></i> <?php echo app('translator')->get('zimbrafiscal::lang.verify_taxpayer'); ?>
                                </button>
                            </form>
                            
                            <form action="<?php echo e(route('zimbrafiscal.device.register', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-success" <?php echo e(!$device->taxpayer_name ? 'disabled' : '', false); ?>>
                                    <i class="fas fa-certificate"></i> <?php echo app('translator')->get('zimbrafiscal::lang.register_with_zimra'); ?>
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if($device->status === 'registered'): ?>
                            
                            <form action="<?php echo e(route('zimbrafiscal.device.fetch-config', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download"></i> <?php echo app('translator')->get('zimbrafiscal::lang.fetch_config'); ?>
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if($device->status === 'active'): ?>
                            <a href="<?php echo e(route('zimbrafiscal.device.status', $device->id), false); ?>" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-info-circle"></i> <?php echo app('translator')->get('zimbrafiscal::lang.check_status'); ?>
                            </a>
                            <form action="<?php echo e(route('zimbrafiscal.device.fetch-config', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-sync"></i> <?php echo app('translator')->get('zimbrafiscal::lang.sync_config'); ?>
                                </button>
                            </form>
                            <form action="<?php echo e(route('zimbrafiscal.device.ping', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-satellite-dish"></i> <?php echo app('translator')->get('zimbrafiscal::lang.ping_server'); ?>
                                </button>
                            </form>
                            <form action="<?php echo e(route('zimbrafiscal.device.renew-cert', $device->id), false); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-key"></i> <?php echo app('translator')->get('zimbrafiscal::lang.renew_certificate'); ?>
                                </button>
                            </form>
                        <?php endif; ?>

                        <form action="<?php echo e(route('zimbrafiscal.device.destroy', $device->id), false); ?>" method="POST" class="d-inline" onsubmit="return confirm('<?php echo app('translator')->get('zimbrafiscal::lang.confirm_delete'); ?>')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> <?php echo app('translator')->get('zimbrafiscal::lang.delete'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-microchip fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No devices registered yet. Use the form to add your first ZIMRA fiscal device.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
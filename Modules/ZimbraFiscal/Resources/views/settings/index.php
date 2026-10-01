
<?php $__env->startSection('title', __('zimbrafiscal::lang.zimra_fdms') . ' - ' . __('zimbrafiscal::lang.settings')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('zimbrafiscal::lang.settings'); ?> <small><?php echo app('translator')->get('zimbrafiscal::lang.zimra_fdms'); ?></small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Config Display -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-cogs"></i> <?php echo app('translator')->get('zimbrafiscal::lang.operating_config'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($device): ?>
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_id'); ?>:</td><td><?php echo e($device->device_id, false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.device_serial_no'); ?>:</td><td><?php echo e($device->device_serial_no, false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_name'); ?>:</td><td><strong><?php echo e($device->taxpayer_name ?? '-', false); ?></strong></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.taxpayer_tin'); ?>:</td><td><?php echo e($device->taxpayer_tin ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.vat_number'); ?>:</td><td><?php echo e($device->vat_number ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.branch_name'); ?>:</td><td><?php echo e($device->device_branch_name ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.operating_mode'); ?>:</td><td><span class="badge bg-primary"><?php echo e($device->operating_mode ?? 'N/A', false); ?></span></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.environment'); ?>:</td><td><span class="badge bg-<?php echo e($device->env === 'production' ? 'danger' : 'warning', false); ?>"><?php echo e(ucfirst($device->env), false); ?></span></td></tr>
                        <tr>
                            <td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.status'); ?>:</td>
                            <td><span class="badge bg-<?php echo e($device->status === 'active' ? 'success' : ($device->status === 'registered' ? 'info' : 'warning'), false); ?>"><?php echo e(ucfirst($device->status), false); ?></span></td>
                        </tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.certificate_valid_till'); ?>:</td><td><?php echo e($device->certificate_valid_till ? \Carbon\Carbon::parse($device->certificate_valid_till)->format('Y-m-d') : '-', false); ?></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.qr_url'); ?>:</td><td><small><?php echo e($device->qr_url ?? '-', false); ?></small></td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.day_max_hrs'); ?>:</td><td><?php echo e($device->taxpayer_day_max_hrs ?? 24, false); ?> hrs</td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.day_end_notification_hrs'); ?>:</td><td><?php echo e($device->taxpayer_day_end_notification_hrs ?? 2, false); ?> hrs</td></tr>
                        <tr><td class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.last_config_sync'); ?>:</td><td><?php echo e($device->last_config_sync ? \Carbon\Carbon::parse($device->last_config_sync)->format('Y-m-d H:i:s') : 'Never', false); ?></td></tr>
                    </table>
                    <?php else: ?>
                        <p class="text-muted"><?php echo app('translator')->get('zimbrafiscal::lang.no_active_device'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Branch Address & Contacts -->
            <?php if($device && ($device->device_branch_address || $device->device_branch_contacts)): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-building"></i> <?php echo app('translator')->get('zimbrafiscal::lang.branch_address'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($device->device_branch_address): ?>
                        <?php $addr = is_array($device->device_branch_address) ? $device->device_branch_address : json_decode($device->device_branch_address, true); ?>
                        <?php if(is_array($addr)): ?>
                            <table class="table table-sm table-borderless">
                                <?php $__currentLoopData = $addr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($value): ?>
                                    <tr><td class="text-muted"><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?>:</td><td><?php echo e($value, false); ?></td></tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        <?php else: ?>
                            <p><?php echo e($device->device_branch_address, false); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if($device->device_branch_contacts): ?>
                        <?php $contacts = is_array($device->device_branch_contacts) ? $device->device_branch_contacts : json_decode($device->device_branch_contacts, true); ?>
                        <?php if(is_array($contacts)): ?>
                            <hr>
                            <strong>Contacts:</strong>
                            <table class="table table-sm table-borderless mt-1">
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($value): ?>
                                    <tr><td class="text-muted"><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?>:</td><td><?php echo e($value, false); ?></td></tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Applicable Taxes & Actions -->
        <div class="col-lg-6">
            <!-- Applicable Taxes -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-percentage"></i> <?php echo app('translator')->get('zimbrafiscal::lang.applicable_taxes'); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($device && $device->applicable_taxes && count($device->applicable_taxes) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_id'); ?></th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_code'); ?></th>
                                    <th>Tax Name</th>
                                    <th><?php echo app('translator')->get('zimbrafiscal::lang.tax_percent'); ?></th>
                                    <th>Valid From</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $device->applicable_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($tax['taxID'] ?? '-', false); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo e($tax['taxCode'] ?? '-', false); ?></span></td>
                                    <td><?php echo e($tax['taxName'] ?? '-', false); ?></td>
                                    <td><?php echo e(($tax['taxPercent'] ?? 0), false); ?>%</td>
                                    <td><?php echo e($tax['validFrom'] ?? '-', false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="text-muted">No taxes configured. Please sync configuration from ZIMRA.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sync Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-sync"></i> Sync Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="<?php echo e(route('zimbrafiscal.settings.sync-config'), false); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync"></i> <?php echo app('translator')->get('zimbrafiscal::lang.sync_config'); ?>
                            </button>
                        </form>
                        <form action="<?php echo e(route('zimbrafiscal.settings.sync-hs-codes'), false); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-info w-100">
                                <i class="fas fa-barcode"></i> <?php echo app('translator')->get('zimbrafiscal::lang.sync_hs_codes'); ?>
                            </button>
                        </form>
                        <form action="<?php echo e(route('zimbrafiscal.settings.server-cert'), false); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-certificate"></i> <?php echo app('translator')->get('zimbrafiscal::lang.get_server_cert'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-link"></i> <?php echo app('translator')->get('zimbrafiscal::lang.quick_actions'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('zimbrafiscal.api-logs'), false); ?>" class="btn btn-outline-info w-100">
                            <i class="fas fa-history"></i> <?php echo app('translator')->get('zimbrafiscal::lang.api_logs'); ?>
                        </a>
                        <a href="<?php echo e(route('zimbrafiscal.device.index'), false); ?>" class="btn btn-outline-primary w-100">
                            <i class="fas fa-microchip"></i> <?php echo app('translator')->get('zimbrafiscal::lang.device_management'); ?>
                        </a>
                        <a href="<?php echo e(route('zimbrafiscal.dashboard'), false); ?>" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('zimbrafiscal::lang.dashboard'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
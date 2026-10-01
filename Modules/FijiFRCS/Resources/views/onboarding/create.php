
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.add_new_onboarding')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e(__('fijifrcs::fijifrcs.add_new_onboarding'), false); ?></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('fijifrcs.onboarding.store'), false); ?>">
        <?php echo csrf_field(); ?>
        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">Taxpayer Information</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.business_location'), false); ?> *</label>
                    <select name="location_id" class="form-select" required>
                        <option value="">--</option>
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.tin'), false); ?> *</label>
                    <input type="text" name="tin" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.vat_registration_number'), false); ?></label>
                    <input type="text" name="vat_registration_number" class="form-control">
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.legal_name'), false); ?> *</label>
                    <input type="text" name="legal_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.trading_name'), false); ?></label>
                    <input type="text" name="trading_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.business_category'), false); ?></label>
                    <input type="text" name="business_category" class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">Address</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.physical_address_line1'), false); ?> *</label>
                    <input type="text" name="physical_address_line1" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.physical_address_line2'), false); ?></label>
                    <input type="text" name="physical_address_line2" class="form-control">
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.city'), false); ?> *</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.province'), false); ?> *</label>
                    <select name="province" class="form-select" required>
                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p, false); ?>"><?php echo e($p, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.postal_code'), false); ?></label>
                    <input type="text" name="postal_code" class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">EFD Device Credentials (issued by FRCS)</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.efd_serial_number'), false); ?> *</label>
                    <input type="text" name="efd_serial_number" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.efd_pos_id'), false); ?> *</label>
                    <input type="text" name="efd_pos_id" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label><?php echo e(__('fijifrcs::fijifrcs.efd_branch_code'), false); ?></label>
                    <input type="text" name="efd_branch_code" class="form-control">
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.activation_code'), false); ?> *</label>
                    <input type="password" name="activation_code" class="form-control" required>
                    <small class="text-muted">One-time activation code retrieved from the FRCS portal.</small>
                </div>
                <div class="col-md-6">
                    <label><?php echo e(__('fijifrcs::fijifrcs.environment'), false); ?> *</label>
                    <select name="environment" class="form-select" required>
                        <option value="sandbox"><?php echo e(__('fijifrcs::fijifrcs.sandbox'), false); ?></option>
                        <option value="production"><?php echo e(__('fijifrcs::fijifrcs.production'), false); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="<?php echo e(route('fijifrcs.onboarding.index'), false); ?>" class="btn btn-secondary"><?php echo e(__('fijifrcs::fijifrcs.cancel'), false); ?></a>
            <button class="btn btn-primary"><i class="fa fa-bolt"></i> Activate with FRCS</button>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
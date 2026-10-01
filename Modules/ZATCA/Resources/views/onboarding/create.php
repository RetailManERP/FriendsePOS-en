
<?php $__env->startSection('title', 'Onboard Business Location - ZATCA'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Onboard Business Location <small>ZATCA E-Invoicing Registration</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <?php if($existing && $existing->isOnboarded()): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> This location is already onboarded (<?php echo e(ucfirst($existing->status), false); ?>). Submitting will update the existing onboarding.
        </div>
    <?php endif; ?>

    <?php if($existing && !empty($existing->getSimulationReadinessIssues())): ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> The existing onboarding is missing some simulation credentials:
            <ul class="mb-0 mt-2">
                <?php $__currentLoopData = $existing->getSimulationReadinessIssues(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($issue, false); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="mt-2">Submit this form again with a fresh ZATCA OTP to rebuild the missing testing credentials.</div>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('zatca.onboarding.store'), false); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="row">
            <!-- Business Location Selection -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-map-marker-alt"></i> Business Location & Portal Mode</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="location_id" class="form-label">Business Location</label>
                                    <select name="location_id" id="location_id" class="form-select">
                                        <option value="">-- All Locations --</option>
                                        <?php if($location): ?>
                                            <option value="<?php echo e($location->id, false); ?>" selected><?php echo e($location->name, false); ?></option>
                                        <?php elseif(!empty($locations)): ?>
                                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($loc->id, false); ?>" <?php echo e(old('location_id', $existing->location_id ?? '') == $loc->id ? 'selected' : '', false); ?>>
                                                    <?php echo e($loc->name, false); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-muted">Each location must be onboarded separately.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="portal_mode" class="form-label">Portal Mode <span class="text-danger">*</span></label>
                                    <select name="portal_mode" id="portal_mode" class="form-select" required>
                                        <?php $__currentLoopData = $portal_modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value, false); ?>" <?php echo e(old('portal_mode', $existing ? $existing->getNormalizedPortalMode() : 'simulation') === $value ? 'selected' : '', false); ?>>
                                                <?php echo e($label, false); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <small class="text-muted">Use Sandbox or Simulation first. Switch to Core only after successful testing.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="otp" class="form-label">OTP (One Time Password) <span class="text-danger">*</span></label>
                                    <input type="text" name="otp" id="otp" class="form-control" value="<?php echo e(old('otp', ''), false); ?>" required maxlength="20" placeholder="Enter the latest OTP from your ZATCA portal">
                                    <small class="text-muted">Use the current OTP from the selected ZATCA portal. Do not rely on hardcoded test OTPs.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-building"></i> Organization Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="organization_name" class="form-label">Organization Name <span class="text-danger">*</span></label>
                            <input type="text" name="organization_name" id="organization_name" class="form-control" 
                                value="<?php echo e(old('organization_name', $existing->organization_name ?? ''), false); ?>" required maxlength="255" placeholder="Company or Organization Name">
                        </div>
                        <div class="mb-3">
                            <label for="organization_unit_name" class="form-label">Organization Unit / Branch Name <span class="text-danger">*</span></label>
                            <input type="text" name="organization_unit_name" id="organization_unit_name" class="form-control" 
                                value="<?php echo e(old('organization_unit_name', $existing->organization_unit_name ?? ''), false); ?>" required maxlength="255" placeholder="Branch Name">
                        </div>
                        <div class="mb-3">
                            <label for="vat_registration_number" class="form-label">VAT Registration Number <span class="text-danger">*</span></label>
                            <input type="text" name="vat_registration_number" id="vat_registration_number" class="form-control" 
                                value="<?php echo e(old('vat_registration_number', $existing->vat_registration_number ?? ''), false); ?>" required maxlength="50" placeholder="e.g. 300000000000003">
                        </div>
                        <div class="mb-3">
                            <label for="vat_type" class="form-label">VAT Registration Type <span class="text-danger">*</span></label>
                            <select name="vat_type" id="vat_type" class="form-select" required>
                                <option value="B2C" <?php echo e(old('vat_type', $existing->vat_type ?? 'B2C') === 'B2C' ? 'selected' : '', false); ?>>B2C (Simplified)</option>
                                <option value="B2B" <?php echo e(old('vat_type', $existing->vat_type ?? '') === 'B2B' ? 'selected' : '', false); ?>>B2B (Standard)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Device Serial Number <span class="text-danger">*</span></label>
                            <input type="text" name="serial_number" id="serial_number" class="form-control" 
                                value="<?php echo e(old('serial_number', $existing->serial_number ?? ''), false); ?>" maxlength="100" required placeholder="Device serial used for CSR generation">
                        </div>
                        <div class="mb-3">
                            <label for="crn_number" class="form-label">CRN Number <span class="text-danger">*</span></label>
                            <input type="text" name="crn_number" id="crn_number" class="form-control" 
                                value="<?php echo e(old('crn_number', $existing->crn_number ?? ''), false); ?>" required maxlength="50" placeholder="Commercial Registration Number">
                        </div>
                        <div class="mb-3">
                            <label for="business_category" class="form-label">Business Category <span class="text-danger">*</span></label>
                            <input type="text" name="business_category" id="business_category" class="form-control" 
                                value="<?php echo e(old('business_category', $existing->business_category ?? ''), false); ?>" required maxlength="100" placeholder="e.g. Retail, Wholesale">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registered Address -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-map"></i> Registered Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="street_name" class="form-label">Street Name <span class="text-danger">*</span></label>
                            <input type="text" name="street_name" id="street_name" class="form-control" 
                                value="<?php echo e(old('street_name', $existing->street_name ?? ''), false); ?>" required maxlength="255">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="building_number" class="form-label">Building Number <span class="text-danger">*</span></label>
                                    <input type="text" name="building_number" id="building_number" class="form-control" 
                                        value="<?php echo e(old('building_number', $existing->building_number ?? ''), false); ?>" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="plot_identification" class="form-label">Plot Identification</label>
                                    <input type="text" name="plot_identification" id="plot_identification" class="form-control" 
                                        value="<?php echo e(old('plot_identification', $existing->plot_identification ?? ''), false); ?>" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <input type="text" name="district" id="district" class="form-control" 
                                value="<?php echo e(old('district', $existing->district ?? ''), false); ?>" maxlength="100">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control" 
                                        value="<?php echo e(old('city', $existing->city ?? ''), false); ?>" required maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city_subdivision" class="form-label">City Subdivision</label>
                                    <input type="text" name="city_subdivision" id="city_subdivision" class="form-control" 
                                        value="<?php echo e(old('city_subdivision', $existing->city_subdivision ?? ''), false); ?>" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Postal Code <span class="text-danger">*</span></label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" 
                                value="<?php echo e(old('postal_code', $existing->postal_code ?? ''), false); ?>" required maxlength="20">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('zatca.onboarding.index'), false); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-paper-plane"></i> Submit Onboarding
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        this.disabled = true;
        this.closest('form').submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
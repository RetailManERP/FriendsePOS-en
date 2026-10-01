
<?php $__env->startSection('title', 'eTIMS Device Management'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS Device Management <small>OSCU/VSCU Registration</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item active">Devices</li>
    </ol>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Register New Device -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle"></i> Register New Device</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('kenyaetims.device.store'), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">KRA TIN / PIN <span class="text-danger">*</span></label>
                            <input type="text" name="tin" class="form-control" 
                                   placeholder="e.g., P000111222A" required maxlength="20"
                                   value="<?php echo e(old('tin'), false); ?>">
                            <small class="text-muted">Your KRA PIN (Tax Identification Number)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Branch ID <span class="text-danger">*</span></label>
                            <input type="text" name="bhf_id" class="form-control" 
                                   placeholder="00" value="<?php echo e(old('bhf_id', '00'), false); ?>" required maxlength="10">
                            <small class="text-muted">00 for main branch, 01, 02, etc. for sub-branches</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Device Serial Number <span class="text-danger">*</span></label>
                            <input type="text" name="dvc_srl_no" class="form-control" 
                                   placeholder="Enter device serial number" required maxlength="50"
                                   value="<?php echo e(old('dvc_srl_no'), false); ?>">
                            <small class="text-muted">Unique serial number assigned by KRA</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SCU Type <span class="text-danger">*</span></label>
                            <select name="scu_type" class="form-select" required>
                                <?php $__currentLoopData = $scu_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key, false); ?>" <?php echo e(old('scu_type') === $key ? 'selected' : '', false); ?>>
                                        <?php echo e($label, false); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Environment <span class="text-danger">*</span></label>
                            <select name="env" class="form-select" required>
                                <?php $__currentLoopData = $environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key, false); ?>" <?php echo e(old('env', 'sandbox') === $key ? 'selected' : '', false); ?>>
                                        <?php echo e($label, false); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-muted">Use Sandbox for testing, Production for live transactions</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Business Location</label>
                            <select name="location_id" class="form-select">
                                <option value="">-- All Locations --</option>
                                <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Register Device
                        </button>
                    </form>
                </div>
            </div>

            <!-- OSCU/VSCU Signup Guide -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> How to Sign Up for OSCU/VSCU</h5>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li>Visit <a href="https://etims.kra.go.ke" target="_blank">etims.kra.go.ke</a></li>
                        <li>Log in with your KRA PIN and password</li>
                        <li>Navigate to <strong>Service Request > OSCU/VSCU Registration</strong></li>
                        <li>Fill in business details and select device type</li>
                        <li>Submit and receive your Device Serial Number</li>
                        <li>Enter the serial number above and click "Register Device"</li>
                        <li>Then click "Initialize with KRA" to activate</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Existing Devices -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-server"></i> Registered Devices</h5>
                </div>
                <div class="card-body">
                    <?php if($devices->isEmpty()): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-server fa-4x text-muted mb-3"></i>
                            <p class="text-muted">No devices registered yet. Use the form on the left to register your first device.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>TIN/PIN</th>
                                        <th>Branch</th>
                                        <th>Serial</th>
                                        <th>Type</th>
                                        <th>Env</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($dev->tin, false); ?></strong></td>
                                        <td><?php echo e($dev->bhf_id, false); ?></td>
                                        <td><code><?php echo e($dev->dvc_srl_no, false); ?></code></td>
                                        <td><span class="badge bg-primary"><?php echo e($dev->scu_type, false); ?></span></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($dev->env === 'production' ? 'danger' : 'warning', false); ?>">
                                                <?php echo e(ucfirst($dev->env), false); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo e($dev->status === 'active' ? 'success' : ($dev->status === 'pending' ? 'warning' : 'danger'), false); ?>">
                                                <?php echo e(ucfirst($dev->status), false); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if($dev->status === 'pending'): ?>
                                                <form action="<?php echo e(route('kenyaetims.device.initialize', $dev->id), false); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-xs btn-success" 
                                                            onclick="return confirm('Initialize this device with KRA? This will connect to the KRA eTIMS server.')">
                                                        <i class="fas fa-play"></i> Initialize
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <?php if($dev->status === 'active'): ?>
                                                <form action="<?php echo e(route('kenyaetims.device.initialize', $dev->id), false); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-xs btn-info">
                                                        <i class="fas fa-sync"></i> Re-Init
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form action="<?php echo e(route('kenyaetims.device.destroy', $dev->id), false); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Are you sure you want to deactivate this device?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light" role="button" data-bs-toggle="collapse" data-bs-target="#etimsGuide" aria-expanded="false">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book"></i> User Guide: What is the eTIMS Integration Token?
                        <i class="fas fa-chevron-down float-end mt-1"></i>
                    </h5>
                </div>
                <div class="collapse" id="etimsGuide">
                    <div class="card-body">

                        <h6 class="fw-bold text-primary"><i class="fas fa-question-circle"></i> What is the Integration Token?</h6>
                        <p>
                            The <strong>integration token</strong> (also known as <strong>Communication Key / cmcKey</strong>) is a unique authentication key issued by <strong>KRA</strong> when you register your device (OSCU or VSCU) on the KRA eTIMS portal.
                            It proves your POS system is authorized to communicate with KRA's tax servers.
                        </p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Important:</strong> You do NOT generate this token yourself &mdash; KRA provides it during device registration.
                        </div>

                        <hr>

                        <h6 class="fw-bold text-primary"><i class="fas fa-list-ol"></i> How to Get the Integration Token</h6>

                        <div class="mb-3">
                            <strong>Step 1: Log in to KRA eTIMS Portal</strong>
                            <ul class="mb-1">
                                <li>Go to <a href="https://etims.kra.go.ke" target="_blank" rel="noopener noreferrer">https://etims.kra.go.ke</a></li>
                                <li>Sign in using your <strong>KRA PIN</strong> and <strong>iTax password</strong></li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Step 2: Register Your Device (OSCU or VSCU)</strong>
                            <ul class="mb-1">
                                <li>Navigate to <strong>Taxpayer Device Management</strong> (or Service Request &gt; OSCU/VSCU Registration)</li>
                                <li>Select your <strong>Branch</strong> (Head Office = <code>00</code>)</li>
                                <li>Choose the device type:
                                    <ul>
                                        <li><strong>OSCU</strong> (Online Sales Control Unit) &mdash; cloud-based, recommended for most businesses</li>
                                        <li><strong>VSCU</strong> (Virtual Sales Control Unit) &mdash; software-based, runs locally</li>
                                    </ul>
                                </li>
                                <li>Submit the registration</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Step 3: KRA Issues Your Credentials</strong>
                            <p class="mb-1">After successful registration, KRA provides the following:</p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr><th style="width:30%;">Credential</th><th>Description</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><strong>TIN / KRA PIN</strong></td><td>Your Tax Identification Number (e.g., <code>P051234567X</code>)</td></tr>
                                        <tr><td><strong>Branch ID (bhfId)</strong></td><td>Branch code &mdash; <code>00</code> for head office, <code>01</code>, <code>02</code> for sub-branches</td></tr>
                                        <tr><td><strong>Device Serial Number</strong></td><td>Unique device identifier assigned by KRA</td></tr>
                                        <tr>
                                            <td><strong>Communication Key (cmcKey)</strong></td>
                                            <td><span class="badge bg-success">This is the Integration Token</span> &mdash; used to authenticate API calls between your POS and KRA</td>
                                        </tr>
                                        <tr><td><strong>Signature Key (signKey)</strong></td><td>Used to digitally sign invoices sent to KRA</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Step 4: Enter Credentials in This Page</strong>
                            <ol class="mb-1">
                                <li>In the <strong>"Register New Device"</strong> form on this page, enter your <strong>TIN</strong>, <strong>Branch ID</strong>, <strong>Device Serial Number</strong>, and select the correct <strong>SCU Type</strong> and <strong>Environment</strong>.</li>
                                <li>Click <strong>"Register Device"</strong> to save.</li>
                                <li>Then click the <strong><i class="fas fa-play"></i> Initialize</strong> button next to the device in the table.</li>
                                <li>The system will automatically call KRA's initialization API, retrieve the <strong>Communication Key</strong> (integration token) and <strong>Signature Key</strong>, and store them securely.</li>
                            </ol>
                        </div>

                        <hr>

                        <h6 class="fw-bold text-primary"><i class="fas fa-lightbulb"></i> Quick Summary</h6>
                        <div class="alert alert-info mb-0">
                            <ol class="mb-0">
                                <li>Log in to <a href="https://etims.kra.go.ke" target="_blank" rel="noopener noreferrer">etims.kra.go.ke</a> with your KRA PIN</li>
                                <li>Register your device (OSCU or VSCU) to get a Device Serial Number</li>
                                <li>Enter the TIN, Branch ID and Serial Number on this page and click <strong>"Register Device"</strong></li>
                                <li>Click <strong>"Initialize with KRA"</strong> &mdash; the system retrieves the integration token automatically</li>
                                <li>For <strong>Sandbox (testing)</strong>, KRA provides test credentials. For <strong>Production (live)</strong>, you must register through the official eTIMS portal.</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
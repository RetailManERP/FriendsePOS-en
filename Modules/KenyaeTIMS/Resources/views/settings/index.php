
<?php $__env->startSection('title', 'eTIMS Settings'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS Settings <small>Configuration & Sync</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item active">Settings</li>
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
        <div class="col-lg-6">
            <!-- Environment Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-cog"></i> eTIMS Configuration</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">Module Version:</td><td><?php echo e(config('kenyaetims.module_version'), false); ?></td></tr>
                        <tr><td class="text-muted">Environment:</td><td>
                            <span class="badge bg-<?php echo e(config('kenyaetims.environment') === 'production' ? 'danger' : 'warning', false); ?>">
                                <?php echo e(ucfirst(config('kenyaetims.environment')), false); ?>

                            </span>
                        </td></tr>
                        <tr><td class="text-muted">API Base URL:</td><td><code><?php echo e(config('kenyaetims.api_base_url'), false); ?></code></td></tr>
                        <tr><td class="text-muted">Sandbox URL:</td><td><code><?php echo e(config('kenyaetims.api_sandbox_url'), false); ?></code></td></tr>
                        <tr><td class="text-muted">Production URL:</td><td><code><?php echo e(config('kenyaetims.api_production_url'), false); ?></code></td></tr>
                    </table>

                    <div class="alert alert-info mt-3">
                        <strong>To change environment:</strong> Update <code>ETIMS_ENVIRONMENT</code> and <code>ETIMS_API_BASE_URL</code> in your <code>.env</code> file.
                    </div>
                </div>
            </div>

            <!-- Sync Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-sync"></i> Data Synchronization</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Sync code lists, item classifications, notices, and import items from KRA.</p>
                    <form action="<?php echo e(route('kenyaetims.settings.sync'), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Run full sync with KRA? This may take a moment.')">
                            <i class="fas fa-sync"></i> Full Sync with KRA
                        </button>
                    </form>

                    <?php if($device && $device->last_code_sync_at): ?>
                        <p class="mt-2 text-muted">
                            <small>Last synced: <?php echo e($device->last_code_sync_at->format('Y-m-d H:i:s'), false); ?> (<?php echo e($device->last_code_sync_at->diffForHumans(), false); ?>)</small>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Tax Types Reference -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-percent"></i> Kenya Tax Types</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr><th>Code</th><th>Name</th><th class="text-end">Rate</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tax_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="badge bg-info"><?php echo e($code, false); ?></span></td>
                                <td><?php echo e($info['name'], false); ?></td>
                                <td class="text-end"><?php echo e($info['rate'], false); ?>%</td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Types Reference -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-money-bill"></i> Payment Types</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr><th>Code</th><th>Name</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="badge bg-secondary"><?php echo e($code, false); ?></span></td>
                                <td><?php echo e($name, false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-external-link-alt"></i> Useful Links</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="https://etims.kra.go.ke" target="_blank"><i class="fas fa-link"></i> KRA eTIMS Portal</a></li>
                        <li class="mb-2"><a href="https://www.kra.go.ke" target="_blank"><i class="fas fa-link"></i> Kenya Revenue Authority</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('kenyaetims.api-logs'), false); ?>"><i class="fas fa-history"></i> API Logs</a></li>
                        <li><a href="<?php echo e(route('kenyaetims.notices'), false); ?>"><i class="fas fa-bell"></i> KRA Notices</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
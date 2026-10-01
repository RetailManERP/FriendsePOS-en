
<?php $__env->startSection('title', 'ZATCA Onboarding'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>ZATCA Onboarding <small>Business Location Registration</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <?php
        $allowed_onboarding = true;
        if(!empty($common_settings['enable_total_tax_sale'])) { 
            $allowed_onboarding = false;
        }
        if(!empty($common_settings['enable_total_discount_sale'])) { 
            $allowed_onboarding = false;
        }

        $tax_rate_missing = false;
        $required_tax_rates = [0.0, 5.0, 15.0];
        $configured_tax_rates = [];

        foreach($tax_rates as $tax_rate) {
            $configured_tax_rates[] = (float) $tax_rate['amount'];
        }

        foreach ($required_tax_rates as $required_tax_rate) {
            if (!in_array($required_tax_rate, $configured_tax_rates, true)) {
                $allowed_onboarding = false;
                $tax_rate_missing = true;
                break;
            }
        }
    ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-list"></i> Zatca Onboarding Requirements</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="fas <?php if($tax_rate_missing): ?> fa-circle text-danger <?php else: ?> fa-check text-success <?php endif; ?>"></i> VAT (Tax Rates) (0%, 5%, 15%) configured in the system.
                </li>
                <li class="list-group-item">
                    <i class="fas <?php if(!empty($common_settings['enable_total_tax_sale'])): ?> fa-circle text-danger <?php else: ?> fa-check text-success <?php endif; ?>"></i> Disable Invoice Tax
                </li>
                <li class="list-group-item">
                    <i class="fas <?php if(!empty($common_settings['enable_total_discount_sale'])): ?> fa-circle text-danger <?php else: ?> fa-check text-success <?php endif; ?>"></i> Disable Invoice Discount
                </li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-building"></i> Onboarded Locations</h5>
            <?php if($allowed_onboarding): ?>
            <a href="<?php echo e(route('zatca.onboarding.create'), false); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Onboard New Location
            </a>
            <?php endif; ?>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Organization</th>
                            <th>VAT Number</th>
                            <th>Portal Mode</th>
                            <th>Status</th>
                            <th>Compliance</th>
                            <th>Simulation</th>
                            <th>Certificate</th>
                            <th>Onboarded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $onboardings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $onboarding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($onboarding->location->name ?? 'All Locations', false); ?></td>
                            <td><?php echo e($onboarding->organization_name, false); ?></td>
                            <td><?php echo e($onboarding->vat_registration_number, false); ?></td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getPortalModeBadgeClass(), false); ?>"><?php echo e($onboarding->getPortalModeLabel(), false); ?></span>
                            </td>
                            <td>
                                <?php
                                    $statusColors = [
                                        'pending' => 'bg-warning',
                                        'onboarded' => 'bg-info',
                                        'active' => 'bg-success',
                                        'failed' => 'bg-danger',
                                        'revoked' => 'bg-secondary',
                                    ];
                                ?>
                                <span class="badge <?php echo e($statusColors[$onboarding->status] ?? 'bg-secondary', false); ?>">
                                    <?php echo e(ucfirst($onboarding->status), false); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getComplianceCheckBadgeClass(), false); ?>">
                                    <?php echo e(ucfirst($onboarding->compliance_check_status ?? 'pending'), false); ?>

                                </span>
                            </td>
                            <td>
                                <?php ($simulationIssues = $onboarding->getSimulationReadinessIssues()); ?>
                                <span class="badge <?php echo e($onboarding->getSimulationReadinessBadgeClass(), false); ?>">
                                    <?php echo e($onboarding->getSimulationReadinessLabel(), false); ?>

                                </span>
                                <?php if(!empty($simulationIssues)): ?>
                                    <br>
                                    <small class="text-danger"><?php echo e(count($simulationIssues), false); ?> issue(s)</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getCertificateHealthBadgeClass(), false); ?>">
                                    <?php echo e($onboarding->getCertificateHealthLabel(), false); ?>

                                </span>
                                <?php if($onboarding->getCertificateExpiryDate()): ?>
                                    <br>
                                    <small class="text-muted">
                                        <?php echo e($onboarding->getCertificateExpiryDate()->format('Y-m-d'), false); ?>

                                        <?php ($daysRemaining = $onboarding->getDaysUntilCertificateExpiry()); ?>
                                        <?php if($daysRemaining !== null): ?>
                                            (<?php echo e($daysRemaining, false); ?>d)
                                        <?php endif; ?>
                                    </small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($onboarding->onboarded_at ? $onboarding->onboarded_at->format('Y-m-d H:i') : '-', false); ?></td>
                            <td>
                                <a href="<?php echo e(route('zatca.onboarding.show', $onboarding->id), false); ?>" class="btn btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($onboarding->canSwitchToCore()): ?>
                                    <form action="<?php echo e(route('zatca.onboarding.switch-to-core', $onboarding->id), false); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-sm btn-success" title="Switch to Live Mode" onclick="return confirm('Switch to Live Core Mode? This will use real ZATCA API.')">
                                            <i class="fas fa-rocket"></i> Go Live
                                        </button>
                                    </form>
                                <?php elseif($onboarding->isOnboarded() && $onboarding->portal_mode !== 'core'): ?>
                                    <span class="badge bg-warning text-dark">Check First</span>
                                <?php endif; ?>
                                <?php if($onboarding->isLiveMode() && $onboarding->shouldRenewCertificate('production')): ?>
                                    <span class="badge bg-danger">Renew Soon</span>
                                <?php endif; ?>
                                <form action="<?php echo e(route('zatca.onboarding.destroy', $onboarding->id), false); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" title="Revoke" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle"></i> No business locations onboarded yet.
                                <br>
                                <?php if($allowed_onboarding): ?>
                                <a href="<?php echo e(route('zatca.onboarding.create'), false); ?>" class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-plus"></i> Start Onboarding
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-question-circle"></i> How Onboarding Works</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center mb-3">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width:50px;height:50px;font-size:20px;">1</div>
                    </div>
                    <h6 class="text-center">Onboarding</h6>
                    <p class="text-muted text-center small">Complete Onboarding Form and submit to get onboarding certificate.</p>
                </div>
                <div class="col-md-4">
                    <div class="text-center mb-3">
                        <div class="rounded-circle bg-info text-white d-inline-flex align-items-center justify-content-center" style="width:50px;height:50px;font-size:20px;">2</div>
                    </div>
                    <h6 class="text-center">Compliance Check</h6>
                    <p class="text-muted text-center small">Run the compliance check to submit sample invoice check after CSID issuance so the environment is validated before you request production access.</p>
                </div>
                <div class="col-md-4">
                    <div class="text-center mb-3">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center" style="width:50px;height:50px;font-size:20px;">3</div>
                    </div>
                    <h6 class="text-center">Get Production Certificate (Core Mode)</h6>
                    <p class="text-muted text-center small">Move to Core only after the compliance check passes and the client confirms production credentials.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
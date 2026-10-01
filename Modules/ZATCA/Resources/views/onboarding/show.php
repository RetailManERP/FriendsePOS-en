
<?php $__env->startSection('title', 'Onboarding Details - ZATCA'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Onboarding Details <small><?php echo e($onboarding->organization_name, false); ?></small></h1>
</section>

<section class="content">
    <div class="row">
        <!-- Status Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                <?php
                                    $statusColors = ['pending' => 'bg-warning', 'onboarded' => 'bg-info', 'active' => 'bg-success', 'failed' => 'bg-danger', 'revoked' => 'bg-secondary'];
                                ?>
                                <span class="badge <?php echo e($statusColors[$onboarding->status] ?? 'bg-secondary', false); ?>"><?php echo e(ucfirst($onboarding->status), false); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Portal Mode:</strong></td>
                            <td><?php echo e($onboarding->getPortalModeLabel(), false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td><?php echo e($onboarding->location->name ?? 'All Locations', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Onboarded:</strong></td>
                            <td><?php echo e($onboarding->onboarded_at ? $onboarding->onboarded_at->format('Y-m-d H:i') : 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Invoice Counter:</strong></td>
                            <td><?php echo e($onboarding->invoice_counter, false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Compliance Check:</strong></td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getComplianceCheckBadgeClass(), false); ?>">
                                    <?php echo e(ucfirst($onboarding->compliance_check_status ?? 'pending'), false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Simulation Ready:</strong></td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getSimulationReadinessBadgeClass(), false); ?>">
                                    <?php echo e($onboarding->getSimulationReadinessLabel(), false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Last Check:</strong></td>
                            <td><?php echo e($onboarding->last_compliance_check_at ? $onboarding->last_compliance_check_at->format('Y-m-d H:i') : 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Sample UUID:</strong></td>
                            <td><?php echo e($onboarding->last_compliance_invoice_uuid ?: 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Active Certificate:</strong></td>
                            <td>
                                <span class="badge <?php echo e($onboarding->getCertificateHealthBadgeClass(), false); ?>">
                                    <?php echo e($onboarding->getCertificateHealthLabel(), false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Active Expiry:</strong></td>
                            <td>
                                <?php if($onboarding->getCertificateExpiryDate()): ?>
                                    <?php echo e($onboarding->getCertificateExpiryDate()->format('Y-m-d H:i'), false); ?>

                                    <?php ($daysRemaining = $onboarding->getDaysUntilCertificateExpiry()); ?>
                                    <?php if($daysRemaining !== null): ?>
                                        <br><small class="text-muted"><?php echo e($daysRemaining, false); ?> day(s) remaining</small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Not tracked yet
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Credentials Sealed:</strong></td>
                            <td><?php echo e($onboarding->credentials_encrypted_at ? $onboarding->credentials_encrypted_at->format('Y-m-d H:i') : 'Not yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Last Renewal:</strong></td>
                            <td>
                                <?php echo e($onboarding->last_renewal_attempt_at ? $onboarding->last_renewal_attempt_at->format('Y-m-d H:i') : 'Not yet', false); ?>

                                <?php if($onboarding->last_renewal_status): ?>
                                    <br><small class="text-muted"><?php echo e(ucfirst($onboarding->last_renewal_status), false); ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <?php if($onboarding->isOnboarded() && $onboarding->hasComplianceCredentials()): ?>
                        <form action="<?php echo e(route('zatca.onboarding.run-compliance-check', $onboarding->id), false); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Run ZATCA compliance check using a signed sample invoice?')">
                                <i class="fas fa-check-circle"></i> Run Compliance Check
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if($onboarding->isOnboarded() && $onboarding->hasPassedComplianceCheck()): ?>
                        <form action="<?php echo e(route('zatca.onboarding.request-production-csid', $onboarding->id), false); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-info w-100" onclick="return confirm('Request a fresh Production CSID from ZATCA? This can be used to refresh production credentials for invoice reporting/clearance.')">
                                <i class="fas fa-certificate"></i> Get Production CSID
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if($onboarding->canSwitchToCore()): ?>
                        <form action="<?php echo e(route('zatca.onboarding.switch-to-core', $onboarding->id), false); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100" onclick="return confirm('Switch to Live Core Mode?')">
                                <i class="fas fa-rocket"></i> Switch to Live Core Mode
                            </button>
                        </form>
                    <?php elseif($onboarding->isOnboarded() && $onboarding->portal_mode !== 'core'): ?>
                        <div class="alert alert-warning mt-3 mb-0">
                            Pass the compliance check before switching this onboarding to live core mode.
                        </div>
                    <?php endif; ?>

                    <?php if($onboarding->isLiveMode()): ?>
                        <form action="<?php echo e(route('zatca.onboarding.renew-production-certificate', $onboarding->id), false); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <label class="form-label"><strong>Renew Production CSID</strong></label>
                            <input type="text" name="otp" class="form-control mb-2" placeholder="Enter fresh ZATCA OTP" required>
                            <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Renew the live production certificate with a fresh OTP?')">
                                <i class="fas fa-sync-alt"></i> Renew Production Certificate
                            </button>
                            <small class="text-muted d-block mt-2">Use a fresh portal-generated OTP. Renewal keeps the current live certificate until ZATCA returns the new one successfully.</small>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Organization Info -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-building"></i> Organization</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td><strong>Name:</strong></td><td><?php echo e($onboarding->organization_name, false); ?></td></tr>
                        <tr><td><strong>Unit:</strong></td><td><?php echo e($onboarding->organization_unit_name, false); ?></td></tr>
                        <tr><td><strong>VAT:</strong></td><td><?php echo e($onboarding->vat_registration_number, false); ?></td></tr>
                        <tr><td><strong>VAT Type:</strong></td><td><?php echo e($onboarding->vat_type, false); ?></td></tr>
                        <tr><td><strong>CRN:</strong></td><td><?php echo e($onboarding->crn_number, false); ?></td></tr>
                        <tr><td><strong>Category:</strong></td><td><?php echo e($onboarding->business_category, false); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-map-marker-alt"></i> Address</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td><strong>Street:</strong></td><td><?php echo e($onboarding->street_name, false); ?></td></tr>
                        <tr><td><strong>Building:</strong></td><td><?php echo e($onboarding->building_number, false); ?></td></tr>
                        <tr><td><strong>District:</strong></td><td><?php echo e($onboarding->district, false); ?></td></tr>
                        <tr><td><strong>City:</strong></td><td><?php echo e($onboarding->city, false); ?></td></tr>
                        <tr><td><strong>Postal Code:</strong></td><td><?php echo e($onboarding->postal_code, false); ?></td></tr>
                        <tr><td><strong>Country:</strong></td><td><?php echo e($onboarding->country_code, false); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if($onboarding->error_message): ?>
    <div class="alert alert-danger">
        <strong>Error:</strong> <?php echo e($onboarding->error_message, false); ?>

    </div>
    <?php endif; ?>

    <?php ($simulationIssues = $onboarding->getSimulationReadinessIssues()); ?>
    <?php if($onboarding->isTestingMode() && !empty($simulationIssues)): ?>
    <div class="alert alert-danger">
        <strong>Simulation Smoke Test Blocked:</strong>
        <ul class="mb-0 mt-2">
            <?php $__currentLoopData = $simulationIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($issue, false); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="mt-2">
            Re-run onboarding for this location with a fresh ZATCA OTP to rebuild the missing testing credentials, then execute
            <code>php artisan zatca:simulation-test --onboarding=<?php echo e($onboarding->id, false); ?> --mode=compliance</code>.
        </div>
    </div>
    <?php elseif($onboarding->isTestingMode()): ?>
    <div class="alert alert-info">
        This onboarding is ready for a real simulation smoke test. Use
        <code>php artisan zatca:simulation-test --onboarding=<?php echo e($onboarding->id, false); ?> --mode=compliance</code>
        for the compliance check, or switch <code>--mode=reporting</code> / <code>--mode=clearance</code> for invoice submission smoke tests.
    </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-certificate"></i> Certificate Lifecycle</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td><strong>Compliance Certificate:</strong></td>
                            <td><span class="badge <?php echo e($onboarding->getCertificateHealthBadgeClass('compliance'), false); ?>"><?php echo e($onboarding->getCertificateHealthLabel('compliance'), false); ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Issued:</strong></td>
                            <td><?php echo e($onboarding->getCertificateIssuedDate('compliance') ? $onboarding->getCertificateIssuedDate('compliance')->format('Y-m-d H:i') : 'Not tracked yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Expires:</strong></td>
                            <td><?php echo e($onboarding->getCertificateExpiryDate('compliance') ? $onboarding->getCertificateExpiryDate('compliance')->format('Y-m-d H:i') : 'Not tracked yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fingerprint:</strong></td>
                            <td><small class="text-monospace"><?php echo e($onboarding->compliance_certificate_fingerprint ?: 'Not tracked yet', false); ?></small></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td><strong>Production Certificate:</strong></td>
                            <td><span class="badge <?php echo e($onboarding->getCertificateHealthBadgeClass('production'), false); ?>"><?php echo e($onboarding->getCertificateHealthLabel('production'), false); ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Issued:</strong></td>
                            <td><?php echo e($onboarding->getCertificateIssuedDate('production') ? $onboarding->getCertificateIssuedDate('production')->format('Y-m-d H:i') : 'Not tracked yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Expires:</strong></td>
                            <td><?php echo e($onboarding->getCertificateExpiryDate('production') ? $onboarding->getCertificateExpiryDate('production')->format('Y-m-d H:i') : 'Not tracked yet', false); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fingerprint:</strong></td>
                            <td><small class="text-monospace"><?php echo e($onboarding->production_certificate_fingerprint ?: 'Not tracked yet', false); ?></small></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php if($onboarding->last_renewal_error): ?>
                <div class="alert alert-warning mt-3 mb-0">
                    <strong>Last Renewal Error:</strong> <?php echo e($onboarding->last_renewal_error, false); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('zatca.onboarding.index'), false); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Onboarding List
        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
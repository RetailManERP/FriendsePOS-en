
<?php $__env->startSection('title', 'ZATCA Settings'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>ZATCA Settings <small>Configure E-Invoicing</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('zatca.settings.update'), false); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="row">
            <!-- Sync Configuration -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-sync"></i> Sync Configuration</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sync Mode <span class="text-danger">*</span></label>
                            <select name="sync_mode" class="form-select" required>
                                <option value="disable" <?php echo e(($settings->sync_mode ?? 'disable') === 'disable' ? 'selected' : '', false); ?>>Disabled (Manual)</option>
                                <option value="instant" <?php echo e(($settings->sync_mode ?? '') === 'instant' ? 'selected' : '', false); ?>>Instant (Real-time)</option>
                                <option value="daily" <?php echo e(($settings->sync_mode ?? '') === 'daily' ? 'selected' : '', false); ?>>Daily (Cron Job)</option>
                            </select>
                            <div class="form-text">
                                <strong>Disabled:</strong> Sync invoices manually from the invoice list.<br>
                                <strong>Instant:</strong> Automatically sync each invoice after sale is completed.<br>
                                <strong>Daily:</strong> Batch sync all pending invoices once daily via cron.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ZATCA Phase <span class="text-danger">*</span></label>
                            <select name="phase" class="form-select" required>
                                <option value="phase1" <?php echo e(($settings->phase ?? 'phase1') === 'phase1' ? 'selected' : '', false); ?>>Phase 1 - Generation</option>
                                <option value="phase2" <?php echo e(($settings->phase ?? '') === 'phase2' ? 'selected' : '', false); ?>>Phase 2 - Integration</option>
                            </select>
                            <div class="form-text">Phase 1 generates invoices locally. Phase 2 integrates with ZATCA APIs for clearance/reporting.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Default Invoice Sub-Type</label>
                            <select name="default_invoice_sub_type" class="form-select">
                                <option value="B2C" <?php echo e(($settings->default_invoice_sub_type ?? 'B2C') === 'B2C' ? 'selected' : '', false); ?>>B2C (Simplified - Reporting)</option>
                                <option value="B2B" <?php echo e(($settings->default_invoice_sub_type ?? '') === 'B2B' ? 'selected' : '', false); ?>>B2B (Standard - Clearance)</option>
                            </select>
                            <div class="form-text">B2C invoices are reported. B2B invoices require clearance before they become valid.</div>
                        </div>

                        <div class="form-check mb-2">
                            <input type="hidden" name="sync_sales_returns" value="0">
                            <input type="checkbox" class="form-check-input" name="sync_sales_returns" value="1" id="syncReturns"
                                   <?php echo e(($settings->sync_sales_returns ?? true) ? 'checked' : '', false); ?>>
                            <label class="form-check-label" for="syncReturns">Auto-sync sales returns (credit notes)</label>
                        </div>

                        <div class="form-check mb-2">
                            <input type="hidden" name="validate_tax_rates" value="0">
                            <input type="checkbox" class="form-check-input" name="validate_tax_rates" value="1" id="validateTax"
                                   <?php echo e(($settings->validate_tax_rates ?? true) ? 'checked' : '', false); ?>>
                            <label class="form-check-label" for="validateTax">Validate ZATCA-compliant tax rates (0%, 5%, 15%)</label>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="card mb-3">
                    <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-bell"></i> Notifications</h5></div>
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input type="hidden" name="notify_sync_errors" value="0">
                            <input type="checkbox" class="form-check-input" name="notify_sync_errors" value="1" id="notifyErrors"
                                   <?php echo e(($settings->notify_sync_errors ?? true) ? 'checked' : '', false); ?>>
                            <label class="form-check-label" for="notifyErrors">Notify admin on sync errors</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notification Email</label>
                            <input type="email" name="notification_email" class="form-control" value="<?php echo e($settings->notification_email ?? '', false); ?>" placeholder="admin@example.com">
                        </div>
                    </div>
                </div>
            </div>

            <!-- PDF & Display Settings -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-file-pdf"></i> PDF Settings</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">PDF Paper Size</label>
                            <select name="pdf_size" class="form-select">
                                <option value="A4" <?php echo e(($settings->pdf_size ?? 'A4') === 'A4' ? 'selected' : '', false); ?>>A4</option>
                                <option value="A3" <?php echo e(($settings->pdf_size ?? '') === 'A3' ? 'selected' : '', false); ?>>A3</option>
                            </select>
                        </div>
                        <div class="form-check mb-2">
                            <input type="hidden" name="include_qr_on_pdf" value="0">
                            <input type="checkbox" class="form-check-input" name="include_qr_on_pdf" value="1" id="pdfShowQr"
                                   <?php echo e(($settings->include_qr_on_pdf ?? true) ? 'checked' : '', false); ?>>
                            <label class="form-check-label" for="pdfShowQr">Show QR Code on PDF</label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="hidden" name="arabic_invoice" value="0">
                            <input type="checkbox" class="form-check-input" name="arabic_invoice" value="1" id="pdfShowArabic"
                                   <?php echo e(($settings->arabic_invoice ?? true) ? 'checked' : '', false); ?>>
                            <label class="form-check-label" for="pdfShowArabic">Show Arabic labels on PDF</label>
                        </div>
                    </div>
                </div>

                <!-- Daily Sync Schedule -->
                <div class="card mb-3">
                    <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-clock"></i> Cron Schedule</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Daily Sync Cron Expression</label>
                            <input type="text" name="cron_schedule" class="form-control" value="<?php echo e($settings->cron_schedule ?? '0 23 * * *', false); ?>" placeholder="0 23 * * *">
                            <div class="form-text">Default: <code>0 23 * * *</code> (11 PM daily). Only applies when sync mode is "Daily".</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Settings
                </button>
                <a href="<?php echo e(route('zatca.dashboard'), false); ?>" class="btn btn-secondary btn-lg ms-2">Cancel</a>
            </div>
        </div>
    </form>

    <hr>

    <!-- Quick Links -->
    <div class="row mt-3">
        <div class="col-md-4">
            <a href="<?php echo e(route('zatca.settings.api-logs'), false); ?>" class="btn btn-outline-info w-100">
                <i class="fas fa-list-alt"></i> View API Logs
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?php echo e(route('zatca.onboarding.index'), false); ?>" class="btn btn-outline-success w-100">
                <i class="fas fa-plug"></i> Manage Onboarding
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?php echo e(route('zatca.invoices.index'), false); ?>" class="btn btn-outline-primary w-100">
                <i class="fas fa-file-invoice"></i> View Invoices
            </a>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-book-open"></i> Integration Guide</h5>
        </div>
        <div class="card-body">
            <div class="callout callout-info mb-4">
                <h4 class="mb-2">Recommended setup flow</h4>
                <p class="mb-0">
                    Start in Simulation, complete onboarding and compliance checks, run a real smoke test, then move each location to Core (live) only after invoice data, tax mapping, and certificate health are confirmed.
                </p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h4 class="text-primary">1. Save the base settings</h4>
                        <p class="mb-2">Choose the ZATCA phase, sync mode, default invoice subtype, and PDF preferences on this page.</p>
                        <ul class="mb-0">
                            <li><strong>Phase 1</strong> keeps invoice generation local.</li>
                            <li><strong>Phase 2</strong> enables API integration for clearance and reporting.</li>
                            <li><strong>B2C</strong> invoices are reported after issue, while <strong>B2B</strong> invoices require clearance.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">2. Run preflight diagnostics first</h4>
                        <p class="mb-2">
                            Before using client credentials, confirm the server can sign invoices, reach ZATCA, and read stored certificates.
                        </p>
                        <pre class="bg-light p-3 rounded mb-2"><code>php artisan zatca:diagnose --ping</code></pre>
                        <pre class="bg-light p-3 rounded mb-2"><code>php artisan zatca:diagnose --business=YOUR_BUSINESS_ID</code></pre>
                        <pre class="bg-light p-3 rounded mb-0"><code>php artisan zatca:certificates --business=YOUR_BUSINESS_ID</code></pre>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">3. Onboard every business location</h4>
                        <p class="mb-2">
                            Open <strong>Manage Onboarding</strong> and submit the VAT, branch, and address details for each location that will send invoices to ZATCA.
                        </p>
                        <ul class="mb-0">
                            <li>Each location must be onboarded separately.</li>
                            <li>Use <strong>Simulation</strong> first for testing.</li>
                            <li>Use a fresh OTP from the selected ZATCA portal instead of any fixed or reused test value.</li>
                            <li>The onboarding is not usable until the private key, compliance certificate, and compliance secret are all stored successfully.</li>
                        </ul>
                    </div>

                    <div class="mb-0">
                        <h4 class="text-primary">4. Pass compliance and simulation checks</h4>
                        <p class="mb-2">
                            After simulation onboarding, run the compliance check from the onboarding screen and then verify the environment with a real smoke test.
                        </p>
                        <pre class="bg-light p-3 rounded mb-2"><code>php artisan zatca:simulation-test --onboarding=YOUR_ONBOARDING_ID --mode=compliance</code></pre>
                        <p class="mb-0">Use <strong>View API Logs</strong> to review request IDs, correlation IDs, warnings, and response details before moving forward.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h4 class="text-primary">5. Configure invoice syncing</h4>
                        <p class="mb-2">Pick the sync mode that matches your process:</p>
                        <ul class="mb-0">
                            <li><strong>Disabled</strong>: sync invoices manually from the invoice list.</li>
                            <li><strong>Instant</strong>: submit after every completed sale.</li>
                            <li><strong>Daily</strong>: sync pending invoices in batches using a server cron job.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">6. Cron command for Daily mode</h4>
                        <p class="mb-2">If you use Daily sync, schedule your server to run the ZATCA command at the same time you set in the cron expression field above.</p>
                        <pre class="bg-light p-3 rounded mb-2"><code>php artisan zatca:sync-invoices --business=YOUR_BUSINESS_ID</code></pre>
                        <p class="mb-2">For a manual terminal test, you can force a run with:</p>
                        <pre class="bg-light p-3 rounded mb-0"><code>php artisan zatca:sync-invoices --business=YOUR_BUSINESS_ID --force</code></pre>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">7. Before syncing your first invoice</h4>
                        <ul class="mb-0">
                            <li>Keep VAT rates limited to <strong>0%</strong>, <strong>5%</strong>, or <strong>15%</strong> when validation is enabled.</li>
                            <li>Make sure the invoice subtype matches your customer flow: <strong>B2C</strong> for simplified invoices and <strong>B2B</strong> for standard invoices.</li>
                            <li>The module now reserves the invoice chain on generation, so failed or retried invoices should not be deleted casually because later invoices may depend on their ICV and PIH sequence.</li>
                            <li>Use the invoice list and API logs to verify the first few submissions before relying on automation.</li>
                        </ul>
                    </div>

                    <div class="mb-0">
                        <h4 class="text-primary">8. Go live carefully</h4>
                        <p class="mb-2">
                            Switch a location to <strong>Core</strong> only after simulation onboarding, compliance checking, and smoke testing are all successful.
                        </p>
                        <ul class="mb-3">
                            <li>Do this only when real VAT, branch, buyer flow, and tax mapping are verified.</li>
                            <li>Monitor certificate expiry and renewal state before and after live promotion.</li>
                            <li>Review the first live submissions from the invoice list and API logs.</li>
                        </ul>

                        <div class="alert alert-warning mb-0">
                            <strong>Current implementation notes:</strong>
                            The XML submission flow is the authoritative ZATCA record. The PDF output is suitable as a system print copy, but PDF/A-3 with embedded XML is not yet generated by this module. Advanced zero/exempt tax reason mapping and some buyer/seller ID edge cases should still be reviewed before a large live rollout.
                        </div>
                    </div>
                </div>
            </div>

            <div class="callout callout-warning mt-4 mb-0">
                <h4 class="mb-2">When a simulation onboarding looks complete but still fails</h4>
                <p class="mb-0">
                    If diagnostics show <strong>missing private key</strong>, <strong>missing compliance certificate</strong>, or <strong>simulation ready: blocked</strong>, re-run onboarding with a fresh ZATCA OTP before testing invoice submission.
                </p>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'eTIMS Sale Detail'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS Sale Detail <small><?php echo e($sale->invoice_no, false); ?></small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.sales.index'), false); ?>">Sales</a></li>
        <li class="breadcrumb-item active"><?php echo e($sale->invoice_no, false); ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- Sale Info -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Sale Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted w-40">POS Invoice:</td><td><strong><?php echo e($sale->invoice_no, false); ?></strong></td></tr>
                        <tr>
                            <td class="text-muted">CU Invoice No:</td>
                            <td>
                                <?php if($sale->cu_invoice_no): ?>
                                    <span class="text-success fw-bold"><?php echo e($sale->cu_invoice_no, false); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr><td class="text-muted">Receipt No:</td><td><?php echo e($sale->receipt_no ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted">Sale Date:</td><td><?php echo e($sale->sale_date->format('Y-m-d'), false); ?></td></tr>
                        <tr><td class="text-muted">Sale Type:</td><td><span class="badge bg-secondary"><?php echo e($sale->sale_type_name, false); ?></span></td></tr>
                        <tr><td class="text-muted">Payment Type:</td><td><?php echo e($sale->payment_type_name, false); ?></td></tr>
                        <tr>
                            <td class="text-muted">Status:</td>
                            <td>
                                <?php
                                    $statusColors = ['pending' => 'warning', 'submitted' => 'success', 'failed' => 'danger', 'cancelled' => 'secondary'];
                                ?>
                                <span class="badge bg-<?php echo e($statusColors[$sale->submission_status] ?? 'secondary', false); ?>">
                                    <?php echo e(ucfirst($sale->submission_status), false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr><td class="text-muted">Submitted:</td><td><?php echo e($sale->submitted_at ? $sale->submitted_at->format('Y-m-d H:i:s') : 'Not yet', false); ?></td></tr>
                        <tr><td class="text-muted">Retries:</td><td><?php echo e($sale->retry_count, false); ?></td></tr>
                    </table>

                    <?php if($sale->submission_status === 'failed'): ?>
                        <div class="alert alert-danger mt-2">
                            <strong>Error:</strong> <?php echo e($sale->error_message, false); ?>

                        </div>
                        <form action="<?php echo e(route('kenyaetims.sales.retry', $sale->id), false); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-redo"></i> Retry Submission
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-user"></i> Customer</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">Name:</td><td><?php echo e($sale->cust_nm ?? '-', false); ?></td></tr>
                        <tr><td class="text-muted">TIN/PIN:</td><td><?php echo e($sale->cust_tin ?? 'Not provided', false); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tax Breakdown & CU Data -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calculator"></i> Tax Breakdown</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr><th>Tax Type</th><th class="text-end">Taxable Amt</th><th class="text-end">Tax Amt</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>VAT 16% (A)</td><td class="text-end"><?php echo e(number_format($sale->taxbl_amt_a, 2), false); ?></td><td class="text-end"><?php echo e(number_format($sale->tax_amt_a, 2), false); ?></td></tr>
                            <tr><td>VAT 8% (B)</td><td class="text-end"><?php echo e(number_format($sale->taxbl_amt_b, 2), false); ?></td><td class="text-end"><?php echo e(number_format($sale->tax_amt_b, 2), false); ?></td></tr>
                            <tr><td>VAT 0% (C)</td><td class="text-end"><?php echo e(number_format($sale->taxbl_amt_c, 2), false); ?></td><td class="text-end"><?php echo e(number_format($sale->tax_amt_c, 2), false); ?></td></tr>
                            <tr><td>Exempt (D)</td><td class="text-end"><?php echo e(number_format($sale->taxbl_amt_d, 2), false); ?></td><td class="text-end"><?php echo e(number_format($sale->tax_amt_d, 2), false); ?></td></tr>
                            <tr><td>Excise (E)</td><td class="text-end"><?php echo e(number_format($sale->taxbl_amt_e, 2), false); ?></td><td class="text-end"><?php echo e(number_format($sale->tax_amt_e, 2), false); ?></td></tr>
                            <tr class="table-dark fw-bold">
                                <td>TOTAL</td>
                                <td class="text-end"><?php echo e(number_format($sale->total_taxbl_amt, 2), false); ?></td>
                                <td class="text-end"><?php echo e(number_format($sale->total_tax_amt, 2), false); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <strong>Discount:</strong> <?php echo e(number_format($sale->total_disc_amt, 2), false); ?> | 
                        <strong>Grand Total:</strong> <span class="fs-5 fw-bold text-success"><?php echo e(number_format($sale->total_amt, 2), false); ?></span>
                    </div>
                </div>
            </div>

            <?php if($sale->cu_qr_code || $sale->cu_internal_data): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-stamp"></i> CU Data (KRA)</h5>
                </div>
                <div class="card-body">
                    <?php if($sale->cu_internal_data): ?>
                        <p><strong>Internal Data:</strong><br><code><?php echo e($sale->cu_internal_data, false); ?></code></p>
                    <?php endif; ?>
                    <?php if($sale->cu_receipt_sign): ?>
                        <p><strong>Receipt Signature:</strong><br><code><?php echo e(\Illuminate\Support\Str::limit($sale->cu_receipt_sign, 80), false); ?></code></p>
                    <?php endif; ?>
                    <?php if($sale->cu_sdc_id): ?>
                        <p><strong>SDC ID:</strong> <?php echo e($sale->cu_sdc_id, false); ?></p>
                    <?php endif; ?>
                    <?php if($sale->cu_qr_code): ?>
                        <p><strong>QR Code Data:</strong><br><small><code><?php echo e(\Illuminate\Support\Str::limit($sale->cu_qr_code, 200), false); ?></code></small></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sale Items -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-list"></i> Line Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Code</th>
                            <th>Classification</th>
                            <th>Item Name</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Supply Amt</th>
                            <th class="text-end">Discount</th>
                            <th>Tax Type</th>
                            <th class="text-end">Tax Amt</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sale->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->item_seq, false); ?></td>
                            <td><code><?php echo e($item->item_cd, false); ?></code></td>
                            <td><small><?php echo e($item->item_cls_cd, false); ?></small></td>
                            <td><?php echo e($item->item_nm, false); ?></td>
                            <td class="text-end"><?php echo e($item->qty, false); ?></td>
                            <td class="text-end"><?php echo e(number_format($item->unit_price, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($item->supply_amt, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($item->discount_amt, 2), false); ?></td>
                            <td><span class="badge bg-info"><?php echo e($item->tax_ty_cd, false); ?></span></td>
                            <td class="text-end"><?php echo e(number_format($item->tax_amt, 2), false); ?></td>
                            <td class="text-end fw-bold"><?php echo e(number_format($item->total_amt, 2), false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Raw JSON (collapsible) -->
    <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#rawJson" style="cursor: pointer;">
            <h5 class="card-title mb-0"><i class="fas fa-code"></i> Raw API Data (Click to Expand)</h5>
        </div>
        <div id="rawJson" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Request Payload</h6>
                        <pre class="bg-light p-3" style="max-height: 400px; overflow: auto;"><code><?php echo e(json_encode($sale->kra_request, JSON_PRETTY_PRINT), false); ?></code></pre>
                    </div>
                    <div class="col-md-6">
                        <h6>Response Payload</h6>
                        <pre class="bg-light p-3" style="max-height: 400px; overflow: auto;"><code><?php echo e(json_encode($sale->kra_response, JSON_PRETTY_PRINT), false); ?></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
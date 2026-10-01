
<?php $__env->startSection('title', 'eTIMS Sales'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS Sales <small>KRA Tax Invoice Submissions</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item active">Sales</li>
    </ol>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <!-- Filters & Actions -->
    <div class="card">
        <div class="card-body">
            <form id="filter_form" method="GET" action="<?php echo e(route('kenyaetims.sales.index'), false); ?>">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="filter_status" class="form-select">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($val, false); ?>" <?php echo e(request('status') === $val ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo app('translator')->get('report.date_range'); ?></label>
                        <input type="text" name="date_range" id="etims_date_range" class="form-control" value="<?php echo e(request('date_range'), false); ?>" placeholder="<?php echo app('translator')->get('lang_v1.select_a_date_range'); ?>" readonly>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            <form action="<?php echo e(route('kenyaetims.sales.bulk-submit'), false); ?>" method="POST" class="d-inline mt-2">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-success" 
                        onclick="return confirm('Submit all pending transactions to KRA? This may take a while.')">
                    <i class="fas fa-upload"></i> Bulk Submit
                </button>
            </form>
        </div>
    </div>

    <!-- Sales List -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>CU Invoice</th>
                            <th>Customer</th>
                            <th>Sale Date</th>
                            <th>Type</th>
                            <th>Total Amount</th>
                            <th>Tax Amount</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('kenyaetims.sales.show', $sale->id), false); ?>">
                                    <?php echo e($sale->invoice_no ?? 'N/A', false); ?>

                                </a>
                            </td>
                            <td>
                                <?php if($sale->cu_invoice_no): ?>
                                    <span class="text-success"><i class="fas fa-check"></i> <?php echo e($sale->cu_invoice_no, false); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($sale->cust_nm ?? '-', false); ?></td>
                            <td><?php echo e($sale->sale_date->format('Y-m-d'), false); ?></td>
                            <td><span class="badge bg-secondary"><?php echo e($sale->sale_type_name, false); ?></span></td>
                            <td class="text-end"><?php echo e(number_format($sale->total_amt, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($sale->total_tax_amt, 2), false); ?></td>
                            <td>
                                <?php
                                    $statusColors = ['pending' => 'warning', 'submitted' => 'success', 'failed' => 'danger', 'cancelled' => 'secondary'];
                                ?>
                                <span class="badge bg-<?php echo e($statusColors[$sale->submission_status] ?? 'secondary', false); ?>">
                                    <?php echo e(ucfirst($sale->submission_status), false); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($sale->submitted_at): ?>
                                    <small><?php echo e($sale->submitted_at->format('Y-m-d H:i'), false); ?></small>
                                <?php else: ?>
                                    <small class="text-muted">-</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($sale->submission_status === 'failed'): ?>
                                    <form action="<?php echo e(route('kenyaetims.sales.retry', $sale->id), false); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-xs btn-warning">
                                            <i class="fas fa-redo"></i> Retry
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <a href="<?php echo e(route('kenyaetims.sales.show', $sale->id), false); ?>" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="fas fa-receipt fa-2x mb-2"></i><br>
                                No eTIMS sales found.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php echo e($sales->appends(request()->query())->links(), false); ?>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){
        $('#etims_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#etims_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#etims_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        <?php if(request('date_range')): ?>
            // Preserve the selected date range on page reload
            var parts = '<?php echo e(request('date_range'), false); ?>'.split('~');
            if (parts.length === 2) {
                var start = moment(parts[0].trim(), moment_date_format);
                var end = moment(parts[1].trim(), moment_date_format);
                if (start.isValid() && end.isValid()) {
                    $('#etims_date_range').data('daterangepicker').setStartDate(start);
                    $('#etims_date_range').data('daterangepicker').setEndDate(end);
                }
            }
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
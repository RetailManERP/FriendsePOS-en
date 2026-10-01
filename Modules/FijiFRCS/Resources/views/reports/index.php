
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.xz_reports')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header"><h1><?php echo e(__('fijifrcs::fijifrcs.xz_reports'), false); ?></h1></section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('fijifrcs::fijifrcs.generate_x_report'), false); ?></h5></div>
                <form method="POST" action="<?php echo e(route('fijifrcs.reports.generate-x'), false); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card-body row g-2">
                        <div class="col-md-7">
                            <label>EFD</label>
                            <select name="onboarding_id" class="form-select" required>
                                <?php $__currentLoopData = $onboardings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($o->id, false); ?>"><?php echo e($o->efd_pos_id, false); ?> (<?php echo e(optional($o->location)->name, false); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label><?php echo e(__('fijifrcs::fijifrcs.report_date'), false); ?></label>
                            <input type="date" name="report_date" value="<?php echo e(now()->toDateString(), false); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-outline-primary"><i class="fa fa-eye"></i> X-Report</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0 text-danger"><?php echo e(__('fijifrcs::fijifrcs.generate_z_report'), false); ?></h5></div>
                <form method="POST" action="<?php echo e(route('fijifrcs.reports.generate-z'), false); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card-body row g-2">
                        <div class="col-md-7">
                            <label>EFD</label>
                            <select name="onboarding_id" class="form-select" required>
                                <?php $__currentLoopData = $onboardings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($o->id, false); ?>"><?php echo e($o->efd_pos_id, false); ?> (<?php echo e(optional($o->location)->name, false); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label><?php echo e(__('fijifrcs::fijifrcs.report_date'), false); ?></label>
                            <input type="date" name="report_date" value="<?php echo e(now()->toDateString(), false); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-danger" onclick="return confirm('Z-Report closes the day and resets daily counters. Continue?')">
                            <i class="fa fa-lock"></i> Z-Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Report History</h5></div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th><?php echo e(__('fijifrcs::fijifrcs.report_date'), false); ?></th>
                        <th>Type</th>
                        <th>Z #</th>
                        <th class="text-end">Sales (FJD)</th>
                        <th class="text-end">VAT</th>
                        <th class="text-end">Refunds</th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.sync_status'), false); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($r->report_date, false); ?></td>
                            <td><span class="badge bg-<?php echo e($r->report_type === 'Z' ? 'danger' : 'secondary', false); ?>"><?php echo e($r->report_type, false); ?></span></td>
                            <td><?php echo e($r->z_number ?: '—', false); ?></td>
                            <td class="text-end"><?php echo e(number_format($r->total_sales_incl_vat, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($r->total_vat, 2), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($r->total_refunds, 2), false); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($r->sync_status === 'submitted' ? 'success' : ($r->sync_status === 'failed' ? 'danger' : 'warning'), false); ?>">
                                    <?php echo e(strtoupper($r->sync_status), false); ?>

                                </span>
                            </td>
                            <td><a href="<?php echo e(route('fijifrcs.reports.show', $r->id), false); ?>" class="btn btn-xs btn-outline-primary">View</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="8" class="text-center p-3 text-muted"><?php echo e(__('fijifrcs::fijifrcs.no_data'), false); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3"><?php echo e($reports->links(), false); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('fijifrcs::fijifrcs.onboarding_details')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e(__('fijifrcs::fijifrcs.onboarding_details'), false); ?> <small>EFD #<?php echo e($onboarding->efd_pos_id, false); ?></small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">EFD &amp; Taxpayer</h5>
            <span class="badge bg-<?php echo e($onboarding->status === 'activated' ? 'success' : 'warning', false); ?>">
                <?php echo e(strtoupper($onboarding->status), false); ?>

            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>TIN:</strong> <?php echo e($onboarding->tin, false); ?></p>
                    <p><strong>VAT Reg:</strong> <?php echo e($onboarding->vat_registration_number ?: '—', false); ?></p>
                    <p><strong>Legal Name:</strong> <?php echo e($onboarding->legal_name, false); ?></p>
                    <p><strong>Trading Name:</strong> <?php echo e($onboarding->trading_name ?: '—', false); ?></p>
                    <p><strong>Branch Code:</strong> <?php echo e($onboarding->efd_branch_code ?: '—', false); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>EFD Serial:</strong> <code><?php echo e($onboarding->efd_serial_number, false); ?></code></p>
                    <p><strong>EFD POS ID:</strong> <code><?php echo e($onboarding->efd_pos_id, false); ?></code></p>
                    <p><strong>Environment:</strong> <?php echo e(ucfirst($onboarding->environment), false); ?></p>
                    <p><strong>Activated At:</strong> <?php echo e($onboarding->activated_at ?: '—', false); ?></p>
                    <p><strong>Certificate Expires:</strong> <?php echo e($onboarding->signing_certificate_expires_at ?: '—', false); ?></p>
                </div>
            </div>
            <hr>
            <p class="mb-1"><strong><?php echo e(__('fijifrcs::fijifrcs.icv'), false); ?>:</strong> <?php echo e($onboarding->invoice_counter, false); ?></p>
            <p class="mb-1"><strong>Daily Counter:</strong> <?php echo e($onboarding->daily_counter, false); ?></p>
            <p class="mb-1"><strong><?php echo e(__('fijifrcs::fijifrcs.previous_invoice_hash'), false); ?>:</strong>
                <code class="small"><?php echo e(\Str::limit($onboarding->previous_invoice_hash, 80) ?: '—', false); ?></code>
            </p>
            <?php if($onboarding->error_message): ?>
                <div class="alert alert-danger mt-2 mb-0"><?php echo e($onboarding->error_message, false); ?></div>
            <?php endif; ?>
        </div>
        <div class="card-footer d-flex gap-2">
            <?php if($onboarding->status !== 'activated'): ?>
                <form method="POST" action="<?php echo e(route('fijifrcs.onboarding.reactivate', $onboarding->id), false); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success btn-sm"><i class="fa fa-bolt"></i> Re-activate</button>
                </form>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('fijifrcs.onboarding.refresh-cert', $onboarding->id), false); ?>">
                <?php echo csrf_field(); ?>
                <button class="btn btn-outline-primary btn-sm"><i class="fa fa-key"></i> Refresh Signing Certificate</button>
            </form>
            <form method="POST" action="<?php echo e(route('fijifrcs.onboarding.destroy', $onboarding->id), false); ?>"
                  onsubmit="return confirm('Deactivate this EFD?');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Deactivate</button>
            </form>
            <a href="<?php echo e(route('fijifrcs.onboarding.index'), false); ?>" class="btn btn-secondary btn-sm ms-auto">
                <i class="fa fa-arrow-left"></i> <?php echo e(__('fijifrcs::fijifrcs.back'), false); ?>

            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
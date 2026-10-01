
<?php $__env->startSection('title', __('fijifrcs::fijifrcs.efd_onboarding')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo e(__('fijifrcs::fijifrcs.efd_onboarding'), false); ?>

        <small>Register Electronic Fiscal Devices with FRCS</small>
    </h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end mb-2">
        <a href="<?php echo e(route('fijifrcs.onboarding.create'), false); ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i> <?php echo e(__('fijifrcs::fijifrcs.add_new_onboarding'), false); ?>

        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th><?php echo e(__('fijifrcs::fijifrcs.business_location'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.tin'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.efd_pos_id'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.environment'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.status'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.icv'), false); ?></th>
                        <th><?php echo e(__('fijifrcs::fijifrcs.actions'), false); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $onboardings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e(optional($o->location)->name ?? '—', false); ?></td>
                            <td><?php echo e($o->tin, false); ?></td>
                            <td><code><?php echo e($o->efd_pos_id, false); ?></code></td>
                            <td><span class="badge bg-secondary"><?php echo e(ucfirst($o->environment), false); ?></span></td>
                            <td>
                                <span class="badge bg-<?php echo e($o->status === 'activated' ? 'success' : ($o->status === 'failed' ? 'danger' : 'warning'), false); ?>">
                                    <?php echo e(strtoupper($o->status), false); ?>

                                </span>
                            </td>
                            <td><?php echo e($o->invoice_counter, false); ?></td>
                            <td>
                                <a href="<?php echo e(route('fijifrcs.onboarding.show', $o->id), false); ?>" class="btn btn-xs btn-outline-primary">
                                    <?php echo e(__('fijifrcs::fijifrcs.view'), false); ?>

                                </a>
                                <?php if($o->status !== 'activated'): ?>
                                    <form method="POST" action="<?php echo e(route('fijifrcs.onboarding.reactivate', $o->id), false); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-xs btn-outline-success">Activate</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="7" class="text-center text-muted p-3"><?php echo e(__('fijifrcs::fijifrcs.no_data'), false); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3"><?php echo e($onboardings->links(), false); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
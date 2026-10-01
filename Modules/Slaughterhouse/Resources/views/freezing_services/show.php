
<?php $__env->startSection('title', __('slaughterhouse::lang.freezing_service') . ' - ' . $service->service_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.freezing_service'); ?> <small><?php echo e($service->service_no, false); ?></small></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $service->service_no]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'edit'], $service->id), false); ?>" class="btn btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a>
            <?php if($service->status !== 'released'): ?>
                <?php echo Form::open(['url' => action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'release'], $service->id), 'method' => 'post', 'style' => 'display:inline']); ?>

                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('slaughterhouse::lang.release_service'); ?></button>
                <?php echo Form::close(); ?>

            <?php endif; ?>
        <?php $__env->endSlot(); ?>
        <table class="table table-bordered">
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th><td><?php echo e($service->customer_name, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.mobile'); ?></th><td><?php echo e($service->mobile, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.freezer'); ?></th><td><?php echo e(optional($service->freezer)->name, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.storage_bin'); ?></th><td><?php echo e($service->storage_bin, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_type'); ?></th><td><?php echo e(optional($service->cuttingType)->name, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_instructions'); ?></th><td><?php echo e($service->cutting_instructions, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.intake_weight'); ?></th><td><?php echo e($service->intake_weight, false); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.package_count'); ?></th><td><?php echo e($service->package_count, false); ?></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.service_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($service->service_amount, false); ?></span></td><th><?php echo app('translator')->get('slaughterhouse::lang.balance_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($service->balance_amount, false); ?></span></td></tr>
            <tr><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><td><?php echo app('translator')->get('slaughterhouse::lang.' . $service->status); ?></td><th><?php echo app('translator')->get('slaughterhouse::lang.payment_status'); ?></th><td><?php echo app('translator')->get('slaughterhouse::lang.' . $service->payment_status); ?></td></tr>
        </table>
        <?php if(! empty($service->notes)): ?>
            <p><strong><?php echo app('translator')->get('slaughterhouse::lang.notes'); ?>:</strong> <?php echo e($service->notes, false); ?></p>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
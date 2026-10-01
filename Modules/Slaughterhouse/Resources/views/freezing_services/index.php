
<?php $__env->startSection('title', __('slaughterhouse::lang.freezing_services')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.freezing_services'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.freezing_services')]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'create']), false); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_freezing_service'); ?></a>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('slaughterhouse::lang.service_no'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.mobile'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.freezer'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_type'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.intake_weight'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.service_amount'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.payment_status'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'show'], $service->id), false); ?>"><?php echo e($service->service_no, false); ?></a></td>
                            <td><?php echo e($service->customer_name, false); ?></td>
                            <td><?php echo e($service->mobile, false); ?></td>
                            <td><?php echo e(optional($service->freezer)->name, false); ?></td>
                            <td><?php echo e(optional($service->cuttingType)->name, false); ?></td>
                            <td><?php echo e($service->intake_weight, false); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($service->service_amount, false); ?></span></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $service->payment_status); ?></span></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $service->status); ?></span></td>
                            <td>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'show'], $service->id), false); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->get('slaughterhouse::lang.view'); ?></a>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'edit'], $service->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="10" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($services->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
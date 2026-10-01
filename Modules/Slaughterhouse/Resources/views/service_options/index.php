
<?php $__env->startSection('title', __('slaughterhouse::lang.service_options')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.service_options'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.service_options')]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterServiceOptionController::class, 'create']), false); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_service_option'); ?></a>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('messages.name'); ?></th><th>Code</th><th><?php echo app('translator')->get('slaughterhouse::lang.service_fee'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.fulfillment_route'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($service->name, false); ?></td>
                            <td><?php echo e($service->code, false); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($service->fee, false); ?></span></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $service->fulfillment_route); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $service->status); ?></span></td>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterServiceOptionController::class, 'edit'], $service->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="6" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($services->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
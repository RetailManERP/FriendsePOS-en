
<?php $__env->startSection('title', __('slaughterhouse::lang.cutting_types')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.cutting_types'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.cutting_types')]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterCuttingTypeController::class, 'create']), false); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_cutting_type'); ?></a>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('messages.name'); ?></th><th>Code</th><th><?php echo app('translator')->get('slaughterhouse::lang.animal_type'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_style'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.service_fee'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.charge_type'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $cutting_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($type->name, false); ?></td>
                            <td><?php echo e($type->code, false); ?></td>
                            <td><?php echo e($type->animal_type ? ucfirst(str_replace('_', ' ', $type->animal_type)) : __('slaughterhouse::lang.all'), false); ?></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $type->cutting_style); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($type->fee, false); ?></span></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $type->charge_type); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $type->status); ?></span></td>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterCuttingTypeController::class, 'edit'], $type->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="8" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($cutting_types->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('slaughterhouse::lang.freezers')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.freezers'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.freezers')]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezerController::class, 'create']), false); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_freezer'); ?></a>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('messages.name'); ?></th><th>Code</th><th><?php echo app('translator')->get('slaughterhouse::lang.location'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.freezer_type'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.current_temperature'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.occupied_weight'); ?></th><th>%</th><th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $freezers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $freezer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($freezer->name, false); ?></td>
                            <td><?php echo e($freezer->code, false); ?></td>
                            <td><?php echo e(optional($freezer->location)->name, false); ?></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . ($freezer->freezer_type === 'freezer' ? 'freezer_type_freezer' : $freezer->freezer_type)); ?></td>
                            <td><?php echo e($freezer->current_temperature, false); ?></td>
                            <td><?php echo e($freezer->occupied_weight, false); ?> / <?php echo e($freezer->capacity_weight, false); ?></td>
                            <td>
                                <div class="progress" style="margin:0; min-width:90px;">
                                    <div class="progress-bar" style="width: <?php echo e($freezer->fill_percent, false); ?>%"><?php echo e($freezer->fill_percent, false); ?>%</div>
                                </div>
                            </td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $freezer->status); ?></span></td>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezerController::class, 'edit'], $freezer->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="9" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($freezers->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('slaughterhouse::lang.animal_numbers')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.animal_numbers'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.animal_numbers')]); ?>
        <?php $__env->slot('tool'); ?>
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'create']), false); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_animal_number'); ?></a>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('slaughterhouse::lang.animal_number'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.booking_no'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.token_no'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.service_option'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.cutting_type'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.total_price'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.current_stage'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.display_zone'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $animal_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'show'], $animal->id), false); ?>"><?php echo e($animal->animal_number, false); ?></a></td>
                            <td><?php echo e(optional($animal->booking)->booking_no, false); ?></td>
                            <td><?php echo e(optional($animal->token)->token_no, false); ?></td>
                            <td><?php echo e(optional($animal->serviceOption)->name, false); ?></td>
                            <td><?php echo e(optional($animal->cuttingType)->name, false); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($animal->total_price, false); ?></span></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $animal->current_stage); ?></span></td>
                            <td><?php echo app('translator')->get('slaughterhouse::lang.' . $animal->display_zone); ?></td>
                            <td>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'show'], $animal->id), false); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->get('slaughterhouse::lang.view'); ?></a>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'edit'], $animal->id), false); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.edit'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="9" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($animal_numbers->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
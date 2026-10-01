
<?php $__env->startSection('title', __('slaughterhouse::lang.packing_labels')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.packing_labels'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.packing_labels')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead><tr><th><?php echo app('translator')->get('slaughterhouse::lang.label_no'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.token_no'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.animal_number'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.customer_name'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.service_option'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.zone'); ?></th><th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th></tr></thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($label->label_no, false); ?></td>
                            <td><?php echo e($label->token_no, false); ?></td>
                            <td><?php echo e($label->animal_number, false); ?></td>
                            <td><?php echo e($label->customer_name, false); ?></td>
                            <td><?php echo e($label->service_name, false); ?></td>
                            <td><?php echo e($label->zone, false); ?></td>
                            <td><a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterPackingLabelController::class, 'show'], $label->id), false); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->get('slaughterhouse::lang.view'); ?></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="7" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($labels->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
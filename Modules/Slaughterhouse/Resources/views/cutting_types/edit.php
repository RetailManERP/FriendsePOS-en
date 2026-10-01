
<?php $__env->startSection('title', __('slaughterhouse::lang.edit_cutting_type')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.edit_cutting_type'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php echo Form::open(['url' => action([\Modules\Slaughterhouse\Http\Controllers\SlaughterCuttingTypeController::class, 'update'], $cutting_type->id), 'method' => 'put']); ?>

            <?php echo $__env->make('slaughterhouse::cutting_types._form', ['cutting_type' => $cutting_type], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('slaughterhouse::lang.save'); ?></button>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
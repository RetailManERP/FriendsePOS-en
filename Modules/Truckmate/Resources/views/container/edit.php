

<?php $__env->startSection('title', __('truckmate::lang.edit_container')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::container.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-edit" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.edit_container'); ?></h1>
    </div>
</section>
<section class="content tm-content">
    <?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'update'], [$container->id]), 'method' => 'put', 'id' => 'container_form']); ?>

        <?php echo $__env->make('truckmate::container.partials.form', ['container' => $container], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->get('messages.update'); ?></button>
        </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
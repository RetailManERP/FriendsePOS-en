
<?php $__env->startSection('title', __('fuelstation::lang.edit_nozzle')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.edit_nozzle'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelNozzleController::class, 'update'], [$nozzle->id]), 'method' => 'PUT', 'id' => 'nozzle_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.edit_nozzle')]); ?>
        <?php echo $__env->make('fuelstation::nozzles._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <div id="nozzle-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="nozzle_form"><i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('fuelstation::lang.add_dispenser')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.add_dispenser'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelDispenserController::class, 'store']), 'method' => 'post', 'id' => 'dispenser_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.add_dispenser')]); ?>
        <?php echo $__env->make('fuelstation::dispensers._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <div id="dispenser-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="dispenser_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('fuelstation::lang.save'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
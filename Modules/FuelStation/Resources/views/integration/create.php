
<?php $__env->startSection('title', __('fuelstation::lang.add_integration')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.add_integration'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelIntegrationController::class, 'store']), 'method' => 'post']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.add_integration')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('dispenser_id', __('fuelstation::lang.dispenser') . ':*'); ?>

                    <?php echo Form::select('dispenser_id', $dispensers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        </div>
        <?php echo $__env->make('fuelstation::integration._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php $__env->slot('footer'); ?>
            <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->get('fuelstation::lang.save'); ?></button>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    function toggleFields() {
        var p = $('#protocol').val();
        $('#tcp_fields, #serial_fields, #api_fields').hide();
        if (p === 'tcp_ip') { $('#tcp_fields').show(); }
        else if (p === 'serial' || p === 'rs232') { $('#serial_fields').show(); }
        else if (p === 'api') { $('#api_fields').show(); }
    }
    $('#protocol').change(toggleFields);
    toggleFields();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
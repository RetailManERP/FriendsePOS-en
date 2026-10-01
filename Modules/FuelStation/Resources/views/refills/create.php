
<?php $__env->startSection('title', __('fuelstation::lang.add_refill')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.add_refill'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelTankRefillController::class, 'store']), 'method' => 'post', 'id' => 'refill_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.add_refill')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('tank_id', __('fuelstation::lang.tank') . ':*'); ?>

                    <?php echo Form::select('tank_id', $tanks, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('contact_id', __('fuelstation::lang.supplier') . ':'); ?>

                    <?php echo Form::select('contact_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('refill_date', __('fuelstation::lang.refill_date') . ':*'); ?>

                    <?php echo Form::text('refill_date', \Carbon\Carbon::now()->format('Y-m-d H:i'), ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('quantity', __('fuelstation::lang.quantity') . ' (L):*'); ?>

                    <?php echo Form::number('quantity', null, ['class' => 'form-control', 'step' => 'any', 'required', 'id' => 'quantity']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('rate_per_liter', __('fuelstation::lang.rate_per_liter') . ':'); ?>

                    <?php echo Form::number('rate_per_liter', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'rate_per_liter']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('total_amount', __('fuelstation::lang.total_amount') . ':'); ?>

                    <?php echo Form::number('total_amount', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'total_amount']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('dip_before', __('fuelstation::lang.dip_before') . ':'); ?>

                    <?php echo Form::number('dip_before', null, ['class' => 'form-control', 'step' => 'any']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('dip_after', __('fuelstation::lang.dip_after') . ':'); ?>

                    <?php echo Form::number('dip_after', null, ['class' => 'form-control', 'step' => 'any']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('notes', __('fuelstation::lang.notes') . ':'); ?>

                    <?php echo Form::text('notes', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
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
    function calcTotal() {
        var q = parseFloat($('#quantity').val()) || 0;
        var r = parseFloat($('#rate_per_liter').val()) || 0;
        if (q > 0 && r > 0) { $('#total_amount').val((q * r).toFixed(2)); }
    }
    $('#quantity, #rate_per_liter').on('input', calcTotal);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
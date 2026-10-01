
<?php $__env->startSection('title', __('fuelstation::lang.add_adjustment')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.add_adjustment'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelTankAdjustmentController::class, 'store']), 'method' => 'post', 'id' => 'tank_adjustment_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.add_adjustment')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('tank_id', __('fuelstation::lang.tank') . ':*'); ?>

                    <?php echo Form::select('tank_id', $tanks, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('type', __('fuelstation::lang.type') . ':*'); ?>

                    <?php echo Form::select('type', [
                        'leakage' => __('fuelstation::lang.adj_type_leakage'),
                        'loss' => __('fuelstation::lang.adj_type_loss'),
                        'gain' => __('fuelstation::lang.adj_type_gain'),
                        'testing' => __('fuelstation::lang.adj_type_testing'),
                        'evaporation' => __('fuelstation::lang.adj_type_evaporation'),
                        'calibration' => __('fuelstation::lang.adj_type_calibration'),
                        'other' => __('fuelstation::lang.adj_type_other'),
                    ], null, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('direction', __('fuelstation::lang.direction') . ':*'); ?>

                    <?php echo Form::select('direction', ['decrease' => __('fuelstation::lang.decrease'), 'increase' => __('fuelstation::lang.increase')], 'decrease', ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('quantity', __('fuelstation::lang.quantity') . ' (L):*'); ?>

                    <?php echo Form::number('quantity', null, ['class' => 'form-control', 'step' => 'any', 'required']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('adjustment_date', __('fuelstation::lang.adjustment_date') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('adjustment_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format')), ['class' => 'form-control fuel-date-picker', 'required', 'readonly']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('reason', __('fuelstation::lang.reason') . ':'); ?>

                    <?php echo Form::textarea('reason', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <div id="tank-adjustment-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="tank_adjustment_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('fuelstation::lang.save'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    if ($.fn.datepicker) {
        $('.fuel-date-picker').datepicker({
            autoclose: true,
            format: datepicker_date_format,
            todayHighlight: true,
        });

        $('.fuel-date-picker').closest('.input-group').find('.input-group-addon').on('click', function () {
            $(this).siblings('.fuel-date-picker').datepicker('show');
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
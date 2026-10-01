
<?php $__env->startSection('title', __('fuelstation::lang.open_shift')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.open_shift'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'store']), 'method' => 'post', 'id' => 'shift_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.shift_details')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('user_id', __('fuelstation::lang.operator') . ':*'); ?>

                    <?php echo Form::select('user_id', $operators, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php
                        $location_options = collect($business_locations);
                        $selected_location_id = $location_options->count() === 1 ? $location_options->keys()->first() : null;
                    ?>
                    <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':*'); ?>

                    <?php echo Form::select('location_id', $business_locations, $selected_location_id, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'location_id', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('dispenser_id', __('fuelstation::lang.dispenser') . ':'); ?>

                    <?php echo Form::select('dispenser_id', $dispensers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'dispenser_id', 'placeholder' => __('fuelstation::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('start_time', __('fuelstation::lang.start_time') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('start_time', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control shift-datetimepicker', 'required', 'id' => 'start_time', 'readonly']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('notes', __('fuelstation::lang.notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('fuelstation::lang.opening_readings')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="nozzle_rows_table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check_all_nozzles"></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.nozzle'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.linked_product'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.opening_reading'); ?></th>
                    </tr>
                </thead>
                <tbody id="nozzle_rows">
                    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.select_dispenser_to_load_nozzles'); ?></td></tr>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <div id="shift-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="shift_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('fuelstation::lang.open_shift'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    if ($.fn.datetimepicker) {
        $('.shift-datetimepicker').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
    }

    function loadNozzles() {
        if (!$('#location_id').val()) {
            $('#nozzle_rows').html('<tr><td colspan="5" class="text-center text-muted">' + <?php echo json_encode(__('lang_v1.select_location'), 15, 512) ?> + '</td></tr>');
            return;
        }

        $.ajax({
            url: '<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'getNozzlesForShift']), false); ?>',
            data: { dispenser_id: $('#dispenser_id').val(), location_id: $('#location_id').val() },
            success: function (html) { $('#nozzle_rows').html(html); }
        });
    }
    $('#dispenser_id, #location_id').change(loadNozzles);
    loadNozzles();

    $(document).on('change', '#check_all_nozzles', function () {
        $('#nozzle_rows input.nozzle-check').prop('checked', $(this).is(':checked'));
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('tailorpro::lang.add_measurement_template')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-plus-circle" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.add_measurement_template'); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'store']), 'method' => 'post', 'id' => 'tailorpro_template_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.measurement_templates'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('tailorpro::lang.template_name') . ':*'); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('garment_type', __('tailorpro::lang.garment_type') . ':'); ?>

                        <?php echo Form::text('garment_type', null, ['class' => 'form-control', 'id' => 'template_garment_type']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('sort_order', __('tailorpro::lang.sort_order') . ':'); ?>

                        <?php echo Form::number('sort_order', 0, ['class' => 'form-control', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <?php echo Form::label('is_default', __('tailorpro::lang.is_default') . ':'); ?><br>
                        <?php echo Form::checkbox('is_default', 1, false); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="padding-top:25px;">
                        <button type="button" class="btn btn-sm btn-info" id="load_defaults_btn">
                            <i class="fas fa-download"></i> <?php echo app('translator')->get('tailorpro::lang.load_defaults'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <hr>
            <h4><?php echo app('translator')->get('tailorpro::lang.template_fields'); ?> <button type="button" class="btn btn-xs btn-success" id="add_field_btn"><i class="fas fa-plus"></i> <?php echo app('translator')->get('tailorpro::lang.add_field'); ?></button></h4>
            <div class="table-responsive">
                <table class="table table-bordered" id="fields_table">
                    <thead>
                        <tr>
                            <th style="width:30%;"><?php echo app('translator')->get('tailorpro::lang.field_label'); ?></th>
                            <th style="width:25%;"><?php echo app('translator')->get('tailorpro::lang.field_key'); ?></th>
                            <th style="width:15%;"><?php echo app('translator')->get('tailorpro::lang.field_unit'); ?></th>
                            <th style="width:10%;"><?php echo app('translator')->get('tailorpro::lang.is_required'); ?></th>
                            <th style="width:10%;"><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="fields_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {
    var fieldIndex = 0;

    function addFieldRow(label, key, unit, required) {
        var html = '<tr>' +
            '<td><input type="text" name="field_label[]" class="form-control" value="' + (label || '') + '" required></td>' +
            '<td><input type="text" name="field_key[]" class="form-control" value="' + (key || '') + '"></td>' +
            '<td><input type="text" name="field_unit[]" class="form-control" value="' + (unit || 'inch') + '"></td>' +
            '<td><input type="checkbox" name="field_required[' + fieldIndex + ']" value="1" ' + (required ? 'checked' : '') + '></td>' +
            '<td><button type="button" class="btn btn-xs btn-danger remove_field_btn"><i class="fas fa-trash"></i></button></td>' +
            '</tr>';
        $('#fields_body').append(html);
        fieldIndex++;
    }

    $('#add_field_btn').on('click', function () {
        addFieldRow('', '', 'inch', false);
    });

    $(document).on('click', '.remove_field_btn', function () {
        $(this).closest('tr').remove();
    });

    $('#load_defaults_btn').on('click', function () {
        var garmentType = $('#template_garment_type').val();
        if (!garmentType) {
            toastr.warning('Please enter a garment type first.');
            return;
        }
        $.ajax({
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, "getDefaultFields"], ["__TYPE__"]), false); ?>'.replace('__TYPE__', garmentType.toLowerCase()),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length === 0) {
                    toastr.info('No default fields found for this garment type.');
                    return;
                }
                $('#fields_body').empty();
                fieldIndex = 0;
                $.each(data, function (i, f) {
                    addFieldRow(f.label, f.key, f.unit || 'inch', f.required || false);
                });
                toastr.success(data.length + ' default fields loaded.');
            }
        });
    });

    // Auto-generate key from label
    $(document).on('blur', 'input[name="field_label[]"]', function () {
        var $keyInput = $(this).closest('tr').find('input[name="field_key[]"]');
        if (!$keyInput.val()) {
            $keyInput.val($(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, ''));
        }
    });

    // Add one empty row by default
    addFieldRow('', '', 'inch', false);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
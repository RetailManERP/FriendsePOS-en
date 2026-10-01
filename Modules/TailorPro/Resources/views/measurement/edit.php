
<?php $__env->startSection('title', __('tailorpro::lang.edit_measurement')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-ruler-combined" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.edit_measurement'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, 'update'], [$measurement->id]), 'method' => 'put', 'id' => 'tailorpro_measurement_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('customer_id', __('role.customer') . ':*'); ?>

                        <?php echo Form::select('customer_id', $customers, $measurement->customer_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('type', __('tailorpro::lang.type') . ':*'); ?>

                        <?php echo Form::select('type', $measurement_types, $measurement->type, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.version'); ?>:</label>
                        <p class="form-control-static"><strong>v<?php echo e($measurement->version, false); ?></strong></p>
                    </div>
                </div>
            </div>

            <hr>
            <h4><i class="fas fa-ruler"></i> <?php echo app('translator')->get('tailorpro::lang.measurement_values'); ?></h4>
            <div id="measurement_fields_container">
                
            </div>

            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('tailorpro::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', $measurement->notes, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('select#customer_id').select2({ dropdownParent: $('select#customer_id').parent() });

    var existingData = <?php echo json_encode($measurement->data ?? [], 15, 512) ?>;

    var measurement_fields = {
        shirt: ['chest', 'waist', 'hip', 'shoulder', 'sleeve_length', 'shirt_length', 'neck', 'bicep', 'wrist', 'front_length', 'back_length'],
        trouser: ['trouser_length', 'waist', 'hip', 'thigh', 'knee', 'calf', 'ankle', 'inseam', 'outseam', 'rise'],
        blouse: ['bust', 'waist', 'shoulder', 'sleeve_length', 'blouse_length', 'neck', 'armhole', 'bicep'],
        dress: ['bust', 'waist', 'hip', 'shoulder', 'sleeve_length', 'dress_length', 'neck', 'armhole', 'bicep', 'skirt_length'],
        suit: ['chest', 'waist', 'hip', 'shoulder', 'sleeve_length', 'jacket_length', 'neck', 'bicep', 'wrist', 'trouser_length', 'thigh', 'knee', 'ankle', 'inseam'],
        custom: []
    };

    function buildFields(type) {
        var container = $('#measurement_fields_container');
        container.empty();

        if (type === 'custom') {
            var html = '<div class="row" id="custom_fields_wrapper">';
            $.each(existingData, function (key, val) {
                var label = key.replace(/_/g, ' ').replace(/\b\w/g, function (l) { return l.toUpperCase(); });
                html += '<div class="col-md-5 custom-field-row" style="margin-top:8px;">' +
                    '<div class="input-group">' +
                    '<input type="text" name="custom_labels[]" class="form-control" value="' + label + '">' +
                    '<span class="input-group-btn" style="width:0;"></span>' +
                    '<input type="text" name="custom_values[]" class="form-control input_number" value="' + val + '">' +
                    '<span class="input-group-btn"><button type="button" class="btn btn-danger remove_custom_field"><i class="fas fa-times"></i></button></span>' +
                    '</div></div>';
            });
            html += '<div class="col-md-12"><button type="button" class="btn btn-sm btn-info" id="add_custom_field"><i class="fas fa-plus"></i> Add Field</button></div></div>';
            container.append(html);
            return;
        }

        var fields = measurement_fields[type] || [];
        var rowHtml = '<div class="row">';
        $.each(fields, function (i, field) {
            var label = field.replace(/_/g, ' ').replace(/\b\w/g, function (l) { return l.toUpperCase(); });
            var val = existingData[field] || '';
            rowHtml += '<div class="col-md-3"><div class="form-group">' +
                '<label for="data_' + field + '">' + label + ':</label>' +
                '<input type="text" name="data[' + field + ']" class="form-control input_number" value="' + val + '">' +
                '</div></div>';
        });
        rowHtml += '</div>';
        container.append(rowHtml);
    }

    $('select[name="type"]').on('change', function () {
        buildFields($(this).val());
    });

    buildFields($('select[name="type"]').val());

    $(document).on('click', '#add_custom_field', function () {
        var html = '<div class="col-md-5 custom-field-row" style="margin-top:8px;">' +
            '<div class="input-group">' +
            '<input type="text" name="custom_labels[]" class="form-control" placeholder="Field Name">' +
            '<span class="input-group-btn" style="width:0;"></span>' +
            '<input type="text" name="custom_values[]" class="form-control input_number" placeholder="Value">' +
            '<span class="input-group-btn"><button type="button" class="btn btn-danger remove_custom_field"><i class="fas fa-times"></i></button></span>' +
            '</div></div>';
        $(this).closest('.col-md-12').before(html);
    });
    $(document).on('click', '.remove_custom_field', function () {
        $(this).closest('.custom-field-row').remove();
    });

    $('#tailorpro_measurement_form').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);

        if ($('select[name="type"]').val() === 'custom') {
            var customData = {};
            $('input[name="custom_labels[]"]').each(function (i) {
                var label = $(this).val().trim();
                var value = $('input[name="custom_values[]"]').eq(i).val().trim();
                if (label) customData[label.toLowerCase().replace(/\s+/g, '_')] = value;
            });
            form.find('input[name^="custom_"]').remove();
            $.each(customData, function (k, v) {
                form.append('<input type="hidden" name="data[' + k + ']" value="' + v + '">');
            });
        }

        $.ajax({
            method: 'PUT',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
                    window.location.href = '<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, "index"]), false); ?>';
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function () {
                toastr.error('An error occurred.');
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
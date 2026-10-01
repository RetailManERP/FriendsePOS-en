
<?php $__env->startSection('title', __('tailorpro::lang.edit_measurement_template')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-edit" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.edit_measurement_template'); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'update'], [$template->id]), 'method' => 'put', 'id' => 'tailorpro_template_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.measurement_templates'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('tailorpro::lang.template_name') . ':*'); ?>

                        <?php echo Form::text('name', $template->name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('garment_type', __('tailorpro::lang.garment_type') . ':'); ?>

                        <?php echo Form::text('garment_type', $template->garment_type, ['class' => 'form-control', 'id' => 'template_garment_type']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('sort_order', __('tailorpro::lang.sort_order') . ':'); ?>

                        <?php echo Form::number('sort_order', $template->sort_order, ['class' => 'form-control', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <?php echo Form::label('is_default', __('tailorpro::lang.is_default') . ':'); ?><br>
                        <?php echo Form::checkbox('is_default', 1, $template->is_default); ?>

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
                        <?php if(is_array($template->fields)): ?>
                            <?php $__currentLoopData = $template->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="text" name="field_label[]" class="form-control" value="<?php echo e($field['label'] ?? '', false); ?>" required></td>
                                <td><input type="text" name="field_key[]" class="form-control" value="<?php echo e($field['key'] ?? '', false); ?>"></td>
                                <td><input type="text" name="field_unit[]" class="form-control" value="<?php echo e($field['unit'] ?? 'inch', false); ?>"></td>
                                <td><input type="checkbox" name="field_required[<?php echo e($i, false); ?>]" value="1" <?php echo e(!empty($field['is_required']) ? 'checked' : '', false); ?>></td>
                                <td><button type="button" class="btn btn-xs btn-danger remove_field_btn"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
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
    var fieldIndex = <?php echo e(is_array($template->fields) ? count($template->fields) : 0, false); ?>;

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

    $(document).on('blur', 'input[name="field_label[]"]', function () {
        var $keyInput = $(this).closest('tr').find('input[name="field_key[]"]');
        if (!$keyInput.val()) {
            $keyInput.val($(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, ''));
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('tailorpro::lang.add_custom_field')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-plus-circle" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.add_custom_field'); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\CustomFieldController::class, 'store']), 'method' => 'post', 'id' => 'tailorpro_custom_field_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.custom_fields'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('field_label', __('tailorpro::lang.field_label') . ':*'); ?>

                        <?php echo Form::text('field_label', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('field_type', __('tailorpro::lang.field_type') . ':*'); ?>

                        <?php echo Form::select('field_type', [
                            'text' => __('tailorpro::lang.text'),
                            'number' => __('tailorpro::lang.number'),
                            'select' => __('tailorpro::lang.select'),
                            'textarea' => __('tailorpro::lang.textarea'),
                            'date' => __('tailorpro::lang.date'),
                        ], 'text', ['class' => 'form-control', 'required', 'id' => 'field_type_select']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('entity_type', __('tailorpro::lang.entity_type') . ':*'); ?>

                        <?php echo Form::select('entity_type', [
                            'order' => __('tailorpro::lang.order'),
                            'order_item' => __('tailorpro::lang.order_items'),
                            'measurement' => __('tailorpro::lang.measurement'),
                        ], 'order', ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="options_row" style="display:none;">
                    <div class="form-group">
                        <?php echo Form::label('options', __('tailorpro::lang.field_options') . ':'); ?>

                        <?php echo Form::text('options', null, ['class' => 'form-control', 'placeholder' => __('tailorpro::lang.field_options_help')]); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('sort_order', __('tailorpro::lang.sort_order') . ':'); ?>

                        <?php echo Form::number('sort_order', 0, ['class' => 'form-control', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('is_required', __('tailorpro::lang.is_required') . ':'); ?><br>
                        <?php echo Form::checkbox('is_required', 1, false); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('is_active', __('tailorpro::lang.active') . ':'); ?><br>
                        <?php echo Form::checkbox('is_active', 1, true); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {
    $('#field_type_select').on('change', function () {
        $('#options_row').toggle($(this).val() === 'select');
    }).trigger('change');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
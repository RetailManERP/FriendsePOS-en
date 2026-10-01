
<?php $__env->startSection('title', __('tailorpro::lang.settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-cogs" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.settings'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\SettingsController::class, 'store']), 'method' => 'post', 'id' => 'tailorpro_settings_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.module_settings'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('order_prefix', __('tailorpro::lang.order_prefix') . ':'); ?>

                        <?php echo Form::text('order_prefix', $settings['order_prefix'] ?? 'TP', ['class' => 'form-control']); ?>

                        <span class="help-block"><?php echo app('translator')->get('tailorpro::lang.order_prefix_help'); ?></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('stock_deduction_stage', __('tailorpro::lang.stock_deduction_stage') . ':'); ?>

                        <?php echo Form::select('stock_deduction_stage', [
                            'on_order' => __('tailorpro::lang.on_order_creation'),
                            'on_cutting' => __('tailorpro::lang.on_cutting_status'),
                            'manual' => __('tailorpro::lang.manual_only'),
                        ], $settings['stock_deduction_stage'] ?? 'manual', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('default_garment_types', __('tailorpro::lang.default_garment_types') . ':'); ?>

                        <?php echo Form::text('default_garment_types', $settings['default_garment_types'] ?? 'Shirt,Trouser,Blouse,Dress,Suit,Custom', ['class' => 'form-control']); ?>

                        <span class="help-block"><?php echo app('translator')->get('tailorpro::lang.comma_separated'); ?></span>
                    </div>
                </div>
            </div>

            <hr>
            <h4><?php echo app('translator')->get('tailorpro::lang.feature_toggles'); ?></h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_trial_tracking', 1, ($settings['enable_trial_tracking'] ?? true)); ?>

                            <?php echo app('translator')->get('tailorpro::lang.enable_trial_tracking'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_sms_notifications', 1, ($settings['enable_sms_notifications'] ?? false)); ?>

                            <?php echo app('translator')->get('tailorpro::lang.enable_sms_notifications'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_email_notifications', 1, ($settings['enable_email_notifications'] ?? false)); ?>

                            <?php echo app('translator')->get('tailorpro::lang.enable_email_notifications'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_auto_stock_deduction', 1, ($settings['enable_auto_stock_deduction'] ?? false)); ?>

                            <?php echo app('translator')->get('tailorpro::lang.enable_auto_stock_deduction'); ?>
                        </label>
                    </div>
                </div>
            </div>

            <hr>
            <h4><?php echo app('translator')->get('tailorpro::lang.display_settings'); ?></h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('dashboard_default_days', __('tailorpro::lang.dashboard_default_days') . ':'); ?>

                        <?php echo Form::number('dashboard_default_days', $settings['dashboard_default_days'] ?? 7, ['class' => 'form-control', 'min' => 1, 'max' => 90]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('orders_per_page', __('tailorpro::lang.orders_per_page') . ':'); ?>

                        <?php echo Form::select('orders_per_page', [10 => 10, 25 => 25, 50 => 50, 100 => 100], $settings['orders_per_page'] ?? 25, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>

            <hr>
            <h4><i class="fas fa-sort-numeric-down"></i> <?php echo app('translator')->get('tailorpro::lang.order_number_format'); ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('order_number_format', __('tailorpro::lang.order_number_format') . ':'); ?>

                        <?php echo Form::select('order_number_format', [
                            'prefix_increment' => __('tailorpro::lang.prefix_increment') . ' (TP-00001)',
                            'prefix_date_increment' => __('tailorpro::lang.prefix_date_increment') . ' (TP-20250101-001)',
                            'year_month_increment' => __('tailorpro::lang.year_month_increment') . ' (TP-2025-01-001)',
                        ], $settings['order_number_format'] ?? 'prefix_increment', ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>

            <hr>
            <h4><i class="fas fa-bell"></i> <?php echo app('translator')->get('tailorpro::lang.notification_settings'); ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('sms_template', __('tailorpro::lang.sms_template') . ':'); ?>

                        <?php echo Form::textarea('sms_template', $settings['sms_template'] ?? 'Dear {customer_name}, your order #{order_no} status has been updated to {status}. Expected delivery: {delivery_date}.', ['class' => 'form-control', 'rows' => 3]); ?>

                        <span class="help-block"><?php echo app('translator')->get('tailorpro::lang.sms_template_variables'); ?>: <code>{customer_name}</code>, <code>{order_no}</code>, <code>{status}</code>, <code>{delivery_date}</code>, <code>{business_name}</code></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('email_template', __('tailorpro::lang.email_template') . ':'); ?>

                        <?php echo Form::textarea('email_template', $settings['email_template'] ?? 'Dear {customer_name}, your tailoring order #{order_no} is now "{status}". Expected delivery: {delivery_date}. Thank you for choosing {business_name}.', ['class' => 'form-control', 'rows' => 3]); ?>

                        <span class="help-block"><?php echo app('translator')->get('tailorpro::lang.email_template_variables'); ?>: <code>{customer_name}</code>, <code>{order_no}</code>, <code>{status}</code>, <code>{delivery_date}</code>, <code>{business_name}</code></span>
                    </div>
                </div>
            </div>

            <hr>
            <h4><i class="fas fa-link"></i> <?php echo app('translator')->get('tailorpro::lang.quick_links'); ?></h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex flex-wrap" style="gap:10px;">
                        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'index']), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-tshirt"></i> <?php echo app('translator')->get('tailorpro::lang.garment_catalog'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'index']), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-drafting-compass"></i> <?php echo app('translator')->get('tailorpro::lang.measurement_templates'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\CustomFieldController::class, 'index']), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-sliders-h"></i> <?php echo app('translator')->get('tailorpro::lang.custom_fields'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'index']), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-tags"></i> <?php echo app('translator')->get('tailorpro::lang.statuses'); ?>
                        </a>
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
    $('#tailorpro_settings_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
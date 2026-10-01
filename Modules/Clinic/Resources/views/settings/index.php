

<?php $__env->startSection('title', __('clinic::lang.clinic_settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('clinic::lang.clinic_settings'); ?>
        <small><?php echo app('translator')->get('clinic::lang.configure_clinic'); ?></small>
    </h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => url('clinic/settings'), 'method' => 'post', 'id' => 'clinic_settings_form']); ?>


    <div class="row">
        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('clinic::lang.general_settings')]); ?>
                <div class="form-group">
                    <?php echo Form::label('clinic_name', __('clinic::lang.clinic_name') . ':'); ?>

                    <?php echo Form::text('settings[clinic_name]', $settings['clinic_name'] ?? null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.clinic_name')]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('clinic_address', __('clinic::lang.address') . ':'); ?>

                    <?php echo Form::textarea('settings[clinic_address]', $settings['clinic_address'] ?? null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('clinic_phone', __('clinic::lang.phone') . ':'); ?>

                            <?php echo Form::text('settings[clinic_phone]', $settings['clinic_phone'] ?? null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('clinic_email', __('clinic::lang.email') . ':'); ?>

                            <?php echo Form::email('settings[clinic_email]', $settings['clinic_email'] ?? null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('clinic_registration_no', __('clinic::lang.registration_no') . ':'); ?>

                    <?php echo Form::text('settings[clinic_registration_no]', $settings['clinic_registration_no'] ?? null, ['class' => 'form-control']); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('clinic::lang.appointment_settings')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('appointment_slot_duration', __('clinic::lang.slot_duration') . ':'); ?>

                            <div class="input-group">
                                <?php echo Form::number('settings[appointment_slot_duration]', $settings['appointment_slot_duration'] ?? 15, ['class' => 'form-control', 'min' => 5, 'max' => 120]); ?>

                                <span class="input-group-text"><?php echo app('translator')->get('clinic::lang.minutes'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('max_appointments_per_day', __('clinic::lang.max_appointments_per_day') . ':'); ?>

                            <?php echo Form::number('settings[max_appointments_per_day]', $settings['max_appointments_per_day'] ?? 50, ['class' => 'form-control', 'min' => 1]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('working_start_time', __('clinic::lang.working_start_time') . ':'); ?>

                            <?php echo Form::time('settings[working_start_time]', $settings['working_start_time'] ?? '08:00', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('working_end_time', __('clinic::lang.working_end_time') . ':'); ?>

                            <?php echo Form::time('settings[working_end_time]', $settings['working_end_time'] ?? '17:00', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[allow_walk_ins]', 1, ($settings['allow_walk_ins'] ?? 1), ['id' => 'allow_walk_ins']); ?>

                            <?php echo app('translator')->get('clinic::lang.allow_walk_ins'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[auto_queue_on_checkin]', 1, ($settings['auto_queue_on_checkin'] ?? 1), ['id' => 'auto_queue_on_checkin']); ?>

                            <?php echo app('translator')->get('clinic::lang.auto_queue_on_checkin'); ?>
                        </label>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('clinic::lang.prescription_settings')]); ?>
                <div class="form-group">
                    <?php echo Form::label('prescription_header', __('clinic::lang.prescription_header') . ':'); ?>

                    <?php echo Form::textarea('settings[prescription_header]', $settings['prescription_header'] ?? null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('clinic::lang.prescription_header_help')]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('prescription_footer', __('clinic::lang.prescription_footer') . ':'); ?>

                    <?php echo Form::textarea('settings[prescription_footer]', $settings['prescription_footer'] ?? null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('clinic::lang.prescription_footer_help')]); ?>

                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[auto_deduct_stock]', 1, ($settings['auto_deduct_stock'] ?? 0), ['id' => 'auto_deduct_stock']); ?>

                            <?php echo app('translator')->get('clinic::lang.auto_deduct_stock'); ?>
                        </label>
                    </div>
                    <p class="help-block"><?php echo app('translator')->get('clinic::lang.auto_deduct_stock_help'); ?></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('default_consultation_fee', __('clinic::lang.default_consultation_fee') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                        <?php echo Form::number('settings[default_consultation_fee]', $settings['default_consultation_fee'] ?? 0, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('clinic::lang.notification_settings')]); ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[sms_appointment_reminder]', 1, ($settings['sms_appointment_reminder'] ?? 0)); ?>

                            <?php echo app('translator')->get('clinic::lang.sms_appointment_reminder'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[email_appointment_reminder]', 1, ($settings['email_appointment_reminder'] ?? 0)); ?>

                            <?php echo app('translator')->get('clinic::lang.email_appointment_reminder'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('reminder_before_hours', __('clinic::lang.reminder_before_hours') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::number('settings[reminder_before_hours]', $settings['reminder_before_hours'] ?? 24, ['class' => 'form-control', 'min' => 1]); ?>

                        <span class="input-group-text"><?php echo app('translator')->get('clinic::lang.hours'); ?></span>
                    </div>
                </div>
                <hr>
                <h5><?php echo app('translator')->get('clinic::lang.queue_settings'); ?></h5>
                <div class="form-group">
                    <?php echo Form::label('queue_prefix', __('clinic::lang.queue_prefix') . ':'); ?>

                    <?php echo Form::text('settings[queue_prefix]', $settings['queue_prefix'] ?? 'Q', ['class' => 'form-control', 'maxlength' => 5]); ?>

                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[queue_display_enabled]', 1, ($settings['queue_display_enabled'] ?? 1)); ?>

                            <?php echo app('translator')->get('clinic::lang.enable_queue_display'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[queue_audio_alert]', 1, ($settings['queue_audio_alert'] ?? 0)); ?>

                            <?php echo app('translator')->get('clinic::lang.queue_audio_alert'); ?>
                        </label>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('clinic::lang.patient_id_settings')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('patient_id_prefix', __('clinic::lang.patient_id_prefix') . ':'); ?>

                            <?php echo Form::text('settings[patient_id_prefix]', $settings['patient_id_prefix'] ?? 'PAT-', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('patient_id_length', __('clinic::lang.id_number_length') . ':'); ?>

                            <?php echo Form::number('settings[patient_id_length]', $settings['patient_id_length'] ?? 6, ['class' => 'form-control', 'min' => 4, 'max' => 10]); ?>

                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('clinic::lang.lab_settings')]); ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('settings[require_lab_authorization]', 1, ($settings['require_lab_authorization'] ?? 0)); ?>

                            <?php echo app('translator')->get('clinic::lang.require_lab_authorization'); ?>
                        </label>
                    </div>
                    <p class="help-block"><?php echo app('translator')->get('clinic::lang.require_lab_authorization_help'); ?></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('lab_report_header', __('clinic::lang.lab_report_header') . ':'); ?>

                    <?php echo Form::textarea('settings[lab_report_header]', $settings['lab_report_header'] ?? null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Save Settings via AJAX
        $('#clinic_settings_form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(result) {
                    if(result.success) {
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function(xhr) {
                    toastr.error("<?php echo app('translator')->get('messages.something_went_wrong'); ?>");
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
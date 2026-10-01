<div class="pos-tab-content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('is_location_required', 1, !empty($settings['is_location_required']) ? 1 : 0, ['class' => 'form-check-input'] ); ?> <?php echo app('translator')->get('essentials::lang.is_location_required'); ?>
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-12">
            <strong><?php echo app('translator')->get('essentials::lang.grace_time'); ?>:</strong>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('grace_before_checkin',  __('essentials::lang.grace_before_checkin') . ':'); ?>

                <?php echo Form::number('grace_before_checkin', !empty($settings['grace_before_checkin']) ? $settings['grace_before_checkin'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.grace_before_checkin'), 'step' => 1]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.grace_before_checkin_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('grace_after_checkin',  __('essentials::lang.grace_after_checkin') . ':'); ?>

                <?php echo Form::number('grace_after_checkin', !empty($settings['grace_after_checkin']) ? $settings['grace_after_checkin'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.grace_after_checkin'), 'step' => 1]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.grace_after_checkin_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('grace_before_checkout',  __('essentials::lang.grace_before_checkout') . ':'); ?>

                <?php echo Form::number('grace_before_checkout', !empty($settings['grace_before_checkout']) ? $settings['grace_before_checkout'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.grace_before_checkout'), 'step' => 1]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.grace_before_checkout_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('grace_after_checkout',  __('essentials::lang.grace_after_checkout') . ':'); ?>

                <?php echo Form::number('grace_after_checkout', !empty($settings['grace_after_checkout']) ? $settings['grace_after_checkout'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.grace_after_checkout'), 'step' => 1]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.grace_before_checkin_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('overtime_multiplier',  __('essentials::lang.overtime_multiplier') . ':'); ?>

                <?php echo Form::number('overtime_multiplier', !empty($settings['overtime_multiplier']) ? $settings['overtime_multiplier'] : 1, ['class' => 'form-control','placeholder' => __('essentials::lang.overtime_multiplier')]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.overtime_multiplier_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('deduction_multiplier',  __('essentials::lang.deduction_multiplier') . ':'); ?>

                <?php echo Form::number('deduction_multiplier', !empty($settings['deduction_multiplier']) ? $settings['deduction_multiplier'] : 1, ['class' => 'form-control','placeholder' => __('essentials::lang.deduction_multiplier')]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.deduction_multiplier_help'); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('round_to',  __('essentials::lang.round_to') . ':'); ?>

                <?php echo Form::select('round_to', ['hour' => 'Hour'], !empty($settings['round_to']) ? $settings['round_to'] : null,['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                <p class="help-block"><?php echo app('translator')->get('essentials::lang.round_to_help'); ?></p>
            </div>
        </div>
    </div>
    <p>
        <i class="fas fa-info-circle"></i>
      <span class="text-danger"><?php echo app('translator')->get('essentials::lang.allow_users_for_attendance_moved_to_role'); ?></span>
    </p>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <strong><?php echo app('translator')->get('essentials::lang.attendence_sync_settings'); ?>:</strong>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('attendence_terminal_api_key',  __('essentials::lang.attendence_terminal_api_key') . ':'); ?>

                <?php echo Form::text('attendence_terminal_api_key', !empty($settings['attendence_terminal_api_key']) ? $settings['attendence_terminal_api_key'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.attendence_terminal_api_key')]); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('attendence_terminal_api_secret',  __('essentials::lang.attendence_terminal_api_secret') . ':'); ?>

                <?php echo Form::text('attendence_terminal_api_secret', !empty($settings['attendence_terminal_api_secret']) ? $settings['attendence_terminal_api_secret'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.attendence_terminal_api_secret')]); ?>

            </div>
        </div>
    </div>
</div>

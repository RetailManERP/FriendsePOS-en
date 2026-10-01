<div class="pos-tab-content">
    <div class="row">
    	<div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('APP_NAME', __('superadmin::lang.app_name') . ':'); ?>

            	<?php echo Form::text('APP_NAME', $default_values['APP_NAME'], ['class' => 'form-control','placeholder' => __('superadmin::lang.app_name')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('APP_TITLE', __('superadmin::lang.app_title') . ':'); ?>

            	<?php echo Form::text('APP_TITLE', $default_values['APP_TITLE'], ['class' => 'form-control','placeholder' => __('superadmin::lang.app_title')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('APP_LOCALE', __('superadmin::lang.app_default_language') . ':'); ?>

            	<?php echo Form::select('APP_LOCALE', $languages, $default_values['APP_LOCALE'], ['class' => 'form-control']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="form-check-label">
<?php echo Form::checkbox('ALLOW_REGISTRATION', 1,!empty($default_values["ALLOW_REGISTRATION"]), 
                [ 'class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('superadmin::lang.allow_registration'); ?>
                </label>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo Form::label('REGISTRATION_URL', __('superadmin::lang.registration_url') . ':'); ?>

                <?php echo Form::text('REGISTRATION_URL', $default_values['REGISTRATION_URL'], ['class' => 'form-control', 'placeholder' => route('business.getRegister')]); ?>

                <p class="help-block"><?php echo app('translator')->get('superadmin::lang.registration_url_help', ['url' => route('business.getRegister')]); ?></p>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="form-check-label">
<?php echo Form::checkbox('superadmin_enable_register_tc', 1,!empty($settings["superadmin_enable_register_tc"]), 
                [ 'class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('superadmin::lang.enable_register_tc'); ?>
                </label>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="form-check-label">
<?php echo Form::checkbox('disable_pricing', 1, !empty($settings["disable_pricing"]),
                [ 'class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('superadmin::lang.disable_pricing'); ?>
                </label>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="form-check-label">
<?php echo Form::checkbox('is_email_required', 1, !empty($settings["is_email_required"]),
                [ 'class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('superadmin::lang.is_email_required'); ?>
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <div class="form-group">
                <?php echo Form::label('superadmin_register_tc', __('superadmin::lang.register_tc') .":"); ?>

                <button type="button" class="btn btn-xs btn-primary btn-modal pull-right" data-href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class, 'showAgreementUrl']), false); ?>" data-container=".view_modal">
                    <i class="fas fa-link"></i> <?php echo app('translator')->get('superadmin::lang.agreement_url'); ?>
                </button>

                <?php echo Form::textarea('superadmin_register_tc', !empty($settings['superadmin_register_tc']) ? $settings['superadmin_register_tc'] : '', ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('GOOGLE_MAP_API_KEY', __('superadmin::lang.google_map_api_key') . ':'); ?>

                <?php echo Form::text('GOOGLE_MAP_API_KEY', $default_values['GOOGLE_MAP_API_KEY'], ['class' => 'form-control','placeholder' => __('superadmin::lang.google_map_api_key')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('default_theme_color', __('lang_v1.default_theme_color') . ':'); ?>

                <?php echo Form::select('default_theme_color', $theme_colors, !empty($settings['default_theme_color']) ? $settings['default_theme_color'] : null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                <p class="help-block"><?php echo app('translator')->get('lang_v1.default_theme_color_help'); ?></p>
            </div>
        </div>
    </div>
</div>

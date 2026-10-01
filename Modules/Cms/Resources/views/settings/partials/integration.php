<div class="pos-tab-content">
	<div class="row">
        <div class="col-xs-12">
            <div class="form-group mb-3">
                <?php echo Form::label('google_analytics', __('cms::lang.google_analytics') . ':'); ?>

                <?php echo Form::textarea('google_analytics', !empty($details['google_analytics']) ? $details['google_analytics'] : '', ['class' => 'form-control','placeholder' => __('cms::lang.google_analytics')]); ?>

            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group mb-3">
                <?php echo Form::label('fb_pixel', __('cms::lang.fb_pixel') . ':'); ?>

                <?php echo Form::textarea('fb_pixel', !empty($details['fb_pixel']) ? $details['fb_pixel'] : '', ['class' => 'form-control','placeholder' => __('cms::lang.fb_pixel')]); ?>

            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group mb-3">
                <?php echo Form::label('custom_js', __('cms::lang.custom_js') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.custom_js_instructions') . '"></i>';
                }
            ?>
                <?php echo Form::textarea('custom_js', !empty($details['custom_js']) ? $details['custom_js'] : '', ['class' => 'form-control','placeholder' => __('cms::lang.custom_js')]); ?>

            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group mb-3">
                <?php echo Form::label('custom_css', __('cms::lang.custom_css') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.custom_css_instructions') . '"></i>';
                }
            ?>
                <?php echo Form::textarea('custom_css', !empty($details['custom_css']) ? $details['custom_css'] : '', ['class' => 'form-control','placeholder' => __('cms::lang.custom_css')]); ?>

            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group mb-3">
                <?php echo Form::label('meta_tags', __('cms::lang.meta_tags') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.meta_tags_instructions') . '"></i>';
                }
            ?>
                <?php echo Form::textarea('meta_tags', !empty($details['meta_tags']) ? $details['meta_tags'] : '', ['class' => 'form-control','placeholder' => __('cms::lang.meta_tags')]); ?>

            </div>
        </div>
    </div>
</div>

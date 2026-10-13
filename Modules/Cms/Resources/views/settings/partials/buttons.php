<div class="pos-tab-content">
    <!-- button options -->
    <?php
        $btns = $details['btns'] ?? [];

        $navbar_btn['text'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('text', $btns['navbar'])) ? ($btns['navbar']['text'] ?? '') : 'Try For Free';
        $navbar_btn['link'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('link', $btns['navbar'])) ? ($btns['navbar']['link'] ?? '') : registration_url();

        $hero_btn['text'] = (isset($btns['hero']) && is_array($btns['hero']) && array_key_exists('text', $btns['hero'])) ? ($btns['hero']['text'] ?? '') : 'Start your Free Trial';
        $hero_btn['link'] = (isset($btns['hero']) && is_array($btns['hero']) && array_key_exists('link', $btns['hero'])) ? ($btns['hero']['link'] ?? '') : registration_url();

        $industry_btn['text'] = (isset($btns['industry']) && is_array($btns['industry']) && array_key_exists('text', $btns['industry'])) ? ($btns['industry']['text'] ?? '') : 'Get Started';
        $industry_btn['link'] = (isset($btns['industry']) && is_array($btns['industry']) && array_key_exists('link', $btns['industry'])) ? ($btns['industry']['link'] ?? '') : registration_url();

        $cta_btn['text'] = (isset($btns['cta']) && is_array($btns['cta']) && array_key_exists('text', $btns['cta'])) ? ($btns['cta']['text'] ?? '') : 'Try Now';
        $cta_btn['link'] = (isset($btns['cta']) && is_array($btns['cta']) && array_key_exists('link', $btns['cta'])) ? ($btns['cta']['link'] ?? '') : registration_url();
    ?>
    <div class="row g-3">
        <!-- navbar -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fas fa-bars"></i>
                    <h6><?php echo e(__('cms::lang.navbar_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('navbar_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[navbar][text]', $navbar_btn['text'], ['class' => 'form-control', 'id' => 'navbar_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('navbar_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[navbar][link]', $navbar_btn['link'], ['class' => 'form-control', 'id' => 'navbar_btn_link']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /navbar -->
        <!-- hero section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fas fa-bullhorn"></i>
                    <h6><?php echo e(__('cms::lang.hero_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('hero_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[hero][text]', $hero_btn['text'], ['class' => 'form-control', 'id' => 'hero_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('hero_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[hero][link]', $hero_btn['link'], ['class' => 'form-control', 'id' => 'hero_btn_link']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /hero section btn -->
        <!-- industry btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fas fa-industry"></i>
                    <h6><?php echo e(__('cms::lang.industry_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('industry_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[industry][text]', $industry_btn['text'], ['class' => 'form-control', 'id' => 'industry_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('industry_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[industry][link]', $industry_btn['link'], ['class' => 'form-control', 'id' => 'industry_btn_link']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /industry btn -->
        <!-- cta btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fas fa-mouse-pointer"></i>
                    <h6><?php echo e(__('cms::lang.call_to_action_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('call_to_action_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[cta][text]', $cta_btn['text'], ['class' => 'form-control', 'id' => 'call_to_action_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('call_to_action_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[cta][link]', $cta_btn['link'], ['class' => 'form-control', 'id' => 'call_to_action_btn_link']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /cta btn -->
    </div>
    <!-- /button options -->
</div>

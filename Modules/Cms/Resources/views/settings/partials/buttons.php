<div class="pos-tab-content">
    <!-- button options -->
    <?php
        $btns = $details['btns'] ?? [];
        $download_files = $download_files ?? [];
        $first_download_file_url = $download_files[0]['url'] ?? '';
        $download_file_input = !empty($download_files) ? ['list' => 'cms_public_download_files'] : [];

        $navbar_btn['text'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('text', $btns['navbar'])) ? ($btns['navbar']['text'] ?? '') : 'Try For Free';
        $navbar_btn['link'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('link', $btns['navbar'])) ? ($btns['navbar']['link'] ?? '') : registration_url();

        $hero_btn['text'] = (isset($btns['hero']) && is_array($btns['hero']) && array_key_exists('text', $btns['hero'])) ? ($btns['hero']['text'] ?? '') : 'Start your Free Trial';
        $hero_btn['link'] = (isset($btns['hero']) && is_array($btns['hero']) && array_key_exists('link', $btns['hero'])) ? ($btns['hero']['link'] ?? '') : registration_url();

        $andriod_btn['text'] = (isset($btns['andriod']) && is_array($btns['andriod']) && array_key_exists('text', $btns['andriod'])) ? ($btns['andriod']['text'] ?? '') : 'Start your Free Trial';
        $andriod_btn['link'] = (isset($btns['andriod']) && is_array($btns['andriod']) && array_key_exists('link', $btns['andriod'])) ? ($btns['andriod']['link'] ?? '') : registration_url();

        $andriod_btn_2['text'] = (isset($btns['andriod_2']) && is_array($btns['andriod_2']) && array_key_exists('text', $btns['andriod_2'])) ? ($btns['andriod_2']['text'] ?? '') : 'Start your Free Trial';
        $andriod_btn_2['link'] = (isset($btns['andriod_2']) && is_array($btns['andriod_2']) && array_key_exists('link', $btns['andriod_2'])) ? ($btns['andriod_2']['link'] ?? '') : registration_url();

        $ios_btn['text'] = (isset($btns['ios']) && is_array($btns['ios']) && array_key_exists('text', $btns['ios'])) ? ($btns['ios']['text'] ?? '') : 'Start your Free Trial';
        $ios_btn['link'] = (isset($btns['ios']) && is_array($btns['ios']) && array_key_exists('link', $btns['ios'])) ? ($btns['ios']['link'] ?? '') : registration_url();

        $ios_btn_2['text'] = (isset($btns['ios_2']) && is_array($btns['ios_2']) && array_key_exists('text', $btns['ios_2'])) ? ($btns['ios_2']['text'] ?? '') : 'Start your Free Trial';
        $ios_btn_2['link'] = (isset($btns['ios_2']) && is_array($btns['ios_2']) && array_key_exists('link', $btns['ios_2'])) ? ($btns['ios_2']['link'] ?? '') : registration_url();

        $download_win_btn['text'] = (isset($btns['windows']) && is_array($btns['windows']) && array_key_exists('text', $btns['windows'])) ? ($btns['windows']['text'] ?? '') : 'Start your Free Trial';
        $download_win_btn['link'] = (isset($btns['windows']) && is_array($btns['windows']) && array_key_exists('link', $btns['windows'])) ? ($btns['windows']['link'] ?? '') : ($first_download_file_url ?: registration_url());

        $download_win_btn_2['text'] = (isset($btns['windows_2']) && is_array($btns['windows_2']) && array_key_exists('text', $btns['windows_2'])) ? ($btns['windows_2']['text'] ?? '') : 'Windows App2 Download';
        $download_win_btn_2['link'] = (isset($btns['windows_2']) && is_array($btns['windows_2']) && array_key_exists('link', $btns['windows_2'])) ? ($btns['windows_2']['link'] ?? '') : $first_download_file_url;

        $download_linux_btn['text'] = (isset($btns['linux']) && is_array($btns['linux']) && array_key_exists('text', $btns['linux'])) ? ($btns['linux']['text'] ?? '') : 'Start your Free Trial';
        $download_linux_btn['link'] = (isset($btns['linux']) && is_array($btns['linux']) && array_key_exists('link', $btns['linux'])) ? ($btns['linux']['link'] ?? '') : registration_url();

        $download_osx_btn['text'] = (isset($btns['osx']) && is_array($btns['osx']) && array_key_exists('text', $btns['osx'])) ? ($btns['osx']['text'] ?? '') : 'Start your Free Trial';
        $download_osx_btn['link'] = (isset($btns['osx']) && is_array($btns['osx']) && array_key_exists('link', $btns['osx'])) ? ($btns['osx']['link'] ?? '') : registration_url();

        $industry_btn['text'] = (isset($btns['industry']) && is_array($btns['industry']) && array_key_exists('text', $btns['industry'])) ? ($btns['industry']['text'] ?? '') : 'Get Started';
        $industry_btn['link'] = (isset($btns['industry']) && is_array($btns['industry']) && array_key_exists('link', $btns['industry'])) ? ($btns['industry']['link'] ?? '') : registration_url();

        $cta_btn['text'] = (isset($btns['cta']) && is_array($btns['cta']) && array_key_exists('text', $btns['cta'])) ? ($btns['cta']['text'] ?? '') : 'Try Now';
        $cta_btn['link'] = (isset($btns['cta']) && is_array($btns['cta']) && array_key_exists('link', $btns['cta'])) ? ($btns['cta']['link'] ?? '') : registration_url();
    ?>
    <?php if(!empty($download_files)): ?>
        <datalist id="cms_public_download_files">
            <?php $__currentLoopData = $download_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $download_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($download_file['url'], false); ?>"><?php echo e($download_file['name'], false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </datalist>
    <?php endif; ?>
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
        <!-- andriod section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-android"></i>
                    <h6><?php echo e(__('cms::lang.andriod_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('andriod_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[andriod][text]', $andriod_btn['text'], ['class' => 'form-control', 'id' => 'andriod_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('andriod_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[andriod][link]', $andriod_btn['link'], array_merge(['class' => 'form-control', 'id' => 'andriod_btn_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /andriod section btn -->
        <!-- andriod 2 section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-android"></i>
                    <h6><?php echo e(__('cms::lang.andriod_btn_2'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('andriod_btn_2', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[andriod_2][text]', $andriod_btn_2['text'], ['class' => 'form-control', 'id' => 'andriod_btn_2']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('andriod_btn_2_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[andriod_2][link]', $andriod_btn_2['link'], array_merge(['class' => 'form-control', 'id' => 'andriod_btn_2_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /andriod 2 section btn -->
        <!-- iOS section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-apple"></i>
                    <h6><?php echo e(__('cms::lang.ios_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('ios_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[ios][text]', $ios_btn['text'], ['class' => 'form-control', 'id' => 'ios_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('ios_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[ios][link]', $ios_btn['link'], array_merge(['class' => 'form-control', 'id' => 'ios_btn_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /iOS section btn -->
        <!-- iOS 2 section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-apple"></i>
                    <h6><?php echo e(__('cms::lang.ios_btn_2'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('ios_btn_2', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[ios_2][text]', $ios_btn_2['text'], ['class' => 'form-control', 'id' => 'ios_btn_2']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('ios_btn_2_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[ios_2][link]', $ios_btn_2['link'], array_merge(['class' => 'form-control', 'id' => 'ios_btn_2_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /iOS 2 section btn -->
        <!-- windows section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-windows"></i>
                    <h6><?php echo e(__('cms::lang.download_win_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('download_win_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[windows][text]', $download_win_btn['text'], ['class' => 'form-control', 'id' => 'download_win_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('windows_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[windows][link]', $download_win_btn['link'], array_merge(['class' => 'form-control', 'id' => 'windows_btn_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /windows section btn -->
        <!-- windows app2 section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-windows"></i>
                    <h6><?php echo e(__('cms::lang.download_win_btn_2'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('download_win_btn_2', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[windows_2][text]', $download_win_btn_2['text'], ['class' => 'form-control', 'id' => 'download_win_btn_2']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('windows_btn_2_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[windows_2][link]', $download_win_btn_2['link'], array_merge(['class' => 'form-control', 'id' => 'windows_btn_2_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /windows app2 section btn -->
        <!-- linux section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-linux"></i>
                    <h6><?php echo e(__('cms::lang.download_linux_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('download_linux_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[linux][text]', $download_linux_btn['text'], ['class' => 'form-control', 'id' => 'download_linux_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('linux_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[linux][link]', $download_linux_btn['link'], array_merge(['class' => 'form-control', 'id' => 'linux_btn_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /linux section btn -->
        <!-- osx section btn -->
        <div class="col-md-6">
            <div class="cms-btn-settings-card">
                <div class="settings-card-header">
                    <i class="fab fa-apple"></i>
                    <h6><?php echo e(__('cms::lang.download_osx_btn'), false); ?></h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('download_osx_btn', __('cms::lang.button_text') . ':' ); ?>

                                <?php echo Form::text('btns[osx][text]', $download_osx_btn['text'], ['class' => 'form-control', 'id' => 'download_osx_btn']); ?>

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('osx_btn_link', __('cms::lang.button_link') . ':' ); ?>

                                <?php echo Form::text('btns[osx][link]', $download_osx_btn['link'], array_merge(['class' => 'form-control', 'id' => 'osx_btn_link'], $download_file_input)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /osx section btn -->
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

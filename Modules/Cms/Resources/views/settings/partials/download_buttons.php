<div class="pos-tab-content">
    <?php
        $download_files = $download_files ?? [];
        $download_file_input = !empty($download_files) ? ['list' => 'cms_public_download_files'] : [];
    ?>
    <div class="mb-4">
        <h5 class="fw-bold text-dark mb-1">
            <i class="fas fa-download me-2" style="color: var(--bs-primary)"></i>
            <?php echo app('translator')->get('cms::lang.download_buttons'); ?>
        </h5>
        <p class="text-muted" style="font-size: 0.8125rem;">
            <?php echo app('translator')->get('cms::lang.download_buttons_help'); ?>
        </p>
    </div>

    
    <div class="cms-btn-settings-card">
        <div class="settings-card-header">
            <i class="fab fa-android"></i>
            <h6><?php echo app('translator')->get('cms::lang.android_apps'); ?></h6>
        </div>
        <?php
            $android_app_1 = [
                'text' => $details['btns']['android_app_1']['text'] ?? 'Google Play',
                'link' => $details['btns']['android_app_1']['link'] ?? ''
            ];
            $android_app_2 = [
                'text' => $details['btns']['android_app_2']['text'] ?? 'APK Download',
                'link' => $details['btns']['android_app_2']['link'] ?? ''
            ];
        ?>
        <div class="row">
            <div class="col-md-6">
                <p class="fw-bold text-muted mb-2" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">
                    <?php echo app('translator')->get('cms::lang.android_app_primary'); ?>
                </p>
                <div class="form-group mb-3">
                    <?php echo Form::label('android_app_1_text', __('cms::lang.button_text') . ':'); ?>

                    <?php echo Form::text('btns[android_app_1][text]', $android_app_1['text'], ['class' => 'form-control', 'placeholder' => 'Google Play']); ?>

                </div>
                <div class="form-group mb-3">
                    <?php echo Form::label('android_app_1_link', __('cms::lang.button_link') . ':'); ?>

                    <?php echo Form::url('btns[android_app_1][link]', $android_app_1['link'], array_merge(['class' => 'form-control', 'placeholder' => 'https://play.google.com/store/apps/details?id=...'], $download_file_input)); ?>

                </div>
            </div>
            <div class="col-md-6">
                <p class="fw-bold text-muted mb-2" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">
                    <?php echo app('translator')->get('cms::lang.android_app_secondary'); ?>
                </p>
                <div class="form-group mb-3">
                    <?php echo Form::label('android_app_2_text', __('cms::lang.button_text') . ':'); ?>

                    <?php echo Form::text('btns[android_app_2][text]', $android_app_2['text'], ['class' => 'form-control', 'placeholder' => 'APK Download']); ?>

                </div>
                <div class="form-group mb-3">
                    <?php echo Form::label('android_app_2_link', __('cms::lang.button_link') . ':'); ?>

                    <?php echo Form::url('btns[android_app_2][link]', $android_app_2['link'], array_merge(['class' => 'form-control', 'placeholder' => 'https://example.com/app.apk'], $download_file_input)); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div class="cms-btn-settings-card">
        <div class="settings-card-header">
            <i class="fab fa-apple"></i>
            <h6><?php echo app('translator')->get('cms::lang.ios_apps'); ?></h6>
        </div>
        <?php
            $ios_app_1 = [
                'text' => $details['btns']['ios_app_1']['text'] ?? 'App Store',
                'link' => $details['btns']['ios_app_1']['link'] ?? ''
            ];
            $ios_app_2 = [
                'text' => $details['btns']['ios_app_2']['text'] ?? 'TestFlight',
                'link' => $details['btns']['ios_app_2']['link'] ?? ''
            ];
        ?>
        <div class="row">
            <div class="col-md-6">
                <p class="fw-bold text-muted mb-2" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">
                    <?php echo app('translator')->get('cms::lang.ios_app_primary'); ?>
                </p>
                <div class="form-group mb-3">
                    <?php echo Form::label('ios_app_1_text', __('cms::lang.button_text') . ':'); ?>

                    <?php echo Form::text('btns[ios_app_1][text]', $ios_app_1['text'], ['class' => 'form-control', 'placeholder' => 'App Store']); ?>

                </div>
                <div class="form-group mb-3">
                    <?php echo Form::label('ios_app_1_link', __('cms::lang.button_link') . ':'); ?>

                    <?php echo Form::url('btns[ios_app_1][link]', $ios_app_1['link'], array_merge(['class' => 'form-control', 'placeholder' => 'https://apps.apple.com/app/...'], $download_file_input)); ?>

                </div>
            </div>
            <div class="col-md-6">
                <p class="fw-bold text-muted mb-2" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">
                    <?php echo app('translator')->get('cms::lang.ios_app_secondary'); ?>
                </p>
                <div class="form-group mb-3">
                    <?php echo Form::label('ios_app_2_text', __('cms::lang.button_text') . ':'); ?>

                    <?php echo Form::text('btns[ios_app_2][text]', $ios_app_2['text'], ['class' => 'form-control', 'placeholder' => 'TestFlight']); ?>

                </div>
                <div class="form-group mb-3">
                    <?php echo Form::label('ios_app_2_link', __('cms::lang.button_link') . ':'); ?>

                    <?php echo Form::url('btns[ios_app_2][link]', $ios_app_2['link'], array_merge(['class' => 'form-control', 'placeholder' => 'https://testflight.apple.com/join/...'], $download_file_input)); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div class="cms-btn-settings-card">
        <div class="settings-card-header">
            <i class="fas fa-desktop"></i>
            <h6><?php echo app('translator')->get('cms::lang.desktop_apps'); ?></h6>
        </div>
        <p class="text-muted mb-3" style="font-size: 0.8125rem;">
            <i class="fas fa-info-circle me-1"></i>
            Desktop download URLs (Windows, Linux, macOS) are configured in the <strong>Buttons</strong> tab.
        </p>
    </div>
</div>

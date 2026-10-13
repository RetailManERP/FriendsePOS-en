<?php
    $saved_download_buttons = is_array(data_get($__site_details, 'btns'))
        ? data_get($__site_details, 'btns')
        : [];

    $download_sections = [
        [
            'title' => __('cms::lang.android_apps'),
            'buttons' => [],
            'messages' => [],
        ],
        [
            'title' => __('cms::lang.ios_apps'),
            'buttons' => [],
            'messages' => [],
        ],
        [
            'title' => __('cms::lang.desktop_apps'),
            'buttons' => [],
            'messages' => [],
        ],
    ];

    $download_button_definitions = [
        [
            'section' => 0,
            'key' => 'android_app_1',
            'text' => __('cms::lang.android_app_primary'),
            'eyebrow' => __('cms::lang.download_on'),
            'icon' => 'fab fa-google-play',
            'variant' => 'android',
        ],
        [
            'section' => 0,
            'key' => 'android_app_2',
            'text' => __('cms::lang.android_app_secondary'),
            'eyebrow' => __('cms::lang.get_it_on'),
            'icon' => 'fab fa-android',
            'variant' => 'android-alt',
            'empty_link_message' => __('cms::lang.android_pro_request_message'),
        ],
        [
            'section' => 1,
            'key' => 'ios_app_1',
            'text' => __('cms::lang.ios_app_primary'),
            'eyebrow' => __('cms::lang.download_on'),
            'icon' => 'fab fa-apple',
            'variant' => 'ios',
        ],
        [
            'section' => 1,
            'key' => 'ios_app_2',
            'text' => __('cms::lang.ios_app_secondary'),
            'eyebrow' => __('cms::lang.get_it_on'),
            'icon' => 'fab fa-app-store-ios',
            'variant' => 'ios-alt',
        ],
        [
            'section' => 2,
            'key' => 'windows',
            'text' => __('cms::lang.windows_app'),
            'eyebrow' => __('cms::lang.download_for'),
            'icon' => 'fab fa-windows',
            'variant' => 'windows',
        ],
        [
            'section' => 2,
            'key' => 'windows_2',
            'text' => __('cms::lang.windows_app_2'),
            'eyebrow' => __('cms::lang.download_for'),
            'icon' => 'fab fa-windows',
            'variant' => 'windows',
        ],
        [
            'section' => 2,
            'key' => 'linux',
            'text' => __('cms::lang.linux_app'),
            'eyebrow' => __('cms::lang.download_for'),
            'icon' => 'fab fa-linux',
            'variant' => 'linux',
        ],
        [
            'section' => 2,
            'key' => 'osx',
            'text' => __('cms::lang.macos_app'),
            'eyebrow' => __('cms::lang.download_for'),
            'icon' => 'fab fa-apple',
            'variant' => 'macos',
        ],
    ];

    foreach ($download_button_definitions as $definition) {
        $saved_button = $saved_download_buttons[$definition['key']] ?? [];
        if (!is_array($saved_button)) {
            continue;
        }

        $text = $saved_button['text'] ?? $definition['text'];
        $link = $saved_button['link'] ?? '';
        if (!is_string($text) || trim($text) === '') {
            continue;
        }

        if (!is_string($link) || trim($link) === '') {
            if (isset($definition['empty_link_message'])) {
                $download_sections[$definition['section']]['messages'][] = $definition['empty_link_message'];
            }
            continue;
        }

        $download_sections[$definition['section']]['buttons'][] = [
            'text' => $text,
            'link' => $link,
            'eyebrow' => $definition['eyebrow'],
            'icon' => $definition['icon'],
            'variant' => $definition['variant'],
        ];
    }

    $download_sections = array_filter($download_sections, function ($section) {
        return !empty($section['buttons']) || !empty($section['messages']);
    });
?>

<?php if(!empty($download_sections)): ?>
    <section class="cms-public-downloads" aria-labelledby="cms-public-downloads-title">
        <div class="container">
            <header class="cms-public-downloads__header">
                <span class="cms-public-downloads__heading-icon" aria-hidden="true"><i class="fas fa-download"></i></span>
                <div>
                    <h2 id="cms-public-downloads-title"><?php echo app('translator')->get('cms::lang.download_apps'); ?></h2>
                    <p><?php echo app('translator')->get('cms::lang.download_apps_desc'); ?></p>
                </div>
            </header>

            <?php $__currentLoopData = $download_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cms-public-downloads__group">
                    <h3><?php echo e($section['title'], false); ?></h3>
                    <div class="cms-public-downloads__grid">
                        <?php $__currentLoopData = $section['buttons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="cms-public-downloads__button cms-public-downloads__button--<?php echo e($button['variant'], false); ?>"
                                href="<?php echo e($button['link'], false); ?>"
                                target="_blank"
                                rel="noopener noreferrer">
                                <span class="cms-public-downloads__button-icon" aria-hidden="true"><i class="<?php echo e($button['icon'], false); ?>"></i></span>
                                <span class="cms-public-downloads__button-text">
                                    <span class="cms-public-downloads__eyebrow"><?php echo e($button['eyebrow'], false); ?></span>
                                    <span class="cms-public-downloads__label"><?php echo e($button['text'], false); ?></span>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $section['messages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="cms-public-downloads__notice">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                <span><?php echo e($message, false); ?></span>
                            </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php endif; ?>


<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('modules/cms/css/cms-downloads.css?v=' . filemtime(public_path('modules/cms/css/cms-downloads.css'))), false); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('preload'); ?>
<?php
    $preload_hero_image = !empty(optional($page)->feature_image_url)
        ? $page->feature_image_url
        : asset('modules/cms/img/home.webp');
?>
<link rel="preload" as="image" href="<?php echo e($preload_hero_image, false); ?>" <?php if(empty(optional($page)->feature_image_url)): ?> type="image/webp" <?php endif; ?> fetchpriority="high">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $btns = $__site_details['btns'] ?? [];

    $navbar_btn['text'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('text', $btns['navbar'])) ? ($btns['navbar']['text'] ?? '') : 'Try For Free';
    $navbar_btn['link'] = !empty($btns['navbar']['link']) ? $btns['navbar']['link'] : registration_url();

    $hero_btn['text'] = (isset($btns['hero']) && is_array($btns['hero']) && array_key_exists('text', $btns['hero'])) ? ($btns['hero']['text'] ?? '') : 'Start your Free Trial';
    $hero_btn['link'] = !empty($btns['hero']['link']) ? $btns['hero']['link'] : registration_url();

    $andriod_btn['text'] = (isset($btns['andriod']) && is_array($btns['andriod']) && array_key_exists('text', $btns['andriod'])) ? ($btns['andriod']['text'] ?? '') : 'Start your Free Trial';
    $andriod_btn['link'] = (isset($btns['andriod']) && is_array($btns['andriod']) && array_key_exists('link', $btns['andriod'])) ? ($btns['andriod']['link'] ?? '') : registration_url();

    $andriod_btn_2['text'] = (isset($btns['andriod_2']) && is_array($btns['andriod_2']) && array_key_exists('text', $btns['andriod_2'])) ? ($btns['andriod_2']['text'] ?? '') : '';
    $andriod_btn_2['link'] = (isset($btns['andriod_2']) && is_array($btns['andriod_2']) && array_key_exists('link', $btns['andriod_2'])) ? ($btns['andriod_2']['link'] ?? '') : '';

    $ios_btn['text'] = (isset($btns['ios']) && is_array($btns['ios']) && array_key_exists('text', $btns['ios'])) ? ($btns['ios']['text'] ?? '') : '';
    $ios_btn['link'] = (isset($btns['ios']) && is_array($btns['ios']) && array_key_exists('link', $btns['ios'])) ? ($btns['ios']['link'] ?? '') : '';

    $ios_btn_2['text'] = (isset($btns['ios_2']) && is_array($btns['ios_2']) && array_key_exists('text', $btns['ios_2'])) ? ($btns['ios_2']['text'] ?? '') : '';
    $ios_btn_2['link'] = (isset($btns['ios_2']) && is_array($btns['ios_2']) && array_key_exists('link', $btns['ios_2'])) ? ($btns['ios_2']['link'] ?? '') : '';

    $download_win_btn['text'] = (isset($btns['windows']) && is_array($btns['windows']) && array_key_exists('text', $btns['windows'])) ? ($btns['windows']['text'] ?? '') : '';
    $download_win_btn['link'] = (isset($btns['windows']) && is_array($btns['windows']) && array_key_exists('link', $btns['windows'])) ? ($btns['windows']['link'] ?? '') : '';

    $download_win_btn_2['text'] = (isset($btns['windows_2']) && is_array($btns['windows_2']) && array_key_exists('text', $btns['windows_2'])) ? ($btns['windows_2']['text'] ?? '') : '';
    $download_win_btn_2['link'] = (isset($btns['windows_2']) && is_array($btns['windows_2']) && array_key_exists('link', $btns['windows_2'])) ? ($btns['windows_2']['link'] ?? '') : '';

    $download_linux_btn['text'] = (isset($btns['linux']) && is_array($btns['linux']) && array_key_exists('text', $btns['linux'])) ? ($btns['linux']['text'] ?? '') : '';
    $download_linux_btn['link'] = (isset($btns['linux']) && is_array($btns['linux']) && array_key_exists('link', $btns['linux'])) ? ($btns['linux']['link'] ?? '') : '';

    $download_osx_btn['text'] = (isset($btns['osx']) && is_array($btns['osx']) && array_key_exists('text', $btns['osx'])) ? ($btns['osx']['text'] ?? '') : '';
    $download_osx_btn['link'] = (isset($btns['osx']) && is_array($btns['osx']) && array_key_exists('link', $btns['osx'])) ? ($btns['osx']['link'] ?? '') : '';

    $industry_btn['text'] = (isset($btns['industry']) && is_array($btns['industry']) && array_key_exists('text', $btns['industry'])) ? ($btns['industry']['text'] ?? '') : 'Get Started';
    $industry_btn['link'] = !empty($btns['industry']['link']) ? $btns['industry']['link'] : registration_url();

    $cta_btn['text'] = (isset($btns['cta']) && is_array($btns['cta']) && array_key_exists('text', $btns['cta'])) ? ($btns['cta']['text'] ?? '') : 'Try Now';
    $cta_btn['link'] = !empty($btns['cta']['link']) ? $btns['cta']['link'] : registration_url();
?>
<?php if ($__env->exists('cms::frontend.layouts.home_header')) echo $__env->make('cms::frontend.layouts.home_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if ($__env->exists('cms::frontend.pages.partials.downloads')) echo $__env->make('cms::frontend.pages.partials.downloads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $page_meta = !empty($page) && !empty($page->pageMeta) ? $page->pageMeta->keyBy('meta_key') : collect();
?>


<?php if ($__env->exists('cms::frontend.pages.partials.features', ['page_meta' => $page_meta])) echo $__env->make('cms::frontend.pages.partials.features', ['page_meta' => $page_meta], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.industries', ['page_meta' => $page_meta])) echo $__env->make('cms::frontend.pages.partials.industries', ['page_meta' => $page_meta], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.modules', ['modules' => $modules ?? []])) echo $__env->make('cms::frontend.pages.partials.modules', ['modules' => $modules ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.statistics', ['statistics' => $statistics ?? []])) echo $__env->make('cms::frontend.pages.partials.statistics', ['statistics' => $statistics ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.testimonial', ['testimonials' => $testimonials ?? []])) echo $__env->make('cms::frontend.pages.partials.testimonial', ['testimonials' => $testimonials ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.cta')) echo $__env->make('cms::frontend.pages.partials.cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('cms::frontend.pages.partials.faq', ['faqs' => $faqs ?? []])) echo $__env->make('cms::frontend.pages.partials.faq', ['faqs' => $faqs ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    if (typeof Sticky !== "undefined") {
        new Sticky("[sticky]");
    }

    (function () {
        var modulesEl = document.querySelector("#cms-modules-splide");
        if (modulesEl && typeof Splide !== "undefined") {
            new Splide("#cms-modules-splide", {
                type: "loop",
                perPage: 4,
                perMove: 1,
                gap: "1.5rem",
                arrows: false,
                pagination: true,
                autoplay: true,
                interval: 2800,
                speed: 700,
                pauseOnHover: true,
                pauseOnFocus: false,
                resetProgress: false,
                breakpoints: {
                    1200: { perPage: 3 },
                    992:  { perPage: 2 },
                    576:  { perPage: 1, gap: "1rem" }
                }
            }).mount();
        }
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!doctype html>
<html lang="en">
    <head>
        <?php echo $__env->make('cms::frontend.layouts.analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Custom metas -->
        <?php if(!empty($__site_details['meta_tags'])): ?>
            <?php echo \App\Support\PublicSeo::supplementalHead($__site_details['meta_tags']); ?>

        <?php endif; ?>
        <?php echo $__env->make('cms::frontend.layouts.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo \App\Support\PublicSeo::supplementalHead($__env->yieldContent('meta')); ?>

        <?php echo $__env->yieldContent('preload'); ?>

        <?php if(!config('constants.is_offline')): ?>
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></noscript>
        <?php endif; ?>

        <!-- Keep the main page layout local and immediately available. -->
        <link href="<?php echo e(asset('modules/cms/css/bootstrap-5.0.2.min.css?v=' . $asset_v), false); ?>" rel="stylesheet">

        <!-- CMS Modern CSS v3 -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-v3.css?v=' . $asset_v . '.' . filemtime(public_path('modules/cms/css/cms-v3.css'))), false); ?>">

        <!-- CMS Modern Refresh Layer (v4) -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-modern.css?v=' . $asset_v . '.' . filemtime(public_path('modules/cms/css/cms-modern.css'))), false); ?>">

        
        <?php
            $__cms_theme = \App\System::getProperty('default_theme_color');
            $__cms_theme_map = [
                'blue'         => ['primary' => '#3097D1', 'light' => '#64b5e0', 'dark' => '#2a7cb4', 'rgb' => '48, 151, 209',  'hero' => 'linear-gradient(135deg, #3097D1 0%, #64b5e0 100%)', 'mesh_hue' => 210],
                'black'        => ['primary' => '#343a40', 'light' => '#5a6268', 'dark' => '#23272b', 'rgb' => '52, 58, 64',    'hero' => 'linear-gradient(135deg, #343a40 0%, #5a6268 100%)', 'mesh_hue' => 210],
                'purple'       => ['primary' => '#6f42c1', 'light' => '#9b6fd0', 'dark' => '#5a32a3', 'rgb' => '111, 66, 193',  'hero' => 'linear-gradient(135deg, #6f42c1 0%, #9b6fd0 100%)', 'mesh_hue' => 275],
                'green'        => ['primary' => '#28a745', 'light' => '#5cb870', 'dark' => '#1e7e34', 'rgb' => '40, 167, 69',   'hero' => 'linear-gradient(135deg, #28a745 0%, #5cb870 100%)', 'mesh_hue' => 140],
                'red'          => ['primary' => '#dc3545', 'light' => '#e4606d', 'dark' => '#bd2130', 'rgb' => '220, 53, 69',   'hero' => 'linear-gradient(135deg, #dc3545 0%, #e4606d 100%)', 'mesh_hue' => 0],
                'yellow'       => ['primary' => '#d4a017', 'light' => '#e0b84a', 'dark' => '#b8860b', 'rgb' => '212, 160, 23',  'hero' => 'linear-gradient(135deg, #d4a017 0%, #e0b84a 100%)', 'mesh_hue' => 42],
                'blue-light'   => ['primary' => '#5bc0de', 'light' => '#82d0e7', 'dark' => '#31b0d5', 'rgb' => '91, 192, 222',  'hero' => 'linear-gradient(135deg, #5bc0de 0%, #82d0e7 100%)', 'mesh_hue' => 195],
                'black-light'  => ['primary' => '#6c757d', 'light' => '#8c949b', 'dark' => '#5a6268', 'rgb' => '108, 117, 125', 'hero' => 'linear-gradient(135deg, #6c757d 0%, #8c949b 100%)', 'mesh_hue' => 210],
                'purple-light' => ['primary' => '#9b59b6', 'light' => '#b37dc7', 'dark' => '#8344a5', 'rgb' => '155, 89, 182',  'hero' => 'linear-gradient(135deg, #9b59b6 0%, #b37dc7 100%)', 'mesh_hue' => 285],
                'green-light'  => ['primary' => '#5cb85c', 'light' => '#82ca82', 'dark' => '#449d44', 'rgb' => '92, 184, 92',   'hero' => 'linear-gradient(135deg, #5cb85c 0%, #82ca82 100%)', 'mesh_hue' => 120],
                'red-light'    => ['primary' => '#e74c3c', 'light' => '#ed7669', 'dark' => '#cf3625', 'rgb' => '231, 76, 60',   'hero' => 'linear-gradient(135deg, #e74c3c 0%, #ed7669 100%)', 'mesh_hue' => 6],
                'custom-1'     => ['primary' => '#0047A5', 'light' => '#3373bf', 'dark' => '#003781', 'rgb' => '0, 71, 165',    'hero' => 'linear-gradient(135deg, #0047A5 0%, #3373bf 100%)', 'mesh_hue' => 214],
                'custom-2'     => ['primary' => '#F57421', 'light' => '#f9a06a', 'dark' => '#0A2E3A', 'rgb' => '245, 116, 33',  'hero' => 'linear-gradient(135deg, #0A2E3A 0%, #0C799A 100%)', 'mesh_hue' => 195],
                'custom-3'     => ['primary' => '#556970', 'light' => '#7FA8A3', 'dark' => '#3B4C52', 'rgb' => '85, 105, 112',  'hero' => 'linear-gradient(135deg, #3B4C52 0%, #556970 100%)', 'mesh_hue' => 195],
            ];
            $__cms_tc = $__cms_theme_map[$__cms_theme] ?? null;
        ?>

        <?php if(!empty($__cms_tc)): ?>
            <style>
                :root {
                    --cms-primary: <?php echo e($__cms_tc['primary'], false); ?>;
                    --cms-primary-light: <?php echo e($__cms_tc['light'], false); ?>;
                    --cms-primary-dark: <?php echo e($__cms_tc['dark'], false); ?>;
                    --cms-primary-rgb: <?php echo e($__cms_tc['rgb'], false); ?>;
                    --cms-gradient-primary: linear-gradient(135deg, <?php echo e($__cms_tc['primary'], false); ?> 0%, <?php echo e($__cms_tc['light'], false); ?> 100%);
                    --cms-gradient-hero: <?php echo e($__cms_tc['hero'], false); ?>;
                    --cms-gradient-mesh:
                        radial-gradient(at 40% 20%, hsla(<?php echo e($__cms_tc['mesh_hue'], false); ?>, 80%, 94%, 1) 0px, transparent 50%),
                        radial-gradient(at 80% 0%, hsla(<?php echo e(($__cms_tc['mesh_hue'] + 25) % 360, false); ?>, 80%, 90%, 1) 0px, transparent 50%),
                        radial-gradient(at 0% 50%, hsla(<?php echo e(($__cms_tc['mesh_hue'] - 20 + 360) % 360, false); ?>, 80%, 92%, 1) 0px, transparent 50%),
                        radial-gradient(at 80% 50%, hsla(<?php echo e(($__cms_tc['mesh_hue'] + 100) % 360, false); ?>, 60%, 94%, 1) 0px, transparent 50%),
                        radial-gradient(at 0% 100%, hsla(<?php echo e(($__cms_tc['mesh_hue'] - 40 + 360) % 360, false); ?>, 80%, 92%, 1) 0px, transparent 50%);
                }
            </style>
        <?php endif; ?>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <!-- Custom CSS code -->
        <?php if(!empty($__site_details['custom_css'])): ?>
            <?php echo $__site_details['custom_css']; ?>

        <?php endif; ?>

        <!-- In-app chat widget CSS -->
        <?php if(
            isset($__site_details['chat']) && 
            isset($__site_details['chat']['enable']) && 
            $__site_details['chat']['enable'] == 'in_app_chat'
        ): ?>
            <?php if ($__env->exists('cms::components.chat_widget.css.chat-widget-style.chat_widget-style1')) echo $__env->make('cms::components.chat_widget.css.chat-widget-style.chat_widget-style1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if ($__env->exists('cms::components.chat_widget.css.chat-widget-colors.color-green')) echo $__env->make('cms::components.chat_widget.css.chat-widget-colors.color-green', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->yieldContent('css'); ?>

        <style type="text/css">
            .fas, .far, .fab {
                display: inline-block;
                width: 1.25em;
                text-align: center;
            }
            .far.fa-comments {
                padding-top: 3px !important;
                font-size: 25px !important;
            }
        </style>
    </head>
    <body>
        <main id="main-content">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php if(
            isset($__site_details['chat']) && 
            isset($__site_details['chat']['enable']) && 
            $__site_details['chat']['enable'] == 'in_app_chat'
        ): ?>
            <?php if ($__env->exists('cms::components.chat_widget.chat_widget')) echo $__env->make('cms::components.chat_widget.chat_widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if ($__env->exists('cms::frontend.layouts.footer')) echo $__env->make('cms::frontend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(!config('constants.is_offline')): ?>
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
        <?php if (! empty(trim($__env->yieldContent('jquery_validation')))): ?>
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <?php endif; ?>
        <?php else: ?>
        <?php if (! empty(trim($__env->yieldContent('jquery_validation')))): ?>
            <script src="<?php echo e(asset('js/vendor.js?v=' . $asset_v), false); ?>"></script>
        <?php endif; ?>
        <?php endif; ?>
        <script src="<?php echo e(asset('modules/cms/js/cms.js?v=' . $asset_v . '.' . filemtime(public_path('modules/cms/js/cms.js'))), false); ?>"></script>

        <!-- facebook pixel code -->
        <?php if(!empty($__site_details['fb_pixel'])): ?>
            <?php echo $__site_details['fb_pixel']; ?>

        <?php endif; ?>

        <!-- custom js -->
        <?php if(!empty($__site_details['custom_js'])): ?>
            <?php echo $__site_details['custom_js']; ?>

        <?php endif; ?>

        <!-- 3rd party chat_widget -->
        <?php if(
            (
                isset($__site_details['chat']) && 
                isset($__site_details['chat']['enable']) && 
                $__site_details['chat']['enable'] == 'other' &&
                !empty($__site_details['chat_widget'])
            ) ||
            (
                !isset($__site_details['chat']) &&
                empty($__site_details['chat']) &&
                !empty($__site_details['chat_widget'])
            )
        ): ?>
            <?php echo $__site_details['chat_widget']; ?>

        <?php endif; ?>
        <!-- in app chat js -->
        <?php if(
            isset($__site_details['chat']) && 
            isset($__site_details['chat']['enable']) && 
            $__site_details['chat']['enable'] == 'in_app_chat'
        ): ?>
            <?php if ($__env->exists('cms::components.chat_widget.js.chat_widget-style1')) echo $__env->make('cms::components.chat_widget.js.chat_widget-style1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->yieldContent('javascript'); ?>
    </body>
</html>

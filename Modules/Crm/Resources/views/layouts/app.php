<?php $request = app('Illuminate\Http\Request'); ?>

<?php
    $user_settings = auth()->check() ? json_decode(auth()->user()->user_settings, true) : [];
?>

<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr', false); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(Session::get('business.name'), false); ?></title>
        
        <?php echo $__env->make('layouts.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('css'); ?>
    </head>

    <body class="<?php if(!empty($user_settings['theme_color'])): ?> theme-<?php echo e($user_settings['theme_color'], false); ?> <?php endif; ?>">

        <!-- empty div for vuejs -->
        <div id="app"></div>
        
        <!--start wrapper-->
        <div class="wrapper">
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const wrapper = document.querySelector(".wrapper");
                const sidebar = document.querySelector(".sidebar-wrapper");
                const MOBILE_BREAKPOINT = 1024;

                function isMobileViewport() {
                    return window.innerWidth <= MOBILE_BREAKPOINT;
                }

                if (!isMobileViewport() && localStorage.getItem("upos_sidebar_collapse") === "true") {
                    wrapper.classList.add("toggled");
                }

                if (isMobileViewport()) {
                    if (localStorage.getItem("upos_sidebar_open") === "true") {
                        wrapper.classList.add("toggled");
                        var overlay = document.querySelector(".sidebar-overlay");
                        if (overlay) overlay.style.display = "block";
                        document.body.classList.add("sidebar-open");
                    } else {
                        wrapper.classList.remove("toggled");
                    }
                    wrapper.classList.remove("sidebar-hovered");
                }

                if(sidebar){
                    sidebar.addEventListener("mouseenter", () => {
                        if (!isMobileViewport()) {
                            wrapper.classList.add("sidebar-hovered");
                        }
                    });
                    sidebar.addEventListener("mouseleave", () => {
                        if (!isMobileViewport()) {
                            wrapper.classList.remove("sidebar-hovered");
                        }
                    });
                }
            });
            </script>
            <?php echo $__env->make('crm::layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('crm::layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="sidebar-overlay" style="display:none;"></div>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Add currency related field-->
                <input type="hidden" id="__code" value="<?php echo e(session('currency')['code'], false); ?>">
                <input type="hidden" id="__symbol" value="<?php echo e(session('currency')['symbol'], false); ?>">
                <input type="hidden" id="__thousand" value="<?php echo e(session('currency')['thousand_separator'], false); ?>">
                <input type="hidden" id="__decimal" value="<?php echo e(session('currency')['decimal_separator'], false); ?>">
                <input type="hidden" id="__symbol_placement" value="<?php echo e(session('business.currency_symbol_placement'), false); ?>">
                <input type="hidden" id="__precision" value="<?php echo e(session('business.currency_precision', 2), false); ?>">
                <input type="hidden" id="__quantity_precision" value="<?php echo e(session('business.quantity_precision', 2), false); ?>">
                <input type="hidden" id="__cost_decimal" value="<?php echo e(session('business.cost_decimal', 2), false); ?>">
                <!-- End of currency related field-->

                <?php if(session('status')): ?>
                    <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>

                <div class='scrolltop no-print'>
                    <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
                </div>

                <?php if(config('constants.iraqi_selling_price_adjustment')): ?>
                    <input type="hidden" id="iraqi_selling_price_adjustment">
                <?php endif; ?>

                <!-- This will be printed -->
                <section class="invoice print_section" id="receipt_section">
                </section>
                
            </div>
            <!-- /.content-wrapper -->

            <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <audio id="success-audio">
              <source src="<?php echo e(asset('/audio/success.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/success.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>
            <audio id="error-audio">
              <source src="<?php echo e(asset('/audio/error.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/error.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>
            <audio id="warning-audio">
              <source src="<?php echo e(asset('/audio/warning.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/warning.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>

        </div>

        <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
    </body>

</html>

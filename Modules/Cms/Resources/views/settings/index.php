
<?php $__env->startSection('title', __('cms::lang.cms')); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style type="text/css">
    .app-logo{
        max-width: 100%;
        width: 100px;
        object-fit: contain;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header cms-page-header">
    <h1>
        <span class="header-icon">
            <i class="fas fa-cog"></i>
        </span>
        <?php echo app('translator')->get('cms::lang.site_details'); ?>
    </h1>
</section>
<!-- Main content -->
<section class="content cms-content cms-form">
    <?php echo Form::open(['action' => '\Modules\Cms\Http\Controllers\SettingsController@store', 'id' => 'site_details_form', 'method' => 'post', 'files' => true, 'enctype' => "multipart/form-data"]); ?>

        <div class="row">
            <div class="col-md-12">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="container-fluid cms-settings-tabs">
                        <div class="row pos-tab-container">
                            <div class="col-lg-2 col-md-3 pos-tab-menu">
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        <i class="fas fa-mobile-alt"></i> <?php echo app('translator')->get('cms::lang.application'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-phone-alt"></i> <?php echo app('translator')->get('cms::lang.contact_us'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-share-alt"></i> <?php echo app('translator')->get('cms::lang.follow_us_on_social_media'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('cms::lang.statistics'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-question-circle"></i> <?php echo app('translator')->get('cms::lang.faq'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-comments"></i> <?php echo app('translator')->get('cms::lang.chat_widget'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-plug"></i> <?php echo app('translator')->get('cms::lang.integration'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-hand-pointer"></i> <?php echo app('translator')->get('cms::lang.buttons'); ?>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-download"></i> <?php echo app('translator')->get('cms::lang.download_buttons'); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-9 pos-tab">
                                <?php if ($__env->exists('cms::settings.partials.application')) echo $__env->make('cms::settings.partials.application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.contact_us')) echo $__env->make('cms::settings.partials.contact_us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.follow_us_on_social_media')) echo $__env->make('cms::settings.partials.follow_us_on_social_media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.statistics')) echo $__env->make('cms::settings.partials.statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.faqs')) echo $__env->make('cms::settings.partials.faqs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.chat_widget')) echo $__env->make('cms::settings.partials.chat_widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.integration')) echo $__env->make('cms::settings.partials.integration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.buttons')) echo $__env->make('cms::settings.partials.buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if ($__env->exists('cms::settings.partials.download_buttons')) echo $__env->make('cms::settings.partials.download_buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>            
        </div>
    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">

        function toggleChatDiv(option) {
            if(option == 'in_app_chat'){
                $('div.in_app_chat_div').removeClass('hide');
                $('div.third_party_chat_div').addClass('hide');
            } else {
                $('div.in_app_chat_div').addClass('hide');
                $('div.third_party_chat_div').removeClass('hide');
            }
        }
        
        $(document).on('change', '#chat_widget_option', function() {
            toggleChatDiv($(this).val());
        });

        toggleChatDiv($('#chat_widget_option').val());

        $(document).ready(function () {
            __page_leave_confirmation('#site_details_form');
            $("form#site_details_form").validate({
                submitHandler: function(form, e) {
                    if ($('form#site_details_form').valid()) {
                        window.onbeforeunload = null;
                        let post_submit_btn = Ladda.create(document.querySelector('.submit-btn'));
                        form.submit();
                        post_submit_btn.start();
                    }
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('role.settings')); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('assetmanagement::layouts.nav')) echo $__env->make('assetmanagement::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1 class="fs-4 fw-bold text-dark">
            <?php echo app('translator')->get('assetmanagement::lang.asset_settings'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content no-print">
        <?php echo Form::open([
            'action' => '\Modules\AssetManagement\Http\Controllers\AssetSettingsController@store',
            'id' => 'asset_settings_form',
            'method' => 'post',
        ]); ?>

        <div class="row">
            <div class="col-xs-12">
                <!--  <pos-tab-container> -->
                
                <?php $__env->startComponent('components.widget', ['class' => 'pos-tab-container']); ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu rounded">
                        <div class="list-group">
                            <a href="#" class="list-group-item text-center fw-bold active"><?php echo app('translator')->get('lang_v1.prefixes'); ?></a>
                            <a href="#" class="list-group-item text-center fw-bold"><?php echo app('translator')->get('lang_v1.notifications'); ?></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                        <?php echo $__env->make('assetmanagement::settings.prefix_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('assetmanagement::settings.notification_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-lg btn-danger">
                    <?php echo app('translator')->get('messages.update'); ?>
                </button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('textarea.ckeditor').each(function() {
                var editor_id = $(this).attr('id');
                tinymce.init({
                    selector: 'textarea#' + editor_id,
                });
            });
        });

        $(document).on('change', '#enable_asset_send_for_maintenance_email', function() {
            if ($(this).is(':checked')) {
                $('#asset_send_for_maintenance_email_div').removeClass('hide');
            } else {
                $('#asset_send_for_maintenance_email_div').addClass('hide');
            }
        });

        $(document).on('change', '#enable_asset_assigned_for_maintenance_email', function() {
            if ($(this).is(':checked')) {
                $('#asset_assigned_for_maintenance_email_div').removeClass('hide');
            } else {
                $('#asset_assigned_for_maintenance_email_div').addClass('hide');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
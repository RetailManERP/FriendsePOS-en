
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Superadmin Settings'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?><small><?php echo app('translator')->get('superadmin::lang.edit_super_admin_settings'); ?></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('layouts.partials.search_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <br>
    <?php echo Form::open(['action' => '\Modules\Superadmin\Http\Controllers\SuperadminSettingsController@update', 'method' => 'put', 'id' => 'superadmin_settings_form']); ?>

    <div class="row">
        <div class="col-12">
            <div class="row pos-tab-container">
                <div class="col-lg-2 col-md-3 col-sm-4 col-12 pos-tab-menu mb-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action text-center active"><?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.application_settings'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.maintenance_tools'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.email_smtp_settings'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.payment_gateways'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.backup'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.cron'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.pusher_settings'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action text-center"><?php echo app('translator')->get('superadmin::lang.additional_js_css'); ?></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-8 col-12 pos-tab">
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.super_admin_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.application_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.maintenance_tools', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.email_smtp_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.payment_gateways', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.backup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.cron', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.pusher_setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('superadmin::superadmin_settings.partials.additional_js_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).on('click', '#test_smtp_settings', function() {
        var button = $(this);
        if (button.prop('disabled')) return;
        var result = $('#smtp_test_result');
        var data = $('#superadmin_email_settings').find('[name^="MAIL_"]').serializeArray();
        data = data.filter(function(field) { return field.name !== 'MAIL_VERIFY_PEER'; });
        data.push({name: 'MAIL_VERIFY_PEER', value: $('#superadmin_email_settings [name="MAIL_VERIFY_PEER"]').is(':checked') ? 1 : 0});
        data.push({name: 'test_email', value: $('#smtp_test_recipient').val()});
        data.push({name: '_token', value: $('#superadmin_settings_form [name="_token"]').val()});
        var originalText = button.text();
        button.prop('disabled', true).text(<?php echo json_encode(__('superadmin::lang.test_email_sending'), 15, 512) ?>);
        result.prop('hidden', true).removeClass('alert-success alert-danger');
        $.ajax({url: button.data('url'), type: 'POST', data: data, dataType: 'json'})
            .done(function(response) {
                result.addClass(response.success ? 'alert-success' : 'alert-danger').text(response.msg).prop('hidden', false);
            })
            .fail(function(xhr) {
                var response = xhr.responseJSON || {};
                var message = response.msg || <?php echo json_encode(__('superadmin::lang.test_email_failed'), 15, 512) ?>;
                if (response.errors) {
                    message = Object.keys(response.errors).map(function(key) { return response.errors[key].join(' '); }).join(' ');
                } else if (xhr.status === 429) {
                    message = <?php echo json_encode(__('superadmin::lang.test_email_throttled'), 15, 512) ?>;
                }
                result.addClass('alert-danger').text(message).prop('hidden', false);
            })
            .always(function() { button.prop('disabled', false).text(originalText); });
    });

    $(document).on('change', '#BACKUP_DISK', function() {
        if($(this).val() == 'dropbox'){
            $('div#dropbox_access_token_div').removeClass('hide');
        } else {
            $('div#dropbox_access_token_div').addClass('hide');
        }
    });

    $(document).ready( function(){
        if ($('#welcome_email_body').length) {
            tinymce.init({
                selector: 'textarea#welcome_email_body',
            });
        }

        if ($('#superadmin_register_tc').length) {
            tinymce.init({
                selector: 'textarea#superadmin_register_tc'
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
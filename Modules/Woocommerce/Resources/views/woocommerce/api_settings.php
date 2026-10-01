
<?php $__env->startSection('title', __('woocommerce::lang.api_settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('woocommerce::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('woocommerce::lang.api_settings'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo Form::open(['action' => '\Modules\Woocommerce\Http\Controllers\WoocommerceController@updateSettings', 'method' => 'post']); ?>

    <div class="row">
        <div class="col-12">
           <!--  <pos-tab-container> -->
            <div class="row pos-tab-container">
                <div class="col-lg-2 col-md-3 col-sm-3 col-3 pos-tab-menu">
                    <div class="list-group">
                        <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('woocommerce::lang.instructions'); ?></a>
                        <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('woocommerce::lang.api_settings'); ?></a>
                        <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('woocommerce::lang.product_sync_settings'); ?></a>
                        <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('woocommerce::lang.order_sync_settings'); ?></a>
                        <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('woocommerce::lang.webhook_settings'); ?></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-9 pos-tab">
                    <?php echo $__env->make('woocommerce::woocommerce.partials.api_instructions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('woocommerce::woocommerce.partials.api_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('woocommerce::woocommerce.partials.product_sync_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('woocommerce::woocommerce.partials.order_sync_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('woocommerce::woocommerce.partials.webhook_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <div class="col-12">
                <p class="help-block"><i><?php echo __('woocommerce::lang.version_info', ['version' => $module_version]); ?></i></p>
            </div>
            <!--  </pos-tab-container> -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group float-end">
            <?php echo e(Form::submit('update', ['class'=>"btn btn-danger"]), false); ?>

            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function(){
        // Test Connection
        $('#test_connection').click(function(){
            var btn = $(this);
            var btn_html = btn.html();
            btn.html('<i class="fa fa-spinner fa-spin"></i> <?php echo e(__("woocommerce::lang.testing"), false); ?>...');
            btn.attr('disabled', true);
            $('#connection_result').html('');

            $.ajax({
                url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'testConnection']), false); ?>",
                dataType: "json",
                timeout: 30000,
                success: function(result){
                    if(result.success){
                        var info = '<span class="text-success"><i class="fa fa-check-circle"></i> ' + result.msg + '</span>';
                        if(result.wc_version) {
                            info += '<br><small class="text-muted">WooCommerce: v' + result.wc_version + ' | WordPress: v' + result.wp_version + '</small>';
                        }
                        if(result.store_name) {
                            info += '<br><small class="text-muted">Store: ' + result.store_name + ' (' + result.currency + ')</small>';
                        }
                        $('#connection_result').html(info);
                    } else {
                        $('#connection_result').html('<span class="text-danger"><i class="fa fa-times-circle"></i> ' + result.msg + '</span>');
                    }
                    btn.html(btn_html);
                    btn.removeAttr('disabled');
                },
                error: function(){
                    $('#connection_result').html('<span class="text-danger"><i class="fa fa-times-circle"></i> <?php echo e(__("woocommerce::lang.unable_to_connect"), false); ?></span>');
                    btn.html(btn_html);
                    btn.removeAttr('disabled');
                }
            });
        });

        $('.create_quantity').on('change', function(event){
            if ($(this).is(':checked')) {
                $('.create_stock_settings').each( function(){
                    $(this).addClass('hide');
                });
            } else {
                $('.create_stock_settings').each( function(){
                    $(this).removeClass('hide');
                });
            }
        });
        $('.update_quantity').on('change', function(event){
            if ($(this).is(':checked')) {
                $('.update_stock_settings').each( function(){
                    $(this).addClass('hide');
                });
            } else {
                $('.update_stock_settings').each( function(){
                    $(this).removeClass('hide');
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
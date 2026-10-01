<div class="pos-tab-content">
    <div class="row">
    	<div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('woocommerce_app_url',  __('woocommerce::lang.woocommerce_app_url') . ':'); ?>

            	<?php echo Form::text('woocommerce_app_url', $default_settings['woocommerce_app_url'], ['class' => 'form-control','placeholder' => __('woocommerce::lang.woocommerce_app_url')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('woocommerce_consumer_key',  __('woocommerce::lang.woocommerce_consumer_key') . ':'); ?>

                <?php echo Form::text('woocommerce_consumer_key', $default_settings['woocommerce_consumer_key'], ['class' => 'form-control','placeholder' => __('woocommerce::lang.woocommerce_consumer_key')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('woocommerce_consumer_secret', __('woocommerce::lang.woocommerce_consumer_secret') . ':'); ?>

                <input type="password" name="woocommerce_consumer_secret" value="<?php echo e($default_settings['woocommerce_consumer_secret'], false); ?>" id="woocommerce_consumer_secret" class="form-control">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('location_id',  __('business.business_locations') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.location_dropdown_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('location_id', $locations, $default_settings['location_id'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-check">
                <label>
                    <br/>
                    <?php echo Form::checkbox('enable_auto_sync', 1, !empty($default_settings['enable_auto_sync']), ['class' => 'form-check-input'] ); ?> <?php echo app('translator')->get('woocommerce::lang.enable_auto_sync'); ?>
                </label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.auto_sync_tooltip') . '"></i>';
                }
            ?>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-check">
                <label>
                    <br/>
                    <?php echo Form::checkbox('verify_ssl', 1, !empty($default_settings['verify_ssl'] ?? false), ['class' => 'form-check-input'] ); ?> <?php echo app('translator')->get('woocommerce::lang.verify_ssl'); ?>
                </label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.verify_ssl_help') . '"></i>';
                }
            ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <br>
            <button type="button" class="btn btn-info" id="test_connection"> <i class="fa fa-plug"></i> <?php echo app('translator')->get('woocommerce::lang.test_connection'); ?></button>
            <span id="connection_result" class="ml-2"></span>
        </div>
    </div>
</div>

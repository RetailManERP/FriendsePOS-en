<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="form-check-label">
<?php echo Form::checkbox('enable_offline_payment', 1,!empty($settings["enable_offline_payment"]), 
                [ 'class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('superadmin::lang.enable_offline_payment'); ?>
                </label>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo Form::label('offline_payment_details', __('superadmin::lang.offline_payment_details') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('superadmin::lang.offline_payment_details_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::textarea('offline_payment_details', !empty($settings["offline_payment_details"]) ? $settings["offline_payment_details"] : null, ['class' => 'form-control','placeholder' => __('superadmin::lang.offline_payment_details'), 'rows' => 3]); ?>

            </div>
        </div>
    </div>
    <div class="row">
    	<h4>Stripe:</h4>
    	<div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('STRIPE_PUB_KEY', __('superadmin::lang.stripe_pub_key') . ':'); ?>

            	<?php echo Form::text('STRIPE_PUB_KEY', $default_values['STRIPE_PUB_KEY'], ['class' => 'form-control','placeholder' => __('superadmin::lang.stripe_pub_key')]); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('STRIPE_SECRET_KEY', __('superadmin::lang.stripe_secret_key') . ':'); ?>

            	<?php echo Form::text('STRIPE_SECRET_KEY', $default_values['STRIPE_SECRET_KEY'], ['class' => 'form-control','placeholder' => __('superadmin::lang.stripe_secret_key')]); ?>

            </div>
        </div>

        <div class="clearfix"></div>
        
        <h4>Paypal:</h4>
        <div class="col-xs-6">
            <div class="form-group">
            	<?php echo Form::label('PAYPAL_MODE', __('superadmin::lang.paypal_mode') . ':'); ?>

            	<?php echo Form::select('PAYPAL_MODE',['live' => 'Live', 'sandbox' => 'Sandbox'],  $default_values['PAYPAL_MODE'], ['class' => 'form-control','placeholder' => __('messages.please_select')]); ?>

                <b><span class="text-danger"><?php echo app('translator')->get('superadmin::lang.important'); ?></span><?php echo app('translator')->get('superadmin::lang.paypal_info'); ?> </b>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('PAYPAL_CLIENT_ID', __('superadmin::lang.paypal_client_id') . ':'); ?>

            	<?php echo Form::text('PAYPAL_CLIENT_ID', $default_values['PAYPAL_CLIENT_ID'], ['class' => 'form-control','placeholder' =>'Paypal client id']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	<?php echo Form::label('PAYPAL_APP_SECRET', __('superadmin::lang.paypal_aap_secret') . ':'); ?>

            	<?php echo Form::text('PAYPAL_APP_SECRET', $default_values['PAYPAL_APP_SECRET'], ['class' => 'form-control','placeholder' =>'Paypal app secret']); ?>

            </div>
        </div>

        <div class="col-xs-4">
            <b><?php echo app('translator')->get('superadmin::lang.step_for_paypal'); ?> :</b><br/>
            1. <?php echo app('translator')->get('superadmin::lang.login_to'); ?> <a href="https://developer.paypal.com/home" target="_blank"><?php echo app('translator')->get('superadmin::lang.developer_account'); ?> </a>.<br/>
            <?php echo app('translator')->get('superadmin::lang.paypal_step_2'); ?><br/>
            <?php echo app('translator')->get('superadmin::lang.paypal_step_3'); ?><br/>
            <?php echo app('translator')->get('superadmin::lang.paypal_step_4'); ?><br/>
            <?php echo app('translator')->get('superadmin::lang.paypal_step_5'); ?><br/>
            <?php echo app('translator')->get('superadmin::lang.paypal_step_6'); ?><br/>
        </div>
        
        

        <div class="clearfix"></div>
        
        <h4>Razorpay: <small>(For INR India)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('RAZORPAY_KEY_ID', 'Key ID:'); ?>

                <?php echo Form::text('RAZORPAY_KEY_ID', $default_values['RAZORPAY_KEY_ID'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('RAZORPAY_KEY_SECRET', 'Key Secret:'); ?>

                <?php echo Form::text('RAZORPAY_KEY_SECRET', $default_values['RAZORPAY_KEY_SECRET'], ['class' => 'form-control']); ?>

            </div>
        </div>




        <div class="clearfix"></div>
        
        <h4>Pesapal: <small>(For KES currency)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('PESAPAL_CONSUMER_KEY', 'Consumer Key:'); ?>

                <?php echo Form::text('PESAPAL_CONSUMER_KEY', $default_values['PESAPAL_CONSUMER_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('PESAPAL_CONSUMER_SECRET', 'Consumer Secret:'); ?>

                <?php echo Form::text('PESAPAL_CONSUMER_SECRET', $default_values['PESAPAL_CONSUMER_SECRET'], ['class' => 'form-control']); ?>

            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('PESAPAL_LIVE', 'Is Live?'); ?>

                <?php echo Form::select('PESAPAL_LIVE',['false' => 'False', 'true' => 'True'],  $default_values['PESAPAL_LIVE'], ['class' => 'form-control']); ?>

            </div>
        </div>

        <div class="clearfix"></div>
        
        <h4>Paystack: <small>(For NGN Nigeria, GHS Ghana)</small></h4>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo Form::label('PAYSTACK_PUBLIC_KEY', 'Public key:'); ?>

                <?php echo Form::text('PAYSTACK_PUBLIC_KEY', $default_values['PAYSTACK_PUBLIC_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo Form::label('PAYSTACK_SECRET_KEY', 'Secret key:'); ?>

                <?php echo Form::text('PAYSTACK_SECRET_KEY', $default_values['PAYSTACK_SECRET_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>

        <div class="clearfix"></div>
        
        <h4>Flutterwave:</h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('FLUTTERWAVE_PUBLIC_KEY', 'Public key:'); ?>

                <?php echo Form::text('FLUTTERWAVE_PUBLIC_KEY', $default_values['FLUTTERWAVE_PUBLIC_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('FLUTTERWAVE_SECRET_KEY', 'Secret key:'); ?>

                <?php echo Form::text('FLUTTERWAVE_SECRET_KEY', $default_values['FLUTTERWAVE_SECRET_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('FLUTTERWAVE_ENCRYPTION_KEY', 'Encryption key:'); ?>

                <?php echo Form::text('FLUTTERWAVE_ENCRYPTION_KEY', $default_values['FLUTTERWAVE_ENCRYPTION_KEY'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-12 mt-0">
            <p class="help-block mt-0">
                <a href="https://support.flutterwave.com/en/articles/3632719-accepted-currencies" target="_blank">
                    <?php echo app('translator')->get('superadmin::lang.flutterwave_help_text'); ?>
                </a>
            </p>
        </div>

        <div class="clearfix"></div>

        <h4>JazzCash: <small>(For PKR Pakistan)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('JAZZCASH_MERCHANT_ID', 'Merchant ID:'); ?>

                <?php echo Form::text('JAZZCASH_MERCHANT_ID', $default_values['JAZZCASH_MERCHANT_ID'], ['class' => 'form-control', 'placeholder' => 'JazzCash Merchant ID']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('JAZZCASH_PASSWORD', 'Password:'); ?>

                <?php echo Form::text('JAZZCASH_PASSWORD', $default_values['JAZZCASH_PASSWORD'], ['class' => 'form-control', 'placeholder' => 'JazzCash Password']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('JAZZCASH_INTEGRITY_SALT', 'Integrity Salt:'); ?>

                <?php echo Form::text('JAZZCASH_INTEGRITY_SALT', $default_values['JAZZCASH_INTEGRITY_SALT'], ['class' => 'form-control', 'placeholder' => 'JazzCash Integrity Salt']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('JAZZCASH_SANDBOX', 'Mode:'); ?>

                <?php echo Form::select('JAZZCASH_SANDBOX', ['true' => 'Sandbox', 'false' => 'Live'], $default_values['JAZZCASH_SANDBOX'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <p class="help-block" style="margin-top: 25px;">
                <i class="fas fa-info-circle"></i> Get credentials from <a href="https://merchant.jazzcash.com.pk" target="_blank">JazzCash Merchant Portal</a>. 
                Callback URL: <code><?php echo e(url('/subscription/jazzcash-callback'), false); ?></code>
            </p>
        </div>

        <div class="clearfix"></div>

        <h4>Easypaisa: <small>(For PKR Pakistan)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('EASYPAISA_STORE_ID', 'Store ID:'); ?>

                <?php echo Form::text('EASYPAISA_STORE_ID', $default_values['EASYPAISA_STORE_ID'], ['class' => 'form-control', 'placeholder' => 'Easypaisa Store ID']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('EASYPAISA_HASH_KEY', 'Hash Key:'); ?>

                <?php echo Form::text('EASYPAISA_HASH_KEY', $default_values['EASYPAISA_HASH_KEY'], ['class' => 'form-control', 'placeholder' => 'Easypaisa Hash Key']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('EASYPAISA_SANDBOX', 'Mode:'); ?>

                <?php echo Form::select('EASYPAISA_SANDBOX', ['true' => 'Sandbox', 'false' => 'Live'], $default_values['EASYPAISA_SANDBOX'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-12">
            <p class="help-block">
                <i class="fas fa-info-circle"></i> Get credentials from <a href="https://easypay.easypaisa.com.pk" target="_blank">Easypaisa Merchant Portal</a>. 
                Callback URL: <code><?php echo e(url('/subscription/easypaisa-callback'), false); ?></code>
            </p>
        </div>

        <div class="clearfix"></div>

        <h4>Meezan Bank: <small>(For PKR Pakistan)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MEEZAN_MERCHANT_ID', 'Merchant ID:'); ?>

                <?php echo Form::text('MEEZAN_MERCHANT_ID', $default_values['MEEZAN_MERCHANT_ID'], ['class' => 'form-control', 'placeholder' => 'Meezan Merchant ID']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MEEZAN_SECRET_KEY', 'Secret Key:'); ?>

                <?php echo Form::text('MEEZAN_SECRET_KEY', $default_values['MEEZAN_SECRET_KEY'], ['class' => 'form-control', 'placeholder' => 'Meezan Secret Key']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MEEZAN_GATEWAY_URL', 'Gateway URL:'); ?>

                <?php echo Form::text('MEEZAN_GATEWAY_URL', $default_values['MEEZAN_GATEWAY_URL'], ['class' => 'form-control', 'placeholder' => 'https://...']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MEEZAN_SANDBOX', 'Mode:'); ?>

                <?php echo Form::select('MEEZAN_SANDBOX', ['true' => 'Sandbox', 'false' => 'Live'], $default_values['MEEZAN_SANDBOX'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <p class="help-block" style="margin-top: 25px;">
                <i class="fas fa-info-circle"></i> Contact Meezan Bank for merchant gateway credentials. 
                Callback URL: <code><?php echo e(url('/subscription/meezan-callback'), false); ?></code>
            </p>
        </div>

        <div class="clearfix"></div>

        <h4>PayPoint MultiPay: <small>(UK Card Payments)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MULTIPAY_SUBSCRIPTION_KEY', 'API Subscription Key:'); ?>

                <?php echo Form::text('MULTIPAY_SUBSCRIPTION_KEY', $default_values['MULTIPAY_SUBSCRIPTION_KEY'], ['class' => 'form-control', 'placeholder' => 'Ocp-Apim-Subscription-Key']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MULTIPAY_API_URL', 'API URL:'); ?>

                <?php echo Form::text('MULTIPAY_API_URL', $default_values['MULTIPAY_API_URL'], ['class' => 'form-control', 'placeholder' => 'https://sandbox.multipay.uk']); ?>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?php echo Form::label('MULTIPAY_ENVIRONMENT', 'Mode:'); ?>

                <?php echo Form::select('MULTIPAY_ENVIRONMENT', ['sandbox' => 'Sandbox', 'production' => 'Production'], $default_values['MULTIPAY_ENVIRONMENT'], ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo Form::label('MULTIPAY_HOSTED_FIELD_URL', 'Hosted Field URL:'); ?>

                <?php echo Form::text('MULTIPAY_HOSTED_FIELD_URL', $default_values['MULTIPAY_HOSTED_FIELD_URL'], ['class' => 'form-control', 'placeholder' => 'Hosted Field JS URL']); ?>

            </div>
        </div>
        <div class="col-xs-6">
            <p class="help-block" style="margin-top: 25px;">
                <i class="fas fa-info-circle"></i> Sign up at <a href="https://multipay-sandbox.developer.azure-api.net" target="_blank">PayPoint MultiPay Developer Portal</a>. 
                Callback URL: <code><?php echo e(url('/subscription/multipay-callback'), false); ?></code>
            </p>
        </div>

        <div class="col-xs-12">
            <br/>
            <p class="help-block"><i><?php echo app('translator')->get('superadmin::lang.payment_gateway_help'); ?></i></p>
        </div>
    </div>
</div>



<?php $__env->startSection('title', 'Add Shopify Connection'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $hasSuperadminSettings = class_exists(\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class)
        || is_dir(base_path('modules/Superadmin'));
    $superadminAppName = $hasSuperadminSettings ? trim((string) config('app.name', '')) : '';
    $superadminAppTitle = $hasSuperadminSettings ? trim((string) config('constants.app_title', '')) : '';
    $appName = $superadminAppName ?: trim((string) env('APP_NAME', 'Application')) ?: 'Application';
    $appTitle = $superadminAppTitle ?: trim((string) env('APP_TITLE', ''));
?>

<section class="content-header">
    <h1>Add Shopify Connection
        <small>Connect a new Shopify store</small>
    </h1>
</section>

<section class="content">
    <div class="alert alert-info">
        <h4><i class="fa fa-info-circle"></i> Simple idea</h4>
        <p>
            This page connects one Shopify store with <?php echo e($appName, false); ?>. After connection, <?php echo e($appName, false); ?> can read products,
            customers, and orders from Shopify, and it can send products or stock back to Shopify.
        </p>
        <?php if(!empty($appTitle)): ?>
            <p><strong><?php echo e($appTitle, false); ?></strong></p>
        <?php endif; ?>
        <p class="mb-0">
            Use the <strong>easy connection</strong> if your Shopify app is already configured. Use the
            <strong>manual token</strong> method if Shopify gave you an Admin API access token.
        </p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Easy Connection</h3>
                </div>

                <?php echo Form::open(['action' => '\\Modules\\Shopify\\Http\\Controllers\\ShopifyConnectionController@oauthStart', 'method' => 'post', 'id' => 'shopify_oauth_form']); ?>


                <div class="box-body">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error, false); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="shop_domain">Your Shopify Store Address: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="shop_domain" name="shop_domain"
                               placeholder="my-store.myshopify.com" value="<?php echo e(old('shop_domain'), false); ?>" required>
                        <p class="help-block">
                            Example: if your admin opens at <strong>abc-fashion.myshopify.com</strong>, enter
                            <strong>abc-fashion.myshopify.com</strong>. You can also enter only <strong>abc-fashion</strong>.
                        </p>
                    </div>

                    <div class="callout callout-info">
                        <h4>What happens next?</h4>
                        <p>
                            <?php echo e($appName, false); ?> will send you to Shopify. Shopify will ask you to approve access. After approval,
                            you come back here and the store is saved automatically.
                        </p>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i> Start Easy Connection
                    </button>
                    <a href="<?php echo e(action('\\Modules\\Shopify\\Http\\Controllers\\ShopifyDashboardController@index'), false); ?>" class="btn btn-default">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                </div>

                <?php echo Form::close(); ?>

            </div>

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Manual Token Connection</h3>
                </div>

                <?php echo Form::open(['action' => '\\Modules\\Shopify\\Http\\Controllers\\ShopifyConnectionController@store', 'method' => 'post', 'id' => 'shopify_connection_form']); ?>


                <div class="box-body">
                    <div class="callout callout-warning">
                        <h4>Use this only if you already have a token</h4>
                        <p>
                            A token is like a password for <?php echo e($appName, false); ?> to talk to Shopify. Keep it private.
                            If you are not sure, use the easy connection above.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="shop_name">Store Name: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="shop_name" name="shop_name"
                                   placeholder="my-store" value="<?php echo e(old('shop_name'), false); ?>" required>
                            <span class="input-group-addon">.myshopify.com</span>
                        </div>
                        <p class="help-block">Enter only the first part. Example: for abc-fashion.myshopify.com, enter abc-fashion.</p>
                    </div>

                    <div class="form-group">
                        <label for="access_token">Access Token: <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="access_token" name="access_token"
                               placeholder="shpat_..." value="<?php echo e(old('access_token'), false); ?>" required>
                        <p class="help-block">Paste the Admin API access token from Shopify. It usually starts with shpat_.</p>
                    </div>

                    <div class="form-group">
                        <label for="api_version">API Version: <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="api_version" name="api_version" required style="width: 100%;">
                            <option value="2026-01" <?php echo e(old('api_version', '2026-01') === '2026-01' ? 'selected' : '', false); ?>>2026-01 (Latest)</option>
                            <option value="2025-10" <?php echo e(old('api_version') === '2025-10' ? 'selected' : '', false); ?>>2025-10</option>
                            <option value="2025-07" <?php echo e(old('api_version') === '2025-07' ? 'selected' : '', false); ?>>2025-07</option>
                        </select>
                        <p class="help-block">Leave this as the latest version unless your Shopify app requires another one.</p>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-check"></i> Save Manual Connection
                    </button>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list"></i> Easy Steps</h3>
                </div>
                <div class="box-body">
                    <h4>Option A: Easy connection</h4>
                    <ol>
                        <li>Type your Shopify store address in the Easy Connection box.</li>
                        <li>Click <strong>Start Easy Connection</strong>.</li>
                        <li>Shopify opens and asks for permission.</li>
                        <li>Click approve or install in Shopify.</li>
                        <li>You return to <?php echo e($appName, false); ?> and the connection is ready.</li>
                    </ol>

                    <hr>

                    <h4>Option B: Manual token</h4>
                    <ol>
                        <li>Open Shopify Admin.</li>
                        <li>Go to <strong>Settings &gt; Apps and sales channels &gt; Develop apps</strong>.</li>
                        <li>Create or open a custom app.</li>
                        <li>Give Admin API permissions for products, orders, customers, inventory, locations, and fulfillments.</li>
                        <li>Install the app and copy the Admin API access token.</li>
                        <li>Paste the token in the Manual Token Connection box.</li>
                        <li>Click <strong>Test Connection</strong>, then save if it succeeds.</li>
                    </ol>
                </div>
            </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-check-circle"></i> What Works After Connection</h3>
                </div>
                <div class="box-body">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check text-success"></i> Import Shopify products into <?php echo e($appName, false); ?></li>
                        <li><i class="fa fa-check text-success"></i> Import Shopify orders into <?php echo e($appName, false); ?></li>
                        <li><i class="fa fa-check text-success"></i> Import Shopify customers into <?php echo e($appName, false); ?></li>
                        <li><i class="fa fa-check text-success"></i> Push POS products and stock to Shopify when mappings are ready</li>
                    </ul>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-link"></i> Useful URLs</h3>
                </div>
                <div class="box-body">
                    <p><strong>App URL</strong></p>
                    <input type="text" class="form-control" readonly value="<?php echo e(url('shopify'), false); ?>">
                    <br>
                    <p><strong>OAuth Redirect URL</strong></p>
                    <input type="text" class="form-control" readonly value="<?php echo e(route('connections.oauth.callback'), false); ?>">
                    <br>
                    <p><strong>Webhook Base URL</strong></p>
                    <input type="text" class="form-control" readonly value="<?php echo e(url('api/shopify/webhooks'), false); ?>">
                    <p class="help-block">
                        If Shopify asks for these URLs while creating a custom app, copy them from here.
                        Webhooks need a public HTTPS URL to work outside your local computer.
                    </p>
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-plug"></i> Test Manual Token</h3>
                </div>
                <div class="box-body">
                    <p>Use this for the manual token method before saving the connection.</p>
                    <button type="button" class="btn btn-warning" id="test_connection_btn">
                        <i class="fa fa-plug"></i> Test Connection
                    </button>
                    <div id="test_result" class="mt-3" style="margin-top: 15px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    $('#test_connection_btn').click(function() {
        var btn = $(this);
        var shopName = $('#shop_name').val();
        var accessToken = $('#access_token').val();
        var apiVersion = $('#api_version').val();

        if (!shopName || !accessToken) {
            $('#test_result').html('<div class="alert alert-warning"><i class="fa fa-warning"></i> Please fill in Store Name and Access Token</div>');
            return;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Testing...');
        $('#test_result').html('');

        $.ajax({
            url: '<?php echo e(action("\Modules\Shopify\Http\Controllers\ShopifyConnectionController@test"), false); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                shop_name: shopName,
                access_token: accessToken,
                api_version: apiVersion
            },
            success: function(response) {
                if (response.success) {
                    $('#test_result').html(
                        '<div class="alert alert-success">' +
                        '<i class="fa fa-check"></i> Connection successful!<br>' +
                        '<strong>Store:</strong> ' + (response.shop ? response.shop.name : shopName) +
                        '</div>'
                    );
                } else {
                    $('#test_result').html(
                        '<div class="alert alert-danger">' +
                        '<i class="fa fa-times"></i> Connection failed: ' + response.message +
                        '</div>'
                    );
                }
            },
            error: function(xhr) {
                var message = 'Connection test failed';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                $('#test_result').html(
                    '<div class="alert alert-danger">' +
                    '<i class="fa fa-times"></i> ' + message +
                    '</div>'
                );
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-plug"></i> Test Connection');
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
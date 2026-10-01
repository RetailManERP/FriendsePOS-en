
<?php $__env->startSection('title', __('woocommerce::lang.woocommerce')); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/woocommerce-dashboard.css?v=' . $asset_v), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('woocommerce::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $is_superadmin = auth()->user()->can('superadmin');
    $products_pct = ($stats['total_products'] > 0) ? round(($stats['synced_products'] / $stats['total_products']) * 100) : 0;
    $categories_pct = ($stats['total_categories'] > 0) ? round(($stats['synced_categories'] / $stats['total_categories']) * 100) : 0;
?>

<section class="content content-custom">

    
    <?php if(!empty($alerts['connection_failed'])): ?>
    <div class="woo-connection-error woo-animate">
        <i class="fas fa-exclamation-triangle"></i>
        <div class="conn-error-text">
            <h6><?php echo app('translator')->get('woocommerce::lang.connection_failed'); ?></h6>
            <p><?php echo e($alerts['connection_failed'], false); ?></p>
        </div>
        <?php if($is_superadmin || auth()->user()->can('woocommerce.access_woocommerce_api_settings')): ?>
        <a href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'apiSettings']), false); ?>" class="btn">
            <i class="fas fa-cog"></i> <?php echo app('translator')->get('woocommerce::lang.api_settings'); ?>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    
    <div class="woo-dashboard-header woo-animate">
        <div class="row align-items-center">
            <div class="col-md-7 col-12">
                <div class="woo-header-left">
                    <h2><i class="fab fa-wordpress"></i> <?php echo app('translator')->get('woocommerce::lang.woocommerce_dashboard'); ?></h2>
                    <p class="woo-header-subtitle"><?php echo app('translator')->get('woocommerce::lang.dashboard_subtitle'); ?></p>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="woo-header-right">
                    <span class="woo-header-badge">
                        <i class="fas fa-code-branch"></i> v<?php echo e($stats['module_version'] ?? '5.0', false); ?>

                    </span>
                    <div class="woo-header-actions">
                        <?php if($is_superadmin || auth()->user()->can('woocommerce.access_woocommerce_api_settings')): ?>
                        <a href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'apiSettings']), false); ?>" class="btn btn-sm">
                            <i class="fas fa-cog"></i> <?php echo app('translator')->get('woocommerce::lang.api_settings'); ?>
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'viewSyncLog']), false); ?>" class="btn btn-sm">
                            <i class="fas fa-history"></i> <?php echo app('translator')->get('woocommerce::lang.sync_log'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row woo-stats-row">
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="woo-stat-card woo-animate woo-animate-delay-1">
                <div class="stat-icon si-products"><i class="fas fa-box"></i></div>
                <div class="stat-info">
                    <h3><?php echo e($stats['synced_products'], false); ?><small style="font-size:13px; color:#8898aa;"> / <?php echo e($stats['total_products'], false); ?></small></h3>
                    <p><?php echo app('translator')->get('woocommerce::lang.products_synced_label'); ?></p>
                </div>
                <?php if($stats['not_synced_product_count'] > 0): ?>
                <span class="stat-badge badge-pending"><?php echo e($stats['not_synced_product_count'], false); ?> <?php echo app('translator')->get('woocommerce::lang.pending_lc'); ?></span>
                <?php else: ?>
                <span class="stat-badge badge-synced"><i class="fas fa-check"></i> <?php echo app('translator')->get('woocommerce::lang.all_synced'); ?></span>
                <?php endif; ?>
                <div class="stat-progress">
                    <div class="stat-progress-bar sp-purple" style="width: <?php echo e($products_pct, false); ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="woo-stat-card woo-animate woo-animate-delay-2">
                <div class="stat-icon si-categories"><i class="fas fa-tags"></i></div>
                <div class="stat-info">
                    <h3><?php echo e($stats['synced_categories'], false); ?><small style="font-size:13px; color:#8898aa;"> / <?php echo e($stats['total_categories'], false); ?></small></h3>
                    <p><?php echo app('translator')->get('woocommerce::lang.categories_synced_label'); ?></p>
                </div>
                <?php if($stats['not_synced_cat_count'] > 0): ?>
                <span class="stat-badge badge-pending"><?php echo e($stats['not_synced_cat_count'], false); ?> <?php echo app('translator')->get('woocommerce::lang.pending_lc'); ?></span>
                <?php else: ?>
                <span class="stat-badge badge-synced"><i class="fas fa-check"></i> <?php echo app('translator')->get('woocommerce::lang.all_synced'); ?></span>
                <?php endif; ?>
                <div class="stat-progress">
                    <div class="stat-progress-bar sp-green" style="width: <?php echo e($categories_pct, false); ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="woo-stat-card woo-animate woo-animate-delay-3">
                <div class="stat-icon si-orders"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-info">
                    <h3><?php echo e($stats['woo_orders_count'], false); ?></h3>
                    <p><?php echo app('translator')->get('woocommerce::lang.woo_orders_label'); ?></p>
                </div>
                <div class="stat-progress">
                    <div class="stat-progress-bar sp-pink" style="width: <?php echo e($stats['woo_orders_count'] > 0 ? 100 : 0, false); ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="woo-stat-card woo-animate woo-animate-delay-4">
                <div class="stat-icon si-customers"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <h3><?php echo e($stats['woo_customers_count'], false); ?></h3>
                    <p><?php echo app('translator')->get('woocommerce::lang.woo_customers_label'); ?></p>
                </div>
                <div class="stat-progress">
                    <div class="stat-progress-bar sp-blue" style="width: <?php echo e($stats['woo_customers_count'] > 0 ? 100 : 0, false); ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8">

            
            <?php if(!empty($alerts['not_synced_cat']) || !empty($alerts['updated_cat']) || !empty($alerts['not_synced_product']) || !empty($alerts['not_updated_product'])): ?>
            <div class="mb-3 woo-animate woo-animate-delay-3">
                <?php if(!empty($alerts['not_synced_cat'])): ?>
                <div class="woo-alert woo-alert-warning"><i class="fas fa-info-circle"></i> <span><?php echo e($alerts['not_synced_cat'], false); ?></span></div>
                <?php endif; ?>
                <?php if(!empty($alerts['updated_cat'])): ?>
                <div class="woo-alert woo-alert-warning"><i class="fas fa-sync-alt"></i> <span><?php echo e($alerts['updated_cat'], false); ?></span></div>
                <?php endif; ?>
                <?php if(!empty($alerts['not_synced_product'])): ?>
                <div class="woo-alert woo-alert-warning"><i class="fas fa-info-circle"></i> <span><?php echo e($alerts['not_synced_product'], false); ?></span></div>
                <?php endif; ?>
                <?php if(!empty($alerts['not_updated_product'])): ?>
                <div class="woo-alert woo-alert-warning"><i class="fas fa-sync-alt"></i> <span><?php echo e($alerts['not_updated_product'], false); ?></span></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            
            <?php if($is_superadmin || auth()->user()->can('woocommerce.syc_categories')): ?>
            <div class="woo-sync-card woo-animate woo-animate-delay-4">
                <div class="sync-card-header">
                    <div class="sync-icon sci-categories"><i class="fas fa-layer-group"></i></div>
                    <h5><?php echo app('translator')->get('woocommerce::lang.sync_product_categories'); ?> & <?php echo app('translator')->get('woocommerce::lang.tags'); ?></h5>
                    <span class="sync-last-time last_sync_cat"></span>
                </div>
                <div class="sync-card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <button type="button" class="btn woo-sync-btn wsb-success" id="sync_product_categories">
                                <i class="fas fa-sync-alt"></i> <?php echo app('translator')->get('woocommerce::lang.sync_categories_btn'); ?>
                            </button>
                            <div class="woo-sync-time last_sync_cat_time"></div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn woo-sync-btn wsb-info" id="sync_tags">
                                <i class="fas fa-tag"></i> <?php echo app('translator')->get('woocommerce::lang.sync_tags'); ?>
                            </button>
                            <div class="woo-sync-time last_sync_tags_time"></div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <button type="button" class="btn woo-sync-btn wsb-danger-outline" id="reset_categories">
                                <i class="fas fa-undo"></i> <?php echo app('translator')->get('woocommerce::lang.reset'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($is_superadmin || auth()->user()->can('woocommerce.sync_products')): ?>
            <div class="woo-sync-card woo-animate woo-animate-delay-5">
                <div class="sync-card-header">
                    <div class="sync-icon sci-products"><i class="fas fa-cubes"></i></div>
                    <h5><?php echo app('translator')->get('woocommerce::lang.sync_products'); ?></h5>
                    <span class="sync-last-time last_sync_all_products_header"></span>
                </div>
                <div class="sync-card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <button type="button" class="btn woo-sync-btn wsb-warning sync_products" data-sync-type="new">
                                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('woocommerce::lang.sync_only_new'); ?>
                            </button>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.sync_new_help') . '"></i>';
                }
            ?>
                            <div class="woo-sync-time last_sync_new_products_time"></div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn woo-sync-btn wsb-primary sync_products" data-sync-type="all">
                                <i class="fas fa-sync-alt"></i> <?php echo app('translator')->get('woocommerce::lang.sync_all'); ?>
                            </button>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('woocommerce::lang.sync_all_help') . '"></i>';
                }
            ?>
                            <div class="woo-sync-time last_sync_all_products_time"></div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <button type="button" class="btn woo-sync-btn wsb-danger-outline" id="reset_products">
                                <i class="fas fa-undo"></i> <?php echo app('translator')->get('woocommerce::lang.reset'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($is_superadmin || auth()->user()->can('woocommerce.sync_orders')): ?>
            <div class="woo-sync-card woo-animate woo-animate-delay-6">
                <div class="sync-card-header">
                    <div class="sync-icon sci-orders"><i class="fas fa-shopping-bag"></i></div>
                    <h5><?php echo app('translator')->get('woocommerce::lang.sync_orders'); ?> & <?php echo app('translator')->get('woocommerce::lang.customers'); ?></h5>
                    <span class="sync-last-time last_sync_orders_header"></span>
                </div>
                <div class="sync-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <button type="button" class="btn woo-sync-btn wsb-pink" id="sync_orders">
                                <i class="fas fa-download"></i> <?php echo app('translator')->get('woocommerce::lang.sync_orders'); ?>
                            </button>
                            <div class="woo-sync-time last_sync_orders_time"></div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn woo-sync-btn wsb-info" id="sync_customers">
                                <i class="fas fa-user-friends"></i> <?php echo app('translator')->get('woocommerce::lang.sync_customers'); ?>
                            </button>
                            <div class="woo-sync-time last_sync_customers_time"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($is_superadmin || auth()->user()->can('woocommerce.map_tax_rates')): ?>
            <div class="woo-sync-card woo-animate woo-animate-delay-6">
                <div class="sync-card-header">
                    <div class="sync-icon sci-tax"><i class="fas fa-percent"></i></div>
                    <h5><?php echo app('translator')->get('woocommerce::lang.map_tax_rates'); ?></h5>
                </div>
                <div class="sync-card-body">
                    <?php echo Form::open(['action' => '\Modules\Woocommerce\Http\Controllers\WoocommerceController@mapTaxRates', 'method' => 'post']); ?>

                    <div class="table-responsive">
                        <table class="table woo-tax-table mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('woocommerce::lang.pos_tax_rate'); ?></th>
                                    <th><?php echo app('translator')->get('woocommerce::lang.equivalent_woocommerce_tax_rate'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($tax_rates)): ?>
                                    <?php $__currentLoopData = $tax_rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="fw-semibold"><?php echo e($tax_rate->name, false); ?></td>
                                        <td><?php echo Form::select('taxes[' . $tax_rate->id . ']', $woocommerce_tax_rates, $tax_rate->woocommerce_tax_rate_id, ['class' => 'form-control form-control-sm select2', 'style' => 'max-width:300px']); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn woo-sync-btn wsb-primary" style="width:auto; padding:8px 24px;">
                            <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                        </button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-4">
            <div class="woo-activity-card woo-animate woo-animate-delay-5">
                <div class="activity-header">
                    <h5><i class="fas fa-history"></i> <?php echo app('translator')->get('woocommerce::lang.recent_activity'); ?></h5>
                    <a href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'viewSyncLog']), false); ?>" class="text-decoration-none" style="font-size:12px; font-weight:600;">
                        <?php echo app('translator')->get('woocommerce::lang.view_all'); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <?php if($stats['recent_logs']->count() > 0): ?>
                <ul class="woo-activity-list">
                    <?php $__currentLoopData = $stats['recent_logs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $dot_class = 'ad-purple';
                        if($log->sync_type == 'categories' || $log->sync_type == 'tags') $dot_class = 'ad-green';
                        elseif($log->sync_type == 'orders' || $log->sync_type == 'customers') $dot_class = 'ad-pink';
                        elseif(str_contains($log->sync_type, 'products')) $dot_class = 'ad-purple';

                        $type_labels = [
                            'categories' => __('category.categories'),
                            'brands' => __('brand.brands'),
                            'all_products' => __('sale.products'),
                            'new_products' => __('sale.products'),
                            'orders' => __('woocommerce::lang.orders'),
                            'tags' => __('woocommerce::lang.tags'),
                            'customers' => __('woocommerce::lang.customers'),
                            'products_incoming' => __('woocommerce::lang.products_incoming'),
                        ];
                        $op_labels = [
                            'created' => __('woocommerce::lang.created'),
                            'updated' => __('woocommerce::lang.updated'),
                            'reset' => __('woocommerce::lang.reset'),
                        ];
                        $type_label = $type_labels[$log->sync_type] ?? $log->sync_type;
                        $op_label = $op_labels[$log->operation_type] ?? $log->operation_type;
                        $data_count = !empty($log->data) ? count(json_decode($log->data, true) ?? []) : 0;
                    ?>
                    <li>
                        <span class="activity-dot <?php echo e($dot_class, false); ?>"></span>
                        <div class="activity-text">
                            <strong><?php echo e($type_label, false); ?></strong> <?php echo e($op_label, false); ?>

                            <?php if($data_count > 0): ?>
                            <span style="color:#8898aa;"> &middot; <?php echo e($data_count, false); ?> <?php echo app('translator')->get('woocommerce::lang.records'); ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="activity-time"><?php echo e(\Carbon::parse($log->created_at)->diffForHumans(), false); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php else: ?>
                <div class="woo-activity-empty">
                    <i class="fas fa-inbox"></i>
                    <p><?php echo app('translator')->get('woocommerce::lang.no_recent_activity'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var syncing_text = '<i class="fas fa-sync-alt fa-spin"></i> ' + "<?php echo e(__('woocommerce::lang.syncing'), false); ?>...";
    var loader = __fa_awesome();
    update_sync_date();

    // ---- Sync Product Categories ----
    $('#sync_product_categories').click(function() {
        $(window).bind('beforeunload', function() { return true; });
        var btn = $(this), btn_html = btn.html();
        btn.html(syncing_text).attr('disabled', true);
        $.ajax({
            url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'syncCategories']), false); ?>",
            dataType: "json",
            timeout: 0,
            success: function(result) {
                result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                btn.html(btn_html).removeAttr('disabled');
                update_sync_date();
                $(window).unbind('beforeunload');
            },
            error: function() {
                toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                btn.html(btn_html).removeAttr('disabled');
                $(window).unbind('beforeunload');
            }
        });
    });

    // ---- Sync Products ----
    $('.sync_products').click(function() {
        $(window).bind('beforeunload', function() { return true; });
        var btn = $(this), btn_html = btn.html();
        btn.html(syncing_text).attr('disabled', true);
        sync_products(btn, btn_html);
    });

    // ---- Sync Orders ----
    $('#sync_orders').click(function() {
        $(window).bind('beforeunload', function() { return true; });
        var btn = $(this), btn_html = btn.html();
        btn.html(syncing_text).attr('disabled', true);
        $.ajax({
            url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'syncOrders']), false); ?>",
            dataType: "json",
            timeout: 0,
            success: function(result) {
                result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                btn.html(btn_html).removeAttr('disabled');
                update_sync_date();
                $(window).unbind('beforeunload');
            },
            error: function() {
                toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                btn.html(btn_html).removeAttr('disabled');
                $(window).unbind('beforeunload');
            }
        });
    });

    // ---- Sync Tags ----
    $('#sync_tags').click(function() {
        $(window).bind('beforeunload', function() { return true; });
        var btn = $(this), btn_html = btn.html();
        btn.html(syncing_text).attr('disabled', true);
        $.ajax({
            url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'syncTags']), false); ?>",
            dataType: "json",
            timeout: 0,
            success: function(result) {
                result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                btn.html(btn_html).removeAttr('disabled');
                update_sync_date();
                $(window).unbind('beforeunload');
            },
            error: function() {
                toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                btn.html(btn_html).removeAttr('disabled');
                $(window).unbind('beforeunload');
            }
        });
    });

    // ---- Sync Customers ----
    $('#sync_customers').click(function() {
        $(window).bind('beforeunload', function() { return true; });
        var btn = $(this), btn_html = btn.html();
        btn.html(syncing_text).attr('disabled', true);
        $.ajax({
            url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'syncCustomers']), false); ?>",
            dataType: "json",
            timeout: 0,
            success: function(result) {
                result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                btn.html(btn_html).removeAttr('disabled');
                update_sync_date();
                $(window).unbind('beforeunload');
            },
            error: function() {
                toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                btn.html(btn_html).removeAttr('disabled');
                $(window).unbind('beforeunload');
            }
        });
    });
});

// ---- Update Sync Dates ----
function update_sync_date() {
    $.ajax({
        url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'getSyncLog']), false); ?>",
        dataType: "json",
        timeout: 0,
        success: function(data) {
            var lbl = "<?php echo e(__('woocommerce::lang.last_synced'), false); ?>";
            if(data.categories) {
                $('span.last_sync_cat').html('<i class="fas fa-clock"></i> ' + data.categories);
                $('div.last_sync_cat_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.categories);
            }
            if(data.new_products) {
                $('div.last_sync_new_products_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.new_products);
            }
            if(data.all_products) {
                $('span.last_sync_all_products_header').html('<i class="fas fa-clock"></i> ' + data.all_products);
                $('div.last_sync_all_products_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.all_products);
            }
            if(data.orders) {
                $('span.last_sync_orders_header').html('<i class="fas fa-clock"></i> ' + data.orders);
                $('div.last_sync_orders_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.orders);
            }
            if(data.tags) {
                $('div.last_sync_tags_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.tags);
            }
            if(data.customers) {
                $('div.last_sync_customers_time').html('<i class="fas fa-clock"></i> ' + lbl + ': ' + data.customers);
            }
        }
    });
}

// ---- Reset Synced Categories ----
$(document).on('click', 'button#reset_categories', function() {
    var checkbox = document.createElement("div");
    checkbox.setAttribute('class', 'checkbox');
    checkbox.innerHTML = '<label><input type="checkbox" id="yes_reset_cat"> <?php echo e(__("woocommerce::lang.yes_reset"), false); ?></label>';
    swal({
        title: LANG.sure,
        text: "<?php echo e(__('woocommerce::lang.confirm_reset_cat'), false); ?>",
        icon: "warning",
        content: checkbox,
        buttons: true,
        dangerMode: true,
    }).then(function(confirm) {
        if(confirm && $('#yes_reset_cat').is(":checked")) {
            $(window).bind('beforeunload', function() { return true; });
            $.ajax({
                url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'resetCategories']), false); ?>",
                dataType: "json",
                success: function(result) {
                    result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                    $(window).unbind('beforeunload');
                    location.reload();
                }
            });
        }
    });
});

// ---- Reset Synced Products ----
$(document).on('click', 'button#reset_products', function() {
    var checkbox = document.createElement("div");
    checkbox.setAttribute('class', 'checkbox');
    checkbox.innerHTML = '<label><input type="checkbox" id="yes_reset_product"> <?php echo e(__("woocommerce::lang.yes_reset"), false); ?></label>';
    swal({
        title: LANG.sure,
        text: "<?php echo e(__('woocommerce::lang.confirm_reset_product'), false); ?>",
        icon: "warning",
        content: checkbox,
        buttons: true,
        dangerMode: true,
    }).then(function(confirm) {
        if(confirm && $('#yes_reset_product').is(":checked")) {
            $(window).bind('beforeunload', function() { return true; });
            $.ajax({
                url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'resetProducts']), false); ?>",
                dataType: "json",
                success: function(result) {
                    result.success ? toastr.success(result.msg) : toastr.error(result.msg);
                    $(window).unbind('beforeunload');
                    location.reload();
                }
            });
        }
    });
});

// ---- Paginated Product Sync ----
function sync_products(btn, btn_html, offset) {
    offset = offset || 0;
    var type = btn.data('sync-type');
    $.ajax({
        url: "<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'syncProducts']), false); ?>?type=" + type + "&offset=" + offset + '&ignore_updated_check=true',
        dataType: "json",
        timeout: 0,
        success: function(result) {
            if(result.success) {
                toastr.success(result.msg);
                if(result.total_products > 0) {
                    sync_products(btn, btn_html, offset + 1);
                } else {
                    update_sync_date();
                    btn.html(btn_html).removeAttr('disabled');
                    $(window).unbind('beforeunload');
                }
            } else {
                toastr.error(result.msg);
                btn.html(btn_html).removeAttr('disabled');
                $(window).unbind('beforeunload');
            }
        },
        error: function() {
            toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
            btn.html(btn_html).removeAttr('disabled');
            $(window).unbind('beforeunload');
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
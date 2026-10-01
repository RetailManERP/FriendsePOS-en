
<?php $__env->startSection('title', __('productcatalogue::lang.catalogue_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="fs-4 fw-bold text-dark">
        <i class="fas fa-th-large"></i> <?php echo app('translator')->get('productcatalogue::lang.catalogue_dashboard'); ?>
    </h1>
</section>

<section class="content">

    
    <div class="row g-3 mb-3">
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:50px;height:50px;background:rgba(102,126,234,0.15)">
                        <i class="fas fa-boxes fa-lg" style="color:#667eea"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0"><?php echo e(number_format($total_products), false); ?></h3>
                        <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.total_products'); ?></small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:50px;height:50px;background:rgba(40,167,69,0.15)">
                        <i class="fas fa-tags fa-lg" style="color:#28a745"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0"><?php echo e(number_format($active_categories), false); ?></h3>
                        <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.active_categories'); ?></small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:50px;height:50px;background:rgba(23,162,184,0.15)">
                        <i class="fas fa-map-marker-alt fa-lg" style="color:#17a2b8"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0"><?php echo e(number_format($catalogue_locations), false); ?></h3>
                        <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.catalogue_locations'); ?></small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:50px;height:50px;background:rgba(255,193,7,0.15)">
                        <i class="fas fa-qrcode fa-lg" style="color:#ffc107"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0"><?php echo e(number_format($total_qr_orders), false); ?></h3>
                        <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.total_qr_orders'); ?></small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row g-3 mb-3">
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-aqua']); ?>
                <div class="text-center text-white">
                    <h3 class="fw-bold mb-0"><?php echo e(number_format($today_page_views), false); ?></h3>
                    <small><i class="fas fa-eye me-1"></i><?php echo app('translator')->get('productcatalogue::lang.todays_page_views'); ?></small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-green']); ?>
                <div class="text-center text-white">
                    <h3 class="fw-bold mb-0"><?php echo e(number_format($week_visitors), false); ?></h3>
                    <small><i class="fas fa-users me-1"></i><?php echo app('translator')->get('productcatalogue::lang.week_visitors'); ?></small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-purple']); ?>
                <div class="text-center text-white">
                    <h3 class="fw-bold mb-0"><?php echo e(number_format($month_orders), false); ?></h3>
                    <small><i class="fas fa-shopping-bag me-1"></i><?php echo app('translator')->get('productcatalogue::lang.month_orders'); ?></small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-navy']); ?>
                <div class="text-center text-white">
                    <h3 class="fw-bold mb-0"><span class="display_currency" data-currency_symbol="true"><?php echo e($qr_revenue_month, false); ?></span></h3>
                    <small><i class="fas fa-money-bill-wave me-1"></i><?php echo app('translator')->get('productcatalogue::lang.qr_revenue_month'); ?></small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row g-3 mb-3">
        <div class="col-lg-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.conversion_funnel')]); ?>
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 rounded" style="background:rgba(102,126,234,0.1)">
                            <i class="fas fa-eye fa-2x mb-2" style="color:#667eea"></i>
                            <h4 class="fw-bold mb-0"><?php echo e(number_format($funnel_page_views), false); ?></h4>
                            <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.funnel_page_views'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 rounded" style="background:rgba(118,75,162,0.1)">
                            <i class="fas fa-box-open fa-2x mb-2" style="color:#764ba2"></i>
                            <h4 class="fw-bold mb-0"><?php echo e(number_format($funnel_product_views), false); ?></h4>
                            <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.funnel_product_views'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 rounded" style="background:rgba(243,156,18,0.1)">
                            <i class="fas fa-cart-plus fa-2x mb-2" style="color:#f39c12"></i>
                            <h4 class="fw-bold mb-0"><?php echo e(number_format($funnel_add_to_cart), false); ?></h4>
                            <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.funnel_add_to_cart'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 rounded" style="background:rgba(40,167,69,0.1)">
                            <i class="fas fa-check-circle fa-2x mb-2" style="color:#28a745"></i>
                            <h4 class="fw-bold mb-0"><?php echo e(number_format($funnel_orders), false); ?></h4>
                            <small class="text-muted"><?php echo app('translator')->get('productcatalogue::lang.funnel_orders'); ?></small>
                        </div>
                    </div>
                </div>
                
                <?php
                    $max_funnel = max($funnel_page_views, 1);
                    $pv_pct = round(($funnel_product_views / $max_funnel) * 100);
                    $atc_pct = round(($funnel_add_to_cart / $max_funnel) * 100);
                    $ord_pct = round(($funnel_orders / $max_funnel) * 100);
                ?>
                <div class="progress mt-2" style="height: 28px;">
                    <div class="progress-bar" role="progressbar" style="width:100%;background:#667eea" title="<?php echo app('translator')->get('productcatalogue::lang.funnel_page_views'); ?>">
                        100%
                    </div>
                </div>
                <div class="progress mt-1" style="height: 24px;">
                    <div class="progress-bar" role="progressbar" style="width:<?php echo e($pv_pct, false); ?>%;background:#764ba2" title="<?php echo app('translator')->get('productcatalogue::lang.funnel_product_views'); ?>">
                        <?php echo e($pv_pct, false); ?>%
                    </div>
                </div>
                <div class="progress mt-1" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width:<?php echo e($atc_pct, false); ?>%;background:#f39c12" title="<?php echo app('translator')->get('productcatalogue::lang.funnel_add_to_cart'); ?>">
                        <?php echo e($atc_pct, false); ?>%
                    </div>
                </div>
                <div class="progress mt-1" style="height: 16px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width:<?php echo e($ord_pct, false); ?>%" title="<?php echo app('translator')->get('productcatalogue::lang.funnel_orders'); ?>">
                        <?php echo e($ord_pct, false); ?>%
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-lg-4">
            
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                <div class="text-center py-2">
                    <div class="position-relative d-inline-block mb-2">
                        <svg viewBox="0 0 120 120" width="110" height="110">
                            <circle cx="60" cy="60" r="50" stroke="#e9ecef" stroke-width="10" fill="none"/>
                            <circle cx="60" cy="60" r="50" stroke="#28a745" stroke-width="10" fill="none"
                                stroke-dasharray="<?php echo e(314 * min($conversion_rate, 100) / 100, false); ?> 314"
                                stroke-linecap="round" transform="rotate(-90 60 60)"/>
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <h4 class="fw-bold mb-0"><?php echo e($conversion_rate, false); ?>%</h4>
                        </div>
                    </div>
                    <p class="text-muted mb-0"><i class="fas fa-percentage me-1"></i><?php echo app('translator')->get('productcatalogue::lang.conversion_rate'); ?><br><small>(This Month)</small></p>
                </div>
            <?php echo $__env->renderComponent(); ?>

            
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.catalogue_health')]); ?>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-image me-2 text-warning"></i><?php echo app('translator')->get('productcatalogue::lang.products_no_image'); ?></span>
                        <?php if($products_no_image > 0): ?>
                            <span class="badge bg-warning text-dark rounded-pill"><?php echo e($products_no_image, false); ?></span>
                        <?php else: ?>
                            <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-exclamation-triangle me-2 text-danger"></i><?php echo app('translator')->get('productcatalogue::lang.low_stock_alert'); ?></span>
                        <span class="badge bg-<?php echo e($low_stock_products->count() > 0 ? 'danger' : 'success', false); ?> rounded-pill"><?php echo e($low_stock_products->count(), false); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-map-marker-alt me-2 text-info"></i><?php echo app('translator')->get('productcatalogue::lang.catalogue_locations'); ?></span>
                        <span class="badge bg-info rounded-pill"><?php echo e($catalogue_locations, false); ?></span>
                    </li>
                </ul>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row g-3 mb-3">
        
        <div class="col-lg-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.traffic_trend')]); ?>
                <?php echo $traffic_chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-lg-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.orders_trend')]); ?>
                <?php echo $orders_chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row g-3 mb-3">
        
        <div class="col-lg-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.top_products_by_views')]); ?>
                <?php if($top_products->isEmpty()): ?>
                    <p class="text-muted text-center py-3"><?php echo app('translator')->get('productcatalogue::lang.no_data_available'); ?></p>
                <?php else: ?>
                    <?php echo $top_products_chart->container(); ?>

                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-lg-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.traffic_by_location')]); ?>
                <?php echo $location_chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row g-3 mb-3">
        <div class="col-lg-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.quick_actions')]); ?>
                <div class="row g-2">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="<?php echo e(action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr']), false); ?>"
                           class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-qrcode fa-2x d-block mb-2"></i>
                            <?php echo app('translator')->get('productcatalogue::lang.generate_qr'); ?>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="<?php echo e(action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'catalogueSettings']), false); ?>"
                           class="btn btn-outline-secondary w-100 py-3">
                            <i class="fas fa-cog fa-2x d-block mb-2"></i>
                            <?php echo app('translator')->get('productcatalogue::lang.catalogue_settings'); ?>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="<?php echo e(action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'analytics']), false); ?>"
                           class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-chart-line fa-2x d-block mb-2"></i>
                            <?php echo app('translator')->get('productcatalogue::lang.view_all_analytics'); ?>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="<?php echo e(action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'orderNotes']), false); ?>"
                           class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-sticky-note fa-2x d-block mb-2"></i>
                            <?php echo app('translator')->get('productcatalogue::lang.view_all_order_notes'); ?>
                        </a>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row g-3 mb-3">
        
        <div class="col-lg-7">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.recent_qr_orders')]); ?>
                <?php if($recent_orders->isEmpty()): ?>
                    <p class="text-muted text-center py-3"><i class="fas fa-inbox me-1"></i><?php echo app('translator')->get('productcatalogue::lang.no_recent_orders'); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                    <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                    <th><?php echo app('translator')->get('purchase.business_location'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('sale.total_amount'); ?></th>
                                    <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                                    <th><?php echo app('translator')->get('productcatalogue::lang.date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><span class="fw-semibold"><?php echo e($order->invoice_no ?: $order->ref_no, false); ?></span></td>
                                    <td><?php echo e(optional($order->contact)->name ?? '-', false); ?></td>
                                    <td><?php echo e(optional($order->location)->name ?? '-', false); ?></td>
                                    <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($order->final_total, false); ?></span></td>
                                    <td>
                                        <?php
                                            $badge_class = match($order->payment_status) {
                                                'paid' => 'bg-success',
                                                'partial' => 'bg-warning text-dark',
                                                default => 'bg-danger',
                                            };
                                        ?>
                                        <span class="badge <?php echo e($badge_class, false); ?>"><?php echo e(ucfirst($order->payment_status), false); ?></span>
                                    </td>
                                    <td><small class="text-muted"><?php echo e(\Carbon\Carbon::parse($order->transaction_date)->format('M d, H:i'), false); ?></small></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-lg-5">
            
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.recent_order_notes')]); ?>
                <?php if($recent_notes->isEmpty()): ?>
                    <p class="text-muted text-center py-3"><i class="fas fa-comment-slash me-1"></i><?php echo app('translator')->get('productcatalogue::lang.no_recent_notes'); ?></p>
                <?php else: ?>
                    <?php $__currentLoopData = $recent_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-start border-bottom py-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2 flex-shrink-0"
                                 style="width:36px;height:36px;background:rgba(102,126,234,0.1)">
                                <i class="fas fa-user" style="color:#667eea"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small"><?php echo e($note->customer_name ?: 'Guest', false); ?>

                                    <?php if($note->customer_phone): ?>
                                        <small class="text-muted ms-1"><?php echo e($note->customer_phone, false); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="small text-muted"><?php echo e($note->special_instructions ?: '-', false); ?></div>
                                <div class="small">
                                    <span class="badge bg-<?php echo e($note->order_type == 'delivery' ? 'warning text-dark' : ($note->order_type == 'takeaway' ? 'info' : 'success'), false); ?>"><?php echo e($note->order_type_label, false); ?></span>
                                    <?php if($note->transaction): ?>
                                        <span class="ms-1 text-muted"><?php echo e($note->transaction->invoice_no ?: $note->transaction->ref_no, false); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <small class="text-muted ms-2"><?php echo e($note->created_at->diffForHumans(), false); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center mt-2">
                        <a href="<?php echo e(action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'orderNotes']), false); ?>" class="btn btn-sm btn-outline-primary">
                            <?php echo app('translator')->get('productcatalogue::lang.view_all_order_notes'); ?> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>

            
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.low_stock_alert')]); ?>
                <?php if($low_stock_products->isEmpty()): ?>
                    <p class="text-muted text-center py-2"><i class="fas fa-check-circle me-1 text-success"></i><?php echo app('translator')->get('productcatalogue::lang.no_low_stock'); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo app('translator')->get('sale.product'); ?></th>
                                    <th>SKU</th>
                                    <th class="text-end"><?php echo app('translator')->get('report.current_stock'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $low_stock_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="small"><?php echo e($p->name, false); ?></td>
                                        <td class="small text-muted"><?php echo e($p->sku, false); ?></td>
                                        <td class="text-end">
                                            <span class="badge bg-<?php echo e($p->current_stock <= 0 ? 'danger' : 'warning text-dark', false); ?>"><?php echo e(number_format($p->current_stock, 2), false); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $traffic_chart->script(); ?>

    <?php echo $orders_chart->script(); ?>

    <?php if(!$top_products->isEmpty()): ?>
        <?php echo $top_products_chart->script(); ?>

    <?php endif; ?>
    <?php echo $location_chart->script(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
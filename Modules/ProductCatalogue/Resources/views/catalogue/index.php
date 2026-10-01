
<?php $__env->startSection('title', $business->name); ?>

<?php $__env->startSection('content'); ?>

<section class="catalogue-hero text-center" id="top">
    <div class="container py-4">
        <?php if(!empty($business->logo)): ?>
            <img src="<?php echo e(asset('uploads/business_logos/' . $business->logo), false); ?>" alt="<?php echo e($business->name, false); ?>" class="catalogue-hero-logo mb-3">
        <?php endif; ?>
        <h1 class="catalogue-hero-title"><?php echo e($business->name, false); ?></h1>
        <h5 class="catalogue-hero-subtitle"><?php echo e($business_location->name, false); ?></h5>
        <p class="catalogue-hero-address"><?php echo $business_location->location_address; ?></p>
    </div>
</section>


<section class="no-print">
    <div class="container">
        <nav class="navbar navbar-expand-lg catalogue-navbar" id="catalogue-nav">
            <div class="container-fluid px-0">
                <a class="navbar-brand menu" href="#top">
                    <?php if(!empty($business->logo)): ?>
                        <img src="<?php echo e(asset('uploads/business_logos/' . $business->logo), false); ?>" alt="Logo" width="28" class="rounded">
                    <?php else: ?>
                        <i class="fas fa-boxes"></i>
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#catalogueNavCollapse" aria-controls="catalogueNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="catalogueNavCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link menu" href="#category<?php echo e($key, false); ?>"><?php echo e($value, false); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link menu" href="#category0">Uncategorized</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>


<section class="catalogue-content py-4">
    <div class="container">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="catalogue-category-section mb-5" id="category<?php echo e($product_category->first()->category->id ?? 0, false); ?>">
                <div class="catalogue-category-header mb-4">
                    <h2 class="catalogue-category-title">
                        <span class="catalogue-category-icon"><i class="fas fa-tag"></i></span>
                        <?php echo e($product_category->first()->category->name ?? 'Uncategorized', false); ?>

                    </h2>
                    <hr class="catalogue-category-divider">
                </div>

                <div class="row g-3 g-md-4">
                    <?php $__currentLoopData = $product_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card catalogue-product-card h-100">
                                
                                <div class="catalogue-product-img-wrapper">
                                    <a href="#" class="show-product-details" data-href="<?php echo e(url('show-catalogue/' . $business->slug . '/' . $product->id), false); ?>?location_id=<?php echo e($business_location->uid, false); ?>">
                                        <img src="<?php echo e($product->image_url, false); ?>" class="card-img-top catalogue-product-img" alt="<?php echo e($product->name, false); ?>">
                                    </a>

                                    <?php
                                        $discount = null;
                                        $product_variation_ids = $product->variations->pluck('id');
                                        foreach ($discounts as $_d) {
                                            if ($_d->variations->isNotEmpty()) {
                                                // Product-specific discount: only match if a variation belongs to this product
                                                if ($product_variation_ids->intersect($_d->variations->pluck('id'))->isNotEmpty()) {
                                                    $discount = $_d;
                                                    break;
                                                }
                                            } elseif ($_d->brands->isNotEmpty()) {
                                                // Brand discount: only match if the product has that brand
                                                if (!empty($product->brand_id) && $_d->brands->contains('id', $product->brand_id)) {
                                                    $discount = $_d;
                                                    break;
                                                }
                                            } elseif ($_d->categories->isNotEmpty()) {
                                                // Category discount
                                                if ($_d->categories->contains('id', $product->category_id)) {
                                                    $discount = $_d;
                                                    break;
                                                }
                                            } else {
                                                // General discount with no specific targeting
                                                $discount = $_d;
                                                break;
                                            }
                                        }
                                    ?>

                                    <?php if(!empty($discount)): ?>
                                        <span class="badge catalogue-discount-badge">-<?php echo e(($discount->discount_amount), false); ?>%</span>
                                    <?php endif; ?>

                                    <?php
                                        $is_out_of_stock_flag = $product->enable_stock && (empty($product->stock) || $product->stock < 0);
                                    ?>
                                    <?php if($is_out_of_stock_flag): ?>
                                        <span class="badge catalogue-oos-badge"><?php echo app('translator')->get('productcatalogue::lang.out_of_stock'); ?></span>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="card-body catalogue-product-body d-flex flex-column">
                                    <h6 class="catalogue-product-name">
                                        <a href="#" class="show-product-details text-decoration-none" data-href="<?php echo e(url('show-catalogue/' . $business->slug . '/' . $product->id), false); ?>?location_id=<?php echo e($business_location->uid, false); ?>">
                                            <?php echo e($product->name, false); ?>

                                        </a>
                                    </h6>

                                    <?php
                                        $max_price = $product->variations->max('sell_price_inc_tax');
                                        $min_price = $product->variations->min('sell_price_inc_tax');
                                        $max_discounted = null;
                                        $min_discounted = null;
                                        if (!empty($discount)) {
                                            $d_amount = floatval($discount->discount_amount);
                                            if ($discount->discount_type == 'percentage') {
                                                $max_discounted = $max_price * (1 - $d_amount / 100);
                                                $min_discounted = $min_price * (1 - $d_amount / 100);
                                            } else {
                                                $max_discounted = max(0, $max_price - $d_amount);
                                                $min_discounted = max(0, $min_price - $d_amount);
                                            }
                                        }
                                    ?>

                                    <div class="catalogue-product-price mb-1">
                                        <?php if(!empty($discount)): ?>
                                            <div class="lh-1 mb-1">
                                                <span class="display_currency text-muted small text-decoration-line-through" data-currency_symbol="true"><?php echo e(($max_price), false); ?></span>
                                                <?php if($max_price != $min_price): ?>
                                                    <span class="catalogue-price-separator text-muted small">-</span>
                                                    <span class="display_currency text-muted small text-decoration-line-through" data-currency_symbol="true"><?php echo e(($min_price), false); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <span class="display_currency catalogue-price-value fw-bold text-danger" data-currency_symbol="true"><?php echo e(($max_discounted), false); ?></span>
                                                <?php if($max_price != $min_price): ?>
                                                    <span class="catalogue-price-separator text-danger">-</span>
                                                    <span class="display_currency catalogue-price-value fw-bold text-danger" data-currency_symbol="true"><?php echo e(($min_discounted), false); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="display_currency catalogue-price-value" data-currency_symbol="true"><?php echo e(($max_price), false); ?></span>
                                            <?php if($max_price != $min_price): ?>
                                                <span class="catalogue-price-separator">-</span>
                                                <span class="display_currency catalogue-price-value" data-currency_symbol="true"><?php echo e(($min_price), false); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="catalogue-product-sku text-muted small mb-2">
                                        <i class="fas fa-barcode me-1"></i><?php echo e($product->sku, false); ?>

                                    </div>

                                    <?php if($product->type == 'variable'): ?>
                                        <?php
                                            $variations = $product->variations->groupBy('product_variation_id');
                                        ?>
                                        <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mb-2">
                                                <label class="form-label catalogue-var-label mb-1"><?php echo e($product_variation->first()->product_variation->name, false); ?></label>
                                                <select class="form-select form-select-sm">
                                                    <?php $__currentLoopData = $product_variation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($variation->id, false); ?>"><?php echo e($variation->name, false); ?> (<?php echo e($variation->sub_sku, false); ?>) - <?php echo e(($variation->sell_price_inc_tax), false); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <div class="mt-auto pt-2">
                                        <?php
                                            $default_variation = $product->variations->first();
                                            $is_out_of_stock = $product->enable_stock && (empty($product->stock) || $product->stock < 0);
                                        ?>
                                        <?php if(in_array($product->type, ['single', 'combo']) && !empty($default_variation)): ?>
                                            <button type="button"
                                                class="btn btn-primary btn-sm w-100 catalogue-add-btn add-to-cart-btn"
                                                data-variation-id="<?php echo e($default_variation->id, false); ?>"
                                                data-product-id="<?php echo e($product->id, false); ?>"
                                                data-product-name="<?php echo e($product->name, false); ?>"
                                                data-price="<?php echo e($default_variation->sell_price_inc_tax, false); ?>"
                                                <?php if($is_out_of_stock): ?> disabled <?php endif; ?>>
                                                <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                            </button>
                                        <?php else: ?>
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-sm w-100 catalogue-view-btn show-product-details"
                                                data-href="<?php echo e(url('show-catalogue/' . $business->slug . '/' . $product->id), false); ?>?location_id=<?php echo e($business_location->uid, false); ?>">
                                                <i class="fas fa-eye me-1"></i> View Options
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="scrolltop no-print">
        <div class="scroll icon catalogue-scroll-top">
            <i class="fas fa-chevron-up"></i>
        </div>
    </div>
</section>


<input type="hidden" id="__code" value="<?php echo e($business->currency->code, false); ?>">
<input type="hidden" id="__symbol" value="<?php echo e($business->currency->symbol, false); ?>">
<input type="hidden" id="__thousand" value="<?php echo e($business->currency->thousand_separator, false); ?>">
<input type="hidden" id="__decimal" value="<?php echo e($business->currency->decimal_separator, false); ?>">
<input type="hidden" id="__symbol_placement" value="<?php echo e($business->currency->currency_symbol_placement, false); ?>">
<input type="hidden" id="__precision" value="<?php echo e($business->currency_precision, false); ?>">
<input type="hidden" id="__quantity_precision" value="<?php echo e($business->quantity_precision, false); ?>">


<div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>


<div id="catalogueCartData"
    data-order-url="<?php echo e(url('catalogue/' . $business->slug . '/' . $business_location->uid . '/order'), false); ?>"
    data-orders-url="<?php echo e(url('catalogue/' . $business->slug . '/' . $business_location->uid . '/orders'), false); ?>"
    data-tables-url="<?php echo e(url('catalogue/' . $business->slug . '/' . $business_location->uid . '/tables'), false); ?>"
    data-business-id="<?php echo e($business->slug, false); ?>"
    data-location-id="<?php echo e($business_location->uid, false); ?>"
    data-table-id="<?php echo e(optional($qr_table)->uid, false); ?>"
    data-table-name="<?php echo e(optional($qr_table)->name, false); ?>"
    data-enable-customer-info="<?php echo e(($settings['enable_customer_info'] ?? 0) == 1 ? '1' : '0', false); ?>">
</div>


<div class="catalogue-cart-fab no-print">
    <div class="d-flex gap-2 catalogue-fab-group">
        <button type="button" class="btn catalogue-orders-fab-btn d-none" id="viewOrdersFab" data-bs-toggle="modal" data-bs-target="#catalogueOrdersModal">
            <i class="fas fa-receipt me-1"></i>
            <?php echo app('translator')->get('productcatalogue::lang.view_orders'); ?>
        </button>
        <button type="button" class="btn catalogue-cart-fab-btn" data-bs-toggle="modal" data-bs-target="#catalogueCartModal">
            <i class="fas fa-shopping-cart me-1"></i>
            Cart (<span class="catalogue-cart-count">0</span>) &mdash;
            <span class="catalogue-cart-total display_currency" data-currency_symbol="true">0</span>
        </button>
    </div>
</div>


<div class="modal fade" id="catalogueCartModal" tabindex="-1" aria-labelledby="catalogueCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content catalogue-cart-modal-content">
            <div class="modal-header catalogue-cart-modal-header">
                <h5 class="modal-title fw-bold" id="catalogueCartModalLabel">
                    <i class="fas fa-shopping-cart me-2"></i>Your Cart
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="catalogue-cart-message alert d-none"></div>
                <div class="catalogue-cart-selection text-muted small mb-2">
                    <i class="fas fa-map-marker-alt me-1"></i>Selection: Not selected
                </div>
                <div class="catalogue-cart-empty text-muted text-center py-4">
                    <i class="fas fa-shopping-basket fa-2x mb-2 d-block opacity-50"></i>
                    Your cart is empty.
                </div>
                <div class="catalogue-cart-items"></div>
            </div>
            <div class="modal-footer catalogue-cart-modal-footer">
                <div class="me-auto fw-bold">
                    Total:
                    <span class="catalogue-cart-total display_currency" data-currency_symbol="true">0</span>
                </div>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm place-order-btn" disabled>
                    <i class="fas fa-check-circle me-1"></i>Place Order
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="customerInfoModal" tabindex="-1" aria-labelledby="customerInfoModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content catalogue-cart-modal-content">
            <div class="modal-header catalogue-cart-modal-header">
                <h5 class="modal-title fw-bold" id="customerInfoModalLabel">
                    <i class="fas fa-user me-2"></i><?php echo app('translator')->get('productcatalogue::lang.customer_info_required'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3"><?php echo app('translator')->get('productcatalogue::lang.customer_info_subtitle'); ?></p>
                <div class="mb-3">
                    <label for="catalogue_customer_name" class="form-label fw-semibold">
                        <i class="fas fa-user me-1"></i><?php echo app('translator')->get('productcatalogue::lang.full_name'); ?> <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="catalogue_customer_name" placeholder="<?php echo app('translator')->get('productcatalogue::lang.full_name_placeholder'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="catalogue_customer_phone" class="form-label fw-semibold">
                        <i class="fas fa-phone me-1"></i><?php echo app('translator')->get('productcatalogue::lang.mobile_number'); ?> <span class="text-danger">*</span>
                    </label>
                    <input type="tel" class="form-control" id="catalogue_customer_phone" placeholder="<?php echo app('translator')->get('productcatalogue::lang.mobile_number_placeholder'); ?>" required>
                </div>
                <div class="alert alert-danger d-none" id="customerInfoError"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('productcatalogue::lang.cancel'); ?></button>
                <button type="button" class="btn btn-primary" id="customerInfoSubmitBtn">
                    <i class="fas fa-check me-1"></i><?php echo app('translator')->get('productcatalogue::lang.continue'); ?>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="catalogueOrdersModal" tabindex="-1" aria-labelledby="catalogueOrdersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content catalogue-cart-modal-content">
            <div class="modal-header catalogue-cart-modal-header">
                <h5 class="modal-title fw-bold" id="catalogueOrdersModalLabel">
                    <i class="fas fa-receipt me-2"></i><?php echo app('translator')->get('productcatalogue::lang.my_orders'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="refreshOrdersBtn">
                        <i class="fas fa-sync-alt me-1"></i><?php echo app('translator')->get('productcatalogue::lang.refresh_orders'); ?>
                    </button>
                </div>
                <div class="catalogue-orders-loading text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="catalogue-orders-empty text-muted text-center py-4">
                    <i class="fas fa-receipt fa-2x mb-2 d-block opacity-50"></i>
                    <?php echo app('translator')->get('productcatalogue::lang.no_active_orders'); ?>
                </div>
                <div class="catalogue-orders-list"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <div class="catalogue-orders-grand-total d-none text-center mb-2 w-100">
                    <span class="fw-bold fs-5"><?php echo app('translator')->get('productcatalogue::lang.total'); ?>: <span class="catalogue-orders-grand-total-value display_currency" data-currency_symbol="true">0</span></span>
                </div>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><?php echo app('translator')->get('productcatalogue::lang.close'); ?></button>
            </div>
        </div>
    </div>
</div>


<style>
    /* ---------- Hero ---------- */
    .catalogue-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 2.5rem 0 1.5rem;
    }
    .catalogue-hero-logo {
        width: 72px;
        height: 72px;
        object-fit: contain;
        border-radius: 16px;
        background: rgba(255,255,255,.15);
        padding: 8px;
        backdrop-filter: blur(6px);
    }
    .catalogue-hero-title {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -.5px;
        margin-bottom: .25rem;
    }
    .catalogue-hero-subtitle {
        font-weight: 600;
        opacity: .9;
        margin-bottom: .25rem;
    }
    .catalogue-hero-address {
        opacity: .75;
        font-size: .9rem;
        margin-bottom: 0;
    }

    /* ---------- Category Navbar ---------- */
    .catalogue-navbar {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        padding: .5rem 1rem;
        margin-top: -1.25rem;
        position: relative;
        z-index: 100;
    }
    .catalogue-navbar .navbar-brand {
        padding: .15rem 0;
    }
    .catalogue-navbar .nav-link {
        font-weight: 500;
        color: #4c5258;
        font-size: .875rem;
        padding: .5rem .85rem;
        border-radius: 6px;
        transition: all .2s ease;
    }
    .catalogue-navbar .nav-link:hover,
    .catalogue-navbar .nav-link:focus {
        background: rgba(102,126,234,.08);
        color: #667eea;
    }
    .catalogue-navbar.navbar-fixed-top {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        border-radius: 0;
        margin-top: 0;
        box-shadow: 0 2px 16px rgba(0,0,0,.10);
    }

    /* ---------- Category Headers ---------- */
    .catalogue-category-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .catalogue-category-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border-radius: 8px;
        font-size: .8rem;
    }
    .catalogue-category-divider {
        border: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea 0%, transparent 60%);
        opacity: .3;
        margin-top: .5rem;
    }

    /* ---------- Product Card ---------- */
    .catalogue-product-card {
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 12px;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
        background: #fff;
    }
    .catalogue-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,.10);
    }

    .catalogue-product-img-wrapper {
        position: relative;
        overflow: hidden;
        background: #f8f9fa;
    }
    .catalogue-product-img {
        width: 100%;
        height: 180px;
        object-fit: contain;
        padding: 16px;
        transition: transform .3s ease;
    }
    .catalogue-product-card:hover .catalogue-product-img {
        transform: scale(1.05);
    }

    .catalogue-discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: .75rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(245,158,11,.3);
    }
    .catalogue-oos-badge {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(220,53,69,.9);
        color: #fff;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: .7rem;
        font-weight: 600;
    }

    .catalogue-product-body {
        padding: .875rem 1rem 1rem;
    }
    .catalogue-product-name {
        font-size: .9rem;
        font-weight: 600;
        color: #2d3748;
        line-height: 1.35;
        margin-bottom: .35rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .catalogue-product-name a {
        color: inherit;
    }
    .catalogue-product-name a:hover {
        color: #667eea;
    }

    .catalogue-product-price {
        font-size: 1rem;
        font-weight: 700;
        color: #16a34a;
    }
    .catalogue-price-separator {
        color: #9ca3af;
        margin: 0 2px;
    }
    .catalogue-product-sku {
        font-size: .75rem;
    }
    .catalogue-var-label {
        font-size: .75rem;
        font-weight: 600;
        color: #6b7280;
    }

    .catalogue-add-btn {
        border-radius: 8px;
        font-weight: 600;
        font-size: .8rem;
        padding: .45rem .75rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        transition: all .2s ease;
    }
    .catalogue-add-btn:hover {
        background: linear-gradient(135deg, #5a6fd6, #6a4296);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102,126,234,.35);
    }
    .catalogue-add-btn:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    .catalogue-view-btn {
        border-radius: 8px;
        font-weight: 600;
        font-size: .8rem;
        padding: .45rem .75rem;
    }

    /* ---------- Scroll to Top ---------- */
    .catalogue-scroll-top {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border-radius: 50%;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(102,126,234,.35);
        cursor: pointer;
        transition: transform .2s ease;
    }
    .catalogue-scroll-top:hover {
        transform: scale(1.1);
    }

    /* ---------- Floating Cart FAB ---------- */
    .catalogue-cart-fab {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 1050;
    }
    .catalogue-cart-fab-btn {
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 600;
        font-size: .9rem;
        box-shadow: 0 6px 24px rgba(22,163,74,.35);
        transition: all .2s ease;
    }
    .catalogue-cart-fab-btn:hover {
        background: linear-gradient(135deg, #15803d, #166534);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(22,163,74,.40);
    }

    /* ---------- Cart Modal ---------- */
    .catalogue-cart-modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }
    .catalogue-cart-modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-bottom: none;
        padding: 1rem 1.25rem;
    }
    .catalogue-cart-modal-header .btn-close {
        filter: invert(1);
    }
    .catalogue-cart-modal-footer {
        border-top: 1px solid #f0f0f0;
        padding: .75rem 1.25rem;
    }

    .catalogue-cart-items {
        margin-top: .5rem;
    }
    .catalogue-cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f3f4f6;
        padding: .625rem 0;
        gap: .625rem;
    }
    .catalogue-cart-item-name {
        flex: 1;
        font-weight: 500;
        font-size: .875rem;
        color: #2d3748;
    }
    .catalogue-cart-qty {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .catalogue-cart-qty .btn {
        width: 28px;
        height: 28px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-weight: 700;
    }
    .cart-qty-value {
        min-width: 20px;
        text-align: center;
        font-weight: 600;
    }
    .catalogue-cart-remove {
        color: #dc3545;
        cursor: pointer;
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1;
        transition: color .15s ease;
    }
    .catalogue-cart-remove:hover {
        color: #a71d2a;
    }

    /* ---------- View Orders FAB ---------- */
    .catalogue-fab-group {
        flex-wrap: nowrap;
    }
    .catalogue-orders-fab-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 12px 18px;
        font-weight: 600;
        font-size: .85rem;
        box-shadow: 0 6px 24px rgba(102,126,234,.35);
        transition: all .2s ease;
        white-space: nowrap;
    }
    .catalogue-orders-fab-btn:hover {
        background: linear-gradient(135deg, #5a6fd6, #6a4296);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ---------- Orders List ---------- */
    .catalogue-order-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: .75rem;
        background: #fff;
    }
    .catalogue-order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: .5rem;
    }
    .catalogue-order-number {
        font-weight: 700;
        font-size: .95rem;
        color: #2d3748;
    }
    .catalogue-order-status-badge {
        font-size: .75rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }
    .badge-table-order {
        background: #dbeafe;
        color: #1d4ed8;
    }
    .badge-table-order-bill {
        background: #fef3c7;
        color: #92400e;
    }
    .badge-kitchen-status {
        font-size: .7rem;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
    }
    .badge-kitchen-received {
        background: #e0e7ff;
        color: #3730a3;
    }
    .badge-kitchen-cooked {
        background: #d1fae5;
        color: #065f46;
    }
    .badge-kitchen-served {
        background: #f3f4f6;
        color: #6b7280;
    }
    .catalogue-order-items {
        font-size: .85rem;
    }
    .catalogue-order-item-row {
        display: flex;
        justify-content: space-between;
        padding: 2px 0;
        border-bottom: 1px solid #f9fafb;
    }
    .catalogue-order-total {
        font-weight: 700;
        font-size: 1rem;
        color: #16a34a;
        text-align: right;
        margin-top: .5rem;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 767.98px) {
        .catalogue-hero {
            padding: 1.75rem 0 1.25rem;
        }
        .catalogue-hero-title {
            font-size: 1.35rem;
        }
        .catalogue-hero-logo {
            width: 56px;
            height: 56px;
        }
        .catalogue-product-img {
            height: 140px;
            padding: 10px;
        }
        .catalogue-product-body {
            padding: .65rem .75rem .75rem;
        }
        .catalogue-product-name {
            font-size: .82rem;
        }
        .catalogue-product-price {
            font-size: .9rem;
        }
        .catalogue-cart-fab {
            left: 16px;
            right: 16px;
            bottom: 12px;
        }
        .catalogue-cart-fab-btn {
            width: 100%;
            text-align: center;
        }
        .catalogue-fab-group {
            flex-direction: column;
            width: 100%;
        }
        .catalogue-orders-fab-btn {
            width: 100%;
            text-align: center;
            font-size: .8rem;
            padding: 10px 16px;
        }
        .catalogue-navbar {
            margin-top: -.75rem;
        }
    }

    @media (max-width: 575.98px) {
        .catalogue-product-img {
            height: 120px;
            padding: 8px;
        }
        .catalogue-add-btn,
        .catalogue-view-btn {
            font-size: .75rem;
            padding: .35rem .5rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">

    (function($) {
    $(document).ready( function() {
        //Set global currency to be used in the application
        __currency_symbol = $('input#__symbol').val();
        __currency_thousand_separator = $('input#__thousand').val();
        __currency_decimal_separator = $('input#__decimal').val();
        __currency_symbol_placement = $('input#__symbol_placement').val();
        if ($('input#__precision').length > 0) {
            __currency_precision = $('input#__precision').val();
        } else {
            __currency_precision = 2;
        }

        if ($('input#__quantity_precision').length > 0) {
            __quantity_precision = $('input#__quantity_precision').val();
        } else {
            __quantity_precision = 2;
        }

        if ($('input#__cost_decimal').length > 0) {
            __cost_decimal = $('input#__cost_decimal').val();
        } else {
            __cost_decimal = 2;
        }

        //Set page level currency to be used for some pages. (Purchase page)
        if ($('input#p_symbol').length > 0) {
            __p_currency_symbol = $('input#p_symbol').val();
            __p_currency_thousand_separator = $('input#p_thousand').val();
            __p_currency_decimal_separator = $('input#p_decimal').val();
        }

        __currency_convert_recursively($('.catalogue-content'));
        initializeCart();
    });

    $(document).on('click', '.show-product-details', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                var $modal = $('.product_modal');
                $modal.html(result);
                var bsModal = new bootstrap.Modal($modal[0]);
                bsModal.show();
                __currency_convert_recursively($modal);
            },
        });
    });

    $(document).on('click', '.menu', function(e){
        e.preventDefault();
        // Collapse mobile navbar
        var navCollapse = document.getElementById('catalogueNavCollapse');
        if (navCollapse && navCollapse.classList.contains('show')) {
            var bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
            if (bsCollapse) bsCollapse.hide();
        }

        var cat_id = $(this).attr('href');
        if ($(cat_id).length) {
            $('html, body').animate({
                scrollTop: $(cat_id).offset().top - 60
            }, 800);
        }
    });

    var cartState = {
        items: {},
        selection: null,
        selection_label: null
    };

    var cartStorageKey = null;
    var customerStorageKey = null;
    var orderIdsStorageKey = null;
    var pendingSelection = null;
    var pendingSelectionLabel = 'Not selected';
    var fixedTableSelection = null;
    var isSubmittingOrder = false;
    var enableCustomerInfo = false;
    var pendingAddToCartItem = null;

    function getCartDataElement() {
        return document.getElementById('catalogueCartData');
    }

    function getOrderUrl() {
        var el = getCartDataElement();
        return el ? el.getAttribute('data-order-url') : '';
    }

    function getOrdersUrl() {
        var el = getCartDataElement();
        return el ? el.getAttribute('data-orders-url') : '';
    }

    function getTablesUrl() {
        var el = getCartDataElement();
        return el ? el.getAttribute('data-tables-url') : '';
    }

    function loadCart() {
        if (!cartStorageKey) {
            return;
        }

        var raw = window.localStorage.getItem(cartStorageKey);
        if (!raw) {
            return;
        }

        try {
            var parsed = JSON.parse(raw);
            if (parsed && parsed.items) {
                cartState.items = parsed.items;
            }
            if (parsed && parsed.selection) {
                cartState.selection = parsed.selection;
                cartState.selection_label = parsed.selection_label || null;
            }
        } catch (e) {
            cartState.items = {};
        }
    }

    function saveCart() {
        if (!cartStorageKey) {
            return;
        }

        window.localStorage.setItem(cartStorageKey, JSON.stringify(cartState));
    }

    function getCartItemsArray() {
        return Object.keys(cartState.items).map(function(key) {
            return cartState.items[key];
        });
    }

    function getCartTotals() {
        var items = getCartItemsArray();
        var totalQty = 0;
        var totalAmount = 0;

        items.forEach(function(item) {
            totalQty += item.quantity;
            totalAmount += item.quantity * item.price;
        });

        return {
            quantity: totalQty,
            total: totalAmount
        };
    }

    function updateCartUI() {
        var items = getCartItemsArray();
        var totals = getCartTotals();

        $('.catalogue-cart-count').text(totals.quantity);
        $('.catalogue-cart-total').text(totals.total.toFixed(__currency_precision));
        __currency_convert_recursively($('.catalogue-cart-bar'));

        var $itemsContainer = $('.catalogue-cart-items');
        $itemsContainer.empty();

        $('.catalogue-cart-selection').text('Selection: ' + pendingSelectionLabel);
        var canPlaceOrder = items.length > 0 && !isSubmittingOrder;
        $('.place-order-btn').prop('disabled', !canPlaceOrder);

        if (items.length === 0) {
            $('.catalogue-cart-empty').removeClass('d-none');
        } else {
            $('.catalogue-cart-empty').addClass('d-none');

            items.forEach(function(item) {
                var row = '<div class="catalogue-cart-item" data-variation-id="' + item.variation_id + '">'
                    + '<div class="catalogue-cart-item-name">' + item.product_name + '</div>'
                    + '<div class="catalogue-cart-qty">'
                    + '<button type="button" class="btn btn-outline-secondary btn-sm cart-qty-dec">-</button>'
                    + '<span class="cart-qty-value">' + item.quantity + '</span>'
                    + '<button type="button" class="btn btn-outline-secondary btn-sm cart-qty-inc">+</button>'
                    + '</div>'
                    + '<div class="catalogue-cart-item-price fw-semibold">'
                    + '<span class="display_currency" data-currency_symbol="true">' + (item.quantity * item.price) + '</span>'
                    + '</div>'
                    + '<span class="catalogue-cart-remove" title="Remove">&times;</span>'
                    + '</div>';
                $itemsContainer.append(row);
            });
        }

        __currency_convert_recursively($('#catalogueCartModal'));
    }

    function updateSelectionLabel(label, value) {
        pendingSelectionLabel = label || 'Not selected';
        pendingSelection = value || null;
        cartState.selection = pendingSelection;
        cartState.selection_label = pendingSelectionLabel;
        saveCart();
        $('.catalogue-cart-selection').text('Selection: ' + pendingSelectionLabel);
        $('.place-order-btn').prop('disabled', isSubmittingOrder);
    }

    function addToCart(item) {
        var key = String(item.variation_id);
        if (cartState.items[key]) {
            cartState.items[key].quantity += item.quantity;
        } else {
            cartState.items[key] = item;
        }
        saveCart();
        updateCartUI();
    }

    function updateCartItemQty(variationId, delta) {
        var key = String(variationId);
        if (!cartState.items[key]) {
            return;
        }

        cartState.items[key].quantity += delta;
        if (cartState.items[key].quantity <= 0) {
            delete cartState.items[key];
        }
        saveCart();
        updateCartUI();
    }

    function removeCartItem(variationId) {
        var key = String(variationId);
        if (cartState.items[key]) {
            delete cartState.items[key];
            saveCart();
            updateCartUI();
        }
    }

    function showCartMessage(message, isError) {
        var $message = $('.catalogue-cart-message');
        $message.removeClass('d-none alert-success alert-danger');
        $message.addClass(isError ? 'alert-danger' : 'alert-success');
        $message.text(message);
    }

    function clearCartMessage() {
        $('.catalogue-cart-message').addClass('d-none').text('');
    }

    function initializeCart() {
        var dataEl = getCartDataElement();
        if (!dataEl) {
            return;
        }

        var businessId = dataEl.getAttribute('data-business-id');
        var locationId = dataEl.getAttribute('data-location-id');
        var tableId = dataEl.getAttribute('data-table-id');
        var tableName = dataEl.getAttribute('data-table-name');
        enableCustomerInfo = dataEl.getAttribute('data-enable-customer-info') === '1';
        cartStorageKey = 'qr_catalogue_cart_' + businessId + '_' + locationId + (tableId ? '_table_' + tableId : '');
        customerStorageKey = 'qr_catalogue_customer_' + businessId + '_' + locationId;
        orderIdsStorageKey = 'qr_catalogue_orders_' + businessId + '_' + locationId + (tableId ? '_table_' + tableId : '');

        loadCart();
        loadCustomerInfo();
        if (tableId) {
            fixedTableSelection = {
                value: 'table:' + tableId,
                label: tableName || ('Table ' + tableId)
            };
            updateSelectionLabel(fixedTableSelection.label, fixedTableSelection.value);
        } else if (cartState.selection) {
            pendingSelection = cartState.selection;
            pendingSelectionLabel = cartState.selection_label || pendingSelectionLabel;
        }
        updateCartUI();
        updateViewOrdersButton();
    }

    // ── Customer Info localStorage ────────────────────────
    function getCustomerInfo() {
        if (!customerStorageKey) return null;
        try {
            var raw = window.localStorage.getItem(customerStorageKey);
            return raw ? JSON.parse(raw) : null;
        } catch (e) {
            return null;
        }
    }

    function saveCustomerInfo(name, phone) {
        if (!customerStorageKey) return;
        window.localStorage.setItem(customerStorageKey, JSON.stringify({
            name: name,
            phone: phone
        }));
    }

    function loadCustomerInfo() {
        var info = getCustomerInfo();
        if (info) {
            $('#catalogue_customer_name').val(info.name || '');
            $('#catalogue_customer_phone').val(info.phone || '');
        }
    }

    function hasCustomerInfo() {
        var info = getCustomerInfo();
        return info && info.name && info.phone;
    }

    // ── Order IDs localStorage ────────────────────────────
    function getStoredOrderIds() {
        if (!orderIdsStorageKey) return [];
        try {
            var raw = window.localStorage.getItem(orderIdsStorageKey);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    }

    function addOrderId(id) {
        var ids = getStoredOrderIds();
        if (ids.indexOf(id) === -1) {
            ids.push(id);
        }
        window.localStorage.setItem(orderIdsStorageKey, JSON.stringify(ids));
        updateViewOrdersButton();
    }

    function updateViewOrdersButton() {
        var ids = getStoredOrderIds();
        var tableId = getCartDataElement() ? getCartDataElement().getAttribute('data-table-id') : '';
        if (ids.length > 0 || tableId) {
            $('#viewOrdersFab').removeClass('d-none');
        }
    }

    // ── Customer Info Modal Logic ─────────────────────────
    function requireCustomerInfo(callback) {
        if (!enableCustomerInfo || hasCustomerInfo()) {
            callback();
            return;
        }
        pendingAddToCartItem = callback;
        var info = getCustomerInfo();
        if (info) {
            $('#catalogue_customer_name').val(info.name || '');
            $('#catalogue_customer_phone').val(info.phone || '');
        }
        $('#customerInfoError').addClass('d-none').text('');
        var modal = new bootstrap.Modal(document.getElementById('customerInfoModal'));
        modal.show();
    }

    $(document).on('click', '#customerInfoSubmitBtn', function() {
        var name = $.trim($('#catalogue_customer_name').val());
        var phone = $.trim($('#catalogue_customer_phone').val());

        if (!name || !phone) {
            $('#customerInfoError').removeClass('d-none').text('<?php echo app('translator')->get("productcatalogue::lang.customer_info_required_msg"); ?>');
            return;
        }

        saveCustomerInfo(name, phone);
        var modal = bootstrap.Modal.getInstance(document.getElementById('customerInfoModal'));
        if (modal) modal.hide();

        if (typeof pendingAddToCartItem === 'function') {
            pendingAddToCartItem();
            pendingAddToCartItem = null;
        }
    });

    $(document).on('click', '.add-to-cart-btn', function(e) {
        e.preventDefault();
        var $btn = $(this);

        if ($btn.is(':disabled')) {
            return;
        }

        var item = {
            variation_id: parseInt($btn.data('variation-id'), 10),
            product_id: parseInt($btn.data('product-id'), 10),
            product_name: $btn.data('product-name'),
            price: parseFloat($btn.data('price')),
            quantity: 1
        };

        requireCustomerInfo(function() {
            addToCart(item);
        });
    });

    $(document).on('click', '.cart-qty-inc', function() {
        var variationId = $(this).closest('.catalogue-cart-item').data('variation-id');
        updateCartItemQty(variationId, 1);
    });

    $(document).on('click', '.cart-qty-dec', function() {
        var variationId = $(this).closest('.catalogue-cart-item').data('variation-id');
        updateCartItemQty(variationId, -1);
    });

    $(document).on('click', '.catalogue-cart-remove', function() {
        var variationId = $(this).closest('.catalogue-cart-item').data('variation-id');
        removeCartItem(variationId);
    });

    var cartModalEl = document.getElementById('catalogueCartModal');
    if (cartModalEl) {
        cartModalEl.addEventListener('show.bs.modal', function() {
            clearCartMessage();
            updateCartUI();
        });
    }

    function submitOrderWithSelection(selectionValue) {
        var items = getCartItemsArray();
        if (items.length === 0) {
            showCartMessage('Your cart is empty.', true);
            return;
        }

        var payload = {
            products: items.map(function(item) {
                return {
                    variation_id: item.variation_id,
                    quantity: item.quantity,
                    product_name: item.product_name
                };
            })
        };

        if (selectionValue && selectionValue.indexOf('table:') === 0) {
            payload.res_table_id = selectionValue.replace('table:', '');
        }

        // Include customer info if available
        var customerInfo = getCustomerInfo();
        if (customerInfo) {
            payload.customer_name = customerInfo.name;
            payload.customer_phone = customerInfo.phone;
        }

        $.ajax({
            method: 'POST',
            url: getOrderUrl(),
            data: payload,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                isSubmittingOrder = true;
                $('.place-order-btn').prop('disabled', true);
                clearCartMessage();
            },
            success: function(response) {
                if (response && response.success) {
                    // Store the transaction ID for order tracking
                    if (response.transaction_id) {
                        addOrderId(response.transaction_id);
                    }
                    cartState.items = {};
                    cartState.selection = null;
                    cartState.selection_label = null;
                    saveCart();
                    updateCartUI();
                    showCartMessage('Order placed successfully.', false);
                    var cartModalEl = document.getElementById('catalogueCartModal');
                    var cartBsModal = bootstrap.Modal.getInstance(cartModalEl);
                    if (cartBsModal) cartBsModal.hide();
                    if (fixedTableSelection) {
                        updateSelectionLabel(fixedTableSelection.label, fixedTableSelection.value);
                    } else {
                        updateSelectionLabel('Not selected', null);
                    }
                } else {
                    showCartMessage('Unable to place order. Please try again.', true);
                }
            },
            error: function(xhr) {
                var message = 'Unable to place order. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.error_messages) {
                    message = xhr.responseJSON.error_messages.join(' ');
                }
                showCartMessage(message, true);
            },
            complete: function() {
                isSubmittingOrder = false;
                updateCartUI();
            }
        });
    }

    $(document).on('click', '.place-order-btn', function() {
        var selectionValue = pendingSelection;
        if (!selectionValue && fixedTableSelection) {
            selectionValue = fixedTableSelection.value;
        }
        submitOrderWithSelection(selectionValue);
    });

    // ── Orders Modal Logic ────────────────────────────────
    function fetchAndDisplayOrders() {
        var ordersUrl = getOrdersUrl();
        if (!ordersUrl) return;

        var params = {};
        var ids = getStoredOrderIds();
        if (ids.length > 0) {
            params.transaction_ids = ids;
        }
        var dataEl = getCartDataElement();
        var tableId = dataEl ? dataEl.getAttribute('data-table-id') : '';
        if (tableId) {
            params.table_id = tableId;
        }

        if (!ids.length && !tableId) {
            $('.catalogue-orders-empty').removeClass('d-none');
            $('.catalogue-orders-grand-total').addClass('d-none');
            $('.catalogue-orders-list').empty();
            return;
        }

        $('.catalogue-orders-loading').removeClass('d-none');
        $('.catalogue-orders-empty').addClass('d-none');
        $('.catalogue-orders-grand-total').addClass('d-none');
        $('.catalogue-orders-list').empty();

        $.ajax({
            method: 'GET',
            url: ordersUrl,
            data: params,
            success: function(response) {
                $('.catalogue-orders-loading').addClass('d-none');
                var orders = response.orders || [];
                if (orders.length === 0) {
                    $('.catalogue-orders-empty').removeClass('d-none');
                    $('.catalogue-orders-grand-total').addClass('d-none');
                    return;
                }

                var $list = $('.catalogue-orders-list');
                orders.forEach(function(order) {
                    var subStatusLabel = order.sub_status === 'table_order_bill'
                        ? '<?php echo app('translator')->get("productcatalogue::lang.table_order_bill"); ?>'
                        : '<?php echo app('translator')->get("productcatalogue::lang.table_order"); ?>';
                    var subStatusClass = order.sub_status === 'table_order_bill'
                        ? 'badge-table-order-bill' : 'badge-table-order';

                    var kitchenHtml = '';
                    if (order.res_order_status) {
                        var kitchenLabel = order.res_order_status;
                        var kitchenClass = 'badge-kitchen-received';
                        if (order.res_order_status === 'cooked') {
                            kitchenLabel = '<?php echo app('translator')->get("productcatalogue::lang.order_cooked"); ?>';
                            kitchenClass = 'badge-kitchen-cooked';
                        } else if (order.res_order_status === 'served') {
                            kitchenLabel = '<?php echo app('translator')->get("productcatalogue::lang.order_served"); ?>';
                            kitchenClass = 'badge-kitchen-served';
                        } else {
                            kitchenLabel = '<?php echo app('translator')->get("productcatalogue::lang.order_received"); ?>';
                        }
                        kitchenHtml = ' <span class="badge badge-kitchen-status ' + kitchenClass + '">'
                            + '<i class="fas fa-utensils me-1"></i>' + kitchenLabel + '</span>';
                    }

                    var tableHtml = '';
                    if (order.table_name) {
                        tableHtml = '<div class="text-muted small mb-1"><i class="fas fa-chair me-1"></i>' + $('<span>').text(order.table_name).html() + '</div>';
                    }

                    var itemsHtml = '';
                    if (order.items && order.items.length > 0) {
                        order.items.forEach(function(item) {
                            var itemName = item.product_name || '';
                            if (item.variation_name && item.variation_name !== 'DUMMY') {
                                itemName += ' (' + item.variation_name + ')';
                            }
                            itemsHtml += '<div class="catalogue-order-item-row">'
                                + '<span>' + $('<span>').text(itemName).html() + ' &times; ' + item.quantity + '</span>'
                                + '<span class="display_currency" data-currency_symbol="true">' + (item.quantity * item.unit_price) + '</span>'
                                + '</div>';
                        });
                    }

                    var card = '<div class="catalogue-order-card">'
                        + '<div class="catalogue-order-header">'
                        + '<span class="catalogue-order-number"><?php echo app('translator')->get("productcatalogue::lang.order_number"); ?>' + (order.invoice_no || order.ref_no || order.id) + '</span>'
                        + '<div>'
                        + '<span class="badge catalogue-order-status-badge ' + subStatusClass + '">' + subStatusLabel + '</span>'
                        + kitchenHtml
                        + '</div>'
                        + '</div>'
                        + tableHtml
                        + '<div class="catalogue-order-items">' + itemsHtml + '</div>'
                        + '<div class="catalogue-order-total">'
                        + '<?php echo app('translator')->get("productcatalogue::lang.order_total_label"); ?>: <span class="display_currency" data-currency_symbol="true">' + order.final_total + '</span>'
                        + '</div>'
                        + '</div>';
                    $list.append(card);
                });

                // Calculate and display grand total
                var grandTotal = 0;
                orders.forEach(function(order) {
                    grandTotal += parseFloat(order.final_total) || 0;
                });
                $('.catalogue-orders-grand-total-value').text(grandTotal.toFixed(__currency_precision));
                $('.catalogue-orders-grand-total').removeClass('d-none');

                __currency_convert_recursively($('#catalogueOrdersModal'));
            },
            error: function() {
                $('.catalogue-orders-loading').addClass('d-none');
                $('.catalogue-orders-empty').removeClass('d-none');
                $('.catalogue-orders-grand-total').addClass('d-none');
            }
        });
    }

    var ordersModalEl = document.getElementById('catalogueOrdersModal');
    if (ordersModalEl) {
        ordersModalEl.addEventListener('show.bs.modal', function() {
            fetchAndDisplayOrders();
        });
    }

    $(document).on('click', '#refreshOrdersBtn', function() {
        fetchAndDisplayOrders();
    });

    })(jQuery);

    $(window).scroll(function() {
        var height = $(window).scrollTop();

        if(height > 180) {
            $('#catalogue-nav').addClass('navbar-fixed-top');
            $('.scrolltop:hidden').stop(true, true).fadeIn();
        } else {
            $('#catalogue-nav').removeClass('navbar-fixed-top');
            $('.scrolltop').stop(true, true).fadeOut();
        }
    });

    $(document).on('click', '.scroll', function(e){
        $("html,body").animate({scrollTop:$("#top").offset().top},"1000");
        return false;
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
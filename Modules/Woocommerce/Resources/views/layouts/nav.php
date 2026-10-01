<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'index']), false); ?>"><i class="fab fa-wordpress me-2"></i><?php echo e(__('woocommerce::lang.woocommerce'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#woocommerce-navbar" aria-controls="woocommerce-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="woocommerce-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'woocommerce' && request()->segment(2) == 'view-sync-log'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'viewSyncLog']), false); ?>"><?php echo app('translator')->get('woocommerce::lang.sync_log'); ?></a>
                    </li>

                    <?php if(auth()->user()->can('woocommerce.access_woocommerce_api_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'woocommerce' && request()->segment(2) == 'api-settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'apiSettings']), false); ?>"><?php echo app('translator')->get('woocommerce::lang.api_settings'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>

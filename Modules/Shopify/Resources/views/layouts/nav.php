<section class="no-print">
    <nav class="navbar navbar-default bg-white m-4">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#shopify-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyDashboardController::class, 'index']), false); ?>">
                    <i class="fab fa-shopify"></i> Shopify
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="shopify-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if(request()->segment(1) == 'shopify' && empty(request()->segment(2))): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyDashboardController::class, 'index']), false); ?>">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li <?php if(request()->segment(1) == 'shopify' && request()->segment(2) == 'connections'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyConnectionController::class, 'index']), false); ?>">
                            <i class="fa fa-plug"></i> Connections
                        </a>
                    </li>
                    <li <?php if(request()->segment(1) == 'shopify' && request()->segment(2) == 'sync-log'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyDashboardController::class, 'syncLog']), false); ?>">
                            <i class="fa fa-history"></i> Sync Log
                        </a>
                    </li>
                    <li <?php if(request()->segment(1) == 'shopify' && request()->segment(2) == 'products'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(url('shopify/products'), false); ?>">
                            <i class="fa fa-shopping-bag"></i> Products
                        </a>
                    </li>
                    <li <?php if(request()->segment(1) == 'shopify' && request()->segment(2) == 'orders'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(url('shopify/orders'), false); ?>">
                            <i class="fa fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    <li <?php if(request()->segment(1) == 'shopify' && request()->segment(2) == 'customers'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(url('shopify/customers'), false); ?>">
                            <i class="fa fa-users"></i> Customers
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>

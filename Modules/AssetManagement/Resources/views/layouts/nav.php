<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-3 m-3 border shadow-sm px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetController::class, 'dashboard']), false); ?>">
                	<i class="fas fa-boxes me-2"></i><?php echo e(__('assetmanagement::lang.asset_management'), false); ?>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#asset-navbar" aria-controls="asset-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="asset-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset.view')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'assets'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('assetmanagement::lang.assets'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'allocation'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetAllocationController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('assetmanagement::lang.asset_allocated'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'revocation'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\RevokeAllocatedAssetController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('assetmanagement::lang.revoked_asset'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('asset.view_all_maintenance') || auth()->user()->can('asset.view_own_maintenance')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'maintenance'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetMaitenanceController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('assetmanagement::lang.asset_maintenance'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('only_admin')): ?>
                    <li class="nav-item">
                    	<a class="nav-link <?php if(request()->get('type') == 'asset'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=asset', false); ?>">
                    		<?php echo app('translator')->get('assetmanagement::lang.asset_categories'); ?>
                    	</a>
                   	</li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetSettingsController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('role.settings'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
</section>

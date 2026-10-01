<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white m-4 shadow-sm">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']), false); ?>">
                <i class="fa fas fa-users-cog"></i> <?php echo e(__('superadmin::lang.superadmin'), false); ?>

            </a>
            
            <!-- Toggle button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#superadminNavbar" aria-controls="superadminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation links -->
            <div class="collapse navbar-collapse" id="superadminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'business'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.all_business'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'superadmin-subscription'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.subscription'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'packages'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.subscription_packages'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'coupons'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.all_coupons'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class, 'edit']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'communicator'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('superadmin::lang.communicator'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>

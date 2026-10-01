<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3" style="border-radius: 10px;">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Hms\Http\Controllers\HmsController::class, 'index']), false); ?>"><i class="fas fa-hotel me-2"></i><?php echo app('translator')->get('hms::lang.hms'); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hms-navbar" aria-controls="hms-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="hms-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_rooms')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'rooms'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\RoomController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.rooms'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_price')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'room' && request()->segment(3) == 'pricing'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\RoomController::class, 'pricing']), false); ?>"><?php echo app('translator')->get('hms::lang.prices'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.add_booking')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'bookings'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.bookings'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'calendar'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'calendar']), false); ?>"><?php echo app('translator')->get('hms::lang.calendar'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_extra')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'extras'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\ExtraController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.extras'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_unavailable')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'unavailables'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\UnavailableController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.unavailable'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_coupon')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'coupons'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsCouponController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.coupons'); ?></a>
                    </li>
                <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'reports'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsReportController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.reports'); ?></a>
                    </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_rooms')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'housekeeping'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HousekeepingController::class, 'index']), false); ?>"><?php echo app('translator')->get('hms::lang.housekeeping'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_amenities')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->get('type') == 'amenities'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=amenities', false); ?>"><?php echo app('translator')->get('hms::lang.amenities'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.manage_settings')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'hms' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsSettingController::class, 'index']), false); ?>"><?php echo app('translator')->get('messages.settings'); ?></a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>

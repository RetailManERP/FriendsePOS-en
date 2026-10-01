<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light tw-transition-all tw-duration-5000 tw-shrink-0 tw-rounded-2xl tw-m-[16px] tw-border-2 !tw-bg-white shadow-sm px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Gym\Http\Controllers\DashBoardController::class, 'index']), false); ?>"><i class="fas fa-dumbbell me-2"></i><?php echo app('translator')->get('gym::lang.gym'); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#gym-navbar" aria-controls="gym-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="gym-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_member')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'members'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\MemberController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.members'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_subscription')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'subscriptions'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\SubscriptionController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.subscriptions'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_attendance')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'attendance'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\AttendanceController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.attendance'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'attendance-report'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\AttendanceController::class, 'AttendanceReport']), false); ?>"><?php echo app('translator')->get('gym::lang.attendance_report'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_package')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'gym-packages'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\PackageController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.packages'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_class')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'classes'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\ClassController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.classes'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_setting')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'gym' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([Modules\Gym\Http\Controllers\SettingController::class, 'index']), false); ?>"><?php echo app('translator')->get('gym::lang.settings'); ?></a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>


<?php $__env->startSection('title', __('essentials::lang.hrm')); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/hrm-dashboard.css?v=' . $asset_v), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">

    
    <div class="hrm-dash-header">
        <div class="row align-items-center">
            <div class="col-md-6 col-12">
                <?php
                    $hour = (int) date('H');
                    $greeting = $hour < 12 ? __('essentials::lang.good_morning') : ($hour < 17 ? __('essentials::lang.good_afternoon') : __('essentials::lang.good_evening'));
                ?>
                <h2 class="hrm-greeting"><i class="fas fa-hand-peace"></i> <?php echo e($greeting, false); ?>, <?php echo e(auth()->user()->first_name, false); ?>!</h2>
                <p class="hrm-greeting-sub">
                    <i class="fas fa-calendar-alt"></i> <?php echo e(\Carbon::now()->format('l, F j, Y'), false); ?>

                    &nbsp;&bull;&nbsp;
                    <i class="fas fa-building"></i> <?php echo app('translator')->get('essentials::lang.hrm_dashboard'); ?>
                </p>
            </div>
            <div class="col-md-6 col-12 text-right">
                <div class="hrm-header-actions">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                        <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'index']), false); ?>" class="btn btn-sm btn-light"><i class="fas fa-user-clock"></i> <?php echo app('translator')->get('essentials::lang.attendance'); ?></a>
                    <?php endif; ?>
                    <?php if($can_view_all_leave): ?>
                        <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsLeaveController::class, 'index']), false); ?>" class="btn btn-sm btn-light">
                            <i class="fas fa-sign-out-alt"></i> <?php echo app('translator')->get('essentials::lang.leave'); ?>
                            <?php if($pending_leaves_count > 0): ?>
                                <span class="badge bg-danger ms-1"><?php echo e($pending_leaves_count, false); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index']), false); ?>" class="btn btn-sm btn-light"><i class="fas fa-coins"></i> <?php echo app('translator')->get('essentials::lang.payroll'); ?></a>
                </div>
            </div>
        </div>
    </div>

    
    <?php if($is_admin): ?>
    <div class="row hrm-kpi-row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="hrm-kpi-card kpi-employees">
                <div class="kpi-icon"><i class="fas fa-users"></i></div>
                <div class="kpi-info">
                    <h3><?php echo e($total_employees, false); ?></h3>
                    <span><?php echo app('translator')->get('essentials::lang.total_employees'); ?></span>
                </div>
                <div class="kpi-footer">
                    <small><i class="fas fa-sitemap"></i> <?php echo e($departments->count(), false); ?> <?php echo app('translator')->get('essentials::lang.departments'); ?></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="hrm-kpi-card kpi-present">
                <div class="kpi-icon"><i class="fas fa-user-check"></i></div>
                <div class="kpi-info">
                    <h3><?php echo e($todays_attendances->pluck('user_id')->unique()->count(), false); ?></h3>
                    <span><?php echo app('translator')->get('essentials::lang.present_today'); ?></span>
                </div>
                <div class="kpi-footer">
                    <small><i class="fas fa-clock"></i> <?php echo e($clocked_in_count, false); ?> <?php echo app('translator')->get('essentials::lang.still_working'); ?></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="hrm-kpi-card kpi-leave">
                <div class="kpi-icon"><i class="fas fa-user-minus"></i></div>
                <div class="kpi-info">
                    <h3><?php echo e(count($todays_leaves), false); ?></h3>
                    <span><?php echo app('translator')->get('essentials::lang.on_leave_today'); ?></span>
                </div>
                <div class="kpi-footer">
                    <small><i class="fas fa-hourglass-half"></i> <?php echo e($pending_leaves_count, false); ?> <?php echo app('translator')->get('essentials::lang.pending_requests'); ?></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="hrm-kpi-card kpi-absent">
                <div class="kpi-icon"><i class="fas fa-user-times"></i></div>
                <div class="kpi-info">
                    <h3><?php echo e($not_clocked_in_count, false); ?></h3>
                    <span><?php echo app('translator')->get('essentials::lang.not_clocked_in'); ?></span>
                </div>
                <div class="kpi-footer">
                    <?php if($total_employees > 0): ?>
                        <small>
                            <i class="fas fa-chart-pie"></i>
                            <?php echo e($total_employees > 0 ? round(($not_clocked_in_count / $total_employees) * 100) : 0, false); ?>% <?php echo app('translator')->get('essentials::lang.of_workforce'); ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="row">

        
        <?php if($is_admin): ?>
        <div class="col-lg-8 col-md-12">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-chart-area text-primary"></i> <?php echo app('translator')->get('essentials::lang.attendance_trend'); ?></h4>
                    <span class="hrm-badge badge-info"><?php echo app('translator')->get('essentials::lang.last_7_days'); ?></span>
                </div>
                <div class="hrm-card-body">
                    <canvas id="attendanceTrendChart" height="80"></canvas>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if($is_admin && count($department_chart_data) > 0): ?>
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-sitemap text-info"></i> <?php echo app('translator')->get('essentials::lang.department_distribution'); ?></h4>
                </div>
                <div class="hrm-card-body text-center">
                    <canvas id="departmentChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if(!$is_admin): ?>
        <?php if($can_view_own_leave): ?>
        <div class="col-md-6 col-12">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-sign-out-alt text-warning"></i> <?php echo app('translator')->get('essentials::lang.my_leaves'); ?></h4>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <table class="table table-sm table-hover mb-0">
                        <?php $__empty_18 = true; $__currentLoopData = $users_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <i class="fas fa-calendar-day text-muted"></i>
                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($user_leave->start_date))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($user_leave->end_date))->format(session('business.date_format')), false); ?>

                                </td>
                                <td><span class="badge bg-info"><?php echo e($user_leave->leave_type->leave_type, false); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td class="text-center text-muted py-3"><i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('essentials::lang.no_upcoming_leaves'); ?></td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="<?php echo e($can_view_own_leave ? 'col-md-6' : 'col-md-12', false); ?> col-12">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-bullseye text-success"></i> <?php echo app('translator')->get('essentials::lang.my_sales_targets'); ?></h4>
                </div>
                <div class="hrm-card-body">
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <small class="text-muted text-uppercase"><?php echo app('translator')->get('essentials::lang.last_month'); ?></small>
                            <h4 class="text-success mb-0"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $target_achieved_last_month, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        </div>
                        <div class="col-6">
                            <small class="text-muted text-uppercase"><?php echo app('translator')->get('essentials::lang.this_month'); ?></small>
                            <h4 class="text-primary mb-0"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $target_achieved_this_month, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        </div>
                    </div>
                    <table class="table table-sm table-hover mb-0">
                        <thead><tr><th><?php echo app('translator')->get('essentials::lang.targets'); ?></th><th><?php echo app('translator')->get('essentials::lang.commission_percent'); ?></th></tr></thead>
                        <?php $__empty_18 = true; $__currentLoopData = $sales_targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $target->target_start, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> - <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $target->target_end, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                <td><span class="badge bg-success"><?php echo e(number_format($target->commission_percent, 2), false); ?>%</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="2" class="text-center text-muted"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <?php if($is_admin): ?>
    <div class="row">
        
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-user-check text-success"></i> <?php echo app('translator')->get('essentials::lang.todays_attendance'); ?></h4>
                    <span class="hrm-badge badge-success"><?php echo e($todays_attendances->count(), false); ?></span>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.clock_in'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.clock_out'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $todays_attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td>
                                        <i class="fas fa-circle <?php echo e(empty($attendance->clock_out_time) ? 'text-success' : 'text-muted', false); ?>" style="font-size: 8px;"></i>
                                        <?php echo e($attendance->employee->user_full_name ?? '', false); ?>

                                    </td>
                                    <td><small><?php echo e(\Carbon::parse($attendance->clock_in_time)->format('h:i A'), false); ?></small></td>
                                    <td>
                                        <?php if(!empty($attendance->clock_out_time)): ?>
                                            <small><?php echo e(\Carbon::parse($attendance->clock_out_time)->format('h:i A'), false); ?></small>
                                        <?php else: ?>
                                            <span class="badge bg-success" style="font-size:10px;"><?php echo app('translator')->get('essentials::lang.working'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="3" class="text-center text-muted py-3"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-user-minus text-warning"></i> <?php echo app('translator')->get('essentials::lang.leave_overview'); ?></h4>
                    <?php if($pending_leaves_count > 0): ?>
                        <span class="hrm-badge badge-danger"><?php echo e($pending_leaves_count, false); ?> <?php echo app('translator')->get('essentials::lang.pending'); ?></span>
                    <?php endif; ?>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <h6 class="hrm-section-title"><i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('home.today'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $todays_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-warning-light"><i class="fas fa-user"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($leave->user->user_full_name ?? '', false); ?></strong>
                                <small class="text-muted d-block"><?php echo e($leave->leave_type->leave_type ?? '', false); ?> &bull; <?php echo e(\Carbon::createFromTimestamp(strtotime($leave->start_date))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($leave->end_date))->format(session('business.date_format')), false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('essentials::lang.no_leaves_today'); ?></small></p>
                    <?php endif; ?>

                    <hr class="my-2">
                    <h6 class="hrm-section-title"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('lang_v1.upcoming'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $upcoming_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-info-light"><i class="fas fa-user"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($leave->user->user_full_name ?? '', false); ?></strong>
                                <small class="text-muted d-block"><?php echo e($leave->leave_type->leave_type ?? '', false); ?> &bull; <?php echo e(\Carbon::createFromTimestamp(strtotime($leave->start_date))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($leave->end_date))->format(session('business.date_format')), false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('lang_v1.no_data'); ?></small></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-umbrella-beach text-info"></i> <?php echo app('translator')->get('essentials::lang.holidays'); ?></h4>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <h6 class="hrm-section-title"><i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('home.today'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $todays_holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <?php
                            $diff = \Carbon::parse($holiday->start_date)->diffInDays(\Carbon::parse($holiday->end_date)) + 1;
                        ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-info-light"><i class="fas fa-gift"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($holiday->name, false); ?></strong>
                                <small class="text-muted d-block"><?php echo e(\Carbon::createFromTimestamp(strtotime($holiday->start_date))->format(session('business.date_format')), false); ?> (<?php echo e($diff, false); ?> <?php echo e(Str::plural(__('lang_v1.day'), $diff), false); ?>) &bull; <?php echo e($holiday->location->name ?? __('lang_v1.all'), false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('essentials::lang.no_holidays_today'); ?></small></p>
                    <?php endif; ?>

                    <hr class="my-2">
                    <h6 class="hrm-section-title"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('lang_v1.upcoming'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $upcoming_holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <?php
                            $diff = \Carbon::parse($holiday->start_date)->diffInDays(\Carbon::parse($holiday->end_date)) + 1;
                        ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-purple-light"><i class="fas fa-gift"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($holiday->name, false); ?></strong>
                                <small class="text-muted d-block"><?php echo e(\Carbon::createFromTimestamp(strtotime($holiday->start_date))->format(session('business.date_format')), false); ?> (<?php echo e($diff, false); ?> <?php echo e(Str::plural(__('lang_v1.day'), $diff), false); ?>) &bull; <?php echo e($holiday->location->name ?? __('lang_v1.all'), false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('lang_v1.no_data'); ?></small></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        
        <div class="row">
            <?php if($can_view_holidays): ?>
                <?php echo $__env->make('essentials::dashboard.holidays', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php echo $__env->make('essentials::dashboard.birthdays', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-4 col-12 text-center d-flex align-items-center justify-content-center">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getMyPayrolls']), false); ?>" class="btn btn-lg btn-success shadow">
                    <i class="fas fa-coins"></i> <?php echo app('translator')->get('essentials::lang.my_payrolls'); ?>
                </a>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row">
        
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-bullhorn text-primary"></i> <?php echo app('translator')->get('essentials::lang.active_announcements'); ?></h4>
                    <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AnnouncementController::class, 'index']), false); ?>" class="btn btn-xs btn-outline-primary"><?php echo app('translator')->get('essentials::lang.view_all'); ?></a>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <?php $__empty_18 = true; $__currentLoopData = $active_announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="hrm-announcement-item">
                            <div class="announcement-title">
                                <i class="fas fa-megaphone text-primary" style="font-size: 11px;"></i>
                                <strong><?php echo e($announcement->title, false); ?></strong>
                            </div>
                            <p class="announcement-desc mb-1"><?php echo e(\Illuminate\Support\Str::limit($announcement->description, 100), false); ?></p>
                            <small class="text-muted"><i class="fas fa-clock"></i> <?php echo e(\Carbon::createFromTimestamp(strtotime($announcement->start_date))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($announcement->end_date))->format(session('business.date_format')), false); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-bullhorn" style="font-size: 28px; opacity: 0.3;"></i>
                            <p class="mt-2"><?php echo app('translator')->get('essentials::lang.no_announcements'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if($is_admin): ?>
        <div class="col-lg-4 col-md-6">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-birthday-cake text-pink"></i> <?php echo app('translator')->get('essentials::lang.birthdays'); ?></h4>
                </div>
                <div class="hrm-card-body hrm-card-scroll">
                    <h6 class="hrm-section-title"><i class="fas fa-gift"></i> <?php echo app('translator')->get('home.today'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $today_births; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-pink-light"><i class="fas fa-birthday-cake"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($birthday->surname, false); ?> <?php echo e($birthday->first_name, false); ?> <?php echo e($birthday->last_name, false); ?></strong>
                                <small class="text-muted d-block">🎉 <?php echo app('translator')->get('essentials::lang.happy_birthday'); ?>!</small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('essentials::lang.no_birthdays_today'); ?></small></p>
                    <?php endif; ?>

                    <hr class="my-2">
                    <h6 class="hrm-section-title"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('lang_v1.upcoming'); ?></h6>
                    <?php $__empty_18 = true; $__currentLoopData = $up_comming_births; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar bg-purple-light"><i class="fas fa-user"></i></div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($birthday->surname, false); ?> <?php echo e($birthday->first_name, false); ?> <?php echo e($birthday->last_name, false); ?></strong>
                                <small class="text-muted d-block">
                                    <?php if(date('m') == '12' && \Carbon::parse($birthday->dob)->format('m') == '1'): ?>
                                        <?php echo e(\Carbon::createFromTimestamp(strtotime(\Carbon::parse($birthday->dob)->setYear(date('Y') + 1)))->format(session('business.date_format')), false); ?>

                                    <?php else: ?>
                                        <?php echo e(\Carbon::createFromTimestamp(strtotime(\Carbon::parse($birthday->dob)->setYear(date('Y'))))->format(session('business.date_format')), false); ?>

                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <p class="text-muted text-center py-2"><small><?php echo app('translator')->get('lang_v1.no_data'); ?></small></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="col-lg-4 col-md-6">
            <?php if($is_admin): ?>
            <div class="hrm-card mb-3">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-chart-bar text-success"></i> <?php echo app('translator')->get('essentials::lang.hrm_quick_stats'); ?></h4>
                </div>
                <div class="hrm-card-body">
                    <div class="row">
                        <div class="col-6 text-center hrm-stat-box">
                            <div class="stat-icon bg-warning-light"><i class="fas fa-exclamation-triangle text-warning"></i></div>
                            <h3><?php echo e($recent_warnings_count, false); ?></h3>
                            <small class="text-muted"><?php echo app('translator')->get('essentials::lang.active_warnings'); ?></small>
                            <div class="mt-1"><a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\WarningController::class, 'index']), false); ?>" class="btn btn-xs btn-outline-warning"><?php echo app('translator')->get('essentials::lang.view_all'); ?></a></div>
                        </div>
                        <div class="col-6 text-center hrm-stat-box">
                            <div class="stat-icon bg-success-light"><i class="fas fa-trophy text-success"></i></div>
                            <h3><?php echo e($recent_awards_count, false); ?></h3>
                            <small class="text-muted"><?php echo app('translator')->get('essentials::lang.awards_this_month'); ?></small>
                            <div class="mt-1"><a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AwardController::class, 'index']), false); ?>" class="btn btn-xs btn-outline-success"><?php echo app('translator')->get('essentials::lang.view_all'); ?></a></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php if($expiring_documents->count() > 0): ?>
            <div class="hrm-card hrm-card-alert">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-exclamation-circle text-danger"></i> <?php echo app('translator')->get('essentials::lang.expiring_documents'); ?></h4>
                    <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'index']), false); ?>" class="btn btn-xs btn-outline-danger"><?php echo app('translator')->get('essentials::lang.view_all'); ?></a>
                </div>
                <div class="hrm-card-body hrm-card-scroll-sm">
                    <?php $__currentLoopData = $expiring_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $days_left = \Carbon\Carbon::parse($doc->expiry_date)->diffInDays(now());
                        ?>
                        <div class="hrm-list-item">
                            <div class="hrm-list-avatar <?php echo e($days_left <= 7 ? 'bg-danger-light' : 'bg-warning-light', false); ?>">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="hrm-list-content">
                                <strong><?php echo e($doc->document_name, false); ?></strong>
                                <small class="text-muted d-block"><?php echo e($doc->employee->user_full_name ?? '', false); ?></small>
                                <small class="<?php echo e($days_left <= 7 ? 'text-danger' : 'text-warning', false); ?>">
                                    <i class="fas fa-clock"></i>
                                    <?php echo e($days_left, false); ?> <?php echo e(Str::plural(__('lang_v1.day'), $days_left), false); ?> <?php echo app('translator')->get('essentials::lang.remaining'); ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php else: ?>
            
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-trophy text-success"></i> <?php echo app('translator')->get('essentials::lang.my_awards'); ?></h4>
                </div>
                <div class="hrm-card-body text-center py-4">
                    <div class="stat-icon bg-success-light mx-auto"><i class="fas fa-trophy text-success"></i></div>
                    <h3><?php echo e($recent_awards_count, false); ?></h3>
                    <small class="text-muted"><?php echo app('translator')->get('essentials::lang.total_awards'); ?></small>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($is_admin): ?>
    <div class="row">
        <div class="col-12">
            <div class="hrm-card">
                <div class="hrm-card-header">
                    <h4><i class="fas fa-bullseye text-purple"></i> <?php echo app('translator')->get('essentials::lang.sales_targets'); ?></h4>
                </div>
                <div class="hrm-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="sales_targets_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('report.user'); ?></th>
                                    <th><?php echo app('translator')->get('essentials::lang.target_achieved_last_month'); ?></th>
                                    <th><?php echo app('translator')->get('essentials::lang.target_achieved_this_month'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    // Sales targets DataTable (admin)
    if ($('#sales_targets_table').length) {
        $('#sales_targets_table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            dom: 'Btirp',
            fixedHeader: false,
            ajax: "<?php echo e(action([\Modules\Essentials\Http\Controllers\DashboardController::class, 'getUserSalesTargets']), false); ?>"
        });
    }

    <?php if($is_admin && count($attendance_trend) > 0): ?>
    // Attendance Trend Chart
    var trendCtx = document.getElementById('attendanceTrendChart');
    if (trendCtx) {
        new Chart(trendCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_column($attendance_trend, 'full_date')); ?>,
                datasets: [{
                    label: '<?php echo app('translator')->get("essentials::lang.employees_present"); ?>',
                    data: <?php echo json_encode(array_column($attendance_trend, 'count')); ?>,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#32325d',
                        titleFont: { size: 13 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: { font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }
    <?php endif; ?>

    <?php if($is_admin && count($department_chart_data) > 0): ?>
    // Department Distribution Chart
    var deptCtx = document.getElementById('departmentChart');
    if (deptCtx) {
        var deptColors = ['#667eea', '#764ba2', '#11998e', '#38ef7d', '#f093fb', '#f5576c', '#4facfe', '#fa709a', '#fee140', '#a18cd1', '#fbc2eb', '#00f2fe'];
        new Chart(deptCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($department_chart_data, 'name')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($department_chart_data, 'count')); ?>,
                    backgroundColor: deptColors.slice(0, <?php echo e(count($department_chart_data), false); ?>),
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 12, font: { size: 11 }, usePointStyle: true, pointStyle: 'circle' }
                    }
                }
            }
        });
    }
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
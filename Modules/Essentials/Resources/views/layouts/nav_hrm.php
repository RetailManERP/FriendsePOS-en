<?php
    $can_view_employee_documents = auth()->user()->can('essentials.view_employee_documents') || auth()->user()->can('essentials.manage_employee_documents');
    $can_view_warnings = auth()->user()->can('essentials.view_warnings') || auth()->user()->can('essentials.manage_warnings');
    $can_view_awards = auth()->user()->can('essentials.view_awards') || auth()->user()->can('essentials.manage_awards');
    $can_view_announcements = auth()->user()->can('essentials.view_announcements') || auth()->user()->can('essentials.manage_announcements');
    $can_view_leave_quotas = auth()->user()->can('essentials.view_leave_quotas') || auth()->user()->can('essentials.manage_leave_quotas');
    $can_view_employees_list = auth()->user()->can('user.view') || auth()->user()->can('user.create') || auth()->user()->can('user.create_employee');
    $can_view_more_hrm = $can_view_employee_documents || $can_view_warnings || $can_view_awards || $can_view_announcements || $can_view_leave_quotas || $can_view_employees_list;
?>

<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\DashboardController::class, 'hrmDashboard']), false); ?>"><i class="fa fas fa-users me-2"></i><?php echo e(__('essentials::lang.hrm'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hrm-navbar" aria-controls="hrm-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="hrm-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_leave_type')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'leave-type'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.leave_type'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('essentials.crud_all_leave') || auth()->user()->can('essentials.crud_own_leave') || auth()->user()->can('essentials.approve_leave')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'leave'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsLeaveController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.leave'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('essentials.crud_all_attendance') || auth()->user()->can('essentials.view_own_attendance')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'attendance'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.attendance'); ?></a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'payroll'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.payroll'); ?></a>
                    </li>

                    <?php if(auth()->user()->can('essentials.view_holidays') || auth()->user()->can('essentials.manage_holidays')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'holiday'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsHolidayController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.holiday'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_department')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->get('type') == 'hrm_department'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=hrm_department', false); ?>"><?php echo app('translator')->get('essentials::lang.departments'); ?></a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_designation')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->get('type') == 'hrm_designation'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=hrm_designation', false); ?>"><?php echo app('translator')->get('essentials::lang.designations'); ?></a>
                    </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('essentials.access_sales_target')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'hrm' && request()->segment(2) == 'sales-target'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\SalesTargetController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.sales_target'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if($can_view_more_hrm): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if(request()->segment(1) == 'users' || in_array(request()->segment(2), ['employee-documents', 'warnings', 'awards', 'announcements', 'leave-quotas'])): ?> active <?php endif; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i> <?php echo app('translator')->get('essentials::lang.more'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if($can_view_employee_documents): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(2) == 'employee-documents'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'index']), false); ?>">
                                            <i class="fas fa-file-alt me-1"></i> <?php echo app('translator')->get('essentials::lang.employee_documents'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($can_view_warnings): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(2) == 'warnings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\WarningController::class, 'index']), false); ?>">
                                            <i class="fas fa-exclamation-triangle me-1"></i> <?php echo app('translator')->get('essentials::lang.warnings'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($can_view_awards): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(2) == 'awards'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AwardController::class, 'index']), false); ?>">
                                            <i class="fas fa-trophy me-1"></i> <?php echo app('translator')->get('essentials::lang.awards'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($can_view_announcements): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(2) == 'announcements'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AnnouncementController::class, 'index']), false); ?>">
                                            <i class="fas fa-bullhorn me-1"></i> <?php echo app('translator')->get('essentials::lang.announcements'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($can_view_leave_quotas): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(2) == 'leave-quotas'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\LeaveQuotaController::class, 'index']), false); ?>">
                                            <i class="fas fa-calendar-check me-1"></i> <?php echo app('translator')->get('essentials::lang.leave_quotas'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($can_view_employees_list): ?>
                                    <li>
                                        <a class="dropdown-item <?php if(request()->segment(1) == 'users'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'index']), false); ?>">
                                            <i class="fas fa-users me-1"></i> <?php echo e(__('Employees List'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('edit_essentials_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'hrm' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsSettingsController::class, 'edit']), false); ?>"><?php echo app('translator')->get('business.settings'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>

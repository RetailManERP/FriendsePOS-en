<?php if($__is_essentials_enabled): ?>
<li class="bg-info treeview <?php echo e(in_array($request->segment(1), ['hrm']) ? 'active active-sub' : '', false); ?>">
    <a href="#">
        <i class="fa fa-users"></i>
        <span class="title"><?php echo app('translator')->get('essentials::lang.hrm'); ?></span>
        <span class="float-end-container">
            <i class="fa fa-angle-left float-end"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_leave_type')): ?>
            <li class="<?php echo e($request->segment(2) == 'leave-type' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController::class, 'index']), false); ?>">
                    <i class="fa fa-calendar-alt"></i>
                    <span class="title"><?php echo app('translator')->get('essentials::lang.leave_type'); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if(auth()->user()->can('essentials.crud_all_leave') || auth()->user()->can('essentials.crud_own_leave') || auth()->user()->can('essentials.approve_leave')): ?>
            <li class="<?php echo e($request->segment(2) == 'leave' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsLeaveController::class, 'index']), false); ?>">
                    <i class="fa fa-user-times"></i>
                    <span class="title"><?php echo app('translator')->get('essentials::lang.leave'); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('essentials.crud_all_attendance') || auth()->user()->can('essentials.view_own_attendance')): ?>
            <li class="<?php echo e($request->segment(2) == 'attendance' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'index']), false); ?>">
                    <i class="fa fa-clipboard-check"></i>
                    <span class="title"><?php echo app('translator')->get('essentials::lang.attendance'); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.add_allowance_and_deduction')): ?>
        <li class="<?php echo e($request->segment(2) == 'allowance-deduction' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController::class, 'index']), false); ?>">
                <i class="fa fa-balance-scale"></i>
                <span class="title"><?php echo app('translator')->get('essentials::lang.allowance_and_deduction'); ?></span>
            </a>
        </li>
        <?php endif; ?>
        <li class="<?php echo e($request->segment(2) == 'payroll' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index']), false); ?>">
                <i class="fa fa-wallet"></i>
                <span class="title"><?php echo app('translator')->get('essentials::lang.payroll'); ?></span>
            </a>
        </li>
        <?php if(auth()->user()->can('essentials.view_holidays') || auth()->user()->can('essentials.manage_holidays')): ?>
            <li class="<?php echo e($request->segment(2) == 'holiday' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsHolidayController::class, 'index']), false); ?>">
                    <i class="fa fa-umbrella-beach"></i>
                    <span class="title"><?php echo app('translator')->get('essentials::lang.holiday'); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_essentials_settings')): ?>
            <li class="<?php echo e($request->segment(2) == 'settings' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsSettingsController::class, 'edit']), false); ?>">
                    <i class="fa fa-cogs"></i>
                    <span class="title"><?php echo app('translator')->get('business.settings'); ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>

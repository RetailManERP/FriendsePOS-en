

<?php
    $action_url = action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'store']);
    $title = __( 'essentials::lang.add_payroll' );
    $subtitle = __( 'essentials::lang.add_payroll' );
    $submit_btn_text = __( 'messages.save' );
    $group_name = __('essentials::lang.payroll_for_month', ['date' => $month_name . ' ' . $year]);
    if ($action == 'edit') {
        $action_url = action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getUpdatePayrollGroup']);
        $title = __( 'essentials::lang.edit_payroll' );
        $subtitle = __( 'essentials::lang.edit_payroll' );
        $submit_btn_text = __( 'messages.update' );
    }
?>

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><?php echo e($subtitle, false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<?php echo Form::open(['url' => $action_url, 'method' => 'post', 'id' => 'add_payroll_form' ]); ?>

    <?php echo Form::hidden('transaction_date', $transaction_date); ?>

    <?php if($action == 'edit'): ?>
        <?php echo Form::hidden('payroll_group_id', $payroll_group->id); ?>

    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>
                                <?php echo $group_name; ?>

                            </h3>
                            <small>
                                <b><?php echo app('translator')->get('business.location'); ?></b> :
                                <?php if(!empty($location)): ?>
                                    <?php echo e($location->name, false); ?>

                                    <?php echo Form::hidden('location_id', $location->id); ?>

                                <?php else: ?>
                                    <?php echo e(__('report.all_locations'), false); ?>

                                    <?php echo Form::hidden('location_id', ''); ?>

                                <?php endif; ?>
                            </small>
                        </div>
                        <div class="<?php if($action == 'edit'): ?> col-md-3 <?php else: ?> col-md-4 <?php endif; ?>">
                            <?php echo Form::label('payroll_group_name', __( 'essentials::lang.payroll_group_name' ) . ':*'); ?>

                            <?php echo Form::text('payroll_group_name', !empty($payroll_group) ? $payroll_group->name : strip_tags($group_name), ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.payroll_group_name' ), 'required']); ?>

                        </div>
                        <div class="<?php if($action == 'edit'): ?> col-md-3 <?php else: ?> col-md-4 <?php endif; ?>">
                            <?php echo Form::label('payroll_group_status', __( 'sale.status' ) . ':*'); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.group_status_tooltip') . '"></i>';
                }
            ?>
                            <?php echo Form::select('payroll_group_status', ['draft' => __('sale.draft'), 'final' => __('sale.final')], !empty($payroll_group) ? $payroll_group->status : null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __( 'messages.please_select' )]); ?>

                            
                        </div>
                        <?php if($action == 'edit'): ?>
                        <div class="<?php if($action == 'edit'): ?> col-md-2 <?php else: ?> hide <?php endif; ?>">
                            <?php echo Form::label('recalculate', __( 'lang_v1.recalculate' ) . ':'); ?>

                            <br>
                            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEditPayrollGroup'], ['id' => $payroll_group->id]), false); ?>?recalculate=true" class="btn btn-warning" target="_self">
                                <i class="fas fa-sync" aria-hidden="true"></i>
                                <?php echo app('translator')->get('lang_v1.recalculate'); ?>
                            </a>
                            
                        </div>
                        <?php endif; ?>

                    </div><br><br>
                    <div id="payroll_table">
                        <?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee => $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($action != 'edit' || $recalculate) {
                                    $amount_per_unit_duration = (double)$payroll['essentials_salary'];
                                    $total_work_duration = 1;
                                    $duration_unit = __('lang_v1.month');

                                    $total_days_worked = (float)($payroll['total_days_worked'] ?? 0);
                                    $total_leaves = (float)($payroll['total_leaves'] ?? 0);
                                    $overtime_off_days = (float)($payroll['overtime_off_days'] ?? 0);
                                    $count_full_month = (int)($payroll['count_full_month'] ?? 0);
                                    $shift_id = $payroll['shift_id'] ?? null;
                                    $shift_holidays = $payroll['shift_holidays'] ?? [];
                                    $shift_hours = (float)($payroll['shift_hours'] ?? 8);
                                    if ($shift_hours <= 0) {
                                        $shift_hours = 8;
                                    }

                                    $days_in_month = \Carbon::parse($transaction_date)->daysInMonth;
                                    $date = \Carbon::parse($transaction_date);
                                    $startOfMonth = \Carbon::createFromDate($date->format('Y'), $date->format('m'), 1)->startOfDay();
                                    $endOfMonth = $startOfMonth->copy()->endOfMonth();
                                    $daysInMonth = \Carbon\CarbonPeriod::create($startOfMonth, $endOfMonth);

                                    $absent_days = 0;
                                    $absent_amount = 0;
                                    $off_days = 0;
                                    $overtime_value = 0;
                                    $undertime_value = 0;

                                    if ($total_days_worked == 0) {
                                        // SCENARIO 1: No attendance for the user
                                        if ($count_full_month == 1) {
                                            $days_in_month_calc = $days_in_month;
                                        } else {
                                            $days_in_month_calc = 26;
                                        }

                                        $days_worked = $days_in_month_calc;
                                        $total_work_duration = 1;
                                        $total = $amount_per_unit_duration;
                                        $absent_days = 0;
                                        $absent_amount = 0;
                                    } elseif (empty($shift_id)) {
                                        // SCENARIO 2: Attendance exists (WITHOUT shift assigned)
                                        if ($count_full_month == 1) {
                                            $days_in_month_calc = $days_in_month;
                                        } else {
                                            $days_in_month_calc = 26;
                                        }

                                        foreach ($daysInMonth as $day) {
                                            if ($day->format('l') == 'Sunday') {
                                                $off_days++;
                                            }
                                        }

                                        $effective_days_worked = $total_days_worked + $total_leaves;
                                        if ($effective_days_worked < $days_in_month_calc) {
                                            $absent_days = $days_in_month_calc - $effective_days_worked;
                                            $absent_amount = $absent_days * ($amount_per_unit_duration / $days_in_month_calc);
                                        }

                                        $days_worked = $total_days_worked + $total_leaves;
                                        $total_work_duration = $days_in_month_calc > 0 ? $days_worked / $days_in_month_calc : 1;
                                        $total = $amount_per_unit_duration;
                                    } else {
                                        // SCENARIO 3: Attendance exists (WITH shift assigned)
                                        if (!empty($shift_holidays)) {
                                            foreach ($daysInMonth as $day) {
                                                if (in_array($day->format('l'), $shift_holidays)) {
                                                    $off_days++;
                                                }
                                            }
                                        }

                                        if ($off_days > 0) {
                                            $days_in_month_calc = $days_in_month - $off_days;
                                        } else {
                                            $days_in_month_calc = $days_in_month;
                                        }

                                        $regular_days_worked = $total_days_worked - $overtime_off_days;
                                        $effective_days_worked = $regular_days_worked + $total_leaves;

                                        if ($effective_days_worked < $days_in_month_calc) {
                                            $absent_days = $days_in_month_calc - $effective_days_worked;
                                            $absent_amount = $absent_days * ($amount_per_unit_duration / $days_in_month_calc);
                                        }

                                        $rate_per_hour = ($days_in_month_calc > 0 && $shift_hours > 0)
                                            ? ($amount_per_unit_duration / $days_in_month_calc / $shift_hours)
                                            : 0;

                                        $overtime_value = $rate_per_hour * ($payroll['overtime'] ?? 0) * ($settings['overtime_multiplier'] ?? 1);
                                        $undertime_value = $rate_per_hour * ($payroll['undertime'] ?? 0) * ($settings['deduction_multiplier'] ?? 1);

                                        $days_worked = $effective_days_worked;
                                        $total_work_duration = $days_in_month_calc > 0 ? $days_worked / $days_in_month_calc : 1;
                                        $total = $amount_per_unit_duration;
                                    }

                                    if ($payroll['essentials_pay_period'] == 'week') {
                                        $duration_unit = __('essentials::lang.week');
                                        $total_work_duration = ($days_in_month_calc > 0) ? ($days_worked / ($days_in_month_calc / 4)) : 4;
                                        $total = $total_work_duration * $amount_per_unit_duration;
                                    } elseif ($payroll['essentials_pay_period'] == 'day') {
                                        $duration_unit = __('lang_v1.day');
                                        $total_work_duration = $days_worked;
                                        $total = $total_work_duration * $amount_per_unit_duration;
                                    }
                                } else {
                                    $amount_per_unit_duration = $payroll['essentials_amount_per_unit_duration'];
                                    $duration_unit = $payroll['essentials_duration_unit'];
                                    $payroll['total_leaves'] = $payroll['details']['leaves'] ?? 0;
                                    $payroll['total_days_worked'] = $payroll['details']['attendance_days'] ?? 0;
                                    $payroll['total_work_duration'] = $payroll['details']['work_duration'] ?? 0;
                                    $days_worked = $payroll['total_days_worked'];
                                    $days_in_month = \Carbon::parse($transaction_date)->daysInMonth;
                                    $count_full_month = (int)($payroll['count_full_month'] ?? 0);
                                    $shift_id = $payroll['shift_id'] ?? null;

                                    $date = \Carbon::parse($transaction_date);
                                    $startOfMonth = \Carbon::createFromDate($date->format('Y'), $date->format('m'), 1)->startOfDay();
                                    $endOfMonth = $startOfMonth->copy()->endOfMonth();
                                    $daysInMonth = \Carbon\CarbonPeriod::create($startOfMonth, $endOfMonth);

                                    $off_days = 0;
                                    if (!empty($shift_id)) {
                                        if (!empty($payroll['shift_holidays'])) {
                                            foreach ($daysInMonth as $day) {
                                                if (in_array($day->format('l'), $payroll['shift_holidays'])) {
                                                    $off_days++;
                                                }
                                            }
                                        }
                                        if ($off_days > 0) {
                                            $days_in_month_calc = $days_in_month - $off_days;
                                        } else {
                                            $days_in_month_calc = $days_in_month;
                                        }
                                    } else {
                                        foreach ($daysInMonth as $day) {
                                            if ($day->format('l') == 'Sunday') {
                                                $off_days++;
                                            }
                                        }
                                        if ($count_full_month == 1) {
                                            $days_in_month_calc = $days_in_month;
                                        } else {
                                            $days_in_month_calc = 26;
                                        }
                                    }

                                    $total_work_duration = $payroll['essentials_duration'] ?? ($days_in_month_calc > 0 ? $days_worked / $days_in_month_calc : 1);
                                    $total = $days_worked * ($amount_per_unit_duration / ($days_in_month_calc > 0 ? $days_in_month_calc : 1));

                                    if ($payroll['essentials_pay_period'] == 'week') {
                                        $duration_unit = __('essentials::lang.week');
                                        $total_work_duration = ($days_in_month_calc > 0) ? ($days_worked / ($days_in_month_calc / 4)) : 4;
                                        $total = $total_work_duration * $amount_per_unit_duration;
                                    } elseif ($payroll['essentials_pay_period'] == 'day') {
                                        $duration_unit = __('lang_v1.day');
                                        $total_work_duration = $days_worked;
                                        $total = $total_work_duration * $amount_per_unit_duration;
                                    }
                                }
                            ?>
                            <div class="card mb-6 shadow-sm" data-id="<?php echo e($employee, false); ?>" data-tax-enabled="<?php echo e(!empty($payroll['salary_tax_enabled']) ? 1 : 0, false); ?>" data-annual-tax-adjustment="<?php echo e($payroll['annual_tax_adjustment'] ?? 0, false); ?>">
                                <input type="hidden" name="payrolls[<?php echo e($employee, false); ?>][expense_for]" value="<?php echo e($employee, false); ?>">
                                <?php if($action == 'edit'): ?>
                                    <?php echo Form::hidden('payrolls['.$employee.'][transaction_id]', $payroll['transaction_id']); ?>

                                <?php endif; ?>

                                
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5 class="mb-1"><?php echo app('translator')->get('essentials::lang.employee'); ?></h5>
                                    <?php if($action == 'edit'): ?>
                                    <b><?php echo e(__('purchase.ref_no_short'), false); ?> :</b>
                                    <?php echo e($payroll['ref_no'], false); ?>

                                    <br><br>
                                    <?php endif; ?>
                                    <h4 class="mb-0"><?php echo e($payroll['name'], false); ?></h4>
                                    <br>
                                    <?php if(!empty($payroll['shift_id'])): ?>
                                    <b><?php echo e(__('essentials::lang.shift'), false); ?> :</b> <?php echo e($payroll['shift_name'], false); ?> <br>
                                    <b><?php echo e(__('essentials::lang.overtime'), false); ?> :</b> <br>
                                    <?php echo e(__('essentials::lang.work_duration_hour', ['duration' => $payroll['overtime']]), false); ?>

                                    <br>
                                    <b><?php echo e(__('essentials::lang.undertime'), false); ?> :</b> <br>
                                    <?php echo e(__('essentials::lang.work_duration_hour', ['duration' => $payroll['undertime']]), false); ?>

                                    <br>
                                    <?php endif; ?>
                                    <?php echo Form::label('leaves_'.$employee, __( 'essentials::lang.leaves' ).':*'); ?> <small><?php echo app('translator')->get('lang_v1.days'); ?></small>
                                    <?php echo Form::text('payrolls['.$employee.'][details][leaves]', $payroll['total_leaves'], ['class' => 'form-control input_number input-sm leaves', 'required', 'data-id' => $employee, 'id' => 'leaves_'.$employee]); ?>

                                    
                                    <br>
                                    <?php echo Form::label('work_duration_'.$employee, __( 'essentials::lang.work_duration' ).':*'); ?> <small><?php echo app('translator')->get('lang_v1.hours'); ?></small>
                                    <?php echo Form::text('payrolls['.$employee.'][details][work_duration]', $payroll['total_work_duration'], ['class' => 'form-control input_number input-sm work_duration', 'required', 'data-id' => $employee, 'id' => 'work_duration_'.$employee]); ?>

                                    <?php echo Form::hidden('payrolls['.$employee.'][details][shift_hours]', $payroll['shift_hours'], ['class' => 'form-control input_number input-sm shfit_hours', 'data-id' => $employee, 'id' => 'shift_hours_'.$employee]); ?>

                                    <br>
                                    <?php echo Form::label('off_days_'.$employee, __( 'essentials::lang.off_days' ).':'); ?> <?php echo e($off_days, false); ?>

                                    <br>
                                    <?php echo Form::label('attendance_days_'.$employee, __( 'essentials::lang.attendance' ).':*'); ?> <small><?php echo app('translator')->get('lang_v1.days'); ?></small>
                                    <?php echo Form::text('payrolls['.$employee.'][details][attendance_days]', $days_worked, ['class' => 'form-control input_number input-sm attendence_days', 'required', 'data-id' => $employee, 'id' => 'attendance_days_'.$employee]); ?> 
                                    <?php echo Form::hidden('payrolls['.$employee.'][details][days_in_month]', $days_in_month_calc, ['class' => 'form-control input_number input-sm days_in_month', 'data-id' => $employee, 'id' => 'days_in_month_'.$employee]); ?>

                                    <?php echo Form::hidden('payrolls['.$employee.'][details][total_days_worked]', $payroll['total_days_worked'], ['class' => 'form-control input_number input-sm total_days_worked', 'data-id' => $employee, 'id' => 'total_days_worked_'.$employee]); ?>

                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="mb-1"><?php echo app('translator')->get('essentials::lang.salary'); ?></h5>
                                    <?php echo Form::label('essentials_duration_'.$employee, __( 'essentials::lang.total_work_duration' ) . ':*'); ?>

                                    <?php echo Form::text('payrolls['.$employee.'][essentials_duration]', number_format($total_work_duration, 2, '.'), ['class' => 'form-control input_number essentials_duration', 'placeholder' => __( 'essentials::lang.total_work_duration' ), 'required', 'data-id' => $employee, 'id' => 'essentials_duration_'.$employee]); ?>

                                    <br>

                                    <?php echo Form::label('essentials_duration_unit_'.$employee, __( 'essentials::lang.duration_unit' ) . ':'); ?>

                                    <?php echo Form::text('payrolls['.$employee.'][essentials_duration_unit]', $duration_unit, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.duration_unit' ), 'data-id' => $employee, 'id' => 'essentials_duration_unit_'.$employee]); ?>


                                    <br>
                                    
                                    <?php echo Form::label('essentials_amount_per_unit_duration_'.$employee, __( 'essentials::lang.amount_per_unit_duartion' ) . ':*'); ?>

                                    <?php echo Form::text('payrolls['.$employee.'][essentials_amount_per_unit_duration]', $amount_per_unit_duration, ['class' => 'form-control input_number essentials_amount_per_unit_duration', 'placeholder' => __( 'essentials::lang.amount_per_unit_duartion' ), 'required', 'data-id' => $employee, 'id' => 'essentials_amount_per_unit_duration_'.$employee]); ?>

                                        
                                    <br>
                                    <?php echo Form::label('total_'.$employee, __( 'sale.total' ) . ':'); ?>

                                    <?php echo Form::text('payrolls['.$employee.'][total]', $total, ['class' => 'form-control input_number total', 'placeholder' => __( 'sale.total' ), 'data-id' => $employee, 'id' => 'total_'.$employee]); ?>

                                        </div>
                                    </div>
                                </div>

                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="mb-2"><?php echo app('translator')->get('essentials::lang.allowances'); ?></h5>
                                        <div class="table-responsive">
<table class="table table-condenced allowance_table table-th-skin" id="allowance_table_<?php echo e($employee, false); ?>" data-id="<?php echo e($employee, false); ?>">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-5"><?php echo app('translator')->get('essentials::lang.description'); ?></th>
                                                    <th class="col-md-3"><?php echo app('translator')->get('essentials::lang.amount_type'); ?></th>
                                                    <th class="col-md-3"><?php echo app('translator')->get('sale.amount'); ?></th>
                                                    <th class="col-md-1">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_allowances = 0;
                                                ?>
                                                <?php if(($action != 'edit' || $recalculate) && !empty($payroll['shift_id']) && !empty($overtime_value) && $overtime_value > 0): ?>
                                                <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'overtime', 'name' => 'Overtime', 'value' => $overtime_value, 'no_button' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                                <?php if(!empty($payroll['allowances'])): ?>
                                                    <?php $__currentLoopData = $payroll['allowances']['allowance_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['add_button' => $loop->index == 0 ? true : false, 'type' => 'allowance', 'name' => $value, 'value' => $payroll['allowances']['allowance_amounts'][$key], 'amount_type' => $payroll['allowances']['allowance_types'][$key],
                                                        'percent' => $payroll['allowances']['allowance_percents'][$key] ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                                        <?php
                                                            $total_allowances += $payroll['allowances']['allowance_amounts'][$key];
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['add_button' => true, 'type' => 'allowance'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'allowance'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'allowance'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2"><?php echo app('translator')->get('sale.total'); ?></th>
                                                    <td><span id="total_allowances_<?php echo e($employee, false); ?>" class="display_currency" data-currency_symbol="true"><?php echo e($total_allowances, false); ?></span></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tfoot>
                                        </table>
</div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="mb-2"><?php echo app('translator')->get('essentials::lang.deductions'); ?></h5>
                                        <div class="table-responsive">
<table class="table table-condenced deductions_table table-th-skin" id="deductions_table_<?php echo e($employee, false); ?>" data-id="<?php echo e($employee, false); ?>">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-5"><?php echo app('translator')->get('essentials::lang.description'); ?></th>
                                                    <th class="col-md-3"><?php echo app('translator')->get('essentials::lang.amount_type'); ?></th>
                                                    <th class="col-md-3"><?php echo app('translator')->get('sale.amount'); ?></th>
                                                    <th class="col-md-1">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_deductions = 0;
                                                ?>
                                                
                                                <?php if(($action != 'edit' || $recalculate) && !empty($payroll['shift_id']) && !empty($undertime_value) && $undertime_value > 0): ?>
                                                <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'undertime', 'name' => 'Undertime', 'value' => $undertime_value, 'no_button' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                                
                                                <?php if(($action != 'edit' || $recalculate) && $absent_days > 0): ?>
                                                <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'deduction', 'name' => 'Absent Days : '. $absent_days , 'value' => $absent_amount, 'no_button' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                                
                                                <?php if(($action != 'edit' || $recalculate) && !empty($payroll['advances'])): ?>
                                                    <?php $__currentLoopData = $payroll['advances']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'deduction', 'name' => 'Advance - '. $advance->ref_no, 'value' => $advance->final_total - $advance->total_adjusted,
                                                                                                                    'no_button' => false, 'name_readonly' => true, 'type_readonly' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                                <?php if(($action != 'edit' || $recalculate) && !empty($payroll['loans'])): ?>
                                                    <?php $__currentLoopData = $payroll['loans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'deduction', 'name' => 'Loan - '. $loan->ref_no . ' - Inst # '.$loan->inst_num+1, 'value' => $loan->final_total / $loan->recur_repetitions,
                                                                                                                    'final_total' => $loan->final_total, 'total_adjusted' => $loan->total_adjusted, 'no_button' => false, 'name_readonly' => true, 'type_readonly' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                
                                                <?php if(!empty($payroll['deductions'])): ?>
                                                    <?php $__currentLoopData = $payroll['deductions']['deduction_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['add_button' => $loop->index == 0 ? true : false, 'type' => 'deduction', 'name' => $value, 'value' => $payroll['deductions']['deduction_amounts'][$key], 
                                                        'amount_type' => $payroll['deductions']['deduction_types'][$key], 'percent' => $payroll['deductions']['deduction_percents'][$key], 'payment_id' => $payroll['deductions']['deduction_payment_ids'][$key],
                                                        'name_readonly' => !empty($payroll['deductions']['deduction_payment_ids'][$key]) ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                                        <?php
                                                            $total_deductions += $payroll['deductions']['deduction_amounts'][$key];
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['add_button' => true, 'type' => 'deduction'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'deduction'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php echo $__env->make('essentials::payroll.allowance_and_deduction_row', ['type' => 'deduction'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2"><?php echo app('translator')->get('sale.total'); ?></th>
                                                    <td><span id="total_deductions_<?php echo e($employee, false); ?>" class="display_currency" data-currency_symbol="true"><?php echo e($total_deductions, false); ?></span></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tfoot>
                                        </table>
</div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="card-footer bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="form-group mb-0">
                                                <?php echo Form::label('note_'.$employee, __( 'brand.note' ) . ':'); ?>

                                                <?php echo Form::textarea('payrolls['.$employee.'][staff_note]', $payroll['staff_note'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'sale.total' ), 'id' => 'note_'.$employee, 'rows' => 2]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div><?php echo app('translator')->get('essentials::lang.gross_amount'); ?>: <strong><span id="pre_tax_amount_text_<?php echo e($employee, false); ?>">0</span></strong></div>
                                            <?php if(!empty($payroll['salary_tax_enabled'])): ?>
                                                <div><?php echo app('translator')->get('essentials::lang.salary_tax'); ?> (TY <?php echo e($salary_tax_year, false); ?>): <strong>- <span id="salary_tax_text_<?php echo e($employee, false); ?>">0</span></strong></div>
                                            <?php endif; ?>
                                            <h5 class="mb-1"><?php echo app('translator')->get('essentials::lang.net_pay'); ?></h5>
                                            <h4 class="mb-0">
                                                <strong>
                                                    <span id="gross_amount_text_<?php echo e($employee, false); ?>">0</span>
                                                </strong>
                                            </h4>
                                            <?php echo Form::hidden('payrolls['.$employee.'][final_total]', 0, ['id' => 'gross_amount_'.$employee, 'class' => 'gross_amount']); ?>

                                            <input type="hidden" id="net_amount_<?php echo e($employee, false); ?>" class="net_amount" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo Form::hidden('total_gross_amount', 0, ['id' => 'total_gross_amount']); ?>

            <?php echo Form::hidden('notify_employee', 0, ['id' => 'hidden_notify_employee']); ?>

        </div>
    </div>

    
    <div id="payroll-footer-actions-template" class="d-none">
        <div>
            <label class="form-check-label me-3" style="cursor:pointer;">
                <input type="checkbox" class="form-check-input" id="footer_notify_employee" value="1">
                <?php echo e(__('essentials::lang.notify_employee'), false); ?>

            </label>
            <button type="button" class="btn btn-primary" id="footer_submit_payroll">
                <?php echo e($submit_btn_text, false); ?>

            </button>
        </div>
    </div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if ($__env->exists('essentials::payroll.form_script')) echo $__env->make('essentials::payroll.form_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    if($type == 'allowance') {
        $name_col = 'payrolls['.$employee.'][allowance_names]';
        $val_col = 'payrolls['.$employee.'][allowance_amounts]';
        $val_class = 'allowance';
        $type_col = 'payrolls['.$employee.'][allowance_types]';
        $percent_col = 'payrolls['.$employee.'][allowance_percent]';
        $payment_id_col = 'payrolls['.$employee.'][allowance_payment_ids]';
    } elseif($type == 'deduction') {
        $name_col = 'payrolls['.$employee.'][deduction_names]';
        $val_col = 'payrolls['.$employee.'][deduction_amounts]';
        $val_class = 'deduction';
        $type_col = 'payrolls['.$employee.'][deduction_types]';
        $percent_col = 'payrolls['.$employee.'][deduction_percent]';
        $payment_id_col = 'payrolls['.$employee.'][deduction_payment_ids]';
    } elseif($type == 'overtime') {
        $name_col = 'payrolls['.$employee.'][allowance_names]';
        $val_col = 'payrolls['.$employee.'][allowance_amounts]';
        $val_class = 'allowance';
        $type_col = 'payrolls['.$employee.'][allowance_types]';
        $percent_col = 'payrolls['.$employee.'][allowance_percent]';
        $payment_id_col = 'payrolls['.$employee.'][allowance_payment_ids]';
        $make_fixed = true;
    } elseif($type == 'undertime') {
        $name_col = 'payrolls['.$employee.'][deduction_names]';
        $val_col = 'payrolls['.$employee.'][deduction_amounts]';
        $val_class = 'deduction';
        $type_col = 'payrolls['.$employee.'][deduction_types]';
        $percent_col = 'payrolls['.$employee.'][deduction_percent]';
        $payment_id_col = 'payrolls['.$employee.'][deduction_payment_ids]';
        $make_fixed = true;
        
    }

    $amount_type = !empty($amount_type) ? $amount_type : 'fixed';
    $percent = $amount_type == 'percent' && !empty($percent) ?  $percent : 0; 
?>
<tr>
    <td>
        <?php echo Form::text($name_col . '[]', !empty($name) ? $name : null, ['class' => 'form-control input-sm', !empty($name_readonly) ? 'readonly' : '' ]); ?>

        <?php echo Form::hidden($payment_id_col . '[]', !empty($payment_id) ? $payment_id : null, ['class' => 'form-control input-sm']); ?>

        <?php if(!empty($final_total)): ?>
            <small>Total Repaid: <?php echo e(number_format($total_adjusted, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) .' / '. number_format($final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> </small>
        <?php endif; ?>
    </td>
    <td>
        <?php echo Form::select($type_col . '[]', ['fixed' => __('lang_v1.fixed'), 'percent' => __('lang_v1.percentage')], $amount_type, array_merge(['class' => 'form-control input-sm amount_type select-readonly'], !empty($type_readonly || !empty($payment_id)) ? ['style' => 'pointer-events: none;background-color:#F5F5F5;'] : [])); ?>

        <div class="input-group percent_field <?php if($amount_type != 'percent'): ?> hide <?php endif; ?>">
            <?php echo Form::text($percent_col . '[]', number_format($percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number percent']); ?>

            <span class="input-group-text"><i class="fa fa-percent"></i></span>
        </div>
    </td>
    <td>
        <?php
            $readonly = $amount_type == 'percent' ? 'readonly' : '';
        ?>
        <?php echo Form::text($val_col . '[]', !empty($value) ? number_format((float) $value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input-sm value_field input_number ' . $val_class, $readonly ]); ?>

    </td>
    <td>
        <?php if(!empty($add_button)): ?>
            <button type="button" class="btn btn-primary btn-xs <?php if($type == 'allowance'): ?> add_allowance <?php elseif($type == 'deduction'): ?> add_deduction <?php endif; ?>">
            <i class="fa fa-plus"></i>
        <?php else: ?>
            <?php if(empty($no_button)): ?>
            <button type="button" class="btn btn-danger btn-xs remove_tr"><i class="fa fa-minus"></i></button>
            <?php endif; ?>
        <?php endif; ?>
    </button></td>
</tr>

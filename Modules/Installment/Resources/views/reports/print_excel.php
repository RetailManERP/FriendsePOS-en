<?php
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_installment_report_excel_number')) {
        function _installment_report_excel_number($value, $precision, $decimal_separator, $thousand_separator) {
            if ($value === '' || $value === null || $value === '-') {
                return $value;
            }

            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }
?>
<table>
    <tr>
        <th colspan="12"><?php echo e($business_name, false); ?></th>
    </tr>
    <tr>
        <th colspan="12"><?php echo e($report_title, false); ?></th>
    </tr>
    <?php if(! empty($filters_summary)): ?>
        <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($label, false); ?></th>
                <td colspan="11"><?php echo e($value, false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</table>

<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <table>
        <tr>
            <th colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e($section['title'], false); ?></th>
        </tr>
        <tr>
            <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $type = $column['type'] ?? 'text'; ?>
                <th>
                    <?php echo e($column['label'], false); ?>

                    <?php if($type === 'money' && ! empty($currency_symbol)): ?>
                        (<?php echo e($currency_symbol, false); ?>)
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <?php $__empty_18 = true; $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <tr>
                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $key = $column['key'];
                        $type = $column['type'] ?? 'text';
                        $value = $row[$key] ?? '';
                    ?>
                    <td>
                        <?php if($type === 'money'): ?>
                            <?php echo e(_installment_report_excel_number($value, 2, $decimal_separator, $thousand_separator), false); ?>

                        <?php elseif($type === 'number'): ?>
                            <?php echo e(_installment_report_excel_number($value, 0, $decimal_separator, $thousand_separator), false); ?>

                        <?php else: ?>
                            <?php echo e($value, false); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <tr>
                <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
            </tr>
        <?php endif; ?>

        <?php if(! empty($section['rows'])): ?>
            <tr>
                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $type = $column['type'] ?? 'text';
                        $total = $section['totals'][$column['key']] ?? null;
                    ?>
                    <?php if($loop->first): ?>
                        <th><?php echo app('translator')->get('sale.total'); ?></th>
                    <?php elseif(! empty($column['total']) && $type === 'money'): ?>
                        <th><?php echo e(_installment_report_excel_number($total, 2, $decimal_separator, $thousand_separator), false); ?></th>
                    <?php elseif(! empty($column['total']) && $type === 'number'): ?>
                        <th><?php echo e(_installment_report_excel_number($total, 0, $decimal_separator, $thousand_separator), false); ?></th>
                    <?php else: ?>
                        <th></th>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>
    </table>
    <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

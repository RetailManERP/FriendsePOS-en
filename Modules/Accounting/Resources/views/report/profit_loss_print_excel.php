<?php
    $currency = ! empty($currency_symbol) ? ' ('.$currency_symbol.')' : '';
?>

<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $totals = $section['totals'] ?? []; ?>
    <table>
        <thead>
            <tr>
                <th colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($section['title'], false); ?></th>
            </tr>
            <tr>
                <th><?php echo e(__('purchase.business_location'), false); ?></th>
                <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($location_name, false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('lang_v1.generated_on'), false); ?></th>
                <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($generated_at, false); ?></td>
            </tr>
            <?php if(! empty($filters_summary)): ?>
                <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($label, false); ?></th>
                        <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($value, false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr></tr>
            <tr>
                <th><?php echo e(__('accounting::lang.income'), false); ?></th>
                <td><?php echo e(round((float) ($totals['income'] ?? 0), 2), false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('accounting::lang.cos'), false); ?></th>
                <td><?php echo e(round((float) ($totals['cost_of_sales'] ?? 0), 2), false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('accounting::lang.gross_profit_loss'), false); ?></th>
                <td><?php echo e(round((float) ($totals['gross_profit_loss'] ?? 0), 2), false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('accounting::lang.expenses'), false); ?></th>
                <td><?php echo e(round((float) ($totals['expenses'] ?? 0), 2), false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('accounting::lang.net_profit_loss'), false); ?></th>
                <td><?php echo e(round((float) ($totals['net_profit_loss'] ?? 0), 2), false); ?></td>
            </tr>
            <tr></tr>
            <tr>
                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th>
                        <?php echo e($column['label'], false); ?>

                        <?php if(($column['type'] ?? '') === 'money'): ?>
                            <?php echo e($currency, false); ?>

                        <?php endif; ?>
                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_18 = true; $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <tr>
                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $key = $column['key'];
                            $type = $column['type'] ?? 'text';
                            $value = $row[$key] ?? '';
                        ?>
                        <td>
                            <?php if($value === '' || $value === null): ?>
                                <?php echo e('', false); ?>

                            <?php elseif($type === 'money'): ?>
                                <?php echo e(round((float) $value, 2), false); ?>

                            <?php else: ?>
                                <?php echo e(str_repeat('  ', $row['level'] ?? 0), false); ?><?php echo e($value, false); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <tr>
                    <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

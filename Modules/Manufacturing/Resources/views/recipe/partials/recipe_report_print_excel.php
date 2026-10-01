<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('purchase.business_location'), false); ?></th>
            <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($location_name, false); ?></td>
        </tr>
        <tr>
            <th>Generated on</th>
            <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($generated_at, false); ?></td>
        </tr>
        <?php if(! empty($filters_summary)): ?>
            <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($label, false); ?></th>
                    <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($value, false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <tr></tr>
        <tr>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th>
                    <?php echo e($column['label'], false); ?>

                    <?php if(($column['type'] ?? '') === 'money' && ! empty($currency_symbol)): ?>
                        (<?php echo e($currency_symbol, false); ?>)
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_18 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $key = $column['key'];
                        $type = $column['type'] ?? 'text';
                        $value = $row[$key] ?? '';
                    ?>
                    <td>
                        <?php if($value === '' || $value === null): ?>
                            <?php echo e('', false); ?>

                        <?php elseif(in_array($type, ['money', 'qty', 'percent'], true)): ?>
                            <?php echo e(round((float) $value, 4), false); ?><?php echo e($type === 'percent' ? '%' : '', false); ?>

                        <?php else: ?>
                            <?php echo e($value, false); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <tr>
                <td colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
    <?php if(! empty($rows)): ?>
        <tfoot>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <td><?php echo e(__('sale.total'), false); ?></td>
                    <?php elseif(! empty($column['total'])): ?>
                        <td><?php echo e(round((float) ($totals[$column['key']] ?? 0), 4), false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>

<table class="cash-flow-report-table">
    <colgroup>
        <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <col class="<?php echo e(($column['key'] ?? '') === 'description' ? 'description-column' : 'auto-column', false); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </colgroup>
    <thead>
        <tr>
            <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $key = $column['key'] ?? '';
                    $type = $column['type'] ?? 'text';
                    $is_auto_fit = $key !== 'description';
                ?>
                <th class="<?php echo e(in_array($type, ['money', 'number'], true) ? 'text-right' : '', false); ?> <?php echo e($is_auto_fit ? 'auto-fit' : 'description-column', false); ?>">
                    <?php echo e($column['label'], false); ?>

                    <?php if($type === 'money' && ! empty($currency_symbol)): ?>
                        (<?php echo e($currency_symbol, false); ?>)
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($section['rows'])): ?>
            <tr>
                <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>" class="empty-row"><?php echo app('translator')->get('lang_v1.no_records_found'); ?></td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $key = $column['key'];
                            $type = $column['type'] ?? 'text';
                            $value = $row[$key] ?? '';
                            $is_auto_fit = $key !== 'description';
                        ?>
                        <td class="<?php echo e(in_array($type, ['money', 'number'], true) ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'money-cell' : '', false); ?> <?php echo e($key === 'description' ? 'description-column' : '', false); ?> <?php echo e($key === 'operation_date' ? 'date-cell' : '', false); ?> <?php echo e($is_auto_fit ? 'auto-fit' : '', false); ?>">
                            <?php if($value === '' || $value === null): ?>
                                <?php echo e('', false); ?>

                            <?php elseif($key === 'operation_date'): ?>
                                <?php echo _acfr_print_date_lines($value); ?>

                            <?php elseif($key === 'description'): ?>
                                <?php echo _acfr_print_description_lines($value); ?>

                            <?php elseif($type === 'money'): ?>
                                <?php echo e(_acfr_print_money($value, $decimal_separator, $thousand_separator), false); ?>

                            <?php else: ?>
                                <?php echo e($value, false); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>

    <?php if($show_totals): ?>
        <tfoot>
            <tr class="total-row">
                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $key = $column['key'] ?? '';
                        $type = $column['type'] ?? 'text';
                        $total = $section['totals'][$key] ?? null;
                    ?>
                    <?php if($key === 'description'): ?>
                        <td class="text-right description-column"><?php echo app('translator')->get('sale.total'); ?></td>
                    <?php elseif(! empty($column['total']) && $type === 'money'): ?>
                        <td class="text-right"><?php echo e(_acfr_print_money($total, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>

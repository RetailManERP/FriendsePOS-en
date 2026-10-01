<table>
    <thead>
        <tr>
            <th colspan="2"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('purchase.business_location'), false); ?></th>
            <td><?php echo e($location_name, false); ?></td>
        </tr>
        <tr>
            <th>Generated on</th>
            <td><?php echo e($generated_at, false); ?></td>
        </tr>
        <?php if(! empty($filters_summary)): ?>
            <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($label, false); ?></th>
                    <td><?php echo e($value, false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <tr></tr>
        <tr>
            <th><?php echo e(__('lang_v1.description'), false); ?></th>
            <th>
                <?php echo e(__('sale.amount'), false); ?>

                <?php if(! empty($currency_symbol)): ?>
                    (<?php echo e($currency_symbol, false); ?>)
                <?php endif; ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row['metric'], false); ?></td>
                <td><?php echo e(round((float) $row['amount'], 2), false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

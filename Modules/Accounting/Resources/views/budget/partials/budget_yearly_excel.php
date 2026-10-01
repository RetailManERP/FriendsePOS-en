<table>
    <thead>
        <tr>
            <th>
                <?php echo app('translator')->get('account.account'); ?>
            </th>
            <th>
            <?php echo e($fy_year, false); ?>

            </th>
        </tr>
    </thead>
    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tbody>
        <tr>
            <th colspan="2">
                <?php echo e($account_type_detail['label'], false); ?>

            </th>
        </tr>
        <?php
            $account_ids=[];
        ?>
        <?php $__currentLoopData = $accounts->where('account_primary_type', $account_type)->sortBy('name')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $account_ids[]=$account->id;
                $account_budget = $budget->where('accounting_account_id', $account->id)->first();
            ?>
            <tr>
                <th><?php echo e($account->name, false); ?></th>
                <td>
                    <?php if(!is_null($account_budget) && !is_null($account_budget->yearly)): ?> 
                        <?php echo e(number_format($account_budget->yearly, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php else: ?> 
                        0
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th>
                <?php echo app('translator')->get('sale.total'); ?>
            </th>
            <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('yearly'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
        </tr>
    </tbody>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tfoot>
        <tr>
            <th>
                <?php echo app('translator')->get('lang_v1.grand_total'); ?>
            </th>
            <td><?php echo e(number_format($budget->sum('yearly'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
        </tr>
    </tfoot>
</table>

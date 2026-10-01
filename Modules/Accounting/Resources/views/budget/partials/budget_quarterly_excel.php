<table>
    <thead>
        <tr>
            <th>
                <?php echo app('translator')->get('account.account'); ?>
            </th>
            <th>
                <?php echo app('translator')->get('accounting::lang.1st_quarter'); ?>
            </th>
            <th>
                <?php echo app('translator')->get('accounting::lang.2nd_quarter'); ?>
            </th>
            <th>
                <?php echo app('translator')->get('accounting::lang.3rd_quarter'); ?>
            </th>
            <th>
                <?php echo app('translator')->get('accounting::lang.4th_quarter'); ?>
            </th>
            <th><?php echo app('translator')->get('sale.total'); ?></th>
        </tr>
    </thead>
    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tbody>
        <tr>
            <th colspan="6">
                <?php echo e($account_type_detail['label'], false); ?>

            </th>
        </tr>
        <?php
            $account_ids=[];
        ?>
        <?php $__currentLoopData = $accounts->where('account_primary_type', $account_type)->sortBy('name')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $total = 0;
                $account_ids[]=$account->id;
                $account_budget = $budget->where('accounting_account_id', $account->id)->first();
            ?>
                <tr>
                    <th><?php echo e($account->name, false); ?></th>
                    <td>
                        <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_1)): ?>
                            <?php
                                $total += $account_budget->quarter_1;   
                            ?>  
                            <?php echo e(number_format($account_budget->quarter_1, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_2)): ?> 
                            <?php
                                $total += $account_budget->quarter_2;   
                            ?>
                            <?php echo e(number_format($account_budget->quarter_2, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_3)): ?> 
                            <?php
                                $total += $account_budget->quarter_3;   
                            ?>
                            <?php echo e(number_format($account_budget->quarter_2, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!is_null($account_budget) && !is_null($account_budget->quarter_4)): ?>
                            <?php
                                $total += $account_budget->quarter_4;   
                            ?> 
                            <?php echo e(number_format($account_budget->quarter_4, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e(number_format($total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> 
                    </td>
                </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th>
                    <?php echo app('translator')->get('sale.total'); ?>
                </th>
                <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('quarter_1'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('quarter_2'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('quarter_3'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('quarter_4'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <td></td>
            </tr>
        </tbody>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tfoot>
        <tr>
            <th>
                <?php echo app('translator')->get('lang_v1.grand_total'); ?>
            </th>
            <td><?php echo e(number_format($budget->sum('quarter_1'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td><?php echo e(number_format($budget->sum('quarter_2'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td><?php echo e(number_format($budget->sum('quarter_3'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td><?php echo e(number_format($budget->sum('quarter_4'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

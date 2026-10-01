<table>
    <thead>
        <tr>
            <th>
                <?php echo app('translator')->get('account.account'); ?>
            </th>
            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e(Carbon::createFromFormat('m', $k)->format('M'), false); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo app('translator')->get('sale.total'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th colspan="14">
                <?php echo e($account_type_detail['label'], false); ?>

            </th>
        </tr>
            <?php
                $account_ids=[];
            ?>
            <?php $__currentLoopData = $accounts->where('account_primary_type', $account_type)->sortBy('name')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php
                        $total = 0;
                        $account_ids[]=$account->id;
                    ?>
                    <th><?php echo e($account->name, false); ?></th>
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $account_budget = $budget->where('accounting_account_id', $account->id)->first();
                            $value = !is_null($account_budget) && !is_null($account_budget->$m) 
                            ? $account_budget->$m : null;
                        ?>
                        <td>
                            <?php if(!is_null($value)): ?>
                                <?php echo e(number_format($value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>  
                                <?php
                                    $total += $value;   
                                ?>                                           
                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <?php echo e(number_format($total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> 
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th>
                    <?php echo app('translator')->get('sale.total'); ?>
                </th>
                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td></td>
            </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th>
            <?php echo app('translator')->get('lang_v1.grand_total'); ?>
        </th>
        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e(number_format($budget->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <td></td>
    </tr>
    </tbody>
</table>

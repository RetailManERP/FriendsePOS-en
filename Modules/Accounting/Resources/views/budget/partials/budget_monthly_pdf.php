<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<style>
    .header {
        background-color: #dadada;
    }
    .header td, .header th {
        padding: 10px;
    }
</style>
<div class="width-100">
    <h1><?php echo e(__('accounting::lang.budget'), false); ?></h1>
    <h4><?php echo app('translator')->get( 'accounting::lang.financial_year_for_the_budget' ); ?>: <?php echo e($fy_year, false); ?></h4>
</div>
<div class="width-100">
    <table class="table table-striped width-100" style="text-align: left;">
        <thead>
            <tr class="header">
                <th align="left">
                    <?php echo app('translator')->get('account.account'); ?>
                </th>
                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th align="left"><?php echo e(Carbon::createFromFormat('m', $k)->format('M'), false); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th align="left"><?php echo app('translator')->get('sale.total'); ?></th>
            </tr>
        </thead>
        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tbody>
            <tr class="header">
                <th colspan="14" align="center">
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
                        <th align="left"><?php echo e($account->name, false); ?></th>
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $account_budget = $budget->where('accounting_account_id', $account->id)->first();
                                $value = !is_null($account_budget) && !is_null($account_budget->$m) 
                                ? $account_budget->$m : null;
                            ?>
                            <td align="left">
                                <?php if(!is_null($value)): ?>
                                    <?php echo e(number_format($value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>  
                                    <?php
                                        $total += $value;   
                                    ?>                                           
                                <?php endif; ?>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td align="left">
                            <?php echo e(number_format($total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> 
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="header">
                    <th align="left">
                        <?php echo app('translator')->get('sale.total'); ?>
                    </th align="left">
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td></td>
                </tr>
            </tbody>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tfoot class="bg-green">
            <tr class="header">
                <th align="left">
                    <?php echo app('translator')->get('lang_v1.grand_total'); ?>
                </th>
                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td align="left"><?php echo e(number_format($budget->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

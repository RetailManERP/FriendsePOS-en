<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#monthly_tab" data-bs-toggle="tab" role="tab"
                        aria-expanded="true"><?php echo app('translator')->get('accounting::lang.monthly'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#quarterly_tab" data-bs-toggle="tab" role="tab"
                        aria-expanded="true"><?php echo app('translator')->get('accounting::lang.quarterly'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#yearly_tab" data-bs-toggle="tab" role="tab"
                        aria-expanded="true"><?php echo app('translator')->get('accounting::lang.yearly'); ?></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="monthly_tab" role="tabpanel">
                    <div class="text-right mb-12">
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=pdf&view_type=monthly"><i class="fas fa-file-pdf"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_pdf'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=csv&view_type=monthly"><i class="fas fa-file-csv"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_csv'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=excel&view_type=monthly"><i class="fas fa-file-excel"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_excel'); ?></a>
                    </div>
                    <div class="table-responsive" style="height: 500px;">
                    <table class="table table-striped table-sticky">
                        <thead>
                            <tr class="bg-green">
                                <th>
                                    <?php echo app('translator')->get('account.account'); ?>
                                </th>
                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e(Carbon::createFromFormat('m', $k)->format('M'), false); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo app('translator')->get('sale.total'); ?></th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody class="collapsed">
                            <tr class="toggle-tr bg-gray" style="cursor: pointer;">
                                <th colspan="14">
                                    <span class="collapse-icon">
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </span>
                                    <?php echo e($account_type_detail['label'], false); ?>

                                </th>
                            </tr>
                                <?php
                                    $account_ids=[];
                                ?>
                                <?php $__currentLoopData = $accounts->where('account_primary_type', $account_type)->sortBy('name')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="collapse-tr">
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
                                <tr class="collapse-tr bg-gray">
                                    <th>
                                        <?php echo app('translator')->get('sale.total'); ?>
                                    </th>
                                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td></td>
                                </tr>
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tfoot class="bg-green">
                            <tr class="table-footer">
                                <th>
                                    <?php echo app('translator')->get('lang_v1.grand_total'); ?>
                                </th>
                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e(number_format($budget->sum($m), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                    <div class="tab-pane fade" id="quarterly_tab" role="tabpanel">
                    <div class="text-right mb-12">
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=pdf&view_type=quarterly"><i class="fas fa-file-pdf"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_pdf'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=csv&view_type=quarterly"><i class="fas fa-file-csv"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_csv'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=excel&view_type=quarterly"><i class="fas fa-file-excel"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_excel'); ?></a>
                    </div>
                    <div class="table-responsive" style="height: 500px;">
                        <table class="table table-striped table-sticky">
                            <thead>
                                <tr class="bg-green">
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
                            <tbody class="collapsed">
                                <tr class="toggle-tr bg-gray" style="cursor: pointer;">
                                    <th colspan="6">
                                        <span class="collapse-icon">
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </span>
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
                                        <tr class="collapse-tr">
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
                                    <tr class="collapse-tr bg-gray">
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
                                <tr class="bg-green">
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
                    </div>
                </div>
                    <div class="tab-pane fade" id="yearly_tab" role="tabpanel">
                    <div class="text-right mb-12">
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=pdf&view_type=yearly"><i class="fas fa-file-pdf"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_pdf'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=csv&view_type=yearly"><i class="fas fa-file-csv"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_csv'); ?></a>
                        <a class="btn btn-sm btn-default" 
                        href="<?php echo e(route('budget.index'), false); ?>?financial_year=<?php echo e($fy_year, false); ?>&format=excel&view_type=yearly"><i class="fas fa-file-excel"></i> 
                            <?php echo app('translator')->get('accounting::lang.export_to_excel'); ?></a>
                    </div>
                    <div class="table-responsive" style="height: 500px;">
                        <table class="table table-striped table-sticky">
                            <thead>
                                <tr class="bg-green">
                                    <th>
                                        <?php echo app('translator')->get('account.account'); ?>
                                    </th>
                                    <th class="text-center">
                                    <?php echo e($fy_year, false); ?>

                                    </th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_type_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody class="collapsed">
                                <tr class="toggle-tr bg-gray" style="cursor: pointer;">
                                    <th colspan="2">
                                        <span class="collapse-icon">
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </span>
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
                                    <tr class="collapse-tr">
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
                                <tr class="bg-gray collapse-tr">
                                    <th>
                                        <?php echo app('translator')->get('sale.total'); ?>
                                    </th>
                                    <td><?php echo e(number_format($budget->whereIn('accounting_account_id', $account_ids)->sum('yearly'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tfoot>
                                <tr class="bg-green">
                                    <th>
                                        <?php echo app('translator')->get('lang_v1.grand_total'); ?>
                                    </th>
                                    <td><?php echo e(number_format($budget->sum('yearly'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

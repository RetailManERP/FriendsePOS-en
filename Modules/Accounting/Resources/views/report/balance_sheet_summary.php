

<?php $__env->startSection('title', __('accounting::lang.balance_sheet')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.balance_sheet' ); ?></h1>
</section>

<section class="row" style="padding:15px">

    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('date_range_filter', __('report.date_range') . ':'); ?>

            <?php echo Form::text('date_range_filter', null, 
                ['placeholder' => __('lang_v1.select_a_date_range'), 
                'class' => 'form-control', 'readonly', 'id' => 'date_range_filter']); ?>

        </div>
    </div>

    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.balance_sheet'); ?> (<?php echo app('translator')->get('lang_v1.summary'); ?>)</h2>
                <p><?php echo e(\Carbon::createFromTimestamp(strtotime($start_date))->format(session('business.date_format')), false); ?> ~ <?php echo e(\Carbon::createFromTimestamp(strtotime($end_date))->format(session('business.date_format')), false); ?></p>
            </div>

            <div class="box-body">
                <div class="clearfix no-print" style="margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary pull-right" id="print_balance_sheet_report">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>

                <?php
                    $total_assets = 0;
                    $total_liab_owners = 0;
                ?>
                    <table class="table table-stripped table-bordered" style="min-height: 300px">
                        <thead>
                            <tr>
                                <th class="success"><?php echo app('translator')->get( 'accounting::lang.assets'); ?></th>
                                <th class="warning"><?php echo app('translator')->get( 'accounting::lang.liab_owners_capital'); ?></th>
                            </tr>
                        </thead>

                        <tr>
                            <td class="col-md-6">
                                <table class="table">
                                            
                                    <?php $__currentLoopData = $account_sub_types->where('account_primary_type', 'asset')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // Group accounts of this subtype by parent name
                                            $accountsByParent = $assets
                                                ->where('account_sub_type_id', $sub_type->id)
                                                ->where('account_type', $key)
                                                ->groupBy(function($acc) {
                                                    return $acc->parent_account_name ?? '_no_parent';
                                                });

                                            $subTypeTotal = 0;
                                        ?>

                                        <tr>
                                            <th style="padding-left:3%">
                                                <i class="fa fa-folder pr-5"></i> <?php echo e($sub_type->account_type_name, false); ?>

                                            </th>
                                            <td style="float:right;">
                                                <?php
                                                    // Sum only no-parent accounts here
                                                    $noParentTotal = $accountsByParent->has('_no_parent')
                                                        ? $accountsByParent['_no_parent']->sum('balance')
                                                        : 0;
                                                    $subTypeTotal += $noParentTotal;
                                                    $total_assets += $noParentTotal;
                                                ?>
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $noParentTotal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            </td>
                                        </tr>

                                        <?php $__currentLoopData = $accountsByParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentName => $childAccounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($parentName !== '_no_parent'): ?>
                                                <?php
                                                    $parentBalance = $childAccounts->sum('balance');
                                                    $subTypeTotal += $parentBalance;
                                                    $total_assets += $parentBalance;
                                                ?>

                                                <tr>
                                                    <td style="padding-left:8%">
                                                        <i class="fa fa-folder pr-5"></i> <?php echo e($parentName, false); ?>

                                                    </td>
                                                    <td style="float:right;">
                                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $parentBalance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>

                            </td>

                            <td class="col-md-6">
                                <table class="table">

                                    <?php $__currentLoopData = $account_sub_types->where('account_primary_type', 'liability')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // Group accounts of this subtype by parent name
                                            $accountsByParent = $liabilities
                                                ->where('account_sub_type_id', $sub_type->id)
                                                ->where('account_type', $key)
                                                ->groupBy(function($acc) {
                                                    return $acc->parent_account_name ?? '_no_parent';
                                                });

                                            $subTypeTotal = 0;
                                        ?>

                                        <tr>
                                            <th style="padding-left:3%">
                                                <i class="fa fa-folder pr-5"></i> <?php echo e($sub_type->account_type_name, false); ?>

                                            </th>
                                            <td style="float:right;">
                                                <?php
                                                    // Sum only no-parent accounts here
                                                    $noParentTotal = $accountsByParent->has('_no_parent')
                                                        ? $accountsByParent['_no_parent']->sum('balance')
                                                        : 0;
                                                    $subTypeTotal += $noParentTotal;
                                                    $total_liab_owners += $noParentTotal;
                                                ?>
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $noParentTotal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            </td>
                                        </tr>

                                        <?php $__currentLoopData = $accountsByParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentName => $childAccounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($parentName !== '_no_parent'): ?>
                                                <?php
                                                    $parentBalance = $childAccounts->sum('balance');
                                                    $subTypeTotal += $parentBalance;
                                                    $total_liab_owners += $parentBalance;
                                                ?>

                                                <tr>
                                                    <td style="padding-left:8%">
                                                        <i class="fa fa-folder pr-5"></i> <?php echo e($parentName, false); ?>

                                                    </td>
                                                    <td style="float:right;">
                                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $parentBalance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </table>
                                <?php if(!count($liabilities)): ?> 
                                    <br><br><br><br>
                                <?php endif; ?>

                                <?php 
                                    // $retained_earnings = $total_income-$total_expenses;
                                    $total_liab_owners += $retained_earnings;
                                ?>
                                <table class="table">
                                    <th colspan="2" class="info"><?php echo app('translator')->get( 'accounting::lang.equity'); ?></th>
                                    <?php if($retained_earnings != 0): ?>
                                    <tr>
                                        <th style="padding-left:3%"><i class="fa fa-folder pr-5"></i> Retained Earnings (P/L)</th>
                                        <td style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $retained_earnings, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $account_sub_types->where('account_primary_type', 'equity')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // Group accounts of this subtype by parent name
                                            $accountsByParent = $equities
                                                ->where('account_sub_type_id', $sub_type->id)
                                                ->where('account_type', $key)
                                                ->groupBy(function($acc) {
                                                    return $acc->parent_account_name ?? '_no_parent';
                                                });

                                            $subTypeTotal = 0;
                                        ?>

                                        <tr>
                                            <th style="padding-left:3%">
                                                <i class="fa fa-folder pr-5"></i> <?php echo e($sub_type->account_type_name, false); ?>

                                            </th>
                                            <td style="float:right;">
                                                <?php
                                                    // Sum only no-parent accounts here
                                                    $noParentTotal = $accountsByParent->has('_no_parent')
                                                        ? $accountsByParent['_no_parent']->sum('balance')
                                                        : 0;
                                                    $subTypeTotal += $noParentTotal;
                                                    $total_liab_owners += $noParentTotal;
                                                ?>
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $noParentTotal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            </td>
                                        </tr>

                                        <?php $__currentLoopData = $accountsByParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentName => $childAccounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($parentName !== '_no_parent'): ?>
                                                <?php
                                                    $parentBalance = $childAccounts->sum('balance');
                                                    $subTypeTotal += $parentBalance;
                                                    $total_liab_owners += $parentBalance;
                                                ?>

                                                <tr>
                                                    <td style="padding-left:8%">
                                                        <i class="fa fa-folder pr-5"></i> <?php echo e($parentName, false); ?>

                                                    </td>
                                                    <td style="float:right;">
                                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $parentBalance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </table>
                                
                            </td>
                        </tr>

                        <tr>
                            <td class="col-md-6">
                                <span>
                                    <strong><?php echo app('translator')->get( 'accounting::lang.total_assets'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>: </strong>
                                </span>

                                <span style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_assets, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                            </td>

                            <td class="col-md-6">
                                <span>
                                    <strong><?php echo app('translator')->get( 'accounting::lang.total_liab_owners'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>: </strong>
                                </span>

                                <span style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_liab_owners, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                            </td>
                        </tr>

                    </table>
                
            </div>

        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var balanceSheetPrintUrl = '<?php echo e(route('accounting.balanceSheet.print'), false); ?>';
        var balanceSheetType = '<?php echo e($type ?? 'summary', false); ?>';
        var balanceSheetLocationId = '<?php echo e($location_id ?? 'all', false); ?>';

        dateRangeSettings.startDate = moment('<?php echo e($start_date, false); ?>');
        dateRangeSettings.endDate = moment('<?php echo e($end_date, false); ?>');

        $('#date_range_filter').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                apply_filter();
            }
        );
        $('#date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#date_range_filter').val('');
            apply_filter();
        });

        function apply_filter(){
            var start = '';
            var end = '';

            if ($('#date_range_filter').val()) {
                start = $('input#date_range_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#date_range_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('start_date', start);
            urlParams.set('end_date', end);
            window.location.search = urlParams;
        }

        $('#print_balance_sheet_report').on('click', function(e) {
            e.preventDefault();
            window.open(balanceSheetPrintUrl + '?' + $.param(getBalanceSheetPrintParams()), '_blank');
        });

        function getBalanceSheetPrintParams() {
            var start = '';
            var end = '';
            var picker = $('input#date_range_filter').data('daterangepicker');
            var urlParams = new URLSearchParams(window.location.search);

            if ($('#date_range_filter').val() && picker) {
                start = picker.startDate.format('YYYY-MM-DD');
                end = picker.endDate.format('YYYY-MM-DD');
            } else {
                start = urlParams.get('start_date') || '<?php echo e($start_date, false); ?>';
                end = urlParams.get('end_date') || '<?php echo e($end_date, false); ?>';
            }

            return {
                start_date: start,
                end_date: end,
                location_id: urlParams.get('location_id') || balanceSheetLocationId || 'all',
                type: balanceSheetType,
                tab: balanceSheetType
            };
        }
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
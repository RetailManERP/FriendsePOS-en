

<?php $__env->startSection('title', __('accounting::lang.trial_balance')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="row" style="padding:15px">
        
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('date_range_filter', __('report.date_range') . ':'); ?>

            <?php echo Form::text('date_range_filter', null, 
                ['placeholder' => __('lang_v1.select_a_date_range'), 
                'class' => 'form-control', 'readonly', 'id' => 'date_range_filter']); ?>

        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.trial_balance'); ?> (<?php echo app('translator')->get('lang_v1.detailed'); ?>) </h2>
                <p><?php echo e(\Carbon::createFromTimestamp(strtotime($start_date))->format(session('business.date_format')), false); ?> ~ <?php echo e(\Carbon::createFromTimestamp(strtotime($end_date))->format(session('business.date_format')), false); ?></p>
            </div>

            <div class="box-body">
                <div class="text-end mb-2 no-print">
                    <button type="button" class="btn btn-primary" id="print_trial_balance_report">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
                <table class="table table-stripped">
                    

                    <?php
                        $total_debit = 0;
                        $total_credit = 0;
                    ?>

                    <tbody>
                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <table class="table">
                                    <thead>
                                        <th width="50%"><i class="fa fa-folder pr-5"></i> <?php echo e($account_type, false); ?></th>
                                        <th width="25%"><?php if($loop->index == 0): ?> Debit <?php echo e('('.session("currency")["symbol"].')', false); ?> <?php endif; ?></th>
                                        <th width="25%"><?php if($loop->index == 0): ?> Credit <?php echo e('('.session("currency")["symbol"].')', false); ?> <?php endif; ?></th>
                                    </thead>
                                    <tbody>
                                        
                                        <?php if($account_type == 'Equity' && $retained_earnings != 0): ?>
                                            <?php
                                            $total_credit += $retained_earnings;
                                            ?>
                                            <tr>
                                                <td style="padding-left:10%">Owner / Shareholder Equity (B/F)</td>
                                                <td></td>
                                                <td><?php 
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

                                        <?php $__currentLoopData = $account_sub_types->where('account_primary_type', $key)->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <tr>
                                                <td style="padding-left:5%">
                                                    <i class="fa fa-folder pr-5"></i> <?php echo e($sub_type->account_type_name, false); ?>

                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                             
                                            <?php
                                                $accountsByParent = $accounts
                                                    ->where('account_sub_type_id', $sub_type->id)
                                                    ->where('account_type', $key)
                                                    ->groupBy(function($acc) {
                                                        return $acc->parent_account_name ?? '_no_parent';
                                                    });
                                            ?>

                                            <?php $__currentLoopData = $accountsByParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentName => $childAccounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($parentName !== '_no_parent'): ?>
                                                    <tr>
                                                        <td style="padding-left:8%">
                                                            <i class="fa fa-folder pr-5"></i> <?php echo e($parentName, false); ?>

                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php $__currentLoopData = $childAccounts->sortBy('gl_code'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $balance = (float) $account->balance;
                                                        if(in_array($account->account_type, ['asset','expenses'])){
                                                            $account->debit_balance = $balance > 0 ? $balance : 0;
                                                            $account->credit_balance = $balance < 0 ? abs($balance) : 0;
                                                        } else {
                                                            $account->debit_balance = $balance < 0 ? abs($balance) : 0;
                                                            $account->credit_balance = $balance > 0 ? $balance : 0;
                                                        }

                                                        if($account->debit_balance == 0 && $account->credit_balance == 0 && in_array($account->account_type, ['income','expenses'])){
                                                            continue;
                                                        }

                                                        $total_debit += $account->debit_balance;
                                                        $total_credit += $account->credit_balance;
                                                    ?>
                                                    <tr>
                                                        <td style="padding-left:<?php echo e($parentName !== '_no_parent' ? '12%' : '8%', false); ?>">
                                                            <i class="fas fa-arrow-alt-circle-right pr-5"></i>
                                                            <?php echo e(!empty($account->gl_code) ? $account->gl_code.' - ' : '', false); ?><?php echo e($account->name, false); ?>

                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                                            <a class="btn btn-xs btn-default text-success ledger-link"
                                                                title="<?php echo app('translator')->get('accounting::lang.ledger'); ?>"
                                                                target="_BLANK"
                                                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $account->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                                                <i class="fas fa-file-alt"></i>
                                                            </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php if($account->debit_balance != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->debit_balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                                        <td><?php if($account->credit_balance != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->credit_balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                
                                <tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th width="50%">Total <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th width="25%" class="total_debit"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                            <th width="25%" class="total_credit"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_credit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var trialBalancePrintUrl = '<?php echo e(route('accounting.trialBalance.print'), false); ?>';
        var trialBalanceType = '<?php echo e($type ?? request()->get('type', 'detailed'), false); ?>';

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

        $('#print_trial_balance_report').on('click', function(e) {
            e.preventDefault();
            window.open(trialBalancePrintUrl + '?' + $.param(getTrialBalancePrintParams()), '_blank');
        });

        function getTrialBalancePrintParams() {
            var start = '';
            var end = '';
            var dp = $('input#date_range_filter').data('daterangepicker');

            if ($('#date_range_filter').val() && dp) {
                start = dp.startDate.format('YYYY-MM-DD');
                end = dp.endDate.format('YYYY-MM-DD');
            }

            var urlParams = new URLSearchParams(window.location.search);
            var params = {
                type: trialBalanceType,
                tab: trialBalanceType,
                location_id: urlParams.get('location_id') || '<?php echo e($location_id ?? 'all', false); ?>',
                start_date: start,
                end_date: end
            };

            $.each(params, function(key, value) {
                if (value === '' || value === null || typeof value === 'undefined') {
                    delete params[key];
                }
            });

            return params;
        }
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
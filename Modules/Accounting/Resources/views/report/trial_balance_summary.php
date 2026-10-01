

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
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.trial_balance'); ?> (<?php echo app('translator')->get('lang_v1.summary'); ?>) </h2>
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
                        

                       

                    <?php
                        // Precompute once
                        $childrenByParent = $accounts->filter(function($a){
                            return !empty($a->parent_account_name);
                        })->groupBy('parent_account_name'); // child accounts grouped by their parent name

                        $accountByName = $accounts->keyBy('name'); // look up parent account record by name quickly
                    ?>

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
                                        <?php $total_credit += $retained_earnings; ?>
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
                                        <?php
                                            $subtype_debit = 0;
                                            $subtype_credit = 0;

                                            // All accounts that belong to this subtype and account_type
                                            $accountsInSubtype = $accounts
                                                ->where('account_sub_type_id', $sub_type->id)
                                                ->where('account_type', $key);

                                            // We'll collect parent rows to print after subtype row
                                            $parentRows = [];
                                        ?>

                                        
                                        <?php $__currentLoopData = $childrenByParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentName => $childAccounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                // If there is a parent account record, find where the parent wants to be printed
                                                $parentRecord = $accountByName->get($parentName);
                                                $parentTargetSubTypeId = $parentRecord ? $parentRecord->account_sub_type_id : $sub_type->id;

                                                // Only handle this parent when its target subtype is the current subtype
                                                if($parentTargetSubTypeId != $sub_type->id){
                                                    // skip â€” this parent will be printed when its own subtype is looped
                                                    continue;
                                                }

                                                // Sum child accounts that belong to this subtype & account_type (avoid cross-subtype children)
                                                $p_debit = 0;
                                                $p_credit = 0;
                                                foreach($childAccounts as $c){
                                                    if($c->account_type != $key){
                                                        continue;
                                                    }
                                                    // only include children that belong to this sub_type (avoid mixing other subtypes)
                                                    if($c->account_sub_type_id != $sub_type->id){
                                                        continue;
                                                    }

                                                    $balance = (float) $c->balance;
                                                    if(in_array($c->account_type, ['asset','expenses'])){
                                                        $d = $balance > 0 ? $balance : 0;
                                                        $c_amt = $balance < 0 ? abs($balance) : 0;
                                                    } else {
                                                        $d = $balance < 0 ? abs($balance) : 0;
                                                        $c_amt = $balance > 0 ? $balance : 0;
                                                    }

                                                    // skip zero balances for income/expenses if desired
                                                    if($d == 0 && $c_amt == 0 && in_array($c->account_type, ['income','expenses'])){
                                                        continue;
                                                    }

                                                    $p_debit += $d;
                                                    $p_credit += $c_amt;
                                                }

                                                // If a parent account record exists and belongs to this subtype, include its own balance too
                                                if($parentRecord && $parentRecord->account_type == $key && $parentRecord->account_sub_type_id == $sub_type->id){
                                                    $parentBalance = (float) $parentRecord->balance;
                                                    if(in_array($parentRecord->account_type, ['asset','expenses'])){
                                                        $pd = $parentBalance > 0 ? $parentBalance : 0;
                                                        $pc = $parentBalance < 0 ? abs($parentBalance) : 0;
                                                    } else {
                                                        $pd = $parentBalance < 0 ? abs($parentBalance) : 0;
                                                        $pc = $parentBalance > 0 ? $parentBalance : 0;
                                                    }
                                                    if(!($pd == 0 && $pc == 0 && in_array($parentRecord->account_type, ['income','expenses']))){
                                                        $p_debit += $pd;
                                                        $p_credit += $pc;
                                                    }
                                                }

                                                // register parent row (do NOT add these to $subtype_debit/_credit)
                                                if($p_debit != 0 || $p_credit != 0){
                                                    $parentRows[] = [
                                                        'name' => $parentName,
                                                        'debit' => $p_debit,
                                                        'credit' => $p_credit
                                                    ];

                                                    // add to grand totals only once
                                                    $total_debit += $p_debit;
                                                    $total_credit += $p_credit;
                                                }
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        
                                        <?php
                                            $unparented = $accountsInSubtype->filter(function($a) use ($childrenByParent) {
                                                // include only accounts that have no parent AND are not a parent name themselves
                                                return empty($a->parent_account_name) && !$childrenByParent->has($a->name);
                                            });

                                            foreach($unparented as $acc){
                                                $balance = (float) $acc->balance;
                                                if(in_array($acc->account_type, ['asset','expenses'])){
                                                    $d = $balance > 0 ? $balance : 0;
                                                    $c_amt = $balance < 0 ? abs($balance) : 0;
                                                } else {
                                                    $d = $balance < 0 ? abs($balance) : 0;
                                                    $c_amt = $balance > 0 ? $balance : 0;
                                                }

                                                if($d == 0 && $c_amt == 0 && in_array($acc->account_type, ['income','expenses'])){
                                                    continue;
                                                }

                                                $subtype_debit += $d;
                                                $subtype_credit += $c_amt;
                                            }

                                            // Add subtype totals to grand totals
                                            $total_debit += $subtype_debit;
                                            $total_credit += $subtype_credit;
                                        ?>

                                        
                                        <tr>
                                            <td style="padding-left:5%">
                                                <i class="fa fa-folder pr-5"></i> <?php echo e($sub_type->account_type_name, false); ?>

                                            </td>
                                            <td><?php if($subtype_debit != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $subtype_debit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                            <td><?php if($subtype_credit != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $subtype_credit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                        </tr>

                                        
                                        <?php $__currentLoopData = $parentRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="padding-left:8%">
                                                    <i class="fa fa-folder pr-5"></i> <?php echo e($pr['name'], false); ?>

                                                </td>
                                                <td><?php if($pr['debit'] != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pr['debit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                                <td><?php if($pr['credit'] != 0): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pr['credit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                        </tr>
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
        var trialBalanceType = '<?php echo e($type ?? request()->get('type', 'summary'), false); ?>';

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
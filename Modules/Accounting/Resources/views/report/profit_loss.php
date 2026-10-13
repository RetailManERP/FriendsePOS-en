

<?php $__env->startSection('title', __('accounting::lang.profit_loss')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.profit_loss' ); ?></h1>
</section>

<section class="row" style="padding:15px">

    <div class="col-md-3 no-print">
        <div class="form-group">
            <?php echo Form::label('date_range_filter', __('report.date_range') . ':'); ?>

            <?php echo Form::text('date_range_filter', null, 
                ['placeholder' => __('lang_v1.select_a_date_range'), 
                'class' => 'form-control', 'readonly', 'id' => 'date_range_filter']); ?>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-12">
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.profit_loss'); ?></h2>
                <p><?php echo e(\Carbon::createFromTimestamp(strtotime($start_date))->format(session('business.date_format')), false); ?> ~ <?php echo e(\Carbon::createFromTimestamp(strtotime($end_date))->format(session('business.date_format')), false); ?></p>
            </div>

            <div class="box-body">
                <div class="clearfix no-print" style="margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary pull-right" id="print_profit_loss_report">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>

                <?php
                    $gross_profit_loss = 0;
                    $net_profit_loss = 0;
                    $total_income = 0;
                    $total_cos = 0;
                    $total_expense = 0;
                ?>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered">
                        
                        <tr>
                            <th class="success h4"><?php echo app('translator')->get( 'accounting::lang.income'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th class="success"></th>
                        </tr>
                        <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td>
                                <?php echo e($income->name, false); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                <a class="btn btn-xs btn-default text-success ledger-link" 
                                    title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>"
                                    target="_BLANK"
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $income->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                    <i class="fas fa-file-alt"></i></a>
                                <?php endif; ?>
                              </td>
                              <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $income->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>  
                            </tr>
                            <?php
                                $total_income += $income->balance;
                                $gross_profit_loss += $income->balance;
                                $net_profit_loss += $income->balance;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-right"></th>
                            <th class="success"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_income, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>    
                        
                        <tr>
                            <th class="danger h4"><?php echo app('translator')->get( 'accounting::lang.cos'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th class="danger"></th>
                        </tr>
                        <?php $__currentLoopData = $cost_of_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td>
                                <?php echo e($cos->name, false); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                <a class="btn btn-xs btn-default text-success ledger-link" 
                                    title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>"
                                    target="_BLANK"
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $cos->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                    <i class="fas fa-file-alt"></i></a>
                                <?php endif; ?>
                              </td>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cos->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>  
                            </tr>
                            <?php
                                $total_cos += $cos->balance;
                                $gross_profit_loss -= $cos->balance;
                                $net_profit_loss -= $cos->balance;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th></th>
                            <th class="danger"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_cos, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>    
                        
                        <tr>
                            <th class="warning h4"><?php echo app('translator')->get( 'accounting::lang.gross_profit_loss'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th class="warning"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $gross_profit_loss, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="danger h4"><?php echo app('translator')->get( 'accounting::lang.expenses'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th class="danger"></th>
                        </tr>
                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td>
                                <?php echo e($expense->name, false); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                <a class="btn btn-xs btn-default text-success ledger-link" 
                                    title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>"
                                    target="_BLANK"
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $expense->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                    <i class="fas fa-file-alt"></i></a>
                                <?php endif; ?>
                              </td>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $expense->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>  
                            </tr>
                            <?php
                                $total_expense += $expense->balance;
                                $net_profit_loss -= $expense->balance;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th></th>
                            <th class="danger"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_expense, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>    
                        
                        <tr>
                            <th class="info h4"><?php echo app('translator')->get( 'accounting::lang.net_profit_loss'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th class="info"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $net_profit_loss, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                        </tr>
                        
                    </table>
                </div>
                
            </div>

        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var profitLossPrintUrl = '<?php echo e(route('accounting.profitLoss.print'), false); ?>';
        var profitLossType = '<?php echo e($type ?? 'detailed', false); ?>';
        var profitLossLocationId = '<?php echo e($location_id ?? 'all', false); ?>';

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

        $('#print_profit_loss_report').on('click', function(e) {
            e.preventDefault();
            window.open(profitLossPrintUrl + '?' + $.param(getProfitLossPrintParams()), '_blank');
        });

        function getProfitLossPrintParams() {
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
                location_id: urlParams.get('location_id') || profitLossLocationId || 'all',
                type: profitLossType,
                tab: profitLossType
            };
        }
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
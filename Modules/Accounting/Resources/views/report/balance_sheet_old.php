

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
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.balance_sheet'); ?> (<?php echo app('translator')->get('lang_v1.detailed'); ?>)</h2>
                <p><?php echo e(\Carbon::createFromTimestamp(strtotime($start_date))->format(session('business.date_format')), false); ?> ~ <?php echo e(\Carbon::createFromTimestamp(strtotime($end_date))->format(session('business.date_format')), false); ?></p>
            </div>

            <div class="box-body">
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
                                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total_assets += $asset->balance
                                        ?>

                                        <tr>
                                            <th>
                                                <?php echo e(!empty($asset->gl_code) ? $asset->gl_code.' - ' : '', false); ?><?php echo e($asset->name, false); ?>

                                                <a class="btn btn-xs btn-default text-success ledger-link" title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>" target="_BLANK"
                                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $asset->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                                <i class="fas fa-file-alt"></i></a>
                                            </th>
                                            <td style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $asset->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>

                            </td>

                            <td class="col-md-6">
                                <table class="table">
                                    <?php $__currentLoopData = $liabilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            $total_liab_owners += $liability->balance
                                        ?>

                                        <tr>
                                            <th>
                                                <?php echo e(!empty($liability->gl_code) ? $liability->gl_code.' - ' : '', false); ?><?php echo e($liability->name, false); ?>

                                                <a class="btn btn-xs btn-default text-success ledger-link" title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>" target="_BLANK"
                                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $liability->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                                <i class="fas fa-file-alt"></i></a>
                                            </th>
                                            <td style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $liability->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        </tr>
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
                                        <th>Retained Earnings (P/L)</th>
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
                                    <?php $__currentLoopData = $equities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total_liab_owners += $equity->balance
                                        ?>
                                        
                                        <tr>
                                            <th>
                                                <?php echo e(!empty($equity->gl_code) ? $equity->gl_code.' - ' : '', false); ?><?php echo e($equity->name, false); ?>

                                                <a class="btn btn-xs btn-default text-success ledger-link" title="<?php echo app('translator')->get( 'accounting::lang.ledger' ); ?>" target="_BLANK"
                                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $equity->id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($start_date, false); ?>&end=<?php echo e($end_date, false); ?>">
                                                <i class="fas fa-file-alt"></i></a>
                                            </th>
                                            <td style="float:right;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $equity->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        </tr>
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
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
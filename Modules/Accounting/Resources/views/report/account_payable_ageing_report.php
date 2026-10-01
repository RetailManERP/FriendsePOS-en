

<?php $__env->startSection('title', __('accounting::lang.account_payable_ageing_report')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<br><br>
<!-- Content Header (Page header) -->
<section class="content">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="form-group">
                <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, $location_id,
                    ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.account_payable_ageing_report' ); ?></h2>
                </div>
                <div class="box-body">
                    <div class="clearfix no-print" style="margin-bottom: 10px;">
                        <button type="button" class="btn btn-primary pull-right" id="print_account_payable_ageing_report">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                    </div>

                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get( 'lang_v1.supplier_name'); ?></th>
                                <th style="color: #2dce89 !important;"><?php echo app('translator')->get( 'lang_v1.current'); ?></th>
                                <th style="color: #5de9ac !important;">
                                    <?php echo app('translator')->get( 'accounting::lang.1_7_days' ); ?>
                                </th>
                                <th style="color: #ffd026 !important;">
                                    <?php echo app('translator')->get( 'accounting::lang.8_30_days' ); ?>
                                </th>
                                <th style="color: #ffa100 !important;">
                                    <?php echo app('translator')->get( 'accounting::lang.31_60_days' ); ?>
                                </th>
                                <th style="color: #f5365c !important;">
                                    <?php echo app('translator')->get( 'accounting::lang.61_90_days' ); ?>
                                </th>
                                <th style="color: #FF0000 !important;">
                                    <?php echo app('translator')->get( 'accounting::lang.91_and_over' ); ?>
                                </th>
                                <th><?php echo app('translator')->get('sale.total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_current = 0;
                                $total_1_7 = 0;
                                $total_8_30 = 0;
                                $total_31_60 = 0;
                                $total_61_90 = 0;
                                $total_greater_than_90 = 0;
                                $grand_total = 0;
                            ?>
                            <?php $__currentLoopData = $report_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                        $total_current += $report['<1'];
                                        $total_1_7 += $report['1_7'];
                                        $total_8_30 += $report['8_30'];
                                        $total_31_60 += $report['31_60'];
                                        $total_61_90 += $report['61_90'];
                                        $total_greater_than_90 += $report['>90'];
                                        $grand_total += $report['total_due'];
                                    ?>
                                    <td>
                                        <?php echo e($report['name'], false); ?>

                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['<1'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['1_7'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['8_30'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['31_60'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['61_90'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['>90'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $report['total_due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <?php echo app('translator')->get('sale.total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>

                                </th>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_current, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_1_7, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_8_30, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_31_60, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_61_90, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td>
                                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_greater_than_90, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                </td>
                                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $grand_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                            </tr>
                        </tfoot>
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
        $('#print_account_payable_ageing_report').on('click', function(e) {
            e.preventDefault();
            var location_id = $('select#location_id').val() || 'all';
            var urlParams = new URLSearchParams(window.location.search);
            var tab = urlParams.get('tab') || 'all';
            var url = "<?php echo e(route('accounting.account_payable_ageing_report.print'), false); ?>";
            window.open(url + '?' + $.param({location_id: location_id, tab: tab}), '_blank');
        });

        $('#location_id').change( function(){
            if($(this).val()) {
                window.location.href = "<?php echo e(route('accounting.account_payable_ageing_report'), false); ?>?location_id=" + $(this).val();
            } else {
                window.location.href = "<?php echo e(route('accounting.account_payable_ageing_report'), false); ?>";
            }
            
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
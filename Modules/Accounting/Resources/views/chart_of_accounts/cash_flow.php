

<?php $__env->startSection('title', __('accounting::lang.cash_flow_report')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.cash_flow_report' ); ?> - <?php echo e($account->name, false); ?></h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-md-7 col-xs-6">
        
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> <i class="fa fa-filter" aria-hidden="true"></i> <?php echo app('translator')->get('report.filters'); ?>:</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                            <?php echo Form::select(
                            'location_id',
                            $business_locations,
                            null,
                            ['class' => 'form-control select2 col-xs-6' , 'style'=>'width:100%'],
                            ); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                                <?php echo Form::label('transaction_date_range', __('report.date_range') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <?php echo Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('all_accounts', __( 'accounting::lang.account' ) . ':'); ?>

                            <?php echo Form::select('account_filter', $cash_flow_accounts, $account->id,
                                ['class' => 'form-control cash-flow-accounts-dropdown', 'style' => 'width:100%', 
                                'id' => 'account_filter', 'data-default' => $account->id]); ?>

                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-md-5 col-xs-6">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-condensed">
                        <tr>
                            <th><?php echo app('translator')->get( 'user.name' ); ?>:</th>
                            <td>
                                <?php echo e($account->name, false); ?>


                                <?php if(!empty($account->gl_code)): ?>
                                    (<?php echo e($account->gl_code, false); ?>)
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get( 'accounting::lang.account_type' ); ?>:</th>
                            <td>
                                <?php if(!empty($account->account_primary_type)): ?>
                                    <?php echo e(__('accounting::lang.' . $account->account_primary_type), false); ?>

                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get( 'accounting::lang.account_sub_type' ); ?>:</th>
                            <td>
                                <?php if(!empty($account->account_sub_type)): ?>
                                    <?php echo e(__('accounting::lang.' . $account->account_sub_type->name), false); ?>

                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get( 'accounting::lang.detail_type' ); ?>:</th>
                            <td>
                                <?php if(!empty($account->detail_type)): ?>
                                    <?php echo e(__('accounting::lang.' . $account->detail_type->name), false); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get( 'lang_v1.brought_forward' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $brought_forward, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get( 'lang_v1.closing_balance' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $current_bal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-sm-12 text-right">
            <button type="button"
                data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'printCashFlowReport'], ['id' => $account->id]), false); ?>"
                id="print_cash_flow_btn"
                class="btn btn-primary">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
        	<div class="box box-primary">
                <div class="box-body">
                    
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.cash_flow_report.view')): ?>
                        <div class="text-center">
                            <b class="h4 p4"><?php echo app('translator')->get('lang_v1.cash_inflows'); ?></b>
                            <hr>
                        </div>
                        <div class="table-responsive" style="overflow-x: hidden;">
                    	<table class="table table-bordered table-striped table-th-skin" id="cash_flow_debit">
                    		<thead>
                    			<tr>
                                    <th style="width: 50px;"><?php echo app('translator')->get( 'messages.date' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                    <th class="text-center" style="width: 120px;"><?php echo app('translator')->get( 'purchase.amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    			</tr>
                    		</thead>

                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-right">
                                    <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</strong></td>
                                    <td class="footer_total_debit"></td>
                                </tr>
                            </tfoot>
                    	</table>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
        	<div class="box box-primary">
                <div class="box-body">
                    
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.cash_flow_report.view')): ?>
                        <div class="text-center">
                            <b class="h4 p4"><?php echo app('translator')->get('lang_v1.cash_outflows'); ?></b>
                            <hr>
                        </div>
                        <div class="table-responsive" style="overflow-x: hidden;">
                    	<table class="table table-bordered table-striped table-th-skin" id="cash_flow_credit">
                    		<thead>
                    			<tr>
                                    <th style="width: 50px;"><?php echo app('translator')->get( 'messages.date' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                    <th class="text-center" style="width: 120px;"><?php echo app('translator')->get( 'purchase.amount' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    			</tr>
                    		</thead>

                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-right">
                                    <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</strong></td>
                                    <td class="footer_total_credit"></td>
                                </tr>
                            </tfoot>
                    	</table>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="box box-primary">
                <div class="box-body">
                    <div class="col-md-8 col-xs-0"></div>
                    <div class="col-md-4 col-xs-12">
                        <table class="table table-condensed">
                            <tbody><tr>
                                <th>Brought Forward <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                                <td><span id="brought_forward" data-value="<?php echo e($brought_forward, false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $brought_forward, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get( 'lang_v1.total_cash_inflows' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                                <td><span id="total_debits"></span></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get( 'lang_v1.total_cash_outflows' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                                <td><span id="total_credits"></span></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get( 'lang_v1.net_cash_flows' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                                <td><span id="net_cash_flows"></span></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get( 'lang_v1.closing_balance' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</th>
                                <td><b id="final_balance"></b></td>
                            </tr>
                        </tbody></table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function(){        

        const urlParams = new URLSearchParams(window.location.search);
        const start_date = urlParams.get('start');
        const end_date = urlParams.get('end');
        const location_id = urlParams.get('location_id');
        const default_start_date = <?php echo json_encode($start_date ?? date('Y-m-d'), 15, 512) ?>;
        const default_end_date = <?php echo json_encode($end_date ?? date('Y-m-d'), 15, 512) ?>;

        if(location_id != null){   
            $("#location_id").val(location_id);
            $("#location_id").trigger("change");
            $("#location_id").select2();
        }

        var cashFlowDateRangeSettings = $.extend({}, dateRangeSettings);
        cashFlowDateRangeSettings.startDate = start_date ? moment(start_date) : moment(default_start_date);
        cashFlowDateRangeSettings.endDate = end_date ? moment(end_date) : moment(default_end_date);
        
        $('#account_filter').change(function(){
            account_id = $(this).val();
            let start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let location_id = $('#location_id').val();
            url = base_path + '/accounting/cash-flow-report/' + account_id + '?location_id='+location_id+'&start='+start+'&end='+end+'';
            window.location = url;
        });

        $('#transaction_date_range').daterangepicker(
            cashFlowDateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                // cash_flow_debit.ajax.reload();
                // cash_flow_credit.ajax.reload();
                $('#account_filter').trigger('change');
            }
        );
        var cashFlowDatePicker = $('#transaction_date_range').data('daterangepicker');
        if (cashFlowDatePicker) {
            $('#transaction_date_range').val(cashFlowDatePicker.startDate.format(moment_date_format) + ' ~ ' + cashFlowDatePicker.endDate.format(moment_date_format));
        }

        $('#location_id').change(function(){
            // cash_flow_debit.ajax.reload();
            // cash_flow_credit.ajax.reload();
            $('#account_filter').trigger('change');
        });

        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('');
            // cash_flow_debit.ajax.reload();
            // cash_flow_credit.ajax.reload();
            $('#account_filter').trigger('change');
        });

        cash_flow_debit = $('#cash_flow_debit').DataTable({
                            processing: true,
                            serverSide: true,
                            dom: 'lfrtip',
                            // buttons: ['excel', 'pdf', 'print'],
                            ajax: {
                                url: '<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'cash_flow_report'],[$account->id]), false); ?>',
                                data: function(d) {
                                    var start = '';
                                    var end = '';
                                    if($('#transaction_date_range').val()){
                                        start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    }
                                    d.start_date = start;
                                    d.end_date = end;
                                    d.type = 'debit';
                                    d.location_id = $('select#location_id').val();
                                }
                            },
                            "ordering": false,
                            columns: [
                                {data: 'operation_date', name: 'operation_date'},
                                {data: 'ref_no', name: 'ATM.ref_no'},
                                {data: 'debit', name: 'amount', searchable: false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#cash_flow_debit'));
                            },
                            "footerCallback": function ( row, data, start, end, display ) {
                                var footer_total_debit = 0;
                                for (var r in data){
                                    footer_total_debit += $(data[r].debit).data('orig-value') ? parseFloat($(data[r].debit).data('orig-value')) : 0;
                                }
                                $('.footer_total_debit').html(__currency_trans_from_en(footer_total_debit));
                                $('#total_debits').html(__currency_trans_from_en(footer_total_debit));
                                $('#total_debits').attr('data-value', footer_total_debit);
                                calculateBalance();
                                $('.dataTables_wrapper').find('.dataTables_length').addClass('no-print');
                                $('.dataTables_wrapper').find('.dataTables_filter').addClass('no-print');
                                $('.dataTables_wrapper').find('.dataTables_info').addClass('no-print');
                                $('.dataTables_wrapper').find('.dataTables_paginate').addClass('no-print');
                            }
                        });

        cash_flow_credit = $('#cash_flow_credit').DataTable({
                            processing: true,
                            serverSide: true,
                            dom: 'lfrtip',
                            // buttons: ['excel', 'pdf', 'print'],
                            ajax: {
                                url: '<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'cash_flow_report'],[$account->id]), false); ?>',
                                data: function(d) {
                                    var start = '';
                                    var end = '';
                                    if($('#transaction_date_range').val()){
                                        start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    }
                                    d.start_date = start;
                                    d.end_date = end;
                                    d.type = 'credit';
                                    d.location_id = $('select#location_id').val();
                                }
                            },
                            "ordering": false,
                            columns: [
                                {data: 'operation_date', name: 'operation_date'},
                                {data: 'ref_no', name: 'ATM.ref_no'},
                                {data: 'credit', name: 'amount', searchable: false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#cash_flow_credit'));
                            },
                            "footerCallback": function ( row, data, start, end, display ) {
                                var footer_total_credit = 0;
                                for (var r in data){
                                    footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                                }
                                $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                                $('#total_credits').html(__currency_trans_from_en(footer_total_credit));
                                $('#total_credits').attr('data-value', footer_total_credit);
                                calculateBalance();
                            }
                        });

                        $(document).on('click', '#print_cash_flow_btn', function() {
                            let start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            let end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                            let location_id = $('#location_id').val();

                            var url = $(this).data('href') + '?tab=all&location_id=' + location_id + '&start=' + start + '&end=' + end;
                            window.open(url);
                        });
                        setTimeout(() => {
                            calculateBalance();    
                        }, 1500);
                        
    });
    
    function calculateBalance(){
        var brought_forward = ($('#brought_forward').attr('data-value')) ? parseFloat($('#brought_forward').attr('data-value')) : 0;
        var total_debits = parseFloat($('#total_debits').attr('data-value')); 
        var total_credits = parseFloat($('#total_credits').attr('data-value'));
        var net_cash_flows = total_debits - total_credits;
        var balance =  brought_forward;
        balance = balance + total_debits;
        balance = balance - total_credits;
        $('#final_balance').html(__currency_trans_from_en(balance));
        $('#net_cash_flows').html(__currency_trans_from_en(net_cash_flows));
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
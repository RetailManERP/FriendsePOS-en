

<?php $__env->startSection('title', __('accounting::lang.ledger') . ' - ' . $account->name); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.ledger' ); ?> - <?php echo e($account->name, false); ?></h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-md-7">
            <input type="hidden" id="business_location" value="">
            <input type="hidden" id="date_range" value="">
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
                            ['class' => 'form-control select2'],
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

                            <?php echo Form::select('account_filter', [$account->id => $account->name], $account->id,
                                ['class' => 'form-control accounts-dropdown', 'style' => 'width:100%', 
                                'id' => 'account_filter', 'data-default' => $account->id]); ?>

                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-md-5">
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
                            <th><?php echo app('translator')->get( 'lang_v1.balance' ); ?>:</th>
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
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-12">
        	<div class="box box-primary">
                <div class="box-body">
                    
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                        <div class="text-end mb-2 no-print">
                            <button type="button" class="btn btn-primary" id="print_ledger_report">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                    	<table class="table table-bordered table-striped table-th-skin" id="ledger">
                    		<thead>
                    			<tr>
                                    <th><?php echo app('translator')->get( 'messages.date' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                    <th><?php echo app('translator')->get( 'brand.note' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.added_by' ); ?></th>
                                    <th><?php echo app('translator')->get('account.debit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    <th><?php echo app('translator')->get('account.credit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    				<th><?php echo app('translator')->get( 'lang_v1.balance' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    
                    			</tr>
                    		</thead>

                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?>:</strong></td>
                                    <td class="footer_total_debit"></td>
                                    <td class="footer_total_credit"></td>
                                    <td></td>
                                    
                                </tr>
                            </tfoot>
                    	</table>
                        </div>
                    <?php endif; ?>
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

        var location = $('#select2-location_id-container').text();
        $('#business_location').val(location);
        var ledgerPrintUrl = '<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'printLedger'], [$account->id]), false); ?>';

        $('#brought_forward').html(' 0');
        var ledgerDateRangeSettings = $.extend({}, dateRangeSettings);
        ledgerDateRangeSettings.startDate = start_date ? moment(start_date) : moment(default_start_date);
        ledgerDateRangeSettings.endDate = end_date ? moment(end_date) : moment(default_end_date);
        
        $('#account_filter').change(function(){
            account_id = $(this).val();
            let start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let location_id = $('#location_id').val();
            url = base_path + '/accounting/ledger/' + account_id + '?location_id='+location_id+'&start='+start+'&end='+end+'';
            window.location = url;
        });

        $('#transaction_date_range').daterangepicker(
            ledgerDateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var dateRange = $('#transaction_date_range').val();
                $('#date_range').val(dateRange);
                // ledger.ajax.reload();
                $('#account_filter').trigger('change');
            }
        );
        var ledgerDatePicker = $('#transaction_date_range').data('daterangepicker');
        if (ledgerDatePicker) {
            $('#transaction_date_range').val(ledgerDatePicker.startDate.format(moment_date_format) + ' ~ ' + ledgerDatePicker.endDate.format(moment_date_format));
            $('#date_range').val($('#transaction_date_range').val());
        }

        $('#location_id').change(function(){
            // ledger.ajax.reload();
            var location = $('select#location_id').find('option:selected').text();
            $('#business_location').val(location);
            $('#account_filter').trigger('change');
        });
        // Account Book
        ledger = $('#ledger').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'],[$account->id]), false); ?>',
                data: function(d) {
                    var start = '';
                    var end = '';
                    if($('#transaction_date_range').val()){
                        start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    }
                    var transaction_type = $('select#transaction_type').val();
                    d.start_date = start;
                    d.end_date = end;
                    d.type = transaction_type;
                    d.location_id = $('select#location_id').val();
                }
            },
            "ordering": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'ref_no', name: 'ATM.ref_no'},
                {data: 'note', name: 'ATM.note'},
                {data: 'added_by', name: 'added_by'},
                {data: 'debit', name: 'amount', searchable: false},
                {data: 'credit', name: 'amount', searchable: false},
                {data: 'balance', name: 'balance', searchable: false},
                // {data: 'action', name: 'action', searchable: false}
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#ledger'));
                $('#brought_forward').html($(".balance_brought_forward:first").val());
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var footer_total_debit = 0;
                var footer_total_credit = 0;

                for (var r in data){
                    footer_total_debit += $(data[r].debit).data('orig-value') ? parseFloat($(data[r].debit).data('orig-value')) : 0;
                    footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                }
                
                $('.footer_total_debit').html(__currency_trans_from_en(footer_total_debit, false));
                $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit, false));

            }
        });

        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('');
            // ledger.ajax.reload();
            $('#account_filter').trigger('change');
        });

        $('#print_ledger_report').on('click', function(e) {
            e.preventDefault();
            window.open(ledgerPrintUrl + '?' + $.param(getLedgerPrintParams()), '_blank');
        });

        function getLedgerPrintParams() {
            var start = '';
            var end = '';
            var dp = $('input#transaction_date_range').data('daterangepicker');

            if ($('#transaction_date_range').val() && dp) {
                start = dp.startDate.format('YYYY-MM-DD');
                end = dp.endDate.format('YYYY-MM-DD');
            }

            var params = {
                location_id: $('select#location_id').val(),
                start: start,
                end: end,
                tab: 'all'
            };

            $.each(params, function(key, value) {
                if (value === '' || value === null || typeof value === 'undefined') {
                    delete params[key];
                }
            });

            return params;
        }

        var dateRange = $('#transaction_date_range').val();
        $('#date_range').val(dateRange);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
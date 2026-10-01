

<?php $__env->startSection('title', __('accounting::lang.transactions')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.transactions' ); ?>
        <?php if(auth()->user()->can('accounting.map_transactions')): ?>
            <button type="button" class="btn btn-primary btn-sm" id="btn-remap-all" style="margin-left: 15px; vertical-align: middle;">
                <i class="fas fa-sync" id="btn-remap-all-icon"></i> <span id="btn-remap-all-text">Remap All</span>
            </button>
            <button type="button" class="btn btn-danger btn-sm cancel_accounting_remap" data-url="<?php echo e(route('accounting.transactions.remap-all.cancel'), false); ?>" style="margin-left: 6px; vertical-align: middle;">
                <i class="fas fa-ban"></i> Cancel Remap
            </button>
        <?php endif; ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- Tab Navigation -->
                <div class="box-header with-border">
                    <ul class="nav nav-tabs accounting-transactions-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#opening_balance_tab" aria-controls="opening_balance_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.contact_opening_balance'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#opening_stock_tab" aria-controls="opening_stock_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.opening_stock'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#purchase_tab" aria-controls="purchase_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('purchase.purchases'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#purchase_return_tab" aria-controls="purchase_return_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('purchase.purchase_return'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#sell_tab" aria-controls="sell_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('sale.sale'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#sell_return_tab" aria-controls="sell_return_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('sale.sale_returns'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#stock_adjustment_tab" aria-controls="stock_adjustment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.stock_adjustment'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#expense_tab" aria-controls="expense_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.expenses_title'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#advance_deposit_tab" aria-controls="advance_deposit_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.advance_deposits'); ?>
                            </a>
                        </li>
                        <?php if(in_array('manufacturing_module', $enabled_module)): ?>
                        <li role="presentation">
                            <a href="#production_tab" aria-controls="production_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('manufacturing::lang.production'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#reverse_production_tab" aria-controls="reverse_production_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('manufacturing::lang.reverse_production'); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('essentials_module', $enabled_module)): ?>
                        <li role="presentation">
                            <a href="#payroll_tab" aria-controls="payroll_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('essentials::lang.payroll'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#payroll_advance_tab" aria-controls="payroll_advance_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('essentials::lang.advance_payments'); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li role="presentation">
                            <a href="#sell_payment_tab" aria-controls="sell_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.sales_payments'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#sell_return_payment_tab" aria-controls="sell_return_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('sale.sale_return_payments'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#purchase_payment_tab" aria-controls="purchase_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.purchase_payments'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#purchase_return_payment_tab" aria-controls="purchase_return_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.purchase_return_payments'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#stock_adjustment_payment_tab" aria-controls="stock_adjustment_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.stock_adjustment_payment'); ?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#expense_payment_tab" aria-controls="expense_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.expense_payments_title'); ?>
                            </a>
                        </li>
                        <?php if(in_array('essentials_module', $enabled_module)): ?>
                        <li role="presentation">
                            <a href="#payroll_payment_tab" aria-controls="payroll_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('essentials::lang.payroll_payments'); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li role="presentation">
                            <a href="#contact_payment_tab" aria-controls="contact_payment_tab" role="tab" data-toggle="tab" class="accounting-tab-link">
                                <?php echo app('translator')->get('accounting::lang.contact_payments'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content Panes -->
                <div class="box-body tab-content accounting-tab-content">
                    <!-- Opening Balance Tab -->
                    <div role="tabpanel" class="tab-pane fade in active" id="opening_balance_tab">
                        <?php echo $__env->make('accounting::transactions.partials.opening_balance', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Opening Stock Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="opening_stock_tab">
                        <?php echo $__env->make('accounting::transactions.partials.opening_stock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Advance Deposit Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="advance_deposit_tab">
                        <?php echo $__env->make('accounting::transactions.partials.advance_deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Contact Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="contact_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "contact_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Sales Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="sell_tab">
                        <?php echo $__env->make('accounting::transactions.partials.sales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Sales Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="sell_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "sell_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Sale Returns Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="sell_return_tab">
                        <?php echo $__env->make('accounting::transactions.partials.sale_returns', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Sale Return Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="sell_return_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "sell_return_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Purchase Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="purchase_tab">
                        <?php echo $__env->make('accounting::transactions.partials.purchases', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Purchase Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="purchase_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "purchase_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Purchase Return Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="purchase_return_tab">
                        <?php echo $__env->make('accounting::transactions.partials.purchase_returns', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Purchase Return Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="purchase_return_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "purchase_return_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Stock Adjustment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="stock_adjustment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.stock_adjustment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Stock Adjustment Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="stock_adjustment_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "stock_adjustment_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Expense Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="expense_tab">
                        <?php echo $__env->make('accounting::transactions.partials.expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Expense Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="expense_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "expense_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <?php if(in_array('essentials_module', $enabled_module)): ?>
                    <!-- Payroll Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="payroll_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payroll', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Payroll Payment Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="payroll_payment_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payments', ['id' => "payroll_payment_table"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Payroll Advance Payments Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="payroll_advance_tab">
                        <?php echo $__env->make('accounting::transactions.partials.payroll_advance', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(in_array('manufacturing_module', $enabled_module)): ?>
                    <!-- Production Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="production_tab">
                        <?php echo $__env->make('accounting::transactions.partials.production', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <!-- Reverse Production Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="reverse_production_tab">
                        <?php echo $__env->make('accounting::transactions.partials.reverse_production', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        // ===== Tab Switching Logic =====
        // Handle tab switching for proper content isolation
        $(document).on('click', '.accounting-tab-link', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            
            // Remove active class from all tabs
            $('.accounting-transactions-tabs > li').removeClass('active');
            
            // Hide all tab panes
            $('.accounting-tab-content .tab-pane').removeClass('active in');
            
            // Add active class to clicked tab
            $(this).closest('li').addClass('active');
            
            // Show target tab pane
            $(target).addClass('active in');
            
            // Trigger DataTable redraw if the table exists in this pane
            setTimeout(function() {
                var table_id = $(target).find('.datatable').attr('id');
                if (table_id && typeof window[table_id] !== 'undefined') {
                    window[table_id].columns.adjust().draw(false);
                }
            }, 100);
        });

        // Set initial active tab
        $('.accounting-transactions-tabs > li.active').first().find('a').click();
        
        
        // Set default date to TODAY for all date range filters
        var todaySettings = $.extend(true, {}, dateRangeSettings);
        todaySettings.startDate = moment();
        todaySettings.endDate = moment();
        todaySettings.autoUpdateInput = false;
        
        var dateRangeFilters = {
            '#sell_list_filter_date_range': 'sell_table',
            '#sell_return_list_filter_date_range': 'sell_return_table',
            '#purchase_list_filter_date_range': 'purchase_table',
            '#purchase_return_list_filter_date_range': 'purchase_return_table',
            '#expense_filter_date_range': 'expenses_table',
            '#stock_adjustment_filter_date_range': 'stock_adjustment_table',
            '#opening_stock_filter_date_range': 'opening_stock_table',
            '#production_filter_date_range': 'production_table',
            '#reverse_production_filter_date_range': 'reverse_production_table',
            '#advance_deposit_filter_date_range': 'advance_deposit_table',
            '#payroll_filter_date_range': 'payroll_table',
            '#payroll_advance_filter_date_range': 'payroll_advance_table',
            '#payment_filter_date_range_sell_payment_table': 'sell_payment_table',
            '#payment_filter_date_range_sell_return_payment_table': 'sell_return_payment_table',
            '#payment_filter_date_range_purchase_payment_table': 'purchase_payment_table',
            '#payment_filter_date_range_purchase_return_payment_table': 'purchase_return_payment_table',
            '#payment_filter_date_range_stock_adjustment_payment_table': 'stock_adjustment_payment_table',
            '#payment_filter_date_range_expense_payment_table': 'expense_payment_table',
            '#payment_filter_date_range_contact_payment_table': 'contact_payment_table',
            '#payment_filter_date_range_payroll_payment_table': 'payroll_payment_table'
        };
        
        $.each(dateRangeFilters, function(selector, tableName) {
            if ($(selector).length && !$(selector).data('daterangepicker')) {
                $(selector).daterangepicker(todaySettings, function (start, end) {
                    $(selector).val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    // Reload the corresponding table
                    if (typeof window[tableName] !== 'undefined') {
                        window[tableName].ajax.reload();
                    }
                });
                // Set initial value to TODAY
                $(selector).val(moment().format(moment_date_format) + ' ~ ' + moment().format(moment_date_format));
            }
            
            // Add cancel event handler
            $(selector).on('cancel.daterangepicker', function(ev, picker) {
                $(selector).val('');
                // Reload the corresponding table
                if (typeof window[tableName] !== 'undefined') {
                    window[tableName].ajax.reload();
                }
            });
        });

        function updateAccountingFooterTotals(tableId, json) {
            var totals = json && json.footer_totals ? json.footer_totals : {};
            var $wrapper = $('#' + tableId + '_wrapper');
            var $scope = $wrapper.length ? $wrapper : $('#' + tableId);

            $.each(totals, function(key, value) {
                var $cells = $scope.find('tfoot .footer_' + key);
                var number = parseFloat(value) || 0;
                var footerFormat = $cells.data('footer-format');

                if (footerFormat == 'quantity' && typeof __number_f === 'function') {
                    $cells.html(__number_f(number, false, false, __quantity_precision));
                } else {
                    $cells.html(__currency_trans_from_en(number));
                }
            });
        }

        function accountingTransactionsDrawCallback(tableId, oSettings) {
            __currency_convert_recursively($('#' + tableId));
            updateAccountingFooterTotals(tableId, oSettings && oSettings.json ? oSettings.json : {});
        }
        
        sell_table = $('#sell_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            "ajax": {
                "url": "/accounting/transactions?type=sell&datatable=sell",
                "data": function ( d ) {
                    if($('#sell_list_filter_date_range').val()) {
                        var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.is_direct_sale = 1;

                    d.location_id = $('#sell_list_filter_location_id').val();
                    d.customer_id = $('#sell_list_filter_customer_id').val();
                    d.payment_status = $('#sell_list_filter_payment_status').val();
                    d.mapping_type = $('#sell_list_filter_mapping_type').val();
                    d.created_by = $('#created_by').val();
                    d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                    d.service_staffs = $('#service_staffs').val();

                    if($('#shipping_status').length) {
                        d.shipping_status = $('#shipping_status').val();
                    }

                    if($('#sell_list_filter_source').length) {
                        d.source = $('#sell_list_filter_source').val();
                    }

                    if($('#only_subscriptions').is(':checked')) {
                        d.only_subscriptions = 1;
                    }

                    d = __datatable_ajax_callback(d);
                }
            },
            scrollY:        "75vh",
            scrollX:        true,
            scrollCollapse: true,
            columns: [
                { data: 'action', name: 'action', orderable: false, "searchable": false},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'conatct_name', name: 'conatct_name'},
                { data: 'mobile', name: 'contacts.mobile'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'payment_status', name: 'payment_status'},
                { data: 'payment_methods', orderable: false, "searchable": false},
                { data: 'final_total', name: 'final_total'},
                { data: 'total_paid', name: 'total_paid', "searchable": false},
                { data: 'added_by', name: 'u.first_name'},
                { data: 'additional_notes', name: 'additional_notes'},
                { data: 'staff_note', name: 'staff_note'}
            ],
            "fnDrawCallback": function (oSettings) {
                accountingTransactionsDrawCallback('sell_table', oSettings);
            },
        });

        sell_payment_table = $('#sell_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=sell&datatable=payment",
                                "data": function ( d ) {
                                    if($('#payment_filter_date_range_sell_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_sell_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_sell_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.location_id = $('#sell_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.mapping_type = $('#payment_filter_mapping_type_sell_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('sell_payment_table', oSettings);
                            }
                        });

        sell_return_table = $('#sell_return_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            "ajax": {
                "url": "/accounting/transactions?type=sell_return&datatable=sell_return",
                "data": function ( d ) {
                    if($('#sell_return_list_filter_date_range').val()) {
                        var start = $('#sell_return_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#sell_return_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.is_direct_sale = 1;

                    d.location_id = $('#sell_return_list_filter_location_id').val();
                    d.customer_id = $('#sell_return_list_filter_customer_id').val();
                    d.payment_status = $('#sell_return_list_filter_payment_status').val();
                    d.mapping_type = $('#sell_return_list_filter_mapping_type').val();
                    d.created_by = $('#created_by').val();
                    d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                    d.service_staffs = $('#service_staffs').val();

                    if($('#shipping_status').length) {
                        d.shipping_status = $('#shipping_status').val();
                    }

                    if($('#sell_list_filter_source').length) {
                        d.source = $('#sell_list_filter_source').val();
                    }

                    if($('#only_subscriptions').is(':checked')) {
                        d.only_subscriptions = 1;
                    }

                    d = __datatable_ajax_callback(d);
                }
            },
            scrollY:        "75vh",
            scrollX:        true,
            scrollCollapse: true,
            columns: [
                { data: 'action', name: 'action', orderable: false, "searchable": false},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'conatct_name', name: 'conatct_name'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'payment_status', name: 'payment_status'},
                { data: 'final_total', name: 'final_total'},
                { data: 'total_remaining', name: 'total_remaining', "searchable": false},
                { data: 'added_by', name: 'u.first_name'},
            ],
            "fnDrawCallback": function (oSettings) {
                accountingTransactionsDrawCallback('sell_return_table', oSettings);
            }
        });

        //Sell Return Payments Table
        sell_return_payment_table = $('#sell_return_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=sell_return&datatable=payment",
                                "data": function ( d ) {
                                    if($('#payment_filter_date_range_sell_return_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_sell_return_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_sell_return_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.location_id = $('#sell_return_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.mapping_type = $('#payment_filter_mapping_type_sell_return_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('sell_return_payment_table', oSettings);
                            }
                        });

        //Purchase table
        purchase_table = $('#purchase_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=purchase',
                data: function(d) {
                    if ($('#purchase_list_filter_location_id').length) {
                        d.location_id = $('#purchase_list_filter_location_id').val();
                    }
                    if ($('#purchase_list_filter_supplier_id').length) {
                        d.supplier_id = $('#purchase_list_filter_supplier_id').val();
                    }
                    if ($('#purchase_list_filter_payment_status').length) {
                        d.payment_status = $('#purchase_list_filter_payment_status').val();
                    }
                    if ($('#purchase_list_filter_status').length) {
                        d.status = $('#purchase_list_filter_status').val();
                    }
                    if ($('#purchase_list_filter_mapping_type').length) {
                        d.mapping_type = $('#purchase_list_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#purchase_list_filter_date_range').val()) {
                        start = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'name', name: 'contacts.name' },
                { data: 'status', name: 'status' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_due', name: 'payment_due', orderable: false, searchable: false },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('purchase_table', oSettings);
            }
        });
        
        //Purchase Payments Table
        purchase_payment_table = $('#purchase_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=purchase&datatable=payment",
                                "data": function ( d ) {
                                    if($('#payment_filter_date_range_purchase_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_purchase_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_purchase_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.location_id = $('#purchase_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.mapping_type = $('#payment_filter_mapping_type_purchase_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('purchase_payment_table', oSettings);
                            }
                        });

        //Purchase Returns Table
        purchase_return_table = $('#purchase_return_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=purchase_return',
                data: function(d) {
                    if ($('#purchase_return_list_filter_location_id').length) {
                        d.location_id = $('#purchase_return_list_filter_location_id').val();
                    }
                    if ($('#purchase_return_list_filter_supplier_id').length) {
                        d.supplier_id = $('#purchase_return_list_filter_supplier_id').val();
                    }
                    if ($('#purchase_return_list_filter_payment_status').length) {
                        d.payment_status = $('#purchase_return_list_filter_payment_status').val();
                    }
                    if ($('#purchase_return_list_filter_status').length) {
                        d.status = $('#purchase_return_list_filter_status').val();
                    }
                    if ($('#purchase_return_filter_mapping_type').length) {
                        d.mapping_type = $('#purchase_return_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#purchase_return_list_filter_date_range').val()) {
                        start = $('input#purchase_return_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#purchase_return_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'name', name: 'contacts.name' },
                { data: 'status', name: 'status' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_due', name: 'payment_due', orderable: false, searchable: false },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('purchase_return_table', oSettings);
            }
        });

        //Purchase Return Payments Table
        purchase_return_payment_table = $('#purchase_return_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=purchase_return&datatable=payment",
                                "data": function ( d ) {
                                    if($('#payment_filter_date_range_purchase_return_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_purchase_return_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_purchase_return_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.location_id = $('#purchase_return_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.mapping_type = $('#payment_filter_mapping_type_purchase_return_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('purchase_return_payment_table', oSettings);
                            }
                        });

        //Opening Stock Table
        opening_stock_table = $('#opening_stock_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=opening_stock',
                data: function(d) {
                    if ($('#opening_stock_filter_location_id').length) {
                        d.location_id = $('#opening_stock_filter_location_id').val();
                    }
                    if ($('#opening_stock_filter_mapping_type').length) {
                        d.mapping_type = $('#opening_stock_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#opening_stock_filter_date_range').val()) {
                        start = $('input#opening_stock_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#opening_stock_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'sku', name: 'sku' },
                { data: 'qty', name: 'sale.qty' },
                { data: 'final_total', name: 'final_total' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('opening_stock_table', oSettings);
            }
        });

        //Expense table
        expenses_table = $('#expenses_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=expense',
                data: function(d) {
                    if ($('#expense_filter_location_id').length) {
                        d.location_id = $('#expense_filter_location_id').val();
                    }
                    if ($('#expense_filter_payment_status').length) {
                        d.payment_status = $('#expense_filter_payment_status').val();
                    }
                    if ($('#expense_filter_mapping_type').length) {
                        d.mapping_type = $('#expense_filter_mapping_type').val();
                    }
                    var start = '';
                    var end = '';
                    if ($('#expense_filter_date_range').val()) {
                        start = $('input#expense_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#expense_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                // { data: 'name', name: 'contacts.name' },
                // { data: 'status', name: 'status' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_due', name: 'payment_due', orderable: false, searchable: false },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('expenses_table', oSettings);
            }
        });

        expense_payment_table = $('#expense_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=expense&datatable=payment",
                                "data": function ( d ) {
                                    d.location_id = $('#expense_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.payment_method = $('#expense_payment_tab select[name="payment_filter_status"]').val();
                                    if($('#payment_filter_date_range_expense_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_expense_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_expense_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.mapping_type = $('#payment_filter_mapping_type_expense_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('expense_payment_table', oSettings);
                            }
                        });

        //Expense table
        stock_adjustment_table = $('#stock_adjustment_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=stock_adjustment',
                data: function(d) {
                    if ($('#stock_adjustment_filter_location_id').length) {
                        d.location_id = $('#stock_adjustment_filter_location_id').val();
                    }
                    if ($('#stock_adjustment_filter_mapping_type').length) {
                        d.mapping_type = $('#stock_adjustment_filter_mapping_type').val();
                    }
                    var start = '';
                    var end = '';
                    if ($('#stock_adjustment_filter_date_range').val()) {
                        start = $('input#stock_adjustment_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#stock_adjustment_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'adjustment_type', name: 'adjustment_type' },
                { data: 'final_total', name: 'final_total' },
                { data: 'total_amount_recovered', name: 'total_amount_recovered', orderable: false, searchable: false },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('stock_adjustment_table', oSettings);
            }
        });

        //Purchase Payments Table
        stock_adjustment_payment_table = $('#stock_adjustment_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=stock_adjustment&datatable=payment",
                                "data": function ( d ) {
                                    d.location_id = $('#stock_adjustment_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.payment_method = $('#stock_adjustment_payment_tab select[name="payment_filter_status"]').val();
                                    if($('#payment_filter_date_range_stock_adjustment_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_stock_adjustment_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_stock_adjustment_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.mapping_type = $('#payment_filter_mapping_type_stock_adjustment_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('stock_adjustment_payment_table', oSettings);
                            }
                        });
        
        //Contact Opening Balance table
        var obSettings = $.extend(true, {}, dateRangeSettings);
        obSettings.startDate = moment();
        obSettings.endDate = moment();
        obSettings.autoUpdateInput = false;
        
         $('#opening_balance_filter_date_range').daterangepicker(
            obSettings,
            function (start, end) {
                $('#opening_balance_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                // $('#date_range').val(dateRange);
                opening_balance_table.ajax.reload();
            }
        );
        // Set initial value to TODAY
        $('#opening_balance_filter_date_range').val(moment().format(moment_date_format) + ' ~ ' + moment().format(moment_date_format));
        
        // Add cancel handler for opening balance date filter
        $('#opening_balance_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#opening_balance_filter_date_range').val('');
            opening_balance_table.ajax.reload();
        });
        opening_balance_table = $('#opening_balance_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=opening_balance',
                data: function(d) {
                    if ($('#opening_balance_filter_location_id').length) {
                        d.location_id = $('#opening_balance_filter_location_id').val();
                    }
                    if ($('#opening_balance_filter_contact_type').length) {
                        d.contact_type = $('#opening_balance_filter_contact_type').val();
                    }
                    if ($('#opening_balance_filter_mapping_type').length) {
                        d.mapping_type = $('#opening_balance_filter_mapping_type').val();
                    }
                    var start = '';
                    var end = '';
                    if ($('#opening_balance_filter_date_range').val()) {
                        start = $('input#opening_balance_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#opening_balance_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'contact_type', name: 'contacts.type' },
                { data: 'name', name: 'contacts.name' },
                { data: 'final_total', name: 'final_total' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('opening_balance_table', oSettings);
            }
        });
        $('select#opening_balance_filter_location_id').on('change', function() {
            var location = $('select#opening_balance_filter_location_id').find('option:selected').text();
            $('#business_location').val(location);
            opening_balance_table.ajax.reload();
        });

        $('select#opening_balance_filter_contact_type').on('change', function() {
            opening_balance_table.ajax.reload();
        });

        $('select#opening_balance_filter_mapping_type').on('change', function() {
            opening_balance_table.ajax.reload();
        });

        // Mapping type filter onchange handlers for all tabs
        $('select#sell_list_filter_mapping_type').on('change', function() {
            sell_table.ajax.reload();
        });

        $('select#sell_return_list_filter_mapping_type').on('change', function() {
            sell_return_table.ajax.reload();
        });

        $('select#purchase_list_filter_mapping_type').on('change', function() {
            purchase_table.ajax.reload();
        });

        $('select#purchase_return_filter_mapping_type').on('change', function() {
            purchase_return_table.ajax.reload();
        });

        $('select#opening_stock_filter_mapping_type').on('change', function() {
            opening_stock_table.ajax.reload();
        });

        $('select#expense_filter_mapping_type').on('change', function() {
            expenses_table.ajax.reload();
        });

        $('select#stock_adjustment_filter_mapping_type').on('change', function() {
            stock_adjustment_table.ajax.reload();
        });

        $('select#production_filter_mapping_type').on('change', function() {
            production_table.ajax.reload();
        });

        $('select#reverse_production_filter_mapping_type').on('change', function() {
            reverse_production_table.ajax.reload();
        });

        $('select#advance_deposit_filter_mapping_type').on('change', function() {
            advance_deposit_table.ajax.reload();
        });

        $('select#payroll_filter_mapping_type').on('change', function() {
            payroll_table.ajax.reload();
        });

        // Payment tabs mapping type onChange handlers
        $('select#payment_filter_mapping_type_sell_payment_table').on('change', function() {
            sell_payment_table.ajax.reload();
        });
        $('#sell_payment_tab select[name="payment_filter_location_id"]').on('change', function() {
            sell_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_sell_return_payment_table').on('change', function() {
            sell_return_payment_table.ajax.reload();
        });
        $('#sell_return_payment_tab select[name="payment_filter_location_id"]').on('change', function() {
            sell_return_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_purchase_payment_table').on('change', function() {
            purchase_payment_table.ajax.reload();
        });
        $('#purchase_payment_tab select[name="payment_filter_location_id"]').on('change', function() {
            purchase_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_purchase_return_payment_table').on('change', function() {
            purchase_return_payment_table.ajax.reload();
        });
        $('#purchase_return_payment_tab select[name="payment_filter_location_id"]').on('change', function() {
            purchase_return_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_expense_payment_table').on('change', function() {
            expense_payment_table.ajax.reload();
        });
        $('#expense_payment_tab select[name="payment_filter_location_id"], #expense_payment_tab select[name="payment_filter_status"]').on('change', function() {
            expense_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_stock_adjustment_payment_table').on('change', function() {
            stock_adjustment_payment_table.ajax.reload();
        });
        $('#stock_adjustment_payment_tab select[name="payment_filter_location_id"], #stock_adjustment_payment_tab select[name="payment_filter_status"]').on('change', function() {
            stock_adjustment_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_contact_payment_table').on('change', function() {
            contact_payment_table.ajax.reload();
        });
        $('select#payment_filter_contact_type_contact_payment_table').on('change', function() {
            contact_payment_table.ajax.reload();
        });
        $('#contact_payment_tab select[name="payment_filter_location_id"]').on('change', function() {
            contact_payment_table.ajax.reload();
        });
        $('select#payment_filter_mapping_type_payroll_payment_table').on('change', function() {
            payroll_payment_table.ajax.reload();
        });
        $('#payroll_payment_tab select[name="payment_filter_location_id"], #payroll_payment_tab select[name="payment_filter_status"]').on('change', function() {
            payroll_payment_table.ajax.reload();
        });

        // Filter onchange handlers for all tabs
        $('#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #sell_list_filter_date_range').on('change', function() {
            sell_table.ajax.reload();
        });

        $('#sell_return_list_filter_location_id, #sell_return_list_filter_customer_id, #sell_return_list_filter_payment_status, #sell_return_list_filter_date_range').on('change', function() {
            sell_return_table.ajax.reload();
        });

        $('#purchase_list_filter_location_id, #purchase_list_filter_supplier_id, #purchase_list_filter_payment_status, #purchase_list_filter_status, #purchase_list_filter_date_range').on('change', function() {
            purchase_table.ajax.reload();
        });

        $('#purchase_return_list_filter_location_id, #purchase_return_list_filter_supplier_id, #purchase_return_list_filter_payment_status, #purchase_return_list_filter_status, #purchase_return_list_filter_date_range').on('change', function() {
            purchase_return_table.ajax.reload();
        });

        $('#expense_filter_location_id, #expense_filter_payment_status, #expense_filter_date_range').on('change', function() {
            expenses_table.ajax.reload();
        });

        $('#stock_adjustment_filter_location_id, #stock_adjustment_filter_date_range').on('change', function() {
            stock_adjustment_table.ajax.reload();
        });

        $('#opening_stock_filter_location_id, #opening_stock_filter_date_range').on('change', function() {
            opening_stock_table.ajax.reload();
        });

        $('#production_filter_location_id, #production_filter_date_range').on('change', function() {
            production_table.ajax.reload();
        });

        $('#reverse_production_filter_location_id, #reverse_production_filter_date_range').on('change', function() {
            reverse_production_table.ajax.reload();
        });

        $('#advance_deposit_filter_location_id, #advance_deposit_filter_contact_type, #advance_deposit_filter_payment_status, #advance_deposit_filter_date_range').on('change', function() {
            advance_deposit_table.ajax.reload();
        });

        $('#payroll_filter_location_id, #payroll_filter_payment_status, #payroll_filter_date_range').on('change', function() {
            payroll_table.ajax.reload();
        });

        //Contact Opening Balance table
        advance_deposit_table = $('#advance_deposit_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=advance_deposit',
                data: function(d) {
                    if ($('#advance_deposit_filter_location_id').length) {
                        d.location_id = $('#advance_deposit_filter_location_id').val();
                    }
                    if ($('#advance_deposit_filter_contact_type').length) {
                        d.contact_type = $('#advance_deposit_filter_contact_type').val();
                    }
                    if ($('#advance_deposit_filter_payment_status').length) {
                        d.payment_status = $('#advance_deposit_filter_payment_status').val();
                    }
                    if ($('#advance_deposit_filter_mapping_type').length) {
                        d.mapping_type = $('#advance_deposit_filter_mapping_type').val();
                    }
                    var start = '';
                    var end = '';
                    if ($('#advance_deposit_filter_date_range').val()) {
                        start = $('input#advance_deposit_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#advance_deposit_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'contact_type', name: 'contacts.type' },
                { data: 'name', name: 'contacts.name' },
                { data: 'final_total', name: 'final_total' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('advance_deposit_table', oSettings);
            }
        });
        
        //Contact Payments Table
        contact_payment_table = $('#contact_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "/accounting/transactions?transaction_type=contact_payment&datatable=payment",
                                "data": function ( d ) {
                                    if($('#payment_filter_date_range_contact_payment_table').val()) {
                                        var start = $('#payment_filter_date_range_contact_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var end = $('#payment_filter_date_range_contact_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                        d.start_date = start;
                                        d.end_date = end;
                                    }
                                    d.location_id = $('#contact_payment_tab select[name="payment_filter_location_id"]').val();
                                    d.mapping_type = $('#payment_filter_mapping_type_contact_payment_table').val();
                                    d.contact_type = $('#payment_filter_contact_type_contact_payment_table').val();
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                accountingTransactionsDrawCallback('contact_payment_table', oSettings);
                            }
                        });

        //Payroll table
        payroll_table = $('#payroll_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=payroll',
                data: function(d) {
                    if ($('#payroll_filter_location_id').length) {
                        d.location_id = $('#payroll_filter_location_id').val();
                    }
                    if ($('#payroll_filter_payment_status').length) {
                        d.payment_status = $('#payroll_filter_payment_status').val();
                    }
                    if ($('#payroll_filter_mapping_type').length) {
                        d.mapping_type = $('#payroll_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#payroll_filter_date_range').val()) {
                        start = $('input#payroll_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#payroll_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'expense_for', name: 'expense_for' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'added_by', name: 'added_by' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('payroll_table', oSettings);
            }
        });

        payroll_payment_table = $('#payroll_payment_table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "/accounting/transactions?transaction_type=payroll&datatable=payment",
                "data": function ( d ) {
                    d.location_id = $('#payroll_payment_tab select[name="payment_filter_location_id"]').val();
                    d.payment_method = $('#payroll_payment_tab select[name="payment_filter_status"]').val();
                    if($('#payment_filter_date_range_payroll_payment_table').val()) {
                        var start = $('#payment_filter_date_range_payroll_payment_table').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#payment_filter_date_range_payroll_payment_table').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.mapping_type = $('#payment_filter_mapping_type_payroll_payment_table').val();
                }
            },
            columnDefs:[{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
            columns: [
                {data: 'action', name: 'action'},
                {data: 'paid_on', name: 'paid_on'},
                {data: 'payment_ref_no', name: 'payment_ref_no'},
                {data: 'transaction_number', name: 'transaction_number'},
                {data: 'amount', name: 'amount'},
                {data: 'type', name: 'T.type'},
                {data: 'details', name: 'details', "searchable": false},
            ],
            "fnDrawCallback": function (oSettings) {
                accountingTransactionsDrawCallback('payroll_payment_table', oSettings);
            }
        });

        //Payroll Advance Payments table
        payroll_advance_table = $('#payroll_advance_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=payroll_advance',
                data: function(d) {
                    var start = '';
                    var end = '';
                    if ($('#payroll_advance_filter_date_range').val()) {
                        start = $('input#payroll_advance_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#payroll_advance_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'sub_type', name: 'sub_type' },
                { data: 'expense_for', name: 'expense_for' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'added_by', name: 'added_by' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('payroll_advance_table', oSettings);
            }
        });

        //Manufacturing
        //Purchase table
        production_table = $('#production_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=production',
                data: function(d) {
                    if ($('#production_filter_location_id').length) {
                        d.location_id = $('#production_filter_location_id').val();
                    }
                    if ($('#production_filter_mapping_type').length) {
                        d.mapping_type = $('#production_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#production_filter_date_range').val()) {
                        start = $('input#production_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#production_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'product_name', name: 'product_name' },
                { data: 'quantity', name: 'pl.quantity' },
                { data: 'final_total', name: 'final_total' },
                { data: 'added_by', name: 'added_by' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('production_table', oSettings);
            }
        });

        //Purchase table
        reverse_production_table = $('#reverse_production_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=reverse_production',
                data: function(d) {
                    if ($('#reverse_production_filter_location_id').length) {
                        d.location_id = $('#reverse_production_filter_location_id').val();
                    }
                    if ($('#reverse_production_filter_mapping_type').length) {
                        d.mapping_type = $('#reverse_production_filter_mapping_type').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#reverse_production_filter_date_range').val()) {
                        start = $('input#reverse_production_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#reverse_production_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'product_name', name: 'product_name' },
                { data: 'quantity', name: 'tsl.quantity' },
                { data: 'final_total', name: 'final_total' },
                { data: 'added_by', name: 'added_by' },
            ],
            fnDrawCallback: function(oSettings) {
                accountingTransactionsDrawCallback('reverse_production_table', oSettings);
            }
        });
        
        $(document).on('submit', "form#save_accounting_map", function(e){
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            transaction_type = $('#transaction_type').val();

            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        if(transaction_type == 'sell'){
                            sell_table.ajax.reload();
                        } else if(transaction_type == 'sell_payment'){
                            sell_payment_table.ajax.reload();
                        } else if(transaction_type == 'sell_return'){
                            sell_return_table.ajax.reload();
                        } else if(transaction_type == 'sell_return_payment'){
                            sell_return_payment_table.ajax.reload();
                        }else if(transaction_type == 'purchase'){
                            purchase_table.ajax.reload();
                        } else if(transaction_type == 'purchase_payment'){
                            purchase_payment_table.ajax.reload();
                        }else if(transaction_type == 'purchase_return'){
                            purchase_return_table.ajax.reload();
                        } else if(transaction_type == 'purchase_return_payment'){
                            purchase_return_payment_table.ajax.reload();
                        }else if(transaction_type == 'stock_adjustment'){
                            stock_adjustment_table.ajax.reload();
                        } else if(transaction_type == 'stock_recovered'){
                            stock_adjustment_payment_table.ajax.reload();
                        }else if(transaction_type == 'expense'){
                            expenses_table.ajax.reload();
                        }else if(transaction_type == 'expense_payment'){
                            expense_payment_table.ajax.reload();
                        }else if(transaction_type == 'opening_stock'){
                            opening_stock_table.ajax.reload();
                        }else if(transaction_type == 'opening_balance'){
                            opening_balance_table.ajax.reload();
                        }else if(transaction_type == 'advance_deposit'){
                            advance_deposit_table.ajax.reload();
                        }else if(transaction_type == 'contact_payment'){
                            contact_payment_table.ajax.reload();
                        }else if(transaction_type == 'payroll'){
                            payroll_table.ajax.reload();
                        }else if(transaction_type == 'payroll_payment'){
                            payroll_payment_table.ajax.reload();
                        }else if(transaction_type == 'payroll_advance'){
                            payroll_advance_table.ajax.reload();
                        }else if(transaction_type == 'production_purchase'){
                            production_table.ajax.reload();
                            reverse_production_table.ajax.reload();
                        }
                        
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });


        });

        $(document).on('click', 'button#remap_defaults_sells', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'sell',
                        location_id: $('#sell_list_filter_location_id').val(),
                        customer_id: $('#sell_list_filter_customer_id').val(),
                        payment_status: $('#sell_list_filter_payment_status').val(),
                        mapping_type: $('#sell_list_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#sell_list_filter_date_range').val()) {
                        data.start_date = $('#sell_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#sell_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            sell_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_sell_return', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'sell_return',
                        location_id: $('#sell_return_list_filter_location_id').val(),
                        customer_id: $('#sell_return_list_filter_customer_id').val(),
                        payment_status: $('#sell_return_list_filter_payment_status').val(),
                        mapping_type: $('#sell_return_list_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#sell_return_list_filter_date_range').val()) {
                        data.start_date = $('#sell_return_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#sell_return_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            sell_return_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_purchase', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'purchase',
                        location_id: $('#purchase_list_filter_location_id').val(),
                        supplier_id: $('#purchase_list_filter_supplier_id').val(),
                        payment_status: $('#purchase_list_filter_payment_status').val(),
                        status: $('#purchase_list_filter_status').val(),
                        mapping_type: $('#purchase_list_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#purchase_list_filter_date_range').val()) {
                        data.start_date = $('#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            purchase_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_purchase_return', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'purchase_return',
                        location_id: $('#purchase_return_list_filter_location_id').val(),
                        supplier_id: $('#purchase_return_list_filter_supplier_id').val(),
                        payment_status: $('#purchase_return_list_filter_payment_status').val(),
                        status: $('#purchase_return_list_filter_status').val(),
                        mapping_type: $('#purchase_return_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#purchase_return_list_filter_date_range').val()) {
                        data.start_date = $('#purchase_return_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#purchase_return_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            purchase_return_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_expense', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'expense',
                        location_id: $('#expense_filter_location_id').val(),
                        payment_status: $('#expense_filter_payment_status').val(),
                        mapping_type: $('#expense_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#expense_filter_date_range').val()) {
                        data.start_date = $('#expense_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#expense_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            expenses_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_stock_adjustment', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {
                        type: 'stock_adjustment',
                        location_id: $('#stock_adjustment_filter_location_id').val(),
                        mapping_type: $('#stock_adjustment_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#stock_adjustment_filter_date_range').val()) {
                        data.start_date = $('#stock_adjustment_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('#stock_adjustment_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            stock_adjustment_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_opening_balance', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'opening_balance',
                        location_id: $('#opening_balance_filter_location_id').val(),
                        contact_type: $('#opening_balance_filter_contact_type').val(),
                        mapping_type: $('#opening_balance_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#opening_balance_filter_date_range').val()) {
                        data.start_date = $('input#opening_balance_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#opening_balance_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            opening_balance_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_opening_stock', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'opening_stock',
                        location_id: $('#opening_stock_filter_location_id').val(),
                        mapping_type: $('#opening_stock_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#opening_stock_filter_date_range').val()) {
                        data.start_date = $('input#opening_stock_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#opening_stock_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            opening_stock_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_production', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'production_purchase',
                        location_id: $('#production_filter_location_id').val(),
                        mapping_type: $('#production_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#production_filter_date_range').val()) {
                        data.start_date = $('input#production_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#production_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            production_table.ajax.reload(null, false);
                            reverse_production_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_reverse_production', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'reverse_production',
                        location_id: $('#reverse_production_filter_location_id').val(),
                        mapping_type: $('#reverse_production_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#reverse_production_filter_date_range').val()) {
                        data.start_date = $('input#reverse_production_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#reverse_production_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            reverse_production_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_advance_deposit', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'advance_deposit',
                        location_id: $('#advance_deposit_filter_location_id').val(),
                        contact_type: $('#advance_deposit_filter_contact_type').val(),
                        payment_status: $('#advance_deposit_filter_payment_status').val(),
                        mapping_type: $('#advance_deposit_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#advance_deposit_filter_date_range').val()) {
                        data.start_date = $('input#advance_deposit_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#advance_deposit_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            advance_deposit_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button#remap_defaults_payroll', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');

                    var data = {
                        type: 'payroll',
                        location_id: $('#payroll_filter_location_id').val(),
                        payment_status: $('#payroll_filter_payment_status').val(),
                        mapping_type: $('#payroll_filter_mapping_type').val(),
                        start_date: '',
                        end_date: ''
                    };

                    if ($('#payroll_filter_date_range').val()) {
                        data.start_date = $('input#payroll_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        data.end_date = $('input#payroll_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            payroll_table.ajax.reload(null, false);
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button.remap_defaults_payment_btn', function() {
            var tableId = $(this).data('table-id');
            var type = '';
            
            // Map table ID to payment type
            if (tableId === 'contact_payment_table') {
                type = 'contact_payment';
            } else if (tableId === 'sell_payment_table') {
                type = 'sell_payment';
            } else if (tableId === 'sell_return_payment_table') {
                type = 'sell_return_payment';
            } else if (tableId === 'purchase_payment_table') {
                type = 'purchase_payment';
            } else if (tableId === 'purchase_return_payment_table') {
                type = 'purchase_return_payment';
            } else if (tableId === 'stock_adjustment_payment_table') {
                type = 'stock_adjustment_payment';
            } else if (tableId === 'expense_payment_table') {
                type = 'expense_payment';
            } else if (tableId === 'payroll_payment_table') {
                type = 'payroll_payment';
            }
            
            if (!type) return;
            
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(willDelete => {
                if (willDelete) {
                    var loading = $(this).find('i');
                    loading.toggleClass('hide');
                    var data = {type: type};

                    if (tableId === 'contact_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_contact_payment_table').val();
                        data.contact_type = $('#payment_filter_contact_type_contact_payment_table').val();
                        data.location_id = $('#contact_payment_tab select[name="payment_filter_location_id"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_contact_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_contact_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_contact_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'sell_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_sell_payment_table').val();
                        data.location_id = $('#sell_payment_tab select[name="payment_filter_location_id"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_sell_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_sell_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_sell_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'sell_return_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_sell_return_payment_table').val();
                        data.location_id = $('#sell_return_payment_tab select[name="payment_filter_location_id"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_sell_return_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_sell_return_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_sell_return_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'purchase_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_purchase_payment_table').val();
                        data.location_id = $('#purchase_payment_tab select[name="payment_filter_location_id"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_purchase_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_purchase_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_purchase_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'purchase_return_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_purchase_return_payment_table').val();
                        data.location_id = $('#purchase_return_payment_tab select[name="payment_filter_location_id"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_purchase_return_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_purchase_return_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_purchase_return_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'expense_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_expense_payment_table').val();
                        data.location_id = $('#expense_payment_tab select[name="payment_filter_location_id"]').val();
                        data.payment_method = $('#expense_payment_tab select[name="payment_filter_status"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_expense_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_expense_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_expense_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'stock_adjustment_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_stock_adjustment_payment_table').val();
                        data.location_id = $('#stock_adjustment_payment_tab select[name="payment_filter_location_id"]').val();
                        data.payment_method = $('#stock_adjustment_payment_tab select[name="payment_filter_status"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_stock_adjustment_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_stock_adjustment_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_stock_adjustment_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }

                    if (tableId === 'payroll_payment_table') {
                        data.mapping_type = $('#payment_filter_mapping_type_payroll_payment_table').val();
                        data.location_id = $('#payroll_payment_tab select[name="payment_filter_location_id"]').val();
                        data.payment_method = $('#payroll_payment_tab select[name="payment_filter_status"]').val();
                        data.start_date = '';
                        data.end_date = '';

                        if ($('#payment_filter_date_range_payroll_payment_table').val()) {
                            data.start_date = $('#payment_filter_date_range_payroll_payment_table')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            data.end_date = $('#payment_filter_date_range_payroll_payment_table')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                    }
                    
                    $.ajax({
                        url: "/accounting/transactions/map-defaults",
                        method: 'GET',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success){
                                toastr.success(result.msg);
                            }else{
                                toastr.warning(result.msg);
                            }
                            if (tableId === 'contact_payment_table') {
                                contact_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'sell_payment_table') {
                                sell_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'sell_return_payment_table') {
                                sell_return_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'purchase_payment_table') {
                                purchase_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'purchase_return_payment_table') {
                                purchase_return_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'expense_payment_table') {
                                expense_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'stock_adjustment_payment_table') {
                                stock_adjustment_payment_table.ajax.reload(null, false);
                            }
                            if (tableId === 'payroll_payment_table') {
                                payroll_payment_table.ajax.reload(null, false);
                            }
                            loading.toggleClass('hide');
                        },
                    });
                }
            });
        });

        $(document).on('click', '#btn-remap-all', function(e) {
            e.preventDefault();
            var $btn = $(this);

            swal({
                title: LANG.sure,
                text: "This will run background remapping for all transactions across every type shown on this page. Existing mappings will also be refreshed using the current accounting defaults.",
                icon: 'info',
                buttons: true,
                dangerMode: false,
            }).then(function(willConfirm) {
                if (willConfirm) {
                    $btn.prop('disabled', true);
                    $btn.find('#btn-remap-all-icon').addClass('fa-spin');

                    $.ajax({
                        url: "<?php echo e(route('accounting.transactions.remap-all'), false); ?>",
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _token: "<?php echo e(csrf_token(), false); ?>"
                        },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                            } else {
                                toastr.warning(result.msg);
                            }
                        },
                        error: function(xhr) {
                            var msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'Something went wrong';
                            toastr.error(msg);
                        },
                        complete: function() {
                            $btn.prop('disabled', false);
                            $btn.find('#btn-remap-all-icon').removeClass('fa-spin');
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
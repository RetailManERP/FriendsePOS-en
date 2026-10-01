
<?php $__env->startSection('title', __( 'lang_v1.all_sales')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1><?php echo app('translator')->get( 'sale.sells'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php if(empty($only) || in_array('sell_list_filter_location_id', $only)): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


                        <?php echo Form::select('sell_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(empty($only) || in_array('sell_list_filter_customer_id', $only)): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':'); ?>

                        <?php echo Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(empty($only) || in_array('sell_list_filter_payment_status', $only)): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('sell_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

                        <?php echo Form::select('sell_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue'),'installmented' => __('lang_v1.installmented')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(empty($only) || in_array('sell_list_filter_date_range', $only)): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('sell_list_filter_date_range', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('sell_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative)): ?>
            <?php
             $is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
             ?>
            <?php if($is_admin): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('created_by',  __('report.user') . ':'); ?>

                        <?php echo Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            <?php else: ?>
            <input type="hidden" id="created_by">
            <?php endif; ?>
            <?php endif; ?>

            <?php
                $date_loc = array_key_first($date_settings);
            ?>
            <?php if(!empty($date_settings[$date_loc]['installments_filter_date_range'])): ?>
                <?php echo Form::hidden('installments_filter_date_range', $date_settings[$date_loc]['installments_filter_date_range'], ['id'=>'installments_filter_date_range']); ?>

            <?php endif; ?>





        <?php echo $__env->renderComponent(); ?>

        <div class="row mb-3 no-print">
            <div class="col-md-12 text-right text-end">
                <button type="button" class="btn btn-primary" id="installment_sells_print_active_tab">
                    <i class="fa fa-print"></i> Print A4 Current Tab
                </button>
                <button type="button" class="btn btn-default" id="installment_sells_print_all_tabs">
                    <i class="fa fa-print"></i> Print A4 All Tabs
                </button>
            </div>
        </div>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_sales')]); ?>

            <?php if(auth()->user()->can('installment.view_sells') || auth()->user()->can('installment.create') || auth()->user()->can('installment.view') || auth()->user()->can('direct_sell.access') ||  auth()->user()->can('view_own_sell_only') ||  auth()->user()->can('view_commission_agent_sell')): ?>
                <?php
                    $custom_labels = json_decode(session('business.custom_labels'), true);
                ?>
                <div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_table">
                    <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                        <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                        <th><?php echo app('translator')->get('sale.total_amount'); ?></th>
                        <th><?php echo app('translator')->get('sale.total_paid'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.sell_due'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.sell_return_due'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.total_items'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
                        <th><?php echo e($custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' ), false); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        <th><?php echo app('translator')->get('sale.sell_note'); ?></th>
                        <th><?php echo app('translator')->get('sale.staff_note'); ?></th>
                        <th><?php echo app('translator')->get('sale.shipping_details'); ?></th>
                        <th><?php echo app('translator')->get('restaurant.table'); ?></th>
                        <th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="6"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_payment_status_count"></td>
                        <td class="payment_method_count"></td>
                        <td class="footer_sale_total"></td>
                        <td class="footer_total_paid"></td>
                        <td class="footer_total_remaining"></td>
                        <td class="footer_total_sell_return_due"></td>
                        <td colspan="2"></td>
                        <td class="service_type_count"></td>
                        <td colspan="7"></td>
                    </tr>
                    </tfoot>
                </table>
</div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>
    </section>
    <!-- /.content -->
    

    <!-- This will be printed -->
    <!-- <section class="invoice print_section" id="receipt_section">
    </section> -->
    <div class="modal fade div_modal" tabindex="-1" role="dialog"
         aria-labelledby="gridSystemModalLabel">
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready( function(){
            let date_range_default = $('#installments_filter_date_range').val();
            if(date_range_default == 'today'){
                dateRangeSettings.startDate = moment();
                dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'last_seven_days'){
                dateRangeSettings.startDate = moment().subtract(6,'day');
                dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'last_thirty_days'){
                dateRangeSettings.startDate = moment().subtract(29,'day');
                dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'this_month'){
                dateRangeSettings.startDate = moment().startOf('month');
                dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'last_month'){
                dateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
                dateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
            }else if(date_range_default == 'this_year'){
                dateRangeSettings.startDate = moment().startOf('year');
                dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'last_year'){
                dateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
                dateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
            }else if(date_range_default == 'current_financial_year'){
                // dateRangeSettings.startDate = moment();
                // dateRangeSettings.endDate = moment();
            }else if(date_range_default == 'all_time'){
                dateRangeSettings.startDate = moment(business_start_date);
                dateRangeSettings.endDate = moment();
            }

            //Date range as a button
            $('#sell_list_filter_date_range').daterangepicker(
                dateRangeSettings,
                function (start, end) {
                    $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    sell_table.ajax.reload();
                }
            );
            $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#sell_list_filter_date_range').val('');
                sell_table.ajax.reload();
            });

            sell_table = $('#sell_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [[1, 'desc']],
                "ajax": {
                    "url": "/installment/sells",
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
                        d.created_by = $('#created_by').val();
                        d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                        d.service_staffs = $('#service_staffs').val();

                        if($('#shipping_status').length) {
                            d.shipping_status = $('#shipping_status').val();
                        }

                        <?php if($is_woocommerce): ?>
                        if($('#synced_from_woocommerce').is(':checked')) {
                            d.only_woocommerce_sells = 1;
                        }
                        <?php endif; ?>

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
                    { data: 'total_remaining', name: 'total_remaining'},
                    { data: 'return_due', orderable: false, "searchable": false},
                    { data: 'shipping_status', name: 'shipping_status'},
                    { data: 'total_items', name: 'total_items', "searchable": false},
                    { data: 'types_of_service_name', name: 'tos.name', <?php if(empty($is_types_service_enabled)): ?> visible: false <?php endif; ?>},
                    { data: 'service_custom_field_1', name: 'service_custom_field_1', <?php if(empty($is_types_service_enabled)): ?> visible: false <?php endif; ?>},
                    { data: 'added_by', name: 'u.first_name'},
                    { data: 'additional_notes', name: 'additional_notes'},
                    { data: 'staff_note', name: 'staff_note'},
                    { data: 'shipping_details', name: 'shipping_details'},
                    { data: 'table_name', name: 'tables.name', <?php if(empty($is_tables_enabled)): ?> visible: false <?php endif; ?> },
                    { data: 'waiter', name: 'ss.first_name', <?php if(empty($is_service_staff_enabled)): ?> visible: false <?php endif; ?> },
                ],
                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#sell_table'));
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var footer_sale_total = 0;
                    var footer_total_paid = 0;
                    var footer_total_remaining = 0;
                    var footer_total_sell_return_due = 0;
                    for (var r in data){
                        footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                        footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                        footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                        footer_total_sell_return_due += $(data[r].return_due).data('orig-value') ? parseFloat($(data[r].return_due).data('orig-value')) : 0;
                    }

                    $('.footer_total_sell_return_due').html(__currency_trans_from_en(footer_total_sell_return_due));
                    $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
                    $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
                    $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));

                    $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
                    $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
                    $('.payment_method_count').html(__count_status(data, 'payment_methods'));
                },
                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(6)').attr('class', 'clickable_td');
                }
            });

            function get_installment_sells_print_params() {
                var params = {
                    tab: 'sells',
                    is_direct_sale: 1,
                    location_id: $('#sell_list_filter_location_id').length ? $('#sell_list_filter_location_id').val() : '',
                    customer_id: $('#sell_list_filter_customer_id').length ? $('#sell_list_filter_customer_id').val() : '',
                    payment_status: $('#sell_list_filter_payment_status').length ? $('#sell_list_filter_payment_status').val() : '',
                    created_by: $('#created_by').length ? $('#created_by').val() : '',
                    sales_cmsn_agnt: $('#sales_cmsn_agnt').length ? $('#sales_cmsn_agnt').val() : '',
                    service_staffs: $('#service_staffs').length ? $('#service_staffs').val() : ''
                };

                if ($('#sell_list_filter_date_range').val()) {
                    params.start_date = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    params.end_date = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }

                if ($('#shipping_status').length) {
                    params.shipping_status = $('#shipping_status').val();
                }

                <?php if($is_woocommerce): ?>
                if ($('#synced_from_woocommerce').is(':checked')) {
                    params.only_woocommerce_sells = 1;
                }
                <?php endif; ?>

                if ($('#only_subscriptions').length && $('#only_subscriptions').is(':checked')) {
                    params.only_subscriptions = 1;
                }

                return params;
            }

            $(document).on('click', '#installment_sells_print_active_tab, #installment_sells_print_all_tabs', function() {
                window.open('<?php echo e(url('/installment/sells-print'), false); ?>?' + $.param(get_installment_sells_print_params()), '_blank');
            });

            $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status',  function() {
                sell_table.ajax.reload();
            });
            <?php if($is_woocommerce): ?>
            $('#synced_from_woocommerce').on('change', function(event){
                sell_table.ajax.reload();
            });
            <?php endif; ?>

            $('#only_subscriptions').on('change', function(event){
                sell_table.ajax.reload();
            });

            $(document).on('click','.add_installment_modal',function (e) {
                e.preventDefault();
                var contact_id=$('#customer_id').val();
                if(contact_id==''){
                    toastr.error('Sorry, please select a customer');
                    return true;
                }

                var url=$(this).attr('href');
                $.ajax({
                    method: 'GET',
                    url: url,
                    dataType: 'html',
                    success: function (result) {
                        $(".div_modal").html(result).modal('show');
                    },
                });

            });

        });

    </script>
    <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('title', __('installment::lang.installment_report')); ?>

<?php $__env->startSection('css'); ?>
    <style>
        #installments_table .installment-action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        #installments_table .installment-action-buttons .btn {
            margin: 0;
        }

        .installment-report-tabs-wrap {
            margin-bottom: 15px;
        }

        .installment-report-tabs-wrap > .nav-tabs {
            border-bottom: 1px solid #d2d6de;
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 0;
        }

        .installment-report-tabs-wrap > .nav-tabs > li > a,
        .installment-report-tabs-wrap > .nav-tabs > li > a.nav-link {
            align-items: center;
            background: #f8fafc;
            border: 1px solid #d2d6de;
            border-bottom-color: transparent;
            border-radius: 4px 4px 0 0;
            color: #3c8dbc;
            display: inline-flex;
            font-weight: 600;
            gap: 6px;
            line-height: 1.4;
            margin-right: 0;
            padding: 10px 14px;
        }

        .installment-report-tabs-wrap > .nav-tabs > li.active > a,
        .installment-report-tabs-wrap > .nav-tabs > li.active > a:hover,
        .installment-report-tabs-wrap > .nav-tabs > li.active > a:focus,
        .installment-report-tabs-wrap > .nav-tabs > li > a.nav-link.active {
            background: #fff;
            border-color: #d2d6de;
            border-bottom-color: #fff;
            color: #1f5f8b;
        }

        .installment-report-tabs-wrap > .tab-content {
            background: #fff;
            border: 1px solid #d2d6de;
            border-top: 0;
            padding: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('installment::layouts.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1><?php echo e(__('installment::lang.installment_report'), false); ?></h1>
    </section>

    <section class="content no-print">
        <div class="row">
            <div class="col-md-12">
                <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                    <input type="hidden" id="installment_id" value="<?php echo e($installment_id, false); ?>">
                    <?php
                        $date_loc = array_key_first($date_settings ?? []);
                        $installment_reports_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
                            ? ($date_settings[$date_loc]['installment_reports_filter_date_range'] ?? null)
                            : ($date_settings['installment_reports_filter_date_range'] ?? null);
                    ?>
                    <?php if(!empty($installment_reports_filter_date_range)): ?>
                        <?php echo Form::hidden('installment_reports_filter_date_range', $installment_reports_filter_date_range, ['id' => 'installment_reports_filter_date_range']); ?>

                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('report_customer_id', __('installment::lang.customers') . ' : '); ?>

                                <?php echo Form::select('report_customer_id', $customers, $selected_customer_id, ['class' => 'form-control select2 getinstallment', 'id' => 'report_customer_id', 'style' => 'width:100%']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('report_balance_due', ' Total Money Owed:'); ?>

                                <input type="text" name="report_balance_due" id="report_balance_due" value="00.00" class="form-control text-disabled" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo Form::label('report_installment_status', __('installment::lang.installment_status') . ' : '); ?>

                                <select name="report_installment_status" id="report_installment_status" class="form-control">
                                    <option value="0"><?php echo app('translator')->get('installment::lang.all_installment'); ?></option>
                                    <option value="1"><?php echo app('translator')->get('installment::lang.paid_installment'); ?></option>
                                    <option value="2"><?php echo app('translator')->get('installment::lang.due_installment'); ?></option>
                                    <option value="3"><?php echo app('translator')->get('installment::lang.late_installment'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('report_date_range', __('report.date_range') . ':'); ?>

                                <input type="text" name="report_date_range" id="report_date_range" class="form-control" readonly>
                                <input type="hidden" name="report_datefrom" id="report_datefrom" value="<?php echo e(\Carbon\Carbon::now()->startOfYear()->format('Y-m-d'), false); ?>">
                                <input type="hidden" name="report_dateto" id="report_dateto" value="<?php echo e(\Carbon\Carbon::now()->endOfYear()->format('Y-m-d'), false); ?>">
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        <div class="row mb-3 no-print">
            <div class="col-md-12 text-end">
                <button type="button" class="btn btn-primary" id="installment_print_active_tab">
                    <i class="fa fa-print"></i> Print A4 Current Tab
                </button>
                <button type="button" class="btn btn-default" id="installment_print_all_tabs">
                    <i class="fa fa-print"></i> Print A4 All Tabs
                </button>
            </div>
        </div>

        <div class="nav-tabs-custom installment-report-tabs-wrap">
            <ul class="nav nav-tabs" id="installment_reports_tabs" role="tablist">
                <?php if($can_view_installment_reports): ?>
                    <li class="nav-item <?php echo e($active_tab == 'installments' ? 'active' : '', false); ?>" role="presentation">
                        <a href="#installment_details_tab"
                           class="nav-link <?php echo e($active_tab == 'installments' ? 'active' : '', false); ?>"
                           data-bs-toggle="tab"
                           data-toggle="tab"
                           role="tab"
                           aria-selected="<?php echo e($active_tab == 'installments' ? 'true' : 'false', false); ?>">
                            <i class="fa fa-list-alt"></i>
                            <span><?php echo app('translator')->get('installment::lang.installment_report'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($can_view_installment_contacts): ?>
                    <li class="nav-item <?php echo e($active_tab == 'customers' ? 'active' : '', false); ?>" role="presentation">
                        <a href="#customer_installments_tab"
                           class="nav-link <?php echo e($active_tab == 'customers' ? 'active' : '', false); ?>"
                           data-bs-toggle="tab"
                           data-toggle="tab"
                           role="tab"
                           aria-selected="<?php echo e($active_tab == 'customers' ? 'true' : 'false', false); ?>">
                            <i class="fa fa-users"></i>
                            <span><?php echo app('translator')->get('installment::lang.installment_customer'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
            <?php if($can_view_installment_reports): ?>
                <div class="tab-pane <?php echo e($active_tab == 'installments' ? 'active show' : '', false); ?>" id="installment_details_tab" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" id="installments_table">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px">SN</th>
                                                <th style="width: 160px">Customer</th>
                                                <th style="width: 140px">Due Date</th>
                                                <th style="width: 140px">Installment Value</th>
                                                <th style="width: 140px">Benefit</th>
                                                <th style="width: 140px">Total</th>
                                                <th>Late Days</th>
                                                <th>Status</th>
                                                <th>Payment Date</th>
                                                <th style="width: 150px">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($can_view_installment_contacts): ?>
                <div class="tab-pane <?php echo e($active_tab == 'customers' ? 'active show' : '', false); ?>" id="customer_installments_tab" role="tabpanel">
                    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => '']); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="customer_installments_table">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Installment Status</th>
                                        <th>Number of Installments</th>
                                        <th style="width: 120px"><?php echo app('translator')->get('messages.action'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="modal fade div_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <section class="invoice print_section" id="installment_section"></section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('installment::layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        var installments_table;
        var customer_installments_table;

        function update_installment_balance(customerId, targetSelector) {
            if (!customerId || customerId == '0') {
                $(targetSelector).val('00.00');
                return;
            }

            $.ajax({
                method: 'GET',
                url: '<?php echo e(url('/installment/getcustomerdata'), false); ?>/' + customerId,
                data: {
                    id: customerId
                },
                success: function(result) {
                    var balance = parseFloat(result.balance_due || 0);
                    $(targetSelector).val(balance.toFixed(2));
                }
            });
        }

        $(document).ready(function () {
            var installmentDateRangeSettings = $.extend({}, dateRangeSettings, {
                locale: $.extend({}, dateRangeSettings.locale, {
                    toLabel: '-'
                })
            });
            var date_range_default = $('#installment_reports_filter_date_range').val();
            if (date_range_default == 'today') {
                installmentDateRangeSettings.startDate = moment();
                installmentDateRangeSettings.endDate = moment();
            } else if (date_range_default == 'last_seven_days') {
                installmentDateRangeSettings.startDate = moment().subtract(6, 'day');
                installmentDateRangeSettings.endDate = moment();
            } else if (date_range_default == 'last_thirty_days') {
                installmentDateRangeSettings.startDate = moment().subtract(29, 'day');
                installmentDateRangeSettings.endDate = moment();
            } else if (date_range_default == 'this_month') {
                installmentDateRangeSettings.startDate = moment().startOf('month');
                installmentDateRangeSettings.endDate = moment().endOf('month');
            } else if (date_range_default == 'last_month') {
                installmentDateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
                installmentDateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
            } else if (date_range_default == 'this_year') {
                installmentDateRangeSettings.startDate = moment().startOf('year');
                installmentDateRangeSettings.endDate = moment().endOf('year');
            } else if (date_range_default == 'last_year') {
                installmentDateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
                installmentDateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
            } else if (date_range_default == 'current_financial_year') {
                // Keep dateRangeSettings financial-year defaults.
            } else if (date_range_default == 'all_time') {
                installmentDateRangeSettings.startDate = moment(business_start_date);
                installmentDateRangeSettings.endDate = moment();
            }
            var installmentReportStartDate = installmentDateRangeSettings.startDate;
            var installmentReportEndDate = installmentDateRangeSettings.endDate;

            function set_installment_report_date_range(start, end) {
                $('#report_date_range').val(start.format(moment_date_format) + ' - ' + end.format(moment_date_format));
                $('#report_datefrom').val(start.format('YYYY-MM-DD'));
                $('#report_dateto').val(end.format('YYYY-MM-DD'));
            }

            set_installment_report_date_range(installmentReportStartDate, installmentReportEndDate);

            $('#report_date_range').daterangepicker(
                installmentDateRangeSettings,
                function(start, end) {
                    set_installment_report_date_range(start, end);
                    reload_report_tables();
                }
            );

            $('#report_date_range').on('cancel.daterangepicker', function() {
                $('#report_date_range').val('');
                $('#report_datefrom').val('');
                $('#report_dateto').val('');
                reload_report_tables();
            });

            <?php if($can_view_installment_reports): ?>
                installments_table = $('#installments_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?php echo e(url('/installment/installments'), false); ?>',
                        data: function(d) {
                            d.id = $('#report_customer_id').val();
                            d.installment_status = $('#report_installment_status').val();
                            d.datefrom = $('#report_datefrom').val();
                            d.dateto = $('#report_dateto').val();
                            d.installment_id = $('#installment_id').val();
                        }
                    },
                    columns: [
                        { data: 'installment_number', name: 'installment_number' },
                        { data: 'name', name: 'contacts.name' },
                        { data: 'installmentdate', name: 'installmentdate' },
                        { data: 'installment_value', name: 'installment_value' },
                        { data: 'benefit_value', name: 'benefit_value' },
                        { data: 'total_value', name: 'total_value', searchable: false },
                        { data: 'latdays', name: 'latdays', orderable: false, searchable: false },
                        { data: 'payment_status', name: 'payment_status', orderable: false, searchable: false },
                        { data: 'paid_date', name: 'paid_date' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    columnDefs: [
                        {
                            targets: 9,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });

                $(document).on('click', 'button.getinstallment', function () {
                    installments_table.ajax.reload();
                });
            <?php endif; ?>

            <?php if($can_view_installment_contacts): ?>
                customer_installments_table = $('#customer_installments_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?php echo e(url('/installment/contactwithinstallment'), false); ?>',
                        data: function(d) {
                            d.id = $('#report_customer_id').val();
                            d.installment_status = $('#report_installment_status').val();
                            d.datefrom = $('#report_datefrom').val();
                            d.dateto = $('#report_dateto').val();
                        }
                    },
                    columns: [
                        { data: 'name', name: 'contacts.name' },
                        { data: 'paid_date', name: 'paid_date', orderable: false, searchable: false },
                        { data: 'count', name: 'count', searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    columnDefs: [
                        {
                            targets: 3,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });

            <?php endif; ?>

            function reload_report_tables() {
                if (installments_table) {
                    installments_table.ajax.reload();
                }

                if (customer_installments_table) {
                    customer_installments_table.ajax.reload();
                }
            }

            $(document).on('change', '#report_customer_id', function () {
                update_installment_balance($(this).val(), '#report_balance_due');
                reload_report_tables();
            });

            $(document).on('change', '#report_installment_status', function () {
                reload_report_tables();
            });

            if ($('#report_customer_id').val() && $('#report_customer_id').val() != '0') {
                update_installment_balance($('#report_customer_id').val(), '#report_balance_due');
            }

            $('a[data-bs-toggle="tab"], a[data-toggle="tab"]').on('shown.bs.tab', function() {
                $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            });

            function get_installment_report_active_print_tab() {
                var active_href = $('#installment_reports_tabs li.active a, #installment_reports_tabs a.nav-link.active').first().attr('href') || '';

                return active_href == '#customer_installments_tab' ? 'customers' : 'installments';
            }

            function get_installment_report_print_params(tab) {
                return {
                    tab: tab,
                    id: $('#report_customer_id').val(),
                    installment_status: $('#report_installment_status').val(),
                    datefrom: $('#report_datefrom').val(),
                    dateto: $('#report_dateto').val(),
                    installment_id: $('#installment_id').val()
                };
            }

            $(document).on('click', '#installment_print_active_tab', function() {
                window.open('<?php echo e(url('/installment/reports-print'), false); ?>?' + $.param(get_installment_report_print_params(get_installment_report_active_print_tab())), '_blank');
            });

            $(document).on('click', '#installment_print_all_tabs', function() {
                window.open('<?php echo e(url('/installment/reports-print'), false); ?>?' + $.param(get_installment_report_print_params('all')), '_blank');
            });

            $(document).on('click', 'button.installmentdelete', function () {
                swal({
                    title: LANG.sure,
                    text: 'Premium will be deleted ',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).data('href');

                        $.ajax({
                            method: 'GET',
                            url: href,
                            success: function (result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    installments_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });

            $(document).on('click', 'button.paymentdelete', function () {
                swal({
                    title: LANG.sure,
                    text: 'Premium will be deleted ',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).data('href');

                        $.ajax({
                            method: 'GET',
                            url: href,
                            success: function (result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    installments_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });

        $(document).on('click', 'button.add_payment', function () {
            var href = $(this).data('href');
            $.ajax({
                method: 'GET',
                url: href,
                dataType: 'html',
                success: function (result) {
                    $(".div_modal").html(result).modal('show');
                    installments_table.ajax.reload();
                },
            });
        });

        $(document).on('submit', 'form#storepayment', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function () {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function (result) {
                    if (result.success == true) {
                        $('div.div_modal').modal('hide');
                        toastr.success(result.msg);
                        installments_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        function tprint(id) {
            $.ajax({
                url: '<?php echo e(url('/installment/printinstallment'), false); ?>/' + id,
                method: 'GET',
                success: function (result) {
                    $('#installment_section').html(result);
                    __print_receipt('installment_section');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
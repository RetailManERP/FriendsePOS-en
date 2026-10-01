

<?php $__env->startSection('title', __('truckmate::lang.job_sheets')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::job_sheet.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-clipboard-list" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.job_sheets'); ?></h1>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'closed' => false]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('contact_id',  __('role.customer') . ':'); ?>

                <?php echo Form::select('contact_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('driver_id',  __('truckmate::lang.driver') . ':'); ?>

                <?php echo Form::select('driver_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('vehicle_id',  __('truckmate::lang.vehicle') . ':'); ?>

                <?php echo Form::select('vehicle_id', $vehicles, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('status_id',  __('sale.status') . ':'); ?>

                <?php echo Form::select('status_id', $status_dropdown['statuses'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('date_filter', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                'form-control', 'id' => 'date_filter', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
	<div class="row">
        <div class="col-md-12">
            <div class="tm-card">
                <div class="tm-tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#pending_job_sheet_tab" data-bs-toggle="tab" aria-expanded="true">
                            <i class="fas fa-exclamation-circle text-warning me-1"></i>
                            <?php echo app('translator')->get('truckmate::lang.pending'); ?>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('truckmate::lang.common_pending_status_tooltip') . '"></i>';
                }
            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#completed_job_sheet_tab" data-bs-toggle="tab" aria-expanded="true">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            <?php echo app('translator')->get('truckmate::lang.completed'); ?>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('truckmate::lang.common_completed_status_tooltip') . '"></i>';
                }
            ?>
                        </a>
                    </li>
                </ul>
                </div>
                <div class="tab-content p-3">
                    <div class="tab-pane fade show active" id="pending_job_sheet_tab">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_job_sheet.create')): ?>
                        <div class="d-flex justify-content-end mb-2">
                            <a type="button" class="btn btn-sm btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'create']), false); ?>" id="add_job_sheet">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-th-skin" id="pending_job_sheets_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.job_sheet_no'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('role.customer'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang_v1.start_date'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang_v1.end_date'); ?>
                                        </th>
                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.vehicle'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.driver'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.loading_point'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.destination_point'); ?>
                                        </th>
                                        <th><?php echo app('translator')->get('truckmate::lang.estimated_cost'); ?></th>
                                        <th><?php echo app('translator')->get('truckmate::lang.remarks'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('truckmate::lang.days_remaining'); ?></th>
                                        <th><?php echo app('translator')->get('business.location'); ?></th>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_1'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_1'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_2'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_2'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_3'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_3'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_4'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_4'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_5'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_5'], false); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="completed_job_sheet_tab">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_job_sheet.create')): ?>
                        <div class="d-flex justify-content-end mb-2">
                            <a type="button" class="btn btn-sm btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'create']), false); ?>" id="add_job_sheet">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-th-skin" id="completed_job_sheets_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.job_sheet_no'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('role.customer'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang_v1.start_date'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('lang_v1.end_date'); ?>
                                        </th>
                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.vehicle'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.driver'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.loading_point'); ?>
                                        </th>
                                        <th>
                                            <?php echo app('translator')->get('truckmate::lang.destination_point'); ?>
                                        </th>
                                        <th><?php echo app('translator')->get('truckmate::lang.estimated_cost'); ?></th>
                                        <th><?php echo app('translator')->get('truckmate::lang.remarks'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <?php if($accounting_enabled): ?>
                                        <th id="jsc_invoice_total"><?php echo app('translator')->get('lang_v1.invoice_total'); ?></th>
                                        <th id="jsc_expense"><?php echo app('translator')->get('expense.expense'); ?></th>
                                        <th id="jsc_expense_total"><?php echo app('translator')->get('expense.expense_total'); ?></th>
                                        <th id="jsc_profit"><?php echo app('translator')->get('lang_v1.profit'); ?></th>
                                        <?php endif; ?>
                                        
                                        <th><?php echo app('translator')->get('business.location'); ?></th>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_1'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_1'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_2'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_2'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_3'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_3'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_4'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_4'], false); ?></th>
                                        <?php endif; ?>
                                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_5'])): ?>
                                            <th><?php echo e($truckmate_settings['job_sheet_custom_field_5'], false); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade" id="journal_voucher_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {

            //Date range as a button
            $('#date_filter').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    pending_job_sheets_datatable.ajax.reload();
                    completed_job_sheets_datatable.ajax.reload();
                }
            );
            $('#date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#date_filter').val('');
                pending_job_sheets_datatable.ajax.reload();
                completed_job_sheets_datatable.ajax.reload();
            });

            pending_job_sheets_datatable = $("#pending_job_sheets_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: '/truckmate/job-sheet',
                        "data": function ( d ) {
                            d.location_id = $('#location_id').val();
                            d.contact_id = $('#contact_id').val();
                            d.driver_id = $('#driver_id').val();
                            d.vehicle_id = $('#vehicle_id').val();
                            d.status_id = $('#status_id').val();
                            d.is_completed_status = 0;
                            if ($('#date_filter').val()) {
                                var start = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                var end = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                d.start_date = start;
                                d.end_date = end;
                            }
                        }
                    },
                    columnDefs: [{
                        targets: [0, 5],
                        orderable: false,
                        searchable: false
                    }],
                    aaSorting:[[1, 'asc']],
                    columns:[
                        { data: 'action', name: 'action' },
                        { data: 'job_sheet_no', name: 'job_sheet_no' },
                        { data: 'customer', name: 'contacts.name' },
                        { data: 'start_date', name: 'start_date' },
                        { data: 'end_date', name: 'end_date' },
                        { data: 'status', name: 'ts.name' },
                        { data: 'vehicle_number', name: 'vehicle_number' },
                        { data: 'driver', name: 'driver.name' },
                        { data: 'load_point', name: 'load_point' },
                        { data: 'dest_point', name: 'dest_point' },
                        { data: 'estimated_cost', name: 'estimated_cost'},
                        { data: 'remarks', name: 'remarks'},
                        { data: 'truckmate_no', name: 'truckmate_no'},
                        { data: 'days_remaining', name: 'days_remaining'},
                        { data: 'location', name: 'bl.name'},
                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_1'])): ?>
                            {
                                data: 'custom_field_1', name: 'truckmate_job_sheets.custom_field_1'
                            },
                        <?php endif; ?>
                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_2'])): ?>
                            {
                                data: 'custom_field_2', name: 'truckmate_job_sheets.custom_field_2'
                            },
                        <?php endif; ?>
                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_3'])): ?>
                            {
                                data: 'custom_field_3', name: 'truckmate_job_sheets.custom_field_3'
                            },
                        <?php endif; ?>
                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_4'])): ?>
                            {
                                data: 'custom_field_4', name: 'truckmate_job_sheets.custom_field_4'
                            },
                        <?php endif; ?>
                        <?php if(!empty($truckmate_settings['job_sheet_custom_field_5'])): ?>
                            {
                                data: 'custom_field_5', name: 'truckmate_job_sheets.custom_field_5'
                            },
                        <?php endif; ?>
                        { data: 'added_by', name: 'added_by', searchable: false},
                        { data: 'created_at',
                            name: 'truckmate_job_sheets.created_at'
                        }
                    ],
                    "fnDrawCallback": function (oSettings) {
                        __currency_convert_recursively($('#pending_job_sheets_table'));
                    }
            });

            var cjs_columns = [
                { data: 'action', name: 'action' },
                { data: 'job_sheet_no', name: 'job_sheet_no' },
                { data: 'customer', name: 'contacts.name' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'status', name: 'ts.name' },
                { data: 'vehicle_number', name: 'vehicle_number' },
                { data: 'driver', name: 'driver.name' },
                { data: 'load_point', name: 'load_point' },
                { data: 'dest_point', name: 'dest_point' },
                { data: 'estimated_cost', name: 'estimated_cost'},
                { data: 'remarks', name: 'remarks'},
                { data: 'truckmate_no', name: 'truckmate_no'},
        ];
        <?php if($accounting_enabled): ?>
            cjs_columns.push(
                    { data: 'invoice_total'},
                    { data: 'expenses'},
                    { data: 'expense_total'},
                    { data: 'profit'},
            );
        <?php endif; ?>

        cjs_columns.push(
                // { data: 'days_remaining', name: 'days_remaining'},
                { data: 'location', name: 'bl.name'},
                <?php if(!empty($truckmate_settings['job_sheet_custom_field_1'])): ?>
                    {
                        data: 'custom_field_1', name: 'truckmate_job_sheets.custom_field_1'
                    },
                <?php endif; ?>
                <?php if(!empty($truckmate_settings['job_sheet_custom_field_2'])): ?>
                    {
                        data: 'custom_field_2', name: 'truckmate_job_sheets.custom_field_2'
                    },
                <?php endif; ?>
                <?php if(!empty($truckmate_settings['job_sheet_custom_field_3'])): ?>
                    {
                        data: 'custom_field_3', name: 'truckmate_job_sheets.custom_field_3'
                    },
                <?php endif; ?>
                <?php if(!empty($truckmate_settings['job_sheet_custom_field_4'])): ?>
                    {
                        data: 'custom_field_4', name: 'truckmate_job_sheets.custom_field_4'
                    },
                <?php endif; ?>
                <?php if(!empty($truckmate_settings['job_sheet_custom_field_5'])): ?>
                    {
                        data: 'custom_field_5', name: 'truckmate_job_sheets.custom_field_5'
                    },
                <?php endif; ?>
                { data: 'added_by', name: 'added_by', searchable: false},
                { data: 'created_at',
                    name: 'truckmate_job_sheets.created_at'
                },
            );

            completed_job_sheets_datatable = $("#completed_job_sheets_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: '/truckmate/job-sheet',
                        "data": function ( d ) {
                            d.location_id = $('#location_id').val();
                            d.contact_id = $('#contact_id').val();
                            d.driver_id = $('#driver_id').val();
                            d.vehicle_id = $('#vehicle_id').val();
                            d.status_id = $('#status_id').val();
                            d.is_completed_status = 1;
                            if ($('#date_filter').val()) {
                                var start = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                var end = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                d.start_date = start;
                                d.end_date = end;
                            }
                        }
                    },
                    columnDefs: [{
                        targets: [0, 5],
                        orderable: false,
                        searchable: false
                    }],
                    aaSorting:[[1, 'asc']],
                    columns: cjs_columns,
                    "fnDrawCallback": function (oSettings) {
                        __currency_convert_recursively($('#completed_job_sheets_table'));
                    }
            });

            $(document).on('click', '#delete_job_sheet', function (e) {
                e.preventDefault();
                var url = $(this).data('href');
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((confirmed) => {
                    if (confirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);
                                    pending_job_sheets_datatable.ajax.reload();
                                    completed_job_sheets_datatable.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            <?php if(auth()->user()->can('truckmate_job_sheet.create') || auth()->user()->can('truckmate_job_sheet.edit') || auth()->user()->can('truckmate_job_sheet.update_status')): ?>
                $(document).on('click', '.edit_job_sheet_status', function () {
                    var url = $(this).data('href');
                    $.ajax({
                        method: 'GET',
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                            $('#status_modal').html(result).modal('show');
                        }
                    });
                });
            <?php endif; ?>

            $('#status_modal').on('shown.bs.modal', function (e) {

                //initialize editor
                tinymce.init({
                    selector: 'textarea#email_body',
                });

                $('#send_sms').change(function() {
                    if ($(this). is(":checked")) {
                        $('div.sms_body').fadeIn();
                    } else {
                        $('div.sms_body').fadeOut();
                    }
                });

                $('#send_email').change(function() {
                    if ($(this). is(":checked")) {
                        $('div.email_template').fadeIn();
                    } else {
                        $('div.email_template').fadeOut();
                    }
                });

                if ($('#status_id_modal').length) {
                    ;
                    $("#sms_body").val($("#status_id_modal :selected").data('sms_template'));
                    $("#email_subject").val($("#status_id_modal :selected").data('email_subject'));
                    tinymce.activeEditor.setContent($("#status_id_modal :selected").data('email_body'));  
                }

                $('#status_id_modal').on('change', function() {
                    var sms_template = $(this).find(':selected').data('sms_template');
                    var email_subject = $(this).find(':selected').data('email_subject');
                    var email_body = $(this).find(':selected').data('email_body');

                    $("#sms_body").val(sms_template);
                    $("#email_subject").val(email_subject);
                    tinymce.activeEditor.setContent(email_body);

                    if ($('#status_modal .mark-as-complete-btn').length) {
                        // if ($(this).find(':selected').data('is_completed_status') == 1) 
                        // {
                        //     $('#status_modal').find('.mark-as-complete-btn').removeClass('hide');
                        //     $('#status_modal').find('.mark-as-incomplete-btn').addClass('hide');
                        // } else {
                        //     $('#status_modal').find('.mark-as-complete-btn').addClass('hide');
                        //     $('#status_modal').find('.mark-as-incomplete-btn').removeClass('hide');
                        // }
                    }
                });
            });
            
            $('#status_modal').on('hidden.bs.modal', function(){
                tinymce.remove("textarea#email_body");
            });
            
            $(document).on('click', '.update_status_button', function(){
                $('#status_form_redirect').val($(this).data('href'));
            })
            $(document).on('submit', 'form#update_status_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var ladda = Ladda.create(document.querySelector('.ladda-button'));
                ladda.start();
                $.ajax({
                    method: $(this).attr("method"),
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        ladda.stop();
                        if(result.success == true){
                            $('#status_modal').modal('hide');
                            if (result.msg) {
                                toastr.success(result.msg);
                            }

                            if ($('#status_form_redirect').val()) {
                                window.location = $('#status_form_redirect').val();
                            }
                            pending_job_sheets_datatable.ajax.reload();
                            completed_job_sheets_datatable.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('change', '#location_id, #contact_id, #status_id, #driver_id, #vehicle_id',  function() {
                pending_job_sheets_datatable.ajax.reload();
                completed_job_sheets_datatable.ajax.reload();
            });
        });
    </script>
    <?php if($accounting_enabled): ?>
    <?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        $(document).ready(function(){


            // Handle Add Journal Voucher from Job Sheet
            $(document).on('click', '.add_journal_voucher_from_job', function(e){
                e.preventDefault();
                var jobSheetId = $(this).data('job-sheet-id');
                var jobSheetNo = $(this).data('job-sheet-no');
                var locationId = $(this).data('location-id');
                $.ajax({
                    url: '/accounting/journal-entry/create',
                    data: { 
                        location_id: locationId,
                        job_sheet_id: jobSheetId,
                        job_sheet_no: jobSheetNo
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('#journal_voucher_modal').html(result);
                        $('#journal_voucher_modal').modal('show');
                    },
                });
            });
            
            $(document).on('click', '#journal_voucher_modal #journal_add_form #save_and_print_btn', function(e){
                e.preventDefault();
                $('#journal_voucher_modal #journal_add_form #save_and_print').val(1);
                $('#journal_voucher_modal .journal_add_btn').prop('disabled', true);
                $('#journal_voucher_modal #journal_add_form').submit();
            });

            $(document).on('click', '#journal_voucher_modal .journal_add_btn', function(e){
                //e.preventDefault();
                calculate_total();
                
                var is_valid = true;

                //check if same or not
                if($('.total_credit_hidden').val() != $('.total_debit_hidden').val()){
                    is_valid = false;
                    alert("<?php echo app('translator')->get('accounting::lang.credit_debit_equal'); ?>");
                }

                //check if all account selected or not
                $('#journal_voucher_modal table > tbody  > tr').each(function(index, tr) { 
                    var credit = __read_number($(tr).find('.credit'));
                    var debit = __read_number($(tr).find('.debit'));

                    if(credit != 0 || debit != 0){
                        if($(tr).find('.account_id').val() == ''){
                            is_valid = false;
                            alert("<?php echo app('translator')->get('accounting::lang.select_all_accounts'); ?>");
                        }
                    }
                });

                if(is_valid){
                    $('#journal_voucher_modal .journal_add_btn').prop('disabled', true);
                    $('#journal_voucher_modal form#journal_add_form').submit();
                }

                return is_valid;
            });

            $(document).on('change', '.credit', function(){
                if($(this).val() > 0){
                    $(this).parents('tr').find('.debit').val('');
                }
                calculate_total();
            });
            $(document).on('change', '.debit', function(){
                if($(this).val() > 0){
                    $(this).parents('tr').find('.credit').val('');
                }
                calculate_total();
            });
            $(document).on('change', '.account_id', function(){
                let firstNote = $('#journal_voucher_modal #journal_table tbody tr:first').find('.note').val(); // Get note from the first row
                $(this).closest('tr').find('.note').val(firstNote); // Set note
            });

            $(document).on('click', '.add_new_account_row', function(){
                // Get the last row index
                var lastRowIndex = 0;
                $('#journal_voucher_modal #journal_table tbody tr').each(function(){
                    var rowIndex = parseInt($(this).find('td:first').text());
                    if(!isNaN(rowIndex) && rowIndex > lastRowIndex){
                        lastRowIndex = rowIndex;
                    }
                });
                var newIndex = lastRowIndex + 1;

                var newRow = `
                    <tr>
                        <td>${newIndex}</td>
                        <td>
                            <select name="account_id[${newIndex}]" class="form-control accounts-dropdown account_id" style="width: 100%;">
                                <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="narration_note[${newIndex}]" class="form-control note">
                        </td>
                        <td class="journal-entry-amount-cell">
                            <input type="text" name="debit[${newIndex}]" class="form-control input_number debit journal-entry-amount-input">
                        </td>
                        <td class="journal-entry-amount-cell">
                            <input type="text" name="credit[${newIndex}]" class="form-control input_number credit journal-entry-amount-input">
                        </td>
                    </tr>
                `;

                // Insert the new row before the "add new" button row
                $(this).closest('tr').before(newRow);

                // Initialize the accounts dropdown for the new row
                var newSelect = $('#journal_voucher_modal #journal_table tbody tr').eq(-2).find('.accounts-dropdown');
                newSelect.select2({
                    ajax: {
                        url: '<?php echo e(route("accounts-dropdown"), false); ?>',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: data
                            }
                        },
                    },
                    dropdownParent: $('#journal_voucher_modal'),
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    templateResult: function(data) {
                        return data.html;
                    },
                    templateSelection: function(data) {
                        return data.text;
                    }
                });
            });

        });

        function calculate_total(){
            var precision = $('#__precision').val();

            var total_credit = 0;
            var total_debit = 0;
            $('table > tbody  > tr').each(function(index, tr) { 
                var credit = __read_number($(tr).find('.credit'));
                total_credit += credit;

                var debit = __read_number($(tr).find('.debit'));
                total_debit += debit;
            });

            // Round total_credit and total_debit based on precision
            total_credit = parseFloat(total_credit.toFixed(precision));
            total_debit = parseFloat(total_debit.toFixed(precision));


            $('.total_credit_hidden').val(total_credit);
            $('.total_debit_hidden').val(total_debit);

            $('.total_credit').text(__currency_trans_from_en(total_credit, false));
            $('.total_debit').text(__currency_trans_from_en(total_debit, false));

            if((total_credit != 0) || (total_debit != 0) )
            {
                $('#save_btn').prop('disabled', false);
                $('#save_and_print_btn').prop('disabled', false);
            }
        }

    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
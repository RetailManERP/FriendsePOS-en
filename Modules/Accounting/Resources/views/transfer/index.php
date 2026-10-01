

<?php $__env->startSection('title', __('accounting::lang.transfer')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_transfer_filter_date_range', 'date_range_setting_input_id' => 'accounting_transfer_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.transfer_list' ); ?></h1>
</section>
<section class="content no-print">

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <input type="hidden" id="business_location" value="">
                <input type="hidden" id="date_range" value="">
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select(
                            'location_id',
                            $business_locations,
                            null,
                            ['class' => 'form-control select2', 'placeholder' => 'All', 'style' => 'width:100%'],
                        ); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('transfer_from_filter', __( 'lang_v1.transfer_from' ) . ':'); ?>

                        <?php echo Form::select('transfer_from_filter', [], null,
                            ['class' => 'form-control accounts-dropdown', 'style' => 'width:100%', 
                            'id' => 'transfer_from_filter', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('transfer_to_filter', __( 'account.transfer_to' ) . ':'); ?>

                        <?php echo Form::select('transfer_to_filter', [], null,
                            ['class' => 'form-control accounts-dropdown', 'style' => 'width:100%', 
                            'id' => 'transfer_to_filter', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('transfer_date_range_filter', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('transfer_date_range_filter', null, 
                            ['placeholder' => __('lang_v1.select_a_date_range'), 
                            'class' => 'form-control', 'readonly']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.view_transfer')): ?>
                            <button type="button" class="btn btn-primary" id="transfer_print_btn">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.add_transfer')): ?>
                            <button type="button" class="btn btn-primary btn-modal" 
                                data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\TransferController::class, 'create']), false); ?>" 
                                data-container="#create_transfer_modal" >
                                <i class="fas fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php $__env->endSlot(); ?>
                <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="transfer_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'messages.date' ); ?></th>
                            <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                            <th><?php echo app('translator')->get('account.debit'); ?></th>
                            <th><?php echo app('translator')->get('account.credit'); ?></th>
                            <th><?php echo app('translator')->get('sale.amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.additional_notes'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                            <th><?php echo app('translator')->get('sale.location'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
</div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="create_transfer_modal" tabindex="-1" role="dialog">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready( function(){
        var transferDateRangeSettings = $('#accounting_transfer_filter_date_range').length
            ? window.getAdminReportDateRangeSettings('#accounting_transfer_filter_date_range')
            : $.extend({}, dateRangeSettings);

        $('#transfer_date_range_filter').daterangepicker(
            transferDateRangeSettings,
            function (start, end) {
                $('#transfer_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var dateRange = $('#transfer_date_range_filter').val();
                $('#date_range').val(dateRange);
                if (typeof transfer_table !== 'undefined') {
                    transfer_table.ajax.reload();
                }
            }
        );

        var transferDatePicker = $('#transfer_date_range_filter').data('daterangepicker');
        if (transferDatePicker) {
            $('#transfer_date_range_filter').val(transferDatePicker.startDate.format(moment_date_format) + ' ~ ' + transferDatePicker.endDate.format(moment_date_format));
            $('#date_range').val($('#transfer_date_range_filter').val());
        }

        $(document).on('shown.bs.modal', '#create_transfer_modal', function(){
            $('#operation_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
            $('#transfer_form').submit(function(e) {
                e.preventDefault();
            }).validate({
                submitHandler: function(form) {
                    var data = $(form).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(form).attr('action'),
                        dataType: 'json',
                        data: data,
                        beforeSend: function(xhr) {
                            __disable_submit_button($(form).find('button[type="submit"]'));
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('div#create_transfer_modal').modal('hide');
                                toastr.success(result.msg);
                                transfer_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                                __enable_submit_button($(form).find('button[type="submit"]'));
                                $('#save_and_print_btn').prop('disabled', false);
                                $('#transfer_form #save_and_print').val(0);
                            }
                        },
                        error: function() {
                            __enable_submit_button($(form).find('button[type="submit"]'));
                            $('#save_and_print_btn').prop('disabled', false);
                            $('#transfer_form #save_and_print').val(0);
                        },
                    });
                },
            })
        });
        
        //Transfer table
        transfer_table = $('#transfer_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(action([\Modules\Accounting\Http\Controllers\TransferController::class, 'index']), false); ?>",
                data: function(d) {
                    var start = '';
                    var end = '';
                    if ($('#transfer_date_range_filter').val()) {
                        start = $('input#transfer_date_range_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#transfer_date_range_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                    d.transfer_from = $('#transfer_from_filter').val();
                    d.transfer_to = $('#transfer_to_filter').val();
                    d.location_id = $('select#location_id').val();
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'operation_date', name: 'operation_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'from_account_name', name: 'from_account.name' },
                { data: 'to_account_name', name: 'to_account.name' },
                { data: 'amount', name: 'from_transaction.amount' },
                { data: 'note', name: 'accounting_acc_trans_mappings.note' },
                { data: 'added_by', name: 'added_by' },
                { data: 'location', name: 'location' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
        $(document).on('change', '#transfer_from_filter, #transfer_to_filter', function(){
            transfer_table.ajax.reload();
        })
        $('#transfer_date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#transfer_date_range_filter').val('');
            $('#date_range').val('');
            transfer_table.ajax.reload();
        });

        $('select#location_id').on('change', function() {
            var location = $('select#location_id').find('option:selected').text();
            $('#business_location').val(location);
            transfer_table.ajax.reload();
        });

        var dateRange = $('#transfer_date_range_filter').val();
        $('#date_range').val(dateRange);

        $('#transfer_print_btn').on('click', function(e) {
            e.preventDefault();
            window.open("<?php echo e(route('transfer.print'), false); ?>?" + $.param(getTransferPrintParams()), '_blank');
        });

        function getTransferPrintParams() {
            var start = '';
            var end = '';
            if ($('#transfer_date_range_filter').val()) {
                start = $('input#transfer_date_range_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#transfer_date_range_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            return {
                start_date: start,
                end_date: end,
                transfer_from: $('#transfer_from_filter').val() || 'all',
                transfer_to: $('#transfer_to_filter').val() || 'all',
                location_id: $('select#location_id').val() || 'all',
                tab: 'all'
            };
        }

        //Delete Sale
        $(document).on('click', '.delete_transfer_button', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('data-href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                transfer_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

	});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
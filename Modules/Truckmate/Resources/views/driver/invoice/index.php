
<?php $__env->startSection('title', __('truckmate::lang.list_invoices')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::driver.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-file-invoice-dollar" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.list_invoices'); ?></h1>
    </div>
</section>

<!-- Main content -->
<section class="content tm-content">
    <div clawss="row">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php if(auth()->user()->can('all_expense.access')): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('expense_for', __('expense.expense_for').':'); ?>

                        <?php echo Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('expense_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('expense_payment_status',  __('purchase.payment_status') . ':'); ?>

                    <?php echo Form::select('expense_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('added_by', __('expense.added_by').':'); ?>

                    <?php echo Form::select('added_by', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <br>
                        <label>
                            <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                        </label>
                    </div>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('truckmate::lang.list_invoices')]); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_driver.add_invoice')): ?>
                    <?php $__env->slot('tool'); ?>
                        <div class="box-tools">
                            <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'createDriverInvoice']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                        </div>
                    <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="driver_invoices_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('expense.expense_for'); ?></th>
                                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                <th><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                <th><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                <th><?php echo app('translator')->get('expense.expense_note'); ?></th>
                                <th><?php echo app('translator')->get('business.location'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                <td class="footer_payment_status_count"></td>
                                <td class="footer_payment_method_count"></td>
                                <td class="footer_expense_total"></td>
                                <td class="footer_total_due"></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<!-- /.content -->
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
	$(document).ready( function(){
		 $(document).on('change', 'input#show_deleted', function(e) {
            driver_invoices_table.ajax.reload();
        });

        //date filter for expense table
        if ($('#expense_date_range').length == 1) {
            $('#expense_date_range').daterangepicker(
                dateRangeSettings, 
                function(start, end) {
                    $('#expense_date_range').val(
                        start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                    );
                    driver_invoices_table.ajax.reload();
                }
            );

            $('#expense_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#product_sr_date_filter').val('');
                driver_invoices_table.ajax.reload();
            });
        }           

        //Expense table
        driver_invoices_table = $('#driver_invoices_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            ajax: {
                url: '/truckmate/driver-invoices',
                data: function(d) {
                    d.expense_for = $('select#expense_for').val();
                    d.added_by = $('select#added_by').val();
                    d.location_id = $('select#location_id').val();
                    d.payment_status = $('select#expense_payment_status').val();
                    d.start_date = $('input#expense_date_range')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    d.end_date = $('input#expense_date_range')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                    d.show_deleted = $('#show_deleted').is(':checked');
                },
            },
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'expense_for', name: 'expense_for' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'payment_status', name: 'payment_status', orderable: false },
                { data: 'payment_methods', name: 'payment_methods', orderable: false },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_due', name: 'payment_due' },
                { data: 'staff_note', name: 'staff_note' },
                { data: 'location_name', name: 'bl.name' },
                { data: 'added_by', name: 'usr.first_name'}
            ],
            fnDrawCallback: function(row, data, start, end, display) {
                var expense_total = sum_table_col($('#expense_table'), 'final-total');
                var total_due = sum_table_col($('#expense_table'), 'payment_due');

                $('.footer_expense_total').html(__currency_trans_from_en(expense_total));
                $('.footer_total_due').html(__currency_trans_from_en(total_due));

                $('.footer_payment_status_count').html(
                    __sum_status_html($('#driver_invoices_table'), 'payment-status')
                );
                
            },
            "footerCallback": function(row, data) {
                $('.footer_payment_method_count').html(__count_status(data, 'payment_methods'));
            },
            createdRow: function(row, data, dataIndex) {
                $(row)
                    .find('td:eq(4)')
                    .attr('class', 'clickable_td');
            },
        });

        $('select#location_id, select#expense_for, select#added_by, select#expense_contact_filter, \
            select#expense_category_id, select#expense_payment_status, \
            select#expense_sub_category_id_filter').on(
            'change',
            function() {
                driver_invoices_table.ajax.reload();
            }
        );

        $(document).on('click', 'a.delete_driver_invoice', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_expense,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success === true) {
                                toastr.success(result.msg);
                                driver_invoices_table.ajax.reload();
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
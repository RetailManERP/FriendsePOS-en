
<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<?php $__env->startSection('title', !empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : __('truckmate::lang.truckmate')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::truckmate.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-file-invoice" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.list_invoices'); ?></h1>
    </div>
</section>

<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'closed' => false]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('sell_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('sell_list_filter_date_range', '', ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('sell_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('sell_list_filter_customer_id',  __('role.customer') . ':'); ?>

                <?php echo Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('sell_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

                <?php echo Form::select('sell_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue'), 'overpaid' => __('lang_v1.overpaid')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
    
    <?php echo $__env->renderComponent(); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.invoices')]); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate.add')): ?>
    <?php $__env->slot('tool'); ?>
    <div class="box-tools">
        <a class="btn btn-inline btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'create']), false); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
    </div>
    <?php $__env->endSlot(); ?>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped ajax_view table-th-skin" id="truckmate_invoices_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                    <th><?php echo app('translator')->get('receipt.date'); ?></th>
                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                    <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                    <th><?php echo app('translator')->get('truckmate::lang.job_sheets'); ?></th>
                    <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                    <th><?php echo app('translator')->get('sale.total_amount'); ?></th>
                    <th><?php echo app('translator')->get('purchase.payment_due'); ?></th>
                    <th><?php echo app('translator')->get('truckmate::lang.due_date'); ?></th>
                    <th><?php echo app('translator')->get('truckmate::lang.days_remaining'); ?></th>
                    <th><?php echo app('translator')->get('sale.location'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr class="bg-gray font-17 footer-total text-center">
                    <td colspan="5">
                            <strong><?php echo app('translator')->get('sale.total'); ?>:</strong>
                    </td>
                    <td id="footer_payment_status_count"></td>
                    <td>
                        <span class="display_currency" id="footer_sale_total" data-currency_symbol ="true"></span>
                    </td>
                    <td class="text-left">
                        <small>
                            <span class="display_currency" id="footer_total_remaining" data-currency_symbol ="true"></span>
                        </small>
                    </td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php echo $__env->renderComponent(); ?>

    

    <div class="modal fade" id="edit_truckmate_status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade" id="edit_collection_info_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
$(document).ready( function(){
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

    sell_table = $('#truckmate_invoices_table').DataTable({
        processing: true,
        serverSide: true,
        // aaSorting: [[2, 'asc']],
        "ajax": {
            "url": "/truckmate/truckmate",
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
            }
        },
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'name', name: 'contacts.name'},
            { data: 'job_sheet_nos', name: 'job_sheet_nos'},
            { data: 'payment_status', name: 'payment_status'},
            { data: 'final_total', name: 'final_total', orderable: false, searchable: false},
            { data: 'total_remaining', name: 'total_remaining', orderable: false, searchable: false},
            { data: 'due_date', name: 'due_date', orderable: false, searchable: false},
            { data: 'days_remaining', name: 'days_remaining', orderable: false, searchable: false},
            { data: 'business_location', name: 'bl.name', orderable: false, searchable: false},
            { data: 'added_by', name: 'added_by', orderable: false, searchable: false},
        ],
        "fnDrawCallback": function (oSettings) {

            $('#footer_sale_total').text(sum_table_col($('#truckmate_invoices_table'), 'final-total'));

            $('#footer_total_remaining').text(sum_table_col($('#truckmate_invoices_table'), 'payment_due'));
            
            $('#footer_payment_status_count').html(__sum_status_html($('#truckmate_invoices_table'), 'payment-status-label'));

            __currency_convert_recursively($('#truckmate_invoices_table'));
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(11)').attr('class', 'clickable_td');
            $( row ).find('td:eq(14)').attr('class', 'clickable_td edit_status_td');
        }
    });

    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status',  function() {
        sell_table.ajax.reload();
    });
    
    $(document).on('click', '.collapsed-box-title', function(e){
        if (e.target.tagName == 'BUTTON' || e.target.tagName == 'I') {
            return false;
        }
        $(this).find('.box-tools button').click();
    });

});
</script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
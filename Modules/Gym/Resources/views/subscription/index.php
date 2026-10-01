
<?php $__env->startSection('title', __('gym::lang.subscription')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.subscriptions'); ?>
        </h1>
    </section>
    <section class="content">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('customer_id',  __('contact.customer') . ':'); ?>

                <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'id' => 'customer_id', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('package_id',  __('gym::lang.packages') . ':'); ?>

                <?php echo Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'id' => 'package_id', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('payment_status',  __('purchase.payment_status') . ':'); ?>

                <?php echo Form::select('payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.widget'); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                    <a class="btn btn-primary pull-right"
                        href="<?php echo e(action([\Modules\Gym\Http\Controllers\SubscriptionController::class, 'create']), false); ?>">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                    </a>
            </div>
        <?php $__env->endSlot(); ?>
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="subscription_table" style="width: 100%">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.customer'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.package'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('sale.invoice_no'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.payment_status'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.payment_method'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.total_amount'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.total_paid'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.due'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.created_at'); ?>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6"><strong class="pull-right"><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_total"></td>
                        <td class="footer_total_paid"></td>
                        <td class="footer_total_due"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>

        <!-- Add HMS Extra Modal -->
        <div class="modal fade view_modal_extra" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        </div>

    </section>
    <!-- /.content -->
    

        <!-- /.content -->
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('javascript'); ?>
        <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>

        <script>
            $(document).ready(function() {

                dateRangeSettings.startDate = moment().startOf('month');
                dateRangeSettings.endDate = moment().endOf('month');
                $('#date_range').daterangepicker(
                    dateRangeSettings,
                    function (start, end) {
                        $('#date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    }
                );
                
                subscription_table = $('#subscription_table').DataTable({
                    processing: true,
                    serverSide: true,
                    fixedHeader: false,
                    ajax: {
                        url: "<?php echo e(action([\Modules\Gym\Http\Controllers\SubscriptionController::class, 'index']), false); ?>",
                        "data": function(d) {
                            d.customer_id = $('#customer_id').val();
                            d.package_id = $('#package_id').val();
                            d.payment_status = $('#payment_status').val();
                            if($('#date_range').val()) {
                                var start = $('#date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                var end = $('#date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                d.start_date = start;
                                d.end_date = end;
                            }
                        },
                    },
                    aaSorting: [
                        [7, 'desc']
                    ],
                    columns: [
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            "searchable": false
                        },
                        {
                            data: 'c_name',
                            name: 'c.name',
                        },
                        {
                            data: 'package',
                            name: 'package',
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no',
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status',
                        },
                        {
                            data: 'payment_methods',
                            orderable: false,
                            "searchable": false
                        },
                        {
                            data: 'final_total',
                            name: 'final_total'
                        },
                        {
                            data: 'total_paid',
                            name: 'total_paid',
                            "searchable": false
                        },
                        {
                            data: 'total_remaining',
                            name: 'total_remaining'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var footer_total = 0;
                        var footer_total_paid = 0;
                        var footer_total_due = 0;
                        for (var r in data) {
                            footer_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                            footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                            footer_total_due += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                        }

                        $('.footer_total').html(__currency_trans_from_en(footer_total));
                        $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
                        $('.footer_total_due').html(__currency_trans_from_en(footer_total_due));

                    },
                });

                $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $('#date_range').val('');
                    subscription_table.ajax.reload();
                });

                $(document).on('change', '#customer_id, #payment_status, #package_id, #date_range', function() {
                    subscription_table.ajax.reload();
                });

                $('.payment_modal').on('hide.bs.modal', function (e) {
                    subscription_table.ajax.reload();
                });

                //Delete Subscription
                $(document).on('click', '.delete-subscription', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    }).then(willDelete => {
                        if (willDelete) {
                            var href = $(this).attr('href');
                            $.ajax({
                                method: 'DELETE',
                                url: href,
                                dataType: 'json',
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        subscription_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });

                //Unfreeze Subscription
                $(document).on('click', '.unfreeze-subscription', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        text: '<?php echo e(__("gym::lang.unfreeze_confirm"), false); ?>',
                        icon: 'info',
                        buttons: true,
                    }).then(willUnfreeze => {
                        if (willUnfreeze) {
                            var href = $(this).data('href');
                            $.ajax({
                                method: 'POST',
                                url: href,
                                dataType: 'json',
                                data: { _token: '<?php echo e(csrf_token(), false); ?>' },
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        subscription_table.ajax.reload();
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
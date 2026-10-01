
<?php $__env->startSection('title', __('hms::lang.bookings')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1> <?php echo app('translator')->get('hms::lang.bookings'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.bookings_help_text'); ?> </p>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                    <?php echo Form::select('customer_id', $customers, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('status', __('hms::lang.status') . ':'); ?>

                    <?php echo Form::select('status', $status, null, [
                        'class' => 'form-control',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_payment_status', __('hms::lang.payment_status') . ':'); ?>

                    <?php echo Form::select(
                        'filter_payment_status',
                        [
                            'paid' => __('lang_v1.paid'),
                            'due' => __('lang_v1.due'),
                            'partial' => __('lang_v1.partial'),
                            'overdue' => __('lang_v1.overdue'),
                        ],
                        null,
                        ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')],
                    ); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.widget'); ?>
            <div class="box-tools float-end mb-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.add_booking')): ?>
                        <a class="btn btn-primary pull-right"
                            href="<?php echo e(action([\Modules\Hms\Http\Controllers\HmsBookingController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </a>
                <?php endif; ?>
            </div>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped table-hover table-th-skin" id="bookings_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('hms::lang.booking_Id'); ?>
                        </th>

                        <th>
                            <?php echo app('translator')->get('hms::lang.stay'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.customer'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.status'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.payment_status'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.payment_method'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.total_amount'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.total_paid'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.due'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.created_at'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('messages.action'); ?>
                        </th>
                    </tr>
                </thead>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>
        </div>
    </section>
    
        <!-- /.content -->
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('modals'); ?>
        <div class="modal fade check_in_out" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('javascript'); ?>
        <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                bookings_table = $('#bookings_table').DataTable({
                    processing: true,
                    serverSide: true,
                    fixedHeader:false,
                    ajax: {
                        url: "<?php echo e(action([\Modules\Hms\Http\Controllers\HmsBookingController::class, 'index']), false); ?>",
                        "data": function(d) {
                            d.customer_id = $('#customer_id').val();
                            d.status = $('#status').val();
                            d.payment_status = $('#filter_payment_status').val();
                        },
                    },
                    aaSorting: [
                        [9, 'desc']
                    ],
                    columns: [{
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'stay',
                            name: 'stay',
                            orderable: false,
                            "searchable": false
                        },
                        {
                            data: 'c_name',
                            name: 'c.name',
                        },
                        {
                            data: 'status',
                            name: 'status'
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
                        {
                            data: 'action',
                            name: 'action',
                            sorting: false,
                        }
                    ],
                });

                $(document).on('change', '#customer_id, #status, #filter_payment_status', function() {
                    bookings_table.ajax.reload();
                });

                $(document).on('click', '.btn-modal-checkIn', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('href'),
                        dataType: 'html',
                        success: function(result) {
                            $('.check_in_out')
                                .html(result)
                                .modal('show');
                        },
                    });
                });
                $(".check_in_out").on("show.bs.modal", function() {
                    var currentDate = new Date();
                    var currentDateTime = moment(currentDate);

                    $('.date_picker').datetimepicker({
                        format: moment_date_format + ' ' + moment_time_format,
                        ignoreReadonly: true,
                        defaultDate: currentDateTime
                    });
                });

            // Delete booking handler
            $(document).on('click', '.delete-booking', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_row,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);
                                    bookings_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });

            // Payment modal handlers
            $(document).on('click', '.view_payment_modal', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.payment_modal').html(result).modal('show');
                    },
                });
            });

            $(document).on('click', '.add_payment_modal', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.payment_modal').html(result).modal('show');
                    },
                });
            });

            // Refresh table after payment is saved
            $(document).on('click', '.payment_modal .btn-primary', function() {
                setTimeout(function() {
                    bookings_table.ajax.reload();
                }, 1500);
            });

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
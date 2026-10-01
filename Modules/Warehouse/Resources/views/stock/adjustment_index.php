
<?php $__env->startSection('title', __('stock_adjustment.stock_adjustments')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('stock_adjustment.stock_adjustments'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'location_id', 'style' => 'width:100%', 'placeholder' => __('messages.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('adjustment_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'adjustment_date_range', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('stock_adjustment.all_stock_adjustments')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(route('warehouse.stock.adjust'), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view table-th-skin" id="wh_stock_adjustment_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('business.location'); ?></th>
                        <th><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></th>
                        <th><?php echo app('translator')->get('stock_adjustment.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                        <th><?php echo app('translator')->get('stock_adjustment.total_recovered'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                        <th><?php echo app('translator')->get('stock_adjustment.reason_for_stock_adjustment'); ?></th>
                        <th><?php echo app('translator')->get('expense.added_by'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade" id="wh_sa_view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="view_modal"></div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/stock_adjustment.js?v=' . config('constants.asset_version', '1.0')), false); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {

    var wh_sa_table = $('#wh_stock_adjustment_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        "ajax": {
            "url": '<?php echo e(route('warehouse.stock.adjustments'), false); ?>',
            "data": function (d) {
                d.location_id = $('select#location_id').val();
                if ($('#adjustment_date_range').data('daterangepicker')) {
                    d.start_date = $('#adjustment_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    d.end_date   = $('#adjustment_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
            }
        },
        columnDefs: [{ targets: 0, orderable: false, searchable: false }],
        aaSorting: [[1, 'desc']],
        columns: [
            { data: 'action', name: 'action' },
            { data: 'transaction_date', name: 'transaction_date' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'location_name', name: 'BL.name' },
            { data: 'adjustment_type', name: 'adjustment_type' },
            { data: 'final_total', name: 'final_total' },
            { data: 'total_amount_recovered', name: 'total_amount_recovered' },
            { data: 'additional_notes', name: 'additional_notes' },
            { data: 'added_by', name: 'u.first_name' },
        ],
        fnDrawCallback: function () {
            __currency_convert_recursively($('#wh_stock_adjustment_table'));
        },
    });

    $('select#location_id').on('change', function () {
        wh_sa_table.ajax.reload();
    });

    if ($('#adjustment_date_range').length) {
        $('#adjustment_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#adjustment_date_range span').html(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                wh_sa_table.ajax.reload();
            }
        );
        $('#adjustment_date_range').on('cancel.daterangepicker', function () {
            $('#adjustment_date_range').val('');
            wh_sa_table.ajax.reload();
        });
    }

    $(document).on('click', 'button.delete_stock_adjustment', function () {
        var btn = $(this);
        swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    method: 'DELETE',
                    url: btn.data('href'),
                    dataType: 'json',
                    success: function (result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            wh_sa_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', 'button.restore_stock_adjustment', function () {
        var btn = $(this);
        swal({ title: LANG.sure, icon: 'info', buttons: true }).then(function (willRestore) {
            if (willRestore) {
                $.ajax({
                    method: 'GET',
                    url: btn.data('href'),
                    dataType: 'json',
                    success: function (result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            wh_sa_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    // Open show modal via row click or view button
    $(document).on('click', '.btn-modal', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        var container = $(this).data('container');
        $(container).load(href, function () {
            $('#wh_sa_view_modal').modal('show');
        });
    });

    $('table#wh_stock_adjustment_table').on('click', 'tbody tr', function () {
        var href = $(this).data('href');
        if (href) {
            $('.view_modal').load(href, function () {
                $('#wh_sa_view_modal').modal('show');
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
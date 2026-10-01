
<?php $__env->startSection('title', __('manufacturing::lang.demand_orders')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #demand_orders_table_wrapper .dataTables_scrollBody > table {
        min-width: 100% !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('manufacturing::lang.demand_orders'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('do_filter_location_id', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('do_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('do_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('do_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('do_filter_status', __('sale.status') . ':'); ?>

                <?php echo Form::select('do_filter_status', [
                    '' => __('lang_v1.all'),
                    'draft' => __('manufacturing::lang.do_status_draft'),
                    'pending' => __('manufacturing::lang.do_status_pending'),
                    'approved' => __('manufacturing::lang.do_status_approved'),
                    'in_production' => __('manufacturing::lang.do_status_in_production'),
                    'partially_completed' => __('manufacturing::lang.do_status_partially_completed'),
                    'completed' => __('manufacturing::lang.do_status_completed'),
                    'cancelled' => __('manufacturing::lang.do_status_cancelled'),
                ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-primary btn-sm" id="do_filter_save">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="do_filter_reset">
                <i class="fa fa-undo"></i> <?php echo app('translator')->get('lang_v1.reset'); ?>
            </button>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.add_demand_order')): ?>
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('manufacturing::lang.add_demand_order'); ?>
                </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="demand_orders_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.demand_date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('purchase.location'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.total_items'); ?></th>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.priority'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.required_date'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.estimated_cost'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_total_items text-right"></td>
                        <td colspan="3"></td>
                        <td class="footer_total_estimated_cost text-right"></td>
                        <td class="footer_total_selling_price text-right"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- Change Status Modal -->
<div class="modal fade" id="change_demand_status_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?php echo Form::open(['id' => 'change_demand_status_form', 'method' => 'POST']); ?>

            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exchange-alt"></i> <?php echo app('translator')->get('manufacturing::lang.change_status'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong><?php echo app('translator')->get('manufacturing::lang.current_status'); ?>:</strong> <span id="current_status_badge"></span></p>
                <div class="form-group">
                    <?php echo Form::label('new_demand_status', __('manufacturing::lang.new_status') . ':'); ?>

                    <?php echo Form::select('new_demand_status', [], null, ['class' => 'form-control', 'id' => 'new_demand_status', 'required']); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="submit" class="btn btn-primary" id="submit_change_status"><i class="fas fa-check"></i> <?php echo app('translator')->get('manufacturing::lang.update_status'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    <?php if(session('print_on_load') && session('print_demand_order_id')): ?>
        setTimeout(function() {
            var printId = <?php echo e(session('print_demand_order_id'), false); ?>;
            var printUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, "printView"], "__ID__"), false); ?>'.replace('__ID__', printId);
            window.open(printUrl, '_blank', 'width=1000,height=720,scrollbars=yes,resizable=yes');
        }, 400);
    <?php endif; ?>

    // ── Demand Order filter: Save / Reset ───────────────────────────────────
    var _doFilterKey = 'do_filters_<?php echo e(auth()->id(), false); ?>';

    function _doRestoreFilters() {
        var saved = null;
        try { saved = JSON.parse(localStorage.getItem(_doFilterKey)); } catch(e) {}
        if (!saved) return;
        if (saved.location_id) {
            $('#do_filter_location_id').val(saved.location_id).trigger('change.select2');
        }
        if (saved.date_range) {
            $('#do_filter_date_range').val(saved.date_range);
        }
        if (saved.status) {
            $('#do_filter_status').val(saved.status).trigger('change.select2');
        }
    }

    $('#do_filter_save').on('click', function() {
        var data = {
            location_id: $('#do_filter_location_id').val() || '',
            date_range:  $('#do_filter_date_range').val()  || '',
            status:      $('#do_filter_status').val()      || '',
        };
        localStorage.setItem(_doFilterKey, JSON.stringify(data));
        toastr.success('<?php echo e(__('lang_v1.success'), false); ?>');
    });

    $('#do_filter_reset').on('click', function() {
        localStorage.removeItem(_doFilterKey);
        $('#do_filter_location_id').val('').trigger('change.select2');
        var drp = $('#do_filter_date_range').data('daterangepicker');
        if (drp) { drp.setStartDate(moment()); drp.setEndDate(moment()); }
        $('#do_filter_date_range').val('');
        $('#do_filter_status').val('').trigger('change.select2');
        demand_orders_table.ajax.reload();
    });
    // ─────────────────────────────────────────────────────────────────────────

    // Date range filter
    var doDateSettings = $.extend(true, {}, dateRangeSettings);
    doDateSettings.startDate = moment();
    doDateSettings.endDate = moment();
    $('#do_filter_date_range').daterangepicker(doDateSettings, function(start, end) {
        $('#do_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        demand_orders_table.ajax.reload();
    });
    var _doSaved = null;
    try { _doSaved = JSON.parse(localStorage.getItem(_doFilterKey)); } catch(e) {}
    if (_doSaved && _doSaved.date_range) {
        var _doParts = _doSaved.date_range.split(' ~ ');
        if (_doParts.length === 2) {
            doDateSettings.startDate = moment(_doParts[0], moment_date_format);
            doDateSettings.endDate   = moment(_doParts[1], moment_date_format);
            var _doDrp = $('#do_filter_date_range').data('daterangepicker');
            if (_doDrp) { _doDrp.setStartDate(doDateSettings.startDate); _doDrp.setEndDate(doDateSettings.endDate); }
            $('#do_filter_date_range').val(_doSaved.date_range);
        }
    } else {
        $('#do_filter_date_range').val(moment().format(moment_date_format) + ' ~ ' + moment().format(moment_date_format));
    }
    $('#do_filter_date_range').on('cancel.daterangepicker', function() {
        $(this).val('');
        demand_orders_table.ajax.reload();
    });

    _doRestoreFilters();

    // DataTable
    var demand_orders_table = $('#demand_orders_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        aaSorting: [[1, 'desc']],
        ajax: {
            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, "index"]), false); ?>',
            data: function(d) {
                if ($('#do_filter_date_range').val()) {
                    var start = $('#do_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#do_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.location_id = $('#do_filter_location_id').val();
                d.demand_status = $('#do_filter_status').val();
                d = __datatable_ajax_callback(d);
            }
        },
        columnDefs: [{ targets: [0], orderable: false, searchable: false }],
        columns: [
            { data: 'action', name: 'action' },
            { data: 'demand_date', name: 'mfg_demand_orders.demand_date' },
            { data: 'ref_no', name: 'mfg_demand_orders.ref_no' },
            { data: 'location_name', name: 'bl.name' },
            { data: 'total_items', searchable: false, orderable: false, className: 'text-right' },
            { data: 'status', name: 'mfg_demand_orders.status' },
            { data: 'priority', name: 'mfg_demand_orders.priority' },
            { data: 'required_date', name: 'mfg_demand_orders.required_date' },
            { data: 'total_estimated_cost', name: 'mfg_demand_orders.total_estimated_cost', className: 'text-right' },
            { data: 'total_selling_price', name: 'total_selling_price', orderable: false, searchable: false, className: 'text-right' },
            { data: 'created_by_name', name: 'u.first_name' },
        ],
        fnDrawCallback: function() {
            __currency_convert_recursively($('#demand_orders_table'));
        },
        footerCallback: function(row, data, start, end, display) {
            var total_items = 0, total_cost = 0, total_selling = 0;
            for (var r in data) {
                total_items   += parseFloat(data[r].total_items) || 0;
                total_cost    += parseFloat($(data[r].total_estimated_cost).text()) || 0;
                total_selling += parseFloat($(data[r].total_selling_price).text()) || 0;
            }
            $('.footer_total_items').text(total_items);
            $('.footer_total_estimated_cost').html(__currency_trans_from_en(total_cost));
            $('.footer_total_selling_price').html(__currency_trans_from_en(total_selling));
        }
    });

    // Filter changes
    $('#do_filter_location_id, #do_filter_status').change(function() {
        demand_orders_table.ajax.reload();
    });

    // Delete demand order
    $(document).on('click', '.delete-demand-order', function() {
        swal({
            title: LANG.sure,
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
                            demand_orders_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

    // Update status
    $(document).on('click', '.update-demand-status', function() {
        var href = $(this).data('href');
        var status = $(this).data('status');
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                $.ajax({
                    method: 'POST',
                    url: href,
                    data: { status: status },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            demand_orders_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

    // Change status via modal
    var canApproveDemandOrder = <?php echo e(auth()->user()->can('manufacturing.approve_demand_order') ? 'true' : 'false', false); ?>;
    var allStatusOptions = [
        { value: 'draft',               label: '<?php echo app('translator')->get("manufacturing::lang.do_status_draft"); ?>' },
        { value: 'pending',             label: '<?php echo app('translator')->get("manufacturing::lang.do_status_pending"); ?>' },
        { value: 'approved',            label: '<?php echo app('translator')->get("manufacturing::lang.do_status_approved"); ?>' },
        { value: 'in_production',       label: '<?php echo app('translator')->get("manufacturing::lang.do_status_in_production"); ?>' },
        { value: 'partially_completed', label: '<?php echo app('translator')->get("manufacturing::lang.do_status_partially_completed"); ?>' },
        { value: 'completed',           label: '<?php echo app('translator')->get("manufacturing::lang.do_status_completed"); ?>' },
        { value: 'cancelled',           label: '<?php echo app('translator')->get("manufacturing::lang.do_status_cancelled"); ?>' },
    ];
    // From any non-terminal status, all other statuses are available (approve_demand_order required for all)
    var statusTransitions = {};
    $.each(allStatusOptions, function(i, opt) {
        if (opt.value !== 'cancelled') {
            statusTransitions[opt.value] = allStatusOptions.filter(function(o) {
                return o.value !== opt.value;
            });
        }
    });

    var statusBadges = {
        'draft': '<span class="badge bg-secondary"><?php echo app('translator')->get("manufacturing::lang.do_status_draft"); ?></span>',
        'pending': '<span class="badge bg-warning"><?php echo app('translator')->get("manufacturing::lang.do_status_pending"); ?></span>',
        'approved': '<span class="badge bg-info"><?php echo app('translator')->get("manufacturing::lang.do_status_approved"); ?></span>',
        'in_production': '<span class="badge bg-primary"><?php echo app('translator')->get("manufacturing::lang.do_status_in_production"); ?></span>',
        'partially_completed': '<span class="badge bg-orange text-white" style="background-color:#ff851b"><?php echo app('translator')->get("manufacturing::lang.do_status_partially_completed"); ?></span>',
        'completed': '<span class="badge bg-success"><?php echo app('translator')->get("manufacturing::lang.do_status_completed"); ?></span>',
        'cancelled': '<span class="badge bg-danger"><?php echo app('translator')->get("manufacturing::lang.do_status_cancelled"); ?></span>'
    };

    $(document).on('click', '.change-demand-status', function(e) {
        e.preventDefault();
        var currentStatus = $(this).data('status');
        var href = $(this).data('href');
        var transitions = statusTransitions[currentStatus] || [];

        $('#current_status_badge').html(statusBadges[currentStatus] || currentStatus);
        $('#change_demand_status_form').attr('action', href);

        var $select = $('#new_demand_status').empty();
        $.each(transitions, function(i, opt) {
            $select.append('<option value="' + opt.value + '">' + opt.label + '</option>');
        });

        $('#change_demand_status_modal').modal('show');
    });

    $('#change_demand_status_form').on('submit', function(e) {
        e.preventDefault();
        var href = $(this).attr('action');
        var newStatus = $('#new_demand_status').val();
        $('#submit_change_status').prop('disabled', true);

        $.ajax({
            method: 'POST',
            url: href,
            data: { status: newStatus },
            dataType: 'json',
            success: function(result) {
                $('#change_demand_status_modal').modal('hide');
                $('#submit_change_status').prop('disabled', false);
                if (result.success) {
                    toastr.success(result.msg);
                    demand_orders_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                $('#submit_change_status').prop('disabled', false);
                toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
            }
        });
    });

    // Print demand order
    $(document).on('click', '.print-demand-order', function() {
        var url = $(this).data('href');
        window.open(url, '_blank', 'width=1000,height=720,scrollbars=yes,resizable=yes');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
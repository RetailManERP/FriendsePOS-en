
<?php $__env->startSection('title', __('manufacturing::lang.production_transfer_products_summary')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-balance-scale me-2"></i><?php echo app('translator')->get('manufacturing::lang.production_transfer_products_summary'); ?></h1>
</section>

<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'open' => true]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_location_id', __('lang_v1.location_from').':'); ?>

                    <?php echo Form::select('ptps_location_id', $business_locations, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('report.all_locations'),
                        'id' => 'ptps_location_id'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_transfer_location_id', __('lang_v1.location_to').':'); ?>

                    <?php echo Form::select('ptps_transfer_location_id', $business_locations, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('report.all_locations'),
                        'id' => 'ptps_transfer_location_id'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_date_range', __('report.date_range').':'); ?>

                    <?php echo Form::text('ptps_date_range', null, [
                        'placeholder' => __('lang_v1.select_a_date_range'),
                        'class' => 'form-control',
                        'readonly',
                        'id' => 'ptps_date_range'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_status', __('lang_v1.stock_transfers').' '. __('sale.status').':'); ?>

                    <?php echo Form::select('ptps_status', [
                        'pending' => __('lang_v1.pending'),
                        'in_transit' => __('lang_v1.in_transit'),
                        'final' => __('restaurant.completed')
                    ], null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                        'id' => 'ptps_status'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_finalized', __('manufacturing::lang.finalize').':'); ?>

                    <?php echo Form::select('ptps_finalized', [
                        '' => __('lang_v1.all'),
                        '1' => __('manufacturing::lang.finalize'),
                        '0' => __('lang_v1.draft')
                    ], '1', [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'ptps_finalized'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_category_id', __('product.category').':'); ?>

                    <?php echo Form::select('ptps_category_id', $categories, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                        'id' => 'ptps_category_id'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_sub_category_id', __('product.sub_category').':'); ?>

                    <?php echo Form::select('ptps_sub_category_id', [], null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                        'id' => 'ptps_sub_category_id'
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ptps_sub2_category_id', __('product.sub2_category').':'); ?>

                    <?php echo Form::select('ptps_sub2_category_id', [], null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                        'id' => 'ptps_sub2_category_id'
                    ]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row mb-3 no-print">
        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-primary" id="ptps_print_report">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin nowrap" id="ptps_table" style="width:100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('product.product'); ?></th>
                            <th><?php echo app('translator')->get('product.sku'); ?></th>
                            <th><?php echo app('translator')->get('product.category'); ?></th>
                            <th><?php echo app('translator')->get('product.unit'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.produced_qty'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.transferred_qty'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.qty_difference'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.production_value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                            <th><?php echo app('translator')->get('manufacturing::lang.transfer_value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                            <th><?php echo app('translator')->get('manufacturing::lang.value_difference'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                            <th><?php echo app('translator')->get('manufacturing::lang.productions_count'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.transfers_count'); ?></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total">
                            <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td id="ptps_footer_produced_qty" data-ptps-footer="produced_qty"></td>
                            <td id="ptps_footer_transferred_qty" data-ptps-footer="transferred_qty"></td>
                            <td id="ptps_footer_qty_difference" data-ptps-footer="qty_difference"></td>
                            <td id="ptps_footer_production_value" data-ptps-footer="production_value"></td>
                            <td id="ptps_footer_transfer_value" data-ptps-footer="transfer_value"></td>
                            <td id="ptps_footer_value_difference" data-ptps-footer="value_difference"></td>
                            <td id="ptps_footer_productions_count" data-ptps-footer="productions_count"></td>
                            <td id="ptps_footer_transfers_count" data-ptps-footer="transfers_count"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    var ptpsUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, "productionTransferProductsSummary"]), false); ?>';
    var ptpsPrintUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, "printProductionTransferProductsSummary"]), false); ?>';
    var requestStartDate = <?php echo json_encode(request()->get('start_date'), 15, 512) ?>;
    var requestEndDate = <?php echo json_encode(request()->get('end_date'), 15, 512) ?>;
    var defaultStartDate = moment().subtract(1, 'month').startOf('month');
    var defaultEndDate = moment().subtract(1, 'month').endOf('month');
    var initialStartDate = parsePtpsDate(requestStartDate, defaultStartDate);
    var initialEndDate = parsePtpsDate(requestEndDate, defaultEndDate);

    function parsePtpsDate(value, fallback) {
        if (!value) {
            return fallback.clone();
        }

        var parsed = moment(value, ['YYYY-MM-DD', moment_date_format], true);
        return parsed.isValid() ? parsed : fallback.clone();
    }

    function setPtpsDateRangeText(start, end) {
        $('#ptps_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
    }

    function ptpsNumber(value) {
        var number = parseFloat(value);
        return isNaN(number) ? 0 : number;
    }

    function setPtpsFooterValues(values) {
        $.each(values, function (key, value) {
            $('[data-ptps-footer="' + key + '"]').text(value);
        });
    }

    $('#ptps_date_range').daterangepicker(
        $.extend({}, dateRangeSettings, { startDate: initialStartDate, endDate: initialEndDate }),
        function (start, end) {
            setPtpsDateRangeText(start, end);
            ptpsTable.ajax.reload();
        }
    );
    setPtpsDateRangeText(initialStartDate, initialEndDate);

    $('#ptps_date_range').on('cancel.daterangepicker', function () {
        $('#ptps_date_range').val('');
        ptpsTable.ajax.reload();
    });

    $('#ptps_category_id').on('change', function () {
        var catId = $(this).val();
        $('#ptps_sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');
        $('#ptps_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');

        if (!catId) {
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: catId },
            success: function (result) {
                $('#ptps_sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>' + result);
            }
        });
    });

    $('#ptps_sub_category_id').on('change', function () {
        var subId = $(this).val();
        $('#ptps_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');

        if (!subId) {
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: subId },
            success: function (result) {
                $('#ptps_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>' + result);
            }
        });
    });

    var ptpsTable = $('#ptps_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[6, 'desc']],
        ajax: {
            url: ptpsUrl,
            data: function (d) {
                d.start_date = getStartDate();
                d.end_date = getEndDate();
                d.location_id = $('#ptps_location_id').val();
                d.transfer_location_id = $('#ptps_transfer_location_id').val();
                d.status = $('#ptps_status').val();
                d.finalized = $('#ptps_finalized').val();
                d.category_id = $('#ptps_category_id').val();
                d.sub_category_id = $('#ptps_sub_category_id').val();
                d.sub2_category_id = $('#ptps_sub2_category_id').val();
            }
        },
        columns: [
            { data: 'product_name', name: 'product_name' },
            { data: 'sku', name: 'sku' },
            { data: 'category_name', name: 'category_name' },
            { data: 'unit_name', name: 'unit_name' },
            { data: 'produced_qty', name: 'produced_qty', className: 'text-end' },
            { data: 'transferred_qty', name: 'transferred_qty', className: 'text-end' },
            { data: 'qty_difference', name: 'qty_difference', className: 'text-end' },
            { data: 'production_value', name: 'production_value', className: 'text-end' },
            { data: 'transfer_value', name: 'transfer_value', className: 'text-end' },
            { data: 'value_difference', name: 'value_difference', className: 'text-end' },
            { data: 'productions_count', name: 'productions_count', className: 'text-end' },
            { data: 'transfers_count', name: 'transfers_count', className: 'text-end' },
        ],
        scrollX: true,
        language: { url: '/js/datatable-lang.json' },
        drawCallback: function () {
            __currency_convert_recursively($('#ptps_table'));
        }
    });

    $('#ptps_table').on('xhr.dt', function (e, settings, json) {
        var ft = (json && json.footer_totals) ? json.footer_totals : {};

        setPtpsFooterValues({
            produced_qty: __number_f(ptpsNumber(ft.produced_qty), false, false, __quantity_precision),
            transferred_qty: __number_f(ptpsNumber(ft.transferred_qty), false, false, __quantity_precision),
            qty_difference: __number_f(ptpsNumber(ft.qty_difference), false, false, __quantity_precision),
            production_value: __currency_trans_from_en(ptpsNumber(ft.production_value), false),
            transfer_value: __currency_trans_from_en(ptpsNumber(ft.transfer_value), false),
            value_difference: __currency_trans_from_en(ptpsNumber(ft.value_difference), false),
            productions_count: __number_f(ptpsNumber(ft.productions_count)),
            transfers_count: __number_f(ptpsNumber(ft.transfers_count))
        });
    });

    $('#ptps_location_id, #ptps_transfer_location_id, #ptps_status, #ptps_finalized, #ptps_category_id, #ptps_sub_category_id, #ptps_sub2_category_id').on('change', function () {
        ptpsTable.ajax.reload();
    });

    $('#ptps_print_report').on('click', function () {
        window.open(ptpsPrintUrl + '?' + $.param(getProductionTransferProductsSummaryPrintParams()), '_blank');
    });

    function getProductionTransferProductsSummaryPrintParams() {
        var params = {
            tab: 'all',
            start_date: getStartDate(),
            end_date: getEndDate(),
            location_id: $('#ptps_location_id').val(),
            transfer_location_id: $('#ptps_transfer_location_id').val(),
            status: $('#ptps_status').val(),
            finalized: $('#ptps_finalized').val(),
            category_id: $('#ptps_category_id').val(),
            sub_category_id: $('#ptps_sub_category_id').val(),
            sub2_category_id: $('#ptps_sub2_category_id').val()
        };

        $.each(params, function (key, value) {
            if (value === '' || value === null || typeof value === 'undefined') {
                delete params[key];
            }
        });

        return params;
    }

    function getStartDate() {
        var dp = $('#ptps_date_range').data('daterangepicker');
        if (!dp || !$('#ptps_date_range').val()) {
            return '';
        }

        return dp.startDate.format('YYYY-MM-DD');
    }

    function getEndDate() {
        var dp = $('#ptps_date_range').data('daterangepicker');
        if (!dp || !$('#ptps_date_range').val()) {
            return '';
        }

        return dp.endDate.format('YYYY-MM-DD');
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('manufacturing::lang.productions_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-industry me-2"></i><?php echo app('translator')->get('manufacturing::lang.productions_report'); ?></h1>
</section>

<section class="content">

    
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'open' => true]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_location_id', __('purchase.business_location').':'); ?>

                    <?php echo Form::select('pr_location_id', $business_locations, null,
                        ['class' => 'form-control select2', 'style' => 'width:100%',
                         'placeholder' => __('lang_v1.all'), 'id' => 'pr_location_id']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_date_range', __('report.date_range').':'); ?>

                    <?php echo Form::text('pr_date_range', null,
                        ['placeholder' => __('lang_v1.select_a_date_range'),
                         'class' => 'form-control', 'readonly', 'id' => 'pr_date_range']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_status_filter', __('manufacturing::lang.production_status').':'); ?>

                    <?php echo Form::select('pr_status_filter[]', $statuses, null,
                        ['class' => 'form-control select2', 'style' => 'width:100%',
                         'multiple', 'id' => 'pr_status_filter',
                         'data-placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_finalized', __('manufacturing::lang.finalize').':'); ?>

                    <?php echo Form::select('pr_finalized',
                        ['' => __('lang_v1.all'), '1' => __('manufacturing::lang.finalize'), '0' => __('lang_v1.draft')],
                        '1',
                        ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'pr_finalized']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_category_id', __('product.category').':'); ?>

                    <?php echo Form::select('pr_category_id', $categories, null,
                        ['class' => 'form-control select2', 'style' => 'width:100%',
                         'placeholder' => __('lang_v1.all'), 'id' => 'pr_category_id']); ?>

                    <small class="text-muted"><?php echo app('translator')->get('manufacturing::lang.raw_material_filter_hint'); ?></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_sub_category_id', __('product.sub_category').':'); ?>

                    <?php echo Form::select('pr_sub_category_id', [], null,
                        ['class' => 'form-control select2', 'style' => 'width:100%',
                         'placeholder' => __('lang_v1.all'), 'id' => 'pr_sub_category_id']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pr_sub2_category_id', __('product.sub2_category').':'); ?>

                    <?php echo Form::select('pr_sub2_category_id', [], null,
                        ['class' => 'form-control select2', 'style' => 'width:100%',
                         'placeholder' => __('lang_v1.all'), 'id' => 'pr_sub2_category_id']); ?>

                </div>
            </div>
            <div class="col-md-3 d-flex align-items-end justify-content-end">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="pr_generate_btn">
                        <i class="fa fa-sync-alt me-1"></i><?php echo app('translator')->get('manufacturing::lang.generate_report'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row mb-3 no-print">
        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-primary" id="pr_print_active_tab">
                <i class="fa fa-print"></i> Print A4 Current Tab
            </button>
            <button type="button" class="btn btn-default" id="pr_print_all_tabs">
                <i class="fa fa-print"></i> Print A4 All Tabs
            </button>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#pr_totals_tab" class="nav-link active pb-2 pe-2 ps-2" data-bs-toggle="tab">
                            <i class="fa fa-list me-1"></i><?php echo app('translator')->get('lang_v1.totals'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pr_summary_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab">
                            <i class="fa fa-table me-1"></i><?php echo app('translator')->get('manufacturing::lang.production_detail'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pr_detailed_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab">
                            <i class="fa fa-flask me-1"></i><?php echo app('translator')->get('manufacturing::lang.raw_materials_used'); ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    
                    <div class="tab-pane active" id="pr_totals_tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="pr_totals_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.total_productions'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.finalized'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.draft'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.labor_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.overhead_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.total_production_value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="totals_foot_prods" data-pr-footer="totals_prods"></td>
                                        <td id="totals_foot_fin" data-pr-footer="totals_fin"></td>
                                        <td id="totals_foot_draft" data-pr-footer="totals_draft"></td>
                                        <td id="totals_foot_labor" data-pr-footer="totals_labor"></td>
                                        <td id="totals_foot_overhead" data-pr-footer="totals_overhead"></td>
                                        <td id="totals_foot_value" data-pr-footer="totals_value"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane" id="pr_summary_tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin nowrap" id="pr_detail_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.business_location'); ?></th>
                                        <th><?php echo app('translator')->get('product.product'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.batch_number'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.production_status'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.priority'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.finalize'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.expected_quantity'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.actual_quantity'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.yield_efficiency'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.due_date'); ?></th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.labor_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.overhead_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="12"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="detail_foot_labor" data-pr-footer="detail_labor"></td>
                                        <td id="detail_foot_overhead" data-pr-footer="detail_overhead"></td>
                                        <td id="detail_foot_total" data-pr-footer="detail_total"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane" id="pr_detailed_tab">

                        
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="info-box shadow-sm">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-cubes"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo app('translator')->get('manufacturing::lang.total_ingredients_needed'); ?></span>
                                        <span class="info-box-number" id="raw_total_ingredients">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box shadow-sm">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-trash-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo app('translator')->get('manufacturing::lang.waste_units'); ?></span>
                                        <span class="info-box-number" id="raw_total_waste">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box shadow-sm">
                                    <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo app('translator')->get('manufacturing::lang.total_ingredient_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</span>
                                        <span class="info-box-number" id="raw_total_cost">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="pr_raw_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo app('translator')->get('manufacturing::lang.ingredient_name'); ?></th>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th><?php echo app('translator')->get('product.category'); ?></th>
                                        <th><?php echo app('translator')->get('product.unit'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_qty'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.waste_qty'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.net_qty'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.unit_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="5"><strong><?php echo app('translator')->get('manufacturing::lang.grand_total'); ?></strong></td>
                                        <td class="text-end" id="raw_foot_qty" data-pr-footer="raw_qty">0</td>
                                        <td class="text-end" id="raw_foot_waste" data-pr-footer="raw_waste">0</td>
                                        <td class="text-end" id="raw_foot_net" data-pr-footer="raw_net">0</td>
                                        <td></td>
                                        <td class="text-end" id="raw_foot_cost" data-pr-footer="raw_cost">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {

    var prUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, "index"]), false); ?>';
    var prPrintUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, "printProductionsReport"]), false); ?>';

    // ── Date Range (default: Today) ────────────────────────────────────────────
    var today = moment().startOf('day');
    $('#pr_date_range').daterangepicker(
        $.extend({}, dateRangeSettings, { startDate: today, endDate: today }),
        function (start, end) {
            reloadAll();
        }
    );
    $('#pr_date_range').on('cancel.daterangepicker', function () {
        reloadAll();
    });

    // ── Category cascade ──────────────────────────────────────────────────────
    $('#pr_category_id').on('change', function () {
        var cat_id = $(this).val();
        $('#pr_sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');
        $('#pr_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');
        if (!cat_id) return;
        $.ajax({
            method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: cat_id },
            success: function (result) {
                $('#pr_sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>' + result);
            }
        });
    });
    $('#pr_sub_category_id').on('change', function () {
        var sub_id = $(this).val();
        $('#pr_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');
        if (!sub_id) return;
        $.ajax({
            method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: sub_id },
            success: function (result) {
                $('#pr_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>' + result);
            }
        });
    });

    // ── Auto-reload on filter change (like STR) ───────────────────────────────
    $('#pr_location_id, #pr_status_filter, #pr_finalized').on('change', function () {
        reloadAll();
    });
    $('#pr_category_id, #pr_sub_category_id, #pr_sub2_category_id').on('change', function () {
        rawTable.ajax.reload();
    });

    // ── Generate button ───────────────────────────────────────────────────────
    $('#pr_generate_btn').on('click', function () {
        reloadAll();
    });

    $('#pr_print_active_tab').on('click', function () {
        openProductionReportPrint(getActiveProductionReportTab());
    });

    $('#pr_print_all_tabs').on('click', function () {
        openProductionReportPrint('all');
    });

    // ── Re-adjust column widths when scrollX tabs become visible ─────────────
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr('href');
        if (target === '#pr_summary_tab')  { detailTable.columns.adjust().draw(false); }
        if (target === '#pr_detailed_tab') { rawTable.columns.adjust().draw(false); }
    });

    function reloadAll() {
        totalsTable.ajax.reload();
        detailTable.ajax.reload();
        rawTable.ajax.reload();
    }

    function toReportNumber(value) {
        var number = parseFloat(value);
        return isNaN(number) ? 0 : number;
    }

    function setFooterValues(values) {
        $.each(values, function (key, value) {
            $('[data-pr-footer="' + key + '"]').text(value);
        });
    }

    function openProductionReportPrint(tab) {
        var params = getProductionReportPrintParams(tab);
        window.open(prPrintUrl + '?' + $.param(params), '_blank');
    }

    function getActiveProductionReportTab() {
        var activeTarget = $('.nav-tabs-custom .nav-tabs a.nav-link.active[data-bs-toggle="tab"]').attr('href');

        if (activeTarget === '#pr_summary_tab') {
            return 'detail';
        }

        if (activeTarget === '#pr_detailed_tab') {
            return 'raw_materials';
        }

        return 'totals';
    }

    function getProductionReportPrintParams(tab) {
        var params = {
            tab: tab || getActiveProductionReportTab(),
            start_date: getStartDate(),
            end_date: getEndDate(),
            location_id: $('#pr_location_id').val(),
            status_filter: $('#pr_status_filter').val() || [],
            finalized: $('#pr_finalized').val(),
            category_id: $('#pr_category_id').val(),
            sub_category_id: $('#pr_sub_category_id').val(),
            sub2_category_id: $('#pr_sub2_category_id').val()
        };

        $.each(params, function (key, value) {
            if (value === '' || value === null || typeof value === 'undefined' || (Array.isArray(value) && value.length === 0)) {
                delete params[key];
            }
        });

        return params;
    }

    // =========================================================================
    //  TAB 1 – TOTALS DataTable
    // =========================================================================
    var totalsTable = $('#pr_totals_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        ajax: {
            url: prUrl,
            data: function (d) {
                d.action        = 'totals';
                d.start_date    = getStartDate();
                d.end_date      = getEndDate();
                d.location_id   = $('#pr_location_id').val();
                d.status_filter = $('#pr_status_filter').val() || [];
                d.finalized     = $('#pr_finalized').val();
            }
        },
        columns: [
            { data: 'date',             name: 'date' },
            { data: 'productions_count',name: 'productions_count', className: 'text-end' },
            { data: 'finalized_count',  name: 'finalized_count',  className: 'text-end' },
            { data: 'draft_count',      name: 'draft_count',      className: 'text-end' },
            { data: 'labor_cost',       name: 'labor_cost',       className: 'text-end', orderable: false },
            { data: 'overhead_cost',    name: 'overhead_cost',    className: 'text-end', orderable: false },
            { data: 'total_value',      name: 'total_value',      className: 'text-end', orderable: false },
        ],
        language: { url: '/js/datatable-lang.json' },
        drawCallback: function () {
            __currency_convert_recursively($('#pr_totals_table'));
        }
    });

    // Footer totals for Totals tab (from server via xhr)
    $('#pr_totals_table').on('xhr.dt', function (e, settings, json) {
        var ft = (json && json.footer_totals) ? json.footer_totals : {};
        setFooterValues({
            totals_prods: toReportNumber(ft.total_productions),
            totals_fin: toReportNumber(ft.total_finalized),
            totals_draft: toReportNumber(ft.total_draft),
            totals_labor: __currency_trans_from_en(toReportNumber(ft.total_labor), false),
            totals_overhead: __currency_trans_from_en(toReportNumber(ft.total_overhead), false),
            totals_value: __currency_trans_from_en(toReportNumber(ft.total_value), false)
        });
    });

    // =========================================================================
    //  TAB 2 – SUMMARY DETAILS DataTable
    // =========================================================================
    var detailTable = $('#pr_detail_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: prUrl,
            data: function (d) {
                d.action        = 'detail';
                d.start_date    = getStartDate();
                d.end_date      = getEndDate();
                d.location_id   = $('#pr_location_id').val();
                d.status_filter = $('#pr_status_filter').val() || [];
                d.finalized     = $('#pr_finalized').val();
            }
        },
        columns: [
            { data: 'ref_no',               name: 'transactions.ref_no' },
            { data: 'transaction_date',     name: 'transactions.transaction_date' },
            { data: 'location_name',        name: 'bl.name' },
            { data: 'product_name',         name: 'product_name', orderable: false },
            { data: 'mfg_batch_number',     name: 'transactions.mfg_batch_number', defaultContent: '—' },
            { data: 'mfg_production_status',name: 'transactions.mfg_production_status' },
            { data: 'mfg_priority',         name: 'transactions.mfg_priority' },
            { data: 'mfg_is_final',         name: 'transactions.mfg_is_final' },
            { data: 'mfg_expected_quantity',name: 'transactions.mfg_expected_quantity', className: 'text-end', defaultContent: '—',
              render: function(d) { return d ? __number_f(parseFloat(d), false, false, __quantity_precision) : '—'; } },
            { data: 'mfg_actual_quantity',  name: 'transactions.mfg_actual_quantity',  className: 'text-end', defaultContent: '—',
              render: function(d) { return d ? __number_f(parseFloat(d), false, false, __quantity_precision) : '—'; } },
            { data: 'yield_efficiency',     name: 'yield_efficiency', className: 'text-end', orderable: false, searchable: false },
            { data: 'mfg_due_date',         name: 'transactions.mfg_due_date' },
            { data: 'mfg_labor_cost',       name: 'transactions.mfg_labor_cost',    className: 'text-end' },
            { data: 'mfg_overhead_cost',    name: 'transactions.mfg_overhead_cost', className: 'text-end' },
            { data: 'final_total',          name: 'transactions.final_total',       className: 'text-end' },
            { data: 'action',               name: 'action', orderable: false, searchable: false },
        ],
        order: [[1, 'desc']],
        scrollX: true,
        language: { url: '/js/datatable-lang.json' },
        drawCallback: function () {
            __currency_convert_recursively($('#pr_detail_table'));
        }
    });

    // Footer totals for Detail tab (from server via xhr)
    $('#pr_detail_table').on('xhr.dt', function (e, settings, json) {
        var ft = (json && json.footer_totals) ? json.footer_totals : {};
        setFooterValues({
            detail_labor: __currency_trans_from_en(toReportNumber(ft.total_labor), false),
            detail_overhead: __currency_trans_from_en(toReportNumber(ft.total_overhead), false),
            detail_total: __currency_trans_from_en(toReportNumber(ft.total_value), false)
        });
    });

    // =========================================================================
    //  TAB 3 – RAW MATERIALS DataTable
    // =========================================================================
    var rawTable = $('#pr_raw_table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: prUrl,
            type: 'GET',
            data: function () {
                return {
                    action:           'raw_materials',
                    start_date:       getStartDate(),
                    end_date:         getEndDate(),
                    location_id:      $('#pr_location_id').val(),
                    status_filter:    $('#pr_status_filter').val() || [],
                    finalized:        $('#pr_finalized').val(),
                    category_id:      $('#pr_category_id').val(),
                    sub_category_id:  $('#pr_sub_category_id').val(),
                    sub2_category_id: $('#pr_sub2_category_id').val(),
                };
            },
            dataSrc: 'rows'
        },
        columns: [
            { data: null, orderable: false, searchable: false,
              render: function (d, t, r, m) { return m.row + 1; } },
            { data: 'ingredient_name',
              render: function (d) { return '<strong>' + d + '</strong>'; } },
            { data: 'sku',
              render: function (d) { return '<code class="text-danger">' + d + '</code>'; } },
            { data: 'category_name' },
            { data: 'unit_name' },
            { data: 'total_qty', className: 'text-end',
              render: function (d) { return __number_f(parseFloat(d), false, false, __quantity_precision); } },
            { data: 'total_waste_qty', className: 'text-end text-danger',
              render: function (d) { return __number_f(parseFloat(d), false, false, __quantity_precision); } },
            { data: null, className: 'text-end text-success fw-semibold', orderable: false,
              render: function (d, t, r) {
                  return __number_f(parseFloat(r.total_qty) - parseFloat(r.total_waste_qty), false, false, __quantity_precision);
              } },
            { data: 'unit_cost', className: 'text-end',
              render: function (d) { return __currency_trans_from_en(parseFloat(d), false); } },
            { data: 'total_cost', className: 'text-end fw-semibold',
              render: function (d) { return __currency_trans_from_en(parseFloat(d), false); } },
        ],
        order: [[1, 'asc']],
        scrollX: true,
        language: { url: '/js/datatable-lang.json' },
    });

    // Footer totals & info boxes for Raw Materials tab
    $('#pr_raw_table').on('xhr.dt', function (e, settings, json) {
        var t = (json && json.totals) ? json.totals : {};
        var total_qty = toReportNumber(t.total_qty);
        var total_waste_qty = toReportNumber(t.total_waste_qty);
        var total_cost = toReportNumber(t.total_cost);
        var net_total = total_qty - total_waste_qty;

        setFooterValues({
            raw_qty: __number_f(total_qty, false, false, __quantity_precision),
            raw_waste: __number_f(total_waste_qty, false, false, __quantity_precision),
            raw_net: __number_f(net_total, false, false, __quantity_precision),
            raw_cost: __currency_trans_from_en(total_cost, false)
        });

        $('#raw_total_waste').text(__number_f(total_waste_qty, false, false, __quantity_precision));
        $('#raw_total_cost').text(__currency_trans_from_en(total_cost, false));
        $('#raw_total_ingredients').text((json && json.rows) ? json.rows.length : 0);
    });

    // ── Helpers ───────────────────────────────────────────────────────────────
    function getStartDate() {
        var dp = $('#pr_date_range').data('daterangepicker');
        if (!dp || !$('#pr_date_range').val()) return '';
        return dp.startDate.format('YYYY-MM-DD');
    }
    function getEndDate() {
        var dp = $('#pr_date_range').data('daterangepicker');
        if (!dp || !$('#pr_date_range').val()) return '';
        return dp.endDate.format('YYYY-MM-DD');
    }

    // DataTables perform their initial AJAX load during initialization.
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
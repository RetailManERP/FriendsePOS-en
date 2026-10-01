
<?php $__env->startSection('title', __('importmanagement::lang.import_reports')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('importmanagement::lang.import_reports'); ?>
        <small><?php echo app('translator')->get('importmanagement::lang.import_reports_desc'); ?></small>
    </h1>
</section>

<section class="content">

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_location_id', __('importmanagement::lang.business_location') . ':'); ?>

                    <?php echo Form::select('report_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_supplier_id', __('importmanagement::lang.supplier_importer') . ':'); ?>

                    <?php echo Form::select('report_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_date_range', __('importmanagement::lang.date_range') . ':'); ?>

                    <?php echo Form::text('report_date_range', null, ['class' => 'form-control daterange-filter', 'placeholder' => __('importmanagement::lang.select_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_status', __('importmanagement::lang.import_status') . ':'); ?>

                    <?php echo Form::select('report_status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-primary" id="apply_report_filter">
                    <i class="fa fa-filter"></i> <?php echo app('translator')->get('importmanagement::lang.apply_filter'); ?>
                </button>
                <button type="button" class="btn btn-default" id="clear_report_filter">
                    <i class="fa fa-eraser"></i> <?php echo app('translator')->get('importmanagement::lang.clear_filter'); ?>
                </button>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <div class="row" id="report_summary_cards">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="total_imports_count">0</h3>
                    <p><?php echo app('translator')->get('importmanagement::lang.total_imports'); ?></p>
                </div>
                <div class="icon"><i class="fa fa-ship"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="total_items_cost_base_sum"><span class="display_currency" data-currency_symbol="true">0</span></h3>
                    <p><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?></p>
                </div>
                <div class="icon"><i class="fa fa-money-bill-wave"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="total_charges_sum"><span class="display_currency" data-currency_symbol="true">0</span></h3>
                    <p><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?></p>
                </div>
                <div class="icon"><i class="fa fa-truck"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="total_landed_cost_sum"><span class="display_currency" data-currency_symbol="true">0</span></h3>
                    <p><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></p>
                </div>
                <div class="icon"><i class="fa fa-calculator"></i></div>
            </div>
        </div>
    </div>

    
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_landed_cost" data-toggle="tab"><?php echo app('translator')->get('importmanagement::lang.landed_cost_analysis'); ?></a></li>
            <li><a href="#tab_charges_breakdown" data-toggle="tab"><?php echo app('translator')->get('importmanagement::lang.charges_breakdown'); ?></a></li>
            <li><a href="#tab_monthly_trend" data-toggle="tab"><?php echo app('translator')->get('importmanagement::lang.monthly_trend'); ?></a></li>
            <li><a href="#tab_top_suppliers" data-toggle="tab"><?php echo app('translator')->get('importmanagement::lang.top_suppliers'); ?></a></li>
        </ul>
        <div class="tab-content">

            
            <div class="tab-pane active" id="tab_landed_cost">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="landed_cost_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('importmanagement::lang.import_ref_no'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.product'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.quantity'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.unit_price_base'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.allocated_charges'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.landed_cost_per_unit'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_percentage'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="landed_cost_tbody">
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="tab-pane" id="tab_charges_breakdown">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="charges_breakdown_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('importmanagement::lang.charge_category'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.total_amount'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.charge_percentage'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.count'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="charges_breakdown_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <canvas id="charges_pie_chart" height="300"></canvas>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane" id="tab_monthly_trend">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="monthly_trend_chart" height="300"></canvas>
                    </div>
                </div>
                <div class="row mt-15">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="monthly_trend_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('importmanagement::lang.month'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.total_imports'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></th>
                                        <th><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="monthly_trend_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane" id="tab_top_suppliers">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="top_suppliers_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->get('importmanagement::lang.supplier_importer'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.total_imports'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="top_suppliers_tbody">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/chart.umd.min.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function() {
    var chargesChart = null;
    var trendChart = null;

    // Initialize daterange picker
    if ($.fn.daterangepicker) {
        $('.daterange-filter').daterangepicker({
            autoUpdateInput: false,
            locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
        });
        $('.daterange-filter').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $('.daterange-filter').on('cancel.daterangepicker', function() {
            $(this).val('');
        });
    }

    function getFilterParams() {
        return {
            location_id: $('#report_location_id').val(),
            supplier_id: $('#report_supplier_id').val(),
            date_range: $('#report_date_range').val(),
            status: $('#report_status').val(),
        };
    }

    function loadReportData() {
        var params = getFilterParams();

        $.ajax({
            url: "<?php echo e(route('import-management.reports.get-data'), false); ?>",
            data: params,
            success: function(data) {
                // Summary cards
                $('#total_imports_count').text(data.summary.total_imports || 0);
                $('#total_items_cost_base_sum').html('<span class="display_currency" data-currency_symbol="true">' + (data.summary.total_items_cost_base || 0) + '</span>');
                $('#total_charges_sum').html('<span class="display_currency" data-currency_symbol="true">' + (data.summary.total_charges || 0) + '</span>');
                $('#total_landed_cost_sum').html('<span class="display_currency" data-currency_symbol="true">' + (data.summary.total_landed_cost || 0) + '</span>');

                // Landed cost analysis
                var landed_html = '';
                if (data.landed_cost && data.landed_cost.length) {
                    $.each(data.landed_cost, function(i, row) {
                        var pct = row.unit_price_base > 0 ? ((row.allocated_charges / row.unit_price_base) * 100).toFixed(1) : 0;
                        landed_html += '<tr>' +
                            '<td>' + row.import_ref_no + '</td>' +
                            '<td>' + row.product_name + '</td>' +
                            '<td>' + row.quantity + '</td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.unit_price_base + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.allocated_charges + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.landed_cost_per_unit + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_landed_cost + '</span></td>' +
                            '<td>' + pct + '%</td>' +
                            '</tr>';
                    });
                } else {
                    landed_html = '<tr><td colspan="8" class="text-center text-muted">No data available</td></tr>';
                }
                $('#landed_cost_tbody').html(landed_html);

                // Charges breakdown
                var charges_html = '';
                var chart_labels = [];
                var chart_data = [];
                var chart_colors = ['#3c8dbc', '#f39c12', '#00a65a', '#dd4b39', '#605ca8', '#00c0ef', '#d2d6de', '#39cccc', '#3d9970', '#f012be'];
                if (data.charges_breakdown && data.charges_breakdown.length) {
                    var total_charges = 0;
                    $.each(data.charges_breakdown, function(i, row) { total_charges += parseFloat(row.total_amount); });
                    $.each(data.charges_breakdown, function(i, row) {
                        var pct = total_charges > 0 ? ((row.total_amount / total_charges) * 100).toFixed(1) : 0;
                        charges_html += '<tr>' +
                            '<td>' + row.charge_category + '</td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_amount + '</span></td>' +
                            '<td>' + pct + '%</td>' +
                            '<td>' + row.count + '</td>' +
                            '</tr>';
                        chart_labels.push(row.charge_category);
                        chart_data.push(row.total_amount);
                    });
                }
                $('#charges_breakdown_tbody').html(charges_html || '<tr><td colspan="4" class="text-center text-muted">No data</td></tr>');

                // Charges pie chart
                if (chargesChart) chargesChart.destroy();
                if (chart_data.length > 0) {
                    var ctx = document.getElementById('charges_pie_chart').getContext('2d');
                    chargesChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: chart_labels,
                            datasets: [{
                                data: chart_data,
                                backgroundColor: chart_colors.slice(0, chart_data.length)
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { position: 'bottom' } }
                        }
                    });
                }

                // Monthly trend
                var trend_html = '';
                var trend_labels = [];
                var trend_cost_data = [];
                var trend_charges_data = [];
                var trend_total_data = [];
                if (data.monthly_trend && data.monthly_trend.length) {
                    $.each(data.monthly_trend, function(i, row) {
                        trend_html += '<tr>' +
                            '<td>' + row.month + '</td>' +
                            '<td>' + row.count + '</td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_items_cost_base + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_charges + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_landed_cost + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.final_total + '</span></td>' +
                            '</tr>';
                        trend_labels.push(row.month);
                        trend_cost_data.push(row.total_items_cost_base);
                        trend_charges_data.push(row.total_charges);
                        trend_total_data.push(row.final_total);
                    });
                }
                $('#monthly_trend_tbody').html(trend_html || '<tr><td colspan="6" class="text-center text-muted">No data</td></tr>');

                // Monthly trend chart
                if (trendChart) trendChart.destroy();
                if (trend_labels.length > 0) {
                    var ctx2 = document.getElementById('monthly_trend_chart').getContext('2d');
                    trendChart = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: trend_labels,
                            datasets: [
                                { label: '<?php echo app('translator')->get("importmanagement::lang.total_items_cost_base"); ?>', data: trend_cost_data, backgroundColor: '#3c8dbc' },
                                { label: '<?php echo app('translator')->get("importmanagement::lang.total_charges"); ?>', data: trend_charges_data, backgroundColor: '#f39c12' },
                                { label: '<?php echo app('translator')->get("importmanagement::lang.grand_total"); ?>', data: trend_total_data, type: 'line', borderColor: '#dd4b39', fill: false }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { position: 'bottom' } },
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                }

                // Top suppliers
                var suppliers_html = '';
                if (data.top_suppliers && data.top_suppliers.length) {
                    $.each(data.top_suppliers, function(i, row) {
                        suppliers_html += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + row.supplier_name + '</td>' +
                            '<td>' + row.total_imports + '</td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_items_cost_base + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_charges + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.total_landed_cost + '</span></td>' +
                            '<td><span class="display_currency" data-currency_symbol="true">' + row.final_total + '</span></td>' +
                            '</tr>';
                    });
                }
                $('#top_suppliers_tbody').html(suppliers_html || '<tr><td colspan="7" class="text-center text-muted">No data</td></tr>');

                // Re-init currency formatting
                __currency_convert_recursively($('#report_summary_cards'));
                __currency_convert_recursively($('.tab-content'));
            }
        });
    }

    // Load on page load
    loadReportData();

    // Filter actions
    $('#apply_report_filter').on('click', function() {
        loadReportData();
    });

    $('#clear_report_filter').on('click', function() {
        $('#report_location_id, #report_supplier_id, #report_status').val('').trigger('change');
        $('#report_date_range').val('');
        loadReportData();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('title', __('rental::lang.rental_reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.rental_reports')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_type', __('rental::lang.report_type') . ':*'); ?>

                    <?php echo Form::select('report_type', [
                        'revenue' => __('rental::lang.revenue_report'),
                        'items' => __('rental::lang.items_report'),
                        'agreements' => __('rental::lang.agreements_report'),
                        'overdue' => __('rental::lang.overdue_report'),
                        'utilization' => __('rental::lang.utilization_report'),
                    ], request('report_type', 'revenue'), ['class' => 'form-control select2', 'id' => 'report_type', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_location', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('report_location', ['' => __('rental::lang.all')] + $business_locations->toArray(), null, ['class' => 'form-control select2', 'id' => 'report_location', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('report_date_range', null, ['class' => 'form-control daterange', 'id' => 'report_date_range', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-top:25px;">
                    <button type="button" class="btn btn-primary" id="generate_report">
                        <i class="fas fa-sync"></i> <?php echo app('translator')->get('rental::lang.generate_report'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <div id="report_results">
        <?php if(isset($report_data)): ?>
            
            <?php if($report_type == 'revenue'): ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fas fa-money-bill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_revenue'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_revenue'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fas fa-file-contract"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_agreements'); ?></span>
                            <span class="info-box-number"><?php echo e($report_data['total_agreements'] ?? 0, false); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_late_fees'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_late_fees'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-triangle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_damage_fees'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_damage_fees'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if(in_array($report_type, ['items', 'agreements', 'overdue', 'utilization'])): ?>
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.' . $report_type . '_report')]); ?>
                <table class="table table-bordered table-striped" id="report_data_table">
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $report_data['columns'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($col, false); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $report_data['rows'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo $cell; ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="callout callout-info">
                <p><i class="fas fa-info-circle"></i> <?php echo app('translator')->get('rental::lang.select_report_type_and_generate'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#report_date_range').daterangepicker(dateRangeSettings);

        function escapeHtml(value) {
            return $('<div>').text(value == null ? '' : value).html();
        }

        function money(value) {
            return Number(value || 0).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function table(headers, rows) {
            var html = '<div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr>';
            headers.forEach(function(header) { html += '<th>' + escapeHtml(header) + '</th>'; });
            html += '</tr></thead><tbody>';
            if (!rows.length) {
                html += '<tr><td colspan="' + headers.length + '" class="text-center">No data available</td></tr>';
            } else {
                rows.forEach(function(row) {
                    html += '<tr>';
                    row.forEach(function(cell) { html += '<td>' + escapeHtml(cell) + '</td>'; });
                    html += '</tr>';
                });
            }
            return html + '</tbody></table></div>';
        }

        function renderReport(type, data) {
            var html = '';
            if (type === 'revenue') {
                var summary = data.summary || {};
                html += '<div class="row">';
                [
                    ['Rental income', summary.total_rental_income],
                    ['Deposits collected', summary.total_deposits_collected],
                    ['Deposits refunded', summary.total_deposits_refunded],
                    ['Net revenue', summary.net_revenue]
                ].forEach(function(card) {
                    html += '<div class="col-md-3"><div class="info-box"><div class="info-box-content"><span class="info-box-text">' +
                        escapeHtml(card[0]) + '</span><span class="info-box-number">' + money(card[1]) + '</span></div></div></div>';
                });
                html += '</div>';
                html += table(['Date', 'Revenue'], (data.trend || []).map(function(row) {
                    return [row.date, money(row.total)];
                }));
            } else if (type === 'items') {
                html = table(['Rental item', 'SKU', 'Rentals', 'Revenue', 'Average duration'], (data.items || []).map(function(item) {
                    return [item.name, item.rental_sku, item.total_rentals, money(item.total_revenue), item.avg_duration || 0];
                }));
            } else if (type === 'agreements') {
                var statuses = data.by_status || {};
                var statusRows = Object.keys(statuses).map(function(status) { return [status, statuses[status]]; });
                html += '<div class="row"><div class="col-md-3"><div class="info-box"><div class="info-box-content"><span class="info-box-text">Agreements</span><span class="info-box-number">' +
                    escapeHtml(data.total) + '</span></div></div></div><div class="col-md-3"><div class="info-box"><div class="info-box-content"><span class="info-box-text">Total value</span><span class="info-box-number">' +
                    money(data.total_value) + '</span></div></div></div><div class="col-md-3"><div class="info-box"><div class="info-box-content"><span class="info-box-text">Average value</span><span class="info-box-number">' +
                    money(data.avg_value) + '</span></div></div></div></div>';
                html += table(['Status', 'Count'], statusRows);
            } else if (type === 'overdue') {
                html = '<p><strong>Overdue agreements:</strong> ' + escapeHtml(data.total_count) +
                    ' &nbsp; <strong>Overdue value:</strong> ' + money(data.total_overdue_value) +
                    ' &nbsp; <strong>Potential late fees:</strong> ' + money(data.total_potential_late_fees) + '</p>';
                html += table(['Agreement', 'Customer', 'Due date', 'Balance'], (data.agreements || []).map(function(agreement) {
                    return [agreement.agreement_no, agreement.contact ? agreement.contact.name : '', agreement.rental_end_expected, money(agreement.balance_due)];
                }));
            } else if (type === 'utilization') {
                html = '<p><strong>Average utilization:</strong> ' + escapeHtml(data.avg_utilization) + '%</p>';
                html += table(['Rental item', 'Total quantity', 'Available quantity', 'Rental count', 'Utilization'], (data.items || []).map(function(item) {
                    return [item.item_name, item.total_quantity, item.available_quantity, item.rental_count, item.utilization_rate + '%'];
                }));
            }
            $('#report_results').html(html);
        }

        function generateReport() {
            var range = $('#report_date_range').data('daterangepicker');
            var params = {
                report_type: $('#report_type').val(),
                location_id: $('#report_location').val(),
                start_date: range ? range.startDate.format('YYYY-MM-DD') : '',
                end_date: range ? range.endDate.format('YYYY-MM-DD') : ''
            };
            $('#report_results').html('<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading report...</p>');
            $.get('<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReportController::class, "getData"]), false); ?>', params)
                .done(function(data) { renderReport(params.report_type, data); })
                .fail(function() {
                    $('#report_results').html('<div class="callout callout-danger">Unable to load the report. Please try again.</div>');
                });
        }

        $('#generate_report').on('click', generateReport);
        generateReport();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
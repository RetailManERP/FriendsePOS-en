

<?php $__env->startSection('title', __('clinic::lang.reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('clinic::lang.reports'); ?>
        <small><?php echo app('translator')->get('clinic::lang.clinic_reports'); ?></small>
    </h1>
</section>

<section class="content">
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('report.filters')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_date_range', __('report.date_range') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <?php echo Form::text('report_date_range', null, ['class' => 'form-control', 'id' => 'report_date_range', 'placeholder' => __('report.date_range'), 'readonly']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_doctor', __('clinic::lang.doctor') . ':'); ?>

                    <?php echo Form::select('report_doctor', $doctors, null, ['class' => 'form-control select2', 'id' => 'report_doctor', 'placeholder' => __('messages.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_type', __('clinic::lang.report_type') . ':'); ?>

                    <?php echo Form::select('report_type', [
                        'summary' => __('clinic::lang.summary_report'),
                        'appointments' => __('clinic::lang.appointment_report'),
                        'revenue' => __('clinic::lang.revenue_report'),
                        'patients' => __('clinic::lang.patient_report'),
                        'doctors' => __('clinic::lang.doctor_report'),
                    ], 'summary', ['class' => 'form-control', 'id' => 'report_type']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-top: 25px;">
                    <button type="button" class="btn btn-primary" id="generate_report">
                        <i class="fas fa-search"></i> <?php echo app('translator')->get('clinic::lang.generate_report'); ?>
                    </button>
                    <button type="button" class="btn btn-info" id="export_report">
                        <i class="fas fa-file-excel"></i> <?php echo app('translator')->get('messages.export'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <div class="row" id="summary_stats">
        <div class="col-md-3">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="text-center">
                    <h4 class="text-muted"><?php echo app('translator')->get('clinic::lang.total_patients'); ?></h4>
                    <h2 class="text-primary" id="stat_patients"><?php echo e($stats['total_patients'] ?? 0, false); ?></h2>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> <?php echo e($stats['new_patients'] ?? 0, false); ?> <?php echo app('translator')->get('clinic::lang.new'); ?>
                    </small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
                <div class="text-center">
                    <h4 class="text-muted"><?php echo app('translator')->get('clinic::lang.total_appointments'); ?></h4>
                    <h2 class="text-success" id="stat_appointments"><?php echo e($stats['total_appointments'] ?? 0, false); ?></h2>
                    <small>
                        <span class="text-success"><?php echo e($stats['completed_appointments'] ?? 0, false); ?> <?php echo app('translator')->get('clinic::lang.completed'); ?></span> |
                        <span class="text-warning"><?php echo e($stats['pending_appointments'] ?? 0, false); ?> <?php echo app('translator')->get('clinic::lang.pending'); ?></span>
                    </small>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info']); ?>
                <div class="text-center">
                    <h4 class="text-muted"><?php echo app('translator')->get('clinic::lang.total_consultations'); ?></h4>
                    <h2 class="text-info" id="stat_consultations"><?php echo e($stats['total_consultations'] ?? 0, false); ?></h2>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                <div class="text-center">
                    <h4 class="text-muted"><?php echo app('translator')->get('clinic::lang.total_revenue'); ?></h4>
                    <h2 class="text-warning" id="stat_revenue">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($stats['total_revenue'] ?? 0, false); ?></span>
                    </h2>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('clinic::lang.appointments_trend')]); ?>
                <div id="appointments_chart" style="height: 350px;"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('clinic::lang.appointment_status_breakdown')]); ?>
                <div id="status_chart" style="height: 350px;"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('clinic::lang.top_doctors')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.consultations'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.revenue'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.avg_rating'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $top_doctors ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($doc->first_name, false); ?> <?php echo e($doc->last_name, false); ?></td>
                                    <td><?php echo e($doc->consultations_count, false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($doc->total_revenue, false); ?></span></td>
                                    <td>
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?php echo e($i <= round($doc->avg_rating ?? 0) ? 'text-warning' : 'text-muted', false); ?>"></i>
                                        <?php endfor; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="4" class="text-center"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('clinic::lang.popular_specializations')]); ?>
                <div id="specialization_chart" style="height: 300px;"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('clinic::lang.detailed_report')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="report_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.type'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.amount'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Date range picker
        if ($.fn.daterangepicker) {
            $('#report_date_range').daterangepicker({
                ranges: {
                    "<?php echo app('translator')->get('home.today'); ?>": [moment(), moment()],
                    "<?php echo app('translator')->get('home.this_week'); ?>": [moment().startOf('week'), moment().endOf('week')],
                    "<?php echo app('translator')->get('home.this_month'); ?>": [moment().startOf('month'), moment().endOf('month')],
                    "<?php echo app('translator')->get('home.this_year'); ?>": [moment().startOf('year'), moment().endOf('year')],
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: { format: 'YYYY-MM-DD' }
            });
        }

        // DataTable
        var report_table = $('#report_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\ReportController::class, 'getData']), false); ?>",
                data: function(d) {
                    d.date_range = $('#report_date_range').val();
                    d.doctor_id = $('#report_doctor').val();
                    d.report_type = $('#report_type').val();
                }
            },
            columns: [
                { data: 'date', name: 'date' },
                { data: 'patient', name: 'patient' },
                { data: 'doctor', name: 'doctor' },
                { data: 'type', name: 'type' },
                { data: 'status', name: 'status' },
                { data: 'amount', name: 'amount' }
            ],
            order: [[0, 'desc']]
        });

        // Generate Report
        $('#generate_report').on('click', function() {
            report_table.ajax.reload();
            loadCharts();
        });

        // Export Report
        $('#export_report').on('click', function() {
            var params = $.param({
                date_range: $('#report_date_range').val(),
                doctor_id: $('#report_doctor').val(),
                report_type: $('#report_type').val()
            });
            window.location.href = "<?php echo e(action([\Modules\Clinic\Http\Controllers\ReportController::class, 'export']), false); ?>?" + params;
        });

        // Load Charts
        function loadCharts() {
            $.ajax({
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\ReportController::class, 'chartData']), false); ?>",
                data: {
                    date_range: $('#report_date_range').val(),
                    doctor_id: $('#report_doctor').val()
                },
                success: function(data) {
                    // Appointments Trend
                    if (typeof Highcharts !== 'undefined') {
                        Highcharts.chart('appointments_chart', {
                            chart: { type: 'area' },
                            title: { text: null },
                            xAxis: { categories: data.trend_labels },
                            yAxis: { title: { text: "<?php echo app('translator')->get('clinic::lang.count'); ?>" } },
                            series: [{
                                name: "<?php echo app('translator')->get('clinic::lang.appointments'); ?>",
                                data: data.trend_appointments,
                                color: '#4caf50'
                            }, {
                                name: "<?php echo app('translator')->get('clinic::lang.consultations'); ?>",
                                data: data.trend_consultations,
                                color: '#2196f3'
                            }],
                            credits: { enabled: false }
                        });

                        // Status Breakdown
                        Highcharts.chart('status_chart', {
                            chart: { type: 'pie' },
                            title: { text: null },
                            series: [{
                                name: "<?php echo app('translator')->get('clinic::lang.appointments'); ?>",
                                data: data.status_breakdown
                            }],
                            credits: { enabled: false }
                        });

                        // Specialization Chart
                        Highcharts.chart('specialization_chart', {
                            chart: { type: 'bar' },
                            title: { text: null },
                            xAxis: { categories: data.spec_labels },
                            yAxis: { title: { text: "<?php echo app('translator')->get('clinic::lang.patients'); ?>" } },
                            series: [{
                                name: "<?php echo app('translator')->get('clinic::lang.patients'); ?>",
                                data: data.spec_data,
                                color: '#ff9800'
                            }],
                            credits: { enabled: false }
                        });
                    }
                }
            });
        }

        // Initial load
        loadCharts();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
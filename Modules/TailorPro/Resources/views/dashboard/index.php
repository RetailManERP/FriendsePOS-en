
<?php $__env->startSection('title', __('lang_v1.dashboard')); ?>
<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header -->
<section class="content-header no-print">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="margin-bottom:1rem;">
        <h1>
            <i class="fas fa-cut" style="color:#6f42c1;"></i>
            <?php if(!empty($custom_labels['tailorpro_label'])): ?>
                <?php echo e($custom_labels['tailorpro_label'] . ' ', false); ?><?php echo app('translator')->get('tailorpro::lang.tailoring_management'); ?>
            <?php else: ?>
                <?php echo app('translator')->get('tailorpro::lang.tailorpro_tailoring_management'); ?>
            <?php endif; ?>
            <small><?php echo app('translator')->get('business.dashboard'); ?></small>
        </h1>
        <div class="d-flex gap-2" style="gap:0.5rem;">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.create')): ?>
            <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_order'); ?>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_measurement.create')): ?>
            <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, 'create']), false); ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-ruler-combined"></i> <?php echo app('translator')->get('tailorpro::lang.add_measurement'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content no-print">

    <!-- KPI Summary Stats -->
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-purple" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-clipboard-list"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.orders_today'); ?></span>
                    <span class="info-box-number"><?php echo e($dashboard_stats['orders_today'], false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-green" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-check-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.completed_today'); ?></span>
                    <span class="info-box-number"><?php echo e($dashboard_stats['completed_today'], false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-yellow" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-truck-loading"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.pending_delivery'); ?></span>
                    <span class="info-box-number"><?php echo e($dashboard_stats['pending_delivery'], false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-red" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.overdue_orders'); ?></span>
                    <span class="info-box-number" style="<?php echo e($dashboard_stats['overdue_count'] > 0 ? 'color:#dc3545;font-weight:bold;' : '', false); ?>"><?php echo e($dashboard_stats['overdue_count'], false); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Stats -->
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-aqua" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-tshirt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.total_orders'); ?></span>
                    <span class="info-box-number"><?php echo e($dashboard_stats['total_orders'], false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon" style="background:#6f42c1;color:#fff;border-radius:10px 0 0 10px;">
                    <i class="fas fa-chart-line"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.revenue_this_month'); ?></span>
                    <span class="info-box-number"><?php echo e(number_format($dashboard_stats['revenue_this_month'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-green" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.collected_this_month'); ?></span>
                    <span class="info-box-number"><?php echo e(number_format($dashboard_stats['total_paid_this_month'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box" style="border-radius:10px;">
                <span class="info-box-icon bg-red" style="border-radius:10px 0 0 10px;">
                    <i class="fas fa-file-invoice-dollar"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.total_outstanding'); ?></span>
                    <span class="info-box-number" style="<?php echo e($dashboard_stats['total_outstanding'] > 0 ? 'color:#dc3545;' : '', false); ?>"><?php echo e(number_format($dashboard_stats['total_outstanding'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Navigator -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="box" style="border-radius:10px;">
                <div class="box-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap" style="gap:0.25rem;">
                            <?php for($i = -3; $i <= 3; $i++): ?>
                                <?php $date = $today->copy()->addDays($i); ?>
                                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\DashboardController::class, 'index'], ['date' => $date->toDateString()]), false); ?>"
                                   class="btn btn-sm <?php echo e($i == 0 ? 'btn-primary' : 'btn-outline-secondary', false); ?>" style="border-radius:8px;">
                                    <?php echo e($date->format('D, d M'), false); ?>

                                </a>
                            <?php endfor; ?>
                        </div>
                        <div class="d-flex align-items-center" style="gap:0.5rem;">
                            <div class="input-group input-group-sm" style="max-width:220px;">
                                <input type="text" class="form-control" id="dashboard_jump_date" placeholder="<?php echo app('translator')->get('tailorpro::lang.jump_to_date'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" type="button" id="dashboard_jump_btn">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="box" style="border-radius:10px;">
                <div class="box-body py-2">
                    <div class="d-flex flex-wrap align-items-center" style="gap:0.75rem;">
                        <?php $__currentLoopData = $order_status_counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $osc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="display:inline-flex;align-items:center;gap:0.35rem;padding:0.25rem 0.75rem;background:#f8f9fa;border-radius:20px;font-size:0.85rem;">
                                <span style="width:10px;height:10px;border-radius:50%;background:<?php echo e($osc['color'], false); ?>;display:inline-block;"></span>
                                <?php echo e($osc['name'], false); ?>: <strong><?php echo e($osc['count'], false); ?></strong>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart & Overdue Widget -->
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-chart-area"></i> <?php echo app('translator')->get('tailorpro::lang.revenue_chart'); ?></h3>
                </div>
                <div class="box-body">
                    <div id="tp_revenue_chart" style="height:300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-users-cog"></i> <?php echo app('translator')->get('tailorpro::lang.tailor_workload'); ?></h3>
                </div>
                <div class="box-body" style="max-height:300px;overflow-y:auto;">
                    <?php if($tailor_workload->count()): ?>
                    <table class="table table-condensed table-striped" style="margin-bottom:0;">
                        <thead><tr><th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th><th class="text-right"><?php echo app('translator')->get('tailorpro::lang.active_orders'); ?></th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $tailor_workload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tw->tailor_name, false); ?></td>
                                <td class="text-right">
                                    <span class="badge" style="background:#6f42c1;color:#fff;font-size:0.85rem;"><?php echo e($tw->order_count, false); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p class="text-muted text-center" style="margin-top:30px;"><?php echo app('translator')->get('tailorpro::lang.no_active_tailor_orders'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Overdue Orders Widget -->
    <?php if($overdue_orders->count()): ?>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="box box-danger" style="border-radius:10px;border-top:3px solid #dc3545;">
                <div class="box-header with-border">
                    <h3 class="box-title" style="color:#dc3545;"><i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('tailorpro::lang.overdue_orders'); ?> (<?php echo e($dashboard_stats['overdue_count'], false); ?>)</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover table-condensed" style="margin-bottom:0;">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th>
                                <th><?php echo app('translator')->get('role.customer'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.days_overdue'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                                <th><?php echo app('translator')->get('sale.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $overdue_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="background:#fff5f5;">
                                <td>
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'show'], [$oo->id]), false); ?>">
                                        <strong><?php echo e($oo->order_no, false); ?></strong>
                                    </a>
                                </td>
                                <td><?php echo e($oo->customer->name ?? '-', false); ?></td>
                                <td><?php echo e($oo->delivery_date ? \Carbon::createFromTimestamp(strtotime($oo->delivery_date))->format(session('business.date_format')) : '-', false); ?></td>
                                <td>
                                    <span class="badge badge-danger"><?php echo e(\Carbon\Carbon::parse($oo->delivery_date)->diffInDays(now()), false); ?> <?php echo app('translator')->get('tailorpro::lang.days'); ?></span>
                                </td>
                                <td><?php echo e($oo->tailor ? $oo->tailor->first_name . ' ' . $oo->tailor->last_name : '-', false); ?></td>
                                <td>
                                    <?php if($oo->status): ?>
                                        <span class="badge" style="background:<?php echo e($oo->status->color ?? '#6c757d', false); ?>;color:#fff;"><?php echo e($oo->status->name, false); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Orders Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('tailorpro::lang.orders'); ?>
                    </h3>
                    <div class="box-tools">
                        <select class="form-control form-control-sm" id="order_status_filter" style="width:200px;border-radius:8px;">
                            <option value=""><?php echo app('translator')->get('lang_v1.change_to_filter'); ?></option>
                            <?php $__currentLoopData = $tailorpro_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ts->id, false); ?>"><?php echo e($ts->name, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tailorpro_orders_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th>
                                    <th><?php echo app('translator')->get('role.customer'); ?></th>
                                    <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                                    <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                                    <th><?php echo app('translator')->get('tailorpro::lang.order_date'); ?></th>
                                    <th><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?></th>
                                    <th><?php echo app('translator')->get('tailorpro::lang.priority'); ?></th>
                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var showCompleted = false;

    // Revenue Chart (Highcharts)
    var chartData = <?php echo json_encode($revenue_chart_data, 15, 512) ?>;
    var categories = chartData.map(function(d) { return d.date; });
    var revenueData = chartData.map(function(d) { return d.revenue; });
    var ordersData = chartData.map(function(d) { return d.orders; });

    Highcharts.chart('tp_revenue_chart', {
        chart: { type: 'area' },
        title: { text: null },
        credits: { enabled: false },
        xAxis: { categories: categories, crosshair: true },
        yAxis: [
            { title: { text: '<?php echo app('translator')->get("tailorpro::lang.revenue"); ?>' }, min: 0 },
            { title: { text: '<?php echo app('translator')->get("tailorpro::lang.orders"); ?>' }, opposite: true, min: 0, allowDecimals: false }
        ],
        tooltip: { shared: true },
        plotOptions: { area: { fillOpacity: 0.15 } },
        series: [
            {
                name: '<?php echo app('translator')->get("tailorpro::lang.revenue"); ?>',
                data: revenueData,
                color: '#6f42c1',
                yAxis: 0
            },
            {
                name: '<?php echo app('translator')->get("tailorpro::lang.orders"); ?>',
                data: ordersData,
                type: 'column',
                color: '#17a2b8',
                yAxis: 1
            }
        ]
    });

    var orders_table = $("#tailorpro_orders_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\DashboardController::class, "dashboardOrders"]), false); ?>',
            data: function(d) {
                d.date = '<?php echo e($today->toDateString(), false); ?>';
                d.status_id = $('#order_status_filter').val();
                d.is_completed_status = showCompleted ? '1' : '0';
            },
        },
        columns: [
            { data: 'order_no', name: 'order_no' },
            { data: 'customer_name', name: 'contacts.name' },
            { data: 'garment_type', name: 'garment_type' },
            { data: 'tailor_name', name: 'tailor.first_name' },
            { data: 'order_date', name: 'order_date', searchable: false },
            { data: 'delivery_date', name: 'delivery_date', searchable: false },
            { data: 'priority_badge', name: 'priority' },
            { data: 'status', name: 'ts.name' }
        ],
    });

    $(document).on('change', '#order_status_filter', function () {
        orders_table.ajax.reload();
    });

    // Jump to date
    $('#dashboard_jump_date').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    $(document).on('click', '#dashboard_jump_btn', function() {
        var jumpVal = $('#dashboard_jump_date').val();
        if (jumpVal) {
            var parsedDate = moment(jumpVal, moment_date_format);
            if (parsedDate.isValid()) {
                window.location.href = '<?php echo e(action([\Modules\TailorPro\Http\Controllers\DashboardController::class, "index"]), false); ?>?date=' + parsedDate.format('YYYY-MM-DD');
            }
        }
    });

    $('#dashboard_jump_date').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#dashboard_jump_btn').trigger('click');
        }
    });

    // Status modal
    $(document).on('click', '.edit_order_status', function (e) {
        e.preventDefault();
        var url = $(this).data('href');
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'html',
            success: function(result) {
                $('#status_modal').html(result).modal('show');
            }
        });
    });

    $(document).on('submit', 'form#update_status_form', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: $(this).attr("method"),
            url: $(this).attr("action"),
            dataType: "json",
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('#status_modal').modal('hide');
                    toastr.success(result.msg);
                    orders_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('fuelstation::lang.fuel_station') . ' - ' . __('fuelstation::lang.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('fuelstation::lang.fuel_station'); ?> <small><?php echo app('translator')->get('fuelstation::lang.dashboard'); ?></small></h1>
</section>

<section class="content">
    <?php echo Form::open(['method' => 'get', 'id' => 'fuel_dashboard_filter']); ?>

    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('start_date', __('report.start_date') . ':'); ?>

                <?php echo Form::date('start_date', $start_date, ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('end_date', __('report.end_date') . ':'); ?>

                <?php echo Form::date('end_date', $end_date, ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->get('report.apply_filters'); ?></button>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-success"><span class="info-box-icon"><i class="fa fas fa-money-bill-wave"></i></span>
                <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('fuelstation::lang.today_total_sales'); ?></span>
                    <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($stats['total_amount'], false); ?></span></span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-info"><span class="info-box-icon"><i class="fa fas fa-gas-pump"></i></span>
                <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('fuelstation::lang.today_total_liters'); ?></span>
                    <span class="info-box-number"><?php echo e(number_format($stats['total_liters'], 2), false); ?> L</span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-primary"><span class="info-box-icon"><i class="fa fas fa-user-clock"></i></span>
                <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('fuelstation::lang.active_shifts'); ?></span>
                    <span class="info-box-number"><?php echo e($stats['active_shifts_count'], false); ?></span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-warning"><span class="info-box-icon"><i class="fa fas fa-clipboard-check"></i></span>
                <div class="info-box-content"><span class="info-box-text"><?php echo app('translator')->get('fuelstation::lang.pending_approvals'); ?></span>
                    <span class="info-box-number"><?php echo e($stats['pending_approvals_count'], false); ?></span></div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.tank_wise_stock')]); ?>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.current_stock'); ?></th><th>%</th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $stats['tanks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr class="<?php echo e($tank->is_low_stock ? 'text-danger' : '', false); ?>">
                                <td><?php echo e($tank->name, false); ?> <small class="text-muted"><?php echo e($tank->fuel_type, false); ?></small></td>
                                <td><?php echo e(number_format($tank->current_stock, 2), false); ?> / <?php echo e(number_format($tank->capacity, 2), false); ?> L</td>
                                <td>
                                    <div class="progress" style="margin:0; min-width:80px;">
                                        <div class="progress-bar <?php echo e($tank->is_low_stock ? 'bg-danger' : 'bg-success', false); ?>" style="width: <?php echo e($tank->fill_percent, false); ?>%"><?php echo e($tank->fill_percent, false); ?>%</div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="3" class="text-center"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('fuelstation::lang.low_stock_tanks')]); ?>
                <?php $__empty_18 = true; $__currentLoopData = $stats['low_stock_tanks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <div class="callout callout-danger" style="padding:8px; margin-bottom:6px;">
                        <b><?php echo e($tank->name, false); ?></b> — <?php echo e(number_format($tank->current_stock, 2), false); ?> L
                        (<small><?php echo app('translator')->get('fuelstation::lang.min_stock_alert'); ?>: <?php echo e(number_format($tank->min_stock_alert, 2), false); ?> L</small>)
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <p class="text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></p>
                <?php endif; ?>
                <hr>
                <h4><?php echo app('translator')->get('fuelstation::lang.cash_short_excess'); ?>:
                    <span class="<?php echo e($stats['short_excess_total'] < 0 ? 'text-danger' : 'text-success', false); ?>">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($stats['short_excess_total'], false); ?></span>
                    </span>
                </h4>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('fuelstation::lang.sales_trend')]); ?>
                <canvas id="fuel_trend_chart" height="140"></canvas>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('fuelstation::lang.product_wise_sales')]); ?>
                <canvas id="fuel_product_chart" height="140"></canvas>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.dispenser_wise_sales')]); ?>
                <table class="table table-sm table-bordered">
                    <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?></th></tr></thead>
                    <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $dispenser_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr><td><?php echo e($d->dispenser_name, false); ?></td><td><?php echo e(number_format($d->liters, 2), false); ?> L</td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($d->amount, false); ?></span></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="3" class="text-center"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('fuelstation::lang.integration_status')]); ?>
                <table class="table table-sm table-bordered">
                    <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.protocol'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.sync_status'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.last_reading_at'); ?></th></tr></thead>
                    <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $integrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr><td><?php echo e(optional($ig->dispenser)->name, false); ?></td><td><?php echo e(strtoupper($ig->protocol), false); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('fuelstation::lang.sync_'.$ig->sync_status); ?></span></td>
                            <td><?php echo e(optional($ig->last_reading_at)->format('d-m-Y H:i') ?? '-', false); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.active_shifts')]); ?>
                <table class="table table-sm table-bordered">
                    <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.operator'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.start_time'); ?></th></tr></thead>
                    <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $active_shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr><td><?php echo e($shift->shift_no, false); ?></td><td><?php echo e(optional($shift->operator)->user_full_name, false); ?></td>
                            <td><?php echo e(optional($shift->dispenser)->name ?? '-', false); ?></td><td><?php echo e(optional($shift->start_time)->format('d-m-Y H:i'), false); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/chart.umd.min.js?v=' . $asset_v), false); ?>"></script>
<script>
$(function () {
    var trendLabels = <?php echo json_encode($trend->pluck('d')); ?>;
    var trendAmounts = <?php echo json_encode($trend->pluck('amount')); ?>;
    var trendLiters = <?php echo json_encode($trend->pluck('liters')); ?>;

    if (document.getElementById('fuel_trend_chart')) {
        new Chart(document.getElementById('fuel_trend_chart').getContext('2d'), {
            type: 'line',
            data: { labels: trendLabels, datasets: [
                { label: '<?php echo app('translator')->get('fuelstation::lang.total_amount'); ?>', data: trendAmounts, borderColor: '#28a745', backgroundColor: 'rgba(40,167,69,.1)', fill: true, tension: .3 },
                { label: '<?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?>', data: trendLiters, borderColor: '#17a2b8', backgroundColor: 'rgba(23,162,184,.1)', fill: true, tension: .3 }
            ]},
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    var prodLabels = <?php echo json_encode($product_sales->pluck('product_name')); ?>;
    var prodAmounts = <?php echo json_encode($product_sales->pluck('amount')); ?>;
    if (document.getElementById('fuel_product_chart')) {
        new Chart(document.getElementById('fuel_product_chart').getContext('2d'), {
            type: 'doughnut',
            data: { labels: prodLabels, datasets: [{ data: prodAmounts,
                backgroundColor: ['#4F46E5', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1', '#fd7e14'] }] },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
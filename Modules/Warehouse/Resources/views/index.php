
<?php $__env->startSection('title', __('warehouse::lang.warehouse_management')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?>
        <small><?php echo app('translator')->get('warehouse::lang.dashboard'); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-primary text-primary" style="width:50px; height:50px; min-width:50px;">
                        <i class="fas fa-warehouse fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-primary"><?php echo e($total_warehouses, false); ?></h4>
                        <p class="mb-0 text-muted small"><?php echo app('translator')->get('warehouse::lang.total_warehouses'); ?></p>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-info text-info" style="width:50px; height:50px; min-width:50px;">
                        <i class="fas fa-boxes fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-info"><?php echo e($total_products_in_stock, false); ?></h4>
                        <p class="mb-0 text-muted small"><?php echo app('translator')->get('warehouse::lang.total_products_in_stock'); ?></p>
                        <small class="text-muted"><?php echo e(number_format($total_stock_quantity, 0), false); ?> <?php echo app('translator')->get('warehouse::lang.total_stock_units'); ?></small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-warning text-warning" style="width:50px; height:50px; min-width:50px;">
                        <i class="fas fa-exchange-alt fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-warning"><?php echo e($pending_transfers, false); ?></h4>
                        <p class="mb-0 text-muted small"><?php echo app('translator')->get('warehouse::lang.pending_transfers'); ?></p>
                        <small>
                            <span class="text-info"><i class="fas fa-truck"></i> <?php echo e($in_transit_transfers, false); ?> <?php echo app('translator')->get('warehouse::lang.in_transit'); ?></span>
                        </small>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-danger text-danger" style="width:50px; height:50px; min-width:50px;">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-danger"><?php echo e($expiring_soon, false); ?></h4>
                        <p class="mb-0 text-muted small"><?php echo app('translator')->get('warehouse::lang.expiring_soon'); ?></p>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-muted small"><?php echo app('translator')->get('warehouse::lang.transfers_this_month'); ?></p>
                        <h5 class="mb-0 fw-bold text-primary"><?php echo e($total_transfers_month, false); ?></h5>
                    </div>
                    <div class="text-primary"><i class="fas fa-exchange-alt fa-2x opacity-50"></i></div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-muted small"><?php echo app('translator')->get('warehouse::lang.completed_this_month'); ?></p>
                        <h5 class="mb-0 fw-bold text-success"><?php echo e($completed_transfers_month, false); ?></h5>
                    </div>
                    <div class="text-success"><i class="fas fa-check-circle fa-2x opacity-50"></i></div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-muted small"><?php echo app('translator')->get('warehouse::lang.pending_pick_lists'); ?></p>
                        <h5 class="mb-0 fw-bold text-info"><?php echo e($pending_pick_lists, false); ?></h5>
                    </div>
                    <div class="text-info"><i class="fas fa-clipboard-list fa-2x opacity-50"></i></div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-muted small"><?php echo app('translator')->get('warehouse::lang.pending_shipments'); ?></p>
                        <h5 class="mb-0 fw-bold text-danger"><?php echo e($pending_shipments, false); ?></h5>
                    </div>
                    <div class="text-danger"><i class="fas fa-shipping-fast fa-2x opacity-50"></i></div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.movement_trend')]); ?>
                <?php echo $movement_chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.transfer_status_overview')]); ?>
                <?php if(!empty($transfer_status_counts)): ?>
                    <div id="transfer_status_chart" style="height: 280px;"></div>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-chart-pie fa-3x mb-3 opacity-50"></i>
                        <p><?php echo app('translator')->get('warehouse::lang.no_data'); ?></p>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-5">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.transfer_trend')]); ?>
                <?php echo $transfer_chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-7">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.stock_by_warehouse')]); ?>
                <?php if($stock_by_warehouse->count() > 0): ?>
                    <div id="stock_by_warehouse_chart" style="height: 280px;"></div>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-warehouse fa-3x mb-3 opacity-50"></i>
                        <p><?php echo app('translator')->get('warehouse::lang.no_data'); ?></p>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-3">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.quick_actions')]); ?>
                <div class="d-grid gap-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.transfer.create')): ?>
                    <a href="<?php echo e(route('warehouse.transfers.create'), false); ?>" class="btn btn-sm btn-primary w-100">
                        <i class="fas fa-exchange-alt me-2"></i><?php echo app('translator')->get('warehouse::lang.create_transfer'); ?>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.stock.view')): ?>
                    <a href="<?php echo e(route('warehouse.stock'), false); ?>" class="btn btn-sm btn-info w-100">
                        <i class="fas fa-boxes me-2"></i><?php echo app('translator')->get('warehouse::lang.stock_overview'); ?>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.create')): ?>
                    <a href="<?php echo e(route('warehouse.create'), false); ?>" class="btn btn-sm btn-success w-100">
                        <i class="fas fa-warehouse me-2"></i><?php echo app('translator')->get('warehouse::lang.add_warehouse'); ?>
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('warehouse.transfers'), false); ?>" class="btn btn-sm btn-warning w-100">
                        <i class="fas fa-list me-2"></i><?php echo app('translator')->get('warehouse::lang.view_all_transfers'); ?>
                    </a>
                    <a href="<?php echo e(route('warehouse.stock.movements'), false); ?>" class="btn btn-sm btn-secondary w-100">
                        <i class="fas fa-history me-2"></i><?php echo app('translator')->get('warehouse::lang.view_all_movements'); ?>
                    </a>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.recent_transfers')]); ?>
                <div style="max-height: 340px; overflow-y: auto;">
                    <?php $__empty_18 = true; $__currentLoopData = $recent_transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="d-flex align-items-center justify-content-between py-2 <?php echo e(!$loop->last ? 'border-bottom' : '', false); ?>">
                            <div>
                                <a href="<?php echo e(route('warehouse.transfers.show', $transfer->id), false); ?>" class="fw-bold text-primary">
                                    <?php echo e($transfer->reference_no, false); ?>

                                </a>
                                <br>
                                <small class="text-muted">
                                    <?php echo e(optional($transfer->sourceWarehouse)->name, false); ?>

                                    <i class="fas fa-arrow-right mx-1"></i>
                                    <?php echo e(optional($transfer->destinationWarehouse)->name, false); ?>

                                </small>
                            </div>
                            <div class="text-end">
                                <small class="text-muted"><?php echo e($transfer->created_at ? $transfer->created_at->format('M d') : '', false); ?></small>
                                <br>
                                <?php
                                    $statusColors = [
                                        'draft' => 'bg-secondary',
                                        'pending' => 'bg-warning',
                                        'in_transit' => 'bg-info',
                                        'partial' => 'bg-primary',
                                        'completed' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                    ];
                                ?>
                                <span class="badge <?php echo e($statusColors[$transfer->status] ?? 'bg-secondary', false); ?>">
                                    <?php echo app('translator')->get('warehouse::lang.status_' . $transfer->status); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-exchange-alt fa-3x mb-3 opacity-50"></i>
                            <p><?php echo app('translator')->get('warehouse::lang.no_data'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-5">
            <?php $__env->startComponent('components.widget', ['title' => __('warehouse::lang.recent_movements')]); ?>
                <div class="table-responsive" style="max-height: 340px; overflow-y: auto;">
                    <table class="table table-hover table-sm mb-0">
                        <thead class="table-th-skin">
                            <tr>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
                                <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                                <th><?php echo app('translator')->get('warehouse::lang.movement_type'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('warehouse::lang.quantity'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $recent_movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><small><?php echo e($movement->created_at->format('M d'), false); ?></small></td>
                                    <td><small><?php echo e(optional($movement->warehouse)->name, false); ?></small></td>
                                    <td><small><?php echo e(optional($movement->product)->name, false); ?></small></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($movement->quantity > 0 ? 'success' : 'danger', false); ?>">
                                            <?php echo app('translator')->get('warehouse::lang.movement_' . $movement->type); ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold <?php echo e($movement->quantity > 0 ? 'text-success' : 'text-danger', false); ?>">
                                        <?php echo e($movement->quantity > 0 ? '+' : '', false); ?><?php echo e(number_format($movement->quantity, 2), false); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('warehouse::lang.no_data'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $movement_chart->script(); ?>

    <?php echo $transfer_chart->script(); ?>


    <?php if(!empty($transfer_status_counts)): ?>
    <script>
        $(function() {
            var statusData = <?php echo json_encode($transfer_status_counts, 15, 512) ?>;
            var statusColors = {
                'draft': '#6c757d',
                'pending': '#ffc107',
                'in_transit': '#17a2b8',
                'partial': '#3461ff',
                'completed': '#28a745',
                'cancelled': '#dc3545'
            };
            var statusLabels = {
                'draft': '<?php echo app('translator')->get("warehouse::lang.status_draft"); ?>',
                'pending': '<?php echo app('translator')->get("warehouse::lang.status_pending"); ?>',
                'in_transit': '<?php echo app('translator')->get("warehouse::lang.status_in_transit"); ?>',
                'partial': '<?php echo app('translator')->get("warehouse::lang.status_partial"); ?>',
                'completed': '<?php echo app('translator')->get("warehouse::lang.status_completed"); ?>',
                'cancelled': '<?php echo app('translator')->get("warehouse::lang.status_cancelled"); ?>'
            };

            var chartData = [];
            for (var key in statusData) {
                chartData.push({
                    name: statusLabels[key] || key,
                    y: statusData[key],
                    color: statusColors[key] || '#6c757d'
                });
            }

            if (typeof Highcharts !== 'undefined') {
                Highcharts.chart('transfer_status_chart', {
                    chart: { type: 'pie', backgroundColor: 'transparent' },
                    title: { text: null },
                    tooltip: { pointFormat: '<b>{point.y}</b> ({point.percentage:.1f}%)' },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {point.y}',
                                style: { fontSize: '11px' }
                            },
                            showInLegend: false
                        }
                    },
                    credits: { enabled: false },
                    series: [{ name: 'Transfers', data: chartData }]
                });
            }
        });
    </script>
    <?php endif; ?>

    <?php if($stock_by_warehouse->count() > 0): ?>
    <script>
        $(function() {
            var warehouseData = <?php echo json_encode($stock_by_warehouse->map(function($s) {
                return ['name' => optional($s->warehouse)->name ?? 'Unknown', 'qty' => (float) $s->total_qty];
            })->values(), 512) ?>;

            if (typeof Highcharts !== 'undefined') {
                Highcharts.chart('stock_by_warehouse_chart', {
                    chart: { type: 'bar', backgroundColor: 'transparent' },
                    title: { text: null },
                    xAxis: {
                        categories: warehouseData.map(function(d) { return d.name; }),
                        labels: { style: { fontSize: '11px' } }
                    },
                    yAxis: { title: { text: '<?php echo app('translator')->get("warehouse::lang.quantity"); ?>' }, min: 0 },
                    tooltip: { valueSuffix: ' units' },
                    plotOptions: { bar: { dataLabels: { enabled: true } } },
                    legend: { enabled: false },
                    credits: { enabled: false },
                    series: [{
                        name: '<?php echo app('translator')->get("warehouse::lang.quantity"); ?>',
                        data: warehouseData.map(function(d) { return d.qty; }),
                        color: '#3461ff'
                    }]
                });
            }
        });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
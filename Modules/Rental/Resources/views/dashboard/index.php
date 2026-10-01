

<?php $__env->startSection('title', __('rental::lang.dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-boxes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_rental_items'); ?></span>
                    <span class="info-box-number"><?php echo e($total_items, false); ?></span>
                    <span class="info-box-text text-success"><?php echo e($available_items, false); ?> <?php echo app('translator')->get('rental::lang.available_items'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-file-contract"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.active_agreements'); ?></span>
                    <span class="info-box-number"><?php echo e($active_agreements, false); ?></span>
                    <span class="info-box-text"><?php echo e($draft_agreements, false); ?> <?php echo app('translator')->get('rental::lang.draft_agreements'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-exclamation-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.overdue_agreements'); ?></span>
                    <span class="info-box-number text-danger"><?php echo e($overdue_agreements, false); ?></span>
                    <span class="info-box-text"><?php echo e($completed_this_month, false); ?> <?php echo app('translator')->get('rental::lang.completed_this_month'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.today_revenue'); ?></span>
                    <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($today_revenue, false); ?></span></span>
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.monthly_revenue'); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($monthly_revenue, false); ?></span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fas fa-shield-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_deposits_held'); ?></span>
                    <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($total_deposits_held, false); ?></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-maroon"><i class="fas fa-balance-scale"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.outstanding_balance'); ?></span>
                    <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($outstanding_balance, false); ?></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.pending_maintenance'); ?></span>
                    <span class="info-box-number"><?php echo e($pending_maintenance, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('rental::lang.open_damage_reports'); ?></span>
                    <span class="info-box-number"><?php echo e($open_damage_reports, false); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('rental::lang.revenue_trend'); ?></h3>
                </div>
                <div class="box-body">
                    <canvas id="rental_revenue_chart" height="200"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('rental::lang.status_breakdown'); ?></h3>
                </div>
                <div class="box-body">
                    <canvas id="rental_status_chart" height="250"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('rental::lang.quick_actions'); ?></h3>
                </div>
                <div class="box-body">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_agreements')): ?>
                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'create']), false); ?>" class="btn btn-block btn-primary mb-10">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('rental::lang.new_agreement'); ?>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_rental_items')): ?>
                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalItemController::class, 'create']), false); ?>" class="btn btn-block btn-success mb-10">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('rental::lang.new_rental_item'); ?>
                    </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.view_reports')): ?>
                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReportController::class, 'index']), false); ?>" class="btn btn-block btn-info mb-10">
                        <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('rental::lang.reports'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-exclamation-circle"></i> <?php echo app('translator')->get('rental::lang.overdue_list'); ?></h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.rental_end_expected'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.balance_due'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $overdue_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agreement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'show'], [$agreement->id]), false); ?>">
                                        <?php echo e($agreement->agreement_no, false); ?>

                                    </a>
                                </td>
                                <td><?php echo e($agreement->contact ? $agreement->contact->name : '-', false); ?></td>
                                <td>
                                    <?php echo e($agreement->rental_end_expected ? $agreement->rental_end_expected->format('Y-m-d') : '-', false); ?>

                                    <span class="badge badge-danger"><?php echo e($agreement->overdue_days, false); ?>d</span>
                                </td>
                                <td><span class="display_currency text-danger" data-currency_symbol="true"><?php echo e($agreement->balance_due, false); ?></span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('rental::lang.no_data_available'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-clock"></i> <?php echo app('translator')->get('rental::lang.upcoming_due'); ?></h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.rental_end_expected'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.rental_items'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $upcoming_due; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agreement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'show'], [$agreement->id]), false); ?>">
                                        <?php echo e($agreement->agreement_no, false); ?>

                                    </a>
                                </td>
                                <td><?php echo e($agreement->contact ? $agreement->contact->name : '-', false); ?></td>
                                <td><?php echo e($agreement->rental_end_expected ? $agreement->rental_end_expected->format('Y-m-d H:i') : '-', false); ?></td>
                                <td>
                                    <?php $__currentLoopData = $agreement->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="label label-default"><?php echo e($line->rentalItem ? $line->rentalItem->name : '-', false); ?> (<?php echo e($line->quantity, false); ?>)</span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr><td colspan="4" class="text-center"><?php echo app('translator')->get('rental::lang.no_data_available'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-trophy"></i> <?php echo app('translator')->get('rental::lang.top_rented_items'); ?></h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.name'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.rental_count'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.available_quantity'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.daily_rate'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $top_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name, false); ?></td>
                                <td><?php echo e($item->rental_count, false); ?></td>
                                <td><?php echo e($item->available_quantity, false); ?>/<?php echo e($item->total_quantity, false); ?></td>
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->daily_rate, false); ?></span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Revenue Trend Chart
    var revCtx = document.getElementById('rental_revenue_chart').getContext('2d');
    var revData = <?php echo json_encode($revenue_trend, 15, 512) ?>;
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: revData.map(function(d) { return d.date; }),
            datasets: [{
                label: '<?php echo app('translator')->get("rental::lang.today_revenue"); ?>',
                data: revData.map(function(d) { return d.amount; }),
                borderColor: '#3c8dbc',
                backgroundColor: 'rgba(60,141,188,0.1)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Status Breakdown Pie Chart
    var statusCtx = document.getElementById('rental_status_chart').getContext('2d');
    var statusData = <?php echo json_encode($status_breakdown, 15, 512) ?>;
    var statusLabels = Object.keys(statusData);
    var statusValues = Object.values(statusData);
    var statusColors = {
        'draft': '#6c757d',
        'confirmed': '#17a2b8',
        'active': '#28a745',
        'overdue': '#dc3545',
        'completed': '#007bff',
        'cancelled': '#343a40',
    };
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: statusLabels.map(function(s) { return statusColors[s] || '#999'; }),
            }]
        },
        options: {
            responsive: true,
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', __('productcatalogue::lang.analytics')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="fs-4 fw-bold text-dark">
        <i class="fas fa-chart-line"></i> <?php echo app('translator')->get('productcatalogue::lang.catalogue_analytics'); ?>
    </h1>
</section>

<section class="content">
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
        <form method="GET" class="form-inline">
            <div class="form-group mr-3">
                <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
            <div class="form-group mr-3">
                <?php echo Form::label('date_from', __('productcatalogue::lang.date_from') . ':'); ?>

                <?php echo Form::date('date_from', $from, ['class' => 'form-control']); ?>

            </div>
            <div class="form-group mr-3">
                <?php echo Form::label('date_to', __('productcatalogue::lang.date_to') . ':'); ?>

                <?php echo Form::date('date_to', $to, ['class' => 'form-control']); ?>

            </div>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-filter"></i> <?php echo app('translator')->get('productcatalogue::lang.filter'); ?>
            </button>
        </form>
    <?php echo $__env->renderComponent(); ?>

    
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-aqua']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e(number_format($total_page_views), false); ?></h3>
                    <p class="mb-0"><i class="fas fa-eye"></i> <?php echo app('translator')->get('productcatalogue::lang.page_views'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-green']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e(number_format($unique_visitors), false); ?></h3>
                    <p class="mb-0"><i class="fas fa-users"></i> <?php echo app('translator')->get('productcatalogue::lang.unique_visitors'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-purple']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e(number_format($total_product_views), false); ?></h3>
                    <p class="mb-0"><i class="fas fa-box-open"></i> <?php echo app('translator')->get('productcatalogue::lang.product_views'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-yellow']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e(number_format($total_add_to_cart), false); ?></h3>
                    <p class="mb-0"><i class="fas fa-cart-plus"></i> <?php echo app('translator')->get('productcatalogue::lang.add_to_cart_events'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-red']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e(number_format($total_orders), false); ?></h3>
                    <p class="mb-0"><i class="fas fa-shopping-bag"></i> <?php echo app('translator')->get('productcatalogue::lang.orders_placed'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid bg-navy']); ?>
                <div class="text-center">
                    <h3 class="fw-bold"><?php echo e($conversion_rate, false); ?>%</h3>
                    <p class="mb-0"><i class="fas fa-percentage"></i> <?php echo app('translator')->get('productcatalogue::lang.conversion_rate'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.daily_page_views')]); ?>
                <canvas id="dailyViewsChart" height="100"></canvas>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.top_viewed_products')]); ?>
                <?php if($top_products->isEmpty()): ?>
                    <p class="text-muted text-center"><?php echo app('translator')->get('productcatalogue::lang.no_data_available'); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('sale.product'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('productcatalogue::lang.views'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $top_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i + 1, false); ?></td>
                                        <td><?php echo e($item->product->name ?? 'N/A', false); ?></td>
                                        <td class="text-right"><?php echo e(number_format($item->views), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/chart.umd.min.js?v=' . $asset_v), false); ?>"></script>
<script>
(function() {
    var dailyData = <?php echo json_encode($daily_views, 15, 512) ?>;
    var labels = Object.keys(dailyData);
    var values = Object.values(dailyData);

    if (labels.length > 0) {
        new Chart(document.getElementById('dailyViewsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '<?php echo e(__("productcatalogue::lang.page_views"), false); ?>',
                    data: values,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 3,
                    pointBackgroundColor: '#667eea'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    }
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
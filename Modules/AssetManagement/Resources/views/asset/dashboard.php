
<?php $__env->startSection('title', __('assetmanagement::lang.asset_dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('assetmanagement::layouts.nav')) echo $__env->make('assetmanagement::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1 class="fs-4 fw-bold text-dark">
            <i class="fas fa-tachometer-alt me-2"></i><?php echo app('translator')->get('assetmanagement::lang.asset_dashboard'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">

        
        <div class="row mb-3">
            <div class="col-12">
                <h5 class="fw-semibold text-muted mb-3"><i class="fas fa-user me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.my_assets'); ?></h5>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card radius-10 border-start border-4 border-primary shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-1 text-muted small"><?php echo app('translator')->get('assetmanagement::lang.total_assets_allocated_to_you'); ?></p>
                                <h3 class="mb-0 fw-bold text-primary"><?php echo e(number_format($total_assets_allocated, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-box-open fa-lg text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'h-100 shadow-sm', 'title' => __('assetmanagement::lang.my_allocation_by_category')]); ?>
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr><th><?php echo app('translator')->get('product.category'); ?></th><th class="text-end"><?php echo app('translator')->get('sale.qty'); ?></th></tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $asset_allocation_by_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr><td><?php echo e($asset->category ?? __('lang_v1.uncategorized'), false); ?></td><td class="text-end fw-bold"><?php echo e(number_format($asset->total_quantity_allocated, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="2" class="text-center text-muted py-3"><i class="fas fa-inbox me-1"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        <?php if($is_admin): ?>
        <hr class="my-4">

        
        <h5 class="fw-semibold text-muted mb-3"><i class="fas fa-chart-line me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.admin_overview'); ?></h5>

        
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 border-start border-4 border-info shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-1 text-muted small"><?php echo app('translator')->get('assetmanagement::lang.total_assets'); ?></p>
                                <h3 class="mb-0 fw-bold text-info"><?php echo e(number_format($total_assets, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h3>
                                <small class="text-muted"><?php echo e(number_format($total_asset_count, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo app('translator')->get('assetmanagement::lang.unique_items'); ?></small>
                            </div>
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-boxes fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 border-start border-4 border-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-1 text-muted small"><?php echo app('translator')->get('assetmanagement::lang.total_asset_value'); ?></p>
                                <h3 class="mb-0 fw-bold text-success"><?php echo e(number_format($total_asset_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h3>
                                <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.net_book'); ?>: <?php echo e(number_format($net_book_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></small>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-coins fa-lg text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 border-start border-4 border-warning shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-1 text-muted small"><?php echo app('translator')->get('assetmanagement::lang.total_depreciation'); ?></p>
                                <h3 class="mb-0 fw-bold text-warning"><?php echo e(number_format($total_depreciation, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h3>
                                <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.annual_depreciation'); ?></small>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-chart-line fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 border-start border-4 border-danger shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-1 text-muted small"><?php echo app('translator')->get('assetmanagement::lang.total_assets_allocated'); ?></p>
                                <h3 class="mb-0 fw-bold text-danger"><?php echo e(number_format($total_assets_allocated_for_all_users, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h3>
                                <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.across_all_users'); ?></small>
                            </div>
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-users fa-lg text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-wrench fa-2x text-warning mb-2"></i>
                        <h4 class="fw-bold mb-0"><?php echo e($assets_under_maintenance, false); ?></h4>
                        <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.assets_under_maintenance'); ?></small>
                        <?php if($overdue_maintenance > 0): ?>
                            <div class="mt-1"><span class="badge bg-danger"><?php echo e($overdue_maintenance, false); ?> <?php echo app('translator')->get('assetmanagement::lang.overdue'); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-2x text-info mb-2"></i>
                        <h4 class="fw-bold mb-0"><?php echo e($warranty_summary['active'], false); ?></h4>
                        <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.warranty_active'); ?></small>
                        <?php if($warranty_summary['expiring_soon'] > 0): ?>
                            <div class="mt-1"><span class="badge bg-warning text-dark"><?php echo e($warranty_summary['expiring_soon'], false); ?> <?php echo app('translator')->get('assetmanagement::lang.warranty_expiring_soon'); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-tools fa-2x text-success mb-2"></i>
                        <h4 class="fw-bold mb-0"><?php echo e(number_format($maintenance_cost['actual'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h4>
                        <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.total_maintenance_cost'); ?></small>
                        <div class="mt-1"><small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.estimated_cost'); ?>: <?php echo e(number_format($maintenance_cost['estimated'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></small></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-recycle fa-2x text-secondary mb-2"></i>
                        <h4 class="fw-bold mb-0"><?php echo e(number_format($disposed_assets_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></h4>
                        <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.disposed_assets_value'); ?></small>
                        <?php if($insurance_expiring > 0): ?>
                            <div class="mt-1"><span class="badge bg-info"><?php echo e($insurance_expiring, false); ?> <?php echo app('translator')->get('assetmanagement::lang.insurance_expiring_soon'); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.assets_by_condition')]); ?>
                    <?php if($condition_chart && $assets_by_condition->count() > 0): ?>
                        <?php echo $condition_chart->container(); ?>

                    <?php else: ?>
                        <div class="text-center text-muted py-4"><i class="fas fa-chart-pie fa-3x mb-2 d-block opacity-25"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.assets_by_status')]); ?>
                    <?php if($status_chart && $assets_by_status->count() > 0): ?>
                        <?php echo $status_chart->container(); ?>

                    <?php else: ?>
                        <div class="text-center text-muted py-4"><i class="fas fa-chart-pie fa-3x mb-2 d-block opacity-25"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.assets_by_category')]); ?>
                    <?php if($category_chart && $assets_by_category->count() > 0): ?>
                        <?php echo $category_chart->container(); ?>

                    <?php else: ?>
                        <div class="text-center text-muted py-4"><i class="fas fa-chart-bar fa-3x mb-2 d-block opacity-25"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.maintenance_summary')]); ?>
                    <?php if($maintenance_chart && $maintenance_stats->count() > 0): ?>
                        <?php echo $maintenance_chart->container(); ?>

                    <?php else: ?>
                        <div class="text-center text-muted py-4"><i class="fas fa-chart-bar fa-3x mb-2 d-block opacity-25"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm', 'title' => __('assetmanagement::lang.acquisition_trend_12m')]); ?>
                    <?php if($acquisition_chart): ?>
                        <?php echo $acquisition_chart->container(); ?>

                    <?php else: ?>
                        <div class="text-center text-muted py-4"><i class="fas fa-chart-area fa-3x mb-2 d-block opacity-25"></i><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.assets_by_location')]); ?>
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('business.location'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('assetmanagement::lang.count'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('assetmanagement::lang.total_value'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $assets_by_location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($loc->location ?? __('lang_v1.none'), false); ?></td>
                                    <td class="text-end"><?php echo e($loc->count, false); ?></td>
                                    <td class="text-end fw-bold"><?php echo e(number_format($loc->value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="3" class="text-center text-muted py-3"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.assets_by_purchase_type')]); ?>
                    <div class="row text-center">
                        <?php $__empty_18 = true; $__currentLoopData = $assets_by_purchase_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <div class="col-4">
                                <div class="p-3">
                                    <?php
                                        $pt_icons = ['owned' => 'fas fa-building text-success', 'rented' => 'fas fa-key text-info', 'leased' => 'fas fa-file-contract text-warning'];
                                    ?>
                                    <i class="<?php echo e($pt_icons[$pt->purchase_type] ?? 'fas fa-tag text-secondary', false); ?> fa-2x mb-2"></i>
                                    <h4 class="fw-bold mb-0"><?php echo e($pt->total, false); ?></h4>
                                    <small class="text-muted"><?php echo e(ucfirst($pt->purchase_type ?? __('lang_v1.none')), false); ?></small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <div class="col-12 text-center text-muted py-3"><?php echo app('translator')->get('lang_v1.no_data'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.warranty_overview')]); ?>
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                <i class="fas fa-check-circle fa-lg text-success"></i>
                            </div>
                            <h5 class="fw-bold mt-2 mb-0"><?php echo e($warranty_summary['active'], false); ?></h5>
                            <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.warranty_active'); ?></small>
                        </div>
                        <div>
                            <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                <i class="fas fa-exclamation-triangle fa-lg text-warning"></i>
                            </div>
                            <h5 class="fw-bold mt-2 mb-0"><?php echo e($warranty_summary['expiring_soon'], false); ?></h5>
                            <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.expiring_soon'); ?></small>
                        </div>
                        <div>
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                <i class="fas fa-times-circle fa-lg text-danger"></i>
                            </div>
                            <h5 class="fw-bold mt-2 mb-0"><?php echo e($warranty_summary['expired'], false); ?></h5>
                            <small class="text-muted"><?php echo app('translator')->get('assetmanagement::lang.warranty_expired'); ?></small>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-8 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.expired_or_expiring_in_one_month')]); ?>
                    <div style="max-height: 280px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('assetmanagement::lang.assets'); ?></th>
                                <th><?php echo app('translator')->get('assetmanagement::lang.asset_code'); ?></th>
                                <th><?php echo app('translator')->get('assetmanagement::lang.warranty_status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $expiring_assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($asset->name, false); ?></td>
                                    <td><code><?php echo e($asset->asset_code, false); ?></code></td>
                                    <td>
                                        <?php if(empty($asset->max_end_date)): ?>
                                            <span class="badge bg-danger"><?php echo app('translator')->get('report.expired'); ?></span>
                                        <?php elseif(\Carbon\Carbon::parse($asset->max_end_date)->lessThan(\Carbon\Carbon::today())): ?>
                                            <span class="badge bg-danger"><?php echo app('translator')->get('report.expired'); ?>: <?php echo e(\Carbon::createFromTimestamp(strtotime($asset->max_end_date))->format(session('business.date_format')), false); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><?php echo app('translator')->get('assetmanagement::lang.expiring_on'); ?>: <?php echo e(\Carbon::createFromTimestamp(strtotime($asset->max_end_date))->format(session('business.date_format')), false); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="3" class="text-center text-muted py-3"><i class="fas fa-shield-alt me-1"></i><?php echo app('translator')->get('assetmanagement::lang.no_expiring_warranties'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.recent_allocations')]); ?>
                    <div style="max-height: 320px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('assetmanagement::lang.asset'); ?></th>
                                <th><?php echo app('translator')->get('assetmanagement::lang.allocated_to'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('sale.qty'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $recent_allocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alloc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($alloc->asset_name, false); ?> <small class="text-muted d-block"><?php echo e($alloc->asset_code, false); ?></small></td>
                                    <td><?php echo e($alloc->receiver_name, false); ?></td>
                                    <td class="text-end"><?php echo e(number_format($alloc->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                    <td><?php echo e(\Carbon::createFromTimestamp(strtotime($alloc->transaction_datetime))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="4" class="text-center text-muted py-3"><?php echo app('translator')->get('assetmanagement::lang.no_recent_allocations'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm h-100', 'title' => __('assetmanagement::lang.recent_maintenance')]); ?>
                    <div style="max-height: 320px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo app('translator')->get('assetmanagement::lang.asset'); ?></th>
                                <th><?php echo app('translator')->get('assetmanagement::lang.status'); ?></th>
                                <th><?php echo app('translator')->get('assetmanagement::lang.assigned_to'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $recent_maintenance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($maint->asset_name, false); ?> <small class="text-muted d-block"><?php echo e($maint->asset_code, false); ?></small></td>
                                    <td>
                                        <?php
                                            $status_classes = ['new' => 'bg-info', 'in_progress' => 'bg-warning text-dark', 'completed' => 'bg-success', 'cancelled' => 'bg-secondary'];
                                        ?>
                                        <span class="badge <?php echo e($status_classes[$maint->status] ?? 'bg-secondary', false); ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $maint->status ?? '-')), false); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($maint->assigned_name ?: __('assetmanagement::lang.unassigned'), false); ?></td>
                                    <td><?php echo e(\Carbon::createFromTimestamp(strtotime($maint->created_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr><td colspan="4" class="text-center text-muted py-3"><?php echo app('translator')->get('assetmanagement::lang.no_recent_maintenance'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row mb-4">
            <div class="col-12">
                <?php $__env->startComponent('components.widget', ['class' => 'shadow-sm', 'title' => __('assetmanagement::lang.quick_actions')]); ?>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetController::class, 'index']), false); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.all_assets'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetAllocationController::class, 'index']), false); ?>" class="btn btn-outline-info">
                            <i class="fas fa-share me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.asset_allocated'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\RevokeAllocatedAssetController::class, 'index']), false); ?>" class="btn btn-outline-warning">
                            <i class="fas fa-undo me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.revoked_asset'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetMaitenanceController::class, 'index']), false); ?>" class="btn btn-outline-danger">
                            <i class="fas fa-wrench me-1"></i> <?php echo app('translator')->get('assetmanagement::lang.asset_maintenance'); ?>
                        </a>
                        <a href="<?php echo e(action([\Modules\AssetManagement\Http\Controllers\AssetSettingsController::class, 'index']), false); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-cog me-1"></i> <?php echo app('translator')->get('role.settings'); ?>
                        </a>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php if($is_admin): ?>
        <?php if($condition_chart && $assets_by_condition->count() > 0): ?>
            <?php echo $condition_chart->script(); ?>

        <?php endif; ?>
        <?php if($status_chart && $assets_by_status->count() > 0): ?>
            <?php echo $status_chart->script(); ?>

        <?php endif; ?>
        <?php if($category_chart && $assets_by_category->count() > 0): ?>
            <?php echo $category_chart->script(); ?>

        <?php endif; ?>
        <?php if($maintenance_chart && $maintenance_stats->count() > 0): ?>
            <?php echo $maintenance_chart->script(); ?>

        <?php endif; ?>
        <?php if($acquisition_chart): ?>
            <?php echo $acquisition_chart->script(); ?>

        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
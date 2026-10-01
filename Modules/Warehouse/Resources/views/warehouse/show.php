
<?php $__env->startSection('title', __('warehouse::lang.warehouse_details')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo e($warehouse->name, false); ?>

        <small><?php echo app('translator')->get('warehouse::lang.warehouse_details'); ?></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('warehouse::lang.warehouse_details')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed">
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_name'); ?></th><td><?php echo e($warehouse->name, false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_code'); ?></th><td><?php echo e($warehouse->location_id ?? '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_type'); ?></th><td><?php echo app('translator')->get('warehouse::lang.type_' . $warehouse->warehouse_type); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.business_location'); ?></th><td><?php echo e(optional($warehouse->warehouse_parent_loc)->name ?? '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_manager'); ?></th><td><?php echo e(optional($warehouse->warehouse_manager)->user_full_name ?? $warehouse->manager_name ?? '-', false); ?></td></tr>
                            <tr>
                                <th><?php echo app('translator')->get('warehouse::lang.active'); ?></th>
                                <td>
                                    <?php if($warehouse->is_active): ?>
                                        <span class="badge bg-success"><?php echo app('translator')->get('warehouse::lang.active'); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?php echo app('translator')->get('warehouse::lang.inactive'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-condensed">
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_address'); ?></th><td><?php echo $warehouse->location_address ?: '-'; ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_phone'); ?></th><td><?php echo e($warehouse->mobile ?? '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.warehouse_email'); ?></th><td><?php echo e($warehouse->email ?? '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.total_area'); ?></th><td><?php echo e($warehouse->warehouse_total_area ? number_format($warehouse->warehouse_total_area, 2) . ' sq ft' : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('warehouse::lang.usable_area'); ?></th><td><?php echo e($warehouse->warehouse_usable_area ? number_format($warehouse->warehouse_usable_area, 2) . ' sq ft' : '-', false); ?></td></tr>
                        </table>
                    </div>
                </div>
                <?php if($warehouse->warehouse_notes): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <strong><?php echo app('translator')->get('warehouse::lang.warehouse_notes'); ?>:</strong>
                            <p><?php echo e($warehouse->warehouse_notes, false); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('warehouse::lang.stock_overview')]); ?>
                <div class="text-center">
                    <h3><?php echo e($stock_count, false); ?></h3>
                    <p class="text-muted"><?php echo app('translator')->get('warehouse::lang.total_products'); ?></p>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-xs-6">
                        <h4><?php echo e($zones_count, false); ?></h4>
                        <p class="text-muted"><?php echo app('translator')->get('warehouse::lang.zones'); ?></p>
                    </div>
                    <div class="col-xs-6">
                        <h4><?php echo e($bins_count, false); ?></h4>
                        <p class="text-muted"><?php echo app('translator')->get('warehouse::lang.bin_locations'); ?></p>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <a href="<?php echo e(route('warehouse.stock', ['warehouse_id' => $warehouse->id]), false); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-boxes"></i> <?php echo app('translator')->get('warehouse::lang.view_stock'); ?>
                    </a>
                    <a href="<?php echo e(route('warehouse.zones', $warehouse->id), false); ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-th-large"></i> <?php echo app('translator')->get('warehouse::lang.zones'); ?>
                    </a>
                    <a href="<?php echo e(route('warehouse.bins', $warehouse->id), false); ?>" class="btn btn-default btn-sm">
                        <i class="fas fa-map-marker-alt"></i> <?php echo app('translator')->get('warehouse::lang.bin_locations'); ?>
                    </a>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
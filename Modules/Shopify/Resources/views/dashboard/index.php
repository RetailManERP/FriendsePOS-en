

<?php $__env->startSection('title', 'Shopify'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Shopify Dashboard
        <small>Manage your Shopify integration</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php if($stores->isEmpty()): ?>
    <div class="box box-solid">
        <div class="box-body">
            <div class="alert alert-info">
                <h4><i class="icon fa fa-info"></i> No Shopify Stores Connected</h4>
                <p>Please add a Shopify store connection to get started.</p>
                <a href="<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyConnectionController::class, 'create']), false); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Connection
                </a>
            </div>
        </div>
    </div>
    <?php else: ?>
    
    <!-- Store Selector -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label for="store-selector">Select Store:</label>
                        <select id="store-selector" class="form-control select2" style="width: 100%;">
                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($store->id, false); ?>" <?php echo e(($selectedStore && $selectedStore->id === $store->id) ? 'selected' : '', false); ?>>
                                    <?php echo e($store->shop_name, false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-bag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Products</span>
                    <span class="info-box-number"><?php echo e($metrics['total_products'], false); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Orders</span>
                    <span class="info-box-number"><?php echo e($metrics['total_orders'], false); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Customers</span>
                    <span class="info-box-number"><?php echo e($metrics['total_customers'], false); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number"><?php echo e(number_format($metrics['total_revenue'], 2), false); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Sync Logs -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Sync Activity</h3>
                </div>
                <div class="box-body">
                    <?php if($recentSyncLogs->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Processed</th>
                                    <th>Failed</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentSyncLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><span class="label label-info"><?php echo e(ucfirst($log->sync_type), false); ?></span></td>
                                    <td>
                                        <span class="label label-<?php echo e($log->status === 'completed' ? 'success' : 'warning', false); ?>">
                                            <?php echo e(ucfirst($log->status), false); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($log->records_processed, false); ?></td>
                                    <td><?php echo e($log->records_failed, false); ?></td>
                                    <td><?php echo e($log->created_at->diffForHumans(), false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p class="text-muted text-center">No sync activity yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#store-selector').change(function() {
            var storeId = $(this).val();
            window.location.href = "<?php echo e(url('shopify'), false); ?>?store_id=" + storeId;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
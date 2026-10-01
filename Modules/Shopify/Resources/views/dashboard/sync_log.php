
<?php $__env->startSection('title', 'Shopify Sync Log'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Shopify Sync Log
        <small>View synchronization history</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="shopify_sync_log_table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Store</th>
                        <th>Sync Type</th>
                        <th>Status</th>
                        <th>Processed</th>
                        <th>Failed</th>
                        <th>Duration</th>
                        <th>Error</th>
                    </tr>
                </thead>
            </table>
</div>
        </div>
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#shopify_sync_log_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(action([\Modules\Shopify\Http\Controllers\ShopifyDashboardController::class, 'syncLog']), false); ?>",
            order: [[0, 'desc']],
            columns: [
                { data: 'created_at', name: 'shopify_sync_logs.created_at' },
                { data: 'shop_name', name: 'shopify_stores.shop_name' },
                { data: 'sync_type', name: 'shopify_sync_logs.sync_type' },
                { data: 'status', name: 'shopify_sync_logs.status' },
                { data: 'records_processed', name: 'shopify_sync_logs.records_processed' },
                { data: 'records_failed', name: 'shopify_sync_logs.records_failed' },
                { data: 'sync_duration', name: 'shopify_sync_logs.sync_duration' },
                { data: 'error_message', name: 'shopify_sync_logs.error_message', orderable: false },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('title', 'Shopify Connections'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('shopify::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Shopify Connections
        <small>Manage your Shopify store connections</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Connected Stores</h3>
            <div class="box-tools">
                <a href="<?php echo e(action('\Modules\Shopify\Http\Controllers\ShopifyConnectionController@create'), false); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add Connection
                </a>
            </div>
        </div>
        
        <div class="box-body">
            <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?php echo e(session('success'), false); ?>

            </div>
            <?php endif; ?>

            <?php if($stores->isEmpty()): ?>
            <div class="alert alert-info">
                <h4><i class="icon fa fa-info"></i> No Connections</h4>
                You haven't connected any Shopify stores yet. Click "Add Connection" to get started.
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Shop Name</th>
                            <th>Shop URL</th>
                            <th>Status</th>
                            <th>API Version</th>
                            <th>Last Sync</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($store->shop_name, false); ?></strong></td>
                            <td>
                                <?php if($store->shop_url): ?>
                                <a href="<?php echo e($store->shop_url, false); ?>" target="_blank"><?php echo e($store->shop_url, false); ?></a>
                                <?php else: ?>
                                <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($store->is_active): ?>
                                <span class="label label-success">Active</span>
                                <?php else: ?>
                                <span class="label label-default">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($store->api_version, false); ?></td>
                            <td>
                                <?php if($store->last_sync_at): ?>
                                <?php echo e($store->last_sync_at->diffForHumans(), false); ?>

                                <?php else: ?>
                                <span class="text-muted">Never</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-info toggle-status" data-id="<?php echo e($store->id, false); ?>" data-active="<?php echo e($store->is_active, false); ?>">
                                        <i class="fa fa-power-off"></i>
                                        <?php echo e($store->is_active ? 'Deactivate' : 'Activate', false); ?>

                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete-connection" data-id="<?php echo e($store->id, false); ?>" data-name="<?php echo e($store->shop_name, false); ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>

                                <form id="delete-form-<?php echo e($store->id, false); ?>" action="<?php echo e(action('\Modules\Shopify\Http\Controllers\ShopifyConnectionController@destroy', $store->id), false); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Delete connection
    $('.delete-connection').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        
        swal({
            title: 'Are you sure?',
            text: 'Delete connection to ' + name + '?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#delete-form-' + id).submit();
            }
        });
    });

    // Toggle status
    $('.toggle-status').click(function() {
        var btn = $(this);
        var id = btn.data('id');
        var isActive = btn.data('active');

        btn.prop('disabled', true);

        $.ajax({
            url: '<?php echo e(url("shopify/connections"), false); ?>/' + id + '/status',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                is_active: !isActive
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Failed to update status');
                    btn.prop('disabled', false);
                }
            },
            error: function() {
                alert('Failed to update status');
                btn.prop('disabled', false);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>